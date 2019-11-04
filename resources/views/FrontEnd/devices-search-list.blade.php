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
						<th scope="col">Brand</th>
						<th scope="col">Model</th>
						<th scope="col">Price</th>
						<th scope="col">Storage</th>
						<th scope="col">Supplier</th>
						@if($filterType == 1)
						<th scope="col">Distance</th>
						@endif
						<th scope="col" colspan="2" style="text-align:center">
							{{-- <form action="{{ url('/devices') }}" method="get" id="sortBy" onchange="sortingFunc()">
								<div class="form-group">
									<select class="form-control" name="filter">
									<option value="1" @if($filterType == 1) selected="" @endif>Distance</option>
									<option value="2" @if($filterType == 2) selected="" @endif>Price</option>
									</select>
								</div>
							</form> --}}
							Details
						</th>
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
								<td><a class="form-control btn table-row-btn" href="{{url('/deviceDetails/'.$value['id'])}}">Details</td>
							@else
								<td><a class="form-control btn table-row-btn" href="{{url('/signup')}}">Sign up to unlock details</td>
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
