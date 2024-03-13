<!Doctype html>
<html class="no-js" lang="zxx">

<!-- Mirrored from themephi.net/template/eduan/eduan/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Dec 2023 06:38:16 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Intercambio</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

<head>
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .pre-loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(/loading.gif) center no-repeat #fff;
            opacity: .8;
            background-size: 6%;
            /*display: none;*/
        }
    </style>

</head>

<body>
<div class="pre-loader" style="display: block;"></div>
    @include('layouts.front.header')

    @yield('content')

    @include('layouts.front.footer')

    <!-- JS here -->
    <script src="{{ asset('front/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/appear.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}


    <script>
    $(document).ready(function() {
        $('.pre-loader').hide();
    });
    </script>
    @stack('script')
</body>

</html>
