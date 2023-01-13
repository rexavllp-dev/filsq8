<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdPosition;
use App\Models\Advertisment;
use App\Models\Banner;
use App\Models\FooterBanner;
use App\Models\Slider;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdsController extends Controller
{
    #region show ads
    public function datatables()
    {
        $datas = DB::table('advertisments')
            ->leftJoin('ad_positions', 'advertisments.ad_position_id', '=', 'ad_positions.id')
            ->leftJoin('users', 'advertisments.ad_by_id', '=', 'users.id')
            ->where('advertisments.is_deleted', '=', 0)
            ->select('ad_positions.name AS ad_pos_name', 'advertisments.*', 'users.name')
            ->get();

        return Datatables::of($datas)
            ->editColumn('ad_from', function ($data) {
                return date('d-m-Y', strtotime($data->ad_from));
            })
            ->editColumn('ad_to', function ($data) {
                return date('d-m-Y', strtotime($data->ad_to));
            })
            ->editColumn('is_payment_success', function ($data) {
                if ($data->is_payment_success) {
                    return '<span class="">Success ✅</span>';
                } else {
                    return '<span class="">Failed ❌</span>';
                }
            })
            ->editColumn('is_approved', function ($data) {
                if ($data->is_approved) {
                    return '<span class="">Approved ✅</span>';
                } else {
                    return '<span class="">Not Approved ❌</span>';
                }
            })
            ->addColumn('action', function ($data) {
                if ($data->ad_position_id == 1) {
                    return '<div class="action-list">
                                    <a href="' . route('admin-edit-slider-ad', $data->ad_id) . '" class="edit"> <i class="fas fa-edit"></i>' . __('') . '</a>
                                    <a href="' . route('admin-view-slider-ad', $data->ad_id) . '" class="edit"> <i class="fas fa-eye"></i>' . __('') . '</a>
                                    <a href="javascript:;" class="confirmopen" data-href="' . route('admin-approve-slider-ad', [$data->ad_id, $data->id]) . '" data-toggle="modal" data-target="#confirm-approve" > <i class="fas fa-check"></i>' . __('') . '</a>
                            </div>';
                } else if ($data->ad_position_id == 2) {
                    return '<div class="action-list">
                                    <a href="' . route('admin-edit-banner-ad', $data->ad_id) . '" class="edit"> <i class="fas fa-edit"></i>' . __('') . '</a>
                                    <a href="' . route('admin-view-banner-ad', $data->ad_id) . '" class="edit"> <i class="fas fa-eye"></i>' . __('') . '</a>
                                    <a href="javascript:;" class="confirmopen" data-href="' . route('admin-approve-banner-ad', [$data->ad_id, $data->id]) . '" data-toggle="modal" data-target="#confirm-approve" > <i class="fas fa-check"></i>' . __('') . '</a>
                            </div>';
                } else if ($data->ad_position_id == 3) {
                    return '<div class="action-list">
                                    <a href="' . route('admin-edit-footer-ad', $data->ad_id) . '" class="edit"> <i class="fas fa-edit"></i>' . __('') . '</a>
                                    <a href="' . route('admin-view-footer-ad', $data->ad_id) . '" class="edit"> <i class="fas fa-eye"></i>' . __('') . '</a>
                                    <a href="javascript:;" class="confirmopen" data-href="' . route('admin-approve-footer-ad', [$data->ad_id, $data->id]) . '" data-toggle="modal" data-target="#confirm-approve" > <i class="fas fa-check"></i>' . __('') . '</a>
                            </div>';
                }
            })
            ->rawColumns(['is_payment_success', 'action', 'is_approved'])
            ->toJson();
    }

    public function showads()
    {
        return view('admin.ads.showads', ['name' => 'AdsController']);
    }

    #endregion

    #region Ad Positions
    public function positionsdatatables()
    {
        $datas = DB::table('ad_positions')
            ->select('name', 'price', 'id')
            ->get();

        return Datatables::of($datas)
            ->addColumn('action', function ($data) {
                return '<div class="action-list">
                                    <a href="' . route('admin-edit-position-ad', $data->id) . '" class="edit"> <i class="fas fa-edit"></i>' . __('') . '</a>
                            </div>';

            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function positions()
    {
        return view('admin.ads.showpositions', ['name' => 'AdsController']);
    }
    #endregion Ad Positions

    #region View full ad
    public function showSliderAd($id)
    {
        $adData = DB::table('sliders')->whereId($id)->first();
        return view('admin.ads.view.sliderad', ['data' => $adData]);
    }

    public function showBannerAd($id)
    {
        $adData = DB::table('banners')->whereId($id)->first();
        return view('admin.ads.view.bannerad', ['data' => $adData]);
    }

    public function showFooterBannerAd($id)
    {
        $adData = DB::table('footer_banners')->whereId($id)->first();
        return view('admin.ads.view.footerbannerad', ['data' => $adData]);
    }
    #endregion View full ads end

    #region Edit ads views
    public function editSliderAds($id)
    {
        $adData = DB::table('sliders')->whereId($id)->first();
        return view('admin.ads.edit.editslider', ['data' => $adData]);
    }

    public function editBannerAds($id)
    {
        $adData = DB::table('banners')->whereId($id)->first();
        return view('admin.ads.edit.editbanner', ['data' => $adData]);
    }

    public function editFooterBannerAds($id)
    {
        $adData = DB::table('footer_banners')->whereId($id)->first();
        return view('admin.ads.edit.editfooterbanner', ['data' => $adData]);
    }

    #endregion Edit ads view ends

    #region Update ads 
    public function updateSliderAds($id, Request $request)
    {
        $attributeNames = array(
            'title_text' => 'title',
            'details_text' => 'details',
            'position' => 'test position',
            'ad_from' => 'Ads From',
            'ad_to' => 'Ads To',
            'subtitle_text' => 'subtitle',
        );

        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
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

        $data = Slider::findOrFail($id);

        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/sliders', $name);
            if ($data->photo != null) {
                if (file_exists(public_path() . '/assets/images/sliders/' . $data->photo)) {
                    unlink(public_path() . '/assets/images/sliders/' . $data->photo);
                }
            }
            $input['photo'] = $name;
        }
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }

    public function updateBannerAds($id, Request $request)
    {
        //Validation Section
        $attributeNames = array(
            'ad_from' => 'Ads From',
            'ad_to' => 'Ads To',
        );

        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
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

        $data = Banner::findOrFail($id);

        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/banners', $name);
            if ($data->photo != null) {
                if (file_exists(public_path() . '/assets/images/banners/' . $data->photo)) {
                    unlink(public_path() . '/assets/images/banners/' . $data->photo);
                }
            }
            $input['photo'] = $name;
        }
        $data->update($input);

        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }

    public function updateFooterBannerAds($id, Request $request)
    {
        //Validation Section
        $attributeNames = array(
            'ad_from' => 'Ads From',
            'ad_to' => 'Ads To',
        );

        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
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

        $data = FooterBanner::findOrFail($id);

        $input = $request->all();
        if ($file = $request->file('photo')) {
            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/footers', $name);
            if ($data->photo != null) {
                if (file_exists(public_path() . '/assets/images/footers/' . $data->photo)) {
                    unlink(public_path() . '/assets/images/footers/' . $data->photo);
                }
            }
            $input['photo'] = $name;
        }
        $data->update($input);

        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }

    #endregion Update ads  end

    #region Approve ads view
    public function approveSliderAds($sid, $adid, Request $request)
    {
        $data = Slider::findOrFail($sid);
        $data['adid'] = $adid;
        return view('admin.ads.adsapprove.sliderapprove', compact('data'));
    }
    public function approveBannerAds($sid, $adid, Request $request)
    {
        $data = Banner::findOrFail($sid);
        $data['adid'] = $adid;
        return view('admin.ads.adsapprove.bannerapprove', compact('data'));
    }
    public function approveFooterAds($sid, $adid, Request $request)
    {
        $data = FooterBanner::findOrFail($sid);
        $data['adid'] = $adid;
        return view('admin.ads.adsapprove.footerapprove', compact('data'));
    }
    #endregion Approve ads view end

    #region Approve ads 
    public function approveSliderAd($sid, $adid, Request $request)
    {
        $sdata = Slider::findOrFail($sid);
        $adata = Advertisment::findOrFail($adid);

        if ($sdata->is_approved == 1) {
            $msg = __('Already approved.');
            return response()->json($msg);
        } else {
            $sdata->is_approved = 1;
            $adata->is_approved = 1;
        }
        $sdata->update();
        $adata->update();

        return redirect()->route('admin-show-ads');
    }
    public function approveBannerAd($sid, $adid, Request $request)
    {
        $sdata = Banner::findOrFail($sid);
        $adata = Advertisment::findOrFail($adid);

        if ($sdata->is_approved == 1) {
            $msg = __('Already approved.');
            return response()->json($msg);
        } else {
            $sdata->is_approved = 1;
            $adata->is_approved = 1;
        }
        $sdata->update();
        $adata->update();

        return redirect()->route('admin-show-ads');
    }
    public function approveFooterAd($sid, $adid, Request $request)
    {
        $sdata = FooterBanner::findOrFail($sid);
        $adata = Advertisment::findOrFail($adid);

        if ($sdata->is_approved == 1) {
            $msg = __('Already approved.');
            return response()->json($msg);
        } else {
            $sdata->is_approved = 1;
            $adata->is_approved = 1;
        }
        $sdata->update();
        $adata->update();

        return redirect()->route('admin-show-ads');
    }
    #endregion Approve ads end

    #region Edit ads position
    public function editPositions($id)
    {
        $adData = DB::table('ad_positions')->whereId($id)->first();
        return view('admin.ads.edit.editpositions', ['data' => $adData]);
    }
    #endregion Edit ads position

    #region Update ads position
    public function updatePositions($id, Request $request)
    {
        $attributeNames = array(
            'name' => 'name',
            'price' => 'price',
        );

        $rules = [
            'name' =>'required',
            'price' =>'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributeNames);


        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data = AdPosition::findOrFail($id);

        $input = $request->all();
        
        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = __('Data Updated Successfully.');
        return response()->json($msg);
    }
    #endregion Update ads position

}