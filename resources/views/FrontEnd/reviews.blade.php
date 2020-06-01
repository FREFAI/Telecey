@extends('layouts.frontend_layouts.frontend')
@section('title', 'Reviews')
@section('content')

<style type="text/css">
    .overage_price {
        background-color: #ffffff;
    }
    #overage_price_model{
        z-index: 999999;
        background-color: #00000052;
    }
    div#user_address {
        z-index: 999999;
    }
    div#usage_price_model {
        z-index: 999999;
        background: #00000040;
    }
    div#speedTestModel {
        z-index: 999999;
        background: #00000040;
    }
    select.brand_select_brand_device {
		display: none !important;
	}
    .dropdown-select {
		background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.25) 0%, rgba(255, 255, 255, 0) 100%);
		background-repeat: repeat-x;
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#40FFFFFF', endColorstr='#00FFFFFF', GradientType=0);
		background-color: #fff;
		border-radius: 6px;
		/* border: solid 1px #eee; */
		/* box-shadow: 0px 2px 5px 0px rgba(155, 155, 155, 0.5); */
		box-sizing: border-box;
		cursor: pointer;
		display: block;
		float: left;
		font-size: 14px;
		font-weight: normal;
        height: 34px;
        line-height: 34px;
		outline: none;
		padding-left: 18px;
		padding-right: 30px;
		position: relative;
		text-align: left !important;
		transition: all 0.2s ease-in-out;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		white-space: nowrap;
		width: auto;

	}

	.dropdown-select:focus {
		background-color: #fff;
	}

	.dropdown-select:hover {
		background-color: #fff;
	}

	.dropdown-select:after {
		display:none;
	}

	.dropdown-select.open:after {
		-webkit-transform: rotate(-180deg);
		transform: rotate(-180deg);
	}

	.dropdown-select.open .list {
		-webkit-transform: scale(1);
		transform: scale(1);
		opacity: 1;
		pointer-events: auto;
	}

	.dropdown-select.open .option {
		cursor: pointer;
	}

	.selectreview .dropdown-select.wide {
		width: 100%;
        border: 1px solid #2e75b5;
        border-radius: 5px;
        font-weight: 400;
	}

	.dropdown-select.wide .list {
		left: 0 !important;
		right: 0 !important;
	}

	.dropdown-select .list {
		box-sizing: border-box;
		transition: all 0.15s cubic-bezier(0.25, 0, 0.25, 1.75), opacity 0.1s linear;
		-webkit-transform: scale(0.75);
		transform: scale(0.75);
		-webkit-transform-origin: 50% 0;
		transform-origin: 50% 0;
		box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.09);
		background-color: #fff;
		border-radius: 6px;
		margin-top: 4px;
		padding: 3px 0;
		opacity: 0;
		overflow: hidden;
		pointer-events: none;
		position: absolute;
		top: 100%;
		left: 0;
		z-index: 999;
		max-height: 250px;
		overflow: auto;
		border: 1px solid #ddd;
	}

	.dropdown-select .list:hover .option:not(:hover) {
		background-color: transparent !important;
	}
	.dropdown-select .dd-search{
        overflow:hidden;
        display:flex;
        align-items:center;
        justify-content:center;
        margin:0.5rem;
	}

	.dropdown-select .dd-searchbox:focus{
	    border-color:#12CBC4;
	}

	.dropdown-select .list ul {
		padding: 0;
	}
    span.current {
		color: #000;
		text-transform: capitalize;
	}
	input.txtSearchValue{
		height:30px;
        width: 100%;
	}
	.dropdown-select .option {
		cursor: default;
		font-weight: 400;
		line-height: 40px;
		outline: none;
		padding-left: 18px;
		padding-right: 29px;
		text-align: left;
		transition: all 0.2s;
		list-style: none;
	}

	.dropdown-select .option:hover,
	.dropdown-select .option:focus {
		background-color: #f6f6f6 !important;
	}

	.dropdown-select .option.selected {
		font-weight: 600;
		color: #2e75b5;
	}

	.dropdown-select .option.selected:focus {
		background: #f6f6f6;
	}

	.dropdown-select a {
		color: #aaa;
		text-decoration: none;
		transition: all 0.2s ease-in-out;
	}

	.dropdown-select a:hover {
		color: #666;
    }
    input.form-control{
        min-height: 32px;
        height: unset !important;
    }
    .form-control{
        border: none;
    }
    .heading.detail-div {
        margin: -2rem auto 1rem;
    }
