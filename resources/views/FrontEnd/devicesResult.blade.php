@extends('layouts.frontend_layouts.frontend')
@section('title', 'Devices Result')
@section('content')
	<!-- Content Start Here -->
<section id="main-top-section" >
	<div class="container">
        <div class="row align-items-center mb-5 loading_section">
			<!-- <div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="device-heading-title">Search for Plans</h1>
				</div>
			</div> -->
			<div class="col-7 text-center">
                <div class="loading">
					<h1>{{__('planresult.title')}}</h1><br>
                    <h1>{{__('planresult.title2')}} </h1>
                </div>
			</div>
			<div class="col-5 text-center">
				<div class="right-banner autorotate">
					<img src="{{URL::asset('frontend/assets/img/9367.jpg')}}"/>
				</div>
			</div>
		</div>
		<form action="{{url('/devices/result')}}" method="get" class="w-100" id="deviceForm">
			<div class="row custom_width align-items-center">
				<div class="col-lg-7 record_section">
					<div class="location">
						<input type="text" placeholder="Location" id="searchMapInput" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif" name="address" class="location-input"/>
					</div>
				</div>
				<div class="col-lg-3 record_section">
					<select class="service-type-select service_type" name="brand_name" id="brand_select" data-url="{{url('/searchBrand')}}">
						<option value="">Brand</option>
						@foreach($brands as $v)
							<option value="{{$v->id}}" @if( request()->get('brand_name') ) @if( request()->get('brand_name') == $v->id) selected @endif @endif>{{$v->brand_name}} {{$v->model_name}}</option>
						@endforeach
					</select>
				</div>
				<input type="hidden" name="rows" id="paginate_input" value="{{request()->get('rows')}}"/>
				<div class="col-lg-1 record_section">
					<div class="text-center">
						<a title="Expend Filter" href="javascript:void(0);" onClick="filterExpend()" class="expendFilterbtn"><i class="fa fa-filter"></i></a>
					</div>
				</div>
				<div class="col-lg-1 text-right record_section">
					<div class="filter_button">
						<button type="submit"><img src="{{URL::asset('frontend/assets/img/filter.jpg')}}"/></button>
					</div>
				</div>
				<div class="col-lg-4 expendedFilter">
					<div class="form-group plan_page inputwithicon">
						<div class="select">
							<select name="storage" id="storage" class="service-type-select  service_type">
								<option value="">Capacity</option>
								<option value="64" @if( request()->get('storage') ) @if( request()->get('storage') == '64') selected @endif @endif>64</option>
								<option value="128" @if( request()->get('storage') ) @if( request()->get('storage') == '128') selected @endif @endif>128</option>
								<option value="256" @if( request()->get('storage') ) @if( request()->get('storage') == '256') selected @endif @endif>256</option>
								<option value="512" @if( request()->get('storage') ) @if( request()->get('storage') == '512') selected @endif @endif>512</option>
								<option value="1GB" @if( request()->get('storage') ) @if( request()->get('storage') == '1GB') selected @endif @endif>1GB</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-4 expendedFilter">
					<div class="form-group plan_page inputwithicon">
						<div class="select">
							<select name="device_color" id="device_color" class="service-type-select  service_type">
								<option value="">Color</option>
								
							</select>
						</div>
					</div>
				</div>
			</div>
		</form>
		@if(count($data)>0)
		<div class="row record_section">
			<div class="col-lg-12">
				<table id="example" class="table table-striped custom-table device_sorting" style="width:100%" data-url="{{url('/devices/resultSorting')}}">
					<thead>
						<tr>
							<th class="custom_sorting" data-name="brand_name" data-sort="asc">Brand <i class="fas fa-arrow-down"></i></th>
							<th class="custom_sorting" data-name="model_name" data-sort="asc">Model <i class="fas fa-arrow-down"></i></th>
							<th class="custom_sorting" data-name="supplier_name" data-sort="asc">Supplier <i class="fas fa-arrow-down"></i></th>
							<th class="custom_sorting" data-name="price" data-sort="asc">Price <i class="fas fa-arrow-down"></i></th>
							<th class="custom_sorting" data-name="storage" data-sort="asc">Capacity <i class="fas fa-arrow-down"></i></th>
							<th class="custom_sorting" data-name="distance" data-sort="asc">Distance <i class="fas fa-arrow-down"></i></th>
							<th class="text-center">{{ __('deviceresult.detail_btn') }}</th>
						</tr>
					</thead>
					<tbody class="table_body_sort">
						@php
							$i = ($data->currentpage()-1)* $data->perpage() + 1;
							$custom_ads = 0;
							$j = 0; 
						@endphp
						@foreach($data as $key => $value)
							<tr class="custom-row-cl">
								<td>{{$value->brand ? $value->brand->brand_name : ""}}</td>
								<td>{{$value->brand ? $value->brand->model_name : ""}}</td>
								<td>{{$value->supplier ? $value->supplier->supplier_name : ""}}</td>
								<td>{{$value->price}}</td>
								<td>{{$value->storage}}</td>
								<td>{{round($value->distance)}} KM</td>
								@if(Auth::guard('customer')->check())
									<td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value->id)}}">{{__('deviceresult.detail_btn')}}</td>
								@else
									<td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</td>
								@endif
							</tr>
							@if($i%10 == 0)
								@if($custom_ads === 0)
									@if($j < count($ads))
										@php $custom_ads = 1; @endphp
										<tr class="custom-row-cl @if($i%10 == 0) adds @endif">
											<td colspan="7">
												<div class="add text-center">
													
													<img src="{{URL::asset('ads_banner/resized')}}/{{$ads[$j]['ads_file']}}"/>
												</div>
											</td>
										</tr>
										@php $j++; @endphp
									@else
										@php $custom_ads = 1; $j = 0;@endphp
										<tr class="custom-row-cl @if($i%10 == 0) adds @endif">
											<td colspan="7">
												<div class="add text-center">
													
													<img src="{{URL::asset('ads_banner/resized')}}/{{$ads[$j]['ads_file']}}"/>
												</div>
											</td>
										</tr>
										@php $j++; @endphp
									@endif
								@else
									@php $custom_ads = 0; @endphp
									@if($googleads)
										@if($googleads->script != "")
										<tr class="custom-row-cl adds">
											<td colspan="7">
												<div class="row align-items-center">
													{!!$googleads->script!!}
													<!-- <div class="col-lg-6 text-center">
														<img src="{{URL::asset('frontend/assets/img/case.jpg')}}"/>
													</div>
													<div class="col-lg-6">
														<h1 class="adds-text">The Ultimate cover</h1>
													</div> -->
												</div>
											</td>
										</tr> 
										@endif
									@endif
								@endif
							@endif
							@php $i++;@endphp
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
					<div class="row align-items-center" style="width: 970px !important; margin: 0 auto;">
						<div class="col-lg-9">
							<div class="pagination">
								{{$data->appends(request()->input())->links()}}
							</div>
						</div>
						<div class="col-lg-3 rows_per_page">
							<div class="inner_rows mb-2">
								<label>Items Per Page</label>
								<select class="service-type-select paginate_select_box" name="rows">
									<option @if( request()->get('rows') == "20" ) selected @endif>20</option>
									<option @if( request()->get('rows') == "50" ) selected @endif>50</option>
									<option @if( request()->get('rows') == "70" ) selected @endif>70</option>
									<option @if( request()->get('rows') == "100" ) selected @endif>100</option>
									<option @if( request()->get('rows') == "200" ) selected @endif>200</option>
								</select>
							</div>
						</div>
					</div>
				@else
					@if($filtersetting->no_of_search_record == 0)
						<div class="pagination">
							{{$data->appends(request()->input())->links()}}
						</div>
					@endif
				@endif
			</div>
		</div>
		@else
			<div class="row pt-5 pb-5 mt-5 mb-5 record_section">
				<div class="col text-center">
					<div class="heading noSearchMessage">
						<p>{!!$filtersetting->no_search_message!!}</p>
					</div>
				</div>
			</div>
		@endif 
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
	.custom_sorting i {
    	font-size: 13px;
	}
	.custom_sorting{
		cursor: pointer;
	}
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
	.overlay_signup.w-100.text-center {
		background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#1a82f700), to(#141414));
		height: 230px;    
		margin: -40px auto 0;
		width: 970px !important;
    	z-index: 0;
		padding-top: 60px;
	}
	/* a.btn.table-row-btn.signup_btn {
		background: #2e75b5;
		color: #fff;
		border-color: #2e75b5;
	} */
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
	.pagination {
		width: 970px;
		margin: 10px auto;
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
    setTimeout(function(){
        $('.loading_section').hide();
        $('.record_section').show();
    }, 3000);
	$('.paginate_select_box').on('change',function(){
		$('#paginate_input').val($(this).val());
		$('#deviceForm').submit();
	});
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
	function initMap() {
	    var input = document.getElementById('searchMapInput');
	  
	    var autocomplete = new google.maps.places.Autocomplete(input);
	   
	    autocomplete.addListener('place_changed', function() {
	        var place = autocomplete.getPlace();
	    });
	}
	function filterExpend(){
		$('.expendedFilter').toggle();
	}
	// Sorting 
	$(document).on('click','.custom_sorting',function(){
		$('#loader').show();
		var requestParams = location.search;
		var name = $(this).attr('data-name');
		var sort = $(this).attr('data-sort');
		var requestUrl = $('.device_sorting').attr('data-url');
		if(sort == 'asc'){
			$(this).attr('data-sort','desc');
			$(this).find('i').attr('class','fas fa-arrow-down');
		}else{
			$(this).attr('data-sort','asc');
			$(this).find('i').attr('class','fas fa-arrow-up');
		}
		$.ajax({
			type: "post",
			url: requestUrl,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			dataType:'html',
			data: {
				'requestParams': requestParams,
				'name':name,
				'sort':sort
			},
			success: function (data) {
				$('.table_body_sort').html(data);

				// $(".rating_disable").rate({
				// 	readonly:true
				// });
				$('#loader').hide();
			}         
		});
		
	});
</script>
@endsection