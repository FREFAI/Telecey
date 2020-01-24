@foreach($data as $key => $value)
    <tr class="custom-row-cl @if($key == 4 || $key == 8) adds @endif">
        @if($key == 4)
            <td colspan="7">
                <div class="add text-center">
                    <img src="{{URL::asset('frontend/assets/img/Iphone_ads.webp')}}"/>
                </div>
            </td>
        @elseif($key == 8)
            <td colspan="7">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center">
                        <img src="{{URL::asset('frontend/assets/img/case.webp')}}"/>
                    </div>
                    <div class="col-lg-6">
                        <h1 class="adds-text">The Ultimate cover</h1>
                    </div>
                </div>
            </td>
        @else
            <td>{{$value['brand']['brand_name']}}</td>
            <td>{{$value['brand']['model_name']}}</td>
            <td>{{$value['supplier']['supplier_name']}}</td>
            <td>{{$value['price']}}</td>
            <td>{{$value['storage']}}</td>
            <td>{{round($value['distance'])}} KM</td>
            @if(Auth::guard('customer')->check())
                <td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value['id'])}}">Details</td>
            @else
                <td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</td>
            @endif
        @endif
    </tr>
@endforeach