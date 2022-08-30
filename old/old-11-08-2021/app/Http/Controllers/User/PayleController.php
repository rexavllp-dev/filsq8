<?php

namespace App\Http\Controllers\User;


use App\Classes\ShowpekMailer;
use App\Models\Generalsetting;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Auth;
use App\Models\Currency;
use Carbon\Carbon;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Classes\PHP_AES_Cipher;

class PayleController extends Controller
{


   public function store(Request $request){


    $this->validate($request, [
        'shop_name'   => 'unique:users',
    ],[ 
     'shop_name.unique' => 'This shop name has already been taken.'
    ]);

    $user = Auth::user();
    $subs = Subscription::findOrFail($request->subs_id);
    $settings = Generalsetting::findOrFail(1);
    $notify_url = action('User\PayleController@notify');
    $item_name = $subs->title." Plan";
    $item_number = str_random(4).time();
    $item_amount = $subs->price;


                    $sub = new UserSubscription;
                    $input['user_id'] = $user->id;
                    $input['subscription_id'] = $subs->id;
                    $input['title'] = $subs->title;
                    $input['currency'] = $subs->currency;
                    $input['currency_code'] = $subs->currency_code;
                    $input['price'] = $subs->price;
                    $input['days'] = $subs->days;
                    $input['allowed_products'] = $subs->allowed_products;
                    $input['details'] = $subs->details;
                    $input['method'] = 'Payle';

                    $subid = $sub->create($input);

    $settings = Generalsetting::findOrFail(1);

    $udf1= url('/user/payle/payreturn');


                $url = 'https://sandpay.payleq8.com/apifee/requestfullamounts';
                $data = array('lang' => 'en', 'initialAmount' =>$subs->price,'businessCode'=>$settings->payle_business_code);
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
                            if($v->name=="Visa / Master Card")
                                $fullamount=$v->fullAmount;
                        }
                    }
                }

                if (Session::has('currency')) 
                {
                  $curr = Currency::find(Session::get('currency'));
              }
              else
              {
                $curr = Currency::where('is_default','=',1)->first();
            }
             
            $TranportalId=$settings->payle_accountid;

            $ReqTranportalId = "tpid=".$TranportalId."&";     
            $ReqTranportalPassword = $settings->payle_accountpassword;
            $ReqTranportalKey = "tpkey=".$ReqTranportalPassword."&";
            $TranAmount = number_format($subs->price,2);
            $ReqAmount = "amount=".$TranAmount."&";      
            $TranFullAmount = number_format($fullamount, 2);
            $ReqFullAmount = "fullamount=".$TranFullAmount."&";  
            $paymenttype =  3; // “0 mean Knet, 3 mean Visa/Master”
            $ReqPaymentType = "paymenttype=".$paymenttype."&";        
            $businesscode =$settings->payle_business_code;
            $ReqBusinesscode = "businesscode=".$businesscode."&";
            $invoicekey = 'INS'.$subid->id;
            $ReqInvoiceKey="invoicekey=".$invoicekey."&";

            $udf2 = "";
            $udf3 = "";
            $ReqUdf1 = "udf1=". $udf1 ."&";  
            $ReqUdf2 = "udf2=". $udf2 ."&";    
            $ReqUdf3 = "udf3=". $udf3 ."&";
            $paymentmedia = 1; //“0 mean mobile app, 1 mean web browser” 
            $ReqPaymentMedia = "paymentmedia=".$paymentmedia."&";
            $buyerMobile = $user->phone;
            $buyerEmail = $user->email;
            $buyername =$user->name;   

            $ReqPaymentBuyerMobile = "buyermobile=".$buyerMobile."&";
            $ReqPaymentBuyerEmail = "buyeremail=".$buyerEmail."&";
            $ReqPaymentBuyerName = "buyername=".$buyername."";
            $transactionRequestData = $ReqPaymentMedia.$ReqAmount.$ReqFullAmount.$ReqPaymentType.$ReqBusinesscode.$ReqInvoiceKey.$ReqUdf1.$ReqUdf2.$ReqUdf3.$ReqTranportalId.$ReqTranportalKey.$ReqPaymentBuyerMobile.$ReqPaymentBuyerEmail.$ReqPaymentBuyerName;


            
            $phpclass = new PHP_AES_Cipher; 
            $encriptData = $phpclass->encrypt($transactionRequestData);
            if ($settings->payle_mode == 'sandbox') {
                 $redirectUrl= "https://sandpay.payleq8.com/payinit/en/".$encriptData."/".$TranportalId."/0";
            } elseif ($settings->payle_mode == 'live') {
                $redirectUrl= "https://sandpay.payleq8.com/payinit/en/".$encriptData."/".$TranportalId."/0";
            }
        
                
            Session::put('tempdata',$subid);


          
            return redirect($redirectUrl);
        }


        public function paycancle(){
           return redirect()->back()->with('unsuccess','Payment Cancelled.');
       }

       public function payreturn(){

            $phpclass = new PHP_AES_Cipher; 
            $transaction_date = date('Y-m-d H:i:s');
            $reference_number = request('refnumber');
            $track_number = request('trackNumber');
            $code = request('code');
            $data = $phpclass->decrypt(request('transDate'));
            dd(request('transDate'));

            if($code = '00' && $track_number != '' ){

                $requested=Session::get('tempdata');

                if('INS'.$requested->id == $data['invoicekey'] ){
                    $subscription = UserSubscription::find($subid->id); 
                    $subscription->status = 1;
                    $subscription->transaction_status = 1;
                    $subscription->payment_number = $track_number;
                    $subscription->transaction_date = $transaction_date;
                    $subscription->save();
                    return redirect()->route('/dashboard')->with('success','Vendor Account Activated Successfully');
                }
                else{
                     $subscription = UserSubscription::find($subid->id);    
                     $subscription->delete();
                     return redirect()->route('/dashboard')->with('failed','Vendor Account  Not Activated Successfully');
                }
            }
            else{   
                $subscription = UserSubscription::find($subid->id);    
                $subscription->delete();
                 return redirect()->route('/dashboard   ')->with('failed','Vendor Account  Not Activated Successfully');
            }
       }


       public function notify(Request $request){

        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
    //return $myPost;


    // Read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }

    /*
     * Post IPN data back to PayPal to validate the IPN data is genuine
     * Without this step anyone can fake IPN data
     */
    $paypalURL = "https://www.paypal.com/cgi-bin/webscr";
    $ch = curl_init($paypalURL);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
    $res = curl_exec($ch);

    /*
     * Inspect IPN validation result and act accordingly
     * Split response headers and payload, a better way for strcmp
     */
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));
    if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

        $order = UserSubscription::where('user_id','=',$_POST['custom'])
        ->orderBy('created_at','desc')->first();


        $user = User::findOrFail($_POST['custom']);
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($order->subscription_id);
        $settings = Generalsetting::findOrFail(1);


        $today = Carbon::now()->format('Y-m-d');
        $date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
        $input = $request->all();
        $user->is_vendor = 2;
        if(!empty($package))
        {
            if($package->subscription_id == $request->subs_id)
            {
                $newday = strtotime($today);
                $lastday = strtotime($user->date);
                $secs = $lastday-$newday;
                $days = $secs / 86400;
                $total = $days+$subs->days;
                $user->date = date('Y-m-d', strtotime($today.' + '.$total.' days'));
            }
            else
            {
                $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
            }
        }
        else
        {
            $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
        }
        $user->mail_sent = 1;
        $user->update($input);


        $data['txnid'] = $_POST['txn_id'];
        $data['status'] = 1;
        $order->update($data);

        if($settings->is_smtp == 1)
        {
            $maildata = [
                'to' => $user->email,
                'type' => "vendor_accept",
                'cname' => $user->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'onumber' => "",
            ];
            $mailer = new ShowpekMailer();
            $mailer->sendAutoMail($maildata);
        }
        else
        {
            $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
            mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
        }


    }else{
        $payment = UserSubscription::where('user_id','=',$_POST['custom'])
        ->orderBy('created_at','desc')->first();
        $payment->delete();


    }
}

}
