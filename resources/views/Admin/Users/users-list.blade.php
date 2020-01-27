@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Users list')
@section('content')

@php
  if(count($request)>0){
    $request['name'] = isset($request['name']) ? $request['name'] : '';
    $request['email'] = isset($request['email']) ? $request['email']: '';
    $request['status'] =isset( $request['status']) ? $request['status'] : '';
    $request['search_by_properties'] = isset($request['search_by_properties']) ? $request['search_by_properties']: '';
    if(isset($request['created_at']) != ''){
      $request['created_at'] = date('m/d/Y',strtotime($request['created_at']));
    }else{
      $request['created_at'] = "";
    }
    if(isset($request['updated_at']) != ''){
      $request['updated_at'] = date('m/d/Y',strtotime($request['updated_at']));
    }else{
      $request['updated_at'] = "";
    }
  }else{
    $request['name'] = '';
    $request['email'] = '';
    $request['status'] = '';
    $request['created_at'] = '';
    $request['updated_at'] = '';
    $request['search_by_properties'] = '';
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

            <div class="col-md-8">
               <h5 class="heading-small text-muted mb-4">Users List</h5>
            </div>
            <div class="col-md-4 text-right">
            <!-- <a class="heading-small btn btn-primary" href="javascript:void(0);" id="send_email_to_user">Send Email</a> -->
            <a class="heading-small btn btn-primary sendEmailToUser" href="javascript:void(0);" data-toggle="modal" data-target="#sendEmailToUser" >Send Email</a>
            <a class="heading-small btn btn-primary" href="{{url('/admin/exportUsers')}}">Export</a>
             </div>
             <div class="col-md-12 text-right pb-2">
              <div class="user-search-form">
                <form method="get" action="{{url('/admin/users')}}">
                  
                   <input class="form-control" type="text" placeholder="Search by name" name="name" value="{{$request['name']}}">
                   <input class="form-control" type="text" placeholder="Search by email" name="email" value="{{$request['email']}}">
                   <!-- <input class="form-control" type="number" placeholder="No. of plans" name="plans" value="{{$request['email']}}">
                   <input class="form-control" type="number" placeholder="No. of Device" name="devices" value="{{$request['email']}}"> -->
                   <input class="form-control" type="text" placeholder="Carrier,Brand or Model" name="search_by_properties" value="{{$request['search_by_properties']}}">
                   <input class="form-control datepicker-one" type="text" placeholder="Created" name="created_at" value="{{$request['created_at']}}">
                   <input class="form-control datepicker-two" type="text" placeholder="Update" name="updated_at" value="{{$request['updated_at']}}">
                   <select class="form-control" name="status">
                     <option @if($request['status'] == '') selected="" @endif value="">Choose status</option>
                     <option @if($request['status'] == '1') selected="" @endif value="1">Active</option>
                     <option @if($request['status'] == '2') selected="" @endif value="2">Pending Verfication</option>
                     <option @if($request['status'] == '3') selected="" @endif value="3">Pending Product approval</option>
                   </select>
                   <button type="submit" class="btn btn-sm btn-primary">Search</button>
                </form>
              </div>
             </div>
		  			<div class="col-lg-12">
            @include('flash-message')
               <div class="table-responsive">
                 <table class="table align-items-center text-center" id="userTable">
                   <thead class="thead-light">
                     <tr>
                       <th scope="col" style="width: 10px;">
                          <div class="custom-control custom-checkbox">
                            <input value="-1" class="custom-control-input" id="customCheck0" name="default" type="checkbox">
                            <label class="custom-control-label" for="customCheck0"></label>
                          </div>
                       </th>
                       <th scope="col" style="width: 10px;">Sr.No</th>
                       <th scope="col" style="width: 10px;">Name</th>
                       <th scope="col" style="width: 10px;">Nick Name</th>
                       <th scope="col" style="width: 10px;">Email</th>
                       <th scope="col" style="width: 10px;">Phone Number</th>
                       <th scope="col" style="width: 10px;">City</th>
                       <th scope="col" style="width: 10px;">Country</th>
                       <th scope="col" style="width: 10px;">Postal code</th>
                       <th scope="col" class="text-center">Account type</th>
                       <th scope="col" class="text-center">Status</th>
                       <th scope="col" class="text-center">No. of plans</th>
                       <th scope="col" class="text-center">No. of devices</th>
                       <th scope="col" class="text-center">Creation Date</th>
                       <th scope="col" class="text-center">Last Update</th>
                       <th scope="col" class="text-right">Action</th>
                     </tr>
                   </thead>
                   <tbody>
                      @if(count($users)>0)
                        @php
                            $i = ($users->currentpage()-1)* $users->perpage() + 1;
                        @endphp
                       @foreach($users as $user)
                       <tr>
                          <td class="text-center" style="max-width: 10px;">
                            <div class="custom-control custom-checkbox">
                              <input value="{{$user->email}}" class="custom-control-input default_check_user" id="customCheck{{$user->id}}" data-user_id="{{$user->id}}" name="default" type="checkbox">
                              <label class="custom-control-label" for="customCheck{{$user->id}}"></label>
                            </div>
                          </td>
                          <td class="text-center" style="max-width: 10px;">
                            {{$i++}}
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->firstname}} {{$user->lastname}}</span>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->nickname}}</span>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->email}}</span>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->mobile_number}}</span>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->userAdderss != "" ? $user->userAdderss->city : ""}}</span>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->userAdderss != "" ? $user->userAdderss->country : ""}}</span>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->userAdderss != "" ? $user->userAdderss->postal_code : ""}}</span>
                            </div>
                          </td>
                          <td>
                            @if($user->plansCount == 0 && $user->devicesCount == 0)
                              None
                            @elseif($user->plansCount != 0 && $user->devicesCount != 0)
                              Plan & Device
                            @elseif($user->plansCount != 0 && $user->devicesCount == 0)
                              Plan
                            @elseif($user->plansCount == 0 && $user->devicesCount != 0)
                              Device
                            @endif
                          </td>
                          <td>
                            <span class="badge badge-dot mr-4">
                              @if($user->is_active == 0)
                                <span class="not_ap_ms"><i class="bg-danger"></i>Pending verification</span>
                              @else
                                @if($user->unApprovedCount!=0)
                                  <span class="not_ap_ms"><i class="bg-danger"></i>Pending Product approval</span>
                                @else
                                  <span class="approved_ms"><i class="bg-success"></i> Active</span>
                                @endif
                              @endif
                            </span>
                          </td>
                          <td>{{$user->plansCount}}</td>
                          <td>{{$user->devicesCount}}</td>
                          <td>{{ date("m/d/Y", strtotime($user->created_at)) }}</td>
                          <td>{{ date("m/d/Y", strtotime($user->updated_at)) }}</td>
                          <td>
                            <a class="btn btn-icon btn-2 btn-success btn-sm forgot_email" href="javascript:void(0);" data-url="{{url('/admin/forgotEmail')}}/{{base64_encode($user->id)}}" data-toggle="tooltip" data-placement="top" title="Send forgot password email">
                              <span class="btn-inner--icon"><i class="ni ni-email-83"></i></span>
                            </a>
                            <a class="btn btn-icon btn-2 btn-primary btn-sm" href="{{url('/admin/userDetail')}}/{{base64_encode($user->id)}}" data-toggle="tooltip" data-placement="top" title="View">
                              <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                            </a>
                          </td>
                           
                       </tr>
                       @endforeach
                     @else
                       <tr>
                         <th colspan="8">
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
                   {{$users->appends(request()->except('page'))->links()}}
               </div>
            </div>
		    	</div>
		    </div>
    </div>
    <div class="sendEmailModal">
      <div class="row">
        <div class="col-md-6">
          <h5 class="heading-small text-muted mb-4">Send Email</h5>
        </div>
        <div class="col-md-6 text-right">
          <button type="button" class="close sendEmailClose" >
              <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="col-lg-12">
          <form role="form" enctype="multipart/form-data" id="send_email_to_user_form">
            <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Subject" type="subject" id="subject" name="subject">
                </div>
            </div>
            <div class="form-group">
              <textarea name="email_content" class="from-control text_editor textarea" id="text_editor"></textarea>
            </div>
            <div class="form-group">
              <input type="file" class="form-control" id="attached_file" name="attached_file">
            </div>
            <div class="text-center">
                <button id="send_email_to_user" class="btn btn-primary float-right">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  
    <!-- Footer Section Include -->
        @include('layouts.admin_layouts.footer')
    <!-- End Footer Section Include -->
  </div>
</div>
<style type="text/css">
	h6.heading-small{
		text-transform: capitalize;
	}
  .custom-toggle-slider:before{
    background-color: #5e72e4;
  }
  .custom-toggle-slider, .custom-toggle-slider{
    border: 1px solid #5e72e4;
  }
  .gj-datepicker.gj-datepicker-md.gj-unselectable{
    width: 100%;
    margin-right: 9px;
  }
  .sendEmailModal {
    display:none;
    position: absolute;
    top: -60px;
    background: #fff;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0px 0px 27px 0px #0000007a;
    z-index: 123;
  }
  .sendEmailModalOverLay {
    display:none;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    text-align: center;
    font-size: 0;
    overflow-y: auto;
    background-color: rgba(0,0,0,.4);
    z-index: 1;
    pointer-events: none;
    opacity: 1;
    transition: opacity .3s;
  }
  .custom-control-label {
    margin-bottom: 15px;
  }
  table.dataTable thead .sorting:before, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_desc_disabled:before {
    top: 17px;
  }
  table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after{
    top: 17px;
  }
</style>
@endsection