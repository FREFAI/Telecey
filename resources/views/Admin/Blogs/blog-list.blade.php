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
               <h5 class="heading-small text-muted mb-4">Blogs List</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{url('admin/addblog')}}" class="btn btn-sm btn-primary"><i class="ni ni-fat-add"></i> &nbsp;Add blog</a>
             </div>
		  			<div class="col-lg-12">
            @include('flash-message')
               <div class="table-responsive">
                 <table class="table align-items-center">
                   <thead class="thead-light">
                     <tr>
                       <th scope="col" style="width: 10px;">Sr.No</th>
                       <th scope="col" class="text-center" style="width: 30px;"><i class="ni ni-image"></i></th>
                       <th scope="col" class="text-center">Title</th>
                       <th scope="col" class="text-right">Action</th>
                     </tr>
                   </thead>
                   <tbody>
                    @if(count($blogs) > 0)
                       @php
                           $i = ($blogs->currentpage()-1)* $blogs->perpage() + 1;
                       @endphp
                         @foreach($blogs as $blog)
                           <tr>
                               <td class="text-center" style="max-width: 10px;">
                                {{$i++}}
                               </td>
                               <th scope="row" class="text-center">
                                    <div class="media align-items-center">
                                        <a href="#" class="avatar rounded-circle mr-3">
                                          <img alt="{{$blog->blog_picture}}" src="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}" class="h-100">
                                        </a>
                                    </div>
                                </th>
                                <td class="text-center">
                                  <div class="media-body">
                                      <span class="mb-0 text-sm">{{$blog->title}}</span>
                                  </div>
                                </td>
                               <td class="text-right">
                                 <a class="btn btn-icon btn-2 btn-info btn-sm" href="{{url('/admin/editblog')}}/{{base64_encode($blog->id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                   <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                 </a>
                                 <button class="btn btn-icon btn-2 btn-danger btn-sm delete_blog" type="button" data-blog_id="{{$blog->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
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
                 {{$blogs->links()}}
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