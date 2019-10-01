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
</style>
	<!-- Content Start Here -->
		<div class="page-header inner-page" style="background: url(assets/img/background-img.png);">
		    <div class="container">
		        <div class="row">
		            <div class="col-12 text-center mt-5">
		                <div class="heading find-div">
		                    <h1 class="section-title">Find a Device</h1>
		                    <h4 class="sub-title">Register and share your mobile or telecom experience to unlock Telco Tales</h4>
		                    <div class="search-bar">
		                        <div class="search-inner">
		                            <form class="search-form" action="{{url('/devices')}}" method="get">
										<div class="form-group inputwithicon">
											<div class="select">
												<select required="required" name="brand_name">
													<option value="">Brand</option>
													@foreach($brands as $v)
												<option value="{{$v->id}}">{{$v->brand_name}} {{$v->model_name}}</option>
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
														<option value="">Storage</option>
														<option value="64">64</option>
														<option value="128">128</option>
														<option value="256">256</option>
														<option value="512">512</option>
														<option value="1GB">1GB</option>
													</select>
		                                    </div>
		                                    <i class="lni-chevron-down"></i>
		                                </div>
		                                <div class="form-group inputwithicon">
		                                    <div class="select">
												<select required="required" name="supplier" id="supplier">
													<option value="">Supplier</option>
													@foreach($suppliers as $v)
														<option value="{{$v->id}}">{{$v->supplier_name}}</option>
													@endforeach	
													</select>
		                                    </div>
		                                    <i class="lni-chevron-down"></i>
		                                </div>
		                                <button class="btn btn-common" type="submit"><i class="lni-search"></i> Search Now</button>
		                            </form>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
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

		@if(count($data)>0)
		<div class="container mb-5 mt-5">
			<div class="row">
				<table class="table">
					<thead class="bg-primary text-white">
						<tr>
							<th scope="col">Brand</th>
							<th scope="col">Model</th>
							<th scope="col">Price</th>
							<th scope="col">Storage</th>
							<th scope="col">Supplier</th>
							@if($filterType == 1)
							<th scope="col">Distance</th>
							@endif
							<th scope="col" colspan="2" style="text-align:center">
								{{-- <form action="{{ url('/devices') }}" method="get" id="sortBy" onchange="sortingFunc()">
									<div class="form-group">
										<select class="form-control" name="filter">
										<option value="1" @if($filterType == 1) selected="" @endif>Distance</option>
										<option value="2" @if($filterType == 2) selected="" @endif>Price</option>
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
								<td>{{$value['brand']['brand_name']}}</td>
								<td>{{$value['brand']['model_name']}}</td>
								<td>{{$value['price']}}</td>
								<td>{{$value['storage']}}</td>
								<td>{{$value['supplier']['supplier_name']}}</td>
								<td>{{$value['distance']}} KM</td>
								<td>
								@if(Auth::guard('customer')->check())
									<td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value['id'])}}">Details</td>
								@else
									<td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</td>
								@endif
								</td>
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
	<!-- Content End Here -->
<script>

function sortingFunc(){
	$('#sortBy').submit();
}
	
</script>
@endsection