@php
    $i = ($data->currentpage()-1)* $data->perpage() + 1;
    $custom_ads = 0;
    $j = 0; 
@endphp
@foreach($data as $key => $value)
    <tr class="custom-row-cl">
        <td>
            @if($value['provider']['provider_image_original'] != "")
                <img src="{{URL::asset('providers/provider_original')}}/{{$value['provider']['provider_image_original']}}" style="width:100px;height:50px;" />
            @else
                <img src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" style="width:100px;height:50px;"/>
            @endif
        </td>
        <td>
        @if(!Auth::guard('customer')->check())
            @if($filtersetting->disable_price_for_logged_out_users == 1)
                {{$value['price']}}
            @else
                <a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</a>
            @endif
        @else
        {{$value['price']}}
        @endif
        </td>
        <td>{{$value['local_min']}}</td>
        <td>{{$value['datavolume']}}</td>
        <td data-order="{{$value['average_review']}}"><div class="rating_disable" data-rate-value="{{$value['average_review']}}"></div></td>
        @if(isset($value['distance']))
            <td>{{round($value['distance'])}} KM</td>
        @else
            <td>N/A</td>
        @endif
        @if(Auth::guard('customer')->check())
            <td data-order="-1"><a class="form-control btn table-row-btn" href="{{url('/planDetails/'.$value['id'])}}">Details</a></td>
        @else
            @if($filtersetting->disable_details_for_logged_out_users == 1)
                <td data-order="-1"><a class="form-control btn table-row-btn" href="{{url('/planDetails/'.$value['id'])}}">Details</a></td>
            @else
                <td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</a></td>
            @endif
        @endif
    </tr>
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
            <tr class="custom-row-cl adds">
                <td colspan="7">
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-center">
                            <img src="{{URL::asset('frontend/assets/img/case.jpg')}}"/>
                        </div>
                        <div class="col-lg-6">
                            <h1 class="adds-text">The Ultimate cover</h1>
                        </div>
                    </div>
                </td>
            </tr> 
        @endif
    @endif
    @php $i++;@endphp
@endforeach