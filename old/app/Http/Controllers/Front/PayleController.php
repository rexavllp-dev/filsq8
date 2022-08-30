<?php

namespace App\Http\Controllers\Front;

use App\Classes\ShowpekMailer;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderTrack;
use App\Models\Pagesetting;
use App\Models\Product;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\VendorOrder;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Input;
use Redirect;
use Stripe\Error\Card;
use URL;
use Validator;
use App\Classes\PHP_AES_Cipher;

class PayleController extends Controller
{
    public function __construct()
    {
        $payle = Generalsetting::findOrFail(1);
    }
    public function store(Request $request){
        if($request->pass_check) {
            $users = User::where('email','=',$request->personal_email)->get();
            if(count($users) == 0) {
                if ($request->personal_pass == $request->personal_confirm){
                    $user = new User;
                    $user->name = $request->personal_name; 
                    $user->email = $request->personal_email;   
                    $user->password = bcrypt($request->personal_pass);
                    $token = md5(time().$request->personal_name.$request->personal_email);
                    $user->verification_link = $token;
                    $user->affilate_code = md5($request->name.$request->email);
                    $user->email_verified = 'Yes';
                    $user->save();
                    Auth::guard('web')->login($user);                     
                }else{
                    return redirect()->back()->with('unsuccess',"Confirm Password Doesn't Match.");     
                }
            }
            else {
                return redirect()->back()->with('unsuccess',"This Email Already Exist.");  
            }
        }
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
            if (Session::has('currency')) 
            {
              $curr = Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = Currency::where('is_default','=',1)->first();
            }

        $settings = Generalsetting::findOrFail(1);
        $order = new Order;
        $item_name = $settings->title." Order";
        $item_number = str_random(4).time();
        $item_amount = $request->total;
        $udf1= action('Front\PayleController@payreturn'); // Return Url   
       // echo "Wait";
        foreach($cart->items as $key => $prod)
        {
            if(!empty($prod['item']['license']) && !empty($prod['item']['license_qty']))
            {
                    foreach($prod['item']['license_qty']as $ttl => $dtl)
                    {
                        if($dtl != 0)
                        {
                            $dtl--;
                            $produc = Product::findOrFail($prod['item']['id']);
                            $temp = $produc->license_qty;
                            $temp[$ttl] = $dtl;
                            $final = implode(',', $temp);
                            $produc->license_qty = $final;
                            $produc->update();
                            $temp =  $produc->license;
                            $license = $temp[$ttl];
                            $oldCart = Session::has('cart') ? Session::get('cart') : null;
                            $cart = new Cart($oldCart);
                            $cart->updateLicense($prod['item']['id'],$license);  
                            Session::put('cart',$cart);
                            break;
                        }                    
                    }
            }
        }
        
        $order['user_id'] = $request->user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($item_amount / $curr->value, 2);
        $order['method'] = "Payle";
        $order['customer_email'] = $request->email;
        $order['customer_name'] = $request->name;
        $order['customer_phone'] = $request->phone;
        $order['order_number'] = $item_number;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        $order['customer_zip'] = $request->zip;
        $order['shipping_email'] = $request->shipping_email;
        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_country'] = $request->shipping_country;
        $order['shipping_city'] = $request->shipping_city;
        $order['shipping_zip'] = $request->shipping_zip;
        $order['order_note'] = $request->order_notes;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['payment_status'] = "Pending";        
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['tax'] = $request->tax;
        $order['dp'] = $request->dp;
        $order['vendor_shipping_id'] = $request->vendor_shipping_id;
        $order['vendor_packing_id'] = $request->vendor_packing_id;     
        $order['status'] = $order['dp'] == 1 ? "completed" : 'pending';
        if (Session::has('affilate')) 
        {
                $val = $request->total / $curr->value;
                $val = $val / 100;
                $sub = $val * $settings->affilate_charge;
                $user = User::findOrFail(Session::get('affilate'));
                $user->affilate_income += $sub;
                $user->update();
                $order['affilate_user'] = $user->name;
                $order['affilate_charge'] = $sub;
        }
        $order->save();
        if($request->coupon_id != "")
        {
           $coupon = Coupon::findOrFail($request->coupon_id);
           $coupon->used++;
           if($coupon->times != null)
           {
                $i = (int)$coupon->times;
                $i--;
                $coupon->times = (string)$i;
           }
           $coupon->update();

        }
        
        // PayLe
       //STO Fetching the Full Ammount from the Payle
       $url = 'https://sandpay.payleq8.com/apifee/requestfullamounts';
       $data = array('lang' => 'en', 'initialAmount' => $order->pay_amount,'businessCode'=>$settings->payle_business_code);
       $options = array(
               'http' => array(
               'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
               'method'  => 'POST',
               'content' => http_build_query($data),
           )
       );
       
       $context  = stream_context_create($options);
       $result = file_get_contents($url, false, $context);
       $Ammountreturn=json_decode($result);

        foreach($Ammountreturn as $keys=>$records){
            if(is_array($records)){
                foreach($records as $k=>$v){
                   // print_r($v);
                    if($v->name=="Visa / Master Card")
                        $fullamount=$v->fullAmount;
                }
            }
        }
        //ENO Fetching the Full Ammount from the Payle
            $TranportalId=$settings->payle_accountid;
            $ReqTranportalId = "tpid=".$TranportalId."&";        
            $ReqTranportalPassword = $settings->payle_accountpassword;
            $ReqTranportalKey = "tpkey=".$ReqTranportalPassword."&";        
            $TranAmount = number_format($order->pay_amount / $curr->value, 3);
            $ReqAmount = "amount=".$TranAmount."&";        
             $TranFullAmount = number_format(($fullamount) / $curr->value, 3);
            $ReqFullAmount = "fullamount=".$TranFullAmount."&";                
            $paymenttype =  3; // “0 mean Knet, 3 mean Visa/Master”
            $ReqPaymentType = "paymenttype=".$paymenttype."&";        
            $businesscode =$settings->payle_business_code;
            $ReqBusinesscode = "businesscode=".$businesscode."&";
            $invoicekey = $order->id;
    	    $ReqInvoiceKey="invoicekey=".$invoicekey."&";

            $udf2 = "";
    	    $udf3 = "";
            $ReqUdf1 = "udf1=". $udf1 ."&";  
            $ReqUdf2 = "udf2=". $udf2 ."&";    
    	    $ReqUdf3 = "udf3=". $udf3 ."&";
            $paymentmedia = 1; //“0 mean mobile app, 1 mean web browser” 
        	$ReqPaymentMedia = "paymentmedia=".$paymentmedia."&";
            $buyerMobile = $request->phone;
            $buyerEmail =$request->email;
            $buyername =$request->name;       
            $ReqPaymentBuyerMobile = "buyermobile=".$buyerMobile."&";
            $ReqPaymentBuyerEmail = "buyeremail=".$buyerEmail."&";
            $ReqPaymentBuyerName = "buyername=".$buyername."&";
            $transactionRequestData = $ReqPaymentMedia.$ReqAmount.$ReqFullAmount.$ReqPaymentType.$ReqBusinesscode.$ReqInvoiceKey.$ReqUdf1.$ReqUdf2.$ReqUdf3.$ReqTranportalId.$ReqTranportalKey.$ReqPaymentBuyerMobile.$ReqPaymentBuyerEmail.$ReqPaymentBuyerName;
           //echo "</br>";
            $phpclass = new PHP_AES_Cipher; 
            $encriptData = $phpclass->encrypt($transactionRequestData);
            if ($settings->payle_mode == 'sandbox') {
                $redirectUrl= "https://sandpay.payleq8.com/payinit/en/".$encriptData."/".$TranportalId."/0";
            } elseif ($settings->payle_mode == 'live') {
                
                $redirectUrl= "https://trans.payleq8.com/payinit/en/".$encriptData."/".$TranportalId."/0";
            }
          
           
         //exit;
            Session::put('temporder',$order);
            Session::put('tempcart',$cart);
            Session::forget('cart');
           return redirect($redirectUrl);
                       
    }
    
