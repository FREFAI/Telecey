<style>
	tr.custom-row-cl {
		background-color: #77fdc8;
		color: #333;
		border: 5px solid #fff;
	}
	tr.custom-row-cl:hover {
		background-color: #dcdcdc;
		color: #333;
	}
	tr.custom-row-cl td {
		vertical-align: middle;
	}
	a.form-control.btn.table-row-btn {
		background-color: #77fdc8;
		border: 0;
	}
	a.form-control.btn.table-row-btn:hover {
		background-color: #333;
		color: #fff;
	}
	.noSearchMessage p{
		font-size: 33px;
		font-weight: bold;
	}
</style>

	@if(count($data)>0)
	<div class="container mb-5 mt-5">
		<div class="row">
			<table class="table">
				<thead class="bg-primary text-white">
					<tr>
						<th scope="col">{{__('deviceresult.brand')}} </th>
						<th scope="col">{{__('deviceresult.model')}} </th>
						<th scope="col">{{__('deviceresult.price')}} </th>
						<th scope="col">{{__('deviceresult.capacity')}} </th>
						<th scope="col">{{__('deviceresult.supplier')}} </th>
						@if($filterType == 1)
						<th scope="col">{{__('deviceresult.distance')}} </th>
						@endif
						<th scope="col">{{ __('deviceresult.detail_btn') }}</th>
						
					</tr>
				</thead>
				<tbody>
					@foreach($data as $value)
						<tr class="custom-row-cl">
							<td>{{$value['brand']['brand_name']}}</td>
							<td>{{$value['brand']['model_name']}}</td>
							<td>{{$value['price']}}</td>
							<td>{{$value['storage']}}</td>
							<td>{{$value['supplier']['supplier_name']}}</td>
								@if(isset($value['distance']))
									<td>{{round($value['distance'])}} KM</td>
								@endif
							<td>
							@if(Auth::guard('customer')->check())
								<td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value['id'])}}">{{__('deviceresult.detail_btn')}}</td>
							@else
								<td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">{{__('deviceresult.signup_unlock')}}</td>
							@endif
							</td>
						</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@else
	<div class="container">
		<div class="row pt-5 pb-5 mt-5 mb-5">
			<div class="col text-center">
				<div class="heading noSearchMessage">
					<p>{!!$filtersetting->no_search_message!!}</p>
				</div>
			</div>
		</div>
	</div>
	@endif
