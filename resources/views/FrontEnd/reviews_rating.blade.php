@extends('layouts.frontend_layouts.frontend')
@section('title', 'Reviews')
@section('content')

<style type="text/css">
    .overage_price {
        background-color: #ffffff;
    }
    #overage_price_model{
        z-index: 999999;
        background-color: #00000052;
    }
    div#user_address {
        z-index: 999999999;
        background: #0000002e;
    }
</style>
	<!-- Content Start Here -->
		<div class="page-header inner-page start-page" style="background: url({{URL::asset('frontend/assets/img/bg-1.jpeg')}});">
		    <div class="container-fluid">
		        <div class="row">
		            <div class="col-lg-4 text-center">
		                <div class="step-section-one">
		                    <img src="{{URL::asset('frontend/assets/img/intro.png')}}">
		                    <h2 class="pt-3 text-white">1</h2>
		                    <h3 class="pt-3 custom-height-cl">PLEASE INTRODUCE YOUR SELF</h3>
		                </div>
		            </div>
		            <div class="col-lg-4 text-center">
		                <div class="step-section-one">
		                    <img src="{{URL::asset('frontend/assets/img/share.png')}}">
		                    <h2 class="pt-3 text-white">2</h2>
		                    <h3 class="pt-3 custom-height-cl">CAN YOU ALSO SHARE YOUR SERVICE DETAILS</h3>
		                </div>
		            </div>
		            <div class="col-lg-4 text-center">
		                <div class="step-section-one">
		                    <img src="{{URL::asset('frontend/assets/img/rating.png')}}">
		                    <h2 class="pt-3 text-white">3</h2>
		                    <h3 class="pt-3 custom-height-cl">ONE MORE THINGDO YOU RATE THIS SERVICE?</h3>
		                </div>
		            </div>
		        </div>
		        <!-- <div class="row">
		                <div class="col text-center">
		                        <a href="javascript:void(0);" data-class="intro-section" class="start_btn">
		                        <button class="learn-more mt-5">
		                            <div class="circle">
		                            <span class="icon arrow"></span>
		                            </div>
		                            <p class="button-text">START</p>
		                        </button>
		                    </a>
		                </div>
		            </div> -->
		    </div>
		</div>
		<!-- share-serv-detail -->
		<section class="service-detail">
		    <div class="container">
                <section class="services-section section-both">
                    <!-- Star rating section -->
                    <div class="services-rating-section section-both" id="rating_section">
	               		<div class="row">
	               		    <div class="heading detail-div">
	               		        <h1 class="section-title">Rating</h1>
	               		    </div>
	               		</div>
                        <div class="row starrating_error d-none">
                            <div class="error">
                                All rating rows are required.
                            </div>
                        </div>
                        @if(count($questions)>0)
                            @foreach($questions as $question)
        	               		<div class="row">
        	               		    <div class="col-lg-6">
        	               		        <div class="">
        	               		            <h5>{{$question->question}}</h5>
        	               		        </div>
        	               		    </div>
        	               		    <div class="col-lg-6">
        	               		    	<div class="rating float-right" data-question_id="{{$question->id}}"></div>
        	               		    	<!-- <div class="rating coverage" data-rate-value=6></div> -->
        	               		    </div>
        	               		</div>
                            @endforeach
                        @endif
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5>Comment</h5>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="form-group">
                                    <textarea class="form-control" id="comment" placeholder="Write comment here...." rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="">
                                    <h5 class="font-weight-bold">Average</h5>
                                </div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <input type="hidden" class="average_input" value="0">
                                <div class="font-weight-bold average_div">0</div>
                            </div>
                        </div>
	               		<div class="row">
	               		    <div class="col-lg-12">
	               		        <div class="form-group w-50 ml-auto mr-auto text-center">
	               		        	<input type="hidden" name="service_id" class="service_id" value="{{$plan_id}}">
                                    <button type="submit" class="btn  btn-lg service-rating-submit-btn-add">Submit</button>
                                    <button type="submit" class="btn  btn-lg service-rating-submit-btn d-none">Submit</button>
                                </div>
	               		    </div>
	               		</div>
	               	</div>
                    <!-- End Star rating section -->

                    <!-- Speed testing button section -->
                    <div class="speed-test-button-section section-d-none section-both mb-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading-speedtest">
                                    <div class="heading detail-div">
                                        <h1 class="section-title">Do you want to check your internet speed?</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="button_section">
                                    <a class="btn learn-more speedtest continue-btn">Continue</a>
                                    <a href="{{url('/profile')}}"  class="btn learn-more speedtest">Skip</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Speed testing button section -->
                    <!-- Speed section -->
                    <div class="speedtest-section section-d-none mb-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="speedsection">
                                    <iframe id="iFrameID" width="100%" height="650px" frameborder="0" src="https://softradix.speedtestcustom.com"></iframe> 
                                </div>
                                <div class="action-section text-center mt-3">
                                    <a href="{{url('/profile')}}" class="btn learn-more speedtest">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Speed section -->
               	</section> 
               	
		    </div>
		</section> 

		<section class="plan-device-sec">
		    <div class="container">
		        <div class="row pt-5 pb-5">
		            <div class="col text-center">
		                <div class="heading">
		                    <h1>Top Rated Carriers in your Area</h1>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
	<!-- Content End Here -->
    <!-- The Modal -->
    <div class="modal fade" id="user_address" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <!-- <div class="modal-header">
            <h4 class="modal-title">Would share the overage price?</h4> -->
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <!-- </div> -->

          <!-- Modal body -->
          <div class="modal-body">
                <div class="default_adderss">
                    <div class="row">
                        <div class="address_list">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="address">Chandigarh India 160018</div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="text-green notprimary">Primary</div>
                                    <!-- <button class="btn btn-primary">Make primary</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3 confirm_message_section">
                            Do you want to associate this rating with above address ?
                            <div class="confirmation_button text-center mt-3">
                                <button class="btn btn-primary yes">Yes</button>
                                <button class="btn btn-primary">No</button>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none make_new_address mt-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Address</h5>
                                <div class="form-group">
                                    <input type="text" id="model_over_price" name="overage_price" class="form-control" placeholder="Address" required="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>City</h5>
                                <div class="form-group">
                                    <input type="text" id="model_data_price" name="data_over_age" class="form-control" placeholder="City" required="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Country</h5>
                                <div class="form-group">
                                    <input type="text" id="model_data_price" name="data_over_age" class="form-control" placeholder="Country" required="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Postal code</h5>
                                <div class="form-group">
                                    <input type="text" id="model_data_price" name="data_over_age" class="form-control" placeholder="Postal code" required="">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="button" class="btn btn-primary">Save</button>
                            </div>
                                
                        </div>
                </div>
                <input type="hidden" value="1" id="user_address_id">
          </div>

        </div>
      </div>
    </div>

<script src="{{URL::asset('frontend/assets/js/jquery-min.js')}}"></script>
<script>
    $('.service-rating-submit-btn-add').on('click',function(e){
        e.preventDefault();
        var isset = 0;
        var perams = [];
        $('#rating_section .rating').each(function(index, item){
            var rate = $(item).rate('getValue');
            var question_id = $(item).attr('data-question_id');
            if(rate==0){
                $('.starrating_error').removeClass('d-none');
                setTimeout(function(){
                $('.starrating_error').addClass('d-none');
                },3000);
                isset = 0;
                return false;
            }else{
                isset = 1;
            }
            if(isset == 1){
                $('#user_address').modal({
                    show: true
                });
            }
        });
    });
    $('.confirmation_button .yes').on('click',function(e){
        $('.service-rating-submit-btn').trigger('click');
        $('#user_address').modal('toggle');
    });
    $('.confirmation_button .no').on('click',function(e){
        $('.confirm_message_section').addClass('d-none');
        $('.make_new_address').removeClass('d-none');

    });
</script>

@endsection