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
    @include('layouts.teacher.header')
    <main>
        <div class="account-area pt-4 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    @include('layouts.teacher.sidebar')

                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="exampleModalCenter12" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
                <!-- <span aria-hidden="true">&times;</span> -->
                </button>
            </div>
            <div class="modal-body">
                <!-- <h6>You have selected:</h6> -->
                <div class="course_details-top mb-0 text-center">
                    <h3 class="course_details-title text-center pb-3">Reason</h3>
                    <div class="course_details-meta flex-wrap ">
                        <div class="course_details-meta-left flex-wrap">
                            <p>You are currently paired with a student already. Teachers are paired with only one student at a time. Please email <a href="mailto:online@intercambio.org" style="color:blue;">online@intercambio.org</a> if you have any questions or concerns!</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-block mx-auto">
                        <div class="account-form-button  mb-0">
                            <!-- <button type="button" class="account-btn ">Confirm</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>
    @include('layouts.teacher.footer')

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
    $(document).on('click', '#c_status1', function() {
        $('#exampleModalCenter12').modal('show');
    });
    </script>
    @stack('script')
</body>

</html>
