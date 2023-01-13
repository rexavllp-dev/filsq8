@extends('layouts.admin')

@section('content')

<div class="content-area">
  <div class="mr-breadcrumb">
    <div class="row">
      <div class="col-lg-12">
        <h4 class="heading">{{ __('View Footer Ad') }} <a class="add-btn" href="{{route('admin-show-ads')}}"><i
              class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
        <ul class="links">
          <li>
            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
          </li>
          <li>
            <a href="#">{{ __('View') }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="add-product-content1 add-product-content2">
    <div class="row">
      <div class="col-lg-12">
        <div class="product-description">
          <div class="body-area">
            <div class="gocover"
              style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
            </div>
            <form id="geniusform" action="{{route('admin-sl-update',$data->id)}}" method="POST"
              enctype="multipart/form-data">
              {{csrf_field()}}
              @include('alerts.admin.form-both')

              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="img-upload full-width-img">
                    <div id="image-preview" class="img-preview"
                      style="background: url({{ $data->photo ? asset('assets/images/footers/'.$data->photo):asset('assets/images/noimage.png')}});background-size:contain;">
                      <input type="file" name="photo" class="img-upload" id="image-upload">
                    </div>
                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">
                    <h4 class="heading">{{ __('Link') }} *</h4>
                  </div>
                </div>
                <div class="col-lg-7">
                  <input type="text" class="input-field" disabled name="link" placeholder="Link" required=""
                    value="{{$data->link}}">

                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                    <div class="left-area">
                        <h4 class="heading">{{ __('From') }}*</h4>
                    </div>
                </div>
                <div class="col-lg-7">
                    <input type="text" disabled name="ad_from" id="datepicker" class="input-field"
                        placeholder="dd-mm-yy" value={{ $data->ad_from }}>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="left-area">
                        <h4 class="heading">{{ __('To') }}*</h4>
                    </div>
                </div>
                <div class="col-lg-7">
                    <input type="text" disabled name="ad_to" id="datepicker2" class="input-field"
                        placeholder="dd-mm-yy" value={{ $data->ad_to }}>
                </div>
            </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="left-area">

                  </div>
                </div>
                <div class="col-lg-7">
                  {{-- <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button> --}}
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