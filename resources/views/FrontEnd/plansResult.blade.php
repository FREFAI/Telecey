@extends('layouts.frontend_layouts.frontend')
@section('title', 'Plans Result')
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
                    <h1>Our searching DUDE is working on your request</h1><br>
                    <h1>One moment and he will fetch the data for you </h1>
                </div>
			</div>
			<div class="col-5 text-center">
				<div class="right-banner autorotate">
					<img src="{{URL::asset('frontend/assets/img/9367.jpg')}}"/>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-12 text-center my-5">
				<div class="heading detail-div">
					<h1 class="device-heading-title">Provider Near By</h1>
				</div>
			</div>
		</div> -->
		<form action="{{url('/plans/result')}}" method="get" class="w-100" id="planSearch">
			<div class="row custom_width align-items-center">
				<div class="col-lg-7 record_section">
					<div class="location">
						<input type="text" placeholder="Location" id="searchMapInput" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif" name="address" class="location-input"/>
					</div>
				</div>
				<div class="col-lg-2 record_section">
					<div class="service_type">
						@if($filtersetting->mobile_home_setting == 1)
							<select class="service-type-select service_type" name="service_type">
								<option value="">Select service type</option>
								@if(count($service_types) > 0)
									@foreach($service_types as $type)
										<option value="{{$type->id}}" @if( request()->get('service_type') ) @if( request()->get('service_type') == $type->id) selected @endif @endif>{{$type->service_type_name}}</option>
									@endforeach
								@else
									<option disabled="">Not found</option>
								@endif
							</select>
						@endif
					</div>
				</div>
				<div class="col-lg-1 record_section">
					<select class="service-type-select paginate_select_box" name="rows">
						<option @if( request()->get('rows') == "10" ) selected @endif>10</option>
						<option @if( request()->get('rows') == "20" ) selected @endif>20</option>
						<option @if( request()->get('rows') == "30" ) selected @endif>30</option>
						<option @if( request()->get('rows') == "40" ) selected @endif>40</option>
						<option @if( request()->get('rows') == "50" ) selected @endif>50</option>
						<option @if( request()->get('rows') == "60" ) selected @endif>60</option>
						<option @if( request()->get('rows') == "70" ) selected @endif>70</option>
						<option @if( request()->get('rows') == "80" ) selected @endif>80</option>
						<option @if( request()->get('rows') == "90" ) selected @endif>90</option>
						<option @if( request()->get('rows') == "100" ) selected @endif>100</option>
					</select>
				</div>
				<div class="col-lg-1 record_section">
					<div class="text-center">
						<a title="Expend Filter" href="javascript:void(0);" onClick="filterExpend()" class="expendFilterbtn"><i class="fa fa-filter"></i></a>
					</div>
				</div>
				<div class="col-lg-1 text-right record_section">
					<div class="filter_button">
						<button type="submit"><img src="{{URL::asset('frontend/assets/img/filter.webp')}}"/></button>
					</div>
				</div>
				<div class="col-lg-4 expendedFilter">
					@if($filtersetting->personal_business_setting == 1)
					<div class="form-group plan_page mb-0">
						<span class="toggle_label active">Personal</span>
						<label class="switch">
							<input type="checkbox" id="personal" value="2" onClick="personalToggle()" name="contract_type" @if( request()->get('contract_type') ) @if( request()->get('contract_type') == 2) checked @endif @endif>
							<span class="slider"></span>
						</label>
						<span class="toggle_label">Business</span>
					</div>
					@endif
				</div>
				<div class="col-lg-4 expendedFilter">
					@if($filtersetting->postpaid_prepaid_setting == 1)
					<div class="form-group plan_page mb-0">
						<span class="toggle_label active">Postpaid</span>
						<label class="switch">
							<input type="checkbox" id="paymentTypeId" name="payment_type" value="prepaid" onClick=paymentType()  @if( request()->get('payment_type') ) @if( request()->get('payment_type') == 'prepaid') checked @endif @endif>
							<span class="slider"></span>
						</label>
						<span class="toggle_label">Prepaid</span>
					</div>
					@endif
				</div>
				<div class="col-lg-4 expendedFilter">
					<div class="form-group plan_page mb-0">
						<span class="toggle_label active">Pay as usage</span>
						<label class="switch">
							<input type="checkbox" onclick="payAsUsage()" value="0" id="pay_as_usage_id" name="pay_as_usage_type" @if( request()->get('pay_as_usage_type') ) @if( request()->get('pay_as_usage_type') == 1) checked @endif @endif>
							<span class="slider"></span>
						</label>
						<!-- <span class="toggle_label">On</span> -->
					</div>
				</div>
				@if($filtersetting->unlimited_calls_setting == 1)
				<div class="col-lg-4 pay_as_usage_type expendedFilter">
					<div class="form-group plan_page">
						<span class="toggle_label">Unlimited Calls</span>
						<label class="switch">
							<input type="checkbox" checked="" onclick="myFunction()" id="unlimited">
							<span class="slider"></span>
						</label>
						<select id="unlimited_calls" class="mbps-select d-none w-40">
							<option value="100" selected>100 mins</option>
							<option value="200">200 mins</option>
							<option value="300">300 mins</option>
							<option value="500">500 mins</option>
						</select>
					</div>
				</div>
				@endif
				@if($filtersetting->gb_setting == 1)
				<div class="col-lg-3 text-center pay_as_usage_type expendedFilter">
					<div class="form-group">
						<select id="inputState" class="mbps-select">
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
				@endif
				@if($filtersetting->mb_setting == 1)
				<div class="col-lg-3 text-center pay_as_usage_type expendedFilter">
					<div class="form-group">
						<select id="inputState" class="mbps-select">
							<option selected value="" disabled="">Mbps</option>
							<option value="100">100 Mbps</option>
							<option value="200">200 Mbps</option>
							<option value="300">300 Mbps</option>
							<option value="400">400 Mbps</option>
							<option value="500">500 Mbps</option>
						</select>
					</div>
				</div>
				@endif
			</div>
		</form>
		<div class="row record_section">
			@if(count($data)>0)
				<div class="col-lg-12">
					<table id="example" class="table table-striped custom-table plan_sorting" style="width:100%" data-url="{{url('/plans/resultSorting')}}">
						<thead>
							<tr>
								<th>Provider</th>
								<th @if(!Auth::guard('customer')->check())
											@if($filtersetting->disable_price_for_logged_out_users == 1)
												class="custom_sorting"
											@endif
										@else
										class="custom_sorting"
										@endif data-name="price" data-sort="asc" >Price
										@if(!Auth::guard('customer')->check())
											@if($filtersetting->disable_price_for_logged_out_users == 1)
												<i class="fas fa-arrow-down"></i>
											@endif
										@else
										<i class="fas fa-arrow-down"></i>
										@endif</th>
								<th class="custom_sorting" data-name="local_min" data-sort="asc" >Local Min <i class="fas fa-arrow-down"></i></th>
								<th class="custom_sorting" data-name="datavolume" data-sort="asc" >Volume GB <i class="fas fa-arrow-down"></i></th>
								<th class="custom_sorting" data-name="average_review" data-sort="asc" >Review <i class="fas fa-arrow-down"></i></th>
								<th class="custom_sorting" data-name="distance" data-sort="asc" >Distance <i class="fas fa-arrow-down"></i></th>
								<th class="text-right">Details</th>
							</tr>
						</thead>
						<tbody class="table_body_sort">
							@foreach($data as $key => $value)
								@if($key == 4)
								<tr class="custom-row-cl @if($key == 4 || $key == 8) adds @endif">
									<td colspan="7">
										<div class="add text-center">
											<img src="{{URL::asset('frontend/assets/img/Iphone_ads.webp')}}"/>
										</div>
									</td>
								</tr>
								@elseif($key == 8)
								<tr class="custom-row-cl @if($key == 4 || $key == 8) adds @endif">
									<td colspan="7">
										<div class="row align-items-center">
											<div class="col-lg-6 text-center">
												<img src="{{URL::asset('frontend/assets/img/case.webp')}}"/>
											</div>
											<div class="col-lg-6">
												<h1 class="adds-text">The Ultimate cover</h1>
											</div>
										</div>
									</td>
								</tr>
								@endif
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
						@if($filtersetting->no_of_search_record == 0)
							<div class="pagination">
								{{$data->appends(request()->input())->links()}}
							</div>
						@endif
					@endif
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
		</div>
	</div>
	<div class="container-fluid">
		<div class="row bg-blue">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="device-heading-title section-title text-white">Subscribe Form</h1>
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
	</div>
