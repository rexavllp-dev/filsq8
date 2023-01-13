<?php

namespace App\Http\Controllers\Api;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\AffilateFrom;
use App\Models\Attribute;
use App\Models\Currency;
use App\Models\Gallery;
use App\Models\Generalsetting;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;

class ShopController extends Controller
{

    // Get all packages
    public function package()
    {
        $data['subs'] = Subscription::all();
        $data['package'] = auth()->user()->subscribes()->where('status', 1)->latest('id')->first();
        return (['data' => $data]);
    }

    // Register a shop with a subscription
    public function register(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'shop_name' => 'unique:users',
        );
        $messages = array(
            'shop_name' => 'This shop name has already been taken.'
        );


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(["error" => $errors[0]], 500);
        }


        if (\DB::table('pages')->where('slug', $request->shop_name)->exists()) {
            return response(["error" => "This shop name has already been taken"], 500);
        }

        // $success_url = route('user.payment.return');
        $user = auth()->user();
        // create a new affiliate from each time a vendor starts selling and save it in user db
        // only if user not already have an affiliate_from_id

        if ($user->affilate_from_id == null) {
            $aff_from = new AffilateFrom;
            $aff['name'] = $user->shop_name ? $user->shop_name : $request->shop_name;
            $aff['logo'] = 'noimage.png';
            $aff['byAdmin'] = 0;

            $aff_from->fill($aff)->save();

            $user->affilate_from_id = $aff_from->id;
            $user->save();
        }

        $subs = Subscription::findOrFail($request->subs_id);

        $user->is_vendor = 2;
        $user->date = date('Y-m-d', strtotime(Carbon::now()->format('Y-m-d') . ' + ' . $subs->days . ' days'));
        $user->mail_sent = 1;
        $user->update($input);

        $sub = new UserSubscription;
        $data = json_decode(json_encode($subs), true);
        $data['user_id'] = $user->id;
        $data['subscription_id'] = $subs->id;
        $data['method'] = 'Free';
        $data['status'] = 1;
        $data['currency_sign'] = 'KWD';
        $data['currency_code'] = 'KWD';
        $sub->fill($data)->save();

        $data = [
            'to' => $user->email,
            'type' => "vendor_accept",
            'cname' => $user->name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'onumber' => "",
        ];
        $mailer = new GeniusMailer();
        $mailer->sendAutoMail($data);

        return response(["message" => "Vendor subscription successful"], 201);
    }

    // Renew the package or to change the package 
    public function renew(Request $request)
    {
        $user = auth()->user();

        $rules = array(
            'subs_id' => 'required',
        );
        $messages = array(
            'subs_id.required' => 'Please select a subscription.'
        );


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(["error" => $errors], 500);
        }

        $subs = Subscription::findOrFail($request->subs_id);

        // Update renewal date of users subscription
        $renewDate = $user->date;
        $user->date = date('Y-m-d', strtotime($renewDate . ' + ' . $subs->days . ' days'));
        $user->update(['date' => $user->date]);

        // Create a new subscription save the subscription details
        $sub = new UserSubscription;
        $data = json_decode(json_encode($subs), true);
        $data['user_id'] = $user->id;
        $data['subscription_id'] = $subs->id;
        $data['method'] = 'Free';
        $data['status'] = 1;
        $data['currency_sign'] = 'KWD';
        $data['currency_code'] = 'KWD';
        $sub->fill($data)->save();

        $data = [
            'to' => $user->email,
            'type' => "vendor_accept",
            'cname' => $user->name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'onumber' => "",
        ];
        $mailer = new GeniusMailer();
        $mailer->sendAutoMail($data);

        return response(["message" => "Vendor subscription successful updated", 'data' => $user], 201);
    }

    // SKU generator 
    public function generateSku($num)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $num; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $randomString = $randomString . '-pd';
        return $randomString;
    }

    // Add a product 
    public function addProducts(Request $request)
    {
        $user = auth()->user();
        $sign = Currency::where('is_default', '=', 1)->first();
        $package = $user->subscribes()->latest('id')->first();
        $prods = $user->products()->latest('id')->get()->count();
        if (Generalsetting::find(1)->verify_product == 1) {
            if (!$user->checkStatus()) {
                return response()->json(array(['error' => 'You must complete your verfication first.']));
            }
        }
        $lastDate = $user->date;

        // Check if the vendor subscription date exceeds or number of products exceeds
        if ($lastDate < Carbon::now()) {
            dd($prods);
            return response(['error' => 'Your subscription date exceeds']);
        }

        if ($package->allowed_products != 0) {
            if ($prods > $package->allowed_products) {
                return response(['error' => 'You have exceeds the allowed products. Please upgrade your package.']);
            }
        }

        $rules = array(
            'photo' => 'required',
            'file' => 'mimes:zip'
        );

        $messages = array(
            'photo.required' => 'Please select an image for product.'
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(["error" => $errors], 500);
        }

        $data = new Product;
        // $sign = $this->curr;
        $input = $request->all();

        // Check File
        if ($file = $request->file('file')) {
            $extensions = ['zip'];
            if (!in_array($file->getClientOriginalExtension(), $extensions)) {
                return response()->json(array('errors' => ['Image format not supported']));
            }
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/files', $name);
            $input['file'] = $name;
        }

        // Move the image to assets 
        $image = $request->photo;
        // dd($request->photo);
        list($type, $image) = explode(';', $image);
        list(, $image) = explode(',', $image);
        $image = base64_decode($image);
        $image_name = time() . Str::random(8) . '.png';
        $path = 'assets/images/products/' . $image_name;
        file_put_contents($path, $image);
        $input['photo'] = $image_name;

        // Check if physicl product 
        if ($request->type == "Physical") {

            //--- Validation Section
            $rules = ['sku' => 'min:8|unique:products'];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == "") {
                $input['product_condition'] = 0;
            }

            // Check Preorderd
            if ($request->preordered_check == "") {
                $input['preordered'] = 0;
            }

            // Check Minimum Qty
            if ($request->minimum_qty_check == "") {
                $input['minimum_qty'] = null;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == "") {
                $input['ship'] = null;
            }

            // Check Size
            if (empty($request->stock_check)) {
                $input['stock_check'] = 0;
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
                $input['color'] = null;
            } else {
                if (in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price)) {
                    $input['stock_check'] = 0;
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                    $input['color'] = null;
                } else {
                    $input['stock_check'] = 1;
                    $input['color'] = implode(',', $request->color);
                    $input['size'] = implode(',', $request->size);
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $size_prices = $request->size_price;
                    $s_price = array();
                    foreach ($size_prices as $key => $sPrice) {
                        $s_price[$key] = $sPrice / $sign->value;
                    }

                    $input['size_price'] = implode(',', $s_price);
                }
            }

            // Check Color
            if (empty($request->color_check)) {
                $input['color_all'] = null;
            } else {
                $input['color_all'] = implode(',', $request->color_all);
            }
            // Check Size
            if (empty($request->size_check)) {
                $input['size_all'] = null;
            } else {
                $input['size_all'] = implode(',', $request->size_all);
            }

            // Check Whole Sale
            if (empty($request->whole_check)) {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            } else {
                if (in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount)) {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                } else {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            // Check Color
            if (empty($request->color_check)) {
                $input['color'] = null;
            } else {
                $input['color'] = implode(',', $request->color);
            }

            // Check Measurement
            if ($request->mesasure_check == "") {
                $input['measure'] = null;
            }

        }

        // Check weather SEO is checked 
        if (empty($request->seo_check)) {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        } else {
            if (!empty($request->meta_tag)) {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License
        if ($request->type == "License") {
            if (in_array(null, $request->license) || in_array(null, $request->license_qty)) {
                $input['license'] = null;
                $input['license_qty'] = null;
            } else {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            }
        }
        dd($request->features);

        // Check Features
        if (in_array(null, $request->features) || in_array(null, $request->colors)) {
            $input['features'] = null;
            $input['colors'] = null;
        } else {
            $input['features'] = implode(',', str_replace(',', ' ', $request->features));
            $input['colors'] = implode(',', str_replace(',', ' ', $request->colors));
        }

        //tags
        if (!empty($request->tags)) {
            $input['tags'] = implode(',', $request->tags);
        }

        // Convert Price According to Currency
        $input['price'] = ($input['price'] / $sign->value);
        $input['previous_price'] = ($input['previous_price'] / $sign->value);
        $input['user_id'] = $user->id;

        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
            $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
            if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                    $in_name = $catAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($catAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->subcategory_id)) {
            $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
            if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                    $in_name = $subAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($subAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->childcategory_id)) {
            $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
            if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                    $in_name = $childAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($childAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (empty($attrArr)) {
            $input['attributes'] = NULL;
        } else {
            $jsonAttr = json_encode($attrArr);
            $input['attributes'] = $jsonAttr;
        }

        $data->fill($input)->save();

        // Set SLug
        $prod = Product::find($data->id);
        if ($prod->type != 'Physical') {
            $prod->slug = Str::slug($data->name, '-') . '-' . strtolower(Str::random(3) . $data->id . Str::random(3));
        } else {
            $prod->slug = Str::slug($data->name, '-') . '-' . strtolower($data->sku);
        }

        // Set Thumbnail
        $img = Image::make('assets/images/products/' . $prod->photo)->resize(285, 285);
        $thumbnail = time() . Str::random(8) . '.jpg';
        $img->save('assets/images/thumbnails/' . $thumbnail);
        $prod->thumbnail = $thumbnail;
        $prod->affilate_from_id = $user->affilate_from_id;
        $prod->update();

        $lastid = $data->id;
        if ($files = $request->file('gallery')) {
            if (count($files) > 4) {
                $error = array("You can upload only total of five images.");
                return response()->json(array('errors' => $error));
            }
            foreach ($files as $key => $file) {
                $extensions = ['jpeg', 'jpg', 'png', 'svg'];
                if (!in_array($file->getClientOriginalExtension(), $extensions)) {
                    return response()->json(array('errors' => ['Image format not supported']));
                }
                if (in_array($key, $request->galval)) {
                    $gallery = new Gallery;
                    $name = \PriceHelper::ImageCreateName($file);
                    $img = Image::make($file->getRealPath())->resize(800, 800);
                    $thumbnail = time() . Str::random(8) . '.jpg';
                    $img->save('assets/images/galleries/' . $name);
                    $gallery['photo'] = $name;
                    $gallery['product_id'] = $lastid;
                    $gallery->save();
                }
            }
        }

        return response(['message' => 'Product added successfully']);
    }

    // Update a product

    public function updateProducts(Request $request, $id)
    {
        $user = auth()->user();
        $data = Product::findOrFail($id);
        $sign = Currency::where('is_default', '=', 1)->first();
        // $package = $user->subscribes()->latest('id')->first();
        // $prods = $user->products()->latest('id')->get()->count();
        // if (Generalsetting::find(1)->verify_product == 1) {
        //     if (!$user->checkStatus()) {
        //         return response()->json(array(['error' => 'You must complete your verfication first.']));
        //     }
        // }
        // $lastDate = $user->date;

        // // Check if the vendor subscription date exceeds or number of products exceeds
        // if ($lastDate < Carbon::now()) {
        //     dd($prods);
        //     return response(['error' => 'Your subscription date exceeds']);
        // }

        // if ($package->allowed_products != 0) {
        //     if ($prods > $package->allowed_products) {
        //         return response(['error' => 'You have exceeds the allowed products. Please upgrade your package.']);
        //     }
        // }

        $rules = array(
            'file' => 'mimes:zip',
        );

        $messages = array(
            
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(["error" => $errors], 500);
        }

        $data = new Product;
        $input = $request->all();

        // Check File
        // if ($file = $request->file('file')) {
        //     $extensions = ['zip'];
        //     if (!in_array($file->getClientOriginalExtension(), $extensions)) {
        //         return response()->json(array('errors' => ['Image format not supported']));
        //     }
        //     $name = \PriceHelper::ImageCreateName($file);
        //     $file->move('assets/files', $name);
        //     $input['file'] = $name;
        // }

        // // Move the image to assets 
        // $image = $request->photo;
        // // dd($request->photo);
        // list($type, $image) = explode(';', $image);
        // list(, $image) = explode(',', $image);
        // $image = base64_decode($image);
        // $image_name = time() . Str::random(8) . '.png';
        // $path = 'assets/images/products/' . $image_name;
        // file_put_contents($path, $image);
        // $input['photo'] = $image_name;

        if ($request->type_check == 1) {
            $input['link'] = null;
        } else {
            if ($data->file != null) {
                if (file_exists(public_path() . '/assets/files/' . $data->file)) {
                    unlink(public_path() . '/assets/files/' . $data->file);
                }
            }
            $input['file'] = null;
        }

        // Check if physicl product 
        if ($request->type == "Physical") {

            //--- Validation Section
            $rules = ['sku' => 'min:8|unique:products'];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == "") {
                $input['product_condition'] = 0;
            }

            // Check Preorderd
            if ($request->preordered_check == "") {
                $input['preordered'] = 0;
            }

            // Check Minimum Qty
            if ($request->minimum_qty_check == "") {
                $input['minimum_qty'] = null;
            }

            // Check Shipping Time
            if ($request->shipping_time_check == "") {
                $input['ship'] = null;
            }

            // Check Size
            if (empty($request->stock_check)) {
                $input['stock_check'] = 0;
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
                $input['color'] = null;
            } else {
                if (in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price)) {
                    $input['stock_check'] = 0;
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                    $input['color'] = null;
                } else {
                    $input['stock_check'] = 1;
                    $input['color'] = implode(',', $request->color);
                    $input['size'] = implode(',', $request->size);
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $size_prices = $request->size_price;
                    $s_price = array();
                    foreach ($size_prices as $key => $sPrice) {
                        $s_price[$key] = $sPrice / $sign->value;
                    }

                    $input['size_price'] = implode(',', $s_price);
                }
            }

            // Check Color
            if (empty($request->color_check)) {
                $input['color_all'] = null;
            } else {
                $input['color_all'] = implode(',', $request->color_all);
            }
            // Check Size
            if (empty($request->size_check)) {
                $input['size_all'] = null;
            } else {
                $input['size_all'] = implode(',', $request->size_all);
            }

            // Check Whole Sale
            if (empty($request->whole_check)) {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            } else {
                if (in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount)) {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                } else {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            // Check Color
            if (empty($request->color_check)) {
                $input['color'] = null;
            } else {
                $input['color'] = implode(',', $request->color);
            }

            // Check Measurement
            if ($request->mesasure_check == "") {
                $input['measure'] = null;
            }

        }

        // Check weather SEO is checked 
        if (empty($request->seo_check)) {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        } else {
            if (!empty($request->meta_tag)) {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License
        if ($request->type == "License") {
            if (in_array(null, $request->license) || in_array(null, $request->license_qty)) {
                $input['license'] = null;
                $input['license_qty'] = null;
            } else {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            }
        }

        // Check Features
        // if (in_array(null, $request->features) || in_array(null, $request->colors)) {
        //     $input['features'] = null;
        //     $input['colors'] = null;
        // } else {
        //     $input['features'] = implode(',', str_replace(',', ' ', $request->features));
        //     $input['colors'] = implode(',', str_replace(',', ' ', $request->colors));
        // }
        if (!in_array(null, $request->features) && !in_array(null, $request->colors)) {
            $input['features'] = implode(',', str_replace(',', ' ', $request->features));
            $input['colors'] = implode(',', str_replace(',', ' ', $request->colors));
        } else {
            if (in_array(null, $request->features) || in_array(null, $request->colors)) {
                $input['features'] = null;
                $input['colors'] = null;
            } else {
                $features = explode(',', $data->features);
                $colors = explode(',', $data->colors);
                $input['features'] = implode(',', $features);
                $input['colors'] = implode(',', $colors);
            }
        }

        //tags
        if (!empty($request->tags)) {
            $input['tags'] = implode(',', $request->tags);
        }

        // Convert Price According to Currency
        $input['price'] = ($input['price'] / $sign->value);
        $input['previous_price'] = ($input['previous_price'] / $sign->value);

        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
            $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
            if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                    $in_name = $catAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($catAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->subcategory_id)) {
            $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
            if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                    $in_name = $subAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($subAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->childcategory_id)) {
            $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
            if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                    $in_name = $childAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($childAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (empty($attrArr)) {
            $input['attributes'] = NULL;
        } else {
            $jsonAttr = json_encode($attrArr);
            $input['attributes'] = $jsonAttr;
        }

        $data->slug = Str::slug($data->name, '-') . '-' . strtolower($data->sku);

        $data->update($input);

        // $data->fill($input)->save();

        // Set SLug
        // $prod = Product::find($data->id);
        // if ($prod->type != 'Physical') {
        //     $prod->slug = Str::slug($data->name, '-') . '-' . strtolower(Str::random(3) . $data->id . Str::random(3));
        // } else {
        //     $prod->slug = Str::slug($data->name, '-') . '-' . strtolower($data->sku);
        // }

        // Set Thumbnail
        // $img = Image::make('assets/images/products/' . $prod->photo)->resize(285, 285);
        // $thumbnail = time() . Str::random(8) . '.jpg';
        // $img->save('assets/images/thumbnails/' . $thumbnail);
        // $prod->thumbnail = $thumbnail;
        // $prod->affilate_from_id = $user->affilate_from_id;
        // $prod->update();

        // $lastid = $data->id;
        // if ($files = $request->file('gallery')) {
        //     if (count($files) > 4) {
        //         $error = array("You can upload only total of five images.");
        //         return response()->json(array('errors' => $error));
        //     }
        //     foreach ($files as $key => $file) {
        //         $extensions = ['jpeg', 'jpg', 'png', 'svg'];
        //         if (!in_array($file->getClientOriginalExtension(), $extensions)) {
        //             return response()->json(array('errors' => ['Image format not supported']));
        //         }
        //         if (in_array($key, $request->galval)) {
        //             $gallery = new Gallery;
        //             $name = \PriceHelper::ImageCreateName($file);
        //             $img = Image::make($file->getRealPath())->resize(800, 800);
        //             $thumbnail = time() . Str::random(8) . '.jpg';
        //             $img->save('assets/images/galleries/' . $name);
        //             $gallery['photo'] = $name;
        //             $gallery['product_id'] = $lastid;
        //             $gallery->save();
        //         }
        //     }
        // }

        return response(['message' => 'Product updated successfully']);
    }

    // Test
    public function updates(Request $request, $id)
    {

        //--- Validation Section
        $rules = [
            'file' => 'mimes:zip'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //-- Logic Section
        $data = Product::findOrFail($id);
        $sign = $this->curr;
        $input = $request->all();

        //Check Types
        if ($request->type_check == 1) {
            $input['link'] = null;
        } else {
            if ($data->file != null) {
                if (file_exists(public_path() . '/assets/files/' . $data->file)) {
                    unlink(public_path() . '/assets/files/' . $data->file);
                }
            }
            $input['file'] = null;
        }


        // Check Physical
        if ($data->type == "Physical") {

            //--- Validation Section
            $rules = ['sku' => 'min:8|unique:products,sku,' . $id];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            // Check Condition
            if ($request->product_condition_check == "") {
                $input['product_condition'] = 0;
            }

            // Check Preorderd
            if ($request->preordered_check == "") {
                $input['preordered'] = 0;
            }

            // Check Minimum Qty
            if ($request->minimum_qty_check == "") {
                $input['minimum_qty'] = null;
            }


            // Check Shipping Time
            if ($request->shipping_time_check == "") {
                $input['ship'] = null;
            }

            // Check Size
            if (empty($request->stock_check)) {
                $input['stock_check'] = 0;
                $input['size'] = null;
                $input['size_qty'] = null;
                $input['size_price'] = null;
                $input['color'] = null;
            } else {
                if (in_array(null, $request->size) || in_array(null, $request->size_qty) || in_array(null, $request->size_price)) {
                    $input['stock_check'] = 0;
                    $input['size'] = null;
                    $input['size_qty'] = null;
                    $input['size_price'] = null;
                    $input['color'] = null;
                } else {
                    $input['stock_check'] = 1;
                    $input['color'] = implode(',', $request->color);
                    $input['size'] = implode(',', $request->size);
                    $input['size_qty'] = implode(',', $request->size_qty);
                    $size_prices = $request->size_price;
                    $s_price = array();
                    foreach ($size_prices as $key => $sPrice) {
                        $s_price[$key] = $sPrice / $sign->value;
                    }

                    $input['size_price'] = implode(',', $s_price);
                }
            }

            // Check Color
            if (empty($request->color_check)) {
                $input['color_all'] = null;
            } else {
                $input['color_all'] = implode(',', $request->color_all);
            }
            // Check Size
            if (empty($request->size_check)) {
                $input['size_all'] = null;
            } else {
                $input['size_all'] = implode(',', $request->size_all);
            }


            // Check Whole Sale
            if (empty($request->whole_check)) {
                $input['whole_sell_qty'] = null;
                $input['whole_sell_discount'] = null;
            } else {
                if (in_array(null, $request->whole_sell_qty) || in_array(null, $request->whole_sell_discount)) {
                    $input['whole_sell_qty'] = null;
                    $input['whole_sell_discount'] = null;
                } else {
                    $input['whole_sell_qty'] = implode(',', $request->whole_sell_qty);
                    $input['whole_sell_discount'] = implode(',', $request->whole_sell_discount);
                }
            }

            // Check Color
            if (empty($request->color_check)) {
                $input['color'] = null;
            } else {
                if (!empty($request->color)) {
                    $input['color'] = implode(',', $request->color);
                }
                if (empty($request->color)) {
                    $input['color'] = null;
                }
            }

            // Check Measure
            if ($request->measure_check == "") {
                $input['measure'] = null;
            }
        }


        // Check Seo
        if (empty($request->seo_check)) {
            $input['meta_tag'] = null;
            $input['meta_description'] = null;
        } else {
            if (!empty($request->meta_tag)) {
                $input['meta_tag'] = implode(',', $request->meta_tag);
            }
        }

        // Check License
        if ($data->type == "License") {

            if (!in_array(null, $request->license) && !in_array(null, $request->license_qty)) {
                $input['license'] = implode(',,', $request->license);
                $input['license_qty'] = implode(',', $request->license_qty);
            } else {
                if (in_array(null, $request->license) || in_array(null, $request->license_qty)) {
                    $input['license'] = null;
                    $input['license_qty'] = null;
                } else {
                    $license = explode(',,', $prod->license);
                    $license_qty = explode(',', $prod->license_qty);
                    $input['license'] = implode(',,', $license);
                    $input['license_qty'] = implode(',', $license_qty);
                }
            }

        }
        // Check Features
        if (!in_array(null, $request->features) && !in_array(null, $request->colors)) {
            $input['features'] = implode(',', str_replace(',', ' ', $request->features));
            $input['colors'] = implode(',', str_replace(',', ' ', $request->colors));
        } else {
            if (in_array(null, $request->features) || in_array(null, $request->colors)) {
                $input['features'] = null;
                $input['colors'] = null;
            } else {
                $features = explode(',', $data->features);
                $colors = explode(',', $data->colors);
                $input['features'] = implode(',', $features);
                $input['colors'] = implode(',', $colors);
            }
        }

        //Product Tags
        if (!empty($request->tags)) {
            $input['tags'] = implode(',', $request->tags);
        }
        if (empty($request->tags)) {
            $input['tags'] = null;
        }

        $input['price'] = $input['price'] / $sign->value;
        $input['previous_price'] = $input['previous_price'] / $sign->value;

        // store filtering attributes for physical product
        $attrArr = [];
        if (!empty($request->category_id)) {
            $catAttrs = Attribute::where('attributable_id', $request->category_id)->where('attributable_type', 'App\Models\Category')->get();
            if (!empty($catAttrs)) {
                foreach ($catAttrs as $key => $catAttr) {
                    $in_name = $catAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($catAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->subcategory_id)) {
            $subAttrs = Attribute::where('attributable_id', $request->subcategory_id)->where('attributable_type', 'App\Models\Subcategory')->get();
            if (!empty($subAttrs)) {
                foreach ($subAttrs as $key => $subAttr) {
                    $in_name = $subAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($subAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }

        if (!empty($request->childcategory_id)) {
            $childAttrs = Attribute::where('attributable_id', $request->childcategory_id)->where('attributable_type', 'App\Models\Childcategory')->get();
            if (!empty($childAttrs)) {
                foreach ($childAttrs as $key => $childAttr) {
                    $in_name = $childAttr->input_name;
                    if ($request->has("$in_name")) {
                        $attrArr["$in_name"]["values"] = $request["$in_name"];
                        $attrArr["$in_name"]["prices"] = $request["$in_name" . "_price"];
                        if ($childAttr->details_status) {
                            $attrArr["$in_name"]["details_status"] = 1;
                        } else {
                            $attrArr["$in_name"]["details_status"] = 0;
                        }
                    }
                }
            }
        }



        if (empty($attrArr)) {
            $input['attributes'] = NULL;
        } else {
            $jsonAttr = json_encode($attrArr);
            $input['attributes'] = $jsonAttr;
        }


        $data->slug = Str::slug($data->name, '-') . '-' . strtolower($data->sku);

        $data->update($input);
        //-- Logic Section Ends

        //--- Redirect Section
        $msg = __('Product Updated Successfully.') . '<a href="' . route('vendor-prod-index') . '">' . __('View Product Lists.') . '</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }
}