@extends('layouts.frontend_layouts.frontend')
@section('content')
<style type="text/css">
	.profile{
		padding-top: 163px;
		background-color: #fff;
	}
	.profile_section{
		box-shadow: 0 0 10px rgba(175, 175, 175, 0.65);
	    padding: 25px 30px 30px;
	    margin-bottom: 10px;
	}
	.service_list_design{
		width: 100%;
		box-shadow: 0 0 10px rgba(175, 175, 175, 0.65);
	    padding: 25px 30px 30px;
	    margin-bottom: 10px;
	}
	ul.first_row_service {
		font-size: 16px;
	}
	/*.card_sm{
		box-shadow: 0 0 5px rgba(175, 175, 175, 0.78);
	    margin-bottom: 10px;
	    padding: 5px;
	}*/
	.value_div{
		font-weight: bold;
	}
</style>
<div class="profile inner-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="profile_section">
					<div class="profile_image text-center">
						<img class="w-50" src="frontend/assets/img/user_placeholder.png">
					</div>
					<div class="user_name text-center mt-3">
						<h5 class="mb-0">{{ Auth::guard('customer')->user()['firstname'] }}</h5>
					</div>
				</div>
			</div>

			<div class="col-lg-9">
				<div class="profile_section">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Service</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Products</a>
					  </li>
					</ul>
					<div class="tab-content mt-2" id="myTabContent">
					  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					  	<div class="row mb-2">
					  		<div class="col-lg-12">
					  			<a class="btn btn-info pull-right" href="{{url('reviews')}}">Add review</a>
					  		</div>
					  	</div>
					  	@if(count($serviceData)>0)
					  		@foreach($serviceData as $service)
							  	<div class="row">
							  		<div class="col-lg-12">
							  			<div class="service_list_design">
							  				<div class="row">
								  				<div class="col-lg-6">
								  					<div class="card_sm">
									  					<ul class="first_row_service">
									  						<li>
									  							<div>Provider Name : </div>
									  							<div class="value_div">&nbsp;{{$service->provider_name}}</div>
									  						</li>
									  					</ul>
									  				</div>
								  				</div>
								  				<div class="col-lg-6">
								  					<div class="card_sm">
									  					<ul class="first_row_service">
									  						<li>
									  							<div>Contract type : </div>
									  							<div class="value_div">&nbsp;
									  								@if($service->contract_type == 1) 
									  									Personal
									  								@else
									  									Business
									  								@endif
									  						</div>
									  						</li>
									  					</ul>
								  					</div>
								  				</div>
								  				
								  				<div class="col-lg-4 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>Payment type : </div>
								  							<div class="value_div">
								  								&nbsp;{{$service->payment_type}}
								  							</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-5 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>Service type : </div>
								  							<div class="value_div">
								  							&nbsp;
								  							@if($service->service_type == "home_internet") 
							  									Home Internet
							  								@elseif($service->service_type == "landline")
							  									Landline
							  								@elseif($service->service_type == "mobile_plan")
							  									Mobile Plan
							  								@elseif($service->service_type == "package")
							  									Package
							  								@elseif($service->service_type == "familly_share_plan")
							  									Familly Share Plan
							  								@elseif($service->service_type == "businesss_internet")
							  									Businesss Internet
							  								@elseif($service->service_type == "business_landline")
							  									Business Landline
							  								@elseif($service->service_type == "coorperate_mobile_plan")
							  									Coorperate Mobile Plan
							  								@endif</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-3 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>Local Min : </div>
								  							<div class="value_div">&nbsp;{{$service->local_min}}
								  							</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-4 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>DataVolume : </div>
								  							<div class="value_div">&nbsp;{{$service->datavolume}}</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-4 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>Long distance Min : </div>
								  							<div class="value_div">&nbsp;{{$service->long_distance_min}}</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-4 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>International Min : </div>
								  							<div class="value_div">&nbsp;{{$service->international_min}}</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-4 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>Roaming Min : </div>
								  							<div class="value_div">&nbsp;{{$service->roaming_min}}</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-4 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>Data speed : </div>
								  							<div class="value_div">&nbsp;{{$service->data_speed}}</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-4 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>SMS : </div>
								  							<div class="value_div">&nbsp;{{$service->sms}}</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  				<div class="col-lg-12 mt-2">
								  					<div class="card_sm">
								  					<ul class="first_row_service">
								  						<li>
								  							<div>How much are you paying monthly multi currencies should be supported : </div>
								  							<div class="value_div">&nbsp;{{$service->price}}</div>
								  						</li>
								  					</ul>
								  					</div>
								  				</div>
								  			</div>
								  			<div class="row">
								  				<div class="col-lg-12">
								  					<div class="heading detail-div">
		  					                            <h1 class="section-title">Rating</h1>
		  					                        </div>
								  				</div>
								  				<div class="col-lg-12 mb-3">
									  				<div class="card_sm">
									  					<div class="row">
										  					<div class="col-lg-8">
											  					Coverage
											  				</div>
											  				<div class="col-lg-4">
											  					<div class="rateing_disable pull-right" data-rate-value={{$service->coverage}}></div>
											  				</div>
											  			</div>
										  			</div>
										  		</div>
										  		<div class="division"></div>
										  		<div class="col-lg-12 mb-3">
									  				<div class="card_sm">
									  					<div class="row">
										  				<div class="col-lg-8">
										  					Service Stability some time calls are disconnected, network is up and down , some times there is no coverage
										  				</div>
										  				<div class="col-lg-4">
										  					<div class="rateing_disable pull-right" data-rate-value={{$service->service_stability}}></div>
										  				</div>
										  				</div>
										  			</div>
										  		</div>
										  		<div class="division"></div>
										  		<div class="col-lg-12 mb-3">
									  				<div class="card_sm">
									  					<div class="row">
										  				<div class="col-lg-8">
										  					Billing & paymnet accuracy
										  				</div>
										  				<div class="col-lg-4">
										  					<div class="rateing_disable pull-right" data-rate-value={{$service->billing_payment}}></div>
										  				</div>
										  				</div>
										  			</div>
										  		</div>
										  		<div class="division"></div>
										  		<div class="col-lg-12 mb-3">
									  				<div class="card_sm">
									  					<div class="row">
										  				<div class="col-lg-8">
										  					Data speed You may use our speed test to get what speed you are getting for real
										  				</div>
										  				<div class="col-lg-4">
										  					<div class="rateing_disable pull-right" data-rate-value={{$service->data_speed_rating}}></div>
										  				</div>
										  				</div>
										  			</div>
										  		</div>
										  		<div class="division"></div>
								  				<div class="col-lg-12 mb-3">
									  				<div class="card_sm">
									  					<div class="row">
										  				<div class="col-lg-8">
										  					Customer Service Waiting time, knowlage, response, understanding, final solution time
										  				</div>
										  				<div class="col-lg-4">
										  					<div class="rateing_disable pull-right" data-rate-value={{$service->service_waiting}}></div>
										  				</div>
										  				</div>
										  			</div>
										  		</div>
										  		<div class="division"></div>
								  				<div class="col-lg-12 mb-3">
									  				<div class="card_sm">
									  					<div class="row">
										  				<div class="col-lg-8">
										  					Qulaity Such as Voice clearance, echo, some times you can hear your own voice
										  				</div>
										  				<div class="col-lg-4">
										  					<div class="rateing_disable pull-right" data-rate-value={{$service->voice_quality}}></div>
										  				</div>
										  				</div>
										  			</div>
										  		</div>
								  			</div>
							  			</div>
							  		</div>
							  	</div>
						  	@endforeach
					  	@else
					  		<div class="row">
					  			<div class="col-lg-12">
					  				<h3 class="text-center pt-3">
					  					No data found
					  				</h3>
					  			</div>
					  		</div>
					  	@endif
					  </div>
					  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					  	<div class="row">
					  			<div class="col-lg-12">
					  				<h3 class="text-center pt-3">
					  					No data found
					  				</h3>
					  			</div>
					  		</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection