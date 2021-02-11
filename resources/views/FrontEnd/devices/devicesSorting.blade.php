@php
    $i = ($data->currentpage()-1)* $data->perpage() + 1;
    $custom_ads = 0;
    $j = 0; 
@endphp
@foreach($data as $key => $value)
    <tr class="custom-row-cl">
        <td>{{$value->brand_name}}</td>
        <td>{{$value->model_name}}</td>
        <td>{{$value->supplier_name}}</td>
        <td>
            @if($filtersetting->display_price == 1)
                {{$value->price}}
            @elseif($filtersetting->display_price == 2)
                {{roundUp($value->price, -1)}}
            @endif
        </td>
        <td>{{$value->storage}}</td>
        <td>{{round($value->distance)}} KM</td>
        @if(Auth::guard('customer')->check())
            @if(!$filtersetting->review_detail_for_unverified)
                @if(Auth::guard('customer')->user()['is_active'])
                    <td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value->id)}}">{{__('deviceresult.detail_btn')}}</td>
                @else
                    <td data-order="-1"><a href="{{url('/resendVerifyEmail')}}" class="btn table-row-btn">Verify your email</a></td>
                @endif
            @else
                <td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value->id)}}">{{__('deviceresult.detail_btn')}}</td>
            @endif
        @else
            @if($filtersetting->disable_details_for_logged_out_users == 1)
                <td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value->id)}}">{{__('deviceresult.detail_btn')}}</td>
            @else
                <td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">{{__('deviceresult.signup_unlock')}}</td>
            @endif
        @endif
    </tr>
    @if(count($ads) > 0)
        @if($i%10 == 0)
            @if($custom_ads === 0)
                @if($j < count($ads))
                    @php $custom_ads = 1; @endphp
                    <tr class="custom-row-cl @if($i%10 == 0) adds @endif">
                        <td colspan="7">
                            <div class="add text-center">
                                
                                <img src="{{URL::asset('ads_banner/resized')}}/{{$ads[$j]['ads_file']}}"/>
                            </div>
                        </td>
                    </tr>
                    @php $j++; @endphp
                @else
                    @php $custom_ads = 1; $j = 0;@endphp
                    <tr class="custom-row-cl @if($i%10 == 0) adds @endif">
                        <td colspan="7">
                            <div class="add text-center">
                                
                                <img src="{{URL::asset('ads_banner/resized')}}/{{$ads[$j]['ads_file']}}"/>
                            </div>
                        </td>
                    </tr>
                    @php $j++; @endphp
                @endif
            @else
                @php $custom_ads = 0; @endphp
                @if($googleads)
                    @if($googleads->script != "")
                    <tr class="custom-row-cl adds">
                        <td colspan="7">
                            <div class="row align-items-center">
                                {!!$googleads->script!!}
                                <!-- <div class="col-lg-6 text-center">
                                    <img src="{{URL::asset('frontend/assets/img/case.jpg')}}"/>
                                </div>
                                <div class="col-lg-6">
                                    <h1 class="adds-text">The Ultimate cover</h1>
                                </div> -->
                            </div>
                        </td>
                    </tr> 
                    @endif
                @endif
            @endif
        @endif
    @endif
    @php $i++;@endphp
@endforeach