</style>
	<!-- Content Start Here -->
		<div class="inner-page start-page" style="background: url({{URL::asset('frontend/assets/img/bg-1.jpeg')}});">
		    <div class="container-fluid">
		        <!-- <div class="row">
		            <div class="col-lg-4 text-center">
		                <div class="step-section-one">
		                    <img src="{{URL::asset('frontend/assets/img/intro.png')}}">
		                    <h2 class="pt-3 text-white">1</h2>
		                    <h3 class="pt-3 custom-height-cl">PLEASE INTRODUCE YOUR SELF</h3>
		                </div>
		            </div>
		            <div class="col-lg-4 text-center">
		                <div class="step-section-one">
		                    <img src="{{URL::asset('frontend/assets/img/share.png')}}">
		                    <h2 class="pt-3 text-white">2</h2>
		                    <h3 class="pt-3 custom-height-cl">CAN YOU ALSO SHARE YOUR SERVICE DETAILS</h3>
		                </div>
		            </div>
		            <div class="col-lg-4 text-center">
		                <div class="step-section-one">
		                    <img src="{{URL::asset('frontend/assets/img/rating.png')}}">
		                    <h2 class="pt-3 text-white">3</h2>
		                    <h3 class="pt-3 custom-height-cl">ONE MORE THINGDO YOU RATE THIS SERVICE?</h3>
		                </div>
		            </div>
		        </div> -->
		        <!-- <div class="row">
	                <div class="col text-center">
	                        <a href="javascript:void(0);" data-class="intro-section" class="start_btn">
	                        <button class="learn-more mt-5">
	                            <div class="circle">
	                            <span class="icon arrow"></span>
	                            </div>
	                            <p class="button-text">START</p>
	                        </button>
	                    </a>
	                </div>
	            </div> -->
		    </div>
		</div>
		<!-- intro section -->
        @if(!Request::get('type'))
		<section class="intro-section">
	        <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="step_one_img">
                            <img src="{{URL::asset('frontend/assets/img/374216-PBQ6QV-653.png')}}"/>
                        </div>
                    </div>
                    <!-- <div class="col-lg-12 text-center">
                        <div class="title-step-1">
                            <h1>STEP #1</h1>
                            <h1>Please Introduce Yourself</h1>
                        </div>
                    </div> -->
                </div>
	            <div class="row step-row">
	                <div class="col-lg-12 text-center wow animated fadeInRight" data-wow-delay="0.2s">
	                    <div class="step-section-one mt-5 mb-5">
	                        <!-- <img src="assets/img/step-1.png">
	                        <h2 class="pt-3 text-white">1</h2>
	                        <h3 class="pt-3 custom-height-cl">PLEASE INTRODUCE YOUR SELF</h3> -->
	                        <section class="get-in-touch">
	                            <p class="title pt-3">Join our mailing list</p>
	                            <p class="pt-2 pb-3 text-black text-left">Never miss an update</p>
	                            <form class="contact-form row" id="firstform">
	                                <div class="form-field col-lg-6">
	                                    <input id="firstname" class="input-text js-input" type="text" required value="{{$usersDetail->firstname}}" name="firstname">
	                                    <label class="label" for="name">First Name</label>
	                                </div>
	                                <div class="form-field col-lg-6">
	                                    <input id="lastname" class="input-text js-input" type="text" required value="{{$usersDetail->lastname}}" name="lastname">
	                                    <label class="label" for="name">Last Name</label>
	                                </div>
	                                <div class="form-field col-lg-6 country_div" id="country_div">
	                                    <input id="country" class="input-text js-input" type="text" required value="{{$usersDetail->country}}" name="country" autocomplete="no">
                                        <label class="label" for="country">Country</label>
	                                </div>
	                                <div class="form-field col-lg-6 city_div" id="city_div">
	                                    <input id="city" class="input-text js-input city_input" type="text" required value="{{$usersDetail->city}}" name="city"  autocomplete="no" data-country="{{$usersDetail->country_code}}">
	                                    <label class="label" for="city">City</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="email" class="input-text js-input" type="email" value="{{$usersDetail->email}}" disabled="">
	                                    <label class="label" for="email">E-mail</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                        <input id="postal_code" class="input-text js-input" type="text" value="{{$usersDetail->postal_code}}" name="postal_code" autocomplete="no">
	                                        <label class="label" for="number">Postal Code</label>
	                                    </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="mobile_number" class="input-text js-input" type="text" value="{{$usersDetail->mobile_number}}" name="mobile_number"autocomplete="no">
	                                    <label class="label" for="phone">Contact Number</label>
                                    </div>
                                    <input type="hidden" name="latitude" id="lat" value="{{$lat}}">
                                    <input type="hidden" name="longitude" id="long" value="{{$long}}">
	                               <!--  <div class="custom-control custom-checkbox ml-3">
	                                    <input type="checkbox" class="custom-control-input" id="Check33" required >
	                                    <label class="custom-control-label" for="Check33">Agree to terms and conditions</label>
	                                    </div> -->
	                                <div class="form-field col-lg-12">
	                                    <input class="submit-btn" type="submit" value="Submit">
	                                </div>
	                            </form>
	                        </section>
	                    </div>
	                </div>
	            </div>
	        </div>
		</section>
         @endif
		<!-- end-intro-section -->
		<!-- share-serv-detail -->
		<section class="service-detail @if(!Request::get('type')) section-d-none @endif">
		    <div class="container review-container">
                <div class="row second-step align-items-center">
                    <div class="col-lg-4">
                        <div class="step_two_img">
                            <img src="{{URL::asset('frontend/assets/img/Tube_Lights_(1).png')}}"/>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class=" title-step-1 w-75">
                            @if(Request::get('type'))
                                <h1>STEP #1</h1>
                            @else
                                <h1>STEP #2</h1>
                            @endif
                            <h1>What About Sharing You Service with others?</h1>
                        </div>
                    </div>
                </div>
               
                @if(!Request::get('type'))
	           	<form class="detail-section pt-4 mb-3">
	                <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs tab-selection">
                                <li class="nav-item">
                                    <a class="nav-link active select_one" data-value="services-section" data-toggle="tab" href="#menu1">Plans</a>
                                </li>
                                @if($settings->device == 1)
                                <li class="nav-item">
                                    <a class="nav-link @if(Request::get('type') == 2) active @endif  select_one" data-value="product-section" data-toggle="tab" href="#home">Devices</a>
                                </li>
                                @endif
                                
                            </ul>
                        </div>
	                </div>
	            </form> 
                @endif
                <!-- Device section  -->
                <section class="product-section @if(Request::get('type') == 1) section-d-none @endif  @if(!Request::get('type')) section-d-none @endif section-both">
                    <form id="device_rating_form" method="post" action="javascript:void(0);">
                        <div class="row mt-1">
                            <div class="col-lg-6">
                                <h5>Device type</h5>
                                <div class="tg-select form-control">
                                    <select required="required" name="device_name" id="device_id">
                                        @if(count($devices) > 0)
                                            <option value="">Choose device</option>
                                        @foreach($devices as $device)
                                            <option value="{{$device->id}}">{{$device->device_name}}</option>
                                        @endforeach
                                        @else
                                            <option value="">No data found.</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                    <h5>Brand</h5>
                                    <div class="form-group inputwithicon">
                                        <div class="selectreview">
                                            <select class="brand_name active brand_select_brand_device" required="required" name="brand_name" data-url="{{url('/searchBrand')}}">
                                                <option value="">Brand</option>
                                                @foreach($brands as $v)
                                                    <option value="{{$v->id}}" @if( request()->get('brand_name') ) @if( request()->get('brand_name') == $v->id) selected @endif @endif>{{$v->brand_name}} {{$v->model_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group brand_text ped-3 mb-0">
                                        <input type="text" class="form-control brand_name text_brand_name mt-1" name="brand_name" placeholder="Brand name" maxlength="30">   
                                        <input type="text" class="form-control model_name text_model_name mt-1" name="model_name" placeholder="Model name" maxlength="30">      
                                        <input type="hidden" class="form-control brand_status" name="brand_status" placeholder="Brand status" value="1">      
                                    </div>
                                    <small>
                                        <a href="javascript:void(0)" onclick="brand_text_show();" class="brand_text_show">Couldn't find your brand</a>
                                    </small>
                                </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-lg-6 ">
                                <h5>Price</h5>
                                <div class="form-group mb-0">
                                    <select class="currency_id">
                                        @foreach($countries as $curr)
                                            @if($curr->currency_code != '' && $curr->currency_code != " ")
                                                <option @if($curr->code == $usersDetail->country_code)
                                                selected
                                                @elseif($curr->country_code == 'US') selected @endif value="{{$curr->id}}">{{$curr->currency_code}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control price-box device-price" name="price" placeholder="Price" required id="price">  
                                    <small><input type="checkbox" checked> Including Tax</small>    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h5>Supplier</h5>
                                <div class="tg-select form-control supplier_select mb-0">
                                    <select name="supplier" id="supplier" class="supplier_name active">
                                        @if(count($suppliers) > 0)
                                            <option value="">Choose brand</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->brand_name}} {{$supplier->supplier_name}}</option>
                                        @endforeach
                                        @else
                                            <option value="">No data found.</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group supplier_text mb-0">
                                    <input type="text" class="form-control supplier_name text_supplier_name" name="supplier_name" placeholder="Supplier name" maxlength="30">      
                                    <input type="hidden" class="form-control supplier_status" name="supplier_status" placeholder="Supplier status" value="1">      
                                </div>
                                <small>
                                    <a href="javascript:void(0)" class="supplier_text_show" onclick="supplier_text_show()">Couldn't find your supplier</a>
                                </small>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-3">
                                <h5>Capacity</h5>
                                <div class="tg-select form-control mb-0">
                                    <select required="required" name="storage" id="storage">
                                        <option value="">Choose Capacity</option>
                                        <option value="64">64</option>
                                        <option value="128">128</option>
                                        <option value="256">256</option>
                                        <option value="512">512</option>
                                        <option value="1GB">1GB</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h5>Color</h5>
                                <div class="tg-select form-control mb-0">
                                    <select  name="device_color" id="device_color">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                @if(Request::get('type'))                 
                                    <a class="link" href="{{url('/reviews?type=1')}}"><h5>Do you want to rate a plan instead?</h5></a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" id="device_review_id" name="device_review_id">
                            <div class="col-lg-6">
                                @if(!Request::get('type'))
                                    <div class="back-button">
                                        <button type="button" class="back-btn-device mt-3 common-btn"><i class="fas fa-angle-left"></i> Back</button>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block product-submit-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Star rating section -->
                    <div class="services-rating-section section-d-none section-both" id="device_rating_section">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="step_three_img text-center">
                                    <img src="{{URL::asset('frontend/assets/img/Waves_iPhone_Case.png')}}"/>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="title-step-1 w-75">
                                    @if(Request::get('type'))
                                        <h1>STEP #2</h1>
                                    @else
                                        <h1>STEP #3</h1>
                                    @endif
                                    <h1>What about Rating Your Service Today?</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="heading detail-div">
                                <h1 class="section-title">Rating</h1>
                            </div>
                        </div>
                        <div class="row device_starrating_error d-none">
                            <div class="error">
                                All rating rows are required.
                            </div>
                        </div>
                        @if(count($questions)>0)
                            @foreach($questions as $question)
                                @if($question->type == 2)
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="">
                                            <h5>{{$question->question}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                            @if($question->text_field == 1)
                                                <div class="form-group mb-2">
                                                    <input type="text" class="form-control" id="text_field_value{{$question->id}}">		
                                                </div>
                                            @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="rating float-right device-rating" data-question_id="{{$question->id}}"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="rating coverage" data-rate-value=6></div> -->
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @endif
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5>Comment</h5>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="form-group">
                                    <textarea class="form-control" id="device_comment" placeholder="Write comment here...." rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="font-weight-bold">Average</h5>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <input type="hidden" class="device_average_input" value="0">
                                <div class="font-weight-bold device_average_div">0</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="back-button">
                                    <button type="button" class="common-btn back-btn-3 mt-2"><i class="fas fa-angle-left"></i> Back</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group ml-auto mr-auto text-right">
                                    <input type="hidden" name="type" class="device-type" value="2">
                                    <input type="hidden" name="device_id" class="device_id">
                                    <button type="submit" class="common-btn device-rating-submit-btn-add">Submit</button>
                                    <button type="submit" class="btn  btn-lg btn-primary device-rating-submit-btn d-none">Submit</button>                                    
                                </div>
                            </div>
                        </div>
                    </div>
               	</section>
                <!-- End product section  -->
                <!-- Plan Section -->
                <section class="services-section  @if(Request::get('type') == 2) section-d-none @endif   section-both">
                    <!-- Form Section  -->
                	<div class="service_form_section">
	                	<form class="reveiewing_form_service">
	                    	<div class="row mt-3">
	                            <div class="col-lg-6 ">
	                                <h5>Provider Name</h5>
	                                <div class="tg-select form-control provider_select mb-0">
	                                     <select class="provider_name active" name="provider_name" required="required">
	                                         <option value="">Please select provider</option>
                                             @if(count($providers) > 0)
                                                @foreach($providers as $provider)
                                                    <option value="{{$provider->id}}">{{$provider->provider_name}}</option>
                                                @endforeach
                                             @else
                                                <option value="" disabled="">Not found</option>
                                             @endif
	                                     </select>
	                                 </div>
                                    <div class="form-group provider_text mb-2">
                                        <input type="text" class="form-control provider_name text_provider_name" name="provider_name" placeholder="Provider name" maxlength="30">      
                                        <input type="hidden" class="form-control provider_status" name="provider_status" placeholder="Provider status">      
                                    </div>
                                    <small>
                                        <a href="javascript:void(0)" class="provider_text_show" onclick="provider_text_show()">Couldn't find your Service provider</a>
                                    </small>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="row align-items-center">
	                                    <div class="col-lg-6">
                             	            <h5 class="pt-3">Contract type</h5>
                                            <div class="form-group review_page">
                                                <span class="ext-default reviewpage_toggle active">Personal</span>
                                                <label class="switch">
                                                  <input type="checkbox" id="personal" class="contract_type" name="contract_type" value="2">
                                                  <span class="slider"></span>
                                                </label>
                                                <span class="text-default reviewpage_toggle">Business</span>
                                            </div>

	                                        <!-- <div class="button-product">
	                                            <label class="text-product"><input type="radio" class="radio-inline contract_type" name="contract_type" value="1" checked="" data-type="personal"><span class="outside"><span class="inside"></span></span>Personal</label>
	                                        </div> -->
	                                    </div>
                                        <div class="col-lg-6 pt-3">
                                            <h5>Payment type</h5>
                                            <div class="form-group review_page">
                                                <span class="ext-default reviewpage_toggle active">Postpaid</span>
                                                <label class="switch">
                                                  <input type="checkbox" id="payment_type" class="payment_type" name="payment_type">
                                                  <span class="slider"></span>
                                                </label>
                                                <span class="text-default reviewpage_toggle">Prepaid</span>
                                            </div>
                                        </div>
	                                    <!-- <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product"><input type="radio" class="radio-inline contract_type" name="contract_type" value="2" data-type="buisness"><span class="outside"><span class="inside"></span></span>Business</label>
	                                        </div>
	                                    </div> -->
	                                </div>
	                             </div>
	                        </div>
	                        <div class="row mt-1">
                                <div class="col-lg-6">
	                                <h5>Service type</h5>
	                                <div class="tg-select form-control">
	                                    <select class="service_type" required>
	                                    	<option value="">Select service type</option>
                                            @if(count($service_types) > 0)
                                                @foreach($service_types as $type)
    	                                           <option class="@if($type->type == 1) personal @else buisness @endif" value="{{$type->id}}">{{$type->service_type_name}}</option>
                                               @endforeach
                                            @else
                                            <option disabled="">Not found</option>
                                            @endif
	                                    </select>
	                                </div>
	                            </div>
                                <div class="col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 d-none">
                                            <h5>Pay as usage</h5>
                                            <div class="form-group review_page">
                                                <span class="ext-default reviewpage_toggle active">OFF</span>
                                                <label class="switch">
                                                  <input onchange="usageFunction()" type="checkbox" id="pay_as_usage" class="pay_as_usage" name="pay_as_usage" value="1">
                                                  <span class="slider"></span>
                                                </label>
                                                <span class="text-default reviewpage_toggle">ON</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            @if(Request::get('type')) 
                                                <a class="link" href="{{url('/reviews?type=2')}}"><h5>Do you want to rate a device instead?</h5></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6>Whats included in your plan?</h6>
                            <div class="row mt-1">
                                <div class="col-lg-3">
                                    <h5>Device</h5>
                                    <div class="form-group inputwithicon">
                                        <div class="selectreview">
                                            <select class="brand_select_brand_device device_select" name="device"  data-url="{{url('/searchBrand')}}">
                                                <option value="0">None</option>
                                                @foreach($brands as $v)
                                                    <option value="{{$v->id}}" @if( request()->get('brand_name') ) @if( request()->get('brand_name') == $v->id) selected @endif @endif>{{$v->brand_name}} {{$v->model_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pay_as_usage_class">
                                    <h5>Local Minutes</h5>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control local_min mint_input"  name="local_min" placeholder="Local Minutes" required="required"  maxlength="20" value="100">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Minute</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pay_as_usage_class">
                                    <h5>DataVolume</h5>
                                    <div class="input-group mb-3">
                                    <input type="text" class="form-control datavolume " name="datavolume" placeholder="Data Volume" required="required" maxlength="20" value="2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">DataVolume</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 pay_as_usage_class">
	                                <h5>SMS</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control sms mint_input" name="sms" placeholder="SMS" required="required" value="Unlimited" maxlength="20">		
	                                </div>
	                            </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>How much are you paying</h6>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a href="javascript:void(0)" class="pay_as_model link" onclick="resetUsageButton()">
                                        <h5><u>Is it Pay as you go?</u></h5>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="row mt-1">
                                <div class="col-lg-6">
	                                <h5>How much are you paying monthly  </h5>
	                                <div class="form-group mb-1">
                                        <select class="currency_id">
                                            @foreach($countries as $curr)
                                                @if($curr->currency_code != '' && $curr->currency_code != " ")
                                                    <option @if($curr->code == $usersDetail->country_code)
                                                    selected
                                                    @elseif($curr->country_code == 'US') selected @endif value="{{$curr->id}}">{{$curr->currency_code}}</option>
                                                @endif
                                            @endforeach
                                        </select>
	                                    <input type="text" class="form-control price-box price" name="price" placeholder="Price" required>	
                                        <div class="text-right text-10"><small>Including Tax</small></div>
	                                </div>
	                            </div>
                                <div class="col-lg-6">
                                    <h5>Upfront price</h5>
                                    <div class="form-group mb-1">
                                        <input type="number" class="form-control upfront_price" name="upfront_price" placeholder="Upfront price"  maxlength="20" value="0">	
                                        <div class="text-right text-10"><small>Including Tax</small></div>
                                    </div>	
                                </div>
                            </div>
                            <small>
                                <a href="javascript:void(0);" class="pay_as_usage_class more_info_toggle"><i class="fa fa-angle-down" style="font-size:24px"></i> Would you like to share more optional  information ?</a>
                            </small>
	                        <div class="row mt-1 more_info_section" style="display:none;">
                                <div class="col-lg-3 d-none technology">
                                    <h5>Technology</h5>
                                    <div class="form-group">
                                        <div class="tg-select form-control">
                                            <select class="technology_type" >
                                                <option value="">Select technology</option>
                                                <option value="GPRS">GPRS</option>
                                                <option value="LTE">LTE</option>
                                                <option value="5G">5G</option>
                                            </select>   
                                        </div>     
                                    </div>
                                </div>
	                            <div class="col-lg-3 pay_as_usage_class">
	                                <h5>Long distance  Minutes</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control long_distance_min mint_input" name="long_distance_min" placeholder="Long distance  Min" required="required" value="Unlimited" maxlength="20">		
	                                </div>
	                            </div>
	                            <div class="col-lg-3 pay_as_usage_class">
	                                <h5>International Minutes</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control international_min mint_input" name="international_min" placeholder="International Min" required="required" maxlength="20" value="0">		
	                                </div>
	                            </div>
	                            <div class="col-lg-3 pay_as_usage_class">
	                                <h5>Roaming Minutes</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control roaming_min mint_input" name="roaming_min" placeholder="Roaming Min" required="required" maxlength="20" value="0">		
	                                </div>
	                            </div>
                                <div class="col-lg-3 pay_as_usage_class">
                                    <h5>Would share the overage price?</h5>
                                    <div class="form-group review_page">
                                        <span class="ext-default reviewpage_toggle active">No</span>
                                        <label class="switch">
                                          <input onchange="overageFunction()" type="checkbox" id="overage_price" class="price_overage">
                                          <span class="slider overage_price"></span>
                                        </label>
                                        <span class="text-default reviewpage_toggle">Yes</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="voice_overage_price" id="voice_overage_price">
                            <input type="hidden" name="data_over_age" id="data_over_age">
                            <input type="hidden" name="voice_usage_price" id="voice_usage_price">
                            <input type="hidden" name="data_usage_age" id="data_usage_age">
                            <input type="hidden" name="latitude" id="lat" value="{{$lat}}">
                            <input type="hidden" name="longitude" id="long" value="{{$long}}">
                            <input type="hidden" name="plan_id" id="plan_id" value="">
	                        <div class="row">
                                <div class="col-lg-6">
                                @if(!Request::get('type'))
                                    <div class="back-button">
                                        <button type="button" class="btn btn-sm btn-default back-btn mt-3"><i class="fas fa-angle-left"></i> Back</button>
                                    </div>
                                @endif
                                </div>
	                            <div class="col-lg-6">
	                                <div class="form-group text-right">
	                                    <button type="submit" class="btn btn-primary btn-sm btn-block product-submit-btn">Submit</button>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
                    <!-- End Form Section -->

                    <!-- Star rating section -->
                    <div class="services-rating-section section-d-none section-both" id="rating_section">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="step_three_img text-center">
                                    <img src="{{URL::asset('frontend/assets/img/Waves_iPhone_Case.png')}}"/>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="title-step-1 w-75">
                                    @if(Request::get('type'))
                                        <h1>STEP #2</h1>
                                    @else
                                        <h1>STEP #3</h1>
                                    @endif
                                    <h1>What about Rating Your Service Today?</h1>
                                </div>
                            </div>
                        </div>  
                        <div class="row">
	               		    <div class="heading detail-div">
	               		        <h1 class="section-title">Rating</h1>
	               		    </div>
	               		</div>
                        <div class="row starrating_error d-none">
                            <div class="error">
                                All rating rows are required.
                            </div>
                        </div>
                        @if(count($questions)>0)
                            @foreach($questions as $question)
                                @if($question->type == 1)
        	               		<div class="row">
        	               		    <div class="col-lg-6">
        	               		        <div class="">
        	               		            <h5>{{$question->question}}</h5>
        	               		        </div>
        	               		    </div>
        	               		    <div class="col-lg-6">
                                       <div class="row">
                                            <div class="col-lg-6">
                                            @if($question->text_field == 1)
                                                <div class="form-group mb-2">
                                                    <input type="text" class="form-control" id="text_field_value{{$question->id}}">		
                                                </div>
                                            @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="rating float-right" data-question_id="{{$question->id}}"></div>
                                            </div>
                                       </div>
        	               		    	<!-- <div class="rating coverage" data-rate-value=6></div> -->
        	               		    </div>
        	               		</div>
                                @endif
                            @endforeach
                        @endif
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5>Comment</h5>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="form-group">
                                    <textarea class="form-control" id="comment" placeholder="Write comment here...." rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="font-weight-bold">Average</h5>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <input type="hidden" class="average_input" value="0">
                                <div class="font-weight-bold average_div">0</div>
                            </div>
                        </div>
	               		<div class="row mb-3">
                           <div class="col-lg-6">
                                <div class="back-button">
                                    <button type="button" class="btn btn-sm btn-default back-btn-2 mt-2"><i class="fas fa-angle-left"></i> Back</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-right">
                                    <input type="hidden" name="type" class="plan-type" value="1">
	               		        	<input type="hidden" name="service_id" class="service_id">
                                    <button type="submit" class="btn  btn-sm btn-primary service-rating-submit-btn-add mt-2">Submit</button>
                                    <button type="submit" class="btn  btn-sm btn-primary service-rating-submit-btn d-none">Submit</button>
                                </div>
                            </div>
	               		</div>
	               	</div>
                    <!-- End Star rating section -->

               	</section> 
               	
		    </div>
		</section> 

		<section class="plan-device-sec">
		    <div class="container">
		        <div class="row pt-5 pb-5">
		            <div class="col text-center">
		                <div class="heading">
		                    <h1>Top Rated Carriers in your Area</h1>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
	<!-- Content End Here -->
    <!-- Overage price Modal -->
    <div class="modal fade" id="overage_price_model" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h5>Would share the overage price?</h5>
            <button type="button" class="close" data-dismiss="modal" onclick="resetButton()">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="overage_price_form">
                <div class="row">
                        <div class="col-lg-12">
                            <h5>Voice Overage usage price (<b>Per Min</b>)</h5>
                            <div class="form-group">
                                <input type="text" maxlength="20" id="model_over_price" name="overage_price" class="form-control" placeholder="Voice price" required="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h5>Data Overage usage price (<b>Per MB</b>)</h5>
                            <div class="form-group">
                                <input type="text" maxlength="20" id="model_data_price" name="data_over_age" class="form-control" placeholder="Data price" required="">
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-primary">Ok</button>
                        </div>
                </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!-- Usage Modal -->
    <div class="modal fade" id="usage_price_model" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h5>Pay as usage</h5>
            <button type="button" class="close" data-dismiss="modal" onclick="resetUsageButton()">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="usage_price_form">
                <div class="row">
                    <div class="col-lg-12">
                        <h5>Voice usage price (<b>Per Min</b>)</h5>
                        <div class="form-group">
                            <input type="text" maxlength="20" id="model_usage_price" name="voice_usage_price" class="form-control" placeholder="Voice usage price" required="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h5>Data usage price (<b>Per MB</b>)</h5>
                        <div class="form-group">
                            <input type="text" maxlength="20" id="model_usage_data_price" name="data_usage_age" class="form-control" placeholder="Data usage price" required="">
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Ok</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- User address Modal -->
    <div class="modal fade" id="user_address" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal body -->
          <div class="modal-body">
                <div class="default_adderss">
                    <div class="row">
                        <div class="address_list">
                            <div class="row">
                                @if($userAddress)
                                <div class="col-lg-8">
                                    <div class="address ratingAddressLable">{{$userAddress->formatted_address}}</div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="text-green primary">Primary</div>
                                    <button class="btn btn-primary d-none make_primary_btn" data-address_id="{{$userAddress->id}}">Make primary</button>
                                </div>
                                <input type="hidden" data-id="{{$userAddress->id}}" value="{{$userAddress->id}}" id="user_address_id">
                                <input type="hidden" value="1" id="is_primary">
                                @else
                                    <div class="address">No address found.</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3 confirm_message_section">
                            Do you want to associate this rating with above address ?
                            <div class="confirmation_button text-center mt-3">
                                <button class="btn btn-primary yes">Yes</button>
                                <button class="btn btn-primary no">No</button>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none make_new_address mt-3">
                    <form id="address_form">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Address <span class="text-mute">Optional</span></h5>
                                <div class="form-group">
                                    <input type="text" id="user_full_address" name="user_full_address" class="form-control" placeholder="Address" autocomplete="no">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Country</h5>
                                <div class="form-group country_div" id="country_div">
                                    <input type="text" id="user_country" name="user_country" class="form-control" placeholder="Country" required="" autocomplete="no">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>City</h5>
                                <div class="form-group user_city_add city_div" id="city_div">
                                    <input type="text" id="user_city" name="user_city" class="form-control js-input city_input" placeholder="City" autocomplete="no" required="" data-country="IN">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Postal code</h5>
                                <div class="form-group">
                                    <input type="text" id="user_postal_code" name="user_postal_code" class="form-control" placeholder="Postal code" required="" autocomplete="no">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary save_address">Save</button>
                                <button type="button" class="btn btn-primary cancel">Cancel</button>
                            </div>
                                
                        </div>
                    </form>
                </div>
                <div class="d-none continue-btn-section text-center mt-3">
                    <button class="btn btn-primary">Continue</button>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Speed test Modal -->
    <div class="modal fade" id="speedTestModel" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <!-- Modal body -->
            <div class="modal-body">
                <h4 class="speedTestTitle">We preform live speed test as part of the service review process to obtain more reliable data <br>You can abort this speed test and continue your review if you want</h4>
                <div id="testWrapper" class="text-center">
                    <div id="startStopBtn" onclick="startStop()"></div>
                    <div id="test" class="row">
                        <div class="testGroup col-lg-6">
                            <div class="testArea col-lg-6">
                                <div class="testName">Download</div>
                                <canvas id="dlMeter" class="meter"></canvas>
                                <div id="dlText" class="meterText"></div>
                                <div class="unit">Mbps</div>
                            </div>
                            <div class="testArea col-lg-6">
                                <div class="testName">Upload</div>
                                <canvas id="ulMeter" class="meter"></canvas>
                                <div id="ulText" class="meterText"></div>
                                <div class="unit">Mbps</div>
                            </div>
                        </div>
                        <div class="testGroup col-lg-6">
                            <div class="testArea col-lg-6">
                                <div class="testName">Ping</div>
                                <canvas id="pingMeter" class="meter"></canvas>
                                <div id="pingText" class="meterText"></div>
                                <div class="unit">ms</div>
                            </div>
                            <div class="testArea col-lg-6">
                                <div class="testName">Jitter</div>
                                <canvas id="jitMeter" class="meter"></canvas>
                                <div id="jitText" class="meterText"></div>
                                <div class="unit">ms</div>
                            </div>
                        </div>
                        <div id="ipArea" class="col-lg-12">
                            IP Address: <span id="ip"></span>
                        </div>
                  </div>
                </div>  
                <form id="speedtestForm">
                    <div class="row">
                        <div class="col-lg-6 speedtestDiv">
                            <h5>Downloading speed</h5>
                            <div class="form-group">
                                <input type="text" class="form-control downloading_speed" name="data_speed" id="downloading_speed" placeholder="Downloading speed" maxlength="20">      
                            </div>
                        </div>
                        <div class="col-lg-6 speedtestDiv">
                            <h5>Uploading speed</h5>
                            <div class="form-group">
                                <input type="text" class="form-control uploading_speed" name="uploading_speed" id="uploading_speed" placeholder="Uploading speed" maxlength="20">
                            </div>
                        </div>
                        <input type="hidden" name="plan_id" id="plan_id" class="plan_id">
                        <input type="hidden" name="speedtest_type" id="speedtest_type" value="1">
                            <div id="resultDiv" class="col-lg-12 pt-2 text-center">
                                <button type="submit" class="btn btn-primary rounted continueBtn" >Continue</button>
                                <input type="hidden" id="dspeedhidden"/>
                                <input type="hidden" id="uspeedhidden"/>
                                <input type="hidden" id="pingtimehidden"/>
                                <input type="hidden" id="jittimehidden"/>
                                <!-- <p>Downloading Speed: <span id="dspeed"></span></p>
                                <p>Uploading Speed: <span id="uspeed"></span></p>
                                <p>Ping time: <span id="pingtime"></span></p>
                                <p>Jitter time: <span id="jittertime"></span></p> -->
                            </div>
                    </div>            
                </form>
            </div>
        </div>
      </div>
    </div>
<script src="{{URL::asset('frontend/assets/js/jquery-min.js')}}"></script>
<script src="{{URL::asset('frontend/jsplugins/speedtest/speedtest.js')}}"></script>
<script>
    if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
      $('select').css({padding:"10px 10px"}); 
    }
    $('.more_info_toggle').on('click',function(){
        $('.more_info_section').toggle();
        $('.long_distance_min').focus();
    });
    //   $("a.provider_text_show").on('click',function(){
        function provider_text_show(){
            if ($(".provider_select select").attr("disabled")) {
              
                $('.provider_status').val(1);
                $('.provider_select select').attr('disabled',false);
                $('.provider_select select').attr('required',true);
                $('.provider_select select').addClass('active');
                $('.provider_text input').removeClass('active');
                $('.provider_text input').attr('required',false);
                $('.provider_text').hide();
            } else {
        
                $('.provider_status').val(2);
                $('.provider_select select option').prop('selected',false);
                $('.provider_select select').attr('required',false);
                $('.provider_select select option:nth-child(1)').prop('selected',true);
                $('.provider_select select').attr('disabled',true);
                $('.provider_select select').removeClass('active');
                $('.provider_text input').addClass('active');
                $('.provider_text input').attr('required',true);
                $('.provider_text').show();
            } 
        }
    //   });
    // Brand Section
        // $(".brand_text_show").on('click',function(){
        function brand_text_show(){
            $('.brand_text').toggle();
          if ($("select.brand_select_brand_device").attr("disabled")) {
              $('.brand_status').val(1);
              $('select.brand_select_brand_device').attr('disabled',false);
              $('select.brand_select_brand_device').attr('required',true);
              $('.brand_select_brand_device').addClass('active');
              $('.brand_text input').removeClass('active');
              $('.brand_text input').attr('required',false);
          } else {

              $('.brand_status').val(2);
              $('select.brand_select_brand_device').attr('disabled',true);
              $('select.brand_select_brand_device').attr('required',false);
              $('select.brand_select_brand_device option').prop('selected',false);
              $('select.brand_select_brand_device option:nth-child(1)').prop('selected',true);
              $('.brand_select_brand_device').removeClass('active');
              $('.brand_text input').addClass('active');
              $('.brand_text input').attr('required',true);
          } 
        }
        // });
    // End Brand Section
    
    // Device section  
    // $(".supplier_text_show").on('click',function(){
    function supplier_text_show(){
      if ($(".supplier_select select").attr("disabled")) {
        
          $('.supplier_status').val(1);
          $('.supplier_select select').attr('disabled',false);
          $('.supplier_select select').attr('required',true);
          $('.supplier_select select').addClass('active');
          $('.supplier_text input').removeClass('active');
          $('.supplier_text input').attr('required',false);
          $('.supplier_text').hide();
      } else {

          $('.supplier_status').val(2);
          $('.supplier_select select option').prop('selected',false);
          $('.supplier_select select').attr('required',false);
          $('.supplier_select select option:nth-child(1)').prop('selected',true);
          $('.supplier_select select').attr('disabled',true);
          $('.supplier_select select').removeClass('active');
          $('.supplier_text input').addClass('active');
          $('.supplier_text input').attr('required',true);
          $('.supplier_text').show();
      } 
    }
    // });
    function overageFunction(){
        if(document.getElementById('overage_price').checked){
            $('#overage_price_model').modal({
                show: true
            }); 
        }else{
            $('#overage_price_model').modal({
                show: false
            }); 
        }
    };
    function usageFunction(){
        if(document.getElementById('pay_as_usage').checked){
            $('#usage_price_model').modal({
                show: true
            }); 
        }else{
            $('#usage_price_model').modal({
                show: false
            }); 
        }
    };
    function resetButton(){
        $("#overage_price").trigger('click');
    }
    function resetUsageButton(){
        $("#pay_as_usage").trigger('click');
    }
    $('#model_over_price').on('input', function (event) { 
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
    $('#model_data_price').on('input', function (event) { 
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
    $('#overage_price_form').on('submit',function(){
        if(!$("#overage_price_form").valid()){
            return;
        }
        var model_over_price = $('#model_over_price').val();
        var model_data_price = $('#model_data_price').val();
        if(model_over_price == "" || model_data_price == ""){
            return false;
        }
        $('#voice_overage_price').val(model_over_price);
        $('#data_over_age').val(model_data_price);
        $('#overage_price_model').modal('hide');
        return false;
    });
    $('#usage_price_form').on('submit',function(){
        if(!$("#usage_price_form").valid()){
            return;
        }
        var model_usage_price = $('#model_usage_price').val();
        var model_usage_data_price = $('#model_usage_data_price').val();
        if(model_usage_price == "" || model_usage_data_price == ""){
            return false;
        }
        $('#voice_usage_price').val(model_usage_price);
        $('#data_usage_age').val(model_usage_data_price);
        $('#usage_price_model').modal('hide');
        return false;
    });
    $('.service-rating-submit-btn-add').on('click',function(e){
        e.preventDefault();
        var isset = 0;
        var perams = [];
        $('#rating_section .rating').each(function(index, item){
            var rate = $(item).rate('getValue');
            var question_id = $(item).attr('data-question_id');
            if(rate==0){
                $('.starrating_error').removeClass('d-none');
                setTimeout(function(){
                $('.starrating_error').addClass('d-none');
                },3000);
                isset = 0;
                return false;
            }else{
                isset = 1;
            }
        });
        if(isset == 1){
            $('.save_address').attr('data-type',2);
            $('#user_address').modal({
                show: true
            });
        }
    });
    $('.confirmation_button .yes').on('click',function(e){
        var type = $('.save_address').attr('data-type');
        if(type == 1){
            $('.device-rating-submit-btn').trigger('click');
        }else{
            $('.service-rating-submit-btn').trigger('click');
        }
        $('#user_address').modal('toggle');
    });
    $('.confirmation_button .no').on('click',function(e){
        $('#user_country').val('');
        $('#user_city').val('');
        $('.confirm_message_section').addClass('d-none');
        $('.make_new_address').removeClass('d-none');
        $('#user_address_id').val(0);
        $('#is_primary').val(0);
    });
    $('#address_form .cancel').on('click',function(e){
        $('.confirm_message_section').removeClass('d-none');
        $('.make_new_address').addClass('d-none');
        $('#user_address_id').val($('#user_address_id').attr('data-id'));
        $('#is_primary').val(1);
    });
    $('.save_address').on('click', async function(e){
        e.preventDefault();
        
        if(countrySelection === false){
            $('.country_list').css('display','none');
            $('#country').addClass('error');
            // $('#country').val('');
            if($("#country_div #country-error").length == 0){
                $("#country_div").append('<label id="country-error" class="error" for="country">Pleace select country from a list.</label>');
            }
            return false;
        }
        if(citySelection === false){
            $('.city_list').css('display','none');
            $('#city').addClass('error');
            // $('#city').val('');
            if($("#city_div #city-error").length == 0){
                $("#city_div").append('<label id="city-error" class="error" for="city">Pleace select city from a list.</label>');
            }
            return false;
        }
        
        if(!$("#address_form").valid()){
            return false;
        }else{
            let postal = await valid_postal_code_with_google_api($('#address_form #user_postal_code').val(),$('#address_form #user_country').val(),$('#address_form .city_input').val());
            if(!postal['status']){
                if(!$('#address_form #user_postal_code').hasClass('error')){
                    $('#address_form #user_postal_code').addClass('error');
                    $('#address_form #user_postal_code').after('<label id="postal_code-error" class="error" for="postal_code">Postal code is invalid, Please select valid postal code</label>');
                }
                return false;
            }
            // let postal = valid_postal_code($('#address_form #user_postal_code').val(),$('#address_form .city_input').attr('data-country'));
           
            var user_full_address = $('#user_full_address').val();
            var user_city = $('#user_city').val();
            var user_country = $('#user_country').val();
            var user_postal_code = $('#user_postal_code').val();
            var is_primary = $('#is_primary').val();
            var user_address_id = $('#user_address_id').val();
            var formatted_address = user_full_address+' '+user_city+' '+user_country+' '+user_postal_code;
            // alert(formatted_address);
            $('.address_list').append('<div class="row mt-2 border-top pt-2"><div class="col-lg-8"> <div class="address">'+formatted_address+'</div></div><div class="col-lg-4 text-right"> <div class="text-green primary d-none">Primary</div><button class="btn btn-primary make_primary_btn" data-address_id="0">Make primary</button> </div></div>');
            $('.make_new_address').addClass('d-none');
            $('.continue-btn-section').removeClass('d-none');
        }       
    });
    $(document).on('click','.make_primary_btn',function(){
        var address_id = $(this).attr('data-address_id');
        console.log(address_id);
        if(address_id==0){
            $('.primary').hide();
            $('.make_primary_btn').removeClass('d-none');
            $('.make_primary_btn').show();
            $(this).hide();
            $(this).prev('.primary').removeClass('d-none');
            $(this).prev('.primary').show();
            $('#user_address_id').val(address_id);
            $('#is_primary').val(1);
        }else{
            $('.primary').hide();
            $('.make_primary_btn').removeClass('d-none');
            $('.make_primary_btn').show();
            $(this).hide();
            $(this).prev('.primary').removeClass('d-none');
            $(this).prev('.primary').show();
            $('#user_address_id').val(address_id);
            $('#is_primary').val(1);
        }     
    });
    $('.continue-btn-section button').on('click',function(){
        var type = $('.save_address').attr('data-type');
        if(type == 1){
            $('.device-rating-submit-btn').trigger('click');
        }else{
            $('.service-rating-submit-btn').trigger('click');
        }
        $('#user_address').modal('toggle');
    });
    $('.pay_as_usage').on('change',function(){
        $(".reveiewing_form_service").validate({
            rules: {
                price: {
                  required: true,
                  number: true
                }
              }
          });
        if($(this).prop("checked") == true){ 
            $('.pay_as_usage_class').hide();
            $('.pay_as_usage_class input').removeAttr('required');
        }else{
            $('.pay_as_usage_class').show();
            $('.pay_as_usage_class input').attr('required',true);
        }
    });
    $('.service_type').on('change', function (e) {
       var optionSelected = $("option:selected", this);
       var valueSelected = this.value;
       if(valueSelected == 5){
        $('.technology').removeClass('d-none');
       }else{
        $(".technology option:selected").removeAttr("selected");
        $(".technology option:nth-child(1)").attr("selected");
        $('.technology').addClass('d-none');
       }
    });


    function speedTestFunction(){
        $('#speedTestModel').modal({
            show: true
        });
        $('#speedtest_type').val(1);
        $('.speedtestDiv').hide();
        setTimeout(function(){
            startStop();
        },1000);
    }
    function hideSpeedTestModal(){
        $('.speedtestDiv').show();
        $('#speedtest_type').val(0);
        $('.speedtestDiv input').val('');
    }
    function showhideContinueBtn($type){
        if($type == 1){
            $('.continueBtn').hide();
            $('.speedtestDiv').hide();
        }else{
            $('.speedtestshow').show();
            $('.continueBtn').show();
        }
    }
    // Speed Test Sections 
        function I(i){return document.getElementById(i);}
        //INITIALIZE SPEEDTEST
        var s=new Speedtest(); //create speedtest object

        var meterBk=/Trident.*rv:(\d+\.\d+)/i.test(navigator.userAgent)?"#EAEAEA":"#80808040";
        var dlColor="#6060AA",
            ulColor="#309030",
            pingColor="#AA6060",
            jitColor="#AA6060";
        var progColor=meterBk;

        //CODE FOR GAUGES
        function drawMeter(c,amount,bk,fg,progress,prog){
            var ctx=c.getContext("2d");
            var dp=window.devicePixelRatio||1;
            var cw=c.clientWidth*dp, ch=c.clientHeight*dp;
            var sizScale=ch*0.0055;
            if(c.width==cw&&c.height==ch){
                ctx.clearRect(0,0,cw,ch);
            }else{
                c.width=cw;
                c.height=ch;
            }
            ctx.beginPath();
            ctx.strokeStyle=bk;
            ctx.lineWidth=12*sizScale;
            ctx.arc(c.width/2,c.height-58*sizScale,c.height/1.8-ctx.lineWidth,-Math.PI*1.1,Math.PI*0.1);
            ctx.stroke();
            ctx.beginPath();
            ctx.strokeStyle=fg;
            ctx.lineWidth=12*sizScale;
            ctx.arc(c.width/2,c.height-58*sizScale,c.height/1.8-ctx.lineWidth,-Math.PI*1.1,amount*Math.PI*1.2-Math.PI*1.1);
            ctx.stroke();
            if(typeof progress !== "undefined"){
                ctx.fillStyle=prog;
                ctx.fillRect(c.width*0.3,c.height-16*sizScale,c.width*0.4*progress,4*sizScale);
            }
        }
        function mbpsToAmount(s){
            return 1-(1/(Math.pow(1.3,Math.sqrt(s))));
        }
        function msToAmount(s){
            return 1-(1/(Math.pow(1.08,Math.sqrt(s))));
        }

        //UI CODE
        var uiData=null;
        function startStop(){
            showhideContinueBtn(1)
            if(s.getState()==3){
                //speedtest is running, abort
                s.abort();
                data=null;
                I("startStopBtn").className="";
                initUI();
                hideSpeedTestModal();
            }else{
                I("speedtest_type").value ='1';
                //test is not running, begin
                I("startStopBtn").className="running";
                s.onupdate=function(data){
                    uiData=data;
                };
                s.onend=function(aborted){
                    showhideContinueBtn(2);
                    // var pingtimehidden = I('pingtimehidden').value;

                    // if(pingtimehidden != ""){
                    //     I('pingtime').textContent = pingtimehidden;
                    // }
                    // var jittimehidden = I('jittimehidden').value;

                    // if(jittimehidden != ""){
                    //     I('jittertime').textContent = jittimehidden;
                    // }
                    I("startStopBtn").className="";
                    updateUI(true);
                };
                s.start();
            }
        }
        //this function reads the data sent back by the test and updates the UI
        function updateUI(forced){
            if(!forced&&s.getState()!=3) return;
            if(uiData==null) return;
            var status=uiData.testState;
            I("ip").textContent=uiData.clientIp;
            I("dlText").textContent=(status==1&&uiData.dlStatus==0)?"...":uiData.dlStatus;
            I("downloading_speed").value=(status==1&&uiData.dlStatus==0)?"...":uiData.dlStatus;
            drawMeter(I("dlMeter"),mbpsToAmount(Number(uiData.dlStatus*(status==1?oscillate():1))),meterBk,dlColor,Number(uiData.dlProgress),progColor);
            I("ulText").textContent=(status==3&&uiData.ulStatus==0)?"...":uiData.ulStatus;
            I("uploading_speed").value=(status==3&&uiData.ulStatus==0)?"...":uiData.ulStatus;
            drawMeter(I("ulMeter"),mbpsToAmount(Number(uiData.ulStatus*(status==3?oscillate():1))),meterBk,ulColor,Number(uiData.ulProgress),progColor);
            I("pingText").textContent=uiData.pingStatus;
            I("pingtimehidden").value=uiData.pingStatus;
            drawMeter(I("pingMeter"),msToAmount(Number(uiData.pingStatus*(status==2?oscillate():1))),meterBk,pingColor,Number(uiData.pingProgress),progColor);
            I("jitText").textContent=uiData.jitterStatus;
            I("jittimehidden").value=uiData.jitterStatus;
            drawMeter(I("jitMeter"),msToAmount(Number(uiData.jitterStatus*(status==2?oscillate():1))),meterBk,jitColor,Number(uiData.pingProgress),progColor);
        }
        function oscillate(){
            return 1+0.02*Math.sin(Date.now()/100);
        }
        //update the UI every frame
        window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame||(function(callback,element){setTimeout(callback,1000/60);});
        function frame(){
            requestAnimationFrame(frame);
            updateUI();
        }
        frame(); //start frame loop
        //function to (re)initialize UI
        function initUI(){
            drawMeter(I("dlMeter"),0,meterBk,dlColor,0);
            drawMeter(I("ulMeter"),0,meterBk,ulColor,0);
            drawMeter(I("pingMeter"),0,meterBk,pingColor,0);
            drawMeter(I("jitMeter"),0,meterBk,jitColor,0);
            I("dlText").textContent="";
            I("ulText").textContent="";
            I("pingText").textContent="";
            I("jitText").textContent="";
            I("ip").textContent="";
        }
    // End Speed Test Sections 

    // Device Section 
    $('.device-rating-submit-btn-add').on('click',function(e){
        e.preventDefault();
        var isset = 0;
        var perams = [];
        $('#device_rating_section .device-rating').each(function(index, item){
            var rate = $(item).rate('getValue');
            var question_id = $(item).attr('data-question_id');
            if(rate==0){
                $('.device_starrating_error').removeClass('d-none');
                setTimeout(function(){
                $('.device_starrating_error').addClass('d-none');
                },3000);
                isset = 0;
                return false;
            }else{
                isset = 1;
            }
        });
        if(isset == 1){
            $('.save_address').attr('data-type',1);
            $('#user_address').modal({
                show: true
            });
        }
    });
    // End Device section


    // Device search Section  
	    // Select Box of model
        $(document).on('click','.dropdown-select ul li',function(){
                var brandId = $(this).attr('data-value');
                if(window.location.protocol == "http:"){
                    resuesturl = "{{url('/getBrandColor')}}"
                }else if(window.location.protocol == "https:"){
                    resuesturl = "{{secure_url('/getBrandColor')}}"
                }
                $.ajax({
                    type: "post",
                    url: resuesturl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:'json',
                    data: {
                    id:brandId
                    },
                    success: function (data) {
                        $('#device_color').html('');
                        if(data.success){
                        var colors = data.data;
                        
                        if(colors != ''){
                            for(var i=0; i <= colors.length;i++){
                            $('#device_color').append('<option value="'+colors[i].id+'">'+colors[i].color_name+'</option>');
                            }
                        }else{
                            $('#device_color').append('<option value="">Color</option>');
                        }
                        }else{

                        }
                    }         
                });
            });
        function create_custom_dropdowns() {
            $('.brand_select_brand_device').each(function (i, select) {
                if (!$(this).next().hasClass('dropdown-select')) {
                    $(this).after('<div class="dropdown-select wide ' + ($(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
                    var dropdown = $(this).next();
                    var options = $(select).find('option');
                    var selected = $(this).find('option:selected');
                    dropdown.find('.current').html(selected.data('display-text') || selected.text());
                    options.each(function (j, o) {
                        var display = $(o).data('display-text') || '';
                        dropdown.find('ul').append('<li class="option ' + ($(o).is(':selected') ? 'selected' : '') + '" data-value="' + $(o).val() + '" data-display-text="' + display + '">' + $(o).text() + '</li>');
                    });
                }
            });

            $('.dropdown-select ul').before('<div class="dd-search"><input autocomplete="no" onkeyup="filter(event)" class="dd-searchbox txtSearchValue" type="text"></div>');
        }

        // Event listeners

        // Open/close
        $(document).on('click', '.dropdown-select', function (event) {
            if($(event.target).hasClass('dd-searchbox')){
                return;
            }
            $('.dropdown-select').not($(this)).removeClass('open');
            $(this).toggleClass('open');
            if ($(this).hasClass('open')) {
                $(this).find('.option').attr('tabindex', 0);
                $(this).find('.selected').focus();
            } else {
                $(this).find('.option').removeAttr('tabindex');
                $(this).focus();
            }
        });

        // Close when clicking outside
        $(document).on('click', function (event) {
            if ($(event.target).closest('.dropdown-select').length === 0) {
                $('.dropdown-select').removeClass('open');
                $('.dropdown-select .option').removeAttr('tabindex');
            }
            event.stopPropagation();
        });

        function filter(event){
            
            var actionurl = $('.brand_select_brand_device').attr('data-url');
            var valThis = event.target.value;
            $.ajax({
                url:actionurl,
                type: "GET",
                dataType: "json",
                data: {
                    search:valThis
                },
                success: function(response){
                    var allData = response.data;
                    $('.dropdown-select.wide .list').find('ul').html('');
                    if(allData){
                        for (let index = 0; index < allData.length; index++) {
                            const text = allData[index];
                            $('.dropdown-select.wide .list').find('ul').append('<li class="option" data-value="' + text.id + '" data-display-text="">' + text.brand_name+' '+text.model_name + '</li>');
                        }
                        
                    }
                    
                }
            });
            $('.dropdown-select ul > li').each(function(){
            var text = $(this).text();
                (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show() : $(this).hide();         
            });
            
        };
        // Search

        // Option click
        $(document).on('click', '.dropdown-select .option', function (event) {
            $(this).closest('.list').find('.selected').removeClass('selected');
            $(this).addClass('selected');
            var text = $(this).data('display-text') || $(this).text();
            $(this).closest('.dropdown-select').find('.current').text(text);
            $(this).closest('.dropdown-select').prev('select').val($(this).data('value')).trigger('change');
        });

        // Keyboard events
        $(document).on('keydown', '.dropdown-select', function (event) {
            var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
            // Space or Enter
            //if (event.keyCode == 32 || event.keyCode == 13) {
            if (event.keyCode == 13) {
                if ($(this).hasClass('open')) {
                    focused_option.trigger('click');
                } else {
                    $(this).trigger('click');
                }
                return false;
                // Down
            } else if (event.keyCode == 40) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    focused_option.next().focus();
                }
                return false;
                // Up
            } else if (event.keyCode == 38) {
                if (!$(this).hasClass('open')) {
                    $(this).trigger('click');
                } else {
                    var focused_option = $($(this).find('.list .option:focus')[0] || $(this).find('.list .option.selected')[0]);
                    focused_option.prev().focus();
                }
                return false;
                // Esc
            } else if (event.keyCode == 27) {
                if ($(this).hasClass('open')) {
                    $(this).trigger('click');
                }
                return false;
            }
        });

        $(document).ready(function () {
            create_custom_dropdowns();
        });

    // End Device search Section  


</script>

@endsection