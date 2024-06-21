<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}} - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}">

    <!-- CSS
        ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">

    <!-- Font Family CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/vendor/cerebrisans.css')}}">

    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/vendor/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/vendor/linea-icons.css')}}">

    <!-- Swiper slider CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/plugins/swiper.min.css')}}">

    <!-- animate-text CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/plugins/animate-text.css')}}">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/plugins/animate.min.css')}}">

    <!-- Light gallery CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/plugins/lightgallery.min.css')}}">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->

    <!-- <link rel="stylesheet" href="/assets/css/vendor/vendor.min.css">
        <link rel="stylesheet" href="/assets/css/plugins/plugins.min.css"> -->

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
</head>

<body>


<div class="preloader-activate preloader-active open_tm_preloader">
    <div class="preloader-area-wrap">
        <div class="spinner d-flex justify-content-center align-items-center h-100">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
</div>

<!--====================  header area ====================-->
<div class="header-area header-area--default">

    <!-- Header Top Wrap Start -->
    <div class="header-top-wrap border-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center top-message">{{__('site/template.topTitle')}}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Top Wrap End -->

    <!-- Header Bottom Wrap Start -->
    <div class="header-bottom-wrap header-sticky">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header default-menu-style position-relative">

                        <!-- brand logo -->
                        <div class="header__logo">

                            <a href="{{route('index')}}">
                                <img src="/assets/images/logo/ai-logo.png" width="160" height="48"
                                     class="img-fluid" alt="">
                            </a>
                        </div>

                        <!-- header midle box  -->
                        <div class="header-midle-box">
                            <div class="header-bottom-wrap d-md-block d-none">
                                <div class="header-bottom-inner">
                                    <div class="header-bottom-left-wrap">
                                        <!-- navigation menu -->
                                        <div class="header__navigation d-none d-xl-block">
                                            <nav class="navigation-menu primary--menu">

                                                <ul>
                                                    <li>
                                                        <a href="{{route('index')}}"><span>Home</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('about')}}"><span>About</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('outsource-your-translations')}}"><span>Outsource</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('type-of-translators')}}"><span>Type of Translators</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('our-vetting-process')}}"><span>Our Vetting Process</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('contact-us')}}"><span>Contact Us</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('index')}}"><span>Blog</span></a>
                                                    </li>

                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- header right box -->
                        <div class="header-right-box">
                            <div class="header-right-inner" id="hidden-icon-wrapper">

                                <!-- language-menu -->

                                <div class="service-menu">
                                    <ul>
                                        <li>
                                            <a href="#" class="">
                                                <span class="wpml-ls-native">Service</span>
                                            </a>

                                            <ul class="ls-sub-menu">

                                                @if (Auth::guest())
                                                    <li class="">
                                                        <a href="{{route('login')}}" class="">Login</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="{{route('register')}}" class="">Register</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ url('/logout') }}"
                                                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                            Logout
                                                        </a>
                                                        <form id="logout-form" action="{{ url('/logout') }}"
                                                              method="POST"
                                                              style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    </li>
                                                @endif


                                            </ul>

                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <!-- mobile menu -->
                            <div class="mobile-navigation-icon d-block d-xl-none" id="mobile-menu-trigger">
                                <i></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Wrap End -->


</div>
<!--====================  End of header area  ====================-->

<div id="main-wrapper">

    @yield('page')

    <!--====================  footer area ====================-->
    <div class="footer-area-wrapper bg-gray">
        <div class="footer-area section-space--ptb_80">
            <div class="container">
                <div class="row footer-widget-wrapper">
                    <div class="col-lg-6 col-md-6 col-sm-6 footer-widget">
                        <div class="footer-widget__logo mb-30">
                            <img src="/assets/images/logo/ai-logo.png" width="160" height="48"
                                 class="img-fluid" alt="">
                        </div>
                        <ul class="footer-widget__list">
                            <li>From <a href="https://epictranslations.com/" class="text-color-primary">EPIC
                                    Translations</a></li>
                            <li>28175 Haggerty RD, Suite 3139, Novi, MI 48377</li>
                            <li><a href="mailto:translate@aitranslationhub.co" class="hover-style-link">translate@aitranslationhub.co</a>
                            </li>
                            <li><a href="tel:888-214-2053" class="hover-style-link text-black font-weight--bold">888-214-2053</a>
                            </li>
                            <li><a href="https://aitranslationhub.co" class="hover-style-link text-color-primary">aitranslationhub.co</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 footer-widget">
                        <h6 class="footer-widget__title mb-20">Translation Services</h6>
                        <ul class="footer-widget__list">
                            <li><a href="{{route('index')}}" class="hover-style-link">FREE AI Translations</a></li>
                            <li><a href="#" class="hover-style-link">Hire Translators</a></li>
                            <li><a href="{{route('outsource-your-translations')}}" class="hover-style-link">Outsource
                                    Your Translations</a></li>
                            <li><a href="#" class="hover-style-link">Apply As A Translator</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 footer-widget">
                        <h6 class="footer-widget__title mb-20">Quick links</h6>
                        <ul class="footer-widget__list">
                            <li><a href="#" class="hover-style-link">Terms of Payment</a></li>
                            <li><a href="#" class="hover-style-link">Privacy Policy</a></li>
                            <li><a href="{{route('how-do-we-work')}}" class="hover-style-link">How Do We Work?</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright-area section-space--pb_30">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <span class="copyright-text">&copy; 2023 Ai Translation Hub. <a
                                href="https://aitranslationhub.co/">All Rights Reserved.</a></span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <ul class="list ht-social-networks solid-rounded-icon">

                            <li class="item">
                                <a href="https://twitter.com/epic_trans" target="_blank" aria-label="Twitter"
                                   class="social-link hint--bounce hint--top hint--primary">
                                    <i class="fab fa-twitter link-icon"></i>
                                </a>
                            </li>
                            <li class="item">
                                <a href="https://www.facebook.com/epictranslations/" target="_blank"
                                   aria-label="Facebook"
                                   class="social-link hint--bounce hint--top hint--primary">
                                    <i class="fab fa-facebook-f link-icon"></i>
                                </a>
                            </li>
                            <li class="item">
                                <a href="https://www.instagram.com/epictranslations/" target="_blank"
                                   aria-label="Instagram"
                                   class="social-link hint--bounce hint--top hint--primary">
                                    <i class="fab fa-instagram link-icon"></i>
                                </a>
                            </li>
                            <li class="item">
                                <a href="https://www.linkedin.com/company/31716" target="_blank" aria-label="Linkedin"
                                   class="social-link hint--bounce hint--top hint--primary">
                                    <i class="fab fa-linkedin link-icon"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of footer area  ====================-->
