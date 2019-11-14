@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Edit Brand')
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
                   <h5 class="heading-small text-muted mb-4">Edit Brand</h5>
                 </div>
                 <div class="col-md-6 text-right">
                   <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
                 </div>
                
                <div class="col-lg-12">
                  @if($brand)
                    @include('flash-message')
                    <form action="{{ url('/admin/edit-brand') }}" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="{{base64_encode($brand->id)}}">
                      @csrf
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Brand name" name="brand_name" value="{{$brand->brand_name}}" required="">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Model name" name="model_name" required="" value="{{$brand->model_name}}">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <select class="form-control select2color" name="color[]" multiple >
                                @php
                                  $colors_ids = explode(',',$brand->colors_id)
                                @endphp
                                @if($colors)
                                    @foreach($colors as $color)
                                      <option value="{{$color->id}}" {{in_array($color->id,$colors_ids) ? 'selected' : '' }}>{{$color->color_name}}</option>
                                    @endforeach
                                @else
                                  <option value="">Colors not found</option>
                                @endif
                              </select>
                          </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  @else
                    <div class="text-center">
                      <h3 class="heading-small">Brand not found.</h3>
                    </div>
                  @endif
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