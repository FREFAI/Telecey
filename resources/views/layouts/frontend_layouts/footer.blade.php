<footer>
    @yield('footer')
    <section class="footer-Content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-xs-6 col-mb-12">
                    <div class="widget">
                        <div class="footer-logo mb-0">
                            <img src="{{URL::asset('frontend/assets/img/footer-logo.png')}}" alt="" width="200">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-6 col-mb-12">
                    <div class="widget">
                        <ul class="menu">
                            <li><a href="{{url('/')}}">{{__('footer.home')}}</a></li>
                            <li><a href="{{\request()->path() != 'en' || \request()->path() != 'fr' ? url('/') : '' }}#how-does-it-work">{{__('footer.how_dose')}}</a></li>
                            <li><a href="{{\request()->path() != 'en' || \request()->path() != 'fr' ? url('/') : '' }}#our-information">{{__('footer.how_do')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-6 col-mb-12 last-widget">
                    <div class="widget">
                        <ul class="menu">
                            <li><a href="{{url('/signup')}}">{{__('footer.signup')}}</a></li>
                            <li><a href="{{url('/signin')}}">{{__('footer.login')}}</a></li>
                            <li><a href="{{url('/plans')}}">{{__('footer.plan')}}</a></li>
                            <li><a href="{{url('/devices')}}">{{__('footer.device')}}</a></li>
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
                    <div class="site-info text-left footer-lef">
                        <ul class="footer-menu">
                            <li><a href="{{url('/')}}">{{__('footer.about')}}</a></li>
                            <li><a href="{{getSettings()->terms_and_conditions != '' ? url('/terms-conditions') : '#'}}">{{__('footer.term')}} </a></li>
                            <li><a href="{{getSettings()->privacy_policy != '' ? url('/privacy-policy') : '#'}}">{{__('footer.privacy')}}</a></li>
                            <li><a href="{{getSettings()->cookie_policy != '' ? url('/cookie-policy') : '#'}}">{{__('footer.cookie')}}</a></li>
                            <li><a href="#">{{__('footer.contact')}}</a></li>
                        </ul>
                        <p>Telecey © {{date('Y')}}. {{__('footer.copyright')}} </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="site-info text-right footer-res">
                        <div class="footer-social mt-2">
                            <a target='_blank' href="https://www.facebook.com/telecey" class="link facebook"><span class="fa fa-facebook-square"></span></a>
                            <a target='_blank' href="https://twitter.com/telecey" class="link twitter"><span class="fa fa-twitter"></span></a>
                            <a target='_blank' href="https://www.linkedin.com/company/telecey" class="link google-plus"><span class="fa fa-linkedin-in"></span></a>
                            <a target='_blank' href="https://www.reddit.com/user/Telecey" class="link twitter"><span class="fa fa-reddit-alien"></span></a>
                            <a target='_blank' href="https://www.pinterest.ca/telecey" class="link twitter"><span class="fa fa-pinterest"></span></a>
                            <a target='_blank' href="https://www.instagram.com/teleceye" class="link twitter"><span class="fa fa-instagram"></span></a>
                            <a target='_blank' href="https://www.youtube.com/channel/UCBl2DbvEzWi2QFeJqwKUjNA/featured" class="link twitter"><span class="fa fa-youtube"></span></a>
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
    <div class="container">
        <p class="cookie_text">
        We use cookies to provide the services and features offered on our website, and to improve our user experience. <br><a class="learn-more" target="_blank" href="https://www.learn-about-cookies.com/">Learn more</a>
        </p>
        <button type="button" class="btn btn-info" id="cookie_dismiss">Got it</button>
    </div>
</div>
@endif

