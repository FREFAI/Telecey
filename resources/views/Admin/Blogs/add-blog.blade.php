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
               <h5 class="heading-small text-muted mb-4">Add blog</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
		  			<div class="col-lg-12">
            @include('flash-message')
               <form action="{{ url('/admin/addblog') }}" method="post" enctype="multipart/form-data">
                 @csrf
                 <div class="row">
                   <div class="col-md-12">
                     <div class="form-group">
                       <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Enter title here..." name="title" required="" value="{{old('title')}}">
                     </div>
                     <div class="form-group">
                       <select class="form-control" required="" name="category_id" >
                         <option value="" disabled selected >Select category</option>
                          @if($categories)
                            @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                          @else
                           <option value="" disabled>Not found</option>
                          @endif
                       </select>
                     </div>
                     <div class="form-group">
                        <textarea class="from-control text_editor" id="first-test" name="blog_content"> {{old('blog_content')}}</textarea>
                      </div>
                   </div>
                   <div class="col-lg-12 mb-4">
                    <div class="blog_image">
                      <div class="avatar-upload">
                          <div class="avatar-edit">
                              <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="blog_picture" data-size="{{$setting ? number_format($setting->blog_image_limit) : 10}}"/>
                              <label for="imageUpload"><i class="fas fa-edit"></i></label>
                          </div>
                          <div class="avatar-preview">
                              <div class="mb-2" id="imagePreview" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                              </div>
                              <small><strong>Max. size {{$setting ? number_format($setting->blog_image_limit) : 10}}MB</strong></small>
                          </div>
                      </div>
                    </div>
                   </div>
                   <div class="col-lg-12 mt-4">
                      <div class="form-group">
                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link" name="image_link" value="{{old('image_link')}}">
                      </div>
                    </div>
                   <div class="col-md-12 mt-3">
                     <div class="form-group">
                       <button class="btn btn-primary" type="submit">Save</button>
                     </div>
                   </div>
                 </div>
               </form>
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