<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Response;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Passport\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Str;
use App\Models\Generalsetting;
use App\Classes\GeniusMailer;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserAccoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      
        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed'
        ]);

      
        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password']),
        ]);
        
        $token=$user->createToken('filq8tocken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
           
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account=User::where('id',$id)->get();
        $response=['results'=>$account];
        return response($response,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd(auth()->user()->id);
        
        if($request->has('email')){
            $request->validate(['email'=>'email']);
        }
        if($request->has('name')){
            $request->validate(['name'=>'required']);
        }
        if($request->has('phone')){
            $request->validate(['phone'=>'required|integer|numeric']);
        }
        $user=User::find($id);
        $user->update($request->all());
        $response=[
            'user'=>$user            
        ];
        return response($response,201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function logout(Request $request){

       
       
        auth()->user()->tokens()->delete();
         $response= [
            'message' => "Logged out"
        ];
        return response($response,201);

    }
    public function login(Request $request){
        
        $fields=$request->validate([            
            'email'=>'required|string',
            'password'=>'required'
        ]);

        //Check the Email
        $user=User::where('email',$fields['email'])->first();
        #check Password
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message'=>"Invalid Email/Password"
            ],401);
        }
        // If Both are OK
        $token=$user->createToken('filq8tocken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response,201);
    }
    public function resetpassword(Request $request){
        $gs = Generalsetting::findOrFail(1);
        $fields=$request->validate([            
            'email'=>'required|string'            
        ]);
        if (User::where('email', '=', $request->email)->count() > 0) {
            $user = User::where('email', '=', $request->email)->firstOrFail();
            $otp          = $this->generateNumericOTP(8);
            $subject      = "Fotgot password";
            $msg          = "Hi, <br> Use OTP (".$otp.") to change the password. OTP will expire in 5 min.";
            if($gs->is_smtp == 1)
            {
                $data = [
                        'to' => $request->email,
                        'subject' => $subject,
                        'body' => $msg,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);
            }
            else
            {
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($request->email,$subject,$msg,$headers);
            }
            // dd($user->id);
            // Save OTP to server
            DB::table('user_resetpassword')->insert([
                'email'=>$user->email,
                'user'=>$user->id,
                'OTP'=>$otp,
                'created_at'=>new DateTime('NOW')
                ]
            );
            return $response=['Thank you, The OTP has send to your registered email. Please check. - OPT : '.$otp];
        }else{
            $response=['error'=>"Wrong email address!"];
        }
        return response($response,201);
    }
     public function verifyOTP(Request $request){
        $input_OTP=$request->get('OTP');
        $fields=$request->validate([            
            'OTP'=>'required'          
        ]);
        if(DB::table('user_resetpassword')->where('OTP',$input_OTP)->count() > 0){
            $response=[
                'response'=>true
            ];
        }else{
            $response=[
               'response'=>false
            ];
        }
        return response($response,201);
    }
    public function changepassword(Request $request){
        $input_OTP=$request->get('OTP');
        $input_password=$request->get('password');
        $input_cpassword=$request->get('cpassword');
        $fields=$request->validate([            
            'OTP'=>'required',            
            'password'=>'required|confirmed'           
        ]);
        if(DB::table('user_resetpassword')->where('OTP',$input_OTP)->count() > 0){
            $resetdata=DB::table('user_resetpassword')->where('OTP',$input_OTP)->first();            
            $otp_generatedtime=$resetdata->created_at;
            $time1 = new DateTime($otp_generatedtime);
            $time2 = new DateTime('NOW');
            $interval = $time1->diff($time2);
            $current= $interval->format('%s');
            
            $min = $interval->days * 24 * 60;
            $min += $interval->h * 60;
            $min += $interval->i;
       
            if((int)$min <= 5){
                $user=User::find($resetdata->user);
                $user->update(['password'=>bcrypt($fields['password'])]);
                DB::table('user_resetpassword')->where('id',$resetdata->id)->delete();
                $response=[
                    'message'=>"You have successfully change your password"
                ];
                return response($response,201);
            }else{
                $response=[
                    'error'=>"OTP has expired"
                ];
                DB::table('user_resetpassword')->where('id',$resetdata->id)->delete();
                return response($response,201);
            }
            
        }else{
            $response=[
                'error'=>"Wrong OTP !"
            ];
        }

        

        return response($response,201);
    }
    public function updatepassword(Request $request){
        $user_id=auth()->user()->id;
        $fields=$request->validate([            
            'old_password'=>'required',            
            'password'=>'required|confirmed'           
        ]);
        $user=User::where('id',$user_id)->first();
        #check Password
        if(!$user || !Hash::check($fields['old_password'],$user->password)){
            return response([
                'message'=>"Please enter you currect old password"
            ],401);
        }
        $user=User::find($user_id);
        $user->update(['password'=>bcrypt($fields['password'])]);
        $response=[
            'message'=>"You have successfully change your password"
        ];
        return response($response,201);
    }
    public function generateNumericOTP($n) {
      
        $generator = "1357902468";
        $result = "";
      
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
      
        // Return result
        return $result;
    }
}
