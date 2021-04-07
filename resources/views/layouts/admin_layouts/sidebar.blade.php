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
        <ul class="navbar-nav sidebar_nav">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{url('/admin/dashboard')}}">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
          @if(Auth::guard('admin')->user()['type'] == 1)
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/admin-list') ? 'active' : '' }}" href="{{url('/admin/admin-list')}}">
              <i class="fa fa-users text-success" aria-hidden="true"></i>
              <span class="d-md-inline-block">Admin</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/messages') ? 'active' : '' }}" href="{{url('/admin/messages')}}">
              <i class="fas fa-comment text-danger" aria-hidden="true"></i>
              <span class="d-md-inline-block">Message</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="{{url('/admin/users')}}">
              <i class="ni ni-single-02 text-info"></i>
              <span class="d-md-inline-block">Users</span>
            </a>
          </li>
          <!-- <li class="nav-item dropdown  {{ request()->is('admin/settings') ? 'show' : '' }} {{ request()->is('admin/filetrsettings') ? 'show' : '' }}">
            <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-single-02 text-info"></i>
              <span class="d-md-inline-block">Users</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small {{ request()->is('admin/settings') ? 'show' : '' }} {{ request()->is('admin/filetrsettings') ? 'show' : '' }}">
              <a class="dropdown-item {{ request()->is('admin/settings') ? 'active' : '' }}" href="{{url('admin/settings')}}">
                <i class="ni ni-fat-add text-info"></i> Add user
              <a class="dropdown-item {{ request()->is('admin/filetrsettings') ? 'active' : '' }}" href="{{url('admin/filetrsettings')}}">
                <i class="ni ni-circle-08 text-orange"></i> Users list </a>
            </div>
          </li> -->
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/home-content') ? 'active' : '' }}" href="{{url('/admin/home-content')}}">
              <i class="ni ni-shop text-pink"></i> Home content
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/adminLogs') ? 'active' : '' }}" href="{{url('/admin/adminLogs')}}">
              <i class="ni ni-collection text-pink"></i> Admin Transaction
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/userLogs') ? 'active' : '' }}" href="{{url('/admin/userLogs')}}">
              <i class="ni ni-collection text-pink"></i> Website Transaction
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/terms-conditions') ? 'active' : '' }}" href="{{url('/admin/terms-conditions')}}">
              <i class="ni ni-support-16 text-pink"></i> Terms and Conditions
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/privacy-policy') ? 'active' : '' }}" href="{{url('/admin/privacy-policy')}}">
              <i class="ni ni-support-16 text-pink"></i> Privacy Policy
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/cookie-policy') ? 'active' : '' }}" href="{{url('/admin/cookie-policy')}}">
              <i class="ni ni-support-16 text-pink"></i> Cookie Policy
            </a>
          </li>
          <li class="nav-item dropdown  {{ request()->is('admin/blogs') ? 'show' : '' }} {{ request()->is('admin/addblog') ? 'show' : '' }} {{ request()->is('admin/blogs') ? 'show' : '' }}">
            <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-newspaper text-pink"></i>
              <span class="d-md-inline-block">Blogs</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small {{ request()->is('admin/addblog') ? 'show' : '' }} {{ request()->is('admin/blogs') ? 'show' : '' }} {{ request()->is('admin/categories') ? 'show' : '' }}">
              <a class="dropdown-item {{ request()->is('admin/blogs') ? 'active' : '' }}" href="{{url('admin/blogs')}}">
                <i class="ni ni-settings text-info"></i> Blogs
              <a class="dropdown-item {{ request()->is('admin/categories') ? 'active' : '' }}" href="{{url('/admin/categories')}}">
                <i class="fa fa-filter text-orange"></i> Categories </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/classes') ? 'active' : '' }}" href="{{url('/admin/classes')}}">
              <i class="fa fa-newspaper text-pink" aria-hidden="true"></i> Classes
            </a>
          </li> 
          <li class="nav-item dropdown  {{ request()->is('admin/settings') ? 'show' : '' }} {{ request()->is('admin/filetrsettings') ? 'show' : '' }}">
            <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-settings text-info"></i>
              <span class="d-md-inline-block">Settings</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small {{ request()->is('admin/settings') ? 'show' : '' }} {{ request()->is('admin/filetrsettings') ? 'show' : '' }}">
              <a class="dropdown-item {{ request()->is('admin/settings') ? 'active' : '' }}" href="{{url('admin/settings')}}">
                <i class="ni ni-settings text-info"></i> Settings
              <a class="dropdown-item {{ request()->is('admin/filetrsettings') ? 'active' : '' }}" href="{{url('admin/filetrsettings')}}">
                <i class="fa fa-filter text-orange"></i> Filter Settings </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/ads') ? 'active' : '' }}" href="{{url('admin/ads')}}">
              <i class="fas fa-ad text-red" style='font-size:20px'></i> ADS
            </a>
          </li>
          <li class="nav-item dropdown  {{ request()->is('admin/provider-list') ? 'show' : '' }} {{ request()->is('admin/servicetype-list') ? 'show' : '' }}">
            <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-bullet-list-67 text-yellow"></i>
              <span class="d-md-inline-block">Plans</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small {{ request()->is('admin/provider-list') ? 'show' : '' }} {{ request()->is('admin/servicetype-list') ? 'show' : '' }}">
              <a class="dropdown-item {{ request()->is('admin/provider-list') ? 'active' : '' }}" href="{{url('admin/provider-list')}}">
                <i class="ni ni-bullet-list-67 text-yellow"></i> Providers
              <a class="dropdown-item {{request()->is('admin/servicetype-list') ? 'active' : '' }}" href="{{url('admin/servicetype-list')}}">
                <i class="ni ni-caps-small text-info"></i> Service Types </a>
            </div>
          </li>
          <li class="nav-item dropdown  {{ request()->is('admin/devices-list') ? 'show' : '' }} {{ request()->is('admin/brands-list') ? 'show' : '' }}">
            <a class="nav-link dropdown-toggle text-nowrap" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-mobile-button text-success"></i>
              <span class="d-md-inline-block">Devices</span>
            </a>
            <div class="dropdown-menu dropdown-menu-small {{ request()->is('admin/devices-list') ? 'show' : '' }} {{ request()->is('admin/brands-list') ? 'show' : '' }} {{ request()->is('admin/suppliers') ? 'show' : '' }}">
              <a class="dropdown-item {{ request()->is('admin/devices-list') ? 'active' : '' }}" href="{{url('admin/devices-list')}}">
                <i class="ni ni-mobile-button text-success"></i> Device List
              <a class="dropdown-item {{request()->is('admin/brands-list') ? 'active' : '' }}" href="{{url('admin/brands-list')}}">
                <i class="ni ni-paper-diploma text-danger"></i> Brands List </a>
              <a class="dropdown-item {{request()->is('admin/suppliers') ? 'active' : '' }}" href="{{url('admin/suppliers')}}">
                <i class="ni ni-delivery-fast text-info"></i> Supplier </a>
              <a class="dropdown-item {{request()->is('admin/colors-list') ? 'active' : '' }}" href="{{url('admin/colors-list')}}">
                <i class="ni ni-palette text-info"></i> Device Colors </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/rating-question') ? 'active' : '' }}" href="{{url('admin/rating-question')}}">
              <i class="ni ni-paper-diploma text-info"></i> Rating Question
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/feedbackQuestion/list') ? 'active' : '' }}" href="{{url('admin/feedbackQuestion/list')}}">
              <i class="ni ni-paper-diploma text-info"></i> Feedback Question
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/feedback/list') ? 'active' : '' }}" href="{{url('admin/feedback/list')}}">
              <i class="ni ni-paper-diploma text-info"></i> Feedback
            </a>
          </li>
        </ul>
      </div>