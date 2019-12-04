@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | User Logs list')
@section('content')

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

                    <div class="col-md-3">
                    <h5 class="heading-small text-muted mb-4">Website translation </h5>
                    </div>
                    <div class="col-md-9 text-right">
                        <div class="user-search-form mb-4">
                            <form class="logtypeForm">
                                <div class="3 mr-1">
                                    <input class="form-control" type="text" placeholder="Search by email" name="email" @if(isset($params['email'])) value="{{$params['email']}}" @endif>
                                </div>
                                <div class="3 mr-1">
                                    <input class="form-control datepicker-one" type="text" placeholder="Created" name="start_date"  @if(isset($params['start_date'])) value="{{$params['start_date']}}" @endif>
                                </div>
                                <div class="3 mr-1">
                                    <input class="form-control datepicker-two" type="text" placeholder="Update" name="end_date"  @if(isset($params['end_date'])) value="{{$params['end_date']}}" @endif>
                                </div>
                                <div class="3 mr-1">
                                    <select class="form-control" name="type" id="log_type">
                                        <option @if(isset($params['type']) && $params['type'] == 1) selected="" @endif value="1">Sign Up Logs</option>
                                        <option @if(isset($params['type']) && $params['type'] == 2) selected="" @endif value="2">Email verification</option>
                                        <option @if(isset($params['type']) && $params['type'] == 3) selected="" @endif value="3">Log in</option>
                                        <option @if(isset($params['type']) && $params['type'] == 4) selected="" @endif value="4">Search Device</option>
                                        <option @if(isset($params['type']) && $params['type'] == 5) selected="" @endif value="5">Search Plans</option>
                                        <option @if(isset($params['type']) && $params['type'] == 6) selected="" @endif value="6">Message</option>
                                    </select>
                                </div>
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
                       <th scope="col" style="width: 10px;">Ip</th>
                       <th scope="col" style="width: 10px;">User name</th>
                       <th scope="col" class="text-center">User email</th>
                       <th scope="col" class="text-center">Status</th>
                       <th scope="col" class="text-center">Filter Params.</th>
                       <th scope="col" class="text-center">Devices count</th>
                       <th scope="col" class="text-center">Plans count</th>
                       <th scope="col" class="text-center">Created at</th>
                     </tr>
                   </thead>
                   <tbody>
                     @if(count($userLogs) > 0)
                       @php
                           $i = ($userLogs->currentpage()-1)* $userLogs->perpage() + 1;
                       @endphp
                       @foreach($userLogs as $log)
                       <tr>
                           <td class="text-center" style="max-width: 10px;">
                               {{$i++}}
                           </td>
                           <td class="text-center">
                                {{$log->ip}}
                           </td>
                           <td class="text-center">
                                {{$log->user_name ? $log->user_name : '-'}}
                           </td>
                           <td class="text-center">
                                {{$log->email  ? $log->email : '-'}}
                           </td>
                           <td class="text-center">
                                <span class="badge badge-dot mr-4">
                                @if(is_numeric($log->user_status))
                                    @if($log->user_status == 1)
                                    <span class="approved_ms"><i class="bg-success"></i> Approved</span>
                                    @else
                                    <span class="not_ap_ms"><i class="bg-danger"></i> Not approved</span>
                                    @endif
                                @else
                                  -
                                @endif
                                </span>
                           </td>
                           @if($log->filter_params != "")
                            <td>
                                @php
                                  $params = json_decode($log->filter_params);
                                @endphp
                                @foreach($params as $key => $value)
                                  <p class="m-0 h5 text-muted"><strong class="text-capitalize">{{$key}}</strong> : <em>{{$value}}</em></p>
                                @endforeach
                            </td>
                            @else
                              <td class="text-center">
                              -
                              </td>
                            @endif
                           <td class="text-center">
                                @if($log->filter_type == 2)
                                    {{$log->filter_search_result_count}}
                                @else   
                                -
                                @endif
                           </td>
                           <td class="text-center">
                                @if($log->filter_type == 1)
                                    {{$log->filter_search_result_count}}
                                @else   
                                -
                                @endif
                           </td>
                           <td class="text-center">
                                {{ date("m/d/Y", strtotime($log->created_at)) }}
                           </td>
                           
                       </tr>
                       @endforeach
                     @else
                       <tr>
                         <th colspan="10">
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
                 {{$userLogs->links()}}
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
<script>
    // $('#log_type').on('change',function(){
    //     $('.logtypeForm').submit();
    // });
</script>
@endsection