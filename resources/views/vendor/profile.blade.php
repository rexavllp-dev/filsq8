@extends('layouts.vendor')

@section('styles')
<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />
@endsection

@section('content')

						<div class="content-area">
							<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ __('Edit Profile') }}</h4>
											<ul class="links">
												<li>
													<a href="{{ route('vendor.dashboard') }}">{{ __('Dashboard') }}</a>
												</li>
												<li>
													<a href="{{ route('vendor-profile') }}">{{ __('Edit Profile') }}</a>
												</li>
											</ul>
									</div>
								</div>
							</div>
							<div class="add-product-content1">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">

				                        <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
											<form id="geniusform" class="m-4" action="{{ route('vendor-profile-update') }}" method="POST" enctype="multipart/form-data">
												{{csrf_field()}}

                      						 @include('alerts.vendor.form-both')  

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Shop Name:') }} </h4>
														</div>
													</div>
													<div class="col-lg-7">
														<div class="right-area">
																<h6 class="heading"> {{ $data->shop_name }}
																	@if($data->checkStatus())
																	<a class="badge badge-success verify-link" href="javascript:;">{{ __('Verified') }}</a>
																	@else
																	 <span class="verify-link"><a href="{{ route('vendor-verify') }}">{{ __('Verify Account') }}</a></span>
																	@endif
																</h6>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Owner Name') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="owner_name" placeholder="{{ __('Owner Name') }}" required="" value="{{$data->owner_name}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Shop Number') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_number" placeholder="{{ __('Shop Number') }}" required="" value="{{$data->shop_number}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Shop Address') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="shop_address" placeholder="{{ __('Shop Address') }}" required="" value="{{$data->shop_address}}">
													</div>
												</div>

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Registration Number') }}</h4>
																<p class="sub-heading">{{ __('(Optional)') }}</p>
														</div>
													</div>
													<div class="col-lg-7">
														<input type="text" class="input-field" name="reg_number" placeholder="{{ __('Registration Number') }}" required="" value="{{$data->reg_number}}">
													</div>
												</div>

												

												<div class="row">
													<div class="col-lg-4">
														<div class="left-area">
																<h4 class="heading">{{ __('Shop Details') }} *</h4>
														</div>
													</div>
													<div class="col-lg-7">
														<textarea class="input-field nic-edit" name="shop_details" placeholder="{{ __('Shop Details') }}">{{$data->shop_details}}</textarea>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-12">
														<div class="left-area">
															<h4 class="heading">{{ __("Logo Image") }} *</h4>
														</div>
													</div>
			
													<div class="col-lg-12 mt-3">
														<div class="panel panel-body">
															<div class="span4 cropme text-center" id="landscape"
																style="width: 100%; height: 200px; border: 1px dashed #ddd; background: #f1f1f1;">
																<a href="javascript:;" id="crop-image" class=" mybtn1" style="">
																	<i class="icofont-upload-alt"></i> {{ __('Upload Logo Here') }}
																</a>
															</div>
														</div>
													</div>
													<input type="hidden" id="feature_photo" name="logo" value="{{ $data->logo }}"
													accept="image/*">
												</div>

						                        <div class="row">
						                          <div class="col-lg-4">
						                            <div class="left-area">
						                              
						                            </div>
						                          </div>
						                          <div class="col-lg-7">
						                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
						                          </div>
						                        </div>

											</form>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

@endsection

@section('scripts')

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>

<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">
	(function($) {
		"use strict";

$('.cropme').simpleCropper(800,500);

	})(jQuery);

</script>

<script type="text/javascript">
	$(function($) {
		"use strict";


    let html = `<img src="{{ empty($aff_from->logo) ? asset('assets/images/noimage.png') : (filter_var($aff_from->logo, FILTER_VALIDATE_URL) ? $aff_from->logo : asset('assets/logos/'.$aff_from->logo)) }}" alt="" >`;
	
    $(".span4.cropme").html(html);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  });

  $('.ok').on('click', function () {

    (function($) {
		"use strict";

//  setTimeout(
//     function() {

//   	var img = $('#feature_photo').val();

//       $.ajax({
//         url: "{{route('admin-prod-upload-update',$data->id)}}",
//         type: "POST",
//         data: {"image":img,"_token": "{{ csrf_token() }}"},
//         success: function (data) {
//           if (data.status) {
//             $('#feature_photo').val(data.file_name);
//           }
//           if ((data.errors)) {
//             for(var error in data.errors)
//             {
//               $.notify(data.errors[error], "danger");
//             }
//           }
//         }
//       });

//     }, 1000);

    })(jQuery);

});

</script>

<script type="text/javascript">
	(function($) {
		"use strict";

  $('#imageSource').on('change', function () {
    var file = this.value;
      if (file == "file"){
          $('#f-file').show();
          $('#f-link').hide();
          $('#f-link').find('input').prop('required',false);
      }
      if (file == "link"){
          $('#f-file').hide();
          $('#f-link').show();
          $('#f-link').find('input').prop('required',true);
      }
  });
  
})(jQuery);

</script>

@endsection