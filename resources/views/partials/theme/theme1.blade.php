
@extends('layouts.front')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/front/css/category/classic.css') }}">
@endsection
@section('content')

@include('partials.global.subscription-popup')

<header class="ecommerce-header nav-on-banner">
    {{-- Top header currency and Language --}}
    @include('partials.global.top-header')
    {{-- Top header currency and Language  end--}}
    @include('partials.global.responsive-menubar')

</header>
@if($ps->slider == 1)
<section class="hero_area">
@if($ps->slider == 1)

    @if(count($sliders))
    <div class="hero_area_slider_wrapper">
        <div class="hero-area-slider">
        <div class="position-relative">
        <!-- <span class="nextBtn"></span>
        <span class="prevBtn"></span> -->
        <section class="home-slider owl-theme owl-carousel">
            @foreach($sliders as $data)
            <div class="banner-slide-item" style="background: url('{{asset('assets/images/sliders/'.$data->photo)}}') no-repeat center center / cover ;">
                <div class="container">
                    <div class="banner-wrapper-item text-{{ $data->position }}">
                        <div class="banner-content text-dark ">
                            <h5 class="subtitle text-dark slide-h5 subtitle8" style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">{{$data->subtitle_text}}</h5>

                            <h2 class="title text-dark slide-h5 title8" style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h2>

                            <p class="slide-h5c text text8" style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">{{$data->details_text}}</p>
                            <div class="layer col-sm-12">
                            <a href="{{$data->link}}" class="cmn--btn " target="_blank">{{ __('SHOP NOW') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        </div>
        </div>    
    @endif
    <div class="hero-right-area">
            
@if($ps->arrival_section == 1)
        <!--==================== Fashion Banner Section Start ====================-->
        <div class="full-row">
            <div class="container">
                <div class="fashion-banner-wrapper">
                @foreach ($arrivals as $key=>$arrival)

                <div class="col-sm-12 banner">
                   
                        <div class="banner-wrapper hover-img-zoom custom-class-121">
                            <div class="banner-image overflow-hidden transation">
                                <a href="{{ route('front.category') }}"><img class="lazy" data-src="{{ $arrival->photo ?  asset('assets/images/arrival/'.$arrival->photo): "" }}" alt="Banner Image"></a>
                            </div>                            
                        </div>

                    
                   
                </div>



                @endforeach
            </div>
            </div>
        </div>
        <!--==================== Fashion Banner Section End ====================-->
@endif

    </div>
</section>
    @endif
@endif


<div id="extraData">
    <div class="text-center">
        <img  src="{{asset('assets/images/'.$gs->loader)}}">
    </div>
</div>



    @if(isset($visited))
    @if($gs->is_cookie == 1)
        <div class="cookie-bar-wrap show">
            <div class="container d-flex justify-content-center">
                <div class="col-xl-10 col-lg-12">
                    <div class="row justify-content-center">
                        <div class="cookie-bar">
                            <div class="cookie-bar-text">
                                {{ __('The website uses cookies to ensure you get the best experience on our website.') }}
                            </div>
                            <div class="cookie-bar-action">
                                <button class="btn btn-primary btn-accept">
                                {{ __('GOT IT!') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @endif
<!-- Scroll to top -->
<a href="#" class="scroller text-white" id="scroll"><i class="fa fa-angle-up"></i></a>
<!-- End Scroll To top -->

@endsection
@section('script')
	<script>
		let checkTrur = 0;
		$(window).on('scroll', function(){

		if(checkTrur == 0){
			$('#extraData').load('{{route('front.extraIndex')}}');
			checkTrur = 1;
		}
		});
        var owl = $('.home-slider').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        items: 1,
        autoplay: true,
        margin: 0,
        animateIn: 'fadeInDown',
        animateOut: 'fadeOutUp',
        mouseDrag: false,
        
    })
    $('.nextBtn').click(function() {
        owl.trigger('next.owl.carousel', [300]);
    })
    $('.prevBtn').click(function() {
        owl.trigger('prev.owl.carousel', [300]);
    })
	</script>
@endsection
