@extends('layouts.frontend_layouts.loginsignup_layout')
@section('title', 'Login')
@section('content')
	@section('pageStyle')
		<style>
			label.form-check-label {
				font-size: 15px;
			}
			.input-group-addon {
				padding: 7px;
				border-right: 1px solid #e5e5e5;
				border-radius: 3px;
				border-top: 1px solid #e5e5e5;
				border-bottom: 1px solid #e5e5e5;
			}
			input.password-field {
				border-right: none;
			}
			label#password-error{
				width:100%;
			}
		</style>
	@endsection 
	<!-- Content Start Here -->
		<div class="login-form">
	        <form action="{{url('/signin')}}" method="post" id="loginForm">
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
					<div class="input-group" id="show_hide_password">
						<input class="form-control password-field" type="password" name="password" placeholder="{{__('login.password')}}" required="required" maxlength="50">
						<div class="input-group-addon">
							<a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
						</div>
					</div>
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
	@section('pageScript')
	<script>
		$("#loginForm").validate({
			errorPlacement: function( label, element ) {
				if( element.attr( "name" ) === "password" ) {
					element.parent().append( label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
				} else {
					label.insertAfter( element ); // standard behaviour
				}
			}
		});
		$("#show_hide_password a").on('click', function(event) {
			event.preventDefault();
			if($('#show_hide_password input').attr("type") == "text"){
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass( "fa-eye-slash" );
				$('#show_hide_password i').removeClass( "fa-eye" );
			}else if($('#show_hide_password input').attr("type") == "password"){
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass( "fa-eye-slash" );
				$('#show_hide_password i').addClass( "fa-eye" );
			}
		});
	</script>
	@endsection 
@endsection