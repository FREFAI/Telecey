@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Add provider')
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
               <h5 class="heading-small text-muted mb-4">Add Provider</h5>
             </div>
             <div class="col-md-6 text-right">
               <a href="{{ url('/admin/provider-list')}}" class="btn btn-sm btn-primary"><i class="ni ni-bold-left"></i> &nbsp;Back</a>
             </div>
            
		  			<div class="col-lg-12">
            @include('flash-message')
              <form action="{{ url('/admin/addprovider') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Provider name" name="provider_name" value="{{old('provider_name')}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <select class="form-control select2" name="country">
                          @if($countries)
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                              <option @if(old('country') == $country->name) selected="" @endif value="{{$country->name}}">{{$country->name}}</option>
                            @endforeach
                          @else
                            <option value="">Countries not found</option>
                          @endif
                        </select>
                    </div>
                  </div>
                  <div class="col-lg-12 mb-4">
                    <div class="blog_image">
                      <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="hidden" name="provider_image_cropped" class="image-get" value="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="provider_image" />
                            <label for="imageUpload"><i class="fas fa-edit"></i></label>
                        </div>
                        <div class="avatar-preview">
                            <div class="imagePreviewProvider" id="imagePreview" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
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
<div id="addProviderImage" class="modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h2 class="text-center w-100">Crop Image</h2>
            </div>
            <div class="modal-body p-2">
                <div class="row text-center">
                <div id="provider-image-display"></div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                <button id="useimg-provider" type="button" class="btn btn-primary">Use Image</button>
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
        var resize = $('#provider-image-display').croppie({
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
        function readURLProvider(input) {
          var img = new Image();
          reader.onload = function (e) {
            resize.croppie('bind',{
              url: e.target.result
            }).then(function(){
              console.log('jQuery bind complete');
            });
          }
          reader.readAsDataURL(input.files[0]);
        }
        $('#useimg-provider').on('click', function () {
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
          readURLProvider(this);
          $("#addProviderImage").modal('show');
        })
      })
      
  </script>
@endsection