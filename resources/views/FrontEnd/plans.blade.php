@extends('layouts.frontend_layouts.frontend')
@section('title', 'Plans')
@section('content')
	<!-- Content Start Here -->
		<div class="page-header inner-page" style="background: url({{URL('frontend/assets/img/background-img.png')}});">
		    <div class="container">
		    	<form action="{{url('/plans')}}" method="get">
			        <div class="row">
			            <div class="col-12 text-center mt-5">
			                <div class="heading find-div">
			                    <h1 class="section-title">Find a Plan</h1>
			                    <div class="location_search mb-2">
			                    	<input type="text" class="form-control" placeholder="Location" id="searchMapInput" value="{{$ip_location}}" name="address">
			                    </div>
			                    <h4 class="sub-title">Register and share your mobile or telecom experience to unlock Telco Tales</h4>
			                    <div class="container">
		                            <div class="row align-items-center justify-content-center">
		                            	@if($filtersetting->personal_business_setting == 1)
		                                <div class="col-lg-3 col-md-4 col-sm-4 pt-3 pl-0 pr-1">
		                                    <div class="form-group plan_page">
		                                    	<span class="toggle_label active">Personal</span>
		                                    	<label class="switch">
		                                    	  <input type="checkbox" id="personal" value="1" onClick="personalToggle()" name="contract_type">
		                                    	  <span class="slider"></span>
		                                    	</label>
		                                    	<span class="toggle_label">Business</span>
		                                    </div>
		                                </div>
		                                @endif
		                                @if($filtersetting->postpaid_prepaid_setting == 1)
		                                <div class="col-lg-3 col-md-4 col-sm-4 pt-3 pl-0 pr-1 ">
		                                    <div class="form-group plan_page">
		                                    	<span class="toggle_label active">Postpaid</span>
		                                    	<label class="switch">
		                                    	  <input type="checkbox" id="paymentTypeId" name="payment_type" value="postpaid" onClick=paymentType()>
		                                    	  <span class="slider"></span>
		                                    	</label>
		                                    	<span class="toggle_label">Prepaid</span>
		                                    </div>
		                                </div>
		                                @endif
		                                @if($filtersetting->mobile_home_setting == 1)
		                                <div class="col-lg-3 col-md-4 col-sm-4 pt-3 pl-0 pr-1 ">
		                                    <div class="form-group plan_page">
		                                    	{{-- <span class="toggle_label active">Mobile Plan</span>
		                                    	<label class="switch">
		                                    	  <input type="checkbox">
		                                    	  <span class="slider"></span>
		                                    	</label>
												<span class="toggle_label">Home Internet</span> --}}
												<div class="tg-select form-control" style="width:160px;height:30px !important; min-height:15px">
													<select style="height:26px;line-height:28px !important" class="service_type" name="service_type">
														<option value="">Select service type</option>
														@if(count($service_types) > 0)
															@foreach($service_types as $type)
													<option value="{{$type->id}}">{{$type->service_type_name}}</option>
														   @endforeach
														@else
															<option disabled="">Not found</option>
														@endif
													</select>
												</div>
		                                    </div>
		                                </div>
		                                @endif
		                                <div class="col-lg-3 col-md-4 col-sm-4 pt-3 pl-0 pr-1">
		                                    <div class="form-group plan_page">
		                                    	<span class="toggle_label active">Pay as usage</span>
		                                    	<label class="switch">
		                                    	  <input type="checkbox" onclick="payAsUsage()" value="0" id="pay_as_usage_id" name="pay_as_usage_type">
		                                    	  <span class="slider"></span>
		                                    	</label>
		                                    	<!-- <span class="toggle_label">On</span> -->
		                                    </div>
		                                </div>
		                                {{-- @if($filtersetting->unlimited_calls_setting == 1)
		                                <div class="col-lg-4 col-md-4 col-sm-4 pt-3 pl-0 pr-1 pay_as_usage_type">
		                                    <div class="form-group plan_page">
		                                    	<span class="toggle_label">Unlimited Calls</span>
		                                    	<label class="switch">
		                                    	  <input type="checkbox" checked="" onclick="myFunction()" id="unlimited">
		                                    	  <span class="slider"></span>
		                                    	</label>
		                                        <select id="unlimited_calls" class="form-control drop-dw d-none w-40">
		                                            <option value="100" selected>100 mins</option>
		                                            <option value="200">200 mins</option>
		                                            <option value="300">300 mins</option>
		                                            <option value="500">500 mins</option>
		                                        </select>
		                                    </div>
		                                </div>
		                                @endif --}}
		                                {{-- @if($filtersetting->gb_setting == 1)
		                                <div class="col-lg-2 col-md-2 col-sm-2 pt-3 pl-0 pr-1 pay_as_usage_type">
		                                    <div class="form-group">
		                                        <select id="inputState" class="form-control drop-dw">
		                                            <option value="0.5">0.5 GB</option>
		                                            <option value="1">1 GB</option>
		                                            <option value="2" selected>2 GB</option>
		                                            <option value="3">3 GB</option>
		                                            <option value="5">5 GB</option>
		                                            <option value="7">7 GB</option>
		                                            <option value="10">10 GB</option>
		                                            <option value="12">12 GB</option>
		                                            <option value="15">15 GB</option>
		                                            <option value="20">20 GB</option>
		                                        </select>
		                                    </div>
		                                </div>
		                                @endif --}}
		                                {{-- @if($filtersetting->mb_setting == 1)
		                                <div class="col-lg-2 col-md-2 col-sm-2 pt-3 pl-0 pr-0 pay_as_usage_type">
		                                    <div class="form-group">
		                                        <select id="inputState" class="form-control drop-dw">
		                                            <option selected value="" disabled="">Mbps</option>
		                                            <option value="100">100 Mbps</option>
		                                            <option value="200">200 Mbps</option>
		                                            <option value="300">300 Mbps</option>
		                                            <option value="400">400 Mbps</option>
		                                            <option value="500">500 Mbps</option>
		                                        </select>
		                                    </div>
		                                </div>
		                                @endif --}}
		                            </div>
		                        </div>
			                </div>
			            </div>
			        </div>
			        <div class="row">
			            <div class="col text-center">
			                <button class="btn btn-common" type="submit"><i class="lni-search"></i> Search Now</button>
			            </div>
			        </div>
		        </form>
		    </div>
	        <div class="container">
		        
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
		       <!--  <div class="row">
		            <div class="col text-center">
		                <a href="sign-in.html" class="btn btn-common btn-find plan ">Register for Free</a>
		            </div>
		        </div> -->
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
	            <div class="row align-items-center">
	                <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
	                	@if($filtersetting->ads_setting == 0)
	                		@if(count($ads) > 0)
			                    <div id="new-products" class="owl-carousel owl-theme">
			                        @foreach($ads as $ad)
				                        <div class="item">
				                            <div class="product-item">
				                                <div class="carousel-thumb">
				                                    <img class="img-fluid" src="{{URL::asset('ads_banner/resized')}}/{{$ad->ads_file}}" alt="">
				                                </div>
				                            </div>
				                        </div>
			                        @endforeach
			                    </div>
                        	@endif
	                    @else
		                    @if($ads)
		                    	{!!$ads->script!!}	
		                    @endif
	                    @endif
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

		<div class="main-container section-padding py-3">
			<div class="container mt-0 mt-lg-4">
				<div class="table-responsive">
					<table class="table table-striped text-center table-bordered">
						<thead>
							<tr>
								<th class="text-left">Plans Type</th>
								<th class="text-left">Price</th>
								<th class="text-left">Voice Price</th>
								<th class="text-left">Data Price</th>
								<th class="text-left">Type of Payment</th>
								<th class="text-left">Local Minutes</th>
								<th class="text-left">Data Volume</th>
								<th class="text-left">Long Distance Minutes</th>
								<th class="text-left">International Minutes</th>
								<th class="text-left">Roaming Minutes</th>
								<th class="text-left">Downloading speed</th>
								<th class="text-left">Uploading speed</th>
								<th class="text-left">Sms</th>
								{{-- <th class="text-left">currency_name</th>
								<th class="text-left">currency_symbol</th>
								<th class="text-left">currency_code</th> --}}
								<th class="text-left">Type of Service</th>
								
							</tr>
						</thead>
						<tbody>
							@if(count($data)>0)
							@foreach($data as $value)
							<tr>
								@if($value['contract_type'] == 1)
								<td class="text-left">Personal</td>
								@else
								<td class="text-left">Business</td>
								@endif
								{{-- <td class="text-left">{{$value['contract_type']}}</td> --}}
								<td class="text-left">{{$value['currency']['currency_symbol']}}{{$value['price']}}</td>
								<td class="text-left">{{$value['currency']['currency_symbol']}}{{$value['voice_price']}}</td>
								<td class="text-left">{{$value['currency']['currency_symbol']}}{{$value['data_price']}}</td>
								<td class="text-left">{{$value['payment_type']}}</td>
								<td class="text-left">{{$value['local_min']}}</td>
								<td class="text-left">{{$value['datavolume']}}</td>
								<td class="text-left">{{$value['long_distance_min']}}</td>
								<td class="text-left">{{$value['international_min']}}</td>
								<td class="text-left">{{$value['roaming_min']}}</td>
								<td class="text-left">{{$value['downloading_speed']}} Mbps</td>
								<td class="text-left">{{$value['uploading_speed']}} Mbps</td>
								<td class="text-left">{{$value['sms']}}</td>
								{{-- <td class="text-left">{{$value['currency']['currency_name']}}</td>
								<td class="text-left">{{$value['currency']['currency_symbol']}}</td>
								<td class="text-left">{{$value['currency']['currency_code']}}</td> --}}
								<td class="text-left">{{$value['type_of_service']['service_type_name']}}</td>
							</tr>
								@endforeach
								@else
								<td class="text-center" colspan="15">No Data Found</td>
							@endif
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
	// function myFunction() {
	//   var checkBox = document.getElementById("unlimited");
	//   var text = document.getElementById("unlimited_calls");
	//   if (checkBox.checked == true){
	//     $('#unlimited_calls').addClass('d-none');
	//   } else {
	//     $('#unlimited_calls').removeClass('d-none');
	//   }
	// }
	// function payAsUsage() {
	//   var checkBox = document.getElementById("pay_as_usage_id");
	//   if (checkBox.checked == true){
	//     $('.pay_as_usage_type').hide('slow');
	//   } else {
	//     $('.pay_as_usage_type').show('slow');
	//   }
	// }
	function payAsUsage() {
	  var checkBox = document.getElementById("pay_as_usage_id");
	  if (checkBox.checked == true){
		$('#pay_as_usage_id').val(1);
	  } else {
	    $('#pay_as_usage_id').val(0);
	  }
	}
	function personalToggle() {
	  var checkBox = document.getElementById("personal");
	  if (checkBox.checked == true){
		$('#personal').val(2);
	  } else {
	    $('#personal').val(1);
	  }
	}
	function paymentType() {
	  var checkBox = document.getElementById("paymentTypeId");
	  if (checkBox.checked == true){
		$('#paymentTypeId').val('prepaid');
	  } else {
	    $('#paymentTypeId').val('postpaid');
	  }
	}
		
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&libraries=places&callback=initMap" async defer></script>
	

@endsection