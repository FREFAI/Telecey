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
</style>
<div class="profile inner-page">
	<div class="container">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="panel-heading mb-2" role="tab" id="heading" >
                    <div class="row align-items-center">
                        <div class="col-4">
                                <b>Device Name</b> : &nbsp;@if(!is_null($service->device)) {{$service->device->device_name}}
                                @else
                                -
                                @endif
                        </div>
                        <div class="col-4">
                                <b>Brand Name</b> : &nbsp;@if(!is_null($service->brand)) 
                                {{$service->brand->brand_name}}
                                @else
                                    -
                                @endif
                        </div>
                        <div class="col-4">
                            <b>Supplier Name</b> : @if(!is_null($service->supplier)) 
                            {{$service->supplier->supplier_name}}
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
                                        <div>Price : </div>
                                        <div class="value_div">
                                            &nbsp;{{$service->price ?? 'N/A'}}
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>Review Date : </div>
                                        <div class="value_div">
                                            &nbsp;{{ date("d/m/Y", strtotime($service->created_at)) }}
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>Storage : </div>
                                        <div class="value_div">
                                            &nbsp;{{$service->storage}}
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card_sm">
                                <ul class="first_row_service">
                                    <li>
                                        <div>Color : </div>
                                        <div class="value_div">
                                            &nbsp;@if($service->device_color_info) 
                                                    {{$service->device_color_info->color_name}}
                                                @else
                                                    N/A
                                                @endif  
                                        </div>
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
                                                <div class="panel-heading mt-2 w-100 innerHeading" role="tab" id="rating{{$service->id}}{{$key}}">
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
                                                <div id="ratingcollapse{{$service->id}}{{$key}}" class="panel-collapse collapse @if($key == count($service->ratings)) show @endif rating_content" role="tabpanel" aria-labelledby="rating{{$service->id}}{{$key}}">
                                                    <div class="panel-body w-100">
                                                        <div class="row">
                                                            <div class="col-lg-12 mb-3 border-bottom">
                                                                <div class="card_sm">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 rating-sec">
                                                                            <b>Address</b>
                                                                        </div>
                                                                        <div class="col-lg-8 rating-sec">
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
                                                                    Comment
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