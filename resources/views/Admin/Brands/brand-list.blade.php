@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Brands List')
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
                  <h5 class="heading-small text-muted mb-4">Brands List</h5>
                </div>
                <div class="col-md-6 text-right">
                  <a href="{{url('admin/add-brand')}}" class="btn btn-sm btn-primary"><i class="ni ni-fat-add"></i> &nbsp;Add brand</a>
                </div>
    		  			<div class="col-lg-12">
                  <div class="brand-list">
                    @include('flash-message')
                       <div class="table-responsive">
                         <table class="table align-items-center">
                           <thead class="thead-light">
                             <tr>
                               <th scope="col" style="width: 10px;">Sr.No</th>
                               <th scope="col">Brands name</th>
                               <th scope="col">Status</th>
                               <th scope="col">Default</th>
                               <th scope="col" style="width: 10px;" class="text-right">Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            @if(count($brands) > 0)
                            @php
                               $i = ($brands->currentpage()-1)* $brands->perpage() + 1;
                            @endphp
                              @foreach($brands as $brand)
                               <tr>
                                  <td class="text-center" style="max-width: 10px;">{{$i++}}</td>
                                  <td class="text-left">
                                    <div class="media-body">
                                      <span class="mb-0 text-sm">{{$brand->brand_name}} {{$brand->model_name}}</span>
                                    </div>
                                  </td>
                                  <td>
                                    <span class="badge badge-dot mr-4">
                                       @if($brand->status == 1)
                                        <span class="d-none not_ap_ms"><i class="bg-danger"></i> Not approved</span>
                                       <span class="approved_ms"><i class="bg-success"></i> Approved</span>
                                       @else
                                       <span class="not_ap_ms"><i class="bg-danger"></i> Not approved</span>
                                       <span class="d-none approved_ms"><i class="bg-success"></i> Approved</span>
                                       @endif
                                    </span>
                                  </td>
                                  <td>
                                    <div class="custom-control custom-checkbox mb-3">
                                      <input class="custom-control-input default_check_brand" id="customCheck{{$brand->id}}" data-brand_id="{{$brand->id}}" name="default" type="checkbox" @if($brand->default == 1) checked="" @endif>
                                      <label class="custom-control-label" for="customCheck{{$brand->id}}"></label>
                                    </div>
                                  </td>
                                  <td class="text-right">
                                    <button class="btn btn-icon btn-2 
                                        @if($brand->status == 1) 
                                          btn-danger 
                                        @else 
                                          btn-success 
                                        @endif 
                                        btn-sm approved_brand_btn" data-toggle="tooltip" data-placement="top" title="
                                        @if($brand->status == 1) 
                                          Not approve 
                                        @else 
                                          Approve 
                                        @endif" 
                                        data-status="@if($brand->status == 1) 0 @else 1 @endif"
                                        data-brand_id="{{$brand->id}}">
                                       <span class="btn-inner--icon"><i class="@if($brand->status != 1) ni ni-check-bold @else ni ni-fat-remove @endif"></i></span>
                                    </button>
                                     <a class="btn btn-icon btn-2 btn-info btn-sm" href="{{url('admin/edit-brand')}}/{{base64_encode($brand->id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                       <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                     </a>
                                     <button class="btn btn-icon btn-2 btn-danger btn-sm delete_brand" type="button" data-brand_id="{{base64_encode($brand->id)}}" data-toggle="tooltip" data-placement="top" title="Delete">
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
                       <div class="device_pagination mt-3 mb-0">
                         {{$brands->links()}}
                       </div>
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