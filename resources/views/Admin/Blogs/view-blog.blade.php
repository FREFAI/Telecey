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
               <h5 class="heading-small text-muted mb-4">Single blog</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
		  			<div class="col-lg-12">
              <div class="post_image_single text-center">
                @if($blog->blog_picture_original != "")
                  <img src="{{URL::asset('blogs/blog_original')}}/{{$blog->blog_picture_original}}">
                @else
                  <img src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}">
                @endif
              </div>
            </div>
            <div class="col-lg-12 mt-3">
              <div class="post_title_single text-center">
                <h1 class="m-0">{{$blog->title}}</h1>
                <small>{{date("M d, Y", strtotime($blog->created_at))}}</small>
              </div>
            </div>
            <div class="col-lg-12 mt-3">
              <div class="post_title_single text-center">
                {!!$blog->blog_content!!}
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