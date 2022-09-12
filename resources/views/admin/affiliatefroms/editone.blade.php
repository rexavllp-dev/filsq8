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
				<h4 class="heading"> {{ __("Edit Product") }}<a class="add-btn ml-2" href="{{ url()->previous() }}"><i
							class="fas fa-arrow-left"></i> {{ __("Back") }}</a></h4>
				<ul class="links">
					<li>
						<a href="{{ route('admin.dashboard') }}">{{ ("Dashboard") }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __("Edit") }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="gocover"
		style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
	</div>
	<form id="geniusform" action="{{route('admin-import-affiliate-update',$data->id)}}" method="POST"
		enctype="multipart/form-data">
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
												placeholder="{{ __('Enter Affiliate Name') }}" name="name" required=""
												value="{{ $data->name }}">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __("Logo Image") }} *</h4>
											</div>
										</div>

										<div class="col-lg-12">
											<div class="panel panel-body">
												<div class="span4 cropme text-center" id="landscape"
													style="width: 100%; height: 200px; border: 1px dashed #ddd; background: #f1f1f1;">
													<a href="javascript:;" id="crop-image" class=" mybtn1" style="">
														<i class="icofont-upload-alt"></i> {{ __('Upload Logo Here') }}
													</a>
												</div>
											</div>
										</div>
										<input type="hidden" id="feature_photo" name="photo" value="{{ $data->logo }}"
										accept="image/*">
									</div>

									<div class="row">
										<div class="col-lg-12 text-center">
											<button class="addProductSubmit-btn" type="submit">{{ __("Edit Affiliate")}}</button>
										</div>
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

<script type="text/javascript">
	$(function($) {
		"use strict";

// Gallery Section Update

    $(document).on("click", ".set-gallery" , function(){
        var pid = $(this).find('input[type=hidden]').val();
        $('#pid').val(pid);
        $('.selected-image .row').html('');
            $.ajax({
                    type: "GET",
                    url:"{{ route('admin-gallery-show') }}",
                    data:{id:pid},
                    success:function(data){
                      if(data[0] == 0)
                      {
	                    $('.selected-image .row').addClass('justify-content-center');
	      				$('.selected-image .row').html('<h3>{{ __("No Images Found.") }}</h3>');
     				  }
                      else {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();      
                          var arr = $.map(data[1], function(el) {
                          return el });

                          for(var k in arr)
                          {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
                          }                         
                       }
 
                    }
                  });
      });


  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
	    $.ajax({
	        type: "GET",
	        url:"{{ route('admin-gallery-delete') }}",
	        data:{id:id}
	    });
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
  });
                                        
                                
  $("#uploadgallery").change(function(){
    $("#form-gallery").submit();  
  });

  $(document).on('submit', '#form-gallery' ,function() {
		  $.ajax({
		   url:"{{ route('admin-gallery-store') }}",
		   method:"POST",
		   data:new FormData(this),
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
		   success:function(data)
		   {
		    if(data != 0)
		    {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();   
		        var arr = $.map(data, function(el) {
		        return el });
		        for(var k in arr)
		           {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
		            }          
		    }
		                     
		                       }

		  });
		  return false;

});

 }); 


// Gallery Section Update Ends	

</script>

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


    let html = `<img src="{{ empty($data->logo) ? asset('assets/images/noimage.png') : (filter_var($data->logo, FILTER_VALIDATE_URL) ? $data->logo : asset('assets/logos/'.$data->logo)) }}" alt="" >`;
	
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

@include('partials.admin.product.product-scripts')
@endsection