</section>
<script src="{{URL::asset('frontend/assets/js/jquery-min.js')}}"></script>
<style>
	.custom_sorting{
		cursor: pointer;
	}
	.custom_sorting i {
    	font-size: 13px;
	}
	th.custom_sorting {
		font-size: 17px;
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
	input:checked + .slider {
		background-color: #2e75b5;
	}
	.pagination{
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
<script>
	function initMap() {
		var input = document.getElementById('searchMapInput');
	
		var autocomplete = new google.maps.places.Autocomplete(input);
	
		autocomplete.addListener('place_changed', function() {
			var place = autocomplete.getPlace();
		});
	}	
	function myFunction() {
		var checkBox = document.getElementById("unlimited");
		var text = document.getElementById("unlimited_calls");
		if (checkBox.checked == true){
			$('#unlimited_calls').addClass('d-none');
		} else {
			$('#unlimited_calls').removeClass('d-none');
		}
	}
	setTimeout(() => {
		$('.loading_section').hide();
		$('.record_section').show();
	}, 3000);
	function filterExpend(){
		$('.expendedFilter').toggle();
	}
	$(document).on('click','.custom_sorting',function(){
		$('#loader').show();
		var requestParams = location.search;
		var name = $(this).attr('data-name');
		var sort = $(this).attr('data-sort');
		var resuesturl = $('.plan_sorting').attr('data-url');
		if(sort == 'asc'){
			$(this).attr('data-sort','desc');
			$(this).find('i').attr('class','fas fa-arrow-down');
		}else{
			$(this).attr('data-sort','asc');
			$(this).find('i').attr('class','fas fa-arrow-up');
		}
		$.ajax({
			type: "post",
			url: resuesturl,
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

				$(".rating_disable").rate({
					readonly:true
				});
				$('#loader').hide();
			}         
		});
		
	});
	// $('.paginate_select_box').on('change',function(){
	// 	$('#planSearch').submit();
	// });
</script>
	

@endsection