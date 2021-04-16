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
             @if($blog)
    		  			<div class="col-lg-12">
                  @include('flash-message')
                   <form action="{{ url('/admin/editblog') }}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                       <div class="col-md-12">
                         <div class="form-group">
                           <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Enter title here..." name="title" value="{{$blog->title}}">
                         </div>
                         <div class="form-group">
                            <select class="form-control" required="" name="category_id">
                              <option value="" disabled selected >Select category</option>
                                @if($categories)
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $blog->category_id) selected @endif>{{$category->category_name}}</option>
                                  @endforeach
                                @else
                                <option value="" disabled>Not found</option>
                                @endif
                            </select>
                          </div>
                         <div class="form-group">
                            <textarea class="from-control text_editor" id="first-test" name="blog_content">{{$blog->blog_content}}</textarea>
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
                                      <input type="hidden" name="blog_image_old" value="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}">
                                      <input type="hidden" name="blog_image_original_old" value="{{URL::asset('blogs/blog_original')}}/{{$blog->blog_picture_original}}">
                                    @if($blog->blog_picture != "")
                                      <input type="hidden" name="blog_image" class="image-get" value="{{URL::asset('blogs/resized')}}/{{$blog->blog_picture}}">
                                      <div class="mb-2 imagePreviewBlog" id="imagePreview" style="background-image: url({{URL::asset('blogs/resized')}}/{{$blog->blog_picture}});">
                                      </div>
                                    @else
                                      <input type="hidden" name="blog_image" class="image-get" value="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}">
                                      <div class="mb-2 imagePreviewBlog" id="imagePreview" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                                      </div>
                                    @endif
                                    <small><strong>Max. size {{$setting ? number_format($setting->blog_image_limit) : 10}}MB</strong></small>
                                  </div>
                              </div>
                        </div>
                       </div>
                      <div class="col-lg-12 mt-4">
                        <div class="form-group">
                          <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link" name="image_link"  value="{{$blog->image_link}}">
                        </div>
                      </div>
                       <div class="col-md-12 mt-3">
                         <div class="form-group">
                          <input type="hidden" name="id" value="{{base64_encode($blog->id)}}">
                           <button class="btn btn-primary" type="submit">Save</button>
                         </div>
                       </div>
                     </div>
                   </form>
                </div>
            @endif
		    	</div>
		    </div>
		</div>
    <!-- Footer Section Include -->
        @include('layouts.admin_layouts.footer')
    <!-- End Footer Section Include -->
  </div>
</div>
<div id="addBlogImage" class="modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h2 class="text-center w-100">Crop Image</h2>
            </div>
            <div class="modal-body p-2">
                <div class="row text-center">
                <div id="blog-image-display"></div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                <button id="useimg-blog" type="button" class="btn btn-primary">Use Image</button>
            </div>
        </div>

    </div>
</div>
@endsection

@section('pageScript')
  <script>
      $(document).ready(function(){
        var image = $('.image-get').val();
        var reader = new FileReader();
        var resize = $('#blog-image-display').croppie({
          url:image,
          enableExif: true,
          enableOrientation: true,    
          viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: 400,
            height: 280,
            type: 'square' //square
          },
          boundary: {
            width: 420,
            height: 300
          }
        });
        function readURLBlog(input,size) {
          if(size){
            size = size;
            var maxSize = size*1024;
          }else{
            size = 10;
            var maxSize = 10240;
          }
          var file = input.files[0];//get file 
          var img = new Image();
          var sizeKB = file.size / 1024;
          if(sizeKB > maxSize){
            toastr.error('Image size', 'Image size should be less then '+size+'Mb.' , {displayDuration:100000,position: 'top-right'});
            return false;
          }
          reader.onload = function (e) {
            resize.croppie('bind',{
              url: e.target.result
            }).then(function(){
              console.log('jQuery bind complete');
            });
          }
          reader.readAsDataURL(input.files[0]);
        }
        $('#useimg-blog').on('click', function () {
          var imageSize = {
              width: 1000,
              height: 550,
              type: 'square'
          };
          resize.croppie('result', {
            type: 'canvas',
            size: imageSize,
            format: "png", 
            quality: 1
          }).then(function (img) {
            $('#imagePreview').css('background-image', 'url('+img+')');
            $('.image-get').val(img);
            $('.modal-close').click();
          });
        });
        $('#imageUpload').on('change', function(){
          readURLBlog(this,$(this).attr('data-size'));
          $("#addBlogImage").modal('show');
        })
      })
      
  </script>
@endsection