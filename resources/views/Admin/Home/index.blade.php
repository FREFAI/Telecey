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
                         <li class="nav-item">
                             <a class="nav-link mb-sm-3 mb-md-0" id="section-6-tab" data-toggle="tab" href="#section-6" role="tab" aria-controls="section-6" aria-selected="false"><i class="fas fa-ad mr-2" style='font-size:18px'></i>Section 6</a>
                         </li>
                     </ul>
                 </div>
                 <div class="card shadow">
                     <div class="card-body">
                         <div class="tab-content" id="myTabContent">
                            <!-- Section One Section -->
                             <div class="tab-pane fade show active" id="section-1" role="tabpanel" aria-labelledby="section-1-tab">
                              <form id="sectionformOne" method="post" action="{{url('/admin/section-one')}}" enctype="multipart/form-data">
                              @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea class="from-control text_editor" id="first-test" name="section_one" maxlength="100"  required="">{{$homeContent ? $homeContent->section_one : ''}}</textarea>
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="image_upload_div">
                                          @if($homeContent)
                                            @if($homeContent->section_one_image != '')
                                              <img class="profile-img mb-3" src="{{URL::asset('home/images')}}/{{$homeContent->section_one_image}}"/>
                                            @else
                                              <img class="profile-img mb-3" src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}"/>
                                              
                                            @endif
                                          @else
                                            <img class="profile-img mb-3" src="{{URL::asset('admin/assets/img/thumbnail-default_2.jpg')}}"/>
                                            
                                          @endif
                                        <br>
                                        <label class="btn btn-info" for="imageUploadSectionOne">Select Image</label>
                                        <input class="d-none" type='file' id="imageUploadSectionOne" accept=".png, .jpg, .jpeg" name="section_one_image" data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
                                        <input type='hidden' id="sectiononeImage" accept=".png, .jpg, .jpeg" name="section_one_image_croped"/>
                                        <input type="hidden" id="image_show" value="{{URL::asset('home/images')}}/{{$homeContent->section_one_image}}">
                                      </div>
                                      <div class="mt-3">
                                        <small><strong>( Max. Size {{$setting ? number_format($setting->homepage_images_limit) : 10}}MB ) </strong></small>
                                      </div>
                                    </div>
                                    <!-- <div class="col-lg-12 mb-4">
                                      <div class="blog_image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="section_one_image" data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
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
                                              <small><strong>( Max. Size {{$setting ? number_format($setting->homepage_images_limit) : 10}}MB ) </strong></small>
                                            </div>
                                        </div>
                                       
                                      </div>
                                    </div> -->
                                    <div class="col-lg-12 mt-4">
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link" name="section_one_image_link"  value="{{$homeContent ? $homeContent->section_one_image_link : ''}}">
                                      </div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                      <div class="form-group">
                                        <input type="text" id="color" maxlength="50" class="colorpicker form-control" placeholder="Image Border Color" name="section_one_image_border_color" value="{{$homeContent ? $homeContent->section_one_image_border_color : '#1bfca3'}}">
                                      </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="section_one_image_old" value="{{$homeContent ? $homeContent->section_one_image : ''}}">
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary sectionOnebtn">Save</button>
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
                                <form method="post" action="{{url('/admin/section-sixth')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="col-lg-4">
                                      <div class="mb-2">
                                        <small><strong>Labels </strong></small>
                                      </div>
                                      <div class="form-group">
                                        <input class="form-control" name="label_1" value="{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_1 != '') ? $homeContent->section_six->label_1 :'' }}"/>
                                      </div>
                                    </div>
                                    <div class="col-lg-4">
                                      <div class="mb-2 text-left">
                                        <small><strong>( Max. Size {{$setting ? number_format($setting->homepage_images_limit) : 10}}MB ) </strong></small>
                                      </div>
                                      <div class="section-4-image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit-1">
                                                <input class="form-control imageUpload" type='file' accept=".png, .jpg, .jpeg" name="icon_1"  data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
                                                <!-- <label for="imageUpload"><i class="fas fa-edit"></i></label> -->
                                            </div>
                                            <div class="avatar-preview">
                                              @if($homeContent)
                                                @if($homeContent->section_six != '' && $homeContent->section_six->icon_1 != '')
                                                  <div id="imagePreview" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_six->icon_1}});">
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
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="col-lg-4">
                                      <div class="mb-2 text-left">
                                        <small><strong>Images Link</strong></small>
                                      </div>
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link"  name="label_1_image_link"  value="{{ $homeContent && ($homeContent->section_six != '' && isset($homeContent->section_six->label_1_image_link) && $homeContent->section_six->label_1_image_link != '') ? $homeContent->section_six->label_1_image_link :'' }}">
                                      </div>   
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input class="form-control"name="label_2" value="{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_2 != '') ? $homeContent->section_six->label_2 :'' }}"/>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="section-4-image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit-1">
                                                <input class="form-control imageUpload" type='file' accept=".png, .jpg, .jpeg" name="icon_2"  data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
                                                <!-- <label for="imageUpload"><i class="fas fa-edit"></i></label> -->
                                            </div>
                                            <div class="avatar-preview">
                                            @if($homeContent)
                                              @if($homeContent->section_six != '' && $homeContent->section_six->icon_2 != '')
                                                <div id="imagePreview" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_six->icon_2}});">
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
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link"  name="label_2_image_link"  value="{{ $homeContent && ($homeContent->section_six != '' && isset($homeContent->section_six->label_2_image_link) && $homeContent->section_six->label_2_image_link != '') ? $homeContent->section_six->label_2_image_link :'' }}">
                                      </div>   
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input class="form-control" name="label_3" value="{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_3 != '') ? $homeContent->section_six->label_3 :'' }}"/>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="section-4-image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit-1">
                                                <input type='file' class="form-control  imageUpload" accept=".png, .jpg, .jpeg" name="icon_3"  data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
                                                <!-- <label for="imageUpload"><i class="fas fa-edit"></i></label> -->
                                            </div>
                                            <div class="avatar-preview">
                                            @if($homeContent)
                                              @if($homeContent->section_six != '' && $homeContent->section_six->icon_3 != '')
                                                <div id="imagePreview" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_six->icon_3}});">
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
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link"  name="label_3_image_link"  value="{{ $homeContent && ($homeContent->section_six != '' && isset($homeContent->section_six->label_3_image_link) && $homeContent->section_six->label_3_image_link != '') ? $homeContent->section_six->label_3_image_link :'' }}">
                                      </div>   
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input class="form-control" name="label_4" value="{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_4 != '') ? $homeContent->section_six->label_4 :'' }}"/>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="section-4-image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit-1">
                                                <input type='file' class="form-control  imageUpload" accept=".png, .jpg, .jpeg" name="icon_4"  data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
                                                <!-- <label for="imageUpload"><i class="fas fa-edit"></i></label> -->
                                            </div>
                                            <div class="avatar-preview">
                                            @if($homeContent)
                                              @if($homeContent->section_six != '' && $homeContent->section_six->icon_4 != '')
                                                <div id="imagePreview" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_six->icon_4}});">
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
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link"  name="label_4_image_link"  value="{{ $homeContent && ($homeContent->section_six != '' && isset($homeContent->section_six->label_4_image_link) && $homeContent->section_six->label_4_image_link != '') ? $homeContent->section_six->label_4_image_link :'' }}">
                                      </div>   
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input class="form-control"name="label_5" value="{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_5 != '') ? $homeContent->section_six->label_5 :'' }}"/>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="section-4-image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit-1">
                                                <input type='file' class="form-control  imageUpload" accept=".png, .jpg, .jpeg" name="icon_5"  data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
                                                <!-- <label for="imageUpload"><i class="fas fa-edit"></i></label> -->
                                            </div>
                                            <div class="avatar-preview">
                                            @if($homeContent)
                                              @if($homeContent->section_six != '' && $homeContent->section_six->icon_5 != '')
                                                <div id="imagePreview" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_six->icon_5}});">
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
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link"  name="label_5_image_link"  value="{{ $homeContent && ($homeContent->section_six != '' && isset($homeContent->section_six->label_5_image_link) && $homeContent->section_six->label_5_image_link != '') ? $homeContent->section_six->label_5_image_link :'' }}">
                                      </div>   
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input class="form-control"name="label_6" 
                                        value="{{ $homeContent && ($homeContent->section_six != '' && $homeContent->section_six->label_6 != '') ? $homeContent->section_six->label_6 :'' }}"/>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="section-4-image">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit-1">
                                                <input type='file' class="form-control  imageUpload" accept=".png, .jpg, .jpeg" name="icon_6"  data-size="{{$setting ? number_format($setting->homepage_images_limit) : 10}}"/>
                                                <!-- <label for="imageUpload"><i class="fas fa-edit"></i></label> -->
                                            </div>
                                            <div class="avatar-preview">
                                            @if($homeContent)
                                              @if($homeContent->section_six != '' && $homeContent->section_six->icon_6 != '')
                                                <div id="imagePreview" style="background-image: url({{URL::asset('home/images')}}/{{$homeContent->section_six->icon_6}});">
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
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link"  name="label_6_image_link"  value="{{ $homeContent && ($homeContent->section_six != '' && isset($homeContent->section_six->label_6_image_link) && $homeContent->section_six->label_6_image_link != '') ? $homeContent->section_six->label_6_image_link :'' }}">
                                      </div>   
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </form> 
                             </div>
                            <!-- End Section Four Section  -->
                            <!-- Section Fifth Section  -->
                             <div class="tab-pane fade" id="section-5" role="tabpanel" aria-labelledby="section-5-tab">
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
                            <!-- End Section Fifth Section  -->
                            <!-- Section Sixth Section  -->
                            <div class="tab-pane fade" id="section-6" role="tabpanel" aria-labelledby="section-6-tab">
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
                                          <small><strong>( Max. Size {{$setting ? number_format($setting->homepage_images_limit) : 10}}MB ) </strong></small>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                      <div class="form-group">
                                        <input type="url" maxlength="50" class="form-control" id="exampleFormControlInput1" placeholder="Image Link" name="section_four_image_link" value="{{$homeContent ? $homeContent->section_four_image_link : ''}}">
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                  </div>
                                </div>
                              </form> 
                            </div>
                            <!-- Section Sixth Section End  -->
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

<button style="display:none;" type="button" class="btn btn-info btn-lg addHomeImageModal" data-toggle="modal" data-target="#addHomeImage">Open Modal</button>
<div id="addHomeImage" class="modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0">
                <h2 class="text-center w-100">Crop Image</h2>
            </div>
            <div class="modal-body p-2">
                <div class="row text-center">
                <div id="upload-demo"></div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                <button id="useimg" type="button" class="btn btn-primary">Use Image</button>
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
  input, textarea{
    color: #000 !important;
  }
  .asColorPicker-wrap {
    width: 100%;
    display: flex;
  }
  .asColorPicker-dropdown {
      max-width: 260px !important;
  }
  .asColorPicker-trigger {
    height: 45px;
    width: 45px;
  }
  .image_upload_div .edit_icon {
    position: absolute;
    z-index: 9;
    background: #fff;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    padding: 5px 10px;
    right: 15px;
    top: 0;
    cursor: pointer;
  }
  /* div#upload-demo {
    border: 1px solid #ccc;
    width: 70%;
    margin: 0 auto;
  } */
  .image_upload_div img {
    height: 100%;
    max-height: 180px;
  }
</style>

@endsection