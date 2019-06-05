@extends('layouts.frontend_layouts.frontend')
@section('content')

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
		        <div class="row">
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
		            </div>
		    </div>
		</div>
		<!-- intro section -->
		<section class="intro-section section-d-none">
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
	                                <div class="form-field col-lg-6">
	                                    <input id="country" class="input-text js-input" type="text" value="{{$usersDetail->country}}" name="country">
	                                    <label class="label" for="name">Country</label>
	                                </div>
	                                <div class="form-field col-lg-6">
	                                    <input id="city" class="input-text js-input" type="text" value="{{$usersDetail->city}}" name="city">
	                                    <label class="label" for="name">City</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="email" class="input-text js-input" type="email" value="{{$usersDetail->email}}" disabled="">
	                                    <label class="label" for="email">E-mail</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                        <input id="postal_code" class="input-text js-input" type="number" value="{{$usersDetail->postal_code}}" name="postal_code">
	                                        <label class="label" for="number">Postal Code</label>
	                                    </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="mobile_number" class="input-text js-input" type="text" value="{{$usersDetail->mobile_number}}" name="mobile_number">
	                                    <label class="label" for="phone">Contact Number</label>
	                                </div>
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
		<!-- end-intro-section -->
		<!-- share-serv-detail -->
		<section class="service-detail section-d-none">
		    <div class="container">
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
	                            <label class="text-product"><input type="radio" class="radio-inline select_one" name="radios" value="product-section"><span class="outside"><span class="inside"></span></span>Devices</label>
	                        </div>
	                    </div>
                        @endif
	                    <div class="@if($settings->device == 1) col-lg-6  @else  col-lg-12 @endif col text-center">
	                        <div class="button-service">
	                            <label class="text-product"><input type="radio" class="radio-inline select_one" name="radios" value="services-section" @if($settings->device == 0) checked="" @endif><span class="outside"><span class="inside"></span></span>Plans</label>
	                        </div>
	                    </div>
	                </div>
	            </form> 
                <section class="product-section section-d-none section-both">
                   <div class="row mt-3">
                       <div class="col-lg-6 ">
                           <h5>Which Device</h5>
                           <div class="tg-select form-control">
                                <select>
                                    <option value="none">Phone</option>
                                    <option value="none">Tablite</option>
                                    <option value="none">Modem</option>
                                    <option value="none">Accessories</option>
                                </select>
                            </div>
                       </div>
                       <div class="col-lg-6 ">
                            <h5>Brand</h5>
                            <div class="tg-select form-control">
                                 <select>
                                     <option value="none">Apple</option>
                                     <option value="none">MI</option>
                                     <option value="none">Samsung</option>
                                     <option value="none">HTC</option>
                                     <option value="none">Nokia</option>
                                 </select>
                             </div>
                        </div>
                   </div>
                   <div class="row mt-3">
                        <div class="col-lg-6 ">
                            <h5>Price</h5>
                            <div class="form-group">
                                    <input type="number" class="form-control price-box" name="price" placeholder="Price" required="required">		
                                </div>
                        </div>
                        <div class="col-lg-6">
                             <h5>Model</h5>
                             <div class="tg-select form-control">
                                  <select>
                                      <option value="none">Apple</option>
                                      <option value="none">MI</option>
                                      <option value="none">Samsung</option>
                                      <option value="none">HTC</option>
                                      <option value="none">Nokia</option>
                                  </select>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Capacity</h5>
                            <div class="tg-select form-control">
                                <select>
                                    <option value="none">64</option>
                                    <option value="none">128</option>
                                    <option value="none">256</option>
                                    <option value="none">512</option>
                                    <option value="none">1GB</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group w-50 ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-lg btn-block product-submit-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="heading detail-div">
                            <h1 class="section-title">Rating</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="">
                                <h5>Are you happy with the device</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">
                                <span class="fa fa-star rate checked" id="star1" onclick="add(this,1)"></span>
                                <span class="fa fa-star rate checked" id="star2" onclick="add(this,2)"></span>
                                <span class="fa fa-star rate checked" id="star3" onclick="add(this,3)"></span>
                                <span class="fa fa-star rate" id="star4" onclick="add(this,4)"></span>
                                <span class="fa fa-star rate" id="star5" onclick="add(this,5)"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="">
                                <h5>Rate the operating system</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">
                                <span class="fa fa-star rate checked" id="star1" onclick="add(this,1)"></span>
                                <span class="fa fa-star rate checked" id="star2" onclick="add(this,2)"></span>
                                <span class="fa fa-star rate " id="star3" onclick="add(this,3)"></span>
                                <span class="fa fa-star rate" id="star4" onclick="add(this,4)"></span>
                                <span class="fa fa-star rate" id="star5" onclick="add(this,5)"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="">
                                <h5>How is you batters  Can you say how much it last for an average</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">
                                <span class="fa fa-star rate checked" id="star1" onclick="add(this,1)"></span>
                                <span class="fa fa-star rate checked" id="star2" onclick="add(this,2)"></span>
                                <span class="fa fa-star rate checked" id="star3" onclick="add(this,3)"></span>
                                <span class="fa fa-star rate checked" id="star4" onclick="add(this,4)"></span>
                                <span class="fa fa-star rate" id="star5" onclick="add(this,5)"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="">
                                <h5>How isit with charging</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">
                                <span class="fa fa-star rate checked" id="star1" onclick="add(this,1)"></span>
                                <span class="fa fa-star rate checked" id="star2" onclick="add(this,2)"></span>
                                <span class="fa fa-star rate" id="star3" onclick="add(this,3)"></span>
                                <span class="fa fa-star rate " id="star4" onclick="add(this,4)"></span>
                                <span class="fa fa-star rate" id="star5" onclick="add(this,5)"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="">
                                <h5>Rate the screen ( Images display clarety , Sensitivity)</h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">
                                <span class="fa fa-star rate checked" id="star1" onclick="add(this,1)"></span>
                                <span class="fa fa-star rate" id="star2" onclick="add(this,2)"></span>
                                <span class="fa fa-star rate" id="star3" onclick="add(this,3)"></span>
                                <span class="fa fa-star rate " id="star4" onclick="add(this,4)"></span>
                                <span class="fa fa-star rate" id="star5" onclick="add(this,5)"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5>Rates Coverage</h5>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <span class="fa fa-star rate checked" id="star1" onclick="add(this,1)"></span>
                                    <span class="fa fa-star rate checked" id="star2" onclick="add(this,2)"></span>
                                    <span class="fa fa-star rate checked" id="star3" onclick="add(this,3)"></span>
                                    <span class="fa fa-star rate " id="star4" onclick="add(this,4)"></span>
                                    <span class="fa fa-star rate" id="star5" onclick="add(this,5)"></span>
                                </div>
                            </div>
                        </div>
               	</section>
                <section class="services-section @if($settings->device == 1) section-d-none @endif section-both">
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
                                        <input type="text" class="form-control provider_name text_provider_name" name="provider_name" placeholder="Provider name">      
                                        <input type="hidden" class="form-control provider_status" name="provider_status" placeholder="Provider status">      
                                    </div>
	                                 <small>
	                                 	<a href="javascript:void(0)" class="provider_text_show">Couldn't find your Service provider</a>
	                                 </small>
	                            </div>
	                            <div class="col-lg-6 ">
	                             	<h5>Contract type</h5>
	                                <div class="row align-items-center">
	                                    <div class="col-lg-12 pl-0 pt-3">
                                            <div class="form-group ">
                                                <span class="ext-default reviewpage_toggle">Personal</span>
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
                                            @foreach($currencies as $curr)
                                            <option @if($curr->iso_code == 'USD') selected @endif value="{{$curr->id}}">{{$curr->iso_code}}</option>
                                            @endforeach
                                        </select>
	                                    <input type="number" class="form-control price-box price" name="price" placeholder="Price" >		
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <h5>Payment type</h5>
	                                <div class="tg-select form-control">
	                                    <select class="payment_type" name="payment_type">
	                                        <option value="postpaid" selected="">Postpaid</option>
	                                        <option value="prepaid">Prepaid</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-6">
	                                <h5>Service type</h5>
	                                <div class="tg-select form-control">
	                                    <select class="service_type">
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
	                            <div class="col-lg-6 ">
	                                <h5>Local Mintue</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control local_min" name="local_min" placeholder="Local Min" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                <h5>DataVolume</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control datavolume" name="datavolume" placeholder="DataVolume" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                <h5>Long distance  Mintue</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control long_distance_min" name="long_distance_min" placeholder="Long distance  Min" required="required" value="Unlimited">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                <h5>International Mintue</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control international_min" name="international_min" placeholder="International Min" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                <h5>Roaming Mintue</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control roaming_min" name="roaming_min" placeholder="Roaming Min" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                <h5>Data speed</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control data_speed" name="data_speed" placeholder="Data speed" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                <h5>SMS</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control sms" name="sms" placeholder="SMS" required="required" value="Unlimited">		
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-12">
	                                <div class="form-group w-50 ml-auto mr-auto">
	                                    <button type="submit" class="btn btn-primary btn-lg btn-block product-submit-btn">Submit</button>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
                    <div class="services-rating-section section-d-none section-both">
	               		<div class="row">
	               		    <div class="heading detail-div">
	               		        <h1 class="section-title">Rating</h1>
	               		    </div>
	               		</div>
	               		<div class="row">
	               		    <div class="col-lg-6">
	               		        <div class="">
	               		            <h5>Coverage</h5>
	               		        </div>
	               		    </div>
	               		    <div class="col-lg-6">
	               		    	<div class="rating coverage"></div>
	               		    	<!-- <div class="rating coverage" data-rate-value=6></div> -->
	               		    </div>
	               		</div>
	               		<div class="row">
	               		    <div class="col-lg-6">
	               		        <div class="">
	               		            <h5>Service Stability some time calls are disconnected, network is up and down , some times there is no coverage </h5>
	               		        </div>
	               		    </div>
	               		    <div class="col-lg-6">
	               		    	<div class="rating service_stability"></div>
	               		    </div>
	               		</div>
	               		<div class="row">
	               		    <div class="col-lg-6">
	               		        <div class="">
	               		            <h5>Billing & paymnet accuracy </h5>
	               		        </div>
	               		    </div>
	               		    <div class="col-lg-6">
	               		    	<div class="rating billing_payment"></div>
	               		    </div>
	               		</div>
	               		<div class="row">
	               		    <div class="col-lg-6">
	               		        <div class="">
	               		            <h5>Data speed You may use our speed test to get what speed you are getting for real </h5>
	               		        </div>
	               		    </div>
	               		    <div class="col-lg-6">
	               		    	<div class="rating data_speed"></div>
	               		    </div>
	               		</div>
	               		<div class="row">
	               		    <div class="col-lg-6">
	               		        <div class="">
	               		            <h5>Customer Service Waiting time, knowlage, response, understanding, final solution time</h5>
	               		        </div>
	               		    </div>
	               		    <div class="col-lg-6">
	               		    	<div class="rating service_waiting"></div>
	               		    </div>
	               		</div>
	               		<div class="row">
	               		    <div class="col-lg-6">
	               		        <div class="">
	               		            <h5>Qulaity Such as Voice clearance, echo, some times you can hear your own voice </h5>
	               		        </div>
	               		    </div>
	               		    <div class="col-lg-6">
	               		    	<div class="rating voice_quality"></div>
	               		    </div>
	               		</div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="font-weight-bold">Average</h5>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <input type="hidden" class="average_input" value="0">
                                <div class="font-weight-bold average_div">0</div>
                            </div>
                        </div>
	               		<div class="row">
	               		    <div class="col-lg-12">
	               		        <div class="form-group w-50 ml-auto mr-auto">
	               		        	<input type="hidden" name="service_id" class="service_id">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block service-rating-submit-btn">Submit</button>
                                </div>
	               		    </div>
	               		</div>
	               	</div>
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
	<script>
	    function add(ths,sno){
	        for (var i=1;i<=5;i++){
	            var cur=document.getElementById("star"+i)
	            cur.className="fa fa-star"
	        }
	    
	        for (var i=1;i<=sno;i++){
	            var cur=document.getElementById("star"+i)
	            if(cur.className=="fa fa-star")
	            {
	                cur.className="fa fa-star checked"
	            }
	        }
	    }
	</script>

@endsection