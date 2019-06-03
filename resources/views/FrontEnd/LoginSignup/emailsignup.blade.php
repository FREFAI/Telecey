@extends('layouts.frontend_layouts.loginsignup_layout')
@section('content')

	<!-- Content Start Here -->
		<div class="login-form">
	        <form action="{{url('/emailsignup')}}" method="post">
	        	@csrf
	            <div class="avatar text-center">
	                <img src="frontend/assets/img/logo-telco-tales.png" alt="">
	            </div>
	            <h2 class="text-center mt-5">Sign up with email</h2>
	            <h5 class="text-center mt-1 mb-4">Already a member? <a href="{{url('/signin')}}" class="text-primary"> Log In</a></h5>
				@include('flash-message')
	            <div class="form-group">
	                <input type="text" class="form-control" name="firstname" placeholder="First name" required="required" autocomplete="off">		
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="lastname" placeholder="Last name" required="required" autocomplete="off">		
	            </div>
	            <div class="form-group">
	                <input type="email" class="form-control" name="email" placeholder="Email" required="required" autocomplete="off">		
	            </div>
	            <div class="form-group">
	                <input type="password" class="form-control" name="password" placeholder="Password" required="required">	
	            </div>        
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

@endsection