<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('administrator/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('administrator/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('administrator/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('administrator/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('administrator/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('stylesheets')
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('Component.admin.header')
        <!-- ========== App Menu ========== -->
        @include('Component.admin.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                @yield('content')
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('Component.admin.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    {{-- <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div> --}}

    <!-- JAVASCRIPT -->
    <script src="{{ asset('administrator/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('administrator/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('administrator/assets/js/plugins.js') }}"></script>

    @yield('scripts')

    <!-- App js -->
    <script src="{{ asset('administrator/assets/js/app.js') }}"></script>


</body>

</html>
