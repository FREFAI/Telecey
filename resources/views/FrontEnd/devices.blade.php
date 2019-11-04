@extends('layouts.frontend_layouts.frontend')
@section('title', 'Devices')
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
	.search-bar .form-group{
		width: 39%;
	}
	.search-bar .search-inner {
		width: 90%;
	}
	div#example_wrapper {
		width: 100%;
	}
	.paginate_button a {
		padding: 5px 14px !important;
		border-radius: 2px !important;
	}
	.location_search {
		width: 50%;
	}
</style>
	<!-- Content Start Here -->
		<div class="page-header inner-page" style="background: url(assets/img/background-img.png);">
		    <div class="container">
				<form id="searchForm" class="search-form" action="{{url('/devices')}}" method="get">
					<div class="row">
						<div class="col-12 text-center mt-5">
							<div class="heading find-div">
								<h1 class="section-title">Find a Device</h1>
								<div class="location_search mb-2">
									<input type="text" class="form-control" placeholder="Location" id="searchMapInput" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif" name="address">
								</div>
								<h4 class="sub-title">Register and share your mobile or telecom experience to unlock Telco Tales</h4>
								<div class="search-bar">
									<div class="search-inner">
										<div class="form-group inputwithicon">
											<div class="select">
												<select required="required" name="brand_name">
													<option value="">Brand</option>
													@foreach($brands as $v)
														<option value="{{$v->id}}" @if( request()->get('brand_name') ) @if( request()->get('brand_name') == $v->id) selected @endif @endif>{{$v->brand_name}} {{$v->model_name}}</option>
													@endforeach
												</select>
											</div>
											<i class="lni-chevron-down"></i>
										</div>
										{{-- <div class="form-group inputwithicon">
											<div class="select" ">
												<select required="required" name="model_name" id="model_name">
													<option value="">Model</option>
													@foreach($brands as $v)
														<option value="{{$v->id}}">{{$v->model_name}}</option>
													@endforeach
												</select>
											</div>
											<i class="lni-chevron-down"></i>
										</div> --}}
										<div class="form-group inputwithicon">
											<div class="select">
												<select required="required" name="storage" id="storage">
														<option value="">Capacity</option>
														<option value="64" @if( request()->get('storage') ) @if( request()->get('storage') == '64') selected @endif @endif>64</option>
														<option value="128" @if( request()->get('storage') ) @if( request()->get('storage') == '128') selected @endif @endif>128</option>
														<option value="256" @if( request()->get('storage') ) @if( request()->get('storage') == '256') selected @endif @endif>256</option>
														<option value="512" @if( request()->get('storage') ) @if( request()->get('storage') == '512') selected @endif @endif>512</option>
														<option value="1GB" @if( request()->get('storage') ) @if( request()->get('storage') == '1GB') selected @endif @endif>1GB</option>
													</select>
											</div>
											<i class="lni-chevron-down"></i>
										</div>
										{{-- <div class="form-group inputwithicon">
											<div class="select">
												<select required="required" name="supplier" id="supplier">
													<option value="">Supplier</option>
													@foreach($suppliers as $v)
														<option value="{{$v->id}}"  @if( request()->get('supplier') ) @if( request()->get('supplier') == $v->id) selected @endif @endif>{{$v->supplier_name}}</option>
													@endforeach	
													</select>
											</div>
											<i class="lni-chevron-down"></i>
										</div> --}}
										<button class="btn btn-common search_btn" type="submit"><i class="lni-search"></i> Search Now</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
		        <div class="row mt-4">
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                            <i class="fa fa-search"></i>
		                        </div> <!-- service-icon -->
		                        <h3 class="service-title">Find the Right Telecom Device</h3>
		                        <p class="service-description">You are searching for, wither it’s a mobile phone, smart phone, Smart tables or even home modem</p>
		                    </div> <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                                <i class="fa fa-dollar-sign"></i>
		                        </div> <!-- service-icon -->
		                        <h3 class="service-title">Compare Device Price</h3>
		                        <p class="service-description">Searching for wither it’s a mobile phone, smart phone, Smart tables or even home modem</p>
		                    </div> <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		            <div class="col-md-4 col-sm-4">
		                <div class="service-post">
		                    <div class="service-content">
		                        <div class="service-icon">
		                                <i class="fa fa-thumbs-up"></i>
		                        </div> <!-- service-icon -->
		                        <p class="service-description">Find the right telecom device you searching for wither it’s a mobile phone, smart phone, Smart tables or even home modem</p>
		                    </div> <!-- service-content -->
		                    <div class="service-hover"></div>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col text-center">
		                    <a href="sign-in.html" class="btn btn-common btn-find plan mt-4">Register for Free</a>
		            </div>
		        </div>
		    </div>
		</div>
		<section class="plan-device-sec">
		    <div class="container">
		        <div class="row pt-5 pb-5">
		            <div class="col text-center">
		                <div class="heading">
		                    <h1>Top Rated Devices in your Area</h1>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
		<div class="row grid-container pt-5 pb-5">
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
		        <div class="product-box column">
		            <a href="#" class="product-item">
		                <div class="product-item-image">
		                    <img src="frontend/assets/img/airpod.png" alt="Stadium Full Exterior">
		                    <div class="product-item-image-hover">
		                    </div>
		                </div>
		                <div class="product-item-content">
		                    <div class="product-item-category">
		                         Airpod
		                    </div>
		                    <div class="product-item-title">
		                        By Fariscom
		                    </div>
		                    <div class="product-item-price">
		                            Save 25% with you first purchase
		                    </div>
		                    <div class="button-pill">
		                        <span>Shop Now</span>
		                    </div>
		                </div>
		            </a>
		        </div>
		    </div>
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
		            <div class="product-box column">
		                <a href="#" class="product-item">
		                    <div class="product-item-image">
		                            <img src="frontend/assets/img/phone-case.png" alt="Stadium Full Exterior">
		                        <div class="product-item-image-hover">
		                        </div>
		                    </div>
		                    <div class="product-item-content">
		                        <div class="product-item-category">
		                                i Phone Case
		                        </div>
		                        <div class="product-item-title">
		                                By Fariscom
		                        </div>
		                        <div class="product-item-price">
		                                Extra slim cover
		                        </div>
		                        <div class="button-pill">
		                            <span>Shop Now</span>
		                        </div>
		                    </div>
		                </a>
		            </div>
		    </div>
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
		        <div class="product-box column">
		            <a href="#" class="product-item">
		                <div class="product-item-image">
		                        <img src="frontend/assets/img/sony.png" alt="Stadium Full Exterior">
		                    <div class="product-item-image-hover">
		                    </div>
		                </div>
		                <div class="product-item-content">
		                    <div class="product-item-category">
		                            By Best Buy
		                    </div>
		                    <div class="product-item-title">
		                            Sony Wirless Headphones
		                    </div>
		                    <div class="product-item-price">
		                            Powerful Bluetooth headphones
		                    </div>
		                    <div class="button-pill">
		                        <span>Shop Now</span>
		                    </div>
		                </div>
		            </a>
		        </div>
		    </div>
		</div>
		{{-- <div class="main-container section-padding py-3">
		    <div class="container mt-0 mt-lg-5">
		        <div class="table-responsive">
		            <table class="at-intenet-package" id="pack">
		                <thead>
		                    <tr>
		                        <th class="at-int-intro">
		                            <h2>Iphone XS  <span class="span-text-col">black/512 GB</span> </h2></th>
		                        <th>1 movie (2GB) would take...</th>
		                        <th>50 photos (300MB) would take...</th>
		                        <th>1 album (60MB) would take...</th>
		                        <th></th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
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
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
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
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
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
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
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
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                    <tr>
		                        <td class="at-int-speedname">
		                            <h2 class="at-IntHdr">Company Name</h2>
		                            <ul>
		                                <li><b>768Kbps</b> Download</li>
		                                <li><b>384Kbps</b> Upload</li>
		                            </ul>
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
		                        <td class="at-int-check"><a href="#" class="btn white">Check Availability</a></td>
		                    </tr>
		                </tbody>
		            </table>
		        </div>
		    </div>
		    <div class="row">
		        <div class="col text-center mt-5 mb-5">
		            <a href="sign-in.html" class="btn btn-common btn-find plan ">Register to Unlock Telco Tales</a>
		        </div>
		    </div>
		</div> --}}
		<div id="searchResult">
			@if(count($data)>0)
				<div class="container mb-5 mt-5">
					<div class="row">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Brand</th>
									<th>Model</th>
									<th>Supplier</th>
									<th>Price</th>
									<th>Capacity</th>
									{{-- @if($filterType == 1) --}}
									<th>Distance</th>
									{{-- @endif --}}
									<th>Details</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $value)
								<tr class="custom-row-cl">
									<td>{{$value['brand']['brand_name']}}</td>
									<td>{{$value['brand']['model_name']}}</td>
									<td>{{$value['supplier']['supplier_name']}}</td>
									<td>{{$value['price']}}</td>
									<td>{{$value['storage']}}</td>
									<td>{{round($value['distance'])}} KM</td>
									@if(Auth::guard('customer')->check())
										<td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value['id'])}}">Details</td>
									@else
										<td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
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
			{{-- <div class="container">
				<div class="row pt-5 pb-5 mt-5 mb-5">
					<div class="col text-center">
						<div class="heading noSearchMessage">
							<p>{!!$filtersetting->no_search_message!!}</p>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
		
	<!-- Content End Here -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script>

function sortingFunc(){
	$('#sortBy').submit();
}
function initMap() {
	var input = document.getElementById('searchMapInput');
	
	var autocomplete = new google.maps.places.Autocomplete(input);
	
	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
	});
}
// $('#searchForm').on('submit',function(e){
// 	$('#loader').show();
// 	e.preventDefault();
// 	var actionurl = $(this).attr('action');
// 	var form = $('#searchForm');
// 	form = form.serialize();
// 	$.ajax({
// 		url:actionurl,
// 		type: "GET",
// 		data: form,
// 		success: function(response){
// 			$('#loader').hide();
// 			$('#searchResult').html(response);
// 			$('html, body').animate({
// 				scrollTop: $("#searchResult").offset().top - 100
// 			}, 1000);
//             console.log(response);  
//         }
// 	});
	
// });
	
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&libraries=places&callback=initMap" async defer></script>
@endsection