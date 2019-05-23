@extends('layouts.frontend_layouts.frontend')
@section('content')

	<!-- Content Start Here -->
		<div class="page-header inner-page" style="background: url(assets/img/background-img.png);">
		    <div class="container">
		        <div class="row">
		            <div class="col-12 text-center mt-5">
		                <div class="heading find-div">
		                    <h1 class="section-title">Find a Plan</h1>
		                    <div class="location_search">
		                    	<input type="text" class="form-control" placeholder="Location" id="searchMapInput">
		                    </div>
		                    <h4 class="sub-title">Register and share your mobile or telecom experience to unlock Telco Tales</h4>
		                    <div class="container">
	                            <div class="row align-items-center justify-content-center">
	                                <div class="col-md-2 pt-3 pl-0 pr-1">
	                                    <div class="form-group ">
	                                        <select id="inputState " class="form-control drop-dw">
	                                            <option selected> Personal Business</option>
	                                            <option>BMW</option>
	                                            <option>Audi</option>
	                                            <option>Maruti</option>
	                                            <option>Tesla</option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="col-md-2 pt-3 pl-0 pr-1">
	                                    <div class="form-group">
	                                        <select id="inputState" class="form-control drop-dw">
	                                            <option selected>Postpaid Prepaid</option>
	                                            <option>BMW</option>
	                                            <option>Audi</option>
	                                            <option>Maruti</option>
	                                            <option>Tesla</option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="col-md-2 pt-3 pl-0 pr-1">
	                                    <div class="form-group">
	                                        <select id="inputState" class="form-control drop-dw">
	                                            <option selected>Mobile plan Home internet</option>
	                                            <option>BMW</option>
	                                            <option>Audi</option>
	                                            <option>Maruti</option>
	                                            <option>Tesla</option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="col-md-2 pt-3 pl-0 pr-1">
	                                    <div class="form-group">
	                                        <select id="inputState" class="form-control drop-dw">
	                                            <option selected>Unlimited Calls</option>
	                                            <option>BMW</option>
	                                            <option>Audi</option>
	                                            <option>Maruti</option>
	                                            <option>Tesla</option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="col-md-2 pt-3 pl-0 pr-1">
	                                    <div class="form-group">
	                                        <select id="inputState" class="form-control drop-dw">
	                                            <option selected>10 GB Download</option>
	                                            <option>BMW</option>
	                                            <option>Audi</option>
	                                            <option>Maruti</option>
	                                            <option>Tesla</option>
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="col-md-2 pt-3 pl-0 pr-0">
	                                    <div class="form-group">
	                                        <select id="inputState" class="form-control drop-dw">
	                                            <option selected>300 MBps</option>
	                                            <option>BMW</option>
	                                            <option>Audi</option>
	                                            <option>Maruti</option>
	                                            <option>Tesla</option>
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col text-center">
		                <button class="btn btn-common" type="button"><i class="lni-search"></i> Search Now</button>
		            </div>
		        </div>
		        <div class="row mt-4">
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                            <i class="fa fa-search"></i>
		                        </div>
		                        <!-- service-icon -->
		                        <h3 class="service-title">Find the right Telecom provider</h3>
		                        <p class="service-description">You are searching for, wither it’s a mobile plan, Home internet plan, Business internet plan, cooperate mobile plan, Smart tables or even mobile package</p>
		                    </div>
		                    <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                            <i class="fa fa-dollar-sign"></i>
		                        </div>
		                        <!-- service-icon -->
		                        <h3 class="service-title">Compare Price</h3>
		                        <p class="service-description">See how much people are See how much people are you area, city or country and check the best price</p>
		                    </div>
		                    <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                            <i class="fa fa-thumbs-up"></i>
		                        </div>
		                        <!-- service-icon -->
		                        <h3 class="service-title">Compare Quality</h3>
		                        <p class="service-description">Check what people are saying about the providers Be aware of the provided telecom service in your area “mobile wireless, home internet, ADSL, LTE “ Custmer service and even the actua speed</p>
		                    </div>
		                    <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col text-center">
		                <a href="sign-in.html" class="btn btn-common btn-find plan ">Register for Free</a>
		            </div>
		        </div>
		    </div>
		</div>
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
		<section class="featured-lis section-padding">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
	                    <div id="new-products" class="owl-carousel owl-theme">
	                        <div class="item">
	                            <div class="product-item">
	                                <div class="carousel-thumb">
	                                    <img class="img-fluid" src="frontend/assets/img/slider-img-1.png" alt="">
	                                </div>
	                                <div class="product-content-inner">
	                                    <div class="product-content">
	                                        <h3 class="product-title"><a href="#">Freedom Mobile</a></h3>
	                                        <span>Register and reveal all the details .</span>
	                                        
	                                    </div>
	                                   
	                                </div>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="product-item">
	                                <div class="carousel-thumb">
	                                    <img class="img-fluid" src="frontend/assets/img/slider-img-2.png" alt="">
	                                </div>
	                                <div class="product-content-inner">
	                                    <div class="product-content">
	                                        <h3 class="product-title"><a href="#">Telus</a></h3>
	                                        <span>Register and reveal all the details</span>
	                                        
	                                    </div>
	                                    
	                                </div>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="product-item">
	                                <div class="carousel-thumb">
	                                    <img class="img-fluid" src="frontend/assets/img/slider-img-3.png" alt="">
	                                </div>
	                                <div class="product-content-inner">
	                                    <div class="product-content">
	                                        <h3 class="product-title"><a href="#">Bell Mobility</a></h3>
	                                        <span>Register and reveal all the details</span>
	                                        
	                                    </div>
	                                    
	                                </div>
	                            </div>
	                        </div>
	                        <div class="item">
	                            <div class="product-item">
	                                <div class="carousel-thumb">
	                                    <img class="img-fluid" src="frontend/assets/img/slider-img-1.png" alt="">
	                                </div>
	                                <div class="product-content-inner">
	                                    <div class="product-content">
	                                        <h3 class="product-title"><a href="#">Freedom Mobile</a></h3>
	                                        <span>Register and reveal all the details .</span>
	                                        
	                                    </div>
	                                    
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
		</section>
		<div class="main-container section-padding py-3">
		    <div class="container mt-0 mt-lg-4">
		        <div class="table-responsive">
		        <table class="at-intenet-package" id="pack">
		            <thead>
		                <tr>
		                    <th class="at-int-intro">
		                        <h2> Internet Plans</h2></th>
		                    <th>1 movie (2GB) would take...</th>
		                    <th>50 photos (300MB) would take...</th>
		                    <th>1 album (60MB) would take...</th>
		                    <th></th>
		                </tr>
		            </thead>
		            <tbody>
		                <tr>
		                    <td class="at-int-speedname">
		                        <img src="frontend/assets/img/logo-web.png" width="150">
		                    </td>
		                    <td class="at-int-dl1">
		                        <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl2">
		                        <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl3">
		                        <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-price">
		                        <h2 class="at-IntHdr">
		                                    <span>$</span>11.95<span class="per-month">/mo</span>
		                                </h2>
		                        <span class="check-info">12 Month Pricing</span> No Contract Required
		                    </td>
		                    <td class="at-int-check"><a href="#" class="btn white mr-1">Reviews</a><a href="#" class="btn white">Detail</a></td>
		                </tr>
		                <tr>
		                    <td class="at-int-speedname">
		                            <img src="frontend/assets/img/logo-web.png" width="150">
		                    </td>
		                    <td class="at-int-dl1">
		                        <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl2">
		                        <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl3">
		                        <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-price">
		                        <h2 class="at-IntHdr">
		                                    <span>$</span>11.95<span class="per-month">/mo</span>
		                                </h2>
		                        <span class="check-info">12 Month Pricing</span> No Contract Required
		                    </td>
		                    <td class="at-int-check"><a href="#" class="btn white mr-1">Reviews</a><a href="#" class="btn white">Detail</a></td>
		                </tr>
		                <tr>
		                    <td class="at-int-speedname">
		                            <img src="frontend/assets/img/logo-web.png" width="150">
		                    </td>
		                    <td class="at-int-dl1">
		                        <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl2">
		                        <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl3">
		                        <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-price">
		                        <h2 class="at-IntHdr">
		                                    <span>$</span>11.95<span class="per-month">/mo</span>
		                                </h2>
		                        <span class="check-info">12 Month Pricing</span> No Contract Required
		                    </td>
		                    <td class="at-int-check"><a href="#" class="btn white mr-1">Reviews</a><a href="#" class="btn white">Detail</a></td>
		                </tr>
		                <tr>
		                    <td class="at-int-speedname">
		                            <img src="frontend/assets/img/logo-web.png" width="150">
		                    </td>
		                    <td class="at-int-dl1">
		                        <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl2">
		                        <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl3">
		                        <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-price">
		                        <h2 class="at-IntHdr">
		                                    <span>$</span>11.95<span class="per-month">/mo</span>
		                                </h2>
		                        <span class="check-info">12 Month Pricing</span> No Contract Required
		                    </td>
		                    <td class="at-int-check"><a href="#" class="btn white mr-1">Reviews</a><a href="#" class="btn white">Detail</a></td>
		                </tr>
		                <tr>
		                    <td class="at-int-speedname">
		                            <img src="frontend/assets/img/logo-web.png" width="150">
		                    </td>
		                    <td class="at-int-dl1">
		                        <h2 class="at-IntHdr">6.2<span class="time-sep"> hrs</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl2">
		                        <h2 class="at-IntHdr">55<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-dl3">
		                        <h2 class="at-IntHdr">11<span class="time-sep"> min</span></h2>
		                        <span class="todownload">to download*</span>
		                    </td>
		                    <td class="at-int-price">
		                        <h2 class="at-IntHdr">
		                                <span>$</span>11.95<span class="per-month">/mo</span>
		                            </h2>
		                        <span class="check-info">12 Month Pricing</span> No Contract Required
		                    </td>
		                    <td class="at-int-check"><a href="#" class="btn white mr-1">Reviews</a><a href="#" class="btn white">Detail</a></td>
		                </tr>
		            </tbody>
		        </table>
		    </div>
		    </div>
		</div>
	<!-- Content End Here -->
	<script>
		
	function initMap() {
	    var input = document.getElementById('searchMapInput');
	  
	    var autocomplete = new google.maps.places.Autocomplete(input);
	   
	    autocomplete.addListener('place_changed', function() {
	        var place = autocomplete.getPlace();
	    });
	}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&libraries=places&callback=initMap" async defer></script>

@endsection