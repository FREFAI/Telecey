@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Admins list')
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
		    	<div class="row">

            <div class="col-md-6">
               <h5 class="heading-small text-muted mb-4">Admins List</h5>
             </div>
             <div class="col-md-6 text-right">
              <a href="{{url('admin/add-admin')}}" class="btn btn-sm btn-primary">
                <i class="ni ni-fat-add"></i> &nbsp;Add admin
              </a>
             </div>
		  			<div class="col-lg-12">
            @include('flash-message')
               <div class="table-responsive">
                 <table class="table align-items-center text-left">
                   <thead class="thead-light">
                     <tr>
                       <th scope="col" style="width: 10px;">Sr.No</th>
                       <th scope="col" style="width: 10px;">Name</th>
                       <th scope="col" style="width: 10px;">Email</th>
                       <th scope="col" style="width: 10px;">Date of birth</th>
                       <th scope="col" class="text-center">Status</th>
                       <th scope="col" class="text-right">Action</th>
                     </tr>
                   </thead>
                   <tbody>
                     @if(count($admins) > 0)
                       @php
                           $i = ($admins->currentpage()-1)* $admins->perpage() + 1;
                       @endphp
                       @foreach($admins as $admin)
                       <tr>
                           <td class="text-center" style="max-width: 10px;">
                               {{$i++}}
                           </td>
                            <td class="text-center">
                              <div class="media-body">
                                  <span class="mb-0 text-sm">{{$admin->firstname}} {{$admin->lastname}}</span>
                              </div>
                            </td>
                            <td>
                              <div class="media-body">
                                  <span class="mb-0 text-sm">{{$admin->email}}</span>
                              </div>
                            </td>
                            <td>
                              <div class="media-body">
                                  <span class="mb-0 text-sm">{{date("M d, Y", strtotime($admin->date_of_birth))}}</span>
                              </div>
                            </td>
                           <td class="text-center">
                             <span class="badge badge-dot mr-4">
                               @if($admin->is_active == 1)
                                <span class="d-none not_ap_ms"><i class="bg-danger"></i> Not approved</span>
                               <span class="approved_ms"><i class="bg-success"></i> Approved</span>
                               @else
                               <span class="not_ap_ms"><i class="bg-danger"></i> Not approved</span>
                               <span class="d-none approved_ms"><i class="bg-success"></i> Approved</span>
                               @endif
                             </span>
                           </td>
                           <td class="text-right">
                              <button class="btn btn-icon btn-2 
                                  @if($admin->is_active == 1) 
                                    btn-danger 
                                  @else 
                                    btn-success 
                                  @endif 
                                  btn-sm approved_admin_btn" data-toggle="tooltip" data-placement="top" title="
                                  @if($admin->is_active == 1) 
                                    Not approve 
                                  @else 
                                    Approve 
                                  @endif" 
                                  data-status="@if($admin->is_active == 1) 0 @else 1 @endif"
                                  data-admin_id="{{base64_encode($admin->id)}}">
                                 <span class="btn-inner--icon"><i class="@if($admin->is_active != 1) ni ni-check-bold @else ni ni-fat-remove @endif"></i></span>
                              </button>
                            
                             <a class="btn btn-icon btn-2 btn-info btn-sm" href="{{url('admin/edit-admin')}}/{{base64_encode($admin->id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                               <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                             </a>
                             <button class="btn btn-icon btn-2 btn-danger btn-sm delete_admin" type="button" data-admin_id="{{base64_encode($admin->id)}}" data-toggle="tooltip" data-placement="top" title="Delete">
                               <span class="btn-inner--icon"><i class="fas fa-trash"></i></span>
                             </button>
                           </td>
                       </tr>
                       @endforeach
                     @else
                       <tr>
                         <th colspan="5">
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
                  {{$admins->appends(request()->except('page'))->links()}}
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