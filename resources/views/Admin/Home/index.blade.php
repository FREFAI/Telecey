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
                @include('flash-message')
                 <div class="nav-wrapper">
                     <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="section" role="tablist">
                         <li class="nav-item">
                             <a class="nav-link mb-sm-3 mb-md-0 active" id="section-1-tab" data-toggle="tab" href="#section-1" role="tab" aria-controls="section-1" aria-selected="true"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Section 1</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link mb-sm-3 mb-md-0" id="section-2-tab" data-toggle="tab" href="#section-2" role="tab" aria-controls="section-2" aria-selected="false"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Section 2</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link mb-sm-3 mb-md-0" id="section-3-tab" data-toggle="tab" href="#section-3" role="tab" aria-controls="section-3" aria-selected="false"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Section 3</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link mb-sm-3 mb-md-0" id="section-4-tab" data-toggle="tab" href="#section-4" role="tab" aria-controls="section-4" aria-selected="false"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Section 4</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link mb-sm-3 mb-md-0" id="section-5-tab" data-toggle="tab" href="#section-5" role="tab" aria-controls="section-5" aria-selected="false"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Section 5</a>
                         </li>
                     </ul>
                 </div>
                 <div class="card shadow">
                     <div class="card-body">
                         <div class="tab-content" id="myTabContent">
                            <!-- Section One Section -->
                             <div class="tab-pane fade show active" id="section-1" role="tabpanel" aria-labelledby="section-1-tab">
                              <form method="post" action="{{url('/admin/section-one')}}" enctype="multipart/form-data">
                              @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea class="from-control text_editor" id="first-test" name="section_one" maxlength="100"  required="">{{$homeContent ? $homeContent->section_one : ''}}</textarea>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                      <div class="blog_image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="section_one_image" />
                                                <label for="imageUpload"><i class="fas fa-edit"></i></label>
                                            </div>
                                            <div class="avatar-preview">
                                            @if($homeContent)
                                              @if($homeContent->section_one_image != '')
                                                <div id="imagePreview" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_one_image}});">
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
                                    <input type="hidden" class="form-control" name="section_one_image_old" value="{{$homeContent ? $homeContent->section_one_image : ''}}">
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                  </div>
                                </div>
                              </form>  
                             
                              </div>
                            <!-- End Section One Section -->

                            <!-- Section Two Section  -->
                             <div class="tab-pane fade" id="section-2" role="tabpanel" aria-labelledby="section-2-tab">
                                <form method="post" action="{{url('/admin/section-two')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <textarea class="form-control text_editor" id="first-test" name="section_two" required="" placeholder="Second Section">{{$homeContent ? $homeContent->section_two : ''}}</textarea>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </form> 
                             </div>
                            <!-- End Section Two Section  -->
                            <!-- Section Three Section  -->
                             <div class="tab-pane fade" id="section-3" role="tabpanel" aria-labelledby="section-3-tab">
                                <form method="post" action="{{url('/admin/section-five')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <input type="url" class="form-control" name="section_five" required=""  placeholder="Video Url" value="{{$homeContent ? $homeContent->section_five : ''}}"/>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </form> 
                             </div>
                            <!-- End Section Three Section  -->
                            <!-- Section Four Section  -->
                             <div class="tab-pane fade" id="section-4" role="tabpanel" aria-labelledby="section-4-tab">
                                <form method="post" action="{{url('/admin/section-three')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <textarea rows="10"class="form-control text_editor" name="section_three" required=""  placeholder="Section Four">{{$homeContent ? $homeContent->section_three : ''}}</textarea>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </form> 
                             </div>
                            <!-- End Section Four Section  -->
                            <!-- Section Five Section  -->
                            <div class="tab-pane fade" id="section-5" role="tabpanel" aria-labelledby="section-5-tab">
                              <form method="post" action="{{url('/admin/section-four')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <input value="{{$homeContent ? $homeContent->section_four : ''}}" type="text" maxlength="100" class="form-control text_editor" placeholder="Section Five" name="section_four" required="">
                                    </div>
                                    <div class="form-group">
                                      <textarea rows="10"class="form-control text_editor" name="section_four_description" required=""  placeholder="Five Section">{{$homeContent ? $homeContent->section_four_description : ''}}</textarea>
                                    </div>
                                    <input type="hidden" class="form-control" name="section_four_image_old" value="{{$homeContent ? $homeContent->section_four_image : ''}}">
                                    <div class="col-lg-12 mb-4">
                                      <div class="blog_image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUploadFoursection" accept=".png, .jpg, .jpeg" name="section_four_image" />
                                                <label for="imageUploadFoursection"><i class="fas fa-edit"></i></label>
                                            </div>
                                            <div class="avatar-preview">
                                            @if($homeContent)
                                              @if($homeContent->section_four_image != '')
                                                <div id="imagePreviewFour" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_four_image}});">
                                                </div>
                                              @else
                                                <div id="imagePreviewFour" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                                                </div>
                                              @endif
                                            @else
                                              <div id="imagePreviewFour" style="background-image: url({{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}});">
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                          <small><strong>( Max. Size 10MB ) </strong></small>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                  </div>
                                </div>
                              </form> 
                            </div>
                            <!-- Section Five Section End  -->
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
  input, textarea{
    color: #000 !important;
  }
</style>
@endsection