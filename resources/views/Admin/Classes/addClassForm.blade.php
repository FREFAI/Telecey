@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Add service type')
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
               <h5 class="heading-small text-muted mb-4">Add Class</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url('/admin/classes') }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
            
		  	<div class="col-lg-12">
            @include('flash-message')
              <form action="{{ url('/admin/addClass') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Class name" name="class_name" value="{{old('class_name')}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control" name="type">
                        <option value="">Select type</option>
                        <option @if(old('type') == 1 ) selected="" @endif value="1">Voice</option>
                        <option @if(old('type') == 2 ) selected="" @endif value="2">Data</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Start range" name="start_range" value="{{old('start_range')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="End range" name="end_range" value="{{old('end_range')}}">
                        </div>
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