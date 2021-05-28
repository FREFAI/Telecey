@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Providers list')
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
               <h5 class="heading-small text-muted mb-4">Providers List</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{url('admin/addprovider')}}" class="btn btn-sm btn-primary"><i class="ni ni-fat-add"></i> &nbsp;Add providers</a>
             </div>
		  			<div class="col-lg-12">
            @include('flash-message')
               <div class="table-responsive">
                 <table class="table align-items-center">
                   <thead class="thead-light">
                     <tr>
                       <th scope="col" style="width: 10px;">Sr.No</th>
                       <th scope="col" class="text-center" style="width: 30px;"><i class="ni ni-image"></i></th>
                       <th scope="col" style="width: 10px;">Provider name</th>
                       <th scope="col" class="text-center">Country</th>
                       <th scope="col" class="text-center">Status</th>
                       <th scope="col" class="text-right">Action</th>
                     </tr>
                   </thead>
                   <tbody>
                     @if(count($providers) > 0)
                       @php
                           $i = ($providers->currentpage()-1)* $providers->perpage() + 1;
                       @endphp
                       @foreach($providers as $provider)
                       <tr>
                           <td class="text-center" style="max-width: 10px;">
                               {{$i++}}
                           </td>
                           <th scope="row" class="text-center">
                                <div class="media align-items-center">
                                    <a href="#" class="avatar rounded-circle mr-3">
                                      @if($provider->provider_image_original != "")
                                      <img alt="{{$provider->provider_image_original}}" src="{{URL::asset('providers/provider_original')}}/{{$provider->provider_image_original}}" class="h-100">
                                      @else
                                      <img alt="{{$provider->provider_image_original}}" src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}" class="h-100">
                                      @endif
                                    </a>
                                </div>
                            </th>
                            <td class="text-center">
                              <div class="media-body">
                                  <span class="mb-0 text-sm">{{$provider->provider_name}}</span>
                              </div>
                            </td>
                            <td class="text-center">
                              <div class="media-body">
                                  <span class="mb-0 text-sm">{{$provider->country ? $provider->country : 'N/A'}}</span>
                              </div>
                            </td>
                           <td  class="text-center">
                             <span class="badge badge-dot mr-4">
                               @if($provider->status == 1)
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
                                  @if($provider->status == 1) 
                                    btn-danger 
                                  @else 
                                    btn-success 
                                  @endif 
                                  btn-sm approved_btn" data-toggle="tooltip" data-placement="top" title="
                                  @if($provider->status == 1) 
                                    Not approve 
                                  @else 
                                    Approve 
                                  @endif" 
                                  data-status="@if($provider->status == 1) 0 @else 1 @endif"
                                  data-provider_id="{{$provider->id}}">
                                 <span class="btn-inner--icon"><i class="@if($provider->status != 1) ni ni-check-bold @else ni ni-fat-remove @endif"></i></span>
                              </button>
                            
                             <a class="btn btn-icon btn-2 btn-info btn-sm" href="{{url('admin/editprovider')}}/{{base64_encode($provider->id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                               <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                             </a>
                             <button class="btn btn-icon btn-2 btn-danger btn-sm delete_provider" type="button" data-provider_id="{{$provider->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
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
                 {{$providers->links()}}
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