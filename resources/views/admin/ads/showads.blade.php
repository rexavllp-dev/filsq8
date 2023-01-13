@extends('layouts.admin')

@section('content')
<input type="hidden" id="headerdata" value="{{ __(" ADVERTISMENT") }}">
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __("Advertisments") }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-show-ads') }}">{{ __("Advertisments") }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="product-area">
        <div class="row">
            <div class="col-lg-12">
                <div class="mr-table allproduct">

                    @include('alerts.admin.form-success')

                    <div class="table-responsive">
                        <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __("Title") }}</th>
                                    <th>{{ __("Approved") }}</th>
                                    <th>{{ __("Ad By") }}</th>
                                    <th>{{ __("From") }}</th>
                                    <th>{{ __("To") }}</th>
                                    <th>{{ __("Ad Price") }}</th>
                                    <th>{{ __("Payment") }}</th>
                                    <th>{{ __("Options") }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ADD / EDIT MODAL --}}

<div class="modal fade" id="confirm-approve" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="submit-loader">
                <img src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
            </div>
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>

{{-- ADD / EDIT MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-approve1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __("Confirm Approval") }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __("Are you sure you want to approve the advertisment.") }}</p>
                <p class="text-center">{{ __("Do you want to proceed?") }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
                <form action="" class="d-inline delete-form" id="confirmpop" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-success">{{ __('Approve') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- DELETE MODAL ENDS --}}

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
               ajax: '{{ route('admin-show-ads-datatables') }}',
               columns: [
                        { data: 'ad_pos_name', name: 'ad_pos_name' },
                        { data: 'is_approved', name: 'is_approved' },
                        { data: 'name', name: 'name' },
                        { data: 'ad_from', name: 'ad_from' },
                        { data: 'ad_to', name: 'ad_to' },
                        { data: 'ad_rate', name: 'ad_rate' },
                        { data: 'is_payment_success', name: 'is_payment_success' },
                        { data: 'action' , name: 'action', searchable: false, orderable: false }
                     ],
                language : {
                  processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });

        $(function() {
        // $(".btn-area").append('<div class="col-sm-4 table-contents">'+
        //   '<a class="add-btn" data-href="{{route('admin-subscription-create')}}" id="add-data" data-toggle="modal" data-target="#modal1">'+
        //   '<i class="fas fa-plus"> <span class="remove-mobile">{{ __("Add New") }}<span>'+
        //   '</a>'+
        //   '</div>');
        $('.confirmopen').click(function()
        {
            console.log(this.attr('data-href'));
        })
        $('#confirmpop').attr('action', 'https://www.google.com/');
      });                     
                  
{{-- DATA TABLE ENDS--}}

})(jQuery);
</script>

@endsection