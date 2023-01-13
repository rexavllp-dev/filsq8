<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\AdPosition;
use App\Models\AdSlot;
use App\Models\Advertisment;
use App\Models\Banner;
use App\Models\FooterBanner;
use App\Models\Slider;
use DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{
    #region Ads position
    // Show ads position to the vendors 
    public function showPositions()
    {
        $slider_slot = [];
        $banner_slot = [];
        $footer_slot = [];
        // Get all ad position 
        $positions = AdPosition::all();
        foreach ($positions as $key => $position) {
            if ($position->id == 1) {
                $slot = AdSlot::where(['position_id' => $position->id])->orderBy('available_date', 'ASC')->first();
                $slider_slot[$key]['slot_id'] = $slot->id;
                $slider_slot[$key]['position_id'] = $position->id;
                $slider_slot[$key]['available_date'] = $slot->available_date;
            } else {
                $slot = AdSlot::where(['position_id' => $position->id])->get();
                if ($position->id == 2) {
                    foreach ($slot as $key => $slot) {
                        $banner_slot[$key]['slot_id'] = $slot->id;
                        $banner_slot[$key]['position_id'] = $position->id;
                        $banner_slot[$key]['available_date'] = $slot->available_date;
                    }
                } else {
                    foreach ($slot as $key => $slot) {
                        $footer_slot[$key]['slot_id'] = $slot->id;
                        $footer_slot[$key]['position_id'] = $position->id;
                        $footer_slot[$key]['available_date'] = $slot->available_date;
                    }
                }
            }
        }
        return view('vendor.ads.showlayout', ['slider_slot' => $slider_slot, 'banner_slot' => $banner_slot, 'footer_slot' => $footer_slot]);
    }
    #endregion

    #region Create views of ads
    // Create view of slider ad  
    public function createSliderAd($slot_id)
    {
        $slot = $this->getSlotDetails($slot_id);
        return view('vendor.ads.sliderad', ['slot' => $slot[0]]);
    }

    // Create view of banner ad 
    public function createBannerAd($slot_id , $pos_id)
    {
        $slot = $this->getSlotDetails($slot_id);
        return view('vendor.ads.bannerad', ['slot' => $slot[0] , 'pos' => $pos_id]);
    }

    // Create view of footer ad 
    public function createFooterAd($slot_id)
    {
        $slot = $this->getSlotDetails($slot_id);
        return view('vendor.ads.footerad', ['slot' => $slot[0]]);
    }
    #endregion 
    
    #region Store ads
    // Store slider ad data
    public function storeSliderAd(Request $request, $id)
    {
        // dd($request);
        //--- Validation Section

        $attributeNames = array(
            'title_text' => 'title',
            'details_text' => 'details',
            'position' => 'test position',
            'ad_from' => 'Ads From',
            'ad_to' => 'Ads To',
            'subtitle_text' => 'subtitle',
        );

        $rules = [
            'photo' => 'required|mimes:jpeg,jpg,png,svg',
            'subtitle_text' => 'required',
            'title_text' => 'required',
            'details_text' => 'required',
            'link' => 'required',
            'position' => 'required',
            'ad_from' => 'required',
            'ad_to' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Slider();
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/sliders', $name);
            $input['photo'] = $name;
        }
        $input['is_ad'] = "1";
        $input['ad_from'] = $this->getConvertedDate($input['ad_from']);
        $input['ad_to'] = $this->getConvertedDate($input['ad_to']);
        $data->fill($input)->save();

        // After saving we need to update the slot date 
        $slot = AdSlot::whereId($id)->first();
        $slot->available_date = $this->addOneDay($input['ad_to']);
        $slot->update();

        $slider = Slider::whereId($data->id)->first();
        $ad_type = $slot->position_id;
        $ad_id = $slider->id;

        // Get the ad price to calculate the ad price
        $ad_position = AdPosition::whereId($ad_type)->first();
        $ad_price = $ad_position->price;
        $dateDiff = $this->calculateDateDiff($input['ad_from'], $input['ad_to']);
        $ad_price = $this->calculateAdPrice($dateDiff , $ad_price);
        $vendorId = Auth::user()->id; //Authenticated user id

        $advertisment = new Advertisment();
        $advertisment->ad_position_id = $ad_type;
        $advertisment->ad_by_id = $vendorId;
        $advertisment->ad_id = $ad_id;
        $advertisment->ad_rate = $ad_price;
        $advertisment->ad_from = $this->getConvertedDate($input['ad_from']);
        $advertisment->ad_to = $this->getConvertedDate($input['ad_to']);

        // Payment Gateway intergration 
        $isPaymentSuccesful = true;

        if ($isPaymentSuccesful) {
            $slider->is_payment_success = 1;
            $slider->update();
            $advertisment->is_payment_success = 1;
        }

        $advertisment->save();

        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New advertisment created successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    // Store banner ad data
    public function storeBannerAd(Request $request, $id , $pos)
    {

        //Validation Section
        $attributeNames = array(
            'ad_from' => 'Ads From',
            'ad_to' => 'Ads To',
        );

        $rules = [
            'photo' => 'required|mimes:jpeg,jpg,png,svg',
            'link' => 'required',
            'ad_from' => 'required',
            'ad_to' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Banner();
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/banners', $name);
            $input['photo'] = $name;
        }
        $input['is_ad'] = "1";
        $input['ad_from'] = $this->getConvertedDate($input['ad_from']);
        $input['ad_to'] = $this->getConvertedDate($input['ad_to']);
        $input['slot'] = $pos;
        // dd($input);
        $data->fill($input)->save();

        // After saving we need to update the slot date 
        $slot = AdSlot::whereId($id)->first();
        $slot->available_date = $this->addOneDay($input['ad_to']);
        $slot->update();

        $banner = Banner::whereId($data->id)->first();
        $ad_type = $slot->position_id;
        $ad_id = $banner->id;

        // Get the ad price to calculate the ad price
        $ad_position = AdPosition::whereId($ad_type)->first();
        $ad_price = $ad_position->price;
        $dateDiff = $this->calculateDateDiff($input['ad_from'], $input['ad_to']);
        $ad_price = $this->calculateAdPrice($dateDiff , $ad_price);
        $vendorId = Auth::user()->id; //Authenticated user id

        $advertisment = new Advertisment();
        $advertisment->ad_position_id = $ad_type;
        $advertisment->ad_by_id = $vendorId;
        $advertisment->ad_id = $ad_id;
        $advertisment->ad_rate = $ad_price;
        $advertisment->ad_from = $this->getConvertedDate($input['ad_from']);
        $advertisment->ad_to = $this->getConvertedDate($input['ad_to']);

        // Payment Gateway intergration 
        $isPaymentSuccesful = true;

        if ($isPaymentSuccesful) {
            $banner->is_payment_success = 1;
            $banner->update();
            $advertisment->is_payment_success = 1;
        }

        $advertisment->save();

        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New advertisment added successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }


    // Store footer ad data
    public function storeFooterAd(Request $request, $id)
    {

        //Validation Section
        $attributeNames = array(
            'ad_from' => 'Ads From',
            'ad_to' => 'Ads To',
        );

        $rules = [
            'photo' => 'required|mimes:jpeg,jpg,png,svg',
            'link' => 'required',
            'ad_from' => 'required',
            'ad_to' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new FooterBanner();
        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/footers', $name);
            $input['photo'] = $name;
        }
        $input['is_ad'] = "1";
        $input['ad_from'] = $this->getConvertedDate($input['ad_from']);
        $input['ad_to'] = $this->getConvertedDate($input['ad_to']);
        $data->fill($input)->save();


        // After saving we need to update the slot date 
        $slot = AdSlot::whereId($id)->first();
        $slot->available_date = $this->addOneDay($input['ad_to']);
        $slot->update();

        $footerBanner = FooterBanner::whereId($data->id)->first();
        $ad_type = $slot->position_id;
        $ad_id = $footerBanner->id;

        // Get the ad price to calculate the ad price
        $ad_position = AdPosition::whereId($ad_type)->first();
        $ad_price = $ad_position->price;
        $dateDiff = $this->calculateDateDiff($input['ad_from'], $input['ad_to']);
        $ad_price = $this->calculateAdPrice($dateDiff , $ad_price);
        $vendorId = Auth::user()->id; //Authenticated user id

        $advertisment = new Advertisment();
        $advertisment->ad_position_id = $ad_type;
        $advertisment->ad_by_id = $vendorId;
        $advertisment->ad_id = $ad_id;
        $advertisment->ad_rate = $ad_price;
        $advertisment->ad_from = $this->getConvertedDate($input['ad_from']);
        $advertisment->ad_to = $this->getConvertedDate($input['ad_to']);

        // Payment Gateway intergration 
        $isPaymentSuccesful = true;

        if ($isPaymentSuccesful) {
            $footerBanner->is_payment_success = 1;
            $footerBanner->update();
            $advertisment->is_payment_success = 1;
        }

        $advertisment->save();

        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('New advertisment added successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends
    }
    #endregion

    #region Helper functions
    // Get converted date 
    public function getConvertedDate($date)
    {
        $date = date('Y-m-d', strtotime($date));
        return $date;
    }

    // Add one day to date 
    public function addOneDay($date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);
        $date = $date->addDays(1);
        $date = date('Y-m-d', strtotime($date));
        return $date;
    }

    // get slot details
    public function getSlotDetails($slot_id)
    {
        $slot = AdSlot::where(['id' => $slot_id])->get();
        $date_1 = Carbon::createFromFormat('Y-m-d H:i:s', $slot[0]['available_date']);
        $today = Carbon::today();

        $result = $date_1->gt($today);
        if (!$result) {
            $slot[0]['available_date'] = $this->getConvertedDate($today->format('d-m-Y'));
        } else {
            $slot[0]['available_date'] = $this->getConvertedDate($date_1);
        }

        return $slot;
    }

    // Calculate difference between two dates (returning difference + 1)
    public function calculateDateDiff($date_1, $date2)
    {
        $earlier = new DateTime($date_1);
        $later = new DateTime($date2);

        $abs_diff = $later->diff($earlier)->format("%a");

        return $abs_diff + 1;
    }

    // Calculate the price for ad using no:of days and ad position price
    public function calculateAdPrice($no_of_days, $ad_position_price)
    {
        $price = 0;
        $price = $no_of_days * $ad_position_price;
        return $price;
    }
    #endregion
}