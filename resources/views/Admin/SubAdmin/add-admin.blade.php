@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Add admin')
@section('content')
@section('pageStyle')
  <style>
    .error{
      color:#f00;
    }
    input.error{
      border-color: #f00;
    }
  </style>
@endsection
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
               <h5 class="heading-small text-muted mb-4">Add admin</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
            
		  			<div class="col-lg-12">
            @include('flash-message')
              <form id="addAdmin" action="{{ url('/admin/add-admin') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" maxlength="50" class="form-control" placeholder="First Name" name="firstname" value="{{ old('firstname') }}" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" maxlength="50" class="form-control" placeholder="Last Name" name="lastname" autocomplete="off" value="{{ old('lastname') }}" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" maxlength="50" class="form-control" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input maxlength="50" class="form-control datepicker" placeholder="Date Of Birth" name="date_of_birth" autocomplete="off" value="{{ old('date_of_birth') }}" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" id="password" maxlength="50" class="form-control" placeholder="Password" name="password" autocomplete="off" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" id="password_confirmation" maxlength="50" class="form-control" placeholder="Confirm Password" name="password_confirmation" autocomplete="off" required="">
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

@section('pageScript')
  <script>
    $('#addAdmin').validate({
        rules: {
            password: {
              "required" : true,
              "minlength": 6,
            },
            password_confirmation: {
                equalTo: "#password"
            }
        }
        messages: {
            password_confirmation: "Enter Confirm Password Same as Password"
        }
    });
  </script>
@endsection