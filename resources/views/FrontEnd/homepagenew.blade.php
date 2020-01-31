@extends('layouts.frontend_layouts.frontend')
@section('title', 'Home')
@section('content')

<!-- Content Start Here -->
<section id="main-top-section" >
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6 text-center pl-0 pr-0 video-height">
				<div class="first-section-text">
					<h2>{{$homeContent ? $homeContent->section_one : 'Welcome to the telco community'}}</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="first-section-image">
					@if($homeContent)
						@if($homeContent->section_one_image != '')
							<img src="{{URL::asset('home/images')}}/{{$homeContent->section_one_image}}">
						@else
							<img src="{{URL::asset('frontend/assets/img/2427279.jpg')}}">
						@endif
					@else
					<img src="{{URL::asset('frontend/assets/img/2427279.jpg')}}">
					@endif
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12 mb-4">
				<div class="find-service-section mx-auto text-center">
					<h2>{{$homeContent ? $homeContent->section_two : 'Find the right telecom service that suits your needs
Check and share your telco experience with every one'}}</h2>
					<!-- <h2>Check and share your telco experience with every one</h2> -->
				</div>
			</div>
		</div>
		<div class="row mt-5 py-5 col-10 offset-md-1">
			<div class="col-2 p-0 text-center">
				<img src="{{URL::asset('frontend/assets/img/2756310.jpg')}}"/>
				<div class="label-service font-weight-bold">Mobile Plans</div>
			</div>
			<div class="col-2 p-0 text-center">
				<img src="{{URL::asset('frontend/assets/img/4636.jpg')}}"/>
				<div class="label-service font-weight-bold">Internet</div>
			</div>
			<div class="col-2 p-0 text-center">
				<img src="{{URL::asset('frontend/assets/img/sharing.jpg')}}"/>
				<div class="label-service font-weight-bold">Share plans</div>
			</div>
			<div class="col-2 p-0 text-center">
				<img src="{{URL::asset('frontend/assets/img/2756310.jpg')}}"/>
				<div class="label-service font-weight-bold">Devices</div>
			</div>
			<div class="col-2 p-0 text-center">
				<img src="{{URL::asset('frontend/assets/img/150631-OUD927-864_edited.jpg')}}"/>
				<div class="label-service font-weight-bold">Personal</div>
			</div>
			<div class="col-2 p-0 text-center">
				<img src="{{URL::asset('frontend/assets/img/2317497_edited.jpg')}}"/>
				<div class="label-service font-weight-bold">Business</div>
			</div>
		</div>
		<div class="row my-5 align-items-center">
			<div class="col-6">
				<div class="service-inner text-right">
					<a href="{{url('/plans')}}" class="service-section-plan">Plan</a>
					@if($settings)
						@if($settings->device == 1)
							<a href="{{url('/devices')}}" class="service-section-device">Device</a>
						@endif
					@else
						<a href="{{url('/devices')}}" class="service-section-device">Device</a>
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
				{!!$homeContent ? $homeContent->section_three : 'Everyone has subscribed to mobile phone plan or a home internet service and everyone has his own unique experience. Because of the telecom nature, the service defer from a location to another and from  specific service to another. A carrier may have a perfect coverage for the whole city except for one single neighborhood. While another one may provide an excellent 100 Mbps <br> service but a horrible Gbps service. <br>TelcoTales enables users to share their experience "Telco Tales" on our website so everyone benefits and easily pick the best service, while carriers can spot their weaknesses and improve them 
				'!!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<div class="heading detail-div mb-5">
					<h1 class="device-heading-title">How Does it Work</h1>
				</div>
			</div>
			<div class="col-10 offset-md-1">
				<div class="row">
					<div class="col-3 bg-blue">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-search"></i>
							</div>
							<div class="work-title font-weight-bold my-4 text-uppercase">
								Search
							</div>
							<div class="work-content text-center mb-4">
								Search for the service you are looking for Personal/Business, Mobile/Fixed internet ? 
							</div>
							<div class="work-button">
								<a>Start now <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-3 bg-green">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-bullhorn"></i>
							</div>
							<div class="work-title font-weight-bold my-4 text-uppercase">
								Research Companies
							</div>
							<div class="work-content text-center mb-4">
								Look at other users reviews and feedback, Start with your neighbors whose using the service and see how its working for them  
							</div>
							<div class="work-button">
								<a>Start now <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-3 bg-blue">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-usd"></i>
							</div>
							<div class="work-title font-weight-bold my-4 text-uppercase">
								Get The best deal 
							</div>
							<div class="work-content text-center mb-4">
								Compare prices and see how much others are paying for the service 
							</div>
							<div class="work-button">
								<a>Start now <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-3 bg-green">
						<div class="work-section text-center">
							<div class="work-icon">
								<i class="fa fa-share-alt"></i>
							</div>
							<div class="work-title font-weight-bold my-4 text-uppercase">
								Share
							</div>
							<div class="work-content text-center mb-4">
								Share your own experience with your current provider and let everyone benefit  
							</div>
							<div class="work-button">
								<a>Start now <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-5 py-4">
			<div class="col-10 offset-md-1">
				<div class="sign-up-email">
					<div class="form-group fields">
						<input type="text" class="form-control" placeholder="Your email">
						<button class="register-button">Register for free</button>
					</div>
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
							Moving your home and don't know if your current service is still suitable?
						</div>
					</div>
					<div class="col-2 text-center mb-3">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/Ringing%20Phone.jpg')}}"/>
						</div>
					</div>
					<div class="col-10 mb-3">
						<div class="content-section">
							Looking for a new mobile device or a mobile plan?
						</div>
					</div>
					<div class="col-2 text-center mb-3">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/Documents.jpg')}}"/>
						</div>
					</div>
					<div class="col-10 mb-3">
						<div class="content-section">
							Changing your mobile carrier?
						</div>
					</div>
					<div class="col-2 text-center mb-3">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/454550-PGQH10-539.jpg')}}"/>
						</div>
					</div>
					<div class="col-10 mb-3">
						<div class="content-section">
							Search other users reviews and feed back for the best plan in the area Find out the best product that fits your need, budget and expectation with us
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row my-5">
			<div class="col-12">
				<div class="plan-device-button text-center">
					<a href="{{url('/plans')}}" class="btn btn-blue">Plan</a>
					@if($settings)
						@if($settings->device == 1)
							<a href="{{url('/devices')}}" class="btn btn-green">Device</a>
						@endif
					@else
					<a href="{{url('/devices')}}" class="btn btn-green">Device</a>
					@endif
				</div>
			</div>
		</div>
		<div class="row bg-green col-10 offset-md-1">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="h1">How do we get our information</h1>
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="image-info">
					<img src="{{URL::asset('frontend/assets/img/28561.jpg')}}"/>
				</div>
			</div>
			<div class="col-12 text-center mt-3">
				<div class="content-info">
				<p>
				Telcotales is a fee telecommunication websites specialized in collecting, analyzing and evaluating telecom carriers and providers world wide. We Depend 100% on our users reviews to rates. With the huge demand on telecommunication and data these days, telecom is considered the most important and critical products and services offered worldwide. The market is offering thousands of telecom and mobile device and hundreds of thousands of telecom plans and telecom subscriptions. Internet Companies and mobile wireless companies’ network are covering millions of kilometers. All these mobile phones, smart devices, pans, subscription and telecom services varies from one company to another and from one brand to another, even within the same network the provided service may vary from city to another or even from a neighborhood to another. For that Telcotales share every one’s experience and reviews to help you pick
				</p>
			</div>
			</div>
		</div>
		<div class="row my-5 col-10 offset-md-1">
			@if(count($blogs) > 0)
				@foreach($blogs as $blog)
					<div class="col-6 mb-4">
						<div class="card-blog">
							<a herf="#">
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
												<a href="#">{{$blog->title}}</a>
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
		
	</div>
	<div class="container-fluid">
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
	</div>
</section>

@endsection