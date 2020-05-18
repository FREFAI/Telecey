@extends('layouts.frontend_layouts.loginsignup_layout')
@section('title', 'Forgot password')
@section('content')
<style type="text/css">
	h2.text-center.forgot-password.mt-5 {
	    font-size: 34px;
	}
	.login-btn:hover{
		background-color: #96fdd4 !important;
	}
</style>
	<!-- Content Start Here -->
		<div class="login-form">
	        <form action="{{url('/forgot-password')}}" method="post">
        		@csrf
	            <div class="avatar text-center">
	                <img src="{{URL::asset('frontend/assets/img/logo-new.png')}}" alt="">
	            </div>
	            <h2 class="text-center forgot-password mt-5">Forgot password</h2>
	            
	            @include('flash-message')
	            <div class="form-group">
	                <input type="email" class="form-control" name="email" placeholder="Email" required="required" maxlength="50">		
	            </div>
	                   
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Next</button>
	            </div>
        		<h5 class="text-center mt-1 mb-4">Back to login <a href="{{url('/signin')}}" class="text-primary"> here</a></h5>
	           
	        </form>
		</div>
	<!-- Content End Here -->

@endsection