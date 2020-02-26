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
		<div class="inner-page start-page">
		    <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="step_three_img text-center">
                            <img src="{{URL::asset('frontend/assets/img/Waves_iPhone_Case.png')}}"/>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="title-step-1 w-75">
                            <h1>STEP #3</h1>
                            <h1>What about Rating Your Service Today?</h1>
                        </div>
                    </div>
                </div>
                <!-- <div class="row second-step">
                    <div class="col-lg-12">
                        <div class="step_two_img">
                            <img src="{{URL::asset('frontend/assets/img/Tube_Lights_(1).png')}}"/>
                        </div>
                    </div>
                </div> -->
		        <!-- <div class="row">
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
		        </div> -->
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
        	               		<div class="row align-items-center">
        	               		    <div class="col-lg-6">
        	               		        <div class="">
        	               		            <h5>{{$question->question}}</h5>
        	               		        </div>
        	               		    </div>
        	               		    <div class="col-lg-6">
                                       <div class="row">
                                            <div class="col-lg-6">
                                            @if($question->text_field == 1)
                                                <div class="form-group mb-2">
                                                    <input type="text" class="form-control" id="text_field_value{{$question->id}}">		
                                                </div>
                                            @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="rating float-right" data-question_id="{{$question->id}}"></div>
                                            </div>
                                       </div>
        	               		    	
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
                                    @if($type == 1)
	               		        	<input type="hidden" name="service_id" class="service_id" value="{{$plan_id}}">
                                    <input type="hidden" name="type" class="plan-type" value="1">
                                    @else
                                    <input type="hidden" name="service_id" class="service_id" value="{{$device_id}}">
                                    <input type="hidden" name="type" class="plan-type" value="2">
                                    @endif
                                    <button type="submit" class="btn  btn-lg btn-primary service-rating-submit-btn-add">Submit</button>
                                    <button type="submit" class="btn  btn-lg btn-primary service-rating-submit-btn d-none">Submit</button>
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
                                @if($userAddress)
                                <div class="col-lg-8">
                                    <div class="address">{{$userAddress->formatted_address}}</div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="text-green primary">Primary</div>
                                    <button class="btn btn-primary d-none make_primary_btn" data-address_id="{{$userAddress->id}}">Make primary</button>
                                </div>
                                <input type="hidden" value="{{$userAddress->id}}" id="user_address_id">
                                <input type="hidden" value="1" id="is_primary">
                                @else
                                    <div class="address">No address found.</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3 confirm_message_section">
                            Do you want to associate this rating with above address ?
                            <div class="confirmation_button text-center mt-3">
                                <button class="btn btn-primary yes">Yes</button>
                                <button class="btn btn-primary no">No</button>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none make_new_address mt-3">
                    <form id="address_form">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5>Address</h5>
                                <div class="form-group">
                                    <input type="text" id="user_full_address" name="user_full_address" class="form-control" placeholder="Address" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Country</h5>
                                <div class="form-group country_div" id="country_div">
                                    <input type="text" id="user_country" name="user_country" class="form-control" placeholder="Country" required="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>City</h5>
                                <div class="form-group city_div" id="city_div">
                                    <input type="text" id="user_city" name="user_city" class="form-control js-input city_input" placeholder="City" autocomplete="off" required="" data-country="IN">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h5>Postal code</h5>
                                <div class="form-group">
                                    <input type="text" id="user_postal_code" name="user_postal_code" class="form-control" placeholder="Postal code" required="">
                                </div>
                            </div>
                            <input type="hidden" name="latitude" id="lat" value="{{$lat}}">
                            <input type="hidden" name="longitude" id="long" value="{{$long}}">
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary save_address">Save</button>
                            </div>
                                
                        </div>
                    </form>
                </div>
                <div class="d-none continue-btn-section text-center mt-3">
                    <button class="btn btn-primary">Continue</button>
                </div>
                
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
        });
        if(isset == 1){
            $('#user_address').modal({
                show: true
            });
        }
    });
    $('.confirmation_button .yes').on('click',function(e){
        $('.service-rating-submit-btn').trigger('click');
        $('#user_address').modal('toggle');
    });
    $('.confirmation_button .no').on('click',function(e){
        $('.confirm_message_section').addClass('d-none');
        $('.make_new_address').removeClass('d-none');
        $('#user_address_id').val(0);
        $('#is_primary').val(0);
    });

    $('.save_address').on('click',function(e){
        e.preventDefault();
        
        if(countrySelection === false){
            $('.country_list').css('display','none');
            $('#country').addClass('error');
            // $('#country').val('');
            if($("#country_div #country-error").length == 0){
                $("#country_div").append('<label id="country-error" class="error" for="country">Pleace select country from a list.</label>');
            }
            return false;
        }else{
            $("#country_div #country-error").remove();
        }
        if(citySelection === false){
            $('.city_list').css('display','none');
            $('#city').addClass('error');
            // $('#city').val('');
            if($("#city_div #city-error").length == 0){
                $("#city_div").append('<label id="city-error" class="error" for="city">Pleace select city from a list.</label>');
            }
            return false;
        }else{
            $("#city_div #country-error").remove();
        }
        
        if(!$("#address_form").valid()){
            return false;
        }else{
            let postal = valid_postal_code($('#address_form #user_postal_code').val(),$('#address_form .city_input').attr('data-country'));
            if(postal != ""){
                if($("#address_form #postal_code-error.errorcustom").length == 0){
                    $('#address_form #user_postal_code').addClass('error');
                    $('#address_form #user_postal_code').after(postal);
                }
                return false;
            }
            var user_full_address = $('#user_full_address').val();
            var user_city = $('#user_city').val();
            var user_country = $('#user_country').val();
            var user_postal_code = $('#user_postal_code').val();
            var is_primary = $('#is_primary').val();
            var user_address_id = $('#user_address_id').val();
            var formatted_address = user_full_address+' '+user_city+' '+user_country+' '+user_postal_code;
            // alert(formatted_address);
            $('.address_list').append('<div class="row mt-2 border-top pt-2"><div class="col-lg-8"> <div class="address">'+formatted_address+'</div></div><div class="col-lg-4 text-right"> <div class="text-green primary d-none">Primary</div><button class="btn btn-primary make_primary_btn" data-address_id="0">Make primary</button> </div></div>');
            $('.make_new_address').addClass('d-none');
            $('.continue-btn-section').removeClass('d-none');
        }
        
    });

    $(document).on('click','.make_primary_btn',function(){
        var address_id = $(this).attr('data-address_id');
        if(address_id==0){
            $('.primary').hide();
            $('.make_primary_btn').removeClass('d-none');
            $('.make_primary_btn').show();
            $(this).hide();
            $(this).prev('.primary').removeClass('d-none');
            $(this).prev('.primary').show();
            $('#user_address_id').val(address_id);
            $('#is_primary').val(1);
        }else{
            $('.primary').hide();
            $('.make_primary_btn').removeClass('d-none');
            $('.make_primary_btn').show();
            $(this).hide();
            $(this).prev('.primary').removeClass('d-none');
            $(this).prev('.primary').show();
            $('#user_address_id').val(address_id);
            $('#is_primary').val(1);
        }
        
    });
    $('.continue-btn-section button').on('click',function(){
        $('.service-rating-submit-btn').trigger('click');
        $('#user_address').modal('toggle');
    });
</script>

@endsection