</div>

<!--====================  scroll top ====================-->
<a href="#" class="scroll-top" id="scroll-top">
    <i class="arrow-top fal fa-long-arrow-up"></i>
    <i class="arrow-bottom fal fa-long-arrow-up"></i>
</a>
<!--====================  End of scroll top  ====================-->

<!--====================  mobile menu overlay ====================-->
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <div class="mobile-menu-overlay__inner">
        <div class="mobile-menu-overlay__header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8">
                        <!-- logo -->
                        <div class="logo">
                            <a href="index.html">
                                <img src="/assets/images/logo/ai-logo.png" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-4">
                        <!-- mobile menu content -->
                        <div class="mobile-menu-content text-end">
                            <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay__body">
            <nav class="offcanvas-navigation">
                <ul>
                    <li>
                        <a href="{{route('index')}}"><span>Home</span></a>
                    </li>
                    <li>
                        <a href="{{route('about')}}"><span>About</span></a>
                    </li>
                    <li>
                        <a href="{{route('outsource-your-translations')}}"><span>Outsource</span></a>
                    </li>
                    <li>
                        <a href="{{route('type-of-translators')}}"><span>Type of Translators</span></a>
                    </li>
                    <li>
                        <a href="{{route('our-vetting-process')}}"><span>Our Vetting Process</span></a>
                    </li>
                    <li>
                        <a href="{{route('contact-us')}}"><span>Contact Us</span></a>
                    </li>
                    <li>
                        <a href="{{route('index')}}"><span>Blog</span></a>
                    </li>
                    <li class="has-children">
                        <a href="{{route('dashboard')}}">Service</a>
                        <ul class="sub-menu">
                            @if (Auth::guest())
                                <li><a href="{{route('login')}}"><span>Login</span></a></li>
                                <li><a href="{{route('register')}}"><span>Register</span></a></li>
                            @else
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!--====================  End of mobile menu overlay  ====================-->


<!-- JS
============================================ -->
<!-- Modernizer JS -->
<script src="/assets/js/vendor/modernizr-2.8.3.min.js"></script>

<!-- jQuery JS -->
<script src="/assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="/assets/js/vendor/bootstrap.min.js"></script>

<!-- wow JS -->
<script src="/assets/js/plugins/wow.min.js"></script>

<!-- Swiper Slider JS -->
<script src="/assets/js/plugins/swiper.min.js"></script>

<!-- Light gallery JS -->
<script src="/assets/js/plugins/lightgallery.min.js"></script>

<!-- Waypoints JS -->
<script src="/assets/js/plugins/waypoints.min.js"></script>

<!-- Counter down JS -->
<script src="/assets/js/plugins/countdown.min.js"></script>

<!-- Isotope JS -->
<script src="/assets/js/plugins/isotope.min.js"></script>

<!-- Masonry JS -->
<script src="/assets/js/plugins/masonry.min.js"></script>

<!-- ImagesLoaded JS -->
<script src="/assets/js/plugins/images-loaded.min.js"></script>

<!-- Wavify JS -->
<script src="/assets/js/plugins/wavify.js"></script>

<!-- jQuery Wavify JS -->
<script src="/assets/js/plugins/jquery.wavify.js"></script>

<!-- circle progress JS -->
<script src="/assets/js/plugins/circle-progress.min.js"></script>

<!-- counterup JS -->
<script src="/assets/js/plugins/counterup.min.js"></script>

<!-- animation text JS -->
<script src="/assets/js/plugins/animation-text.min.js"></script>

<!-- Vivus JS -->
<script src="/assets/js/plugins/vivus.min.js"></script>

<!-- Some plugins JS -->
<script src="/assets/js/plugins/some-plugins.js"></script>


<!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->

<!--
<script src="/assets/js/plugins/plugins.min.js"></script>
-->

<!-- Main JS -->
<script src="/assets/js/main.js"></script>


</body>

</html>

