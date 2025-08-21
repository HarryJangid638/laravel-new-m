<!DOCTYPE html>
<html class="no-js" lang="en">
    @props(['title', 'metaDescription' => '', 'pageName' => 'default'])
    <head>
        <meta charset="utf-8" />
        <title>Ds:{{$title}} </title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg" />
        <!-- Template CSS -->
        <x-assets.front.css :files="[
            ['path' => asset('assets/css/plugins/animate.min.css')],
            ['path' => asset('assets/css/main.css?v=6.0')],

        ]" />
        @stack('css')

    </head>

    <body>
        <!-- Modal -->
        @include('front.elements.modal')
        <!-- Quick view -->
        @include('front.elements.quick-view')

        <x-layout.front.header />

        @include('front.elements.mobile-header')

        <!--End header-->
        {{ $slot }}

        <x-layout.front.footer />

        <!-- Preloader Start -->
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="text-center">
                        <img src="{{ asset('assets/imgs/theme/loading.gif') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Vendor JS-->
        <x-assets.front.js :files="[
            ['path' => asset('assets/js/vendor/modernizr-3.6.0.min.js')],
            ['path' => asset('assets/js/vendor/jquery-3.6.0.min.js')],
            ['path' => asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')],
            ['path' => asset('assets/js/vendor/bootstrap.bundle.min.js')],
            ['path' => asset('assets/js/plugins/slick.js')],
            ['path' => asset('assets/js/plugins/jquery.syotimer.min.js')],
            ['path' => asset('assets/js/plugins/waypoints.js')],
            ['path' => asset('assets/js/plugins/wow.js')],
            ['path' => asset('assets/js/plugins/perfect-scrollbar.js')],
            ['path' => asset('assets/js/plugins/magnific-popup.js')],
            ['path' => asset('assets/js/plugins/select2.min.js')],
            ['path' => asset('assets/js/plugins/counterup.js')],
            ['path' => asset('assets/js/plugins/jquery.countdown.min.js')],
            ['path' => asset('assets/js/plugins/images-loaded.js')],
            ['path' => asset('assets/js/plugins/isotope.js')],
            ['path' => asset('assets/js/plugins/scrollup.js')],
            ['path' => asset('assets/js/plugins/jquery.vticker-min.js')],
            ['path' => asset('assets/js/plugins/jquery.theia.sticky.js')],
            ['path' => asset('assets/js/plugins/jquery.elevatezoom.js')],
            ['path' => asset('assets/js/main.js?v=6.0')],
            ['path' => asset('assets/js/shop.js?v=6.0')],
        ]" />
        @stack('js')
    </body>
</html>
