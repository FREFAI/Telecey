@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Settings')
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
    	<div class="col-xl-12 mb-5 mb-xl-0 ">
	        <div class="card shadow">
	          <div class="card-header bg-transparent">
					@include('flash-message')
		    	<div class="row">
		  			<div class="col-lg-12">
		  				<h5 class="heading-small text-muted mb-4">Settings</h5>
		  			</div>
					<!-- Review premission section -->
					<div class="col-lg-6 pl-lg-4">
						<h6 class="heading-small text-muted mb-4">Hide reviews for unverified users </h6>
					</div>
					<div class="col-lg-6 text-right">
						@if($settings)
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="reviews_for_unverified" value="1" id="device_setting" class="settings" 
								@if($settings->reviews_for_unverified == 0)checked="" @endif>
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@else
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="reviews_for_unverified" value="1" id="device_setting" class="settings">
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@endif
					</div>
					<!-- Review Detail premission section -->
					<div class="col-lg-6 pl-lg-4">
						<h6 class="heading-small text-muted mb-4">Hide reviews detail button for unverified users </h6>
					</div>
					<div class="col-lg-6 text-right">
						@if($settings)
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="review_detail_for_unverified" value="1" id="device_setting" class="settings" 
								@if($settings->review_detail_for_unverified == 0)checked="" @endif>
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@else
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="review_detail_for_unverified" value="1" id="device_setting" class="settings">
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@endif
					</div>
		  			<!-- Device Filter section -->
					<div class="col-lg-6 pl-lg-4">
						<h6 class="heading-small text-muted mb-4">Device <b>Hide</b></h6>
					</div>
					<div class="col-lg-6 text-right">
						@if($settings)
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="device" value="1" id="device_setting" class="settings" 
								@if($settings->device == 0)checked="" @endif>
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@else
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="device" value="1" id="device_setting" class="settings">
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@endif
					</div>
					<div class="col-lg-9 pl-lg-4">
						<h6 class="heading-small text-muted mb-4">Blog image upload limit</h6>
					</div>
					<div class="col-lg-3 text-right">
						<div class="pl-lg-4">
							<div class="input-group mb-3 d-flex">
							<input min="0" type="number" class="form-control search_number" value="{{$settings ? $settings->blog_image_limit : 0}}" id="blog_image_limit"/>
								<div class="input-group-append search_number mr-1">
									<span class="input-group-text" id="basic-addon2">MB</span>
								</div>
								<button type="button" class="btn btn-sm btn-primary blog_image_limit_btn_record"><i class="ni ni-check-bold"></i></button>
							</div>
						</div>
					</div>
					<div class="col-lg-9 pl-lg-4">
						<h6 class="heading-small text-muted mb-4">Homepage image upload limit</h6>
					</div>
					<div class="col-lg-3 text-right">
						<div class="pl-lg-4">
							<div class="input-group mb-3 d-flex">
								<input  min="0" type="number" class="form-control search_number" value="{{$settings ? $settings->homepage_images_limit : 0}}" id="homepage_images_limit"/>
								<div class="input-group-append search_number mr-1">
									<span class="input-group-text" id="basic-addon2">MB</span>
								</div>
								<button type="button" class="btn btn-sm btn-primary homepage_images_limit_btn_record"><i class="ni ni-check-bold"></i></button>
							</div>
						</div>
					</div>
					<div class="col-lg-6 pl-lg-4">
						<h6 class="heading-small text-muted mb-4">Feedback <b>Feature Hide</b></h6>
					</div>
					<div class="col-lg-6 text-right">
						@if($settings)
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="feedback_feature" value="1" id="device_setting" class="settings" 
								@if($settings->feedback_feature == 0)checked="" @endif>
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@else
						<div class="pl-lg-4">
							<label class="custom-toggle" >
								<input type="checkbox" data-setting_key="feedback_feature" value="1" id="device_setting" class="settings">
								<span class="custom-toggle-slider rounded-circle"></span>
							</label>
							<span class="clearfix"></span>
						</div>
						@endif
					</div>
					<div class="col-lg-6 pl-lg-4">
						<h6 class="heading-small text-muted mb-4">Feedback Title</h6>
					</div>
					<div class="col-lg-6 text-right">
						<div class="pl-lg-4">
							<div class="input-group mb-3 d-flex">
								<input type="text" class="form-control search_number" value="{{$settings ? $settings->feedback_title : ''}}" id="feedback_title"/>
								<button type="button" class="btn btn-sm btn-primary feedback_title_btn_record">
									<i class="ni ni-check-bold"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
				
					  <!-- End Device filter section -->
					<div class="row">
		  			 <div class="col-lg-12">
					  <form action="{{ url('/admin/addNoSearchMessage') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label class="mb-3"><strong>No Search Message :</strong></label>
						<textarea class="from-control text_editor" id="first-test" name="no_search_message">{{$settings->no_search_message}}</textarea>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<button class="btn btn-primary" type="submit">Save</button>
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
<style type="text/css">
	h6.heading-small{
		text-transform: capitalize;
	}
	.search_number{
		height: calc(1.75rem + 2px);
		color: #000;
	}
	span#basic-addon2 {
		background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%) !important;
		color: #fff;
		border-radius: 0px 5px 5px 0px;
		border-color: #825ee4;
	}
</style>
@endsection