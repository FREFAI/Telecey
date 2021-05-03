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
	ul.first_row_service {
		font-size: 14px;
	}
	.question, .comment {
	    font-size: 14px;
        font-family: montserrat,sans-serif;
	}
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
    #heading{
        background-color: #96fdd4;
        padding: 10px;
    }
    .innerHeading {
        padding: 0 20px;
        outline: none;
        border-radius: 4px;
        background: #96fdd4;
        border: 1px solid transparent;
        width: 100%;
        box-shadow: 0 0 10px rgba(175, 175, 175, .23);
    }
    .innerHeading h4 a {
        color: #495057;
        padding-left: 0;
        padding-right: 0;
    }
    .innerHeading a {
        font-size: 14px;
        font-weight: 400;
        padding: 15px 35px 15px 30px;
        display: inline-block;
        width: 100%;
        color: #fff;
        position: relative;
    }
    .rating-sec{
        padding-top: 15px;
    }
    .inner-accordian {
        background-color: #2e75b5 !important;
    }
    .inner-accordian a {
        color: #fff !important;
        padding-top: 8px !important;
        padding-bottom: 8px !important;
    }
</style>
<div class="profile inner-page">
	<div class="container">
        <div class="row">
            <div class="col-lg-12 my-2 text-right">
                <button class="searchnow-button" onclick="goBack()"><i class="fas fa-angle-left"></i> {{__('index.Back')}}</button>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="panel-heading mb-2" role="tab" id="heading" >
                    <div class="row align-items-center">
                        <div class="col-3 ">
                                <b>{{__('profile.provider_name')}}</b> : &nbsp;@if(!is_null($service->provider)) {{$service->provider->provider_name}}
                                @else
                                -
                                @endif
                        </div>
                        <div class="col-3 ">
                                <b>{{__('profile.service_type')}}</b> : &nbsp;@if(!is_null($service->typeOfService)) 
                                {{$service->typeOfService['service_type_name']}}
                                @else
                                    -
                                @endif
                        </div>
                        <div class="col-3 ">
                                <b>{{__('profile.price')}}</b> : &nbsp;&nbsp;{{$service->c_code}}&nbsp;{{$service->price}}
                        </div>
                        <div class="col-3 ">
                            @if(!is_null($service->provider)) 
                                @if($service->provider->status == 1)
                                    <span class="font-weight-bold">{{__('profile.approved')}}</span>
                                @else
                                    <span class="font-weight-bold text-danger">{{__('profile.notapproved')}}</span>
                                @endif
                            @else
                            -
                            @endif      
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="service_list_design">
                        <div class="row">
                            <div class="col-lg-3">
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
                            <div class="col-lg-3">
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
                            <div class="col-lg-3">
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
                            <div class="col-lg-3 mt-2">
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
                            <div class="col-lg-3 mt-2">
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
                            <div class="col-lg-3 mt-2">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>{{__('profile.datavol')}} : </div>
                                        <div class="value_div">&nbsp;{{$service->datavolume ?? 'N/A'}}</div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>{{__('profile.long_dis')}} : </div>
                                        <div class="value_div">&nbsp;{{$service->long_distance_min ?? 'N/A'}}</div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>{{__('profile.internantionalmin')}} : </div>
                                        <div class="value_div">&nbsp;{{$service->international_min ?? 'N/A'}}</div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>{{__('profile.romingmin')}} : </div>
                                        <div class="value_div">&nbsp;{{$service->roaming_min ?? 'N/A'}}</div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>{{__('profile.downloading')}} : </div>
                                        <div class="value_div">&nbsp;{{$service->downloading_speed ?? 0}} Mbps @if($service->speedtest_type == 1) <i class="fa fa-tachometer"></i> @endif</div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-2">
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
                            <div class="col-lg-3 mt-2">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>{{__('profile.sms')}} : </div>
                                        <div class="value_div">&nbsp;{{$service->sms ?? 'N/A'}}</div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-2">
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
                            <div class="col-lg-6 mt-2">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>{{__('profile.location')}} : </div>
                                        <div class="value_div">&nbsp;{{$service->user_address ?? 'N/A'}}</div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading detail-div">
                                    <h1 class="section-title">{{__('profile.rating')}}</h1>
                                </div>
                                <!-- <div class="add_new_rating_btn">
                                    <a href="{{url('/reviews')}}/{{base64_encode($service->id)}}" class="btn btn-info pull-right add_service">Add rating</a>
                                </div> -->
                            </div>
                            <!-- Rating -->
                            @if(!is_null($service->ratings)) 
                                    @foreach($service->ratings as $key => $rating)
                                            @if($rating['plan_id']==$service->id)
                                                <div class="panel-heading mt-2 w-100 innerHeading inner-accordian" role="tab" id="rating{{$service->id}}{{$key}}">
                                                    <h4 class="panel-title display-inline mb-0">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$service->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$key}}" class="accordion_btn rating_btn">
                                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                                            <ul class="inline_list">
                                                                <li class="d-flex"><b>{{__('profile.average')}}</b> : &nbsp;<div class="rating_disable" data-rate-value="{{$rating['average']}}"></div>
                                                                </li>
                                                            </ul>
                                                        </a>
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ratingcollapse{{$service->id}}{{$key}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$key}}" class="accordion_btn text-right">{{ date("d/m/Y", strtotime($rating['date'])) }}</a>
                                                    </h4>
                                                </div>
                                                <div id="ratingcollapse{{$service->id}}{{$key}}" class="panel-collapse collapse @if($key == count($service->ratings)) show @endif rating_content" role="tabpanel" aria-labelledby="rating{{$service->id}}{{$key}}">
                                                    <div class="panel-body w-100">
                                                        <div class="row">
                                                            <div class="col-lg-12 mb-3 border-bottom">
                                                                <div class="card_sm">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 rating-sec">
                                                                            <b>{{__('profile.address')}}</b>
                                                                        </div>
                                                                        <div class="col-lg-8 rating-sec">
                                                                            <div class="pull-right" >{{$rating['formatted_address']}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @foreach($rating['ratingList'] as $rate)
                                                        @if($rate['entity_id'] == $service->id && $rate['question_name'] != "")
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="card_sm">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="question">
                                                                            {{$rate['question_name']}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                    {{$rate['text_field_value']}}
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
@endsection
<script>
    function goBack() {
    window.history.back();
    }
</script>