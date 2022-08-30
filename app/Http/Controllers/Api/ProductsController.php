<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Passport\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Message;   
use App\Classes\GeniusMailer;
use App\Models\Conversation;
use App\Models\Generalsetting;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::where('id',$id)->get()->toArray();      
       
        $newProducts=null;
            foreach($product as $key=>$value){
                if($key=='data'){
                    
                    foreach($value as $k=>$v){
                           if($k=='details'){
                                $newProducts['data']['details']=strip_tags($v);
                            }else{
                                $newProducts['data'][$k]=$v;
                            }
                    }
                    
                }else{
                    $newProducts[$key]=$value;
                }
              
            }
            $response=['results'=>$newProducts,'product_imageLink'=>url('assets/images/products/')];
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
        //
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
    
    public function search(Request $request){
        $category=$request->get('cate');
        $search=$request->get('s');
        $order=$request->get('orderby');
        $products=null;
        
        if($order=='htol'){

            $orderF='price';
            $orderB='DESC';

        }elseif($order=='ltoh'){

            $orderF='price';
            $orderB='ASC';

        }
        elseif($order=='ztoa'){

            $orderF='name';
            $orderB='DESC';

        }else{
            $orderF='name';
            $orderB='ASC';
        }
       
        if($request->get('cate')){            
            $products=Product::wherein('category_id',explode(",",$category))->orderBy($orderF,$orderB)->paginate(20);            
        }else{
            if($request->has('s')){
                $products=Product::where('name','like','%'.$search.'%')->orderBy($orderF,$orderB)->paginate(20);
            }
            else{
                $products=Product::orderBy($orderF,$orderB)->paginate(20);               
            }
            
        }

        if(!empty($products)){
            $newProducts=null;
            // foreach($products as $key=>$value){
            //     if($key=='data'){
            //         foreach($value as $k=>$v){
            //             foreach($v as $i=>$j){
            //                 if($i=='details'){
            //                       $newProducts['data']['details']=strip_tags($j);
            //                 }else{
            //                     $newProducts['data'][$i]=$j;
            //                 }
            //             }
                      
            //         }
                    
            //     }else{
            //         $newProducts[$key]=$value;
            //     }
              
            // }        

            $response=[
                'results'=>$products,
                'product_imageLink'=>url('assets/images/thumbnails/')
            ];
            return response($response,201);
        }else{
            $response=[
                'results'=>'No product found'
            ];
            return response($response,201);
        }
    }
    public function categories(){
        $Category=Category::whereStatus(1)->where('language_id',1)->get();
        $response=['results'=>$Category];
        return response($response,201);
    }

    public function contactseller(Request $request){
        $fields=$request->validate([
            'product_id'=>'required|integer|numeric',           
        ]);
        $gs = Generalsetting::findOrFail(1);
        $user_id=auth()->user()->id;        
        $product=Product::find($request->get('product_id'));
        $seller =User::find($product->user_id);
            $subject = "Request for Product SKU : ".$product->sku;
            $to = $seller->email;
            $name = auth()->user()->name;
            $from = auth()->user()->email;
            $phone= auth()->user()->phone;
            $productdetails=null;
            foreach($request->all() as $key=>$value){
                $productdetails.='<br>'.$key.":".$value;
            }
            $mess=
             "Hi $seller->name,Mr/Mis $name has requested purachase the product ($product->name) from you.Here follows the userdetails.Name:$name.<br>Email:$from<br>Phone:$phone <br><h4>Ordering product details</h4>$productdetails";
            
            if($gs->is_smtp)
            {
                $data = [
                    'to' => $to,
                    'subject' => $subject,
                    'body' => $mess,
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);
            }
            else{
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$mess,$headers);
            }
            $conv = Conversation::where('sent_user','=',$user_id)->where('subject','=',$subject)->first();
            if(isset($conv)){
                $msg = new Message();
                $msg->conversation_id = $conv->id;
                $msg->message = $mess;
                $msg->sent_user = $user_id;
                $msg->recieved_user = $seller->id;
                $msg->save();
                $response=['message'=>"'Message Sent!"];
                return response($response,201);
            }
            else{
                $message = new Conversation();
                $message->subject = $subject;
                $message->sent_user= $user_id;
                $message->recieved_user = $seller->id;
                $message->message = $mess;
                $message->save();
                $msg = new Message();
                $msg->conversation_id = $message->id;
                $msg->message = $mess;
                $msg->sent_user =  $user_id;
                $msg->recieved_user = $seller->id;
                $msg->save();
                $response=['message'=>"'Message Sent!"];
                return response($response,201);
            }
       
    }
}
