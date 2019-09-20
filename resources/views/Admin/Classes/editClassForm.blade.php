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
               <h5 class="heading-small text-muted mb-4">Edit Class</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{url('/admin/classes?page='.$data->page)}}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
            
		  	<div class="col-lg-12">
            @include('flash-message')
              <form action="{{ url('/admin/editClass') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                    <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Class name" name="class_name" value="{{$data->class_name}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <select class="form-control" name="type">
                        <option value="">Select type</option>
                        @if($data->type == 1) 
                            <option value="1" selected>Voice</option>
                            <option value="2">Data</option>
                        @else
                            <option value="1">Voice</option>
                            <option value="2" selected>Data</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Start range" name="start_range" value="{{$data->start_range}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="End range" name="end_range" value="{{$data->end_range}}">
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="class_id" value="{{$data->id}}">
                <input type="hidden" class="form-control" name="page" value="{{$data->page}}">
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