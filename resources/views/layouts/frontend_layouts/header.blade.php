<header id="header-wrap">
    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
        <div class="container-fluid">
            <div class="theme-header clearfix">
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                    </button>
                    <a href="{{url('/')}}" class="navbar-brand"><img src="frontend/assets/img/logo-telco-tales.png" alt="">
                       <span class="logo-title">Telco -Tales </span>
                       <br>
                       <span class="logo-tag-line">Rate Your Telecom Carrier</span>
                    </a>
                </div>
                <div class="collapse navbar-collapse float-right" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 mt-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/plans')}}">Plan</a>
                        </li>
                        @if($settings)
                            @if($settings->device == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/devices')}}">Devices</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/devices')}}">Devices</a>
                            </li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">More</a>
                            <b class="caret"></b>
                            <ul class="dropdown-menu top">
                                <li>
                                    <a class="nav-link mt-0 mb-0" href="{{url('/reviews')}}">Personal-information-and-reviews</a>
                                    <a class="nav-link mt-0 mb-0" href="#">Contact Us</a>
                                    <a class="nav-link mt-0 mb-0" href="{{url('/blogs-list')}}">Blog</a>
                                    <a class="nav-link mt-0 mb-0" href="#">Memebers</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <div class="social">
                                <a href="" class="link facebook"><span class="fa fa-facebook-square"></span></a>
                                <a href="" class="link twitter"><span class="fa fa-twitter"></span></a>
                                <a href="" class="link google-plus"><span class="fa fa-linkedin-in"></span></a>
                            </div>
                        </li>
                        @if(Auth::guard('customer')->user()['id'] != "")
                        <li class="dropdown top">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="frontend/assets/img/user_placeholder.png" alt="" width="40"></a>
                            <b class="caret"></b>
                            <ul class="dropdown-menu top">
                                <li>
                                    <div class="navbar-content">
                                        <a class="nav-link mt-0 mb-0" href="{{url('/profile')}}">
                                            {{ Auth::guard('customer')->user()['firstname'] }}
                                        </a>
                                        <a class="nav-link mt-0 mb-0" href="{{url('/logout')}}">Logout</a>
                                        
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/signin')}}">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-signup" href="{{url('/signup')}}">Sign In/Up</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu" data-logo="frontend/assets/img/logo-telco-tales.png"></div>
    </nav>
</header>