<div class="sidebar-info side-info">
    <div class="sidebar-logo-wrapper mb-25">
        <div class="row align-items-center">
            <div class="col-xl-6 col-8">
                <div class="sidebar-logo">
                    <a href="javascript:void(0)"><img src="assets/img/logo-w.png" alt="logo-img"></a>
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
                            <a href="javascript:void(0)"><img src="{{asset('assets/img/logo.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 d-none d-xl-block">
                    <div class="h2_header-right">
                        <nav class="h2_main-menu mobile-menu" id="mobile-menu">
                            <ul>
                                @php 
                                    $course_d = DB::table('teacher_pairings')->where(['student_id'=>Auth::user()->id,'payment_status'=>'paid','status'=>1])->first();
                                    $type = DB::table('students')->where(['user_id'=>Auth::user()->id,'zip_match'=>'not matched'])->first();
                                @endphp
                                @if(isset($course_d))
                                <li><a href="https://merithub.com/sso/cjhqbn85utj49margtg0?token={{base64_encode(Auth::user()->id)}}" target="_blank">Go to Live Classes</a></li>
                                @endif
                                @if(isset($type))
                                    <li><a href="https://merithub.com/sso/cjhqbn85utj49margtg0?token={{base64_encode(Auth::user()->id)}}" target="_blank">Go to Training Session</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-5 col-6">
                    <div class="h2_header-left">
                        <nav class="h2_main-menu mobile-menu" id="mobile-menu">
                            <ul>
                                <li class="menu-has-child">
                                    <a href="#">
                                        <img src="{{asset('assets/img/users.png')}}" style="width: 30px" class="" />{{Auth::user()->name.' '.Auth::user()->l_name ?? 'user name'}}
                                    </a>
                                    @php 
                                        $students = DB::table('students')->where('user_id',Auth::user()->id)->first();
                                    @endphp
                                    <ul class="submenu">
                                        <!-- <li><a href="#">My Account</a></li> -->
                                        <li><a href="{{ url('/student-change-password') }}">Change Password</a></li>
                                        @if($students->zip_match == 'matched')
                                            <li><a href="{{ url('/student-view-profile') }}">Edit Profile (In-Person)</a></li>
                                        @else
                                            <li><a href="{{ url('/student-view-profile') }}">Edit Profile (Online)</a></li>
                                        @endif
                                        <li><a href="{{ url('/student-time-scheduling') }}">Edit Availability </a></li>
                                        <!-- <li><a href="http://174.138.76.229/intercambio/student-payments.php">Edit
                                                Payment method </a></li> -->
                                        <li><a href="{{url('users/logout')}}">Logout</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
