@extends('layouts.frontend_layouts.frontend')
@section('title', 'Profile')
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
	/*.service_list_design{
		width: 100%;
		box-shadow: 0 0 10px rgba(175, 175, 175, 0.65);
	    padding: 25px 30px 30px;
	    margin-bottom: 10px;
	}*/
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
	.rating_content {
	    width: 100%;
	}
</style>
<div class="profile inner-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="profile_section">
					<div class="profile_image text-center">
						<img class="w-50" src="{{URL::asset('/frontend/assets/img/user_placeholder.png')}}">
					</div>
					<div class="user_name text-center mt-3">
						<h5 class="mb-0">{{ Auth::guard('customer')->user()['firstname'] }} {{Auth::guard('customer')->user()['lastname'] }}</h5>
					</div>
				</div>
			</div>

			<div class="col-lg-9">
				<div class="profile_section">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Plans</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Devices</a>
					  </li>
					</ul>
					<div class="tab-content mt-2" id="myTabContent">
					  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						  	<div class="row mb-2">
						  		<div class="col-lg-12">
						  			<a class="btn btn-info pull-right add_service" href="{{url('reviews')}}">Add new plan</a>
						  		</div>
						  	</div>

						  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">   
						  	@if(count($serviceData)>0)
						  		@foreach($serviceData as $key => $service)

						  		<div class="panel panel-default">
					  	            <div class="panel-heading" role="tab" id="heading{{$service->id}}">
					  	                <h4 class="panel-title display-inline">
					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$service->id}}" aria-expanded="true" aria-controls="collapse{{$service->id}}" class="accordion_btn">
					  	                        <i class="more-less glyphicon glyphicon-plus"></i>
					  	                        <ul class="inline_list">
					  	                        	<li><b>Provider Name</b> : &nbsp;@if(!is_null($service->provider)) {{$service->provider->provider_name}}
					  	                        	@else
					  	                        	-
					  	                        	@endif
					  	                        	</li>
					  	                        	<li><b>Service Type</b> : &nbsp;@if(!is_null($service->typeOfService)) 
											  							{{$service->typeOfService['service_type_name']}}
											  							@else
											  	                        	-
										  	                        	@endif</li>
					  	                        	<li><b>Price</b> : &nbsp;&nbsp;{{$service->c_code}}&nbsp;{{$service->price}}</li>
					  	                        </ul>
					  	                        
					  	                        
					  	                    </a>
					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$service->id}}" aria-expanded="true" aria-controls="collapse{{$service->id}}" class="accordion_btn text-right">
					  	                    	@if(!is_null($service->provider)) 
						  	                    	@if($service->provider->status == 1)
							  	                    	<span class="font-weight-bold">Approved</span>
							  	                    @else
							  	                    	<span class="font-weight-bold text-danger">Not approved</span>
							  	                    @endif
				  	                        	@else
				  	                        	-
				  	                        	@endif
					  	                    	
						  	                </a>
					  	                </h4>
					  	            </div>
					  	            <div id="collapse{{$service->id}}" class="panel-collapse collapse @if($key == 0) show @endif" role="tabpanel" aria-labelledby="heading{{$service->id}}">
					  	                <div class="panel-body">
				  	                      	<div class="row">
										  		<div class="col-lg-12">
										  			<div class="service_list_design">
										  				<div class="row">
											  				
											  				<div class="col-lg-4">
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
											  				
											  				<div class="col-lg-4">
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
											  				<div class="col-lg-4">
											  					<div class="card_sm">
											  					<ul class="first_row_service">
											  						<li>
											  							<div>Review Date : </div>
											  							<div class="value_div">
											  								&nbsp;{{ date("d/m/Y", strtotime($service->review_date)) }}
											  							</div>
											  						</li>
											  					</ul>
											  					</div>
											  				</div>
											  				<div class="col-lg-4 mt-2">
											  					<div class="card_sm">
											  					<ul class="first_row_service">
											  						<li>
											  							<div>Service type : </div>
											  							<div class="value_div">
											  								
											  							&nbsp;
											  							@if(!is_null($service->typeOfService)) 
											  							{{$service->typeOfService['service_type_name']}}
											  							@else
											  	                        	-
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
											  							<div class="value_div">&nbsp;@if(!is_null($service->currency))
											  								{{$service->currency->currency_code}}@else-
											  								@endif&nbsp;{{$service->price}}</div>
											  						</li>
											  					</ul>
											  					</div>
											  				</div>
											  			</div>
											  			<div class="row">
											  				<div class="col-lg-12">
											  					<div class="heading detail-div">
					  					                            <h1 class="section-title">Ratings</h1>
					  					                        </div>
					  					                        <div class="add_new_rating_btn">
					  					                        	<a href="{{url('/reviews')}}/{{base64_encode($service->id)}}" class="btn btn-info pull-right add_service">Add rating</a>
					  					                        </div>
											  				</div>
											  				<!-- Rating -->
											  				@if(!is_null($service->ratings)) 
				  					  	                		@foreach($service->ratings as $key => $rating)
						  					  	                		@if($rating['plan_id']==$service->id)
										  					  	            <div class="panel-heading mt-2" role="tab" id="rating{{$service->id}}{{$key}}">
										  					  	                <h4 class="panel-title display-inline">
										  					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$service->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$key}}" class="accordion_btn rating_btn">
										  					  	                        <i class="more-less glyphicon glyphicon-plus"></i>
										  					  	                        <ul class="inline_list">
										  					  	                        	<li><b>Average</b> : &nbsp;{{$rating['average']}}
										  					  	                        	</li>
										  					  	                        </ul>
										  					  	                    </a>
										  					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$service->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$key}}" class="accordion_btn text-right">{{ date("d/m/Y", strtotime($rating['date'])) }}</a>
										  					  	                </h4>
										  					  	            </div>
										  					  	            <div id="ratingcollapse{{$service->id}}{{$key}}" class="panel-collapse collapse @if($key == 1) show @endif rating_content" role="tabpanel" aria-labelledby="rating{{$service->id}}{{$key}}">
										  					  	                <div class="panel-body w-100">
										  					  	                	<div class="row">
									  					  	                		@foreach($rating['ratingList'] as $rate)
									  					  	                		@if($rate['entity_id'] == $service->id)
						  					  	                	  				<div class="col-lg-12 mb-3">
						  					  	                		  				<div class="card_sm">
						  					  	                		  					<div class="row">
					  					  	                			  					<div class="col-lg-8">
					  					  	                				  					{{$rate['question_name']}}
					  					  	                				  				</div>
					  					  	                				  				<div class="col-lg-4">
					  					  	                				  					<div class="rating_disable pull-right" data-rate-value="{{$rate['rating']}}"></div>
					  					  	                				  				</div>
						  					  	                				  			</div>
						  					  	                			  			</div>
						  					  	                			  		</div>
						  					  	                			  		@endif
						  					  	                			  		@endforeach
							  					  	                			  	</div>
							  					  	                			  	<div class="row">
							  					  	                			  		<div class="col-lg-12">
							  					  	                			  			<h6 class="text-center section-title">
							  					  	                			  				Comment
							  					  	                			  			</h6>
							  					  	                			  			<p>{{$rating['comment']}}</p>
							  					  	                			  		</div>
							  					  	                			  	</div>
										  					  	                </div>
										  					  	            </div>
															  				<div class="division"></div>
														  				@endif
		    		  					  	                		@endforeach
		      					  	                        	@endif
											  				<!-- Rating -->
													  		
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