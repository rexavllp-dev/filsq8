@extends('layouts.front')

@section('content')

@if($ps->slider == 1)

@if(count($sliders))
@include('includes.slider-style')
@endif
@endif

@if($ps->slider == 1)
<!-- Hero Area Start -->
<section class="hero-area">

	<div class="container">

		<div class="row">
			<div class="col-md-3">

			</div>
			<div class="col-md-7">
				@if($ps->slider == 1)

				@if(count($sliders))
				<div class="hero-area-slider" style="margin-top:15px;">

					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							@php $count = 0; @endphp
							@foreach($sliders as $data)

							<li data-target="#carouselExampleIndicators" data-slide-to="{{ $count }}" @if($loop->first) class="active" @endif></li>
							@php $count++; @endphp
							@endforeach

						</ol>
						<div class="carousel-inner" style="border-radius:20px;">

							@foreach($sliders as $data)
							<div class="carousel-item @if($loop->first) active @endif">
								<img class="d-block w-100" src="{{asset('assets/images/sliders/'.$data->photo)}}" alt="First slide">
							</div>
							@endforeach
						</div>

					</div>

				</div>
				@endif

				@endif

				<div style="margin-top:15px;">
					<img src="{{asset('assets/images/banner2.jpg')}}" style="border-radius:20px;">
				</div>
			</div>
			<div class="col-md-2 d-none d-sm-block" style="padding-top:15px;padding-bottom:15px;">

				<div class="row">
					 <div style="background:#fff;min-height:100%;border-radius:20px;padding:10px;width:100%;">
				 		<center><img  src="{{asset('assets/images/profpic.png')}}" alt="First slide" style="width:30%;"><br>

				 		<p class="text-center" style="font-size:12px;margin-bottom:20px;">Welcome to Showpeklowpek</p>

				 		<a href="{{ url('user/login') }}" class="btn btn-danger btn-block"> Join </a>
				 		<a href="{{ url('user/login') }}" class="btn btn-danger btn-block" style="background:#f9f9f9;border-color:#f9f9f9;color:#000;"> Login </a>
				 		</center>
						<img style="margin-top:15px;" src="{{asset('assets/images/right_banner1.jpg')}}" alt="First slide">
				 </div>
				</div>
				
			</div>

		</div>


	</div>

</section>
<!-- Hero Area End -->
@endif


<!-- @if($ps->featured_category == 1)

{{-- Slider buttom Category Start --}}
<section class="slider-buttom-category d-none d-md-block">
	<div class="container-fluid">
		<div class="row">
			@foreach($categories->where('is_featured','=',1) as $cat)
			<div class="col-xl-2 col-lg-3 col-md-4 sc-common-padding">
				<a href="{{ route('front.category',$cat->slug) }}" class="single-category">
					<div class="left">
						<h5 class="title">
							{{ $cat->name }}
						</h5>
						<p class="count">
							{{ count($cat->products) }} {{ $langg->lang4 }}
						</p>
					</div>
					<div class="right">
						<img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="">
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</section>
{{-- Slider buttom banner End --}}

@endif
 -->
@if($ps->featured == 1)
<!-- Trending Item Area Start -->
<section  class="trending">
	<div class="container">

		<div style="padding:20px;background:#fff;border-radius:20px;">
		<div class="row" style="padding:20px;">
			<div class="col-lg-12 remove-padding">
				<div class="section-top">
					<h2 class="section-title">
						{{ $langg->lang26 }}
					</h2>
					{{-- <a href="#" class="link">View All</a> --}}
				</div>
			</div>
		</div>
		<div class="row" style="padding:20px;">
			<div class="col-lg-12 remove-padding">
				<div class="trending-item-slider">
					@foreach($feature_products as $prod)
					@include('includes.product.slider-product')
					@endforeach
				</div>
			</div>

		</div>
		</div>


	</div>
</section>
<!-- Tranding Item Area End -->
@endif

@if($ps->small_banner == 1)

<!-- Banner Area One Start -->
<section class="banner-section">
	<div class="container">


		@foreach($top_small_banners->chunk(2) as $chunk)
		<div class="row">
			@foreach($chunk as $img)
			<div class="col-lg-6 remove-padding">
				<div class="left">
					<a class="banner-effect" href="{{ $img->link }}" target="_blank">
						<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
					</a>
				</div>
			</div>
			@endforeach
		</div>
		@endforeach


	</div>
</section>
<!-- Banner Area One Start -->
@endif

<section id="extraData">
	<div class="text-center">
		<img src="{{asset('assets/images/'.$gs->loader)}}">
	</div>
</section>


@endsection

@section('scripts')
<script>
	$(window).on('load',function() {

		setTimeout(function(){

			$('#extraData').load('{{route('front.extraIndex')}}');

		}, 500);
	});

</script>
@endsection