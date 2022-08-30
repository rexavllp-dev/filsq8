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

class PayletestController extends Controller
{


   public function paymentgateway(Request $request){

                $settings = Generalsetting::findOrFail(1);
                $udf1= url('/user/payle/payreturntest');
                $url = 'https://sandpay.payleq8.com/apifee/requestfullamounts';
                $data = array('lang' => 'en', 'initialAmount' =>10,'businessCode'=>"6d06bfbe513a0227e899ede94616fee94ec0741fa6fa7e6666a490ac24463b3b");
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
             
            $TranportalId="26106921";
            //account id
            $ReqTranportalId = "tpid=".$TranportalId."&";     
            $ReqTranportalPassword = "12345";
            //password 
            $ReqTranportalKey = "tpkey=".$ReqTranportalPassword."&";
            $TranAmount = number_format(10,2);
            $ReqAmount = "amount=".$TranAmount."&";      
            $TranFullAmount = number_format($fullamount, 2);
            $ReqFullAmount = "fullamount=".$TranFullAmount."&";  
            $paymenttype =  3; // “0 mean Knet, 3 mean Visa/Master”
            $ReqPaymentType = "paymenttype=".$paymenttype."&";        
            $businesscode ="6d06bfbe513a0227e899ede94616fee94ec0741fa6fa7e6666a490ac24463b3b";
            //business code 
            $ReqBusinesscode = "businesscode=".$businesscode."&";
            $invoicekey = 'INS1851';
            $ReqInvoiceKey="invoicekey=".$invoicekey."&";
            $udf2 = "";
            $udf3 = "";
            $ReqUdf1 = "udf1=". $udf1 ."&";  
            $ReqUdf2 = "udf2=". $udf2 ."&";    
            $ReqUdf3 = "udf3=". $udf3 ."&";
            $paymentmedia = 1; //“0 mean mobile app, 1 mean web browser” 
            $ReqPaymentMedia = "paymentmedia=".$paymentmedia."&";
            $buyerMobile = "6282218195";
            $buyerEmail ='vmohan491@gmail.com';
            $buyername ="vishnu";   

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
            
            
            Session::put('tempdata',10);
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
                     //$subscription = UserSubscription::find(123);    
                    // $subscription->delete();
                     return redirect()->route('/dashboard')->with('failed','Vendor Account  Not Activated Successfully');
                }
            }
            else{   
              //  $subscription = UserSubscription::find(123);    
                //$subscription->delete();
                 return redirect()->route('/dashboard   ')->with('failed','Vendor Account  Not Activated Successfully');
            }
       }
}
