@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Add Brand')
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
                   <h5 class="heading-small text-muted mb-4">Add Brand</h5>
                 </div>
                 <div class="col-md-6 text-right">
                   <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
                 </div>
                
                <div class="col-lg-12">
                @include('flash-message')
                  <form action="{{ url('/admin/add-brand') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Brand name" name="brand_name" required="" value="{{old('brand_name')}}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Model name" name="model_name" required="" value="{{old('model_name')}}">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control select2color" name="color[]" multiple >
                              @if($colors)
                                @foreach($colors as $color)
                                  <option value="{{$color->id}}">{{$color->color_name}}</option>
                                @endforeach
                              @else
                                <option value="">Colors not found</option>
                              @endif
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" name="device_type" required="">
                              <option value=''>Select device type</option>
                              @if($devices)
                                @foreach($devices as $device)
                                  <option value="{{$device->id}}">{{$device->device_name}}</option>
                                @endforeach
                              @else
                                <option value="">Device type not found</option>
                              @endif
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <button class="btn btn-primary" type="submit">Save</button>
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