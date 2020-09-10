@extends('layouts.frontend_layouts.loginsignup_layout') 
@section('title', 'Sign up with email') 
@section('content')
	@section('pageStyle')
	<style>
		label.form-check-label {
			font-size: 15px;
		}
		.input-group-addon {
			padding: 3px;
			position: absolute;
			right: 5px;
			top:5px;
			z-index: 99999;

		}
		input.password-field {
			border-radius: 5px;
		}
		.password-form-group label{
			width:100%;
			display: inline-block;
		}
		label#password-error {
			width: 100%;
		}
		label#checkboxTerms-error {
			top: 20px;
		}
	</style>
	@endsection 
	<!-- Content Start Here -->
	<div class="login-form">
		<form action="{{url('/emailsignup')}}" method="post" id="registerForm">
			@csrf
			<div class="avatar text-center">
				<img src="{{URL::asset('frontend/assets/img/logo-new.png')}}" alt="" />
			</div>
			<h2 class="text-center mt-5">{{__('emailsignup.title')}}</h2>
			<h5 class="text-center mt-1 mb-4">{{__('emailsignup.title_one')}} <a href="{{url('/signin')}}" class="text-primary"> {{__('emailsignup.signup_label_link')}}</a></h5>
			@include('flash-message')
			<div class="form-group">
				<input type="text" class="form-control" name="firstname" placeholder="{{__('emailsignup.first_name')}}" required="required" autocomplete="off" maxlength="50" />
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="lastname" placeholder="{{__('emailsignup.last_name')}}" required="required" autocomplete="off" maxlength="50" />
			</div>
			<div class="form-group">
				<input type="email" class="form-control" name="email" placeholder="{{__('emailsignup.email')}}" required="required" autocomplete="off" maxlength="50" id="user_email" />
			</div>
			<div class="form-group password-form-group mb-2">
				<div class="input-group" id="show_hide_password">
					<input class="form-control password-field" type="password" name="password" placeholder="{{__('emailsignup.password')}}" required="required" maxlength="50" onkeyup="passwordValidate(event)">
					<div class="input-group-addon">
						<a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
					</div>
				</div>
				<small id="password_error"></small>
			</div>
			<div class="form-check  my-4">
				<input class="form-check-input" type="checkbox" name="checkboxTerms" value="check" id="agree" required="required">
				<label class="form-check-label" for="inlineCheckbox1">{{__('emailsignup.agree_text')}} 
					<a style="color: blue;" href="javascript:void(0)" data-toggle="modal" data-target="#termAndCondition"> {{__('emailsignup.agree_text_link')}}</a>
				</label><br/>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-lg btn-block login-btn register-btn">{{__('emailsignup.signup_button')}}</button>
			</div>
			<div class="or-seperator"><i>{{__('emailsignup.title_two')}}</i></div>
			<div class="text-center mt-5">
				<a class="btn btn-primary social-login-btn social-facebook" href="{{url('/facebooklogin')}}"><i class="fa fa-facebook"></i></a>
				<a class="btn btn-primary social-login-btn social-google" href="{{url('/googlelogin')}}"><i class="fa fa-google"></i></a>
			</div>
		</form>
	</div>
	<!-- Content End Here -->
	<!-- The Modal -->
	<div class="modal" id="termAndCondition">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header px-3 py-2">
					<h4 class="modal-title">{{__('index.Terms and conditions')}}</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					{!!$setting->terms_and_conditions!!}
				</div>
			</div>
		</div>
	</div>
	@section('pageScript')
	<script>
		$("#registerForm").validate({
			errorPlacement: function( label, element ) {
				if( element.attr( "name" ) === "checkboxTerms" ) {
					element.parent().append( label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
				} else {
					label.insertAfter( element ); // standard behaviour
				}
			}
		});
		function passwordValidate(e) {
			var email = document.getElementById("user_email").value;
			document.getElementById("password_error").innerHTML = "";
			document.getElementById("password_error").style.color = "red";
			var res = email.toString().split("@");
			var pwd = e.target.value;
			if(pwd == ""){
				return false;
			}
			var regularExpression = /^(?=.*\d)(?=.*[a-z])[a-z\d]{2,}$/i;
			var valid = regularExpression.test(pwd);
			if (valid) {
				if (pwd == res[0]) {
					valid = false;
					document.getElementById("password_error").innerHTML = "{{__('index.Your password and email are same')}}";
				} else {
					valid = true;
				}
			} else {
				valid = false;
				document.getElementById("password_error").innerHTML = "{{__('index.Password must be alphanumeric')}}";
			}
			return valid;
		}
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
