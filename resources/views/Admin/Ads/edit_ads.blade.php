@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Ads')
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
		  			<div class="col-lg-12">
		  				<h5 class="heading-small text-muted mb-4">Edit ADS</h5>
		  			</div>
		  			<div class="col-lg-12">
                        @include('flash-message')
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <!-- Custom Ads Section -->
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <form action="{{ url('/admin/editAds') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" value="{{$ads->title}}" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Ads Title" name="title" required="">
                                                </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox mb-3">
                                                    <input class="custom-control-input is_global" id="customCheck1" name="is_global" type="checkbox" @if($ads->is_global) checked="" @endif>
                                                    <label class="custom-control-label" for="customCheck1">Is Global</label>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group country_select_section" @if($ads->is_global) style="display:none;" @endif>
                                                        <select class="form-control select2 country_field" name="country">
                                                            @if($countries)
                                                            <option value="">Select Country</option>
                                                            @foreach($countries as $country)
                                                                <option @if($ads->country == $country->id) selected="" @endif value="{{$country->id}}">{{$country->name}}</option>
                                                            @endforeach
                                                            @else
                                                            <option value="">Countries not found</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="blog_image">
                                                            <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <input type="hidden" name="ads_image_old" value="{{URL::asset('ads_banner/resized')}}/{{$ads->ads_file}}">
                                                                    <input type="hidden" name="ads_image_original_old" value="{{URL::asset('ads_banner/ads_banner_original')}}/{{$ads->ads_file_original}}">
                                                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="ads_file" />
                                                                    <label for="imageUpload"><i class="fas fa-edit"></i></label>
                                                                </div>
                                                                <div class="avatar-preview">
                                                                @if($ads)
                                                                    @if($ads->ads_file != '')
                                                                        <input type="hidden" name="ads_image" class="image-get" value="{{URL::asset('ads_banner/resized')}}/{{$ads->ads_file}}">
                                                                        <div id="imagePreview" style="background-image: url({{URL::asset('ads_banner/resized')}}/{{$ads->ads_file}});">
                                                                        </div>
                                                                    @else
                                                                        <input type="hidden" name="ads_image" class="image-get" value="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}">
                                                                        <div id="imagePreview" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                                                                        </div>
                                                                    @endif
                                                                @else
                                                                <div id="imagePreview" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                                                                    </div>
                                                                @endif
                                                                
                                                                </div>
                                                                <div class="mt-3">
                                                                <small><strong>( Max. Size 10MB ) </strong></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                <div class="form-group">
                                                <input type="hidden" value="{{$ads->id}}" maxlength="50" class="form-control" name="adsId" required="">
                                                    <input type="hidden" name="type" value="0">
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- End Custom Ads Section -->
                                </div>
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

<div id="addImage" class="modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h2 class="text-center w-100">Crop Image</h2>
            </div>
            <div class="modal-body p-2">
                <div class="row text-center">
                <div id="ads-image-display"></div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                <button id="useimg-blog" type="button" class="btn btn-primary">Use Image</button>
            </div>
        </div>

    </div>
</div>
<style type="text/css">
	h6.heading-small{
		text-transform: capitalize;
	}
  .custom-toggle-slider:before{
    background-color: #5e72e4;
  }
  .custom-toggle-slider, .custom-toggle-slider{
    border: 1px solid #5e72e4;
  }
  span.select2.select2-container.select2-container--default {
    width: 100% !important;
  }
</style>
@endsection


@section('pageScript')
  <script>
      $(document).ready(function(){
        var image = $('.image-get').val();
        var reader = new FileReader();
        var resize = $('#ads-image-display').croppie({
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
        $("#addImage").modal('show');
      })
      })
      
  </script>
@endsection