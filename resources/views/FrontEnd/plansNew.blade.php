@extends('layouts.frontend_layouts.frontend')
@section('title', 'Plans')
@section('content')

<!-- Content Start Here -->
<section id="main-top-section" >
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="device-heading-title">Search for Plans</h1>
				</div>
			</div>
			<div class="col-7 text-right">
				<form action="{{url('/plans')}}" method="get" class="w-100">
					<div class="row justify-content-end">
						<div class="col-9">
							<input type="text" placeholder="Location" id="searchMapInput" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif" name="address" class="location-input"/>
						</div>
						<div class="col-3">
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
						@if($filtersetting->personal_business_setting == 1)
						<div class="col-4 pr-0 text-right mt-4">
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
						<div class="col-4 text-center pl-0 pr-0 mt-4">
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

						<div class="col-4 pl-0 text-left mt-4">
							<div class="form-group plan_page">
								<span class="toggle_label active">Pay as usage</span>
								<label class="switch">
									<input type="checkbox" onclick="payAsUsage()" value="0" id="pay_as_usage_id" name="pay_as_usage_type" @if( request()->get('pay_as_usage_type') ) @if( request()->get('pay_as_usage_type') == 1) checked @endif @endif>
									<span class="slider"></span>
								</label>
								<!-- <span class="toggle_label">On</span> -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<button type="submit" class="searchnow-button">Search Now</button>
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
					<h1 class="device-heading-title">Provider Near By</h1>
				</div>
			</div>

			<div class="col-md-10 m-auto">
				<div class="row">
					<div class="col-sm-4 col-md-4 mb-4">
						<div class="post">
							<div class="post-img-content">
								<img src="{{URL::asset('frontend/assets/img/348487_3595d4c42533437ba5c542bb996b8f48_mv2.png')}}" class="img-responsive"/>
							</div>
							<div class="post-content">
								<div class="row">
									<div class="col-12">
										<span class="date-post">January 14, 2017</span>
										<!-- <h4 class="text-blue">Fido</h4> -->
									</div>
								</div>
								<div class="row my-3">
									<div class="col-lg-12 rating provider">
										<div class="rating_disable" data-rate-value="4"></div>
									</div>
								</div>
								<div class="detail-section my-3 pb-4 border-bottom">
									<div class="row">
										<div class="col-lg-12">
											<p>The service is excellent and I'm enjoying the unlimited data on my mobile plan </p>					
										</div>
									</div>	
								</div>
								<div class="post-button">
									<div class="row align-items-center">
										<div class="col-lg-3">
											<img src="{{URL::asset('frontend/assets/img/727644b338ab465cad167dcaf9e69f84.webp')}}"/>					
										</div>
										<div class="col-lg-9">
											<p>SAM123</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 mb-4">
						<div class="post">
							<div class="post-img-content">
								<img src="{{URL::asset('frontend/assets/img/freedom.webp')}}" class="img-responsive"/>
							</div>
							<div class="post-content">
								<div class="row">
									<div class="col-12">
										<span class="date-post">January 14, 2017</span>
										<!-- <h4 class="text-blue">Fido</h4> -->
									</div>
								</div>
								<div class="row my-3">
									<div class="col-lg-12 rating provider">
										<div class="rating_disable" data-rate-value="4"></div>
									</div>
								</div>
								<div class="detail-section my-3 pb-4 border-bottom">
									<div class="row">
										<div class="col-lg-12">
											<p>The service is excellent and I'm enjoying the unlimited data on my mobile plan </p>					
										</div>
									</div>	
								</div>
								<div class="post-button">
									<div class="row align-items-center">
										<div class="col-lg-3">
											<img src="{{URL::asset('frontend/assets/img/12c903750c8d46ccb81ce6562a1923d9.webp')}}"/>					
										</div>
										<div class="col-lg-9">
											<p>Johnx234</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-md-4 mb-4">
						<div class="post">
							<div class="post-img-content">
								<img src="{{URL::asset('frontend/assets/img/Telus-Logo2.webp')}}" class="img-responsive"/>
							</div>
							<div class="post-content">
								<div class="row">
									<div class="col-12">
										<span class="date-post">January 14, 2017</span>
										<!-- <h4 class="text-blue">Fido</h4> -->
									</div>
								</div>
								<div class="row my-3">
									<div class="col-lg-12 rating provider">
										<div class="rating_disable" data-rate-value="4"></div>
									</div>
								</div>
								<div class="detail-section my-3 pb-4 border-bottom">
									<div class="row">
										<div class="col-lg-12">
											<p>The service is excellent and I'm enjoying the unlimited data on my mobile plan </p>					
										</div>
									</div>	
								</div>
								<div class="post-button">
									<div class="row align-items-center">
										<div class="col-lg-3">
											<img src="{{URL::asset('frontend/assets/img/8a49d97617ec470289d12539d3365e26.webp')}}"/>					
										</div>
										<div class="col-lg-9">
											<p>Briannoz21</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			@if(count($data)>0)
				<div class="col-lg-12">
					<table id="example" class="table table-striped custom-table " style="width:100%">
						<thead>
							<tr>
								<th>Provider</th>
								<th>Price</th>
								<th>Local Min</th>
								<th>Volume GB</th>
								<th>Review</th>
								<th>Distance</th>
								<th class="text-right">Details</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key => $value)
								<tr class="custom-row-cl @if($key == 4 || $key == 8) adds @endif">
									@if($key == 4)
										<td colspan="7">
											<div class="add text-center">
												<img src="{{URL::asset('frontend/assets/img/Iphone_ads.webp')}}"/>
											</div>
										</td>
									@elseif($key == 8)
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
									@else
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
	

@endsection