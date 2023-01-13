@extends('layouts.vendor')

@section('styles')

@endsection

@section('content')

<div class="content-area">
    {{-- breadcrumb --}}
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Advertisment') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('vendor.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Settings') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor-ads-showlayout') }}">{{ __('Advertisment') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Layout --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-plus-circle"></i>
                        {{ __('Create Advertisment') }}
                    </h5>
                </div>
                <div class="card-body replicasite">
                    <div class="selectposition mt-2 py-2 ">
                        <h5 class="text-upper">Select the position to give advertisments</h5>
                    </div>
                    <div class="site-replica">
                        <div class="row">
                            <div class="col-12 slider-replica mb-2 adrelative"
                                style="background-image: url({{url('/assets/images/sliderimg.jpg')}});">
                                <h5>Slider Header text</h5>
                                <h3>Slider Hero text</h3>
                                <h6>Slider description</h6>
                                <div class="btn btn-primary">Shop now</div>
                                <i class="fas fa-ad ad"></i>
                                <div class="overlay">
                                    <div class="text">
                                        <a class="btn btn-success" style="cursor: pointer;"
                                            href="{{route('vendor-slider-ad', ['slot_id'=>$slider_slot[0]['slot_id']])}}">Place
                                            Ad</a>
                                        <h5 class="text-white mt-1">Next slot - {{date('d-m-Y',
                                            strtotime($slider_slot[0]['available_date']))}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row middlebanner mt-2">
                            @foreach ($banner_slot as $banner)
                            <div class="col-md-3 text-center border py-1 card-bg adrelative">
                                <i class="fas fa-ad ad"></i>
                                <div class="overlay">
                                    <div class="text">
                                        <a class="btn btn-success" style="cursor: pointer;"
                                            href="{{route('vendor-banner-ad', ['slot_id' => $banner['slot_id'] , 'pos_id' => $loop->index])}}">Place
                                            Ad</a>
                                        <h5 class="text-white mt-1">Next slot - {{date('d-m-Y',
                                            strtotime($banner['available_date']))}}</h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-2">
                            <h5>FEATURED PRODUCTS</h5>
                            <h2 style="font-size: 1.9rem">Our Featured Products</h2>
                            <div class="row featuredreplica">
                                <div class="col-md-4 product-card">
                                    <div class="card">
                                        <img
                                            src="https://w3collective.com/wp-content/uploads/2021/03/static-skeleton-screen.png" />
                                        {{-- <h1>Product 1</h1>
                                        <p>KD 95</p> --}}
                                    </div>
                                </div>
                                <div class="col-md-4 product-card">
                                    <div class="card">
                                        <img
                                            src="https://w3collective.com/wp-content/uploads/2021/03/static-skeleton-screen.png" />
                                        {{-- <h1>Product 2</h1>
                                        <p>KD 95</p> --}}
                                    </div>
                                </div>
                                <div class="col-md-4 product-card">
                                    <div class="card">
                                        <img
                                            src="https://w3collective.com/wp-content/uploads/2021/03/static-skeleton-screen.png" />
                                        {{-- <h1>Product 3</h1>
                                        <p>KD 95</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dealoftheday container">
                            <h2>Deal of the day</h2>
                            <div class="lines"></div>
                            <div class="deal">
                                <div class="row container">
                                    {{-- <div class="col-md-6 leftside">
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                                        <div class="off">50%</div>
                                        <div class="cntr">
                                            <div class="box">01</div>
                                            <div class="box">04</div>
                                            <div class="box">02</div>
                                            <div class="box">40</div>
                                        </div>
                                        <div class="btn btn-primary">
                                            Shop now
                                        </div>
                                    </div>
                                    <div class="col-md-6 rightside">
                                        <img src="https://picsum.photos/200/200.jpg" />
                                    </div> --}}
                                    <div class="load load2"></div>
                                    <div class="load "></div>
                                    <div class="load load1"></div>
                                    <div class="load load1"></div>
                                    <div class="load"></div>
                                </div>
                            </div>
                        </div>
                        <div class="othersection">
                            <div class="row featuredreplica">
                                <div class="col-md-4 product-card">
                                    <div class="card">
                                        <img
                                            src="https://w3collective.com/wp-content/uploads/2021/03/static-skeleton-screen.png" />
                                        {{-- <h1>Product 1</h1>
                                        <p>KD 95</p> --}}
                                    </div>
                                </div>
                                <div class="col-md-4 product-card">
                                    <div class="card">
                                        <img
                                            src="https://w3collective.com/wp-content/uploads/2021/03/static-skeleton-screen.png" />
                                        {{-- <h1>Product 2</h1>
                                        <p>KD 95</p> --}}
                                    </div>
                                </div>
                                <div class="col-md-4 product-card">
                                    <div class="card">
                                        <img
                                            src="https://w3collective.com/wp-content/uploads/2021/03/static-skeleton-screen.png" />
                                        {{-- <h1>Product 3</h1>
                                        <p>KD 95</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footerreplica">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="lazy footerlogo" src="{{ asset('assets/images/'.$gs->footer_logo) }}"
                                        alt="Image not found!" />
                                </div>
                                <div class="col-md-3 linksftr">
                                    <ul>
                                        <li>Link 1</li>
                                        <li>Link 2</li>
                                        <li>Link 3</li>
                                        <li>Link 4</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 adrelative">
                                    <img src="https://picsum.photos/600/150.webp" />
                                    <i class="fas fa-ad ad"></i>
                                    <div class="overlay">
                                        <div class="text">
                                            <a class="btn btn-success" style="cursor: pointer;"
                                                href="{{route('vendor-footer-ad' , ['slot_id'=>$footer_slot[0]['slot_id']])}}">Place
                                                Ad</a>
                                            <h5 class="text-white mt-1">Next slot - {{date('d-m-Y',
                                                strtotime($footer_slot[0]['available_date']))}}</h5>
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
</div>

@endsection

@section('scripts')


{{-- DATA TABLE --}}

<script type="text/javascript">
    (function($) {
		"use strict";

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('vendor-service-datatables') }}',
               columns: [
                        { data: 'photo', name: 'photo' , searchable: false, orderable: false},
                        { data: 'title', name: 'title' },
                        { data: 'details', name: 'details' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

      	$(function() {
        $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        	'<a class="add-btn" data-href="{{route('vendor-service-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
          		'<i class="fas fa-plus"></i> <span class="remove-mobile">{{ __("Add New") }}<span>'+
          	'</a>'+
          '</div>');
      });

})(jQuery);

</script>

{{-- DATA TABLE ENDS--}}

@endsection