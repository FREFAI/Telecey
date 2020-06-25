@extends('layouts.frontend_layouts.frontend')
@section('title', 'Plans')
@section('content')

<!-- Content Start Here -->
<section id="main-top-section" >
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="device-heading-title">{{__('plan.title')}}</h1>
				</div>
			</div>
			<div class="col-7 text-right">
				<form action="{{url('/plans/result')}}" method="get" class="w-100">
					<div class="row">
						<div class="col-9">
							<input type="text" placeholder="Location" id="searchMapInput" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif" name="address" class="location-input"/>
						</div>
						<div class="col-3">
						@if($filtersetting->mobile_home_setting == 1)
							<select class="service-type-select service_type" name="service_type">
								<option value="">Service type</option>
								@if(count($service_types) > 0)
									@foreach($service_types as $type)
										<option value="{{$type->id}}" @if( request()->get('service_type') ) @if( request()->get('service_type') == $type->id) selected @endif @endif>{{$type->service_type_name}}</option>
									@endforeach
								@else
									<option disabled="">{{__('plan.not_found')}}</option>
								@endif
							</select>
						@endif
						</div>
						@if($filtersetting->personal_business_setting == 1)
						<div class="col-4 pr-0 text-right mt-4">
							<div class="form-group plan_page mb-0">
								<span class="toggle_label active">Personal</span>
								<label class="switch">
									<input type="checkbox" id="personal" value="2" onClick="personalToggle()" name="contract_type" @if( request()->get('contract_type') ) @if( request()->get('contract_type') == 2) checked @endif @endif>
									<span class="slider"></span>
								</label>
								<span class="toggle_label">Business</span>
							</div>
						</div>
						@endif
						@if($filtersetting->postpaid_prepaid_setting == 1)
						<div class="col-4 text-center pl-0 pr-0 mt-4">
							<div class="form-group plan_page mb-0">
								<span class="toggle_label active">Postpaid</span>
								<label class="switch">
									<input type="checkbox" id="paymentTypeId" name="payment_type" value="prepaid" onClick=paymentType()  @if( request()->get('payment_type') ) @if( request()->get('payment_type') == 'prepaid') checked @endif @endif>
									<span class="slider"></span>
								</label>
								<span class="toggle_label">Prepaid</span>
							</div>
						</div>
						@endif
						<input type="hidden" name="rows" value="20">
						<div class="col-4 pl-0 text-left mt-4">
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
						<div class="col-6 text-center pl-0 pr-0 mt-4 pay_as_usage_type">
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
						<div class="col-3 text-center mt-4 pay_as_usage_type">
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
						<div class="col-3 text-center mt-4 pay_as_usage_type">
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
					<div class="row">
						<div class="col-md-12 text-center">
							<button type="submit" class="searchnow-button">{{__('plan.search_now_btn')}}</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-5 text-center">
				<div class="right-banner">
					<img src="{{URL::asset('frontend/assets/img/153981-OUOERJ-745.jpg')}}"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center my-5">
				<div class="heading detail-div">
					<h1 class="device-heading-title">{{__('plan.provider_title')}}</h1>
				</div>
			</div>

			<div class="col-md-10 m-auto">
				<div class="row">
				@if(count($data)>0)
					@foreach($data as $key => $value)
						<div class="col-sm-4 col-md-4 mb-4">
							<div class="post">
								<div class="post-img-content">
									@if($value['provider']['provider_image_original'] != "")
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
									<div class="detail-section my-3 pb-4 border-bottom">
										<div class="row">
											<div class="col-lg-12 comment_section">
												@if($value['plan_rating'])
													
													@if(strlen(strip_tags($value['plan_rating']['comment'])) > 80) 
													<p>{{substr(strip_tags($value['plan_rating']['comment']),0,80)}}...</p>
													@elseif(strlen(strip_tags($value['plan_rating']['comment'])) == 0) 
													<p>The service is excellent and I'm enjoying the unlimited data on my mobile plan </p>
													@else
														<p>{{substr(strip_tags($value['plan_rating']['comment']),0,80)}}</p>
													@endif
													
												@else
												<p>The service is excellent and I'm enjoying the unlimited data on my mobile plan </p>	
												@endif
																
											</div>
										</div>	
									</div>
									<div class="post-button">
										<div class="row align-items-center">
											<div class="col-lg-3">
												<img src="{{URL::asset('frontend/assets/img/user_placeholder.png')}}"/>					
											</div>
											<div class="col-lg-9">
												<p>{{$value['user']['firstname']}} {{$value['user']['lastname']}}</p>
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
	function payAsUsage() {
	  var checkBox = document.getElementById("pay_as_usage_id");
	  if (checkBox.checked == true){
	    $('.pay_as_usage_type').hide('slow');
	  } else {
	    $('.pay_as_usage_type').show('slow');
	  }
	}
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
	

@endsection