@extends('layouts.frontend_layouts.frontend')
@section('title', 'Devices')
@section('content')
	<!-- Content Start Here -->
<section id="main-top-section" >
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="device-heading-title">{{__('device.title')}}</h1>
				</div>
			</div>
			<div class="col-7 text-right">
				<form action="{{url('/devices/result')}}" method="get" class="w-100">
					<div class="row position-relative">
						<div class="google-location-loader">
							<i class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="col-12">
							<input type="hidden" name="lat" class="currentLat" value="{{$current_lat}}">
							<input type="hidden" name="lng" class="currentLng" value="{{$current_long}}">
							<input type="hidden" name="country" class="currentCountry" value="{{$current_country_code}}">
							<input type="hidden" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif"  class="location-input-hidden"/>
							<input type="text" placeholder="Location" id="searchMapInput" value="" name="address" class="location-input search-input-field"/>
						</div>
						<div class="col-4 mt-4 devicenew">
							<select class="service-type-select service_type" name="brand_name" id="brand_select" data-url="{{url('/searchBrand')}}">
								<option value="">{{__('deviceresult.brand')}}</option>
								@foreach($brands as $v)
									<option value="{{$v->id}}" @if( request()->get('brand_name') ) @if( request()->get('brand_name') == $v->id) selected @endif @endif>{{$v->brand_name}} {{$v->model_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-4 mt-4">
							<div class="form-group plan_page inputwithicon">
								<div class="select">
									<select name="storage" id="storage" class="service-type-select  service_type">
										<option value="">{{__('deviceresult.capacity')}} </option>
										<option value="64" @if( request()->get('storage') ) @if( request()->get('storage') == '64') selected @endif @endif>64</option>
										<option value="128" @if( request()->get('storage') ) @if( request()->get('storage') == '128') selected @endif @endif>128</option>
										<option value="256" @if( request()->get('storage') ) @if( request()->get('storage') == '256') selected @endif @endif>256</option>
										<option value="512" @if( request()->get('storage') ) @if( request()->get('storage') == '512') selected @endif @endif>512</option>
										<option value="1GB" @if( request()->get('storage') ) @if( request()->get('storage') == '1GB') selected @endif @endif>1GB</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-4 mt-4">
							<div class="form-group plan_page inputwithicon">
								<div class="select">
									<select name="device_color" id="device_color" class="service-type-select  service_type">
										<option value="">{{__('index.Color')}}</option>
										
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<input type="hidden" value="20" name="rows"/>
						<div class="col-md-12 text-center">
							<button type="submit" class="searchnow-button search-form-button">{{__('device.search_now_btn')}}</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-5 text-center">
				<div class="right-banner">
					<img src="{{URL::asset('frontend/assets/img/2801276.jpg')}}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center my-5">
				<div class="heading detail-div">
					<h1 class="device-heading-title">{{__('device.title_one')}}</h1>
				</div>
			</div>

			<div class="col-md-10 m-auto">
				<div class="row">
					@if(count($data)>0)
						@foreach($data as $key => $value)
							<div class="col-sm-4 col-md-4 mb-4">
								<div class="post">
									<div class="post-img-content">
										@if(isset($value['provider']) && $value['provider']['provider_image_original'] != "")
											<img src="{{URL::asset('providers/provider_original')}}/{{$value['provider']['provider_image_original']}}" class="img-responsive"/>
											@else
											<img src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" class="img-responsive"/>
										@endif
									</div>
									<div class="post-content">
										<div class="row">
											<div class="col-12">
												<span class="date-post">{{ date('M d, Y',strtotime($value['created_at'])) }}</span>
												<!-- <h4 class="text-blue">Fido</h4> -->
											</div>
										</div>
										<div class="row my-3">
											<div class="col-lg-12 provider">
												<div class="rating_disable" data-rate-value="{{$value['average_review']}}"></div>
											</div>
										</div>
										<div class="detail-section my-1 pb-1">
											<div class="row">
												<div class="col-lg-12 comment_section">
													@if($value['plan_rating'])
														
														@if(strlen(strip_tags($value['plan_rating']['comment'])) > 80) 
														<p>{{substr(strip_tags($value['plan_rating']['comment']),0,80)}}...</p>
														@elseif(strlen(strip_tags($value['plan_rating']['comment'])) == 0) 
														<p>{{__("index.The service is excellent and I'm enjoying the unlimited data on my mobile plan")}} </p>
														@else
															<p>{{substr(strip_tags($value['plan_rating']['comment']),0,80)}}</p>
														@endif
														
													@else
													<p>{{__("index.The service is excellent and I'm enjoying the unlimited data on my mobile plan")}} </p>	
													@endif
																	
												</div>
											</div>	
										</div>
										
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
		
	</div>
	<!-- <div class="container-fluid">
		<div class="row bg-blue">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="device-heading-title text-white">Subscribe Form</h1>
				</div>
			</div>
			<div class="col-md-8 offset-md-2">
				<div class="sign-up-email">
					<div class="form-group fields subscrib">
						<input type="text" class="form-control" placeholder="Email Address">
						<button class="btn btn-info">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</section>
<style>
	span.toggle_label{
		color: #000;
	}
	span.toggle_label.active{
		color: #000;
		font-weight: bold;
	}
	.rating {
		font-size: 25px;
	}
	/* .overlay_signup.w-100.text-center {
		background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#1a82f700), to(#b9b9b9));
		height: 230px;    
		margin-top: -40px;
    	z-index: 0;
		padding-top: 60px;
	} */
	.overlay_signup.w-100.text-center {
		height: 50px;
		z-index: 0;
	}
	.overlay_signup i.fa.fa-lock {
		border: 2px solid #2e76b5;
		border-radius: 50px;
		padding: 10px 14px;
		color: #2e76b5;
		margin-bottom: 10px;
		margin-top: -20px;
		background-color: #fff;
		position: absolute;
		box-shadow: 1px 1px 9px 0px #2e76b5;
	}
	.overlay_signup .signup_btn {
		border-radius: 30px;
		color: #333534;
	}
	.line-cl {
		width: 100%;
		height: 2px;
		background-color: #2e76b5;
		box-shadow: 1px 1px 9px 0px #2e76b5;
	}
	.searchnow-button {
		border: 2px solid #2e75b5;
		border-radius: 5px;
		padding: 2px 10px;
		color: #2e75b5;
	}
	.section-title:after {
		position: absolute;
		content: '';
		height: 3px;
		width: 70px;
		margin-left: 20px;
		bottom: 16px;
		background-color: #2e75b5;
	}
	.section-title:before {
		position: absolute;
		content: '';
		height: 3px;
		width: 70px;
		margin-left: -90px;
		bottom: 16px;
		background-color: #2e75b5;
	}
	.slider{
		background-color: #2e75b5;
    	border: 1px solid #2e75b5;
	}
	.dropdown-select.wide.service-type-select.service_type {
		border: 1px solid #2e75b5;
		height: 29px;
		line-height: 30px;
	}
	input#txtSearchValue {
		height: 30px;
		width: 100%;
		border-radius: 5px;
	}
	/* .searchnow-button:hover {
		border: 2px solid #2e75b5;
		background-color: #2e75b5;
		border-radius: 5px;
		padding: 2px 10px;
		color: #fff;
	} */
</style>
<!-- Content End Here -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
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
		$(".rating .rating_disable").rate({
			readonly: true,
		});
	});
	// function initMap() {
	//     var input = document.getElementById('searchMapInput');
	  
	//     var autocomplete = new google.maps.places.Autocomplete(input);
	   
	//     autocomplete.addListener('place_changed', function() {
	//         var place = autocomplete.getPlace();
	//     });
	// }

