<header id="header-wrap">
    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
        <div class="container">
            <div class="theme-header clearfix row">
                <div class="navbar-header col-3">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                    </button>
                    <a href="{{url('/')}}" class="navbar-brand"><img src="{{URL::asset('frontend/assets/img/logo-new.png')}}" alt="">
                       <!-- <span class="logo-title">Telco -Tales </span>
                       <br>
                       <span class="logo-tag-line">Rate Your Telecom Carrier</span> -->
                    </a>
                </div>
                <div class="col-9">
                    <div class="collapse navbar-collapse float-right" id="main-navbar">
                        <ul class="navbar-nav mr-auto w-100 mt-4">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}">{{__('header.home')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/plans')}}">{{__('header.plan')}}</a>
                            </li>
                            @if($settings)
                                @if($settings->device == 1)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('/devices')}}">{{__('header.device')}}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/devices')}}">{{__('header.device')}}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/blogs-list')}}">{{__('header.blog')}}</a>
                            </li>
                            <li class="nav-item mr-3">
                                <form action="{{url('/setLocal')}}" method="post" class="mt-4">
                                @csrf
                                <input type="hidden" name="current_url" value="{{\Request::fullUrl()}}">
                                    <select name="lang" class="language">
                                        <option @if(!\Session::get('locale') || (\Session::get('locale') && \Session::get('locale') == "en")) selected="" @endif value="en">English</option>
                                        <option @if(\Session::get('locale') && \Session::get('locale') == "fr") selected="" @endif value="fr">French</option>
                                    </select>
                                </form>
                            </li> 
                            @if((Auth::guard('customer')->user() !== null) && Auth::guard('customer')->user()['id'] != "")
                            <li class="dropdown top text-right ml-5">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{URL::asset('frontend/assets/img/user_placeholder.png')}}" alt="" width="40"></a>
                                <b class="caret"></b>
                                <ul class="dropdown-menu top">
                                    <li>
                                        <div class="navbar-content">
                                            <a class="nav-link mt-0 mb-0 text-capitalize" href="{{url('/profile')}}">
                                                @if(Auth::guard('customer')->user()['nickname'] == "" || Auth::guard('customer')->user()['nickname'] == NULL)
                                                    {{ Auth::guard('customer')->user()['firstname'] }}
                                                @else
                                                    {{ Auth::guard('customer')->user()['nickname'] }}
                                                @endif
                                            </a>
                                            <a class="nav-link mt-0 mb-0" href="{{url('/reviews')}}">{{__('header.personal_menu')}}</a>
                                            <a class="nav-link mt-0 mb-0" href="{{url('/logout')}}">{{__('header.logout')}}</a>
                                            
                                        </div>
                                    </li>
                                </ul>
                                <div class="social">
                                    <a target='_blank' href="https://www.facebook.com/telecey" class="link facebook"><span class="fa fa-facebook-square"></span></a>
                                    <a target='_blank' href="https://twitter.com/telecey" class="link twitter"><span class="fa fa-twitter"></span></a>
                                    <a target='_blank' href="https://www.linkedin.com/company/telecey" class="link google-plus"><span class="fa fa-linkedin-in"></span></a>
                                    <a target='_blank' href="https://www.instagram.com/teleceye" class="link instagram"><span class="fa fa-instagram"></span></a>
                                    <a target='_blank' href="https://www.youtube.com/channel/UCBl2DbvEzWi2QFeJqwKUjNA/featured" class="link instagram"><span class="fa fa-youtube"></span></a>
                                </div>
                            </li>
                            @else
                            <li class="nav-item ml-5">
                                <a class="nav-link login-link" href="{{url('/signup')}}">{{__('header.signup_button')}}</a>
                            </li>
                            <li class="nav-item">
                                <div class="text-right"><a id="signup-btn" class="nav-link btn-signup text-center" href="{{url('/signin')}}">{{__('header.login_button')}}</a></div>
                                <div class="social">
                                    <a target='_blank' href="https://www.facebook.com/telecey" class="link facebook"><span class="fa fa-facebook-square"></span></a>
                                    <a target='_blank' href="https://twitter.com/telecey" class="link twitter"><span class="fa fa-twitter"></span></a>
                                    <a target='_blank' href="https://www.linkedin.com/company/telecey" class="link google-plus"><span class="fa fa-linkedin-in"></span></a>
                                    <a target='_blank' href="https://www.instagram.com/teleceye" class="link instagram"><span class="fa fa-instagram"></span></a>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu" data-logo="{{URL::asset('frontend/assets/img/logo-telco-tales.png')}}"></div>
    </nav>
</header>