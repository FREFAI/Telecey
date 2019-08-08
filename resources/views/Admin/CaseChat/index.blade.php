@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Cases list')
@section('content')

@php
  if(isset($request)){
    $request['search_by'] = $request['search_by'];
    $request['search'] = $request['search'];
  }else{
    $request['search_by'] = '';
    $request['search'] = '';
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

            <div class="col-md-2">
               <h5 class="heading-small text-muted mb-4">Cases List</h5>
            </div>
            <div class="col-md-10">
              <div class="user-search-form text-right">
                <form method="post" action="{{url('/admin/messages')}}">
                  @csrf
                  <select class="form-control" name="search_by">
                    <option @if($request['search_by'] == 0) selected="" @endif value="0">Search By Subject</option>
                    <option @if($request['search_by'] == 1) selected="" @endif value="1">Search By Name</option>
                    <option @if($request['search_by'] == 2) selected="" @endif value="2">Search By Email</option>
                  </select>
                   <input class="form-control" type="text" placeholder="Search" name="search" required="" value="{{$request['search']}}">
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
                             <td>{{ date('d/m/Y', strtotime($case->created_at)) }}</td>
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