    public function payreturn(Request $request){
        $phpclass = new PHP_AES_Cipher; 
        $data=explode('?', $request);
        $decriptData = urldecode($data[1]);
        //$decriptData = $phpclass->decrypt($data[1]);
        $raw_post_array = explode('&', $decriptData);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);           
            $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
    
        if($myPost['code']== 00){ // Success
            $order = Order::where('id',$myPost['refnumber'])
            ->where('id',$myPost['refnumber'])->first();
            $data['payment_status']='Completed';
            $data['status'] = 'completed';
            $data['dp'] =1;
            $trackNumber=$myPost['trackNumber'];
            $transDate=$myPost['transDate'];
            $order->update($data);
            if($order->dp == 1){
                $track = new OrderTrack;
                $track->title = 'Completed';
                $track->text = 'Your order has completed successfully.';
                $track->order_id = $order->id;
                $track->save();
            }
            else {
                $track = new OrderTrack;
                $track->title = 'Pending';
                $track->text = 'You have successfully placed your order.';
                $track->order_id = $order->id;
                $track->save();
            }
            $requested=Session::get('tempcart');
            $notification = new Notification;
            $notification->order_id = $order->id;
            $notification->save();
            if($requested->coupon_id != "")
            {
                       $coupon = Coupon::findOrFail($requested->coupon_id);
                       $coupon->used++;
                       if($coupon->times != null)
                       {
                            $i = (int)$coupon->times;
                            $i--;
                            $coupon->times = (string)$i;
                       }
                        $coupon->update();

            }
            $cart=Session::get('tempcart');
            foreach($cart->items as $prod)
            {
                $x = (string)$prod['size_qty'];
                if(!empty($x))
                {
                    $product = Product::findOrFail($prod['item']['id']);
                    $x = (int)$x;
                    $x = $x - $prod['qty'];
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = $x;
                    $temp1 = implode(',', $temp);
                    $product->size_qty =  $temp1;
                    $product->update();               
                }
            }
            foreach($cart->items as $prod)
            {
                $x = (string)$prod['stock'];
                if($x != null)
                {

                    $product = Product::findOrFail($prod['item']['id']);
                    $product->stock =  $prod['stock'];
                    $product->update();  
                    if($product->stock <= 5)
                    {
                        $notification = new Notification;
                        $notification->product_id = $product->id;
                        $notification->save();                    
                    }              
                }
            }
            $notf = null;

            foreach($cart->items as $prod)
            {
                if($prod['item']['user_id'] != 0)
                {
                    $vorder =  new VendorOrder;
                    $vorder->order_id = $order->id;
                    $vorder->user_id = $prod['item']['user_id'];
                    $notf[] = $prod['item']['user_id'];
                    $vorder->qty = $prod['qty'];
                    $vorder->price = $prod['price'];
                    $vorder->order_number = $order->order_number;         
                   // var_dump($vorder);exit;    
                    $vorder->save();
                }

            }
            if(!empty($notf))
            {
                $users = array_unique($notf);
                foreach ($users as $user) {
                    $notification = new UserNotification;
                    $notification->user_id = $user;
                    $notification->order_number = $order->order_number;
                    $notification->save();    
                }
            }
            $gs = Generalsetting::find(1);

            //Sending Email To Buyer

            if($gs->is_smtp == 1)
            {
            $data = [
                'to' => $requested->email,
                'type' => "new_order",
                'cname' => $requested->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
                'onumber' => $order->order_number,
            ];

            $mailer = new ShowpekMailer();
            $mailer->sendAutoOrderMail($data,$order->id);            
            }
            else
            {
            $to = $requested->email;
            $subject = "Your Order Placed!!";
            $msg = "Hello ".$requested->name."!\nYou have placed a new order.\nYour order number is ".$order->order_number.".Please wait for your delivery. \nThank you.";
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$msg,$headers);            
            }
            //Sending Email To Admin
            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => Pagesetting::find(1)->contact_email,
                    'subject' => "New Order Recieved!!",
                    'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is ".$order->order_number.".Please login to your panel to check. <br>Thank you.",
                ];

                $mailer = new ShowpekMailer();
                $mailer->sendCustomMail($data);            
            }
            else
            {
            $to = Pagesetting::find(1)->contact_email;
            $subject = "New Order Recieved!!";
            $msg = "Hello Admin!\nYour store has recieved a new order.\nOrder Number is ".$order->order_number.".Please login to your panel to check. \nThank you.";
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           // mail($to,$subject,$msg,$headers);
            }
            Session::put('temporder',$order);
            Session::put('tempcart',$cart);
            Session::forget('cart');

            Session::forget('already');
            Session::forget('coupon');
            Session::forget('coupon_total');
            Session::forget('coupon_total1');
            Session::forget('coupon_percentage');  
            $success_url = action('Front\PaymentController@payreturn');          
          //  return view('front.success',compact('tempcart','order'));
          return redirect($success_url);
        }else{
           
            $order = Order::where('id',$myPost['refnumber'])
            ->where('id',$myPost['refnumber'])->first();
            $data['payment_status']='declined';
            $data['status'] = 'declined';
            $order->update($data);          
            $payment = Order::where('id',$myPost['refnumber']);
            //var_dump($payment);exit;
             VendorOrder::where('id','=',$myPost['refnumber'])->delete();
             $payment->delete();
            Session::forget('cart');
          return redirect()->route('front.checkout')->with('unsuccess','Payment Failed.');
        }
    }
   
}
