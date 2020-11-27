@php
    $i = ($data->currentpage-1)* $data->perpage + 1;
    $custom_ads = 0;
    $j = 0; 
@endphp
@foreach($data as $key => $value)
    <tr class="custom-row-cl">
        <td>{{$value->brand ? $value->brand->brand_name : ""}}</td>
        <td>{{$value->brand ? $value->brand->model_name : ""}}</td>
        <td>{{$value->supplier ? $value->supplier->supplier_name : ""}}</td>
        <td>{{$value->price}}</td>
        <td>{{$value->storage}}</td>
        <td>{{round($value->distance)}} KM</td>
        @if(Auth::guard('customer')->check())
            <td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value->id)}}">{{ __('deviceresult.detail_btn') }}</td>
        @else
            <td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">{{__('deviceresult.signup_unlock')}}</td>
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