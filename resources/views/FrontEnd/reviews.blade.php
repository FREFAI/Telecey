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
</style>
	<!-- Content Start Here -->
		<div class="page-header inner-page start-page" style="background: url({{URL::asset('frontend/assets/img/bg-1.jpeg')}});">
		    <div class="container-fluid">
		        <div class="row">
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
		        </div>
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
	                                    <input id="country" class="input-text js-input" type="text" required value="{{$usersDetail->country}}" name="country" autocomplete="off">
	                                    <label class="label" for="name">Country</label>
	                                </div>
	                                <div class="form-field col-lg-6 city_div" id="city_div">
	                                    <input id="city" class="input-text js-input city_input" type="text" required value="{{$usersDetail->city}}" name="city"  autocomplete="off" data-country="{{$usersDetail->country_code}}">
	                                    <label class="label" for="name">City</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="email" class="input-text js-input" type="email" value="{{$usersDetail->email}}" disabled="">
	                                    <label class="label" for="email">E-mail</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                        <input id="postal_code" class="input-text js-input" type="text" value="{{$usersDetail->postal_code}}" name="postal_code">
	                                        <label class="label" for="number">Postal Code</label>
	                                    </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="mobile_number" class="input-text js-input" type="text" value="{{$usersDetail->mobile_number}}" name="mobile_number">
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
		    <div class="container">
                @if(!Request::get('type'))
	           	<form class="get-in-touch detail-section pt-4 mt-5 mb-5">
	                <div class="row">
	                    <div class="heading detail-div">
	                        <h1 class="section-title">What your are reveiewing today?</h1>
	                    </div>
	                </div>
	                <div class="row">
                        @if($settings->device == 1)
	                    <div class="col-lg-6 col text-center">
	                        <div class="button-product">
	                            <label class="text-product"><input @if(Request::get('type') == 2) checked="checked" @endif type="radio" class="radio-inline select_one" name="radios" value="product-section"><span class="outside"><span class="inside"></span></span>Devices</label>
	                        </div>
	                    </div>
                        @endif
	                    <div class="@if($settings->device == 1) col-lg-6  @else  col-lg-12 @endif col text-center">
	                        <div class="button-service">
	                            <label class="text-product"><input type="radio" class="radio-inline select_one" name="radios" value="services-section" @if(Request::get('type') == 1) checked="checked" @endif @if($settings->device == 0) checked="" @endif><span class="outside"><span class="inside"></span></span>Plans</label>
	                        </div>
	                    </div>
	                </div>
	            </form> 
                @endif
                <!-- Device section  -->
                <section class="product-section @if(Request::get('type') == 1) section-d-none @endif @if(!Request::get('type')) section-d-none @endif section-both">
                <form id="device_rating_form" method="post" action="javascript:void(0);">
                   <div class="row mt-3">
                       <div class="col-lg-6 ">
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
                       <div class="col-lg-6 ">
                            <h5>Brand</h5>
                            <div class="tg-select form-control brand_select">
                                 <select class="brand_name active" required="required" name="brand_name" id="brand">
                                    @if(count($brands) > 0)
                                        <option value="">Choose brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brand_name}} {{$brand->model_name}}</option>
                                    @endforeach
                                    @else
                                        <option value="">No data found.</option>
                                    @endif
                                 </select>
                             </div>
                              <div class="form-group brand_text">
                                  <input type="text" class="form-control brand_name text_brand_name" name="brand_name" placeholder="Brand name" maxlength="30">  
                                  <br>    
                                  <input type="text" class="form-control model_name text_model_name" name="model_name" placeholder="Model name" maxlength="30">      
                                  <input type="hidden" class="form-control brand_status" name="brand_status" placeholder="Brand status" value="1">      
                              </div>
                             <small>
                                <a href="javascript:void(0)" class="brand_text_show">Couldn't find your brand</a>
                             </small>
                        </div>
                   </div>
                   <div class="row mt-3">
                        <div class="col-lg-6 ">
                            <h5>Price</h5>
                            <div class="form-group">
                                <select class="form-control currency_id">
                                    @foreach($countries as $curr)
                                        @if($curr->currency_code != '' && $curr->currency_code != " ")
                                            <option @if($curr->code == $usersDetail->country_code)
                                            selected
                                            @elseif($curr->country_code == 'US') selected @endif value="{{$curr->id}}">{{$curr->currency_code}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="text" class="form-control price-box device-price" name="price" placeholder="Price" required id="price">  
                                <small>Including Tax</small>    
                            </div>
                        </div>
                        <div class="col-lg-6">
                             <h5>Supplier</h5>
                             <div class="tg-select form-control supplier_select">
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
                              <div class="form-group supplier_text">
                                  <input type="text" class="form-control supplier_name text_supplier_name" name="supplier_name" placeholder="Supplier name" maxlength="30">      
                                  <input type="hidden" class="form-control supplier_status" name="supplier_status" placeholder="Supplier status" value="1">      
                              </div>
                             <small>
                                <a href="javascript:void(0)" class="supplier_text_show">Couldn't find your supplier</a>
                             </small>
                         </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h5>Capacity</h5>
                            <div class="tg-select form-control">
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
                        <div class="col-lg-6">
                            <a  href="{{url('/reviews?type=1')}}"><h5>Do you want to rate a plan instead?</h5></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group w-50 ml-auto mr-auto text-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block product-submit-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Star rating section -->
                <div class="services-rating-section section-d-none section-both" id="device_rating_section">
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
                                    <div class="rating float-right device-rating" data-question_id="{{$question->id}}"></div>
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
                        <div class="col-lg-12">
                            <div class="form-group w-50 ml-auto mr-auto text-center">
                                <input type="hidden" name="type" class="device-type" value="2">
                                <input type="hidden" name="device_id" class="device_id">
                                <button type="submit" class="btn  btn-lg btn-primary device-rating-submit-btn-add">Submit</button>
                                <button type="submit" class="btn  btn-lg btn-primary device-rating-submit-btn d-none">Submit</button>                                    
                            </div>
                        </div>
                    </div>
                </div>
               	</section>
                <!-- End product section  -->
                <!-- Plan Section -->
                <section class="services-section  @if(Request::get('type') == 2) section-d-none @endif @if(!Request::get('type'))  @if($settings->device == 1) section-d-none @endif @endif  section-both">
                    <!-- Form Section  -->
                	<div class="service_form_section">
	                	<form class="reveiewing_form_service">
	                    	<div class="row mt-3">
	                     
	                            <div class="col-lg-6 ">
	                                <h5>Provider Name</h5>
	                                <div class="tg-select form-control provider_select">
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
                                    <div class="form-group provider_text">
                                        <input type="text" class="form-control provider_name text_provider_name" name="provider_name" placeholder="Provider name" maxlength="30">      
                                        <input type="hidden" class="form-control provider_status" name="provider_status" placeholder="Provider status">      
                                    </div>
	                                 <small>
	                                 	<a href="javascript:void(0)" class="provider_text_show">Couldn't find your Service provider</a>
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
	                        <div class="row mt-3">

	                            <div class="col-lg-6">
	                                <h5>How much are you paying monthly multi currencies should be supported </h5>
	                                <div class="form-group">
                                        <select class="form-control currency_id">
                                            @foreach($countries as $curr)
                                                @if($curr->currency_code != '' && $curr->currency_code != " ")
                                                    <option @if($curr->code == $usersDetail->country_code)
                                                    selected
                                                    @elseif($curr->country_code == 'US') selected @endif value="{{$curr->id}}">{{$curr->currency_code}}</option>
                                                @endif
                                            @endforeach
                                        </select>
	                                    <input type="text" class="form-control price-box price" name="price" placeholder="Price" required>	
                                        <small>Including Tax</small>	
	                                </div>
	                            </div>
                                <div class="col-lg-6">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
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
                                            <a  href="{{url('/reviews?type=2')}}"><h5>Do you want to rate a device instead?</h5></a>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-6">
                                    <h5>Payment type</h5>
                                    <div class="form-group review_page">
                                        <span class="ext-default reviewpage_toggle active">Postpaid</span>
                                        <label class="switch">
                                          <input type="checkbox" id="payment_type" class="payment_type" name="payment_type">
                                          <span class="slider"></span>
                                        </label>
                                        <span class="text-default reviewpage_toggle">Prepaid</span>
                                    </div>
                                </div> -->
	                        </div>
	                        <div class="row">
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
                                <div class="col-lg-6 d-none technology">
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
	                            <div class="col-lg-6 pay_as_usage_class">
                                    <h5>Local Minutes</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control local_min mint_input" name="local_min" placeholder="Local Minutes" required="required"  maxlength="20" value="100">		
                                            </div>
                                        </div>
                                        <div class="col-lg-2">                                     
                                            <div class="form-group">
                                                <input type="text" class="form-control" required="required"  maxlength="20" value="Minute" readonly>		
                                            </div>
                                        </div>
                                    </div>
	                                {{-- <div class="form-group">
	                                    <input type="text" class="form-control local_min mint_input" name="local_min" placeholder="Local Min" required="required"  maxlength="20" value="Unlimited">		
	                                </div> --}}
	                            </div>
	                            <div class="col-lg-6 pay_as_usage_class">
                                    <h5>DataVolume</h5>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control datavolume " name="datavolume" placeholder="Data Volume" required="required" maxlength="20" value="2">		
                                            </div>
                                        </div>
                                        <div class="col-lg-2">                                     
                                            <div class="form-group">
                                                <input type="text" class="form-control datavolume" placeholder="DataVolume" required="required" maxlength="20" value="GB" readonly>		
                                            </div>
                                        </div>
                                    </div>
	                            </div>
	                            <div class="col-lg-6 pay_as_usage_class">
	                                <h5>Long distance  Minutes</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control long_distance_min mint_input" name="long_distance_min" placeholder="Long distance  Min" required="required" value="Unlimited" maxlength="20">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 pay_as_usage_class">
	                                <h5>International Minutes</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control international_min mint_input" name="international_min" placeholder="International Min" required="required" maxlength="20" value="0">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 pay_as_usage_class">
	                                <h5>Roaming Minutes</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control roaming_min mint_input" name="roaming_min" placeholder="Roaming Min" required="required" maxlength="20" value="0">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 pay_as_usage_class">
	                                <h5>SMS</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control sms mint_input" name="sms" placeholder="SMS" required="required" value="Unlimited" maxlength="20">		
	                                </div>
	                            </div>
                                <div class="col-lg-6 pay_as_usage_class">
                                    <h5>Would share the overage price?</h5>
                                    <div class="form-group review_page">
                                        <span class="ext-default reviewpage_toggle active">No</span>
                                        <label class="switch">
                                          <input onchange="overageFunction()" type="checkbox" id="overage_price" class="price_overage">
                                          <span class="slider overage_price"></span>
                                        </label>
                                        <span class="text-default reviewpage_toggle">Yes</span>
                                    </div>
                                    <input type="hidden" name="voice_overage_price" id="voice_overage_price">
                                    <input type="hidden" name="data_over_age" id="data_over_age">
                                    <input type="hidden" name="voice_usage_price" id="voice_usage_price">
                                    <input type="hidden" name="data_usage_age" id="data_usage_age">
                                    <input type="hidden" name="latitude" id="lat" value="{{$lat}}">
                                    <input type="hidden" name="longitude" id="long" value="{{$long}}">
                                </div>
                                <!-- <div class="col-lg-6 mt-3">
                                    <div class="speedtestpopuplink">
                                        <a href="javascript:void(0);" onclick="speedTestFunction()" data-toggle="modal" data-target="#speedTestModel">Do you want to perform speedtest ?</a>
                                    </div>
                                </div> -->
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-12">
	                                <div class="form-group w-50 ml-auto mr-auto text-center">
	                                    <button type="submit" class="btn btn-primary btn-lg btn-block product-submit-btn">Submit</button>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
                    <!-- End Form Section -->

                    <!-- Star rating section -->
                    <div class="services-rating-section section-d-none section-both" id="rating_section">
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
        	               		    	<div class="rating float-right" data-question_id="{{$question->id}}"></div>
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
	               		<div class="row">
	               		    <div class="col-lg-12">
	               		        <div class="form-group w-50 ml-auto mr-auto text-center">
                                    
                                    <input type="hidden" name="type" class="plan-type" value="1">
	               		        	<input type="hidden" name="service_id" class="service_id">
                                    <button type="submit" class="btn  btn-lg btn-primary service-rating-submit-btn-add">Submit</button>
                                    <button type="submit" class="btn  btn-lg btn-primary service-rating-submit-btn d-none">Submit</button>                                    
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
            <h4 class="modal-title">Would share the overage price?</h4>
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
            <h4 class="modal-title">Pay as usage</h4>
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
                                    <div class="address">{{$userAddress->formatted_address}}</div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="text-green primary">Primary</div>
                                    <button class="btn btn-primary d-none make_primary_btn" data-address_id="{{$userAddress->id}}">Make primary</button>
                                </div>
                                <input type="hidden" value="{{$userAddress->id}}" id="user_address_id">
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
                                <h5>Address</h5>
                                <div class="form-group">
                                    <input type="text" id="user_full_address" name="user_full_address" class="form-control" placeholder="Address" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Country</h5>
                                <div class="form-group country_div" id="country_div">
                                    <input type="text" id="user_country" name="user_country" class="form-control" placeholder="Country" required="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>City</h5>
                                <div class="form-group user_city_add city_div" id="city_div">
                                    <input type="text" id="user_city" name="user_city" class="form-control js-input city_input" placeholder="City" autocomplete="off" required="" data-country="IN">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Postal code</h5>
                                <div class="form-group">
                                    <input type="text" id="user_postal_code" name="user_postal_code" class="form-control" placeholder="Postal code" required="">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary save_address">Save</button>
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
                                <input type="text" class="form-control downloading_speed" name="data_speed" id="downloading_speed" placeholder="Downloading speed" required="required" maxlength="20">      
                            </div>
                        </div>
                        <div class="col-lg-6 speedtestDiv">
                            <h5>Uploading speed</h5>
                            <div class="form-group">
                                <input type="text" class="form-control uploading_speed" name="uploading_speed" id="uploading_speed" placeholder="Uploading speed" required="required" maxlength="20">
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
    // function add(ths,sno){
    //     for (var i=1;i<=5;i++){
    //         var cur=document.getElementById("star"+i)
    //         cur.className="fa fa-star"
    //     }
    
    //     for (var i=1;i<=sno;i++){
    //         var cur=document.getElementById("star"+i)
    //         if(cur.className=="fa fa-star")
    //         {
    //             cur.className="fa fa-star checked"
    //         }
    //     }
    // }
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
        $('.confirm_message_section').addClass('d-none');
        $('.make_new_address').removeClass('d-none');
        $('#user_address_id').val(0);
        $('#is_primary').val(0);
    });
    $('.save_address').on('click',function(e){
        e.preventDefault();
        if(!$("#address_form").valid()){
            return false;
        }else{
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
</script>

@endsection