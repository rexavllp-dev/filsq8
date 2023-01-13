@extends('layouts.load')

@section('content')
<div class="modal-body text-center">
    @if ($data->is_approved)
    <button class="btn btn-primary text-center">
        {{ __("Approved") }}
    </button>
    @else
    <p class="text-center">{{ __("Are you sure you want to approve the advertisment.") }}</p>
    <p class="text-center">{{ __("Do you want to proceed?") }}</p>
    <form action="{{route('admin-approve-update-footer-ad', [$data->id , $data->adid])}}" method="POST" class="">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $data->id }}">
        <button type="submit" class="btn btn-success text-center">
            {{ __("Approve") }}
        </button>
    </form>
    @endif
</div>
@endsection