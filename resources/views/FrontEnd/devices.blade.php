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
	.search-bar .search-inner{
		overflow:unset;
	}
	select#brand_select {
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
		height: 42px;
		line-height: 50px;
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

	/* .dropdown-select:active,
	.dropdown-select.open {
		background-color: #fff !important;
		border-color: #bbb;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05) inset;
	} */

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

	.dropdown-select.wide {
		width: 100%;
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
	input#txtSearchValue{
		height:30px;
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
		color: #12cbc4;
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
												<select name="brand_name" id="brand_select" data-url="{{url('/searchBrand')}}">
													<option value="">Brand</option>
													@foreach($brands as $v)
														<option value="{{$v->id}}" @if( request()->get('brand_name') ) @if( request()->get('brand_name') == $v->id) selected @endif @endif>{{$v->brand_name}} {{$v->model_name}}</option>
													@endforeach
												</select>
											</div>
											<i class="lni-chevron-down"></i>
										</div>
										<div class="form-group inputwithicon">
											<div class="select">
												<select name="storage" id="storage">
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
										<div class="form-group inputwithicon">
											<div class="select">
												<select name="device_color" id="device_color">
													<option value="">Color</option>
													
												</select>
											</div>
											<i class="lni-chevron-down"></i>
										</div>
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
		$('#brand_select').each(function (i, select) {
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

		$('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
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

	function filter(){
		var actionurl = $('#brand_select').attr('data-url');
		var valThis = $('#txtSearchValue').val();
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

// End Select Box of model
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