</script>
@endsection
@section('pageScript')
	<script>
		$('body, html').on('scroll',function(){
			$('input.search-input-field').blur();
		});
		getCurrentLocation();
		function getCurrentLocation() {
			$('.google-location-loader').css('display','flex');
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(geoSearchSuccess, geoSearchError,{ enableHighAccuracy: true, maximumAge: 10000 });
			} else {
				console.log("Geolocation is not supported by this browser.");
			}
		}
		function geoSearchSuccess(position) {
			var lat = position.coords.latitude;
			var lng = position.coords.longitude;
			$('.currentLat').val(lat)
			$('.currentLng').val(lng)
			codeLatLngSearch(lat, lng);
		}
		function geoSearchError(error) {
			$('.location-input').val($('.location-input-hidden').val());
			$('.google-location-loader').css('display','none');
			console.log("Geocoder failed",error);
		}
		var geocoder;
		function initialize() {
			geocoder = new google.maps.Geocoder();
		}
		function codeLatLngSearch(lat, lng) {
			var searchAddr = {};
			var latlng = new google.maps.LatLng(lat, lng);
			geocoder.geocode({ latLng: latlng }, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[1]) {
						for (let ii = 0; ii < results[0].address_components.length; ii++) {
							var street_number = (route = street = city = state = zipcode = country = formatted_address = "");
							var types = results[0].address_components[ii].types.join(",");
							if (types == "street_number") {
								searchAddr.street_number = results[0].address_components[ii].long_name;
							}
							if (types == "route" || types == "point_of_interest,establishment") {
								searchAddr.route = results[0].address_components[ii].long_name;
							}
							if (types == "sublocality,political" || types == "locality,political" || types == "neighborhood,political" || types == "administrative_area_level_3,political") {
								searchAddr.city = city == "" || types == "locality,political" ? results[0].address_components[ii].long_name : city;
							}
							if (types == "administrative_area_level_1,political") {
								searchAddr.state = results[0].address_components[ii].short_name;
							}
							if (types == "postal_code" || types == "postal_code_prefix,postal_code") {
								searchAddr.zipcode = results[0].address_components[ii].long_name;
							}
							if (types == "country,political") {
								searchAddr.country = results[0].address_components[ii].long_name;
								searchAddr.countryCode = results[0].address_components[ii].short_name;
							}

						}
						let address = `${searchAddr.country}, ${searchAddr.state}, ${searchAddr.city}, ${searchAddr.zipcode}`
						$(".location-input").val(address);
						$('.google-location-loader').css('display','none');
					}
				}
			});
		}
	</script>
@endsection
