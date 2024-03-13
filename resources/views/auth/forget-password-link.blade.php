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
        <!-- Place favicon.ico in the root directory -->
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
    </head>
     
    <body>
       <!-- sidebar-information-area-start -->
       <header> 
                <div class="h2_header-area header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-sm-7 col-6">
                                <div class="h2_header-left">
                                    <div class="h2_header-logo">
                                        <a href="javascript:void(0)"><img src="assets/img/logo.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 d-none d-xl-block">
                                <div class="h2_header-right">
                                    <nav class="h2_main-menu mobile-menu" id="mobile-menu">
                                    <ul>
                                        <!-- <li class="menu-has-child">
                                                <a href="index.html">Home</a>
                                                <ul class="submenu">
                                                    <li><a href="index.html">Education Main</a></li>
                                                    <li><a href="index-2.html">Online Education</a></li>
                                                    <li><a href="index-3.html">Classic LMS</a></li>
                                                    <li><a href="index-4.html">Elearning Education</a></li>
                                                    <li><a href="index-5.html">College Status</a></li>
                                                    <li><a href="index-6.html">University Campus</a></li>
                                                    <li><a href="index-7.html">Academic Education</a></li>
                                                    <li><a href="index-8.html">Online Courses</a></li>
                                                    <li><a href="index-9.html">Kids Education</a></li>
                                                    <li><a href="index-10.html">Preschool Program</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-has-child">
                                                <a href="course.html">Courses</a>
                                                <ul class="submenu">
                                                    <li><a href="course.html">Courses 1</a></li>
                                                    <li><a href="course-2.html">Courses 2</a></li>
                                                    <li><a href="course-details.html">Course Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-has-child">
                                                <a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="about.html">About</a></li>
                                                    <li><a href="team.html">Teacher</a></li>
                                                    <li><a href="team-details.html">Teacher Details</a></li>
                                                    <li><a href="event.html">Events</a></li>
                                                    <li><a href="event-details.html">Event Details</a></li>
                                                    <li><a href="price.html">Price</a></li>
                                                    <li><a href="gallery.html">Gallery</a></li>
                                                    <li><a href="sign-up.html">Sign Up</a></li>
                                                    <li><a href="sign-in.html">Sign In</a></li>
                                                    <li><a href="404.html">404</a></li>
                                                </ul>
                                            </li>
                                            <li class="menu-has-child">
                                                <a href="blog.html">Blog</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="blog-details.html">Blog Details</a></li>
                                                </ul>
                                            </li>-->
                                            <li><a href="#">Contact Us</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-sm-5 col-6">
                                <div class="h2_header-left">
                                    <div class="h2_header-btn  d-sm-block">
                                        <a href="{{url('/')}}" class="header-btn theme-btn theme-btn-medium">Sign In</a>
                                    </div>
                                    <div class="header-menu-bar d-xl-none ml-10">
                                        <span class="header-menu-bar-icon side-toggle">
                                            <i class="fa-light fa-bars"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <main>
            <!-- sign in area start -->
            <div class="account-area pt-60 pb-120">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-8 col-md-10">
                            <div class="account-wrap">
                                <div class="account-main">
                                    <h3 class="account-title">Create New Password</h3>
                                    <form action="{{ route('ResetPasswordPost') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input id="email" name="email" placeholder="email address" class="form-control" type="hidden" value="{{$data->email ?? ''}}">
                                        <div class="account-form-item mb-15">
                                            <div class="account-form-label">
                                                <label>Your Password</label>
                                            </div>
                                            <div class="account-form-input account-form-input-pass">
                                            <input id="password" name="password" placeholder="password" class="form-control"
                                            type="password" value="{{ old('password') }}">
                                                <span><i class="fa-thin fa-eye" id="togglePassword"></i></span>
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="account-form-item mb-15">
                                            <div class="account-form-label">
                                                <label>Confirm password</label>
                                            </div>
                                            <div class="account-form-input account-form-input-pass">
                                            <input id="password_confirmation" name="password_confirmation"
                                                placeholder="confirm password" class="form-control" type="password"
                                                value="{{ old('password_confirmation') }}">
                                                <span><i class="fa-thin fa-eye" id="togglePassword1"></i></span>
                                            </div>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                        <div class="account-form-button">
                                            <button type="submit" class="account-btn">Next</button>
                                        </div>
                                    </form>
                                    <div class="account-bottom">
                                        <div class="account-bottom-text">
                                            <p>Don’t have an account ?  <a href="signup-account-select.php">Sign Up </a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sign in area end -->

       
        </main>

    <!-- footer area start -->
    <footer class="footer-area">
                <div class="footer-top pt-70 pb-55">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-xl-3 col-lg-5 col-md-5 col-sm-6 d-flex justify-content-xl-center">
                                <div class="footer-widget mb-40">
                                    <h5 class="footer-widget-title">EDUCATION</h5>
                                    <div class="footer-widget-list">
                                        <ul>
                                            <li><a target="_blank" href="https://intercambio.org/english-classes-for-adults/">English Classes for Adults</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/english-classes-for-adults/boulder-county/">Boulder County Program</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/english-classes-for-adults/online-english/">Learn English Online</a></li>
                                            <li><a target="_blank" href="https://app.ccenglish.org/auth/login">CC English Online Login</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/privacy-policy/">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-5 col-md-5 col-sm-6 d-flex justify-content-xl-center">
                                <div class="footer-widget mb-40">
                                    <h5 class="footer-widget-title">GET INVOLVED</h5>
                                    <div class="footer-widget-list">
                                        <ul>
                                            <li><a target="_blank" href="https://intercambio.org/donate/">Ways to Give</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/volunteer-with-us/">Volunteer With Us</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/volunteer-with-us/volunteer-form/">Teach English in Boulder County</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/volunteer-with-us/teach-english-online/">Teach English Online</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/events/event-category/community-conversations/">Join Community Conversations</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-5 col-md-5 col-sm-6 d-flex justify-content-xl-center order-md-4 order-xl-3">
                                <div class="footer-widget mb-40">
                                    <h5 class="footer-widget-title">CURRICULUM AND RESOURCES</h5>
                                    <div class="footer-widget-list">
                                        <ul>
                                            <li><a target="_blank" href="https://intercambio.org/resources-and-training/adult-esl-curriculum/">About Our Curriculum</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/product-category/guide/">Guides</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/shop/">Shop</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/shop/ordering-faqs/">Shop FAQs</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/resources-and-training/">Resources and Training</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-5 col-md-5 col-sm-6 d-flex justify-content-xl-center order-md-4 order-xl-3">
                                <div class="footer-widget mb-40">
                                    <h5 class="footer-widget-title">NEWS AND EVENTS</h5>
                                    <div class="footer-widget-list">
                                        <ul>
                                            <li><a target="_blank" href="https://intercambio.org/blog/">Blog</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/calendar/">Calendar</a></li>
                                            <li><a target="_blank" href="https://intercambio.org/about/contact/">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="copyright-text">
                                    <p>Copyright © 2023 All Rights Reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footer area end -->

            <!-- JS here -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.bundle.min.js"></script>
            <script src="assets/js/swiper-bundle.min.js"></script>
            <script src="assets/js/jquery.meanmenu.min.js"></script>
            <script src="assets/js/wow.min.js"></script>
            <script src="assets/js/jquery.nice-select.min.js"></script>
            <script src="assets/js/jquery.scrollUp.min.js"></script>
            <script src="assets/js/jquery.magnific-popup.min.js"></script>
            <script src="assets/js/odometer.min.js"></script>
            <script src="assets/js/appear.min.js"></script>
            <script src="assets/js/main.js"></script>

    </body>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<script>
       $(document).ready(function() {


        const togglePassword1 = document.querySelector('#togglePassword1');
             const password1 = document.querySelector('#password_confirmation');

             togglePassword1.addEventListener('click', function(e) {
                 // toggle the type attribute
                 const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                 password1.setAttribute('type', type);
                 // toggle the eye slash icon
                 // this.classList.toggle('fa-eye-slash');
                 $(this).toggleClass('fa fa-eye fa-eye-slash');
             });


            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                // this.classList.toggle('fa-eye-slash');
                $(this).toggleClass('fa fa-eye fa-eye-slash');
            });



        });
    </script>
</html>