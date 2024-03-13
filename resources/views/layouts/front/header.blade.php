<!-- sidebar-information-area-start -->
<div class="sidebar-info side-info">
    <div class="sidebar-logo-wrapper mb-25">
        <div class="row align-items-center">
            <div class="col-xl-6 col-8">
                <div class="sidebar-logo">
                    <a href="index.html"><img src="{{ asset('front/assets/img/logo-w.png')}}" alt="logo-img"></a>
                </div>
            </div>
            <div class="col-xl-6 col-4">
                <div class="sidebar-close-wrapper text-end">
                    <button class="sidebar-close side-info-close"><i class="fal fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-menu-wrapper fix">
        <div class="mobile-menu"></div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<!-- sidebar-information-area-end -->

<!-- header area start -->
<header>
    <div class="h2_header-area header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-sm-7 col-6">
                    <div class="h2_header-left">
                        <div class="h2_header-logo">
                            <a href="#"><img src="{{ asset('front/assets/img/logo.png')}}" alt=""></a>
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
                            @if(Auth::check())
                            <a href="{{url('users/logout')}}" class="header-btn theme-btn theme-btn-medium">Sign Out</a>
                            @else
                            <a href="{{url('/')}}" class="header-btn theme-btn theme-btn-medium">Sign In</a>
                            @endif
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
<!-- header area end -->
