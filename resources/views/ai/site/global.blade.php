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


    <!-- Header Bottom Wrap Start -->
    <div class="header-bottom-wrap header-sticky">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header default-menu-style position-relative justify-content-center">
                        <!-- brand logo -->
                        <div class="">
                            <a href="{{route('ai-home')}}">
                                <img src="/assets/images/logo/ai-logo.png" width="240"
                                     class="img-fluid" >
                            </a>
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


    <div style="height: 200px"></div>
</div>

<!--====================  scroll top ====================-->
<a href="#" class="scroll-top" id="scroll-top">
    <i class="arrow-top fal fa-long-arrow-up"></i>
    <i class="arrow-bottom fal fa-long-arrow-up"></i>
</a>

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

@yield('customJs')


</body>

</html>

