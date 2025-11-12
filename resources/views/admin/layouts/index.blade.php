<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default" data-bs-theme="semi-dark" data-assets-path="{{ asset('assets') }}" data-template="vertical-menu-template" data-semidark-menu="true">
    <head>
        @props(['title' => 'Admin'])
        <meta charset="utf-8" />
        <title>Admin : @yield('title')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="robots" content="noindex, nofollow" />

        @yield('meta')

        <meta name="description" content="Materialize is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
        <!-- Canonical SEO -->
        <meta name="keywords" content="Materialize bootstrap dashboard, Materialize bootstrap 5 dashboard, themeselection, html dashboard, web dashboard, frontend dashboard, responsive bootstrap theme" />
        <meta property="og:title" content="Materialize bootstrap Dashboard by Pixinvent" />
        <meta property="og:type" content="product" />
        <meta property="og:url" content="https://themeforest.net/item/materialize-material-design-admin-template/11446068" />
        <meta property="og:image" content="https://ts-assets.b-cdn.net/pi-assets/materialize/landing-page/materialize-hero-image.png" />
        <meta property="og:description" content="Materialize is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
        <meta property="og:site_name" content="Pixinvent" />
        <link rel="canonical" href="https://themeforest.net/item/materialize-material-design-admin-template/11446068" />

        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "GTM-5J3LMKC");
        </script>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

        @include('admin.layouts.partials.styles')

        <!-- Helpers -->
        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

        <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>

        <script src="{{ asset('assets/js/config.js') }}"></script>

        <style type="text/css">
            .offcanvas.offcanvas-end {
                min-width: 50% !important;
            }
            .template-customizer-open-btn {
                display: none !important;
            }
        </style>

    @stack('styles')

    </head>

    <body>
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
        </noscript>

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                @include('admin.layouts.partials.aside')

                <div class="menu-mobile-toggler d-xl-none rounded-1">
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                        <i class="ri ri-menu-line icon-base"></i>
                        <i class="ri ri-arrow-right-s-line icon-base"></i>
                    </a>
                </div>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                    @include('admin.layouts.partials.header')

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        @yield('content')
                            <!-- Content -->
                            @include('admin.layouts.partials.footer')
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>

        @include('admin.layouts.partials.scripts')

        <script type="text/javascript">
            // Create the Notyf instance once
            // Use the Notyf class method to create a new instance and assign to window.toaster

            window.toaster = new Notyf({
                ripple: true,
                duration: 5000,
                position: { x: "right", y: "top" },
                dismissible: true,
                types: [
                    {
                        type: "info",
                        icon: { className: "icon-base ri ri-information-fill icon-md text-white", tagName: "i" },
                        className: "notyf__info",
                        background: config.colors.info,
                    },
                    {
                        type: "warning",
                        icon: { className: "icon-base ri ri-alert-fill icon-md text-white", tagName: "i" },
                        className: "notyf__warning",
                        background: config.colors.warning,
                    },
                    {
                        type: "success",
                        icon: { className: "icon-base ri ri-checkbox-circle-fill icon-md text-white", tagName: "i" },
                        className: "notyf__success",
                        background: config.colors.success,
                    },
                    {
                        type: "error",
                        icon: { className: "icon-base ri ri-close-circle-fill icon-md text-white", tagName: "i" },
                        className: "notyf__error",
                        background: config.colors.danger,
                    }
                ]
            });

            // Define toasterAlert globally so it can be used anywhere
            window.toasterAlert = function(type, message)
            {
                window.toaster.dismissAll();
                window.toaster.open({ type: type, message: message });
            };

            @if(session('success'))
                toasterAlert('success', '{{ session('success') }}');
            @endif

            @if(session('error'))
                toasterAlert('error', '{{ session('error') }}');
            @endif

            @if(session('warning'))
                toasterAlert('warning', '{{ session('warning') }}');
            @endif

        </script>
        <script src="{{ asset('assets/js/axios-setup.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
        <script src="{{ asset('assets/js/extended-ui-blockui.js') }}"></script>
        @stack('scripts')
    </body>
</html>
