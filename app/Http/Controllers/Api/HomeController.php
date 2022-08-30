<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Passport\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
//Slider
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Faq;
use App\Models\Conversation;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider=Slider::where('language_id',1)->get();
        foreach($slider as $key=>$value){
              $sliderData[]=[
                "id"=>$value->id,
                "title"=>$value->title_text,
                "details"=>$value->details_text,
                "link"=>$value->link,
                "image"=>url('assets/images/sliders/'.$value->photo),
              ];       
        }
        //
       $Latest= Product::whereStatus(1)->whereLatest(1)->where('language_id',1)->get();
       $featured= Product::whereStatus(1)->whereFeatured(1)->where('language_id',1)->get();
       $best_seller= Product::whereStatus(1)->whereBest(1)->where('language_id',1)->get();
       $trending_products= Product::whereStatus(1)->whereTrending(1)->where('language_id',1)->get();
       $Category=Category::whereStatus(1)->where('language_id',1)->get();
        $response=[
            'slider'=>$sliderData,
            'latest_products'=>$Latest,
            'featured'=>$featured,
            'best_seller'=>$best_seller,
            'trending_products'=>$trending_products,
            'Category'=>$Category,
            'product_imageLink'=>url('assets/images/thumbnails/')
        ];
        return response($response,201);
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
        //
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
    public function wishlists(){
        $user_id=auth()->user()->id;
        $wishlists=User::find($user_id)->wishlists()->get();
        if(User::find($user_id)->wishlists()->count()>0){
            $product=[];
            foreach($wishlists as $key=>$value){
                $product[]=Product::whereId($value['product_id'])->get();
            }
        
         $response=['results'=>$product,'product_imageLink'=>url('assets/images/thumbnails/')];
         }else{
             $response=['results'=>""];
        }
        return response($response,201);
       
    }
    public function addwishlist($product_id){      
        $user_id=auth()->user()->id;
        $wishlist=Wishlist::insert([
            'user_id'=>$user_id,
            'product_id'=>$product_id
        ]);
       return $this->wishlists();
    }
    public function deleteWishlist($id){
        $user_id=auth()->user()->id;
        $wishlist=Wishlist::where('product_id',$id)->where('user_id',$user_id)->first();
        $wishlist->delete();
        return $this->wishlists();
    }
    public function faqs(){
        $user_id=auth()->user()->id;
        $faqs=Faq::where('language_id',1)->get()->toArray();
        $faqsN=null;
        foreach($faqs as $key=>$value){
            foreach($value as $k=>$v){
                if($k=='details'){
                    $faqsN[$key][$k]=strip_tags($v);
                }else{
                    $faqsN[$key][$k]=$v;
                }
            }
        }
        // dd($faqsN);
        $response=['results'=>$faqsN];
        return response($response,201);
       
    }
    public function notification(){
        $user_id=auth()->user()->id;
        $conversation=Conversation::where('recieved_user',$user_id)->get();
        $response=['results'=>$conversation];
        return response($response,201);
    }
}
