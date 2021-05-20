@extends('layouts.frontend_layouts.frontend')
@section('title', 'Home')
@section('content')
<!-- Content Start Here -->
<section id="main-top-section" >
	<div class="container">
		<div class="row">
			<div class="col-md-6 text-center pl-0 pr-0 video-height">
				<div class="first-section-text mt-5">
				@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
					{!!$homeContent ? $homeContent->section_one : 'Welcome to the telco community'!!}
				@else
					{!!$homeContent ? $homeContent->section_one_fr : 'Welcome to the telco community'!!}
				@endif
				</div>
				<ul class="nav nav-tabs tab-selection  mt-5">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#plan">{{__('home.plan')}}</a>
					</li>
					@if($settings->device == 1)
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#device">{{__('home.device')}}</a>
						</li>
					@endif
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="plan">
						<form action="{{url('/plans/result')}}" method="get" class="w-75 mt-4">
							<div class="row position-relative">
								<div class="google-location-loader">
									<i class="fa fa-spinner fa-spin"></i>
								</div>
								<div class="col-md-12 ml-md-auto">
									<input type="hidden" name="lat" class="currentLat">
									<input type="hidden" name="lng" class="currentLng">
									<input type="hidden" name="country" class="currentCountry">
									<input type="hidden" value="@if( request()->get('address') ) {{request()->get('address')}} @else {{$ip_location}} @endif"  class="location-input-hidden"/>
									<input type="text" placeholder="{{__('profile.location')}}" id="searchMapInput" value="" name="address" class="location-input search-input-field"/>
								</div>
								
								<input type="hidden" name="rows" value="20">
								
								@if($filtersetting->gb_setting == 1)
								<div class="col-6 text-center mt-4 pay_as_usage_type">
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
								<div class="col-6 text-center mt-4 pay_as_usage_type">
									<div class="form-group">
										<select class="service-type-select service_type" name="service_type">
											<option value="">{{__('profile.service_type')}}</option>
											@if(count($service_types) > 0)
												@foreach($service_types as $type)
													<option value="{{$type->id}}" @if( request()->get('service_type') ) @if( request()->get('service_type') == $type->id) selected @endif @endif>{{$type->service_type_name}}</option>
												@endforeach
											@else
												<option disabled="">{{__('common.notfound')}}</option>
											@endif
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-center">
									<button type="submit" class="searchnow-button">{{__('home.search_now_btn')}}</button>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="device">
						<form action="{{url('/devices/result')}}" method="get" class="w-75 mt-4">
							<div class="row position-relative">
								<div class="google-location-loader">
									<i class="fa fa-spinner fa-spin"></i>
								</div>
								<div class="col-12">
									<input type="hidden" name="lat" class="currentLat">
									<input type="hidden" name="lng" class="currentLng">
									<input type="hidden" name="isSelect" class="isselect" value="1">
									<input type="hidden" name="country" class="currentCountry">
									<input type="text" placeholder="{{__('profile.location')}}" id="searchMapInput" value="" name="address" class="location-input search-input-field"/>
								</div>
								<div class="col-6 mt-4 devicenew">
									<select class="service-type-select service_type" name="brand_name" id="brand_select" data-url="{{url('/searchBrand')}}">
										<option value="">{{__('deviceresult.brand')}}</option>
										@foreach($brands as $v)
											<option value="{{$v->id}}" @if( request()->get('brand_name') ) @if( request()->get('brand_name') == $v->id) selected @endif @endif>{{$v->brand_name}} {{$v->model_name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-6 mt-4">
									<div class="form-group plan_page inputwithicon">
										<div class="select">
											<select name="storage" id="storage" class="service-type-select  service_type">
												<option value="">{{__('deviceresult.capacity')}}</option>
												<option value="64" @if( request()->get('storage') ) @if( request()->get('storage') == '64') selected @endif @endif>64</option>
												<option value="128" @if( request()->get('storage') ) @if( request()->get('storage') == '128') selected @endif @endif>128</option>
												<option value="256" @if( request()->get('storage') ) @if( request()->get('storage') == '256') selected @endif @endif>256</option>
												<option value="512" @if( request()->get('storage') ) @if( request()->get('storage') == '512') selected @endif @endif>512</option>
												<option value="1GB" @if( request()->get('storage') ) @if( request()->get('storage') == '1GB') selected @endif @endif>1GB</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<input type="hidden" value="20" name="rows"/>
								<div class="col-md-12 text-center">
									<button type="submit" class="searchnow-button">{{__('home.search_now_btn')}}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="first-section-image">
					@if($homeContent)
						<a @if($homeContent->section_one_image_link != '') target="_blank" href="{{$homeContent->section_one_image_link}}" @endif>
							@if($homeContent->section_one_image != '')
								<img style="border:8px solid {{$homeContent->section_one_image_border_color != '' ? $homeContent->section_one_image_border_color : '#1bfca3'}};" src="{{URL::asset('home/images')}}/{{$homeContent->section_one_image}}">
							@else
								<img src="{{URL::asset('frontend/assets/img/2427279.jpg')}}">
							@endif
						</a>
					@else
						<img src="{{URL::asset('frontend/assets/img/2427279.jpg')}}">
					@endif
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12 mb-4">
				<div class="find-service-section mx-auto text-center">
				@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
					<h2>{!!$homeContent ? $homeContent->section_two : 'Find the right telecom service that suits your needs
	Check and share your telco experience with every one'!!}</h2>	
				@else
					<h2>{!!$homeContent ? $homeContent->section_two_fr : 'Find the right telecom service that suits your needs
	Check and share your telco experience with every one'!!}</h2>
				@endif	
					
					<!-- <h2>Check and share your telco experience with every one</h2> -->
				</div>
			</div>
		</div>
		<div class="row mt-5 py-5 col-10 offset-md-1">
			<div class="col-2 p-0 text-center">
				@if($homeContent)
					<a @if($homeContent->section_six != '' && isset($homeContent->section_six->label_1_image_link) && $homeContent->section_six->label_1_image_link != '') target="_blank" href="{{$homeContent->section_six->label_1_image_link}}" @endif>
						@if($homeContent->section_six != '' && $homeContent->section_six->icon_1 != '')
							<img src="{{URL::asset('home/images')}}/{{$homeContent->section_six->icon_1}}"/>	
						@else
							<img src="{{URL::asset('frontend/assets/img/2756310.jpg')}}"/>
						@endif
					</a>
				@else
					<img src="{{URL::asset('frontend/assets/img/2756310.jpg')}}"/>
				@endif
				<div class="label-service font-weight-bold">
				@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
				{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_1 != '') ? $homeContent->section_six->label_1 :'' }}
				@else
				{{ $homeContent && ($homeContent->section_six != '' &&  (isset($homeContent->section_six->label_fr_1) && $homeContent->section_six->label_fr_1 != '')) ? $homeContent->section_six->label_fr_1 :'' }}
				@endif
				
				</div>
			</div>
			<div class="col-2 p-0 text-center">
				@if($homeContent)
				<a @if($homeContent->section_six != '' && isset($homeContent->section_six->label_2_image_link) && $homeContent->section_six->label_2_image_link != '') target="_blank" href="{{$homeContent->section_six->label_2_image_link}}" @endif>
					@if($homeContent->section_six != '' && $homeContent->section_six->icon_2 != '')
						<img src="{{URL::asset('home/images')}}/{{$homeContent->section_six->icon_2}}"/>	
					@else
						<img src="{{URL::asset('frontend/assets/img/4636.jpg')}}"/>
					@endif
				</a>
				@else
					<img src="{{URL::asset('frontend/assets/img/4636.jpg')}}"/>
				@endif
				
				<div class="label-service font-weight-bold">
				@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
					{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_2 != '') ? $homeContent->section_six->label_2 :'' }}
				@else
					{{ $homeContent && ($homeContent->section_six != '' &&  (isset($homeContent->section_six->label_fr_2) && $homeContent->section_six->label_fr_1 != '')) ? $homeContent->section_six->label_fr_2 :'' }}
				@endif
				</div>
			</div>
			<div class="col-2 p-0 text-center">
				@if($homeContent)
				<a @if($homeContent->section_six != '' && isset($homeContent->section_six->label_3_image_link) && $homeContent->section_six->label_3_image_link != '') target="_blank" href="{{$homeContent->section_six->label_3_image_link}}" @endif>
					@if($homeContent->section_six != '' && $homeContent->section_six->icon_3 != '')
						<img src="{{URL::asset('home/images')}}/{{$homeContent->section_six->icon_3}}"/>	
					@else
						<img src="{{URL::asset('frontend/assets/img/sharing.jpg')}}"/>
					@endif
				</a>
				@else
					<img src="{{URL::asset('frontend/assets/img/sharing.jpg')}}"/>
				@endif	
			
				<div class="label-service font-weight-bold">
					@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
						{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_3 != '') ? $homeContent->section_six->label_3 :'' }}
					@else
						{{ $homeContent && ($homeContent->section_six != '' &&  (isset($homeContent->section_six->label_fr_3) && $homeContent->section_six->label_fr_1 != '')) ? $homeContent->section_six->label_fr_3 :'' }}
					@endif
				
				</div>
			</div>
			<div class="col-2 p-0 text-center">
				@if($homeContent)
				<a @if($homeContent->section_six != '' && isset($homeContent->section_six->label_4_image_link) && $homeContent->section_six->label_4_image_link != '') target="_blank" href="{{$homeContent->section_six->label_4_image_link}}" @endif>
					@if($homeContent->section_six != '' && $homeContent->section_six->icon_4 != '')
						<img src="{{URL::asset('home/images')}}/{{$homeContent->section_six->icon_4}}"/>	
					@else
						<img src="{{URL::asset('frontend/assets/img/2756310.jpg')}}"/>
					@endif
				</a>
				@else
					<img src="{{URL::asset('frontend/assets/img/2756310.jpg')}}"/>
				@endif
				
				<div class="label-service font-weight-bold">
				@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
					{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_4 != '') ? $homeContent->section_six->label_4 :'' }}
				@else
					{{ $homeContent && ($homeContent->section_six != '' &&  (isset($homeContent->section_six->label_fr_4) && $homeContent->section_six->label_fr_1 != '')) ? $homeContent->section_six->label_fr_4 :'' }}
				@endif
				
				</div>
			</div>
			<div class="col-2 p-0 text-center">
				@if($homeContent)
				<a @if($homeContent->section_six != '' && isset($homeContent->section_six->label_5_image_link) && $homeContent->section_six->label_5_image_link != '') target="_blank" href="{{$homeContent->section_six->label_5_image_link}}" @endif>
					@if($homeContent->section_six != '' && $homeContent->section_six->icon_5 != '')
						<img src="{{URL::asset('home/images')}}/{{$homeContent->section_six->icon_5}}"/>	
					@else
						<img src="{{URL::asset('frontend/assets/img/150631-OUD927-864_edited.jpg')}}"/>
					@endif
				</a>
				@else
					<img src="{{URL::asset('frontend/assets/img/150631-OUD927-864_edited.jpg')}}"/>
				@endif
				<div class="label-service font-weight-bold">
					@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
						{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_5 != '') ? $homeContent->section_six->label_5 :'' }}
					@else
						{{ $homeContent && ($homeContent->section_six != '' &&  (isset($homeContent->section_six->label_fr_5) && $homeContent->section_six->label_fr_5 != '')) ? $homeContent->section_six->label_fr_5 :'' }}
					@endif
				</div>
			</div>
			<div class="col-2 p-0 text-center">
				@if($homeContent)
				<a @if($homeContent->section_six != '' && isset($homeContent->section_six->label_6_image_link) && $homeContent->section_six->label_6_image_link != '') target="_blank" href="{{$homeContent->section_six->label_6_image_link}}" @endif>
					@if($homeContent->section_six != '' && $homeContent->section_six->icon_6 != '')
						<img src="{{URL::asset('home/images')}}/{{$homeContent->section_six->icon_6}}"/>	
					@else
						<img src="{{URL::asset('frontend/assets/img/2317497_edited.jpg')}}"/>
					@endif
				</a>
				@else
					<img src="{{URL::asset('frontend/assets/img/2317497_edited.jpg')}}"/>
				@endif
				<div class="label-service font-weight-bold">
					@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
						{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_6 != '') ? $homeContent->section_six->label_6 :'' }}
					@else
						{{ $homeContent && ($homeContent->section_six != '' &&  (isset($homeContent->section_six->label_fr_6) && $homeContent->section_six->label_fr_6 != '')) ? $homeContent->section_six->label_fr_6 :'' }}
					@endif
				</div>
			</div>
		</div>
		<div class="row my-5 align-items-center">
			<div class="col-6">
				<div class="service-inner text-right">
					<a href="{{url('/plans')}}" class="service-section-plan">{{__('home.plan')}}</a>
					@if($settings)
						@if($settings->device == 1)
							<a href="{{url('/devices')}}" class="service-section-device">{{__('home.device')}}</a>
						@endif
					@else
						<a href="{{url('/devices')}}" class="service-section-device">{{__('home.device')}}</a>
					@endif
				</div>
			</div>
			<div class="col-6">
				<div class="service-section-image">
					<img src="{{URL::asset('frontend/assets/img/filter.jpg')}}">
				</div>
			</div>
			<div class="col-12 mt-5">
				<div class="service-content-section w-75 mx-auto text-center">
				@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
					{!!$homeContent ? $homeContent->section_three : 'Everyone has subscribed to mobile phone plan or a home internet service and everyone has his own unique experience. Because of the telecom nature, the service defer from a location to another and from  specific service to another. A carrier may have a perfect coverage for the whole city except for one single neighborhood. While another one may provide an excellent 100 Mbps <br> service but a horrible Gbps service. <br>TelcoTales enables users to share their experience "Telco Tales" on our website so everyone benefits and easily pick the best service, while carriers can spot their weaknesses and improve them 
					'!!}
				@else
					{!!$homeContent ? $homeContent->section_three_fr : 'Everyone has subscribed to mobile phone plan or a home internet service and everyone has his own unique experience. Because of the telecom nature, the service defer from a location to another and from  specific service to another. A carrier may have a perfect coverage for the whole city except for one single neighborhood. While another one may provide an excellent 100 Mbps <br> service but a horrible Gbps service. <br>TelcoTales enables users to share their experience "Telco Tales" on our website so everyone benefits and easily pick the best service, while carriers can spot their weaknesses and improve them 
					'!!}
				@endif
				
				</div>
			</div>
		</div>
		@if($homeContent && $homeContent->section_five != "")
		<div class="row mt-5">
			<div class="col-12 my-5">
				<div class="find-service-section mx-auto text-center">
					@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
						<iframe style="width: 85%" height="500" src="{{$homeContent ? $homeContent->section_five : ''}}?rel=0" frameborder="0" allow="accelerometer; autoplay;" allowfullscreen></iframe>
					@else
						<iframe style="width: 85%" height="500" src="{{$homeContent ? $homeContent->section_five_fr : ''}}?rel=0" frameborder="0" allow="accelerometer; autoplay;" allowfullscreen></iframe>
					@endif
						<!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/9xwazD5SyVg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
					<!-- <h2>Check and share your telco experience with every one</h2> -->
				</div>
			</div>
		</div>
		@endif
		<div class="row" id='how-does-it-work'>
			<div class="col-12 text-center">
				<div class="heading detail-div mb-5">
					<h1 class="device-heading-title">{{__('home.how_it_work')}}</h1>
				</div>
			</div>
			<div class="col-12">
				<div class="row">
					<div class="col-3 bg-blue">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-search"></i>
							</div>
							<div class="work-title font-weight-bold my-5 text-uppercase">
							{{__('home.title_one')}}
							</div>
							<div class="work-content text-center mb-4">
							{{__('home.description_one')}}
							</div>
							<div class="work-button">
								<a>{{__('home.btn_one')}} <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-3 bg-green">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-bullhorn"></i>
							</div>
							<div class="work-title font-weight-bold my-5 text-uppercase">
								{{__('home.title_two')}}
							</div>
							<div class="work-content text-center mb-4">
								{{__('home.description_two')}}  
							</div>
							<div class="work-button">
								<a>{{__('home.btn_two')}} <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-3 bg-blue">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-usd"></i>
							</div>
							<div class="work-title font-weight-bold my-5 text-uppercase">
								{{__('home.title_three')}}
							</div>
							<div class="work-content text-center mb-4">
								{{__('home.description_three')}}
							</div>
							<div class="work-button">
								<a>{{__('home.btn_three')}} <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-3 bg-green">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-share-alt"></i>
							</div>
							<div class="work-title font-weight-bold my-5 text-uppercase">
								{{__('home.title_four')}}
							</div>
							<div class="work-content text-center mb-4">
								{{__('home.description_four')}}  
							</div>
							<div class="work-button">
								<a>{{__('home.btn_four')}} <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5 py-4">
			<div class="col-10 offset-md-1">
				<div class="sign-up-email">
					<form action='{{url("/emailsignup")}}'>
						<div class="form-group fields">
							<input type="text" class="form-control" name="email" placeholder="{{__('home.your_email')}}">
							<button class="register-button" type="submit">{{__('home.email_btn')}}</button>
						</div>
					</from>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="row">
					<div class="col-2 text-center mb-3">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/House%20Sketch.jpg')}}"/>
						</div>
					</div>
					<div class="col-10 mb-3">
						<div class="content-section">
							{{__('home.list_one')}}
						</div>
					</div>
					<div class="col-2 text-center mb-3">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/Ringing%20Phone.jpg')}}"/>
						</div>
					</div>
					<div class="col-10 mb-3">
						<div class="content-section">
						{{__('home.list_two')}}
						</div>
					</div>
					<div class="col-2 text-center mb-3">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/Documents.jpg')}}"/>
						</div>
					</div>
					<div class="col-10 mb-3">
						<div class="content-section">
						{{__('home.list_three')}}
						</div>
					</div>
					<div class="col-2 text-center mb-3">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/454550-PGQH10-539.jpg')}}"/>
						</div>
					</div>
					<div class="col-10 mb-3">
						<div class="content-section">
						{{__('home.list_four')}}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row my-5">
			<div class="col-12">
				<div class="plan-device-button text-center">
					<a href="{{url('/plans')}}" class="btn btn-blue">{{__('home.plan')}}</a>
					@if($settings)
						@if($settings->device == 1)
							<a href="{{url('/devices')}}" class="btn btn-green">{{__('home.device')}}</a>
						@endif
					@else
					<a href="{{url('/devices')}}" class="btn btn-green">{{__('home.device')}}</a>
					@endif
				</div>
			</div>
		</div>
		<div class="row bg-green col-10 offset-md-1" id='our-information'>
			<div class="col-12 text-center">
				<div class="heading detail-div">
					@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
						<h1 class="h1">{!!$homeContent ? $homeContent->section_four : ''!!}</h1>
					@else
						<h1 class="h1">{!!$homeContent ? $homeContent->section_four_fr : ''!!}</h1>
					@endif
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="image-info">
					@if($homeContent)
					<a @if($homeContent->section_four_image_link != '') target="_blank" href="{{$homeContent->section_four_image_link}}" @endif>
						@if($homeContent->section_four_image != '')
							<img src="{{URL::asset('home/images')}}/{{$homeContent->section_four_image}}">
						@else
							<img src="{{URL::asset('frontend/assets/img/28561.jpg')}}">
						@endif
					</a>
					@else
					<img src="{{URL::asset('frontend/assets/img/28561.jpg')}}">
					@endif
				</div>
			</div>
			<div class="col-12 text-center mt-3">
				<div class="content-info">
				<p>
					@if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en"))
						{!!$homeContent ? $homeContent->section_four_description : ''!!}
					@else
						{!!$homeContent ? $homeContent->section_four_description_fr : ''!!}
					@endif
				</p>
			</div>
			</div>
		</div>
		<div class="row my-5 col-10 offset-md-1">
			@if(count($blogs) > 0)
				@foreach($blogs as $blog)
					<div class="col-6 mb-4">
						<div class="card-blog">
							<a herf="{{url('/single-blog')}}/{{base64_encode($blog->id)}}">
								<div class="poster">
									<div class="text-center image-blog">
										@if($blog->blog_picture != "")
											<img alt="{{$blog->blog_picture}}" src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}" class="img-fluid">
										@else
											<img alt="{{$blog->blog_picture}}" src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" class="img-fluid">
										@endif
									</div>
									<div class="detail">
										<div class="top-section px-2">
											<small>{{date("M d, Y", strtotime($blog->created_at))}}</small>
										</div>
										<div class="title-blog  px-2">
											<h2>
												<a href="{{url('/single-blog')}}/{{base64_encode($blog->id)}}">{{$blog->title}}</a>
											</h2>
											<hr/>
										</div>
										<div class="blog-footer  px-2">
											<small>{{substr(html_entity_decode(strip_tags($blog->blog_content)),0,65)}}</small>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				@endforeach
			@endif
		</div>
		<div class="row mb-3">
			<div class="col-lg-12 text-center">
					<a class="common-btn" href="{{url('/blogs-list')}}">{{__('home.see_all')}}</a>
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
			<div class="col-10 offset-md-1">
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
@section('pageStyle')
<style>
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
	.find-service-section {
		word-break: break-all;
	}
	.label-service {
		word-break: break-all;
	}
</style>
@endsection()

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
					$('#device_color').append('<option value="">{{__("index.Color")}}</option>');
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
				navigator.geolocation.getCurrentPosition(geoSearchSuccess, geoSearchError);
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