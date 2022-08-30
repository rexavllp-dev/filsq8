<?php 
use App\Classes\PHP_AES_Cipher;
use App\Models\Currency;
use App\Models\Generalsetting;
 $settings = Generalsetting::findOrFail(1);

    $udf1= url('/user/payle/payreturn');




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
             
            $TranportalId=$settings->payle_accountid;
            $ReqTranportalId = "tpid=".$TranportalId."&"; 

            $ReqTranportalPassword = $settings->payle_accountpassword;
            $ReqTranportalKey = "tpkey=".$ReqTranportalPassword."&";
            $TranAmount = number_format(10,2);
            $ReqAmount = "amount=".$TranAmount."&";      
            $TranFullAmount = number_format($fullamount, 2);
            $ReqFullAmount = "fullamount=".$TranFullAmount."&";  
            $paymenttype =  3; // “0 mean Knet, 3 mean Visa/Master”
            $ReqPaymentType = "paymenttype=".$paymenttype."&";        
            $businesscode =$settings->payle_business_code;
         
            $ReqBusinesscode = "businesscode=".$businesscode."&";
            $invoicekey = 'INS1518';
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
            $ReqPaymentBuyerName = "buyername=".$buyername."&";
            $transactionRequestData = $ReqPaymentMedia.$ReqAmount.$ReqFullAmount.$ReqPaymentType.$ReqBusinesscode.$ReqInvoiceKey.$ReqUdf1.$ReqUdf2.$ReqUdf3.$ReqTranportalId.$ReqTranportalKey.$ReqPaymentBuyerMobile.$ReqPaymentBuyerEmail.$ReqPaymentBuyerName;

            $phpclass = new PHP_AES_Cipher; 
            $encriptData = $phpclass->encrypt($transactionRequestData);


            if ($settings->payle_mode == 'sandbox') {
                 $redirectUrl= "https://sandpay.payleq8.com/payinit/en/".$encriptData."/".$TranportalId."/0";
            } elseif ($settings->payle_mode == 'live') {
                $redirectUrl= "https://sandpay.payleq8.com/payinit/en/".$encriptData."/".$TranportalId."/0";
            }
                            return redirect($redirectUrl);
                    
            ?>