<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default" data-bs-theme="light" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template">
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

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
        <link href="{{ asset('css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap') }}" rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}"/>

        <!-- Core CSS -->
        <!-- build:css assets/vendor/css/theme.css -->

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

        <!-- Vendors CSS -->

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/notyf/notyf.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />

        <!-- endbuild -->

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

        <!-- Page CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}" />

        <!-- Helpers -->
        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

        <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>

        <script src="{{ asset('assets/js/config.js') }}"></script>

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

        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleave-zen/cleave-zen.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script src="{{ asset('assets/vendor/libs/notyf/notyf.js') }}"></script>


        <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>


        <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.11.0/axios.min.js" integrity="sha512-h9644v03pHqrIHThkvXhB2PJ8zf5E9IyVnrSfZg8Yj8k4RsO4zldcQc4Bi9iVLUCCsqNY0b4WXVV4UB+wbWENA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Page JS -->
        <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>

        <script type="text/javascript">
            // Create the Notyf instance once
            window.toaster = new Notyf({
                duration: 5000,
                ripple: true,
                dismissible: true,
                position: { x: "right", y: "top" },
                types: [
                    {
                        type: "info",
                        background: "#17a2b8",
                        icon: { className: "ri ri-information-fill text-white", tagName: "i" }
                    },
                    {
                        type: "warning",
                        background: "#ffc107",
                        icon: { className: "ri ri-alert-fill text-white", tagName: "i" }
                    },
                    {
                        type: "success",
                        background: "#28a745",
                        icon: { className: "ri ri-checkbox-circle-fill text-white", tagName: "i" }
                    },
                    {
                        type: "error",
                        background: "#dc3545",
                        icon: { className: "ri ri-close-circle-fill text-white", tagName: "i" }
                    }
                ]
            });

            // Define toasterAlert globally so it can be used anywhere
            window.toasterAlert = function(type, message) {
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
        <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>

        @stack('scripts')
    </body>
</html>
