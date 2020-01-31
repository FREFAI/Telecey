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
                                      <input value="{{$homeContent ? $homeContent->section_one : ''}}" type="text" maxlength="100" class="form-control" placeholder="Section One" name="section_one" required="">
                                    </div>
                                    <div class="form-group">
                                      <input type="file" maxlength="100" class="form-control" name="section_one_image">
                                      <input type="hidden" class="form-control" name="section_one_image_old" value="{{$homeContent ? $homeContent->section_one_image : ''}}">
                                    </div>
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
                                        <textarea class="form-control" name="section_two" required="" placeholder="Second Section">{{$homeContent ? $homeContent->section_two : ''}}</textarea>
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
                                <form method="post" action="{{url('/admin/section-three')}}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <textarea rows="10"class="form-control" name="section_three" required=""  placeholder="Third Section">{{$homeContent ? $homeContent->section_three : ''}}</textarea>
                                      </div>
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </form> 
                             </div>
                            <!-- End Section Three Section  -->
                             
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
</style>
@endsection