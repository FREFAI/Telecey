<footer>
    <section class="footer-Content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-xs-6 col-mb-12">
                    <div class="widget">
                        <div class="footer-logo mb-0">
                            <img src="{{URL::asset('frontend/assets/img/logo-telco-tales.png')}}" alt="" width="200">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-6 col-mb-12">
                    <div class="widget">
                        <ul class="menu">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">How Does it Work</a></li>
                            <li><a href="#">How do we get our Information</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-6 col-mb-12">
                    <div class="widget">
                        <ul class="menu">
                            <li><a href="{{url('/signup')}}">Sign Up</a></li>
                            <li><a href="{{url('/signin')}}">Sign In</a></li>
                            <li><a href="{{url('/plans')}}">Plans</a></li>
                            <li><a href="{{url('/devices')}}">Devices</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="site-info text-left">
                        <ul class="footer-menu">
                            <li><a href="{{url('/')}}">About</a></li>
                            <li><a href="#">Terms of Service </a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Cookie Policy</a></li>
                            <li><a href="#">Contact US</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="site-info text-right footer-res">
                        <p>Telecey © {{date('Y')}}. All rights Reserved </p>
                        <div class="footer-social mt-2">
                            <a href="" class="link facebook"><span class="fa fa-facebook-square"></span></a>
                            <a href="" class="link twitter"><span class="fa fa-twitter"></span></a>
                            <a href="" class="link google-plus"><span class="fa fa-linkedin-in"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</footer>

<a href="#" class="back-to-top">
    <i class="lni-chevron-up"></i>
</a>

<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>

@if(!array_key_exists('popup',$_COOKIE)) 
<div class="cookies_popup">
    <p class="cookie_text">
    We use cookies to provide the services and features offered on our website, and to improve our user experience. <br><a class="learn-more" href="https://www.learn-about-cookies.com/">Learn more</a>
    </p>
    <button class="btn btn-info" id="cookie_dismiss">Got it</button>
</div>
@endif

