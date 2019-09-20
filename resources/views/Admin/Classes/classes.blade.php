@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Blogs list')
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
               <h5 class="heading-small text-muted mb-4">Classes</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{url('admin/addClass')}}" class="btn btn-sm btn-primary"><i class="ni ni-fat-add"></i> &nbsp;Add Class</a>
             </div>
		  			<div class="col-lg-12">
            @include('flash-message')
               <div class="table-responsive">
                 <table class="table align-items-center">
                   <thead class="thead-light">
                     <tr>
                       <th scope="col" style="width: 10px;">Sr.No</th>
                       <th scope="col" class="text-center">Name</th>
                       <th scope="col" class="text-center">Local Minutes / Data Volume</th>
                       <th scope="col" class="text-center">Type</th>
                       <th scope="col" class="text-center">Date</th>
                       <th scope="col" class="text-right">Actions</th>
                     </tr>
                   </thead>
                   <tbody>
                    @if(count($classes) > 0)
                       @php
                           $i = ($classes->currentpage()-1)* $classes->perpage() + 1;
                       @endphp
                         @foreach($classes as $class)
                           <tr>
                               <td class="text-center" style="max-width: 10px;">
                                {{$i++}}
                               </td>
                                <td class="text-center">
                                  <div class="media-body">
                                      <span class="mb-0 text-sm">{{$class->class_name}}</span>
                                  </div>
                                </td>
                                @if($class->type == 1)
                                    <td class="text-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{$class->local_min}}</span>
                                        </div>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">{{$class->data_volume}}</span>
                                        </div>
                                    </td>
                                 @endif
                                 @if($class->type == 1)
                                     <td class="text-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">Voice</span>
                                        </div>
                                      </td>
                                  @else
                                      <td class="text-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">Data</span>
                                        </div>
                                      </td>
                                   @endif          
                                <td class="text-center">
                                  <div class="media-body">
                                      <span class="mb-0 text-sm">{{date("M d, Y", strtotime($class->created_at))}}</span>
                                  </div>
                                </td>
                               <td class="text-right">
                                 {{-- <a class="btn btn-icon btn-2 btn-primary btn-sm" href="{{url('/admin/single-blog')}}/{{base64_encode($class->id)}}" data-toggle="tooltip" data-placement="top" title="View">
                                   <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                 </a> --}}
                                <a class="btn btn-icon btn-2 btn-info btn-sm" href="{{url('/admin/editClass')}}/{{$class->id}}/{{$classes->currentPage()}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                   <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                 </a>
                                 <button class="btn btn-icon btn-2 btn-danger btn-sm delete_class" type="button" data-class_id="{{$class->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
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
               <div class="blog_pagination">
                 {{$classes->links()}}
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