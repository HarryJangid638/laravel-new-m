<!DOCTYPE html>
<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default" data-bs-theme="light" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta name="robots" content="noindex, nofollow" />
        <title>Admin : @yield('title')</title>

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

        @yield('meta')
        <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
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
        <!-- End Google Tag Manager -->

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
        <link href="{{ asset('css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap') }} rel="stylesheet" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}"/>

        <!-- Core CSS -->
        <!-- build:css assets/vendor/css/theme.css -->

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

        <!-- Vendors CSS -->

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />

        <!-- endbuild -->

        <!-- Vendor -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />

        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/notyf/notyf.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />

        <!-- Helpers -->
        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

        <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js. -->
        <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>

        <!--? Config: Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file. -->

        <script src="{{ asset('assets/js/config.js') }}"></script>
    </head>

    <body>

        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0" style="display: none; visibility: hidden;"></iframe>
        </noscript>

        @yield('content')

        <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/%40algolia/autocomplete-js.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        {{-- <script src="{{ asset('assets/vendor/libs/%40form-validation/popular.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/%40form-validation/auto-focus.js') }}"></script> --}}

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <!-- Page JS -->
        <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.11.0/axios.min.js" integrity="sha512-h9644v03pHqrIHThkvXhB2PJ8zf5E9IyVnrSfZg8Yj8k4RsO4zldcQc4Bi9iVLUCCsqNY0b4WXVV4UB+wbWENA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ asset('assets/vendor/libs/notyf/notyf.js') }}"></script>

        <script type="text/javascript">

            // Create a global Notyf instance
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

            document.addEventListener('DOMContentLoaded', function ()
            {
                @if(session('success'))
                    window.toasterAlert('success', '{{ session('success') }}');
                @endif

                @if(session('error'))
                    window.toasterAlert('error', '{{ session('error') }}');
                @endif

                @if(session('warning'))
                    window.toasterAlert('warning', '{{ session('warning') }}');
                @endif
            });
        </script>
        <script src="{{ asset('assets/js/axios-setup.js') }}"></script>


        @stack('scripts')
    </body>
</html>
