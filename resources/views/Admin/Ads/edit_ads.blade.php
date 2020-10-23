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
                                                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="ads_file" />
                                                                    <label for="imageUpload"><i class="fas fa-edit"></i></label>
                                                                </div>
                                                                <div class="avatar-preview">
                                                                @if($ads)
                                                                    @if($ads->ads_file != '')
                                                                        <div id="imagePreview" style="background-image: url({{URL::asset('ads_banner/resized')}}/{{$ads->ads_file}});">
                                                                        </div>
                                                                    @else
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