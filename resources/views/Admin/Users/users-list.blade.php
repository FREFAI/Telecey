@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Users list')
<style type="text/css">
  .gj-datepicker.gj-datepicker-md.gj-unselectable{
    width: 100%;
    margin-right: 9px;
  }
</style>
@section('content')

@php
  if(isset($request)){
    $request['name'] = $request['name'];
    $request['email'] = $request['email'];
    $request['status'] = $request['status'];
    if($request['created_at'] != ''){
      $request['created_at'] = date('m/d/Y',strtotime($request['created_at']));
    }else{
      $request['created_at'] = "";
    }
    if($request['updated_at'] != ''){
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
               <h5 class="heading-small text-muted mb-4">Users List</h5>
             </div>
             <div class="col-md-12 text-right pb-2">
              <div class="user-search-form">
                <form method="post" action="{{url('/admin/users')}}">
                  @csrf
                   <input class="form-control" type="text" placeholder="Search by name" name="name" value="{{$request['name']}}">
                   <input class="form-control" type="text" placeholder="Search by email" name="email" value="{{$request['email']}}">
                   <!-- <input class="form-control" type="number" placeholder="No. of plans" name="plans" value="{{$request['email']}}">
                   <input class="form-control" type="number" placeholder="No. of Device" name="devices" value="{{$request['email']}}"> -->
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
                 <table class="table align-items-center text-center">
                   <thead class="thead-light">
                     <tr>
                       <th scope="col" style="width: 10px;">Sr.No</th>
                       <th scope="col" style="width: 10px;">Name</th>
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
                     @if(count($users) > 0)
                       @php
                           $i = ($users->currentpage()-1)* $users->perpage() + 1;
                       @endphp
                       @foreach($users as $user)
                       <tr>
                          <td class="text-center" style="max-width: 10px;">
                               {{$i++}}
                          </td>
                          <td class="text-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{$user->firstname}} {{$user->lastname}}</span>
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
                 {{$users->links()}}
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