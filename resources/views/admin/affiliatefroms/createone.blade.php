@extends('layouts.admin')

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
				<h4 class="heading">{{ __("Affiliate Product") }} <a class="add-btn"
						href="{{ route('admin-prod-types') }}"><i class="fas fa-arrow-left"></i> {{ __("Back") }}</a>
				</h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
					</li>
					
					<li>
						<a href="{{ route('admin-import-create-affiliate') }}">{{ __("Add Affiliate Product") }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="gocover"
		style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
	</div>
	<form id="geniusform" action="{{route('admin-import-store-affiliate')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}

		@include('alerts.admin.form-both')
		<div class="row">
			<div class="col-lg-12">
				<div class="add-product-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="product-description">
								<div class="body-area">
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Affiliate Name') }}* </h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field"
												placeholder="{{ __('Enter Affiliate Name') }}" name="name" required="">
										</div>
									</div>

									<div id="f-file">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Logo Image') }} *</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="panel panel-body">
													<div class="span4 cropme text-center" id="landscape"
														style="width: 100%; height: 105px; border: 1px dashed #ddd; background: #f1f1f1;">
														<a href="javascript:;" id="crop-image" class="mybtn1" style="">
															<i class="icofont-upload-alt"></i> {{ __('Upload Logo
															Here') }}
														</a>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" id="feature_photo" name="photo" value="">
									</div>

									

									{{-- <input type="hidden" name="type" value="Physical"> --}}
									<div class="row">
										{{-- <div class="col-lg-4">
											<div class="left-area">

											</div>
										</div> --}}
										<div class="col-lg-12 text-center">
											<button class="addProductSubmit-btn" type="submit">{{ __("Create Affiliate") }}</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			
		</div>
	</form>
</div>

@endsection

@section('scripts')

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script type="text/javascript">
	(function($) {
		"use strict";

// Gallery Section Insert

  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $('#galval'+id).remove();
    $(this).parent().parent().remove();
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
     $('.selected-image .row').html('');
    $('#geniusform').find('.removegal').val(0);
  });

  const showAffiliateBox = () => {
	e.preventDefault();
	alert("helo")
  }

                                        
                                
  $("#uploadgallery").change(function(){
     var total_file=document.getElementById("uploadgallery").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+i+'">'+
                                            '</span>'+
                                            '<a href="'+URL.createObjectURL(event.target.files[i])+'" target="_blank">'+
                                            '<img src="'+URL.createObjectURL(event.target.files[i])+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  '</div> '
                                      );
      $('#geniusform').append('<input type="hidden" name="galval[]" id="galval'+i+'" class="removegal" value="'+i+'">')
     }

  });

// Gallery Section Insert Ends	

})(jQuery);

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

<script type="text/javascript">
	(function($) {
		"use strict";

$('.cropme').simpleCropper(800, 400);

	})(jQuery);
	
	
$(document).on('click','#size-check',function(){
	if($(this).is(':checked')){
		$('#default_stock').addClass('d-none')
	}else{
		$('#default_stock').removeClass('d-none');
	}
})

</script>

@include('partials.admin.product.product-scripts')
@endsection