@extends('layouts.front')
@section('content')
<style type="text/css">
    .price-digit{
        font-size: 35px !important;
    }
</style>

<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
                <div class="col-lg-8">
     
    <div class="panel panel-primary">

      <div class="panel-body">
     
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        <img src="images/{{ Session::get('image') }}">
        @endif
    
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
       <div class="card-header text-center font-weight-bold">
      <h2>Upload Banner</h2>
    </div>
 
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{route('user-banner-create')}}" >

        	      {{csrf_field()}}
                   
            <div class="row">
 
                <div class="col-md-12">
                    <div class="form-group">
                    	<input type="hidden" name="id" value="{{$sub->id}}">
                        <input type="file" name="image" placeholder="Choose image" id="image">

                    </div>
                </div>
                   
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>     
        </form>
 
    </div>
    
      </div>
    </div>

                </div>
      </div>
    </div>
  </section>

@endsection
<style type="text/css">
	.categories_menu{
		    display: none !important;
	}
</style>