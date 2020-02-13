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
		  				<h5 class="heading-small text-muted mb-4">ADS</h5>
		  			</div>
            <!-- <div class="col-lg-6">
              <h6 class="heading-small text-muted mb-4">Currently active</h6>
            </div>
            <div class="col-lg-6 text-right">
              <div class="form-group">
                <span class="toggle_label">Custom Ads</span>
                &nbsp;
                  <label class="custom-toggle mb-0">
                    <input id="add_setting" data-setting_key="ads_setting" type="checkbox" @if($settings->ads_setting == 1) checked="" @endif>
                    <span class="custom-toggle-slider rounded-circle"></span>
                  </label>
                &nbsp;
                <span class="toggle_label">Google Ads</span>

              </div>
            </div> -->
		  			<div class="col-lg-12">
            @include('flash-message')
             <div class="nav-wrapper">
                 <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                     <li class="nav-item">
                         <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Custom Ads</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Google Ads</a>
                     </li>
                 </ul>
             </div>
             <div class="card shadow">
                 <div class="card-body">
                     <div class="tab-content" id="myTabContent">
                        <!-- Custom Ads Section -->
                         <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="row">
                              <div class="col-md-12">
                                <form action="{{ url('/admin/ads') }}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <input type="text" value="{{old('title')}}" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Ads Title" name="title" required="">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <div class="custom-control custom-checkbox mb-3">
                                          <input class="custom-control-input is_global" id="customCheck1" name="is_global" type="checkbox" checked="">
                                          <label class="custom-control-label" for="customCheck1">Is Global</label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group country_select_section" style="display:none;">
                                          <select class="form-control select2 country_field" name="country">
                                            @if($countries)
                                              <option value="">Select Country</option>
                                              @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
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
                                                    <div id="imagePreview" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                                                    </div>
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
                                        <input type="hidden" name="type" value="0">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <div class="col-md-12">
                                <h5 class="heading-small text-muted mb-4">ADS List</h5>
                              </div>
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table align-items-center">
                                    <thead class="thead-light">
                                      <tr>
                                        <th scope="col" style="width: 10px;">Sr.No</th>
                                        <th scope="col" style="width: 10px;">Image</th>
                                        <th scope="col" class="text-center">Title</th>
                                        <th scope="col" class="text-center">Is Global</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-right">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if(count($customads) > 0)
                                        @php
                                            $i = ($customads->currentpage()-1)* $customads->perpage() + 1;
                                        @endphp
                                        @foreach($customads as $ads)
                                        <tr>
                                            <td style="max-width: 10px;">
                                                {{$i++}}
                                            </td>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <a href="#" class="avatar rounded-circle mr-3">
                                                      <img alt="{{$ads->ads_file}}" src="{{URL::asset('ads_banner/resized')}}/{{$ads->ads_file}}" class="h-100">
                                                    </a>
                                                </div>
                                            </th>
                                            <td  class="text-center">
                                              <div class="media-body">
                                                  <span class="mb-0 text-sm">{{$ads->title}}</span>
                                              </div>
                                            </td>
                                            <td  class="text-center">
                                              <div class="media-body">
                                                  <span class="mb-0 text-sm">
                                                       {{$ads->is_global == 0 ? $ads->countries->name : "Global"}}
                                                  </span>
                                              </div>
                                            </td>
                                            <td  class="text-center">
                                              <span class="badge badge-dot mr-4">
                                                @if($ads->is_active == 1)
                                                  <span class="d-none not_ap_ms"><i class="bg-danger"></i> In active</span>
                                                <span class="approved_ms"><i class="bg-success"></i> Active</span>
                                                @else
                                                <span class="not_ap_ms"><i class="bg-danger"></i> In active</span>
                                                <span class="d-none approved_ms"><i class="bg-success"></i> Active</span>
                                                @endif
                                              </span>
                                            </td>
                                            <td class="text-right">
                                              <a href="{{url('/admin/editAds')}}/{{base64_encode($ads->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                              <button class="btn btn-icon btn-2 
                                                  @if($ads->is_active == 1) 
                                                    btn-danger 
                                                  @else 
                                                    btn-success 
                                                  @endif 
                                                  btn-sm active_btn_ads" data-toggle="tooltip" data-placement="top" title="
                                                  @if($ads->is_active == 1) 
                                                    Not approve 
                                                  @else 
                                                    Approve 
                                                  @endif" 
                                                  data-is_active="@if($ads->is_active == 1) 0 @else 1 @endif"
                                                  data-ads_id="{{$ads->id}}">
                                                <span class="btn-inner--icon"><i class="@if($ads->is_active != 1) ni ni-check-bold @else ni ni-fat-remove @endif"></i></span>
                                              </button>
                                            
                                              <button class="btn btn-icon btn-2 btn-danger btn-sm delete_ad" type="button" data-ad_id="{{$ads->id}}" data-toggle="tooltip" data-placement="top" title="Delete">
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
                                <div class="ads_pagination">
                                  {{$customads->links()}}
                                </div>
                              </div>
                            </div>
                         </div>
                        <!-- End Custom Ads Section -->

                        <!-- Google Ads Section  -->
                         <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <form action="{{ url('/admin/ads') }}" method="post">
                              @csrf
                              <div class="form-group">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter your Google Ads script here..." name="script" required="">@if($googleads) {{$googleads->script}} @endif</textarea>
                              </div>
                              <div class="form-group">
                                <input type="hidden" name="type" value="1">
                                <button class="btn btn-primary" type="submit">Save</button>
                              </div>
                            </form>
                         </div>
                        <!-- End Google Ads Section  -->
                         
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