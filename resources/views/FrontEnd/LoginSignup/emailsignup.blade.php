@extends('layouts.frontend_layouts.loginsignup_layout')
@section('title', 'Sign up with email')
@section('content')

	<!-- Content Start Here -->
		<div class="login-form">
	        <form action="{{url('/emailsignup')}}" method="post">
	        	@csrf
	            <div class="avatar text-center">
	                <img src="{{URL::asset('frontend/assets/img/logo-new.png')}}" alt="">
	            </div>
	            <h2 class="text-center mt-5">Sign up with email</h2>
	            <h5 class="text-center mt-1 mb-4">Already a member? <a href="{{url('/signin')}}" class="text-primary"> Log In</a></h5>
				@include('flash-message')
	            <div class="form-group">
	                <input type="text" class="form-control" name="firstname" placeholder="First name" required="required" autocomplete="off" maxlength="50">		
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="lastname" placeholder="Last name" required="required" autocomplete="off" maxlength="50">		
	            </div>
	            <div class="form-group">
	                <input type="email" class="form-control" name="email" placeholder="Email" required="required" autocomplete="off" maxlength="50">		
	            </div>
	            <div class="form-group">
	                <input type="password" class="form-control" name="password" placeholder="Password" required="required" maxlength="50">	
	            </div>   





	            	<input type="checkbox" name="checkboxTerms" value="check" id="agree" required="required"/> <font size="4px">I agree to the <a style="color:blue;" href="javascript:void(0)" data-toggle="modal" data-target="#termAndCondition">terms and conditions</a> </font>



 

	            <div class="form-group">
	                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Sign Up</button>
	            </div>
	            <div class="or-seperator"><i>or sign up with</i></div>
	            <div class="text-center mt-5">
	                    <a class="btn btn-primary social-login-btn social-facebook" href="{{url('/facebooklogin')}}"><i class="fa fa-facebook"></i></a>
	                    <a class="btn btn-primary social-login-btn social-google" href="{{url('/googlelogin')}}"><i class="fa fa-google"></i></a>
	            </div>
	           <!--  <div class="check-bx mt-4">
	                <input type="checkbox"> <span>Join this site’s community. <a href="#" class="text-primary">Read more</a> </span>
	            </div> -->
	        </form>
		</div>
	<!-- Content End Here -->
<!-- The Modal -->
<div class="modal" id="termAndCondition">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header px-3 py-2">
        <h4 class="modal-title">Terms and conditions</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        {!!$setting->terms_and_conditions!!}
      </div>

    </div>
  </div>
</div>
@endsection