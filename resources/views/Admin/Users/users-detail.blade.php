@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Users Detail')
@section('content')
<!-- Main content -->
<div class="main-content" id="user-detail">
  @include('layouts.admin_layouts.top_navbar')
  <!-- Header -->
   <div class="header bg-gradient-primary pb-5 pt-5 pt-md-8">
     <div class="container-fluid">
       <div class="header-body">
         <!-- Card stats -->
         <div class="row">
         </div>
       </div>
     </div>
   </div>
  <!-- Page content -->
  <div class="container-fluid mt--5 ">
    <div class="row">
      <div class="col-xl-3 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <a href="#">
                  <img src="{{URL::asset('/frontend/assets/img/user_placeholder.png')}}" class="rounded-circle">
                </a>
              </div>
            </div>
          </div>
          <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            <div class="d-flex justify-content-between">
              <!-- <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
              <a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
            </div>
          </div>
          <div class="card-body pt-0 pt-md-4">
            <div class="row">
              <div class="col">
                <div class="card-profile-stats d-flex justify-content-center mt-md-3">
                  <div>
                    <span class="heading">{{$user->plansCount}}</span>
                    <span class="description">Plans</span>
                  </div>
                  <div>
                    <span class="heading">{{$user->devicesCount}}</span>
                    <span class="description">Device</span>
                  </div>
                  <!-- <div>
                    <span class="heading">89</span>
                    <span class="description">Comments</span>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="text-center">
              <h3>
                {{$user->firstname}} {{$user->lastname}}
              </h3>
              <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>{{$user->nickname}}
              </div>
              <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>( {{$user->email}} )
              </div>
              @if($user->mobile_number != "")
              <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>Ph.no. {{$user->mobile_number}} 
              </div>
              @endif
              <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>Member since: {{date('d, F Y', strtotime($user->created_at)) }}
              </div>
              <div>
                <i class="ni education_hat mr-2"></i>
                @if(isset($user->userPrimaryAddress))
                  {{$user->userPrimaryAddress->formatted_address}}
                @endif
              </div>
              <!-- <hr class="my-4" />
              <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music.</p>
              <a href="#">Show more</a> -->
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-6">
                <a href="{{url('admin/userDetail')}}/{{base64_encode($user->id)}}?type={{base64_encode(1)}}" class="btn btn-sm btn-primary @if(!Request::get('type') || base64_decode(Request::get('type')) == 1) active @endif">Plans</a>
                <a href="{{url('admin/userDetail')}}/{{base64_encode($user->id)}}?type={{base64_encode(2)}}" class="btn btn-sm btn-primary @if(base64_decode(Request::get('type')) == 2) active @endif">Devices</a>
              </div>
              <div class="col-6 text-right">
                  <a href="{{url(Request::session()->get('backUrlUser'))}}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> Back</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="accordion" class="admin-profile">
              @if(!Request::get('type') || base64_decode(Request::get('type')) == 1)  
                @if(count($serviceData)>0)
                  @foreach($serviceData as $key => $service)
                    <div class="card">
                      <div class="card-header admin-accordians" id="headingOne">
                        <h5 class="mb-0">
                          <button class="btn btn-link @if($key!=0) collapsed @endif" data-toggle="collapse" data-target="#collapseMain{{$service->id}}" aria-expanded="true" aria-controls="collapseMain{{$service->id}}"> <i class="fa" aria-hidden="true"></i>
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
                          </button>
                        </h5>
                      </div>

                      <div id="collapseMain{{$service->id}}" class="admin_accordian_section collapse @if($key==0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          <div class="service_list_design">
                            <div class="row">
                              <div class="col-lg-4">
                                <div class="card_sm">
                                  <div>Contract type : @if($service->contract_type == 1) 
                                      Personal
                                    @else
                                      Business
                                    @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="card_sm">
                                    <div>Payment type : {{$service->payment_type ?? 'N/A'}}</div>
                                    
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="card_sm">
                                    <div>Review Date : {{ date("d/m/Y", strtotime($service->created_at)) }}</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>Service type : @if(!is_null($service->typeOfService)) 
                                    {{$service->typeOfService['service_type_name']}}
                                    @else N/A @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>Local Min : {{$service->local_min ?? 'N/A'}}</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>DataVolume : {{$service->datavolume ?? 'N/A'}}</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>Long distance Min : {{$service->long_distance_min ?? 'N/A'}}</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>International Min : {{$service->international_min ?? 'N/A'}}</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>Roaming Min : {{$service->roaming_min ?? 'N/A'}}</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>Downloading speed : {{$service->downloading_speed ?? 0}} Mbps @if($service->speedtest_type == 1) <i class="fa fa-tachometer"></i> @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>Uploading speed : {{$service->uploading_speed ?? 0}} Mbps @if($service->speedtest_type == 1) <i class="fa fa-tachometer"></i> @endif</div>
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <div class="card_sm">
                                    <div>SMS : {{$service->sms ?? 'N/A'}}</div>
                                </div>
                              </div>
                              <div class="col-lg-12 mt-2">
                                <div class="card_sm">
                                    <div>How much are you paying monthly multi currencies should be supported : @if(!is_null($service->currency))
                                      {{$service->currency->currency_code}}@else-
                                      @endif&nbsp;{{$service->price}}</div>
                                </div>
                              </div>
                            </div>
                            <hr/>
                            <div class="row align-items-center">
                              <div class="col-lg-12">
                                <div class="heading detail-div">
                                    <h2 class="section-title text-center"><i class="ni ni-favourite-28 rating-heart"></i> Ratings</h2>
                                </div>
                              </div>
                              <!-- Rating -->
                              <div id="accordion{{$service->id}}" class="admin-profile">
                                @if(!is_null($service->ratings)) 
                                  @foreach($service->ratings as $innerKey => $rating)
                                    @if($rating['plan_id']==$service->id)
                                      <div class="panel-heading mt-2 inner-admin-accordians px-3" role="tab" id="rating{{$service->id}}{{$innerKey}}">
                                        <div class="row">
                                          <div class="col-8">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion{{$service->id}}" href="#ratingcollapse{{$service->id}}{{$innerKey}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$innerKey}}" class="accordion_btn rating_btn">
                                                <i class="more-less glyphicon glyphicon-plus"></i><b>Average</b> : &nbsp;{{$rating['average']}}
                                            </a>
                                          </div>
                                          <div class="col-4 text-right">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion{{$service->id}}" href="#ratingcollapse{{$service->id}}{{$innerKey}}" aria-expanded="true" aria-controls="ratingcollapse{{$service->id}}{{$innerKey}}" class="accordion_btn text-right">{{ date("d/m/Y", strtotime($rating['date'])) }}</a>
                                          </div>
                                        </div>
                                      </div>
                                      <div id="ratingcollapse{{$service->id}}{{$innerKey}}" class="inner-accordian-content panel-collapse collapse @if($innerKey == count($service->ratings)) show @endif rating_content" role="tabpanel" aria-labelledby="rating{{$service->id}}{{$innerKey}}">
                                        <div class="panel-body w-100">
                                          <div class="row">
                                              <div class="col-lg-12 mb-3 border-bottom">
                                                <div class="card_sm">
                                                  <div class="row pb-2">
                                                    <div class="col-lg-4">
                                                      <b>Address</b>
                                                    </div>
                                                    <div class="col-lg-8 text-right">
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
                                                  <div class="col-lg-8">
                                                    <div class="question">
                                                      {{$rate['question_name']}}
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-4">
                                                    <div class="rating_disable float-right" data-rate-value="{{$rate['rating']}}"></div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            </div>
                                            <div class="row">
                                              <div class="col-lg-12">
                                                <h2 class="section-title text-center"><i class="ni ni-chat-round rating-heart"></i> Comment</h2>
                                                <p class="comment">{{$rating['comment']}}</p>
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="division"></div>
                                    @endif
                                  @endforeach
                                @endif
                              </div>
                              <!-- Rating -->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                      {{ $serviceData->appends(request()->query())->links()}}
                @else
                  <div class="row">
                    <div class="col-lg-12">
                      <h3 class="text-center">
                        No data found
                      </h3>
                    </div>
                  </div>
                @endif
              @endif
              @if(base64_decode(Request::get('type')) == 2) 
                @if(count($serviceData)>0)
                  @foreach($serviceData as $key => $device)
                    <div class="card">
                      <div class="card-header admin-accordians" id="headingOne">
                        <h5 class="mb-0">
                          <button class="btn btn-link @if($key!=0) collapsed @endif" data-toggle="collapse" data-target="#collapseMain{{$device->id}}" aria-expanded="false" aria-controls="collapseMain{{$device->id}}"> <i class="fa" aria-hidden="true"></i>
                            <ul class="inline_list">
                              <li><b>Device Name</b> : &nbsp;{{$device->device_name}}
                              </li> 
                              <li><b>Brand Name</b> : &nbsp;{{$device->brand_name}}</li>
                              <li><b>Model</b> : &nbsp;&nbsp;{{$device->model_name}}</li>
                            </ul>
                          </button>
                        </h5>
                      </div>

                      <div id="collapseMain{{$device->id}}" class="collapse @if($key==0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-6 text-center">
                              <div class="card_sm">
                                <div>Price : @if(!is_null($device->currency))
                                              {{$device->currency->currency_code}}@else-
                                              @endif&nbsp;{{$device->price}}
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6 text-center">
                              <div class="card_sm">
                                  <div>Storage : {{$device->storage}}</div>
                              </div>
                            </div>
                          </div>
                          <hr/>
                          <div class="row align-items-center">
                            <div class="col-lg-12">
                              <div class="heading detail-div">
                                  <h2 class="section-title text-center"><i class="ni ni-favourite-28 rating-heart"></i> Ratings</h2>
                              </div>
                            </div>
                            <div id="accordion{{$device->id}}" class="admin-profile">
                              <!-- Rating -->
                              @if(!is_null($device->ratings)) 
                                @foreach($device->ratings as $deviceInnerKey => $rating)
                                  @if($rating['device_id']==$device->id)
                                    <div class="panel-heading inner-admin-accordians mt-2 px-3" role="tab" id="rating{{$device->id}}{{$deviceInnerKey}}">
                                      <div class="row">
                                        <div class="col-8">
                                          <a role="button" data-toggle="collapse" data-parent="#accordion{{$device->id}}" href="#ratingcollapse{{$device->id}}{{$deviceInnerKey}}" aria-expanded="true" aria-controls="ratingcollapse{{$device->id}}{{$deviceInnerKey}}" class="accordion_btn rating_btn">
                                              <i class="more-less glyphicon glyphicon-plus"></i><b>Average</b> : &nbsp;{{$rating['average']}}
                                          </a>
                                        </div>
                                        <div class="col-4 text-right">
                                          <a role="button" data-toggle="collapse" data-parent="#accordion{{$device->id}}" href="#ratingcollapse{{$device->id}}{{$deviceInnerKey}}" aria-expanded="true" aria-controls="ratingcollapse{{$device->id}}{{$deviceInnerKey}}" class="accordion_btn text-right">{{ date("d/m/Y", strtotime($rating['date'])) }}</a>
                                        </div>
                                      </div>
                                    </div>
                                    <div id="ratingcollapse{{$device->id}}{{$deviceInnerKey}}" class="inner-accordian-content panel-collapse collapse @if($deviceInnerKey == count($device->ratings)) show @endif rating_content" role="tabpanel" aria-labelledby="rating{{$device->id}}{{$deviceInnerKey}}">
                                        <div class="panel-body w-100">
                                          <div class="row">
                                            <div class="col-lg-12 mb-3 border-bottom">
                                              <div class="card_sm">
                                                <div class="row pb-2">
                                                  <div class="col-lg-4">
                                                    <b>Address</b>
                                                  </div>
                                                  <div class="col-lg-8 text-right">
                                                    <div class="pull-right" >{{$rating['formatted_address']}}</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          @foreach($rating['ratingList'] as $rate)
                                          @if($rate['entity_id'] == $device->id)
                                            <div class="col-lg-12 mb-3">
                                              <div class="card_sm">
                                                <div class="row">
                                                  <div class="col-lg-8">
                                                    <div class="question">
                                                      {{$rate['question_name']}}
                                                    </div>
                                                  </div>
                                                  <div class="col-lg-4">
                                                    <div class="rating_disable float-right" data-rate-value="{{$rate['rating']}}"></div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            </div>
                                            <div class="row">
                                              <div class="col-lg-12">
                                                <h2 class="section-title text-center"><i class="ni ni-chat-round rating-heart"></i> Comment</h2>
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
                  @endforeach
                      {{ $serviceData->appends(request()->query())->links()}}
                @else
                  <div class="row">
                    <div class="col-lg-12">
                      <h3 class="text-center">
                        No data found
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
    <!-- Footer Section Include -->
        @include('layouts.admin_layouts.footer')
    <!-- End Footer Section Include -->
  </div>
</div>
@endsection