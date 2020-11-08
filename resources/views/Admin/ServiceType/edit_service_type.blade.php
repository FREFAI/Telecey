@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Edit service type')
@section('content')

<!-- Main content -->
<div class="main-content">
  @include('layouts.admin_layouts.top_navbar')
 <!-- Header -->
  <div class="header bg-gradient-primary pb-1 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--5">
    <div class="row">
    	<div class="col-xl-12 mb-5 mb-xl-0">
	        <div class="card shadow">
	          <div class="card-header bg-transparent">
		    	<div class="row">

		  			<div class="col-md-6">
               <h5 class="heading-small text-muted mb-4">Edit Service type</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
            
		  			<div class="col-lg-12">
            @include('flash-message')
              <form action="{{ url('/admin/updateservicetype') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Type name" name="service_type_name" value="{{$servicetype->service_type_name}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control" name="type">
                        <option value="">Select type</option>
                        <option value="1" @if($servicetype->type == 1) selected="" @endif>Personal</option>
                        <option value="2" @if($servicetype->type == 2) selected="" @endif>Business</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control" name="category">
                        <option value="">Select category</option>
                        <option @if($servicetype->category == 1) selected="" @endif value="1">Mobile</option>
                        <option @if($servicetype->category == 2) selected="" @endif value="2">Fixed Data</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control select2Category" name="filter_types[]" multiple>
                        <option value="device" @if(in_array('device',explode(',',$servicetype->filter_types))) selected="" @endif>Device</option>
                        <option value="local_minutes" @if(in_array('local_minutes',explode(',',$servicetype->filter_types))) selected="" @endif>Local Minutes</option>
                        <option value="data_volum" @if(in_array('data_volum',explode(',',$servicetype->filter_types))) selected="" @endif>Data Volum</option>
                        <option value="sms" @if(in_array('sms',explode(',',$servicetype->filter_types))) selected="" @endif>SMS</option>
                        <option value="speed" @if(in_array('speed',explode(',',$servicetype->filter_types))) selected="" @endif>Speed</option>
                        <option value="upfront_price" @if(in_array('upfront_price',explode(',',$servicetype->filter_types))) selected="" @endif>Upfront price</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="id" value="{{$servicetype->id}}">
                      <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
		    	</div>
		    </div>
		</div>
    <!-- Footer Section Include -->
        @include('layouts.admin_layouts.footer')
    <!-- End Footer Section Include -->
  </div>
</div>
@endsection