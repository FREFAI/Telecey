@extends('layouts.frontend_layouts.loginsignup_layout')
@section('title', 'Sign up with email')
@section('content')

	<!-- Content Start Here -->
		<div class="login-form">
	        <form action="{{url('/emailsignup')}}" method="post" id="registerForm">
	        	@csrf
	            <div class="avatar text-center">
	                <img src="{{URL::asset('frontend/assets/img/logo-new.png')}}" alt="">
	            </div>
	            <h2 class="text-center mt-5">{{__('emailsignup.title')}}</h2>
	            <h5 class="text-center mt-1 mb-4">{{__('emailsignup.title_one')}} <a href="{{url('/signin')}}" class="text-primary"> {{__('emailsignup.signup_label_link')}}</a></h5>
				@include('flash-message')
	            <div class="form-group">
	                <input type="text" class="form-control" name="firstname" placeholder="{{__('emailsignup.first_name')}}" required="required" autocomplete="off" maxlength="50">		
	            </div>
	            <div class="form-group">
	                <input type="text" class="form-control" name="lastname" placeholder="{{__('emailsignup.last_name')}}" required="required" autocomplete="off" maxlength="50">		
	            </div>
	            <div class="form-group">
	                <input type="email" class="form-control" name="email" placeholder="{{__('emailsignup.email')}}" required="required" autocomplete="off" maxlength="50" id="user_email">		
	            </div>
	            <div class="form-group">
	                <input type="password" class="form-control password_user" name="password" placeholder="{{__('emailsignup.password')}}" required="required" maxlength="50" onkeyup="passwordValidate(event)">	
					<small id="password_error"></small>
	            </div>   
	            	<input type="checkbox" name="checkboxTerms" value="check" id="agree" required="required"/> <font size="4px">{{__('emailsignup.agree_text')}}<a style="color:blue;" href="javascript:void(0)" data-toggle="modal" data-target="#termAndCondition"> {{__('emailsignup.agree_text_link')}}</a> </font>
	            <div class="form-group">
	                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn register-btn">{{__('emailsignup.signup_button')}}</button>
	            </div>
	            <div class="or-seperator"><i>{{__('emailsignup.title_two')}}</i></div>
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
<script>
	function passwordValidate(e){
		var email = document.getElementById("user_email").value;
		document.getElementById("password_error").innerHTML = "";
		document.getElementById("password_error").style.color = "red";
		var res = email.toString().split("@");
		var pwd = e.target.value;
		var regularExpression = /^(?=.*\d)(?=.*[a-z])[a-z\d]{2,}$/i;
        var valid = regularExpression.test(pwd);
		if(valid){
			if(pwd == res[0]){
				valid = false;
				document.getElementById("password_error").innerHTML = "Your password and email are same.";
			}else{
				valid = true;
			}
		}else{
			valid = false;
			document.getElementById("password_error").innerHTML = "Password must be alphanumeric";
		}
		return valid;
		
	}
</script>
@endsection