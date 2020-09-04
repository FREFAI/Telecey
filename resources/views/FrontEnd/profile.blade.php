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
	    padding: 25px 24px 30px;
	    margin-bottom: 10px;
	}
	/*.service_list_design{
		width: 100%;
		box-shadow: 0 0 10px rgba(175, 175, 175, 0.65);
	    padding: 25px 30px 30px;
	    margin-bottom: 10px;
	}*/
	ul.first_row_service {
		font-size: 14px;
	}
	.question, .comment {
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
	div#change_password_model {
	    z-index: 999999;
	    background: #0000006b;
	}
	div#change_address_model {
	    z-index: 999999;
	    background: #0000006b;
	}
	.page-item.active .page-link {
	    z-index: 1;
	    color: #485056;
	    background-color: #96fdd4;
	    border-color: #96fdd4;
	}
	.inner-accordian{
		background-color: #2e75b5 !important;
	}
	.inner-accordian a{
		color: #fff !important;
		padding-top:8px !important; 
		padding-bottom:8px !important; 
	}
</style>
<div class="profile inner-page">
	<div class="container">
		@if(Auth::guard('customer')->user()['is_active'] == 0)
		<div class="alert alert-danger alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
	        We have sent an email with a confirmation link to your email address. Please verify your email <strong><a href="{{url('/resendVerifyEmail')}}">Click here</a></strong> to resend verification email.
		</div>
		@endif
		@include('flash-message')
		<!-- @include('flash-message') -->
		<div class="row">
			<div class="col-lg-3 mb-3">
				<div class="profile-sidebar">
					<div class="profile_section">
						<div class="profile_image text-center">
							<img class="w-50" src="{{URL::asset('/frontend/assets/img/user_placeholder.png')}}">
						</div>
						<div class="user_name text-center mt-3">
							<h4 class="mb-0">{{ Auth::guard('customer')->user()['firstname'] }} {{Auth::guard('customer')->user()['lastname'] }}</h4>
							<p>({{Auth::guard('customer')->user()['nickname'] }})</p>
							<small>{{__('profile.member_since')}}: {{date('d, F Y', strtotime(Auth::guard('customer')->user()['created_at'])) }}</small>
							@if(isset($customer->userAdderss))
								<div class="profile_address mt-2">
									<p>{{$customer->userAdderss['formatted_address']}}</p>
									<a data-user_id="{{Auth::guard('customer')->user()['id']}}" class="edit_address" href="javascript:void(0);"><i class="fa fa-edit"></i></a>
								</div>
							@endif
							<div class="reset_password_button mt-4">
								<button data-toggle="modal" data-target="#change_password_model" class="btn btn-info rounded change_password_button">{{__('profile.changes_password')}}</button>
							</div>
						</div>
					</div>
					<div class="profile-usermenu">
						<ul class="nav">
							<li>
								<a class="font-weight-bold">{{__('profile.total_plan')}}</a>
								<small class="pull-right">{{$customer->planCount}}</small>
							</li>
							<li>
								<a class="font-weight-bold">{{__('profile.plan_review')}}</a>
								<small class="pull-right">{{$customer->planReviewCount}}</small>
							</li>
							<li>
								<a class="font-weight-bold">{{__('profile.total_device')}}</a>
								<small class="pull-right">{{$customer->deviceDatacount}}</small>
							</li>
							<li>
								<a class="font-weight-bold">{{__('profile.device_review')}}</a>
								<small class="pull-right">{{$customer->deviceReviewCount}}</small>
							</li>
							<li>
								<a href="{{url('/contact-us')}}" class="font-weight-bold">{{__('profile.contact_us')}}</a>
							</li>
							<li>
								<a href="{{url('/blog-list')}}" class="font-weight-bold">{{__('profile.blog')}}</a>
							</li>
							<!-- <li>
								<a href="{{url('/add-blog')}}" class="font-weight-bold">Blogs</a>
							</li> -->
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-9 mb-3">
				<div class="profile_section">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item">
					    <a class="nav-link @if(!Request::get('type') || Request::get('type') == 1) active @endif" id="home-tab" href="{{url('/profile')}}" role="tab">{{__('profile.plans')}}</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link @if(Request::get('type') == 2) active @endif" id="profile-tab"  href="{{url('/profile')}}?type=2" role="tab" >{{__('profile.devices')}}</a>
					  </li>
					</ul>
					<div class="tab-content mt-2" id="myTabContent">
					  <div class="tab-pane fade @if(!Request::get('type') || Request::get('type') == 1) show active @endif" id="home" role="tabpanel" aria-labelledby="home-tab">
						  	<div class="row mb-2">
						  		<div class="col-lg-12">
						  			<a class="btn btn-info pull-right add_service" href="{{url('/reviews?type=1')}}">{{__('profile.add_new_plan')}}</a>
						  		</div>
						  	</div>

						  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> 
							  	@if(!Request::get('type') || Request::get('type') == 1)  
								  	@if(count($serviceData)>0)
								  		@foreach($serviceData as $key => $service)

								  		<div class="panel panel-default">
							  	            <div class="panel-heading" role="tab" id="heading{{$service->id}}">
							  	                <h4 class="panel-title display-inline">
							  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$service->id}}" aria-expanded="false" aria-controls="collapse{{$service->id}}" class="accordion_btn collapsed">
							  	                        <i class="more-less glyphicon glyphicon-plus"></i>
							  	                        <ul class="inline_list">
							  	                        	<li><b>{{__('profile.provider_name')}}</b> : &nbsp;@if(!is_null($service->provider)) {{$service->provider->provider_name}}
							  	                        	@else
							  	                        	-
							  	                        	@endif
							  	                        	</li>
							  	                        	<li><b>{{__('profile.service_type')}}</b> : &nbsp;@if(!is_null($service->typeOfService)) 
													  							{{$service->typeOfService['service_type_name']}}
													  							@else
													  	                        	-
												  	                        	@endif</li>
							  	                        	<li><b>{{__('profile.price')}}</b> : &nbsp;&nbsp;{{$service->c_code}}&nbsp;{{$service->price}}</li>
							  	                        	<li>
																<b>
																	@if(!is_null($service->provider)) 
																		@if($service->provider->status == 1)
																			<span class="font-weight-bold">{{__('profile.approved')}}</span>
																		@else
																			<span class="font-weight-bold text-danger">{{__('profile.notapproved')}}</span>
																		@endif
																	@else
																	-
																	@endif
															  	</b>
															</li>
							  	                        </ul>
							  	                        
							  	                    </a>
							  	                </h4>
							  	            </div>
							  	            <div id="collapse{{$service->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$service->id}}">
							  	                <div class="panel-body">
						  	                      	<div class="row">
												  		<div class="col-lg-12">
												  			<div class="service_list_design">
												  				<div class="row">
													  				
													  				<div class="col-lg-4">
													  					<div class="card_sm">
														  					<ul class="first_row_service">
														  						<li>
														  							<div>{{__('profile.contract_type')}} : </div>
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
													  							<div>{{__('profile.payment_type')}} : </div>
													  							<div class="value_div">
													  								&nbsp;{{$service->payment_type ?? 'N/A'}}
													  							</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.review_date')}} : </div>
													  							<div class="value_div">
													  								&nbsp;{{ date("d/m/Y", strtotime($service->created_at)) }}
													  							</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.service_type')}} : </div>
													  							<div class="value_div">
													  								
													  							&nbsp;
													  							@if(!is_null($service->typeOfService)) 
													  							{{$service->typeOfService['service_type_name']}}
													  							@else
													  	                        	N/A
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
													  							<div>{{__('profile.localmin')}} : </div>
													  							<div class="value_div">&nbsp;{{$service->local_min ?? 'N/A'}}
													  							</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.datavol')}} : </div>
													  							<div class="value_div">&nbsp;{{number_format($service->datavolume,0) ?? 'N/A'}}</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.long_dis')}} : </div>
													  							<div class="value_div">&nbsp;{{$service->long_distance_min ?? 'N/A'}}</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.internantionalmin')}} : </div>
													  							<div class="value_div">&nbsp;{{$service->international_min ?? 'N/A'}}</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.romingmin')}} : </div>
													  							<div class="value_div">&nbsp;{{$service->roaming_min ?? 'N/A'}}</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.downloading')}} : </div>
													  							<div class="value_div">&nbsp;{{$service->downloading_speed ?? 0}} Mbps @if($service->speedtest_type == 1) <i class="fa fa-tachometer"></i> @endif</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.uploading')}} : </div>
													  							<div class="value_div">&nbsp;{{$service->uploading_speed ?? 0}} Mbps @if($service->speedtest_type == 1) <i class="fa fa-tachometer"></i> @endif
													  							</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.sms')}} : </div>
													  							<div class="value_div">&nbsp;{{$service->sms ?? 'N/A'}}</div>
													  						</li>
													  					</ul>
													  					</div>
													  				</div>
													  				<div class="col-lg-12 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.price_str')}} : </div>
													  							<div class="value_div">&nbsp;@if(!is_null($service->currency))
													  								{{$service->currency->currency_code}}@else-
													  								@endif&nbsp;{{$service->price}}</div>
													  						</li>
													  					</ul>
													  					</div>
																	  </div>
																	  <div class="col-lg-4 mt-2">
													  					<div class="card_sm">
													  					<ul class="first_row_service">
													  						<li>
													  							<div>{{__('profile.device')}} : </div>
													  							<div class="value_div">&nbsp;
																				  	@if(!is_null($service->brand)) 
																				  		{{$service->brand->brand_name}} {{$service->brand->model_name}}
																					@else
																					None
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
																					<div>{{__('profile.upfront_price')}} : </div>
																					<div class="value_div">&nbsp;{{$service->upfront_price ?? 0}} 
																					</div>
																				</li>
																			</ul>
													  					</div>
													  				</div>
																	  @if(count($service->ratings) == 0 ) 
																	  <div class="col-lg-4 mt-2">
													  					<div class="card_sm">
																			<ul class="first_row_service">
																				<li>
																					<div>{{__('profile.address')}} : </div>
																					<div class="value_div">&nbsp;{{$customer->userAdderss['city'] ?? ''}} {{$customer->userAdderss['country'] ?? ''}} {{$customer->userAdderss['postal_code'] ?? ''}} 
																					</div>
																				</li>
																			</ul>
													  					</div>
																	  </div>
																	  @endif
													  			</div>
													  			<div class="row">
													  				<div class="col-lg-12">
													  					<div class="heading detail-div">
							  					                            <h1 class="section-title">{{__('profile.rating')}}</h1>
							  					                        </div>
							  					                        <div class="add_new_rating_btn">
							  					                        	<a href="{{url('/reviews')}}/{{base64_encode($service->id)}}" class="btn btn-info pull-right add_service">{{__('profile.add_rating')}}</a>
							  					                        </div>
													  				</div>
													  				<!-- Rating -->
													  				@if(!is_null($service->ratings)) 
						  					  	                		@foreach($service->ratings as $key => $rating)
								  					  	                		@if($rating['plan_id']==$service->id)
												  					  	            <div class="panel-heading mt-2 inner-accordian" role="tab" id="rating{{$service->id}}{{$key}}">
												  					  	                <h4 class="panel-title display-inline">
												  					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$service->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$key}}" class="accordion_btn rating_btn">
												  					  	                        <i class="more-less glyphicon glyphicon-plus"></i>
												  					  	                        <ul class="inline_list">
												  					  	                        	<li><b>{{__('profile.average')}}</b> : &nbsp;{{$rating['average']}}
												  					  	                        	</li>
												  					  	                        </ul>
												  					  	                    </a>
												  					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$service->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$key}}" class="accordion_btn text-right">{{ date("d/m/Y", strtotime($rating['date'])) }}</a>
												  					  	                </h4>
												  					  	            </div>
												  					  	            <div id="ratingcollapse{{$service->id}}{{$key}}" class="panel-collapse collapse rating_content" role="tabpanel" aria-labelledby="rating{{$service->id}}{{$key}}">
												  					  	                <div class="panel-body w-100">
												  					  	                	<div class="row">
								  					  	                		  				<div class="col-lg-12 mb-3 border-bottom">
								  					  	                			  				<div class="card_sm">
								  					  	                			  					<div class="row">
								  					  	                				  					<div class="col-lg-4">
								  					  	                					  					<b>{{__('profile.address')}}</b>
								  					  	                					  				</div>
								  					  	                					  				<div class="col-lg-8">
								  					  	                					  					<div class="pull-right" >{{$rating['formatted_address']}}</div>
								  					  	                					  				</div>
								  					  	                					  			</div>
								  					  	                				  			</div>
								  					  	                				  		</div>
											  					  	                		@foreach($rating['ratingList'] as $rate)
											  					  	                		@if($rate['entity_id'] == $service->id)
								  					  	                	  				<div class="col-lg-12 mb-3">
								  					  	                		  				<div class="card_sm">
								  					  	                		  					<div class="row">
								  					  	                			  					<div class="col-lg-6">
								  					  	                			  						<div class="question">
									  					  	                				  					{{$rate['question_name']}}
									  					  	                				  				</div>
								  					  	                				  				</div>
								  					  	                				  				<div class="col-lg-4">
																											<div class="question">
									  					  	                				  					{{$rate['text_field_value']}}
									  					  	                				  				</div>
								  					  	                				  				</div>
								  					  	                				  				<div class="col-lg-2">
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
																										  {{__('profile.comment')}}
									  					  	                			  			</h6>
									  					  	                			  			<p class="comment">{{$rating['comment']}}</p>
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
							  	        {{ $serviceData->appends(request()->input())->links()}}
								  	@else
								  		<div class="row">
								  			<div class="col-lg-12">
								  				<h3 class="text-center pt-3">
								  					{{__('common.notfound')}}
								  				</h3>
								  			</div>
								  		</div>
								  	@endif
							  	@endif
						  </div>
					  </div>
					  <div class="tab-pane fade @if(Request::get('type') == 2) show active @endif" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="row mb-2">
						  		<div class="col-lg-12">
						  			<a class="btn btn-info pull-right add_service" href="{{url('/reviews?type=2')}}">{{__('profile.add_new_device')}}</a>
						  		</div>
						  	</div>
						  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">  
						  	 @if(Request::get('type') == 2) 
  							  	@if(count($serviceData)>0)
  							  		@foreach($serviceData as $key => $device)
	  							  		<div class="panel panel-default">
	  						  	            <div class="panel-heading" role="tab" id="heading{{$device->id}}">
	  						  	                <h4 class="panel-title display-inline">
	  						  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$device->id}}" aria-expanded="true" aria-controls="collapse{{$device->id}}" class="accordion_btn">
	  						  	                        <i class="more-less glyphicon glyphicon-plus"></i>
	  						  	                        <div class="row">
	  						  	                        	<div class="col-4 text-center">
	  						  	                        		<b>{{__('profile.device_name')}}</b> : &nbsp; {{$device->device_name}}
	  						  	                        	</div>
	  						  	                        	<div class="col-4 text-center">
	  						  	                        		<b>{{__('profile.brand_name')}}</b> : &nbsp;{{$device->brand_name}} {{$device->model_name}}
	  						  	                        	</div>
	  						  	                        	<div class="col-4 text-center">
	  						  	                        		<b>{{__('profile.supplier_name')}}</b> : &nbsp;&nbsp;{{$device->supplier_name}}
	  						  	                        	</div>
	  						  	                        </div>
	  						  	                    </a>
	  						  	                </h4>
	  						  	            </div>
	  						  	            <div id="collapse{{$device->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$device->id}}">
	  						  	                <div class="panel-body">
	  					  	                      	<div class="row">
	  											  		<div class="col-lg-12">
	  											  			<div class="service_list_design">
								  				  				<div class="row">
								  					  				
								  					  				<div class="col-lg-4 text-left">
								  					  					<div class="card_sm">
								  						  					<ul class="first_row_service">
								  						  						<li>
								  						  							<div>{{__('profile.price')}} : </div>
								  						  							<div class="value_div">&nbsp;
								  						  								@if(!is_null($device->currency))
														  								{{$device->currency->currency_code}}@else-
														  								@endif&nbsp;{{$device->price}}
								  						  							</div>
								  						  						</li>
								  						  					</ul>
								  					  					</div>
								  					  				</div>
								  					  				<div class="col-lg-4 text-center">
								  					  					<div class="card_sm">
								  						  					<ul class="first_row_service">
								  						  						<li>
								  						  							<div>{{__('profile.storage')}} : </div>
								  						  							<div class="value_div">&nbsp;
								  						  								{{$device->storage}}
								  						  							</div>
								  						  						</li>
								  						  					</ul>
								  					  					</div>
								  					  				</div>
								  					  				<div class="col-lg-4 text-right">
								  					  					<div class="card_sm">
								  						  					<ul class="first_row_service">
								  						  						<li>
								  						  							<div>{{__('profile.color')}} : </div>
								  						  							<div class="value_div">&nbsp;
																						@if($device->device_color_info) 
																							{{$device->device_color_info->color_name}}
																						@else
																							N/A
																						@endif 
								  						  							</div>
								  						  						</li>
								  						  					</ul>
								  					  					</div>
																		</div>
																		@if(count($device->ratings) === 0 ) 
																		<div class="col-lg-4 mt-2 text-left">
																			<div class="card_sm">
																				<ul class="first_row_service">
																					<li>
																						<div>{{__('profile.address')}} : </div>
																						<div class="value_div">&nbsp;{{$customer->userAdderss['city'] ?? ''}} {{$customer->userAdderss['country'] ?? ''}} {{$customer->userAdderss['postal_code'] ?? ''}} 
																						</div>
																					</li>
																				</ul>
																			</div>
																		</div>
																		@endif
								  					  			</div>
	  												  			<div class="row">
	  												  				<div class="col-lg-12">
	  												  					<div class="heading detail-div">
	  						  					                            <h1 class="section-title">{{__('profile.rating')}}</h1>
	  						  					                        </div>
	  						  					                        <div class="add_new_rating_btn">
	  						  					                        	<a href="{{url('/device-review')}}/{{base64_encode($device->id)}}" class="btn btn-info pull-right add_service">{{__('profile.add_rating')}}</a>
	  						  					                        </div>
	  												  				</div>
	  												  				<!-- Rating -->
	  												  				@if(!is_null($device->ratings)) 
	  					  					  	                		@foreach($device->ratings as $key => $rating)
  							  					  	                		@if($rating['device_id']==$device->id)
  											  					  	            <div class="panel-heading mt-2 inner-accordian" role="tab" id="rating{{$device->id}}{{$key}}">
  											  					  	                <h4 class="panel-title display-inline">
  											  					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$device->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$device->id}}{{$key}}" class="accordion_btn rating_btn">
  											  					  	                        <i class="more-less glyphicon glyphicon-plus"></i>
  											  					  	                        <ul class="inline_list">
  											  					  	                        	<li><b>{{__('profile.average')}}</b> : &nbsp;{{$rating['average']}}
  											  					  	                        	</li>
  											  					  	                        </ul>
  											  					  	                    </a>
  											  					  	                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$device->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$device->id}}{{$key}}" class="accordion_btn text-right">{{ date("d/m/Y", strtotime($rating['date'])) }}</a>
  											  					  	                </h4>
  											  					  	            </div>
  											  					  	            <div id="ratingcollapse{{$device->id}}{{$key}}" class="panel-collapse collapse rating_content" role="tabpanel" aria-labelledby="rating{{$device->id}}{{$key}}">
  											  					  	                <div class="panel-body w-100">
  											  					  	                	<div class="row">
  							  					  	                		  				<div class="col-lg-12 mb-3 border-bottom">
  							  					  	                			  				<div class="card_sm">
  							  					  	                			  					<div class="row">
  							  					  	                				  					<div class="col-lg-4">
  							  					  	                					  					<b>{{__('profile.address')}}</b>
  							  					  	                					  				</div>
  							  					  	                					  				<div class="col-lg-8">
  							  					  	                					  					<div class="pull-right" >{{$rating['formatted_address']}}</div>
  							  					  	                					  				</div>
  							  					  	                					  			</div>
  							  					  	                				  			</div>
  							  					  	                				  		</div>
  										  					  	                		@foreach($rating['ratingList'] as $rate)
  										  					  	                		@if($rate['entity_id'] == $device->id && $rate['question_name'] != "")
																							<div class="col-lg-12 mb-3">
																								<div class="card_sm">
																									<div class="row">
																										<div class="col-lg-6">
																											<div class="question">
																												{{$rate['question_name']}}
																											</div>
																										</div>
																										<div class="col-lg-4">
																											<div class="question">
																												{{$rate['text_field_value']}}
																											</div>
																										</div>
																										<div class="col-lg-2">
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
																										{{__('profile.comment')}}
  								  					  	                			  			</h6>
  								  					  	                			  			<p class="comment">{{$rating['comment']}}</p>
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
  						  	        {{ $serviceData->appends(request()->input())->links()}}
  							  	@else
  							  		<div class="row">
  							  			<div class="col-lg-12">
  							  				<h3 class="text-center pt-3">
  							  					{{__('common.notfound')}}
  							  				</h3>
  							  			</div>
  							  		</div>
  							  	@endif
						  	@endif
						  	</div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Changes password Modal -->
    <div class="modal fade" id="change_password_model" >
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Change Password</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="change_password_form" action="{{url('/changePassword')}}" method="post">
                <div class="row">
                    <div class="col-lg-12">
                    	@csrf
                        <h5>Old password</h5>
                        <div class="form-group">
                            <input type="password" maxlength="20" id="old_password" name="old_password" class="form-control" placeholder="Old password" required="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h5>New password</h5>
                        <div class="form-group">
                            <input type="password" maxlength="20" id="new_password" name="new_password" class="form-control" placeholder="New password" required="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <h5>Confirm new password</h5>
                        <div class="form-group">
                            <input type="password" maxlength="20" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm new password" required="">
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<!-- Changes address Modal -->
	<div class="modal fade" id="change_address_model" >
		<div class="modal-dialog">
			<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">{{__('profile.change_address')}}</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="change_address_form" action="{{url('/changeAddress')}}" method="post">
					<div class="row">
						@csrf
						<div class="col-lg-12">
							<h5>Address <span class="text-mute">Optional</span></h5>
							<div class="form-group">
								<input type="text" maxlength="70" id="address" name="address" class="form-control" placeholder="Address" value="" autocomplete="no">
							</div>
						</div>
						<div class="col-lg-12">
							<h5>Country</h5>
							<div class="form-group country_div" id="country_div">
								<input type="text" maxlength="50" id="country" name="country" class="form-control js-input" placeholder="Country" required=""  autocomplete="no">
							</div>
						</div>
						<div class="col-lg-12">
							<h5>City</h5>
							<div class="form-group city_div" id="city_div">
								<input type="text" maxlength="50" id="city" name="city" class="form-control city_input" placeholder="City" autocomplete="no" required="" data-country="IN" value="">
								<input type="hidden" maxlength="50" id="country_code" name="country_code" class="form-control" value="">
							</div>
						</div>
						<div class="col-lg-12">
							<h5>Postal code</h5>
							<div class="form-group">
								<input type="text" maxlength="20" id="postal_code" name="postal_code" class="form-control" placeholder="Postal code" required="" value="">
							</div>
						</div>
						<input type="hidden" name="id" value="" id="address_id">
						<div class="col-lg-12 text-center">
							<button type="button" class="btn btn-primary address_update_btn">Update</button>
							<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
@endsection