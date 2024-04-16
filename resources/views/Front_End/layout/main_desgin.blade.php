<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>Syriatra | @yield('title')</title>
        <!-- Required Meta Tags Always Come First -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('front_assest/assets/favicon.png') }}">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Rubik:300,400,500,700,900&display=swap" rel="stylesheet">

        <!-- CSS Implementing Plugins -->
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/font-awesome/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/css/font-mytravel.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/animate.css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/hs-megamenu/src/hs.megamenu.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/flatpickr/dist/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/slick-carousel/slick/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/custombox/dist/custombox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/fancybox/jquery.fancybox.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/dzsparallaxer/dzsparallaxer.css') }}">
        <link rel="stylesheet" href="{{ asset('front_assest/assets/vendor/ion-rangeslider/css/ion.rangeSlider.css') }}">
        <!-- CSS MyTravel Template -->
        <link rel="stylesheet" href="{{ asset('front_assest/assets/css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('back_assest/assets/plugins/notifications/css/lobibox.min.css') }}" />

        @yield('style')
    </head>
    <body>
        <!-- include  Header  -->
        @hasSection('home_header')
        @include('Front_End.layout.header')
        @else
        @include('Front_End.layout.pages_header')
        @endif
        <!-- include  Content  -->
        @yield('content')
        <!-- include  Footer  -->
        @include('Front_End.layout.footer')
        <!-- include  Preload  -->
        @hasSection('preload')
        @include('Front_End.layout.preload')
        @endif
            <!-- include  Back to top button  -->
        @include('Front_End.layout.back_to_top')   <!-- JS Plugins Init. -->

        <!-- JS Global Compulsory -->
        <script src="{{ asset('front_assest/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{ asset('front_assest/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
        <script src="{{ asset('front_assest/assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{ asset('front_assest/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

        <!-- JS Implementing Plugins -->
        <script src="{{ asset('front_assest/assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
        <script src="{{ asset('front_assest/assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
        <script src="{{ asset('front_assest/assets/vendor/flatpickr/dist/flatpickr.min.js')}}"></script>
        <script src="{{ asset('front_assest/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
        <script src="{{ asset('front_assest/assets/vendor/slick-carousel/slick/slick.js')}}"></script>
         <!-- JS Implementing Plugins -->
         <script src="{{ asset('front_assest/assets/vendor/gmaps/gmaps.min.js')}}"></script>
         <script src="{{ asset('front_assest/assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
         <script src="{{ asset('front_assest/assets/vendor/custombox/dist/custombox.min.js')}}"></script>
         <script src="{{ asset('front_assest/assets/vendor/custombox/dist/custombox.legacy.min.js')}}"></script>
         <script src="{{ asset('front_assest/assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
         <script src="{{ asset('front_assest/assets/js/components/hs.fancybox.js')}}"></script>

        <!-- JS MyTravel -->
        <script src="{{ asset('front_assest/assets/js/hs.core.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.header.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.unfold.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.validation.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.show-animation.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.range-datepicker.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.selectpicker.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.go-to.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.slick-carousel.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.quantity-counter.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.g-map.js')}}"></script>
        <script src="{{ asset('front_assest/assets/js/components/hs.modal-window.js')}}"></script>
    <!--notification js -->
	<script src="{{ asset('back_assest/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
	<script src="{{ asset('back_assest/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('back_assest/assets/js/multiple-uploader.js') }}"></script>

        <script>
            $(window).on('load', function () {
                // initialization of HSMegaMenu component
                $('.js-mega-menu').HSMegaMenu({
                    event: 'hover',
                    pageContainer: $('.container'),
                    breakpoint: 1199.98,
                    hideTimeOut: 0
                });

                // Page preloader
                setTimeout(function () {
                    $('#jsPreloader').fadeOut(500)
                }, 800);
            });

            $(document).on('ready', function () {
                // initialization of header
                $.HSCore.components.HSHeader.init($('#header'));

                // initialization of unfold component
                $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

                // initialization of show animations
                $.HSCore.components.HSShowAnimation.init('.js-animation-link');

                // initialization of datepicker
                $.HSCore.components.HSRangeDatepicker.init('.js-range-datepicker');

                // initialization of select
                $.HSCore.components.HSSelectPicker.init('.js-select');

                // initialization of quantity counter
                $.HSCore.components.HSQantityCounter.init('.js-quantity');

                // initialization of slick carousel
                $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

                // initialization of go to
                $.HSCore.components.HSGoTo.init('.js-go-to');
            });
        </script>
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
    </body>
</html>
