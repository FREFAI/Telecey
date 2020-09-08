@extends('layouts.admin_layouts.loginsignup_layout')
@section('title', 'Admin|Reset password')
@section('content')
  <div class="main-content">
    
    <!-- Header -->
    <div class="header bg-gradient-primary py-4 py-lg-5">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome to Telco Tales!</h1>
              <p class="text-lead text-light">Use these awesome forms to reset password in your project for free.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              @include('flash-message')
              <div class="text-center text-muted mb-4">
                <div class="text-muted text-center mt-2 mb-3"><small>Set your password.</small></div>
              </div>
              <form role="form" method="post" action="{{url('/admin/resetPassword')}}" id="resetPasseordForm">
                <div class="form-group mb-3">
                  @csrf
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="New Password" type="password" name="password" id="password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" id="password_confirmation">
                  </div>
                </div>
                <input type="hidden" name="token" value="{{$token}}"> 
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Reset password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; {{date('Y')}} <a href="{{url('/')}}" class="font-weight-bold ml-1" target="_blank">Telco Tales</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="{{url('/')}}" class="nav-link" target="_blank">Telco Tales</a>
            </li>
            <li class="nav-item">
              <a href="{{url('/')}}" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="{{url('/blogs')}}" class="nav-link" target="_blank">Blog</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
@endsection

@section('pageStyle')
<style>
  label#password-error,label#password_confirmation-error{
    width:100%;
    color:#f00;
    margin-bottom:0px;
    background: transparent;
  }
</style>
@endsection
@section('pageScript')
<script>
  $('#resetPasseordForm').validate({
      rules: {
          password: "required",
          password_confirmation: {
            required: true,
            equalTo: "#password",
          }
      },
      errorPlacement: function( label, element ) {
				if( element.attr( "name" ) === "password" || element.attr( "name" ) === "password_confirmation" ) {
					element.parent().append( label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
				} else {
					label.insertAfter( element ); // standard behaviour
				}
			}
  });
</script>
@endsection