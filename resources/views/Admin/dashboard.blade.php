@extends('layouts.admin_layouts.admin_dashboard')
@section('title', 'Dashboard')
@section('content')

<!-- Main content -->
<div class="main-content">
  @include('layouts.admin_layouts.top_navbar')
  <!-- Header -->
  <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-4 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Admins</h5>
                    <span class="h2 font-weight-bold mb-0">{{$data['admins']}}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Users</h5>
                    <span class="h2 font-weight-bold mb-0">{{$data['users']}}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Blogs</h5>
                    <span class="h2 font-weight-bold mb-0">{{$data['blogs']}}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fas fa-newspaper"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 mt-4">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Plans Review</h5>
                    <span class="h2 font-weight-bold mb-0">{{$data['plansReviews']}}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                      <i class="ni ni-bullet-list-67"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 mt-4">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Devices Review</h5>
                    <span class="h2 font-weight-bold mb-0">{{$data['deviceReviews']}}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                      <i class="ni ni-mobile-button"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt-7">
    <div class="row">
      <!-- <iframe width="100%" height="650px" frameborder="0" src="https://softradix.speedtestcustom.com"></iframe> -->
      
    </div>
    <!-- Footer Section Include -->
        @include('layouts.admin_layouts.footer')
    <!-- End Footer Section Include -->
  </div>
</div>

@endsection