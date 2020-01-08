@extends('layouts.frontend_layouts.frontend')
@section('title', 'Home')
@section('content')

<!-- Content Start Here -->
<section id="main-top-section" >
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-md-6 text-center pl-0 pr-0 video-height">
				<div class="first-section-text">
					<h2>Welcome to the telco community</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="first-section-image">
					<img src="{{URL::asset('frontend/assets/img/first-section.webp')}}">
				</div>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-12 mb-4">
				<div class="find-service-section mx-auto text-center">
					<h3>Find the right telecom service that suits your needs Check and share your telco experience with every one</h3>
				</div>
			</div>
			<div class="col-2 text-center">
				<img src="{{URL::asset('frontend/assets/img/2756310.webp')}}"/>
				<div class="label-service font-weight-bold">Mobile Plans</div>
			</div>
			<div class="col-2 text-center">
				<img src="{{URL::asset('frontend/assets/img/4636.webp')}}"/>
				<div class="label-service font-weight-bold">Internet</div>
			</div>
			<div class="col-2 text-center">
				<img src="{{URL::asset('frontend/assets/img/sharing.webp')}}"/>
				<div class="label-service font-weight-bold">Share plans</div>
			</div>
			<div class="col-2 text-center">
				<img src="{{URL::asset('frontend/assets/img/2756310.webp')}}"/>
				<div class="label-service font-weight-bold">Devices</div>
			</div>
			<div class="col-2 text-center">
				<img src="{{URL::asset('frontend/assets/img/150631-OUD927-864_edited.webp')}}"/>
				<div class="label-service font-weight-bold">Personal</div>
			</div>
			<div class="col-2 text-center">
				<img src="{{URL::asset('frontend/assets/img/2317497_edited.webp')}}"/>
				<div class="label-service font-weight-bold">Business</div>
			</div>
		</div>
		<div class="row my-5 align-items-center">
			<div class="col-6">
				<div class="service-inner text-right">
					<a href="{{url('/plans')}}" class="service-section-plan">Plan</a>
					<a href="{{url('/devices')}}" class="service-section-device">Device</a>
				</div>
			</div>
			<div class="col-6">
				<div class="service-section-image">
					<img src="{{URL::asset('frontend/assets/img/filter.webp')}}">
				</div>
			</div>
			<div class="col-12 mt-5">
				<div class="service-content-section w-50 mx-auto text-center">
				Everyone has subscribed to mobile phone plan or a home internet service and everyone has his own unique experience. Because of the telecom nature, the service defer from a location to another and from  specific service to another. A carrier may have a perfect coverage for the whole city except for one single neighborhood. While another one may provide an excellent 100 Mbps service but a horrible Gbps service. TelcoTales enables users to share their experience "Telco Tales" on our website so everyone benefits and easily pick the best service, while carriers can spot their weaknesses and improve them 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="section-title">How Does it Work</h1>
				</div>
			</div>
			<div class="col-md-8 offset-md-2">
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
		<div class="row mt-5">
			<div class="col-md-8 offset-md-2">
				<div class="sign-up-email">
					<div class="form-group fields">
						<input type="text" class="form-control" placeholder="Your email">
						<button class="btn btn-info">Register for free</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="row">
					<div class="col-2 text-center">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/House%20Sketch.webp')}}"/>
						</div>
					</div>
					<div class="col-10">
						<div class="content-section">
							Moving your home and don't know if your current service is still suitable?
						</div>
					</div>
					<div class="col-2 text-center">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/Ringing%20Phone.webp')}}"/>
						</div>
					</div>
					<div class="col-10">
						<div class="content-section">
							Looking for a new mobile device or a mobile plan?
						</div>
					</div>
					<div class="col-2 text-center">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/Documents.webp')}}"/>
						</div>
					</div>
					<div class="col-10">
						<div class="content-section">
							Changing your mobile carrier?
						</div>
					</div>
					<div class="col-2 text-center">
						<div class="image-section">
							<img src="{{URL::asset('frontend/assets/img/454550-PGQH10-539.webp')}}"/>
						</div>
					</div>
					<div class="col-10">
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
					<a href="{{url('/devices')}}" class="btn btn-green">Device</a>
				</div>
			</div>
		</div>
		<div class="row bg-green">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="section-title">How do we get our information</h1>
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="image-info">
					<img src="{{URL::asset('frontend/assets/img/28561.webp')}}"/>
				</div>
			</div>
			<div class="col-12 text-center mt-3">
				<div class="content-info w-75 mx-auto">
				Telcotales is a fee telecommunication websites specialized in collecting, analyzing and evaluating telecom carriers and providers world wide. We Depend 100% on our users reviews to rates. With the huge demand on telecommunication and data these days, telecom is considered the most important and critical products and services offered worldwide. The market is offering thousands of telecom and mobile device and hundreds of thousands of telecom plans and telecom subscriptions. Internet Companies and mobile wireless companies’ network are covering millions of kilometers. All these mobile phones, smart devices, pans, subscription and telecom services varies from one company to another and from one brand to another, even within the same network the provided service may vary from city to another or even from a neighborhood to another. For that Telcotales share every one’s experience and reviews to help you pick
				</div>
			</div>
		</div>
		<div class="row my-5">
			<div class="col-4">
				<div class="card-blog">
					<a herf="#">
						<div class="poster">
							<div class="text-center image-blog">
								<img src="{{URL::asset('frontend/assets/img/file.png')}}">
							</div>
							<div class="detail">
								<div class="top-section px-2">
									<small>Fares Al Refai</small><br>
									<small>Oct 21, 2018 - 1 min</small>
								</div>
								<div class="title-blog  px-2">
									<h2>
										<a href="#">Why You should take your time before getting a apln</a>
									</h2>
									<hr/>
								</div>
								<div class="blog-footer  px-2">
									<small>2 views</small>&nbsp;
									<small>Write a comment</small>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-4">
				<div class="card-blog">
					<a herf="#">
						<div class="poster">
							<div class="text-center image-blog">
								<img src="{{URL::asset('frontend/assets/img/file.png')}}">
							</div>
							<div class="detail">
								<div class="top-section px-2">
									<small>Fares Al Refai</small><br>
									<small>Oct 21, 2018 - 1 min</small>
								</div>
								<div class="title-blog  px-2">
									<h2>
										<a href="#">Why You should take your time before getting a apln</a>
									</h2>
									<hr/>
								</div>
								<div class="blog-footer  px-2">
									<small>2 views</small>&nbsp;
									<small>Write a comment</small>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-4">
				<div class="card-blog">
					<a herf="#">
						<div class="poster">
							<div class="text-center image-blog">
								<img src="{{URL::asset('frontend/assets/img/file.png')}}">
							</div>
							<div class="detail">
								<div class="top-section px-2">
									<small>Fares Al Refai</small><br>
									<small>Oct 21, 2018 - 1 min</small>
								</div>
								<div class="title-blog  px-2">
									<h2>
										<a href="#">Why You should take your time before getting a apln</a>
									</h2>
									<hr/>
								</div>
								<div class="blog-footer  px-2">
									<small>2 views</small>&nbsp;
									<small>Write a comment</small>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="row bg-green">
			<div class="col-12 text-center">
				<div class="heading detail-div">
					<h1 class="section-title">Subscribe Form</h1>
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

	/* Blog Grid section */
	.subscrib .btn{
		border-color: rgba(57,62,68,1) !important;
		background-color: rgba(57,62,68,1) !important;
		color:#fff !important; 
	}
	.text-center.image-blog {
		position: relative;
		height: 100%;
	}
	.blog-footer {
		color: #fff;
		position: absolute;
		bottom: 12px;
	}
	.top-section{
		color: #fff;
	}
	.title-blog h2 a {
		color: #fff;
		font-size: 23px !important;
	}
	.title-blog hr{
		border-top : 1px solid #fff !important;
	}
	.title-blog {
		position: absolute;
		bottom: 40px;
	}
	.card-blog {
		height:300px;
		box-shadow:0 5px 10px rgba(0,0,0,0.5);
	}	
	.poster {
		position: relative;
		height: 300px;
	}
	.poster img{
		height: 100%;
		margin:0 auto;
	}
	.detail {
		background: #0000007d;
		position: absolute;
		width: 100%;
		height: 300px;
		top: 0;
	}
	
	/* End Blog Grid section */
	.bg-image{
		height: 300px;
    	background-size: cover;
	}
	.btn-blue{
		background-color: #2e75b5;
		border-color: #2e75b5;
		padding: 3px 30px;
		border-radius:3px;
		color: #fff !important;
	}
	.btn-green{
		margin-left: 30px;
		background-color: #58fca3;
		padding: 3px 30px;
		border-radius:3px;
		color: #000 !important;
	}
	.sign-up-email .fields button{
		color: #000;
	}
	.sign-up-email .fields {
		display: flex;
	}
	.sign-up-email {
		width: 50%;
		margin: 0 auto;
	}
	section#main-top-section {
		padding-top: 145px;
	}
	.first-section-image img{
		border:8px solid rgba(27, 252, 163, 1);
		border-radius: 5px; 
	}
	.first-section-text {
		width: 400px;
		margin: 0 auto;
		color: #fff;
		background-color: #2e76b5;
		padding: 15px;
		border-radius: 5px;
		box-shadow: 0px 0px 4px 2px #000;
	}
	.find-service-section{
		width: 65%;
	}
	a.service-section-plan ,a.service-section-device{
		border: 2px solid #0077b5;
		border-radius: 5px;
		padding: 5px 20px;
		margin-right: 20px;
	}
	.service-section-image img {
		border: 8px solid #2e76b5;
		border-radius:3px;
	}
	.bg-blue {
    	background-color: #2e75b5;
		padding: 25px;
		color: #fff;
	}
	.bg-green {
    	background-color: #58fca3;
		padding: 25px;
		color: #000;
	}
	.work-icon {
		font-size: 60px;
	}
	.work-content {
		min-height: 150px;
	}
	.work-title {
		min-height: 50px;
	}
	
</style>

@endsection