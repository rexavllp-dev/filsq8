@extends('layouts.admin')

@section('content')

<div class="content-area">
    {{-- breadcrumb --}}
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Ads Position') }}</h4>
                <ul class="links">
                    {{-- <li>
                        <a href="{{ route('vendor.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor-ads-showlayout') }}">{{ __('Ads Position') }} </a>
                    </li> --}}
                    <li>
                        <a href="{{ null }}">{{ __('Edit Ads positions') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Layout --}}

    <div class="row">
        <div class="col-12">
            <div class="card">

                {{-- Upload ads --}}
                <div class="add-product-content1 add-product-content2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-description">
                                <div class="body-area">
                                    <div class="gocover"
                                        style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                    </div>
                                    {{-- action="{{route('vendor-slider-ad-store' , ['id' => $slot['id']])}}" --}}
                                    <form id="geniusform" 
                                        action="{{route('admin-update-position-ad', ['id' => $data->id])}}"
                                        method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        @include('alerts.admin.form-both')

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Name') }} *</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <input type="text" class="input-field" name="name"
                                                    placeholder="{{ __('Name') }}" value={{$data->name}} >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="left-area">
                                                    <h4 class="heading">{{ __('Price') }} *</h4>
                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <input type="text" class="input-field" name="price"
                                                    placeholder="{{ __('Price') }}" required="" value={{$data->price}} >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="left-area">

                                                </div>
                                            </div>
                                            <div class="col-lg-7">
                                                <button class="addProductSubmit-btn" type="submit">{{ __('Update
                                                    Position') }}</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Upload ads end --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(function(){
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            minDate: new Date(document.getElementById("datepicker").value),
            onSelect: function(date) {
                $("#datepicker2").datepicker('option', 'minDate', date);
            }
        });
    });
    $(function(){
        $("#datepicker2").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
        });
    });

</script>

@endsection