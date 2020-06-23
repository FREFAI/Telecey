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
	            <h2 class="text-center mt-5">{{__('login.title')}}</h2>
	            
	            @include('flash-message')
	            <div class="form-group">
	                <input type="email" class="form-control" name="email" placeholder="{{__('login.email')}}" required="required" maxlength="50">		
	            </div>
	            <div class="form-group">
	                <input type="password" class="form-control" name="password" placeholder="{{__('login.password')}}" required="required" maxlength="50">	
	            </div>        
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">{{__('login.login_button')}}</button>
	            </div>
        		<h5 class="text-center mt-1 mb-4">{{__('login.signup_label')}} <a href="{{url('/emailsignup')}}" class="text-primary"> {{__('login.signup_label_link')}}</a></h5>
	            <div class="or-seperator"><i>{{__('login.signup_label2')}}</i></div>
	            <div class="text-center mt-5">
	                    <a class="btn btn-primary social-login-btn social-facebook" href="{{url('/facebooklogin')}}"><i class="fa fa-facebook"></i></a>
	                    <a class="btn btn-primary social-login-btn social-google" href="{{url('/googlelogin')}}"><i class="fa fa-google"></i></a>
	            </div>
	            <div class="check-bx mt-4 text-center">
	                <span><a href="{{url('/forgot-password')}}" class="text-primary">{{__('login.forgot_button')}}</a> </span>
	            </div>
	        </form>
		</div>
	<!-- Content End Here -->

@endsection