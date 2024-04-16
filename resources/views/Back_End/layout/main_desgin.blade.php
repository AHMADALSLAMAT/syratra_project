<!DOCTYPE html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('front_assest/assets/favicon.png') }}" type="image/png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--plugins-->
    <link href="{{ asset('back_assest/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
        rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('back_assest/assets/plugins/notifications/css/lobibox.min.css') }}" />

    <link href="{{ asset('back_assest/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('back_assest/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- loader-->
    <link href="{{ asset('back_assest/assets/css/pace.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('back_assest/assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <!--Theme Styles-->
    <link href="{{ asset('back_assest/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('back_assest/assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/css/header-colors.css') }}" rel="stylesheet" />
    <link href="{{ asset('back_assest/assets/css/main.css') }}" rel="stylesheet" type="text/css">
<style>
     .error-message{
        color: red;
        margin: 10px;
        font-weight: 400
    }
</style>
    <title> Syriatra | Dashboard</title>
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">

        <!--start header-->
        @hasSection ('login')
        @yield('content')
        <footer class="footer">
            <div class="footer-text">
                Copyright © 2023. All right reserved.
            </div>
        </footer>
        <!--end footer-->
        @else
        @include('Back_End.layout.header')
        <!--end header-->

        <!--start sidebar-->
        @include('Back_End.layout.sidebar')
        <!--end sidebar-->
        <!--start Contant-->
        @yield('content')
        <!--End Contant-->
        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->
        <!--start footer-->
        <footer class="footer">
            <div class="footer-text">
                Copyright © 2023. All right reserved.
            </div>
        </footer>
        <!--end footer-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        @endif
    </div>
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('back_assest/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('back_assest/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    {{--<script src="{{ asset('back_assest/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>--}}
    <script src="{{ asset('back_assest/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    {{--<script src="{{ asset('back_assest/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>--}}
      <!--notification js -->
	<script src="{{ asset('back_assest/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{ asset('back_assest/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/multiple-uploader.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    @yield('js')
    @if(session()->has('error'))
	<script>
    	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-x-circle',
		msg: "{{ session('error') }}"
	});
    </script>

    @endif
    @if(session()->has('success'))
	<script>
    	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-check-circle',
		msg: "{{ session('success') }}"
	});
    </script>
    @endif
    @if(session()->has('errors'))
    @foreach ($errors as $error)
	<script>
    	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		continueDelayOnInactiveTab: false,
		position: 'top right',
		icon: 'bx bx-check-circle',
		msg: "{{ session('error') }}"
	});
    </script>
    @endforeach
    @endif
    <script src="{{ asset('back_assest/assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/form-select2.js') }}"></script>
     <script src="{{ asset('back_assest/assets/js/pace.min.js') }}"></script>
    <!--app-->
    <script src="{{ asset('back_assest/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/table-datatable.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/app.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/index2.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/todo.js') }}"></script>
    {{--<script>
        new PerfectScrollbar(".best-product");
    </script>--}}

</body>

</html>
