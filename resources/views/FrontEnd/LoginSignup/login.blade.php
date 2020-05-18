@extends('layouts.frontend_layouts.loginsignup_layout')
@section('title', 'Login')
@section('content')

	<!-- Content Start Here -->
		<div class="login-form">
	        <form action="{{url('/signin')}}" method="post">
        		@csrf
	            <div class="avatar text-center">
	                <img src="{{URL::asset('frontend/assets/img/logo-new.png')}}" alt="">
	            </div>
	            <h2 class="text-center mt-5">Log In User</h2>
	            
	            @include('flash-message')
	            <div class="form-group">
	                <input type="email" class="form-control" name="email" placeholder="Email" required="required" maxlength="50">		
	            </div>
	            <div class="form-group">
	                <input type="password" class="form-control" name="password" placeholder="Password" required="required" maxlength="50">	
	            </div>        
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Log In</button>
	            </div>
        		<h5 class="text-center mt-1 mb-4">Sign up with email <a href="{{url('/emailsignup')}}" class="text-primary"> here</a></h5>
	            <div class="or-seperator"><i>or sign up with</i></div>
	            <div class="text-center mt-5">
	                    <a class="btn btn-primary social-login-btn social-facebook" href="{{url('/facebooklogin')}}"><i class="fa fa-facebook"></i></a>
	                    <a class="btn btn-primary social-login-btn social-google" href="{{url('/googlelogin')}}"><i class="fa fa-google"></i></a>
	            </div>
	            <div class="check-bx mt-4 text-center">
	                <span><a href="{{url('/forgot-password')}}" class="text-primary">Forgotten password?</a> </span>
	            </div>
	        </form>
		</div>
	<!-- Content End Here -->

@endsection