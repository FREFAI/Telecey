@extends('layouts.frontend_layouts.frontend')
@section('title', 'Plans')
@section('content')
<style>
	tr.custom-row-cl {
		background-color: #77fdc8;
		color: #333;
		border: 5px solid #fff;
	}
	tr.custom-row-cl:hover {
		background-color: #dcdcdc;
		color: #333;
	}
	tr.custom-row-cl td {
		vertical-align: middle;
	}
	a.form-control.btn.table-row-btn {
		background-color: #77fdc8;
		border: 0;
	}
	a.form-control.btn.table-row-btn:hover {
		background-color: #333;
		color: #fff;
	}
	.noSearchMessage p{
		font-size: 33px;
		font-weight: bold;
	}
	div#example_wrapper {
		width: 100%;
	}
	.paginate_button a {
		padding: 5px 14px !important;
		border-radius: 2px !important;
	}
	.overlay_signup.w-100.text-center {
		background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#1a82f700), to(#141414));
		height: 230px;    
		margin-top: -40px;
    	z-index: 0;
		padding-top: 60px;
	}
	.overlay_signup i.fa.fa-lock {
		border: 2px solid #96fdd4;
		border-radius: 50px;
		padding: 10px 14px;
		color: #96fdd4;
		margin-bottom: 10px;
		margin-top: 40px;
	}
	.overlay_signup .signup_btn {
		border-radius: 30px;
		color: #333534;
	}
</style>
	<!-- Content Start Here -->
		<div class="page-header inner-page" style="background: url({{URL('frontend/assets/img/background-img.png')}});">
		    <div class="container">
		    	<form action="{{url('/plans')}}" method="get">
			        <div class="row">
			            <div class="col-12 text-center mt-5">
			                <div class="heading find-div">
			                    <h1 class="section-title">Find a Plan</h1>
			                    <div class="location_search mb-2">
								<input type="text" class="form-control" placeholder="Location" id="searchMapInput" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif" name="address">
			                    </div>
			                    <h4 class="sub-title">Register and share your mobile or telecom experience to unlock Telco Tales</h4>
			                    <div class="container">
		                            <div class="row align-items-center justify-content-center">
		                            	@if($filtersetting->personal_business_setting == 1)
		                                <div class="col-lg-3 col-md-4 col-sm-4 pt-3 pl-0 pr-1">
		                                    <div class="form-group plan_page">
		                                    	<span class="toggle_label active">Personal</span>
		                                    	<label class="switch">
		                                    	  <input type="checkbox" id="personal" value="1" onClick="personalToggle()" name="contract_type" @if( request()->get('contract_type') ) @if( request()->get('contract_type') == 2) checked @endif @endif>
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
		                                    	  <input type="checkbox" id="paymentTypeId" name="payment_type" value="postpaid" onClick=paymentType()  @if( request()->get('payment_type') ) @if( request()->get('payment_type') == 'prepaid') checked @endif @endif>
		                                    	  <span class="slider"></span>
		                                    	</label>
		                                    	<span class="toggle_label">Prepaid</span>
		                                    </div>
		                                </div>
		                                @endif
		                                @if($filtersetting->mobile_home_setting == 1)
		                                <div class="col-lg-3 col-md-4 col-sm-4 pt-2 pl-0 pr-1 ">
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
																<option value="{{$type->id}}" @if( request()->get('service_type') ) @if( request()->get('service_type') == $type->id) selected @endif @endif>{{$type->service_type_name}}</option>
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
		                                    	  <input type="checkbox" onclick="payAsUsage()" value="0" id="pay_as_usage_id" name="pay_as_usage_type" @if( request()->get('pay_as_usage_type') ) @if( request()->get('pay_as_usage_type') == 1) checked @endif @endif>
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
		{{-- <div class="main-container section-padding py-3">
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
		</div> --}}
		@if(count($data)>0)
		<div class="container mb-5">
			<div class="row">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							{{-- <th scope="col">Location</th> --}}
							<th>Provider</th>
							<th>Price</th>
							<th>Local Min</th>
							<th>Volume GB</th>
							<th>Review</th>
							{{-- @if($filterType == 1) --}}
								<th>Distance</th>
							{{-- @endif --}}
							<th>
								{{-- <form action="{{ url('/plans') }}" method="get" id="sortBy" onchange="sortingFunc()">
									<div class="form-group">
										<select class="form-control" name="filter">
										<option value="2" @if($filterType == 2) selected="" @endif>Price</option>
										<option value="3" @if($filterType == 3) selected="" @endif>Minutes</option>
										<option value="4" @if($filterType == 4) selected="" @endif>Data</option>
										<option value="5" @if($filterType == 5) selected="" @endif>Review</option>
										</select>
									</div>
								</form> --}}
								Details
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $value)
							<tr class="custom-row-cl">
								<td>
									@if($value['provider']['provider_image_original'] != "")
										<img src="{{URL::asset('providers/provider_original')}}/{{$value['provider']['provider_image_original']}}" style="width:100px;height:50px;" />
									@else
										<img src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" style="width:100px;height:50px;"/>
									@endif
								</td>
								<td>
								@if(!Auth::guard('customer')->check())
									@if($filtersetting->disable_price_for_logged_out_users == 1)
										{{$value['price']}}
									@else
										<a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</a>
									@endif
								@else
								{{$value['price']}}
								@endif
								</td>
								<td>{{$value['local_min']}}</td>
								<td>{{$value['datavolume']}}</td>
								<td data-order="{{$value['average_review']}}"><div class="rating_disable" data-rate-value="{{$value['average_review']}}"></div></td>
								@if(isset($value['distance']))
									<td>{{round($value['distance'])}} KM</td>
								@else
									<td>N/A</td>
								@endif
								@if(Auth::guard('customer')->check())
									<td data-order="-1"><a class="form-control btn table-row-btn" href="{{url('/planDetails/'.$value['id'])}}">Details</a></td>
								@else
									@if($filtersetting->disable_details_for_logged_out_users == 1)
										<td data-order="-1"><a class="form-control btn table-row-btn" href="{{url('/planDetails/'.$value['id'])}}">Details</a></td>
									@else
										<td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</a></td>
									@endif
								@endif
							</tr>
						@endforeach
					</tbody>
				</table>
				@if(!Auth::guard('customer')->check())
					@if($filtersetting->no_of_search_record > 0)
					<div class="overlay_signup w-100 text-center text-white">
						<i class="fa fa-lock" aria-hidden="true"></i>
						<div> 
						<a class="btn table-row-btn signup_btn" href="{{url('/signup')}}">Sign up to show more reviews</a>
						</div>
					</div>
					@endif
				@endif
				@if(Auth::guard('customer')->check())
				<div class="pagination">
					{{$data->appends(request()->input())->links()}}
				</div>
				@else
					@if($filtersetting->no_of_search_record === 0)
						<div class="pagination">
							{{$data->appends(request()->input())->links()}}
						</div>
					@endif
				@endif
			</div>
		</div>
		@else
		<div class="container">
			<div class="row pt-5 pb-5 mt-5 mb-5">
				<div class="col text-center">
					<div class="heading noSearchMessage">
						<p>{!!$filtersetting->no_search_message!!}</p>
					</div>
				</div>
			</div>
		</div>
		@endif
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

	function sortingFunc(){
		$('#sortBy').submit();
	}
		
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&libraries=places&callback=initMap" async defer></script>
	

@endsection