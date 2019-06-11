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
                     </ul>
                 </div>
                 <div class="card shadow">
                     <div class="card-body">
                         <div class="tab-content" id="myTabContent">
                            <!-- Section One Section -->
                             <div class="tab-pane fade show active" id="section-1" role="tabpanel" aria-labelledby="section-1-tab">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea class="from-control text_editor" id="first-test">Next, get a free Tiny Cloud API key!</textarea>
                                    </div>
                                    <div class="form-group">
                                      <button class="btn btn-primary">Submit</button>
                                    </div>
                                  </div>
                                </div>
                             </div>
                            <!-- End Section One Section -->

                            <!-- Section Two Section  -->
                             <div class="tab-pane fade" id="section-2" role="tabpanel" aria-labelledby="section-2-tab">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea class="from-control text_editor" id="first-test">Next, get a free Tiny Cloud API key!</textarea>
                                    </div>
                                    <div class="form-group">
                                      <button class="btn btn-primary">Submit</button>
                                    </div>
                                  </div>
                                </div>
                             </div>
                            <!-- End Section Two Section  -->

                            <!-- Section Three Section  -->
                             <div class="tab-pane fade" id="section-3" role="tabpanel" aria-labelledby="section-3-tab">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea class="from-control text_editor" id="first-test">Next, get a free Tiny Cloud API key!</textarea>
                                    </div>
                                    <div class="form-group">
                                      <button class="btn btn-primary">Submit</button>
                                    </div>
                                  </div>
                                </div>
                             </div>
                            <!-- End Section Three Section  -->

                            <!-- Section Four Section  -->
                             <div class="tab-pane fade" id="section-4" role="tabpanel" aria-labelledby="section-4-tab">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea class="from-control text_editor" id="first-test">Next, get a free Tiny Cloud API key!</textarea>
                                    </div>
                                    <div class="form-group">
                                      <button class="btn btn-primary">Submit</button>
                                    </div>
                                  </div>
                                </div>
                             </div>
                            <!-- End Section Four Section  -->
                             
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