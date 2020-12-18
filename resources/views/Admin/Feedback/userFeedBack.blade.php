@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Feedback list')
@section('pageStyle')
<style>
  tr.hide-table-padding td {
    padding: 0;
  }
  .expand-button {
    position: relative;
  }
  .accordion-toggle .expand-button:after
  {
    position: absolute;
    transform: translate(0, -50%);
    content: '-';
    background: #5e72e4;
    border-radius: 50%;
    height: 20px;
    width: 20px;
    color: #fff;
    text-align: center;
    font-weight: bold;
    box-shadow: 0px 0px 6px #8999ab;
  }
  .accordion-toggle.collapsed .expand-button:after
  {
    content: '+';
    background: #5e72e4;
    border-radius: 50%;
    box-shadow: 0px 0px 6px #8999ab;
    height: 20px;
    width: 20px;
    color: #fff;
    text-align: center;
    font-weight: bold;
  }
</style>
@endsection
@section('content')
@php
  if(count($request)>0){
    if(isset($request['start_date']) != ''){
      $request['start_date'] = date('m/d/Y',strtotime($request['start_date']));
    }else{
      $request['start_date'] = "";
    }
    if(isset($request['end_date']) != ''){
      $request['end_date'] = date('m/d/Y',strtotime($request['end_date']));
    }else{
      $request['end_date'] = "";
    }
  }else{
    $request['start_date'] = '';
    $request['end_date'] = '';
  } 
@endphp
<!-- Main content -->
<div class="main-content">
  @include('layouts.admin_layouts.top_navbar')
 <!-- Header -->
  <div class="header bg-gradient-primary pb-1 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--5">
    <div class="row">
    	<div class="col-xl-12 mb-5 mb-xl-0">
	        <div class="card shadow">
	          <div class="card-header bg-transparent">
		    	<div class="row align-items-center">
                    <div class="col-md-6">
                    <h5 class="heading-small text-muted mb-4">Feedback List</h5>
                    </div>
                    <div class="col-md-6 text-right  mb-4"> 
                        <a href="{{url('/admin/feedback/exportFeedBack')}}" class="btn  btn-primary btn-sm">Export</a>
                    </div>
                    <div class="col-12">
                        <div class="user-search-form text-right mb-3">
                            <form method="get" action="{{url('/admin/feedback/list')}}">
                                <input autocomplete="off" class="form-control datepicker-one" type="text" placeholder="Start Date" name="start_date" value="{{$request['start_date']}}">
                                <input autocomplete="off" class="form-control datepicker-two" type="text" placeholder="End Date" name="end_date" value="{{$request['end_date']}}">
                                <button type="submit" class="btn btn-sm btn-primary">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        @include('flash-message')
                    <div class="table-responsive">
                        <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                            <th scope="col" style="width: 10px;"></th>
                            <th scope="col" style="width: 10px;">Sr.No</th>
                            <th scope="col">Email</th>
                            <th scope="col" >Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($feedbacks)>0)
                                @php
                                    $i = ($feedbacks->currentpage()-1)* $feedbacks->perpage() + 1;
                                @endphp
                                @foreach($feedbacks as $feedback)
                                    <tr class="accordion-toggle collapsed" id="accordion{{$feedback->id}}" data-toggle="collapse" data-parent="#accordion{{$feedback->id}}" href="#collapse{{$feedback->id}}">
                                      <td class="expand-button"></td>    
                                      <td class="text-center" style="max-width: 10px;">
                                          {{$i++}}
                                        </td>
                                        <td class="text-left">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{$feedback->user ? $feedback->user->email  : '-'}}</span>
                                            </div>
                                        </td>
                                        <td>
                                        {{ date("m/d/Y", strtotime($feedback->created_at)) }} 
                                        </td>
                                    </tr>
                                    <tr class="hide-table-padding">
                                      <td></td>
                                      <td colspan="3">
                                          <div id="collapse{{$feedback->id}}" class="collapse in p-3">
                                            @foreach(json_decode($feedback->feedback_rating) as $ratting)  
                                            <div class="row mb-2">
                                                <div class="col-6">{{$ratting->question_name}}</div>
                                                <div class="col-6 text-right">
                                                  @if($ratting->type == 1)
                                                    <div class="rating_disable float-right" data-rate-value="{{$ratting->value}}"></div>
                                                  @else
                                                  {{$ratting->value}}
                                                  @endif
                                                </div>
                                            </div>
                                            @endforeach
                                          </div>
                                      </td>
                                  </tr>
                                @endforeach
                            @else
                            <tr>
                                <th colspan="6">
                                <div class="media-body text-center">
                                    <span class="mb-0 text-sm">No data found.</span>
                                </div>
                                </th>
                            </tr>
                            @endif
                        </tbody>
                        </table>
                    </div>
                    <div class="ads_pagination mt-3 mb-0">
                        {{$feedbacks->appends(request()->except('page'))->links()}}
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