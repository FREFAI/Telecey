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
      <!-- <div class="col-xl-8 mb-5 mb-xl-0">
        <div class="card bg-gradient-default shadow">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                <h2 class="text-white mb-0">Sales value</h2>
              </div>
              <div class="col">
                <ul class="nav nav-pills justify-content-end">
                  <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                      <span class="d-none d-md-block">Month</span>
                      <span class="d-md-none">M</span>
                    </a>
                  </li>
                  <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                      <span class="d-none d-md-block">Week</span>
                      <span class="d-md-none">W</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="chart-sales" class="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card shadow">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                <h2 class="mb-0">Total orders</h2>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="chart-orders" class="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </div> -->
    </div>
    <div class="row mt-5">
      <!-- <div class="col-xl-8 mb-5 mb-xl-0">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Page visits</h3>
              </div>
              <div class="col text-right">
                <a href="#!" class="btn btn-sm btn-primary">See all</a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Page name</th>
                  <th scope="col">Visitors</th>
                  <th scope="col">Unique users</th>
                  <th scope="col">Bounce rate</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">
                    /argon/
                  </th>
                  <td>
                    4,569
                  </td>
                  <td>
                    340
                  </td>
                  <td>
                    <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    /argon/index.html
                  </th>
                  <td>
                    3,985
                  </td>
                  <td>
                    319
                  </td>
                  <td>
                    <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    /argon/charts.html
                  </th>
                  <td>
                    3,513
                  </td>
                  <td>
                    294
                  </td>
                  <td>
                    <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    /argon/tables.html
                  </th>
                  <td>
                    2,050
                  </td>
                  <td>
                    147
                  </td>
                  <td>
                    <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    /argon/profile.html
                  </th>
                  <td>
                    1,795
                  </td>
                  <td>
                    190
                  </td>
                  <td>
                    <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <h3 class="mb-0">Social traffic</h3>
              </div>
              <div class="col text-right">
                <a href="#!" class="btn btn-sm btn-primary">See all</a>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Referral</th>
                  <th scope="col">Visitors</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">
                    Facebook
                  </th>
                  <td>
                    1,480
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2">60%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    Facebook
                  </th>
                  <td>
                    5,480
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2">70%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    Google
                  </th>
                  <td>
                    4,807
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2">80%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    Instagram
                  </th>
                  <td>
                    3,678
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2">75%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">
                    twitter
                  </th>
                  <td>
                    2,645
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <span class="mr-2">30%</span>
                      <div>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> -->
    </div>
    <!-- Footer Section Include -->
        @include('layouts.admin_layouts.footer')
    <!-- End Footer Section Include -->
  </div>
</div>

@endsection