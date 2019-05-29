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
		    	<div class="row">

		  			<div class="col-lg-12">
		  				<h5 class="heading-small text-muted mb-4">Settings</h5>
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
		  			<!-- End Device filter section -->
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
</style>
@endsection