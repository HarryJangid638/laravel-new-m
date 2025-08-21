<!DOCTYPE html>
<html lang="en">
    <head>
        @props(['title' => 'Admin'])
        <meta charset="utf-8" />
        <title>Admin : {{ $title }}</title>

        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @yield('meta')

        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg" />
        <!-- Template CSS -->
        <x-assets.admin.js :files="[
            ['path' => asset('assets/admin/js/vendors/color-modes.js')],
        ]" />

        <x-assets.admin.css :files="[
            ['path' => asset('assets/admin/css/main.css?v=6.0')],
            ['path' => asset('assets/admin/datatables.net-bs4/css/dataTables.bootstrap4.css')],
        ]" />

        <style type="text/css">
            #loader-overlay {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                width: 100vw; height: 100vh;
                background: rgba(255,255,255,0.7);
                z-index: 9999;
                display: none;
                align-items: center;
                justify-content: center;
                pointer-events: all;
            }
            .loader-spinner {
                border: 8px solid #f3f3f3;
                border-top: 8px solid #3498db;
                border-radius: 50%;
                width: 70px;
                height: 70px;
                animation: spin 1s linear infinite;
            }
            @keyframes spin {
                0% { transform: rotate(0deg);}
                100% { transform: rotate(360deg);}
            }
        </style>

    @stack('styles')

    </head>

    <body>
        <div class="screen-overlay"></div>

        <x-layout.admin.aside />

        <main class="main-wrap">

            <x-layout.admin.header />

            <div id="loader-overlay">
                <div class="loader-spinner"></div>
            </div>

            {{ $slot }}

            <!-- content-main end// -->
            <x-layout.admin.footer />
        </main>

        <x-assets.admin.js :files="[
            ['path' => asset('assets/admin/js/vendors/jquery-3.6.0.min.js')],
            ['path' => asset('assets/admin/js/vendors/bootstrap.bundle.min.js')],
            ['path' => asset('assets/admin/js/vendors/select2.min.js')],
            ['path' => asset('assets/admin/js/vendors/perfect-scrollbar.js')],
            ['path' => asset('assets/admin/js/vendors/jquery.fullscreen.min.js')],
            ['path' => asset('assets/admin/js/vendors/chart.js')],
            ['path' => asset('assets/admin/js/main.js?v=6.0')],
            ['path' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11'],
            ['path' => asset('assets/admin/js/custom-chart.js')],
            ['path' => asset('assets/admin/js/custom.js')],
            ['path' => asset('assets/admin/js/axios.min.js')],
            ['path' => asset('assets/admin/DataTables/datatables.min.js')],
            ['path' => asset('assets/admin/datatable/datatable-basic.init.js')],
        ]" />

        <script type="text/javascript">

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

        @stack('scripts')
    </body>
</html>
