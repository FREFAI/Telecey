@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Users list')
@section('content')

@php
  if(isset($request)){
    $request['name'] = $request['name'];
    $request['email'] = $request['email'];
  }else{
    $request['name'] = '';
    $request['email'] = '';
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
               <h5 class="heading-small text-muted mb-4">Users List</h5>
             </div>
             <div class="col-md-10 text-right">
              <div class="user-search-form">
                <form method="post">
                  @csrf
                   <input class="form-control" type="text" placeholder="Search by name" name="name" value="{{$request['name']}}">
                   <input class="form-control" type="email" placeholder="Search by email" name="email" value="{{$request['email']}}">
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
                                <span class="not_ap_ms"><i class="bg-danger"></i>In-active</span>
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
                          <td>{{ date("d/m/Y", strtotime($user->created_at)) }}</td>
                          <td>{{ date("d/m/Y", strtotime($user->updated_at)) }}</td>
                          <td>
                            <button class="btn btn-icon btn-2 
                                @if($user->active == 1) 
                                  btn-danger 
                                @else 
                                  btn-success 
                                @endif 
                                btn-sm approved_user_btn" data-toggle="tooltip" data-placement="top" title="
                                @if($user->active == 1) 
                                  Not approve 
                                @else 
                                  Approve 
                                @endif" 
                                data-status="@if($user->active == 1) 0 @else 1 @endif"
                                data-provider_id="{{$user->id}}">
                               <span class="btn-inner--icon"><i class="@if($user->active != 1) ni ni-check-bold @else ni ni-fat-remove @endif"></i></span>
                            </button>
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