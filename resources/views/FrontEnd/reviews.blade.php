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
	                                    <input id="name" class="input-text js-input" type="text" required>
	                                    <label class="label" for="name">First Name</label>
	                                </div>
	                                <div class="form-field col-lg-6">
	                                    <input id="name" class="input-text js-input" type="text" required>
	                                    <label class="label" for="name">Last Name</label>
	                                </div>
	                                <div class="form-field col-lg-6">
	                                    <input id="name" class="input-text js-input" type="text" required>
	                                    <label class="label" for="name">Country</label>
	                                </div>
	                                <div class="form-field col-lg-6">
	                                    <input id="name" class="input-text js-input" type="text" required>
	                                    <label class="label" for="name">City</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="email" class="input-text js-input" type="email" required>
	                                    <label class="label" for="email">E-mail</label>
	                                </div>
	                                <div class="form-field col-lg-12 ">
	                                        <input id="Number" class="input-text js-input" type="number" required>
	                                        <label class="label" for="number">Postal Code</label>
	                                    </div>
	                                <div class="form-field col-lg-12 ">
	                                    <input id="phone" class="input-text js-input" type="text" required>
	                                    <label class="label" for="phone">Contact Number</label>
	                                </div>
	                                <div class="custom-control custom-checkbox ml-3">
	                                    <input type="checkbox" class="custom-control-input" id="Check33" required>
	                                    <label class="custom-control-label" for="Check33">Agree to terms and conditions</label>
	                                    </div>
	                                <div class="form-field col-lg-12">
	                                    <input class="submit-btn" type="submit" value="Subscribe Now">
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
	                    <div class="col-lg-6 col text-center">
	                        <div class="button-product">
	                            <label class="text-product"><input type="radio" class="radio-inline select_one" name="radios" value="product-section"><span class="outside"><span class="inside"></span></span>Product</label>
	                        </div>
	                    </div>
	                    <div class="col-lg-6 col text-center">
	                        <div class="button-service">
	                            <label class="text-product"><input type="radio" class="radio-inline select_one" name="radios" value="services-section"><span class="outside"><span class="inside"></span></span>Service</label>
	                        </div>
	                    </div>
	                </div>
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
	                                    <input type="number" class="form-control price-box" name="Price" placeholder="Price" required="required">		
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
	                <section class="services-section section-d-none section-both">
	                    <div class="row mt-3">
	                            <div class="col-lg-6 ">
	                                <h5>Which provider "Carrier"?</h5>
	                                <div class="tg-select form-control">
	                                     <select>
	                                         <option value="none">Vodafone</option>
	                                         <option value="none">Aritel</option>
	                                         <option value="none">BSNL</option>
	                                         <option value="none">JIO</option>
	                                     </select>
	                                 </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                 <h5>Type of subscription</h5>
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios-" value=""><span class="outside"><span class="inside"></span></span>Personal</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios-" value=""><span class="outside"><span class="inside"></span></span>Business</label>
	                                        </div>
	                                    </div>
	                                </div>
	                             </div>
	                        </div>
	                        <div class="row mt-3">
	                            <div class="col-lg-6 ">
	                                <h5>Price</h5>
	                                <div class="form-group">
	                                    <input type="number" class="form-control price-box" name="Price" placeholder="Price" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <h5>Contract Type</h5>
	                                <div class="tg-select form-control">
	                                    <select>
	                                        <option value="none">Postpaid/Prepaid</option>
	                                        <option value="none">Pre or post</option>
	                                        <option value="none">Business Name</option>
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-6">
	                                <h5>Service type</h5>
	                                <div class="tg-select form-control">
	                                    <select>
	                                        <option value="none">Home internet</option>
	                                        <option value="none">Landline</option>
	                                        <option value="none">Mobile plan</option>
	                                        <option value="none">Package</option>
	                                        <option value="none">Familly share plan</option>
	                                        <option value="none">Businesss Internet</option>
	                                        <option value="none">Business Landline</option>
	                                        <option value="none">Coorperate mobile plan</option>
	                                    </select>
	                                </div>
	                            </div>
	                            <div class="col-lg-6 ">
	                                <h5>Did you get a device with this service</h5>
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios0" value=""><span class="outside"><span class="inside"></span></span>Yes</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios0" value=""><span class="outside"><span class="inside"></span></span>No</label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="question-section">
	                        <div class="row mt-2 pb-3 pt-4 ">
	                            <div class="col-lg-6">
	                                <h5>If yes What is the type of the device</h5>
	                                <div class="form-group">
	                                    <input type="text" class="form-control price-box" name="Price" placeholder="Type of the device" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <h5>Did you pay for the device in advance</h5>
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios1" value=""><span class="outside"><span class="inside"></span></span>Full</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios1" value=""><span class="outside"><span class="inside"></span></span>Part</label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row ">
	                            <div class="col-lg-6">
	                                <h5>How much ($) with or with our tax</h5>
	                                <div class="form-group">
	                                    <input type="Number" class="form-control price-box" name="Price" placeholder="" required="required">		
	                                </div>
	                            </div>
	                            <div class="col-lg-6">
	                                <h5>Do you want to rate the device at he end?</h5>
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios2" value=""><span class="outside"><span class="inside"></span></span>Yes</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product"><input type="radio" class="radio-inline" name="radios2" value=""><span class="outside"><span class="inside"></span></span>No</label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                        <div class="row mt-4">
	                            <div class="col text-left">
	                                <h5>Whats included in you Service?</h5>
	                            </div>
	                        </div>
	                        <div class="row mt-4">
	                            <div class="col-lg-6">
	                                <h5>Home internet</h5>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios3" value=""><span class="outside"><span class="inside"></span></span>Yes</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios3" value=""><span class="outside"><span class="inside"></span></span>No</label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row ">
	                            <div class="col-lg-6">
	                                <h5>Landline</h5>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios4" value=""><span class="outside"><span class="inside"></span></span>Yes</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios4" value=""><span class="outside"><span class="inside"></span></span>No</label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row ">
	                            <div class="col-lg-6">
	                                <h5>Mobile plan</h5>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios5" value=""><span class="outside"><span class="inside"></span></span>Yes</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios5" value=""><span class="outside"><span class="inside"></span></span>No</label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="col-lg-6">
	                                <h5>TV</h5>
	                            </div>
	                            <div class="col-lg-6">
	                                <div class="row">
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-product">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios6" value=""><span class="outside"><span class="inside"></span></span>Yes</label>
	                                        </div>
	                                    </div>
	                                    <div class="col-lg-6 pl-0">
	                                        <div class="button-service">
	                                            <label class="text-product mt-0"><input type="radio" class="radio-inline" name="radios6" value=""><span class="outside"><span class="inside"></span></span>No</label>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	               	</section> 
	            </form> 
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