<!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row align-items-center">
            <div class="col-8 collapse-brand">
              <a href="{{url('/admin/dashboard')}}">
                <img src="{{URL::asset('frontend/assets/img/logo-telco-tales.png')}}"  alt="...">
                
              </a>

            </div>
            <div class="col-4 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{url('/admin/dashboard')}}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}" href="{{url('admin/settings')}}">
              <i class="ni ni-settings text-info"></i> Settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/filetrsettings') ? 'active' : '' }}" href="{{url('admin/filetrsettings')}}">
              <i class="fa fa-filter text-orange"></i> Filter Settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/ads') ? 'active' : '' }}" href="{{url('admin/ads')}}">
              <i class="fas fa-ad text-red" style='font-size:20px'></i> ADS
            </a>
          </li>
          <!--
          <li class="nav-item">
            <a class="nav-link" href="./examples/tables.html">
              <i class="ni ni-bullet-list-67 text-yellow"></i> Tables
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/login.html">
              <i class="ni ni-key-25 text-info"></i> Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/register.html">
              <i class="ni ni-circle-08 text-pink"></i> Register
            </a>
          </li> -->
        </ul>
      </div>