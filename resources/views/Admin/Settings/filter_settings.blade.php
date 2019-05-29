@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Admin | Filter Settings')
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
		  				<h5 class="heading-small text-muted mb-4">Settings</h5>
		  			</div>
		  			<!-- Personal And Business Section -->
			  			<div class="col-lg-6 pl-lg-4">
			  				<h6 class="heading-small text-muted mb-4">Personal <b>/</b> Business <b>Hide</b></h6>
			  			</div>
			  			<div class="col-lg-6 text-right">
			  				@if($settings)
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="personal_business_setting" value="1" id="device_setting" class="filtersettings" 
				  				  @if($settings->personal_business_setting == 0)checked="" @endif>
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@else
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="personal_business_setting" value="1" id="device_setting" class="filtersettings">
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@endif
			  			</div>
		  			<!-- End Personal And Business Section -->
		  			<!-- Prepaid And Postpaid Section -->
			  			<div class="col-lg-6 pl-lg-4">
			  				<h6 class="heading-small text-muted mb-4">Postpaid <b>/</b> Prepaid <b>Hide</b></h6>
			  			</div>
			  			<div class="col-lg-6 text-right">
			  				@if($settings)
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="postpaid_prepaid_setting" value="1" id="device_setting" class="filtersettings" 
				  				  @if($settings->postpaid_prepaid_setting == 0)checked="" @endif>
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@else
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="postpaid_prepaid_setting" value="1" id="device_setting" class="filtersettings">
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@endif
			  			</div>
		  			<!-- End Prepaid And Postpaid Section -->
		  			<!-- Mobile And Home Section -->
			  			<div class="col-lg-6 pl-lg-4">
			  				<h6 class="heading-small text-muted mb-4">Mobile Plan <b>/</b> Home Internet <b>Hide</b></h6>
			  			</div>
			  			<div class="col-lg-6 text-right">
			  				@if($settings)
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="mobile_home_setting" value="1" id="device_setting" class="filtersettings" 
				  				  @if($settings->mobile_home_setting == 0)checked="" @endif>
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@else
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="mobile_home_setting" value="1" id="device_setting" class="filtersettings">
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@endif
			  			</div>
		  			<!-- End Mobile And Home Section -->
		  			<!-- Unlimited calls Section -->
			  			<div class="col-lg-6 pl-lg-4">
			  				<h6 class="heading-small text-muted mb-4">Unlimited Calls <b>Hide</b></h6>
			  			</div>
			  			<div class="col-lg-6 text-right">
			  				@if($settings)
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="unlimited_calls_setting" value="1" id="device_setting" class="filtersettings" 
				  				  @if($settings->unlimited_calls_setting == 0)checked="" @endif>
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@else
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="unlimited_calls_setting" value="1" id="device_setting" class="filtersettings">
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@endif
			  			</div>
		  			<!-- End Unlimited calls Section -->
		  			<!-- GB Section -->
			  			<div class="col-lg-6 pl-lg-4">
			  				<h6 class="heading-small text-muted mb-4">GB <b>Hide</b></h6>
			  			</div>
			  			<div class="col-lg-6 text-right">
			  				@if($settings)
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="gb_setting" value="1" id="device_setting" class="filtersettings" 
				  				  @if($settings->gb_setting == 0)checked="" @endif>
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@else
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="gb_setting" value="1" id="device_setting" class="filtersettings">
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@endif
			  			</div>
		  			<!-- End GB Section -->
		  			<!-- MB Section -->
			  			<div class="col-lg-6 pl-lg-4">
			  				<h6 class="heading-small text-muted mb-4">MBPS <b>Hide</b></h6>
			  			</div>
			  			<div class="col-lg-6 text-right">
			  				@if($settings)
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="mb_setting" value="1" id="device_setting" class="filtersettings" 
				  				  @if($settings->mb_setting == 0)checked="" @endif>
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@else
				  			<div class="pl-lg-4">
				  				<label class="custom-toggle" >
				  				  <input type="checkbox" data-setting_key="mb_setting" value="1" id="device_setting" class="filtersettings">
				  				  <span class="custom-toggle-slider rounded-circle"></span>
				  				</label>
				  				<span class="clearfix"></span>
				  			</div>
				  			@endif
			  			</div>
		  			<!-- End MB Section -->
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