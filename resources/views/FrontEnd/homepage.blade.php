@extends('layouts.frontend_layouts.frontend')
@section('content')

	<!-- Content Start Here -->
		<section id="third" >
		    <div class="container-fluid">
		        <div class="row">
		            <div class="col-md-12 text-center pl-0 pr-0 video-height">
		                <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" class="video-rp rounded">
		                    <source src="{{URL::asset('frontend/assets/img/file.mp4')}}" type="video/mp4">
		                </video>
		            </div>
		        </div>
		    </div>
		</section>
		<section class="">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12 text-center slider-contant">
	                    <div id="typedtext"></div><br>
		                <a href="{{url('/signup')}}"class="btn btn-common btn-find lg-mt-5 md-mt-0">Register For Free</a>
		            </div>
		        </div>
		    </div>
		</section>
		<section class="plan-device-sec">
		    <div class="container">
		        <div class="row pt-5 pb-5">
		            <div class="col text-center">
		                <p class="font_p">Looking for a new mobile device or a mobile plan? Or changing your mobile carrier?
		                        Search other users reviews and feed back for the best plan in the area
		                        Find out the best product that fits your need, budget and expectation with us </p>
		                <a href="{{url('/plans')}}"class="btn btn-common btn-find black mt-5 mr-4">Plan</a>
		                @if($settings)
		                    @if($settings->device == 1)
		                        <a href="{{url('/devices')}}"class="btn btn-common btn-find bor-black mt-5">Device</a>
		                    @endif
		                @else
		                    <a href="{{url('/devices')}}"class="btn btn-common btn-find bor-black mt-5">Device</a>
		                @endif
		            </div>
		        </div>
		    </div>
		</section>
		<section class="section-padding">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12 text-center">
		                <div class="heading">
		                    <h1 class="">How do we get our information</h1>
		                </div>
		                <div class="col text-center about-text">
		                    <h5>
		                    	Telcotales is a fee telecommunication websites specialized in collecting, analyzing and evaluating telecom carriers and providers world wide. We Depend 100% on our users reviews to rates.
		                    	With the huge demand on telecommunication and data these days, telecom is considered the most important and critical products and services offered worldwide. 
		                    	The market is offering thousands of telecom and mobile device and hundreds of thousands of telecom plans and telecom subscriptions.
		                    	Internet Companies and mobile wireless companies’ network are covering millions of kilometres.
		                    	All these mobile phones, smart devices, pans, subscription and telecom services varies from one company to another and from one brand to another, even within the same network the provided service may vary from city to another or even from a neighbourhood to another.
		                    	For that Telcotales share every one’s experience and reviews to help you pick
		                    </h5>
		                    <a href="{{url('/signup')}}"class="btn btn-common btn-find mt-5">Register For Free</a>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
		<section id="services" class="bounce-inInverse">
		    <div class="containerContent">
			    <div class="set_size_section1">
			        <div class="article_center2">
			            <div class="col-lg-3">
			                <article class="section1_article">
			                    <img alt="Basket" src="{{URL::asset('frontend/assets/img/dollar_icon.png')}}" width="78" height="77">
			                    <h3>Save Bige</h3>
			                    <h4>Get the hidden deals,,,,</h4>
			                    <p>Easily search for the telecom provider or carrier who provides the cheapest mobile plan or internet subscription</p>
			                </article>
			            </div>
			            <div class="col-lg-3">
			                <article class="section1_article">
			                        <img alt="Basket" src="{{URL::asset('frontend/assets/img/diamond_icon.png')}}" width="78" height="77">
			                    <h3>Value</h3>
			                    <h4>(more minutes, more data GB)</h4>
			                    <p>Whose providing more value from all telecom companies and what they best deal for mobile plan or internet subscription</p>
			                </article>
			            </div>
			            <div class="col-lg-3">
			                <article class="section1_article">
			                        <img alt="Basket" src="{{URL::asset('frontend/assets/img/Quality_icon.png')}}" width="78" height="77">
			                    <h3>Quality</h3>
			                    <h4>Coverage, Speed & Stability</h4>
			                    <p>Which provider or carrier provides the best coverage service in your location</p>
			                </article>
			            </div>
			            <div class="col-lg-3">
			                <article class="section1_article">
			                        <img alt="Basket" src="{{URL::asset('frontend/assets/img/customer_icon.png')}}" width="78" height="77">
			                    <h3>Customer Service</h3>
			                    <h4>Waiting for hours for support?</h4>
			                    <p>And of course the best telecom customer care & service</p>
			                </article>
			            </div>
			        </div>
			    </div>
		    </div>
		</section>
		<section id="second" class="section-padding">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12 text-center">
		                <div class="gif-section">
	                        <div class="video-size">
		                        <video  autoplay loop controls muted>
		                            <source src="{{URL::asset('frontend/assets/img/1file.mp4')}}" type="video/mp4">
		                        </video>
		                    </div>
		                </div>
		            </div>
		        </div>
		        <div class="row">
		            <div class="col text-center">
	                    <a href="{{url('/signup')}}"class="btn btn-common btn-find mt-5">Register For Free</a>
		            </div>
		        </div>
		    </div>
		</section>
		<div class="row grid-container pt-5 pb-5">
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
		        <div class="product-box column">
		            <a href="#" class="product-item">
		                <div class="product-item-image">
		                    <img src="{{URL::asset('frontend/assets/img/airpod.png')}}" alt="Stadium Full Exterior">
		                    <div class="product-item-image-hover">
		                    </div>
		                </div>
		                <div class="product-item-content">
		                    <div class="product-item-category">
		                         Airpod
		                    </div>
		                    <div class="product-item-title">
		                        By Fariscom
		                    </div>
		                    <div class="product-item-price">
		                            Save 25% with you first purchase
		                    </div>
		                    <div class="button-pill">
		                        <span>Shop Now</span>
		                    </div>
		                </div>
		            </a>
		        </div>
		    </div>
		    <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
	            <div class="product-box column">
	                <a href="#" class="product-item">
	                    <div class="product-item-image">
                            <img src="{{URL::asset('frontend/assets/img/phone-case.png')}}" alt="Stadium Full Exterior">
	                        <div class="product-item-image-hover">
	                        </div>
	                    </div>
	                    <div class="product-item-content">
	                        <div class="product-item-category">
	                                i Phone Case
	                        </div>
	                        <div class="product-item-title">
	                                By Fariscom
	                        </div>
	                        <div class="product-item-price">
	                                Extra slim cover
	                        </div>
	                        <div class="button-pill">
	                            <span>Shop Now</span>
	                        </div>
	                    </div>
	                </a>
	            </div>
	        </div>
	        <div class="col-lg-4 grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper">
	            <div class="product-box column">
	                <a href="#" class="product-item">
	                    <div class="product-item-image">
                            <img src="{{URL::asset('frontend/assets/img/sony.png')}}" alt="Stadium Full Exterior">
	                        <div class="product-item-image-hover">
	                        </div>
	                    </div>
	                    <div class="product-item-content">
	                        <div class="product-item-category">
	                                By Best Buy
	                        </div>
	                        <div class="product-item-title">
	                                Sony Wirless Headphones
	                        </div>
	                        <div class="product-item-price">
	                                Powerful Bluetooth headphones
	                        </div>
	                        <div class="button-pill">
	                            <span>Shop Now</span>
	                        </div>
	                    </div>
	                </a>
	            </div>
	        </div>
	    </div>
	    <section  class="section-padding">
         	<div class="container">
	            <div class="row">
	                <div class="col-lg-4">
	                    <div class="img-cl-row">
	                        <img src="{{URL::asset('frontend/assets/img/men-call.png')}}" alt="" >
	                    </div>
	                    <div class="img-conatnt-row mt-5">
	                        <h3>Voice (min)</h3>
	                        <p>Search Other's reviews and see how much voice  minutes others are getting. Find out if you’re paying fairly</p>
	                    </div>
	                </div>
	                <div class="col-lg-4">
	                    <div class="img-conatnt-row">
	                        <h3>Mbps / GB</h3>
	                        <p>Search reviews and see how much Data others are getting. Find out if you’re paying fairly</p>
	                    </div>
	                    <div class="img-cl-row mt-5">
	                        <img src="{{URL::asset('frontend/assets/img/girl-call.png')}}" alt="" >
	                    </div>
	                </div>
	                <div class="col-lg-4">
	                    <div class="img-cl-row">
	                        <img src="{{URL::asset('frontend/assets/img/men-mac.png')}}" alt="" >
	                    </div>
	                    <div class="img-conatnt-row mt-5">
	                        <h3>Register& share your experience</h3>
	                        <p>Share your your current anonymously to help others</p>
	                    </div>
	                </div>
	            </div>
	            <div class="row">
	                <div class="col text-center mt-4">
	                        <a href="plan.html"class="btn btn-common btn-find black mt-5 mr-4">Plan</a>
	                        @if($settings)
	                            @if($settings->device == 1)
	                                <a href="device.html"class="btn btn-common btn-find bor-black mt-5">Device</a>
	                            @endif
	                        @else
	                            <a href="device.html"class="btn btn-common btn-find bor-black mt-5">Device</a>
	                        @endif
	                        
	                </div>
	            </div>
	        </div>
	    </section>
	    <section class="plan-device-sec">
	        <div class="container">
	            <div class="row pt-5 pb-5">
		            <div class="col-lg-6">
		                 <div class="our-background-contant">
	                     	<h2>Our Background</h2>
	                     	<h5 class="pt-3">How We Got Our Start</h5>
	                     	<p class="pt-3">
	                     		Every one have subscribed to mobile phone plan or a home internet service and every one have is own unique experience.  This is because we are all different taste and quality preference and because of the telecom nature which defer from location to another and from service or package to another.
	                     		A carrier can have a perfect coverage in the whole city but totally off in one single  neighborhood. Other operator provide an excellent 100 Mbps service but a horrible Gbps service. 
	                     		After a lot of research we couldn't find a single website that is 100% specialized in reviewing and rating telecommunication companies and Not being a retail for them
	                     	</p>
		                 </div>
		            </div>
                 	<div class="col-lg-6 phone-img-bg">
                        <img src="{{URL::asset('frontend/assets/img/phone.png')}}" alt="" >
                 	</div>
	            </div>
	        </div>
	    </section>
	    <section  class="section-padding">
	        <div class="container">
	            <div class="row">
	                <div class="col text-center">
                        <a href="{{url('/signup')}}"class="btn btn-common btn-find ">Register For Free</a>
	                </div>
	            </div>
	        </div>
	    </section>
	    <section>
	        <div class="container">
	            <div class="row">
	            	@if(count($blogs) > 0)
	            		@foreach($blogs as $blog)
			                <div class="col-lg-4">
			                    <div class="blog-post home_post">
			                        <div class="post-thumb">
			                            <a href="#">
			                            	<img class="img-fluid" src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}" alt="">
			                            </a>
			                            <div class="hover-wrap"></div>
			                        </div>
			                        <div class="post-content">
			                            <!-- <div class="meta">
			                                <span class="meta-part">
			                                	<a href="#"><i class="lni-heart-filled"></i> 10</a>
			                                </span>
			                                <span class="meta-part">
			                                	<a href="#"><i class="lni-comments-alt"></i> 1 Comments</a>
			                            	</span>
			                            </div> -->
			                            <h2 class="post-title">
			                            	<a href="javascript:void(0);">{{$blog->title}}</a>
			                            </h2>
			                            <div class="entry-summary">
			                                <p>{{substr(html_entity_decode(strip_tags($blog->blog_content)),0,150)}}</p>
			                            </div>
			                            <a href="single-post.html" class="btn btn-common">Read More</a>
			                        </div>
			                    </div>
			                </div>
		                @endforeach
	                @endif
	                
	            </div>
	        </div>
	    </section> 
	<!-- Content End Here -->
	<script type="text/javascript">
		// set up text to print, each item in array is new line
		var aText = new Array(
		    "Be In-control Rate Your Telecom Carrier ",
		    "Search for The Best Service that suites",
		    "your Own needs",
		);
		var iSpeed = 100; // time delay of print out
		var iIndex = 0; // start printing array at this posision
		var iArrLength = aText[0].length; // the length of the text array
		var iScrollAt = 20; // start scrolling up at this many lines
		
		var iTextPos = 0; // initialise text position
		var sContents = ''; // initialise contents variable
		var iRow; // initialise current row
		
		function typewriter()
		{
		    sContents =  ' ';
		    iRow = Math.max(0, iIndex-iScrollAt);
		    var destination = document.getElementById("typedtext");
		    
		    while ( iRow < iIndex ) {
		        sContents += aText[iRow++] + '<br />';
		    }
		    destination.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) + "_";
		    if ( iTextPos++ == iArrLength ) {
		        iTextPos = 0;
		        iIndex++;
		        if ( iIndex != aText.length ) {
		            iArrLength = aText[iIndex].length;
		            setTimeout("typewriter()", 400);
		        }
		    }else{
		        setTimeout("typewriter()", iSpeed);
		    }
		}


		typewriter();
	</script>
@endsection