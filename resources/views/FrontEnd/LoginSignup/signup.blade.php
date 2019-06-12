@extends('layouts.frontend_layouts.loginsignup_layout')
@section('title', 'Sign up')
@section('content')

	<!-- Content Start Here -->
		<div class="login-form">
            <form action="#" method="post">
                <div class="avatar text-center">
                        <img src="{{URL::asset('frontend/assets/img/logo-telco-tales.png')}}" alt="">
                </div>
                <h2 class="text-center mt-5">Sign Up</h2>
                <h5 class="text-center mt-1 mb-4">Already a member? <a href="{{url('/signin')}}" class="text-primary"> Log In</a></h5>
                @include('flash-message')
                <div class="social-btn text-center">
                    <a href="{{url('/facebooklogin')}}" class="btn btn-primary btn-block btn-lg"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
                    <a href="{{url('/googlelogin')}}" class="btn btn-danger btn-block btn-lg"><i class="fa fa-google"></i> Sign in with <b>Google</b></a>
                </div>
                <div class="or-seperator"><i>or</i></div>
                <a href="{{url('/emailsignup')}}" class="btn btn-common btn-find signup mt-5">Sign up with email</a>
                <!-- <div class="check-bx mt-3">
                    <input type="checkbox"> <span>Join this site’s community. <a href="#" class="text-primary">Read more</a> </span>
                </div> -->
            </form>
        </div>
	<!-- Content End Here -->

@endsection