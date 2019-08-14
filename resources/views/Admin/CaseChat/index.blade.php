@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Cases list')
<style type="text/css">
  .gj-datepicker.gj-datepicker-md.gj-unselectable{
    width: 100%;
    margin-right: 9px;
  }
</style>
@section('content')

@php
  if(count($request)>0){
    if($request['search_status'] == ''){
      $request['search_status'] = '3';
    }else{
      $request['search_status'] = $request['search_status'];
    }
    $request['search_by_subject'] = $request['search_by_subject'];
    $request['search_by_name'] = $request['search_by_name'];
    $request['search_by_email'] = $request['search_by_email'];
    if($request['start_date'] != ''){
      $request['start_date'] = date('m/d/Y',strtotime($request['start_date']));
    }else{
      $request['start_date'] = "";
    }
    if($request['end_date'] != ''){
      $request['end_date'] = date('m/d/Y',strtotime($request['end_date']));
    }else{
      $request['end_date'] = "";
    }
  }else{
    $request['search_status'] = '3';
    $request['search_by_subject'] = '';
    $request['search_by_name'] = '';
    $request['search_by_email'] = '';
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
		    	<div class="row">

            <div class="col-md-12">
               <h5 class="heading-small text-muted mb-4">Cases List</h5>
            </div>
            <div class="col-md-12 pb-2">
              <div class="user-search-form text-right">
                <form method="get" action="{{url('/admin/messages')}}">
                   <input class="form-control" type="text" placeholder="Search by subject" name="search_by_subject" value="{{$request['search_by_subject']}}">
                   <input class="form-control" type="text" placeholder="Search by name" name="search_by_name" value="{{$request['search_by_name']}}">
                   <input class="form-control" type="text" placeholder="Search by email" name="search_by_email" value="{{$request['search_by_email']}}">
                   <input class="form-control datepicker-one" type="text" placeholder="Start date" name="start_date" value="{{$request['start_date']}}">
                   <input class="form-control datepicker-two" type="text" placeholder="End date" name="end_date"  value="{{$request['end_date']}}">
                   <select class="form-control" name="search_status">
                     <option @if($request['search_status'] == 3) selected="" @endif  value="">Choose status</option>
                     <option @if($request['search_status'] == 0) selected="" @endif value="0">Open</option>
                     <option @if($request['search_status'] == 1) selected="" @endif value="1">Answered</option>
                     <option @if($request['search_status'] == 2) selected="" @endif value="2">Closed</option>
                   </select>
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
                       <th scope="col" style="width: 10px;">Sr.No</th>
                       <th scope="col">User Name</th>
                       <th scope="col">Subject</th>
                       <th scope="col" style="width: 10px;">Status</th>
                       <th scope="col" style="width: 10px;">Date</th>
                       <th scope="col" class="text-right">Action</th>
                     </tr>
                   </thead>
                   <tbody>
                    @if(count($allCase)>0)
                      @php
                          $i = ($allCase->currentpage()-1)* $allCase->perpage() + 1;
                      @endphp
                      @foreach($allCase as $case)
                          <tr>
                             <td class="text-center" style="max-width: 10px;">
                              {{$i++}}
                             </td>
                             <td class="text-left">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">@if($case->user) {{$case->user->firstname}} @endif</span>
                                </div>
                              </td>
                              <td class="text-left">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">{{$case->subject}}</span>
                                </div>
                              </td>
                             <td class="status-td">
                              @if($case->status == 0)
                                Open
                              @elseif($case->status == 1)
                                Answered
                              @else
                                Closed
                              @endif
                             </td>
                             <td>{{ date('m/d/Y', strtotime($case->created_at)) }}</td>
                             <td class="text-right">
                              <button class="btn btn-icon btn-2 btn-danger
                                  btn-sm @if($case->status != 2) close_case_btn @endif" data-toggle="tooltip" data-placement="top" title="
                                  @if($case->status != 2) 
                                    Close
                                  @else 
                                    Closed 
                                  @endif" 
                                  data-status="2"
                                  data-case_id="{{base64_encode($case->id)}}">
                                 <span class="btn-inner--icon"><i class="ni ni-fat-remove"></i></span>
                              </button>
                               <a class="btn btn-icon btn-2 btn-info btn-sm" href="{{url('admin/inbox')}}/{{base64_encode($case->id)}}" data-toggle="tooltip" data-placement="top" title="Chat">
                                 <span class="btn-inner--icon"><i class="fas fa-comment"></i></span>
                               </a>
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
                {{$allCase->links()}}
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