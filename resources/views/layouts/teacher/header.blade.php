<!-- sidebar-information-area-start -->
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
                        <div class="col-xl-6 d-none d-xl-block">
                            <div class="h2_header-right">
                                <nav class="h2_main-menu mobile-menu" id="mobile-menu">
                                   <ul>
                                    @php 
                                        $course_d = DB::table('teacher_pairings')->where(['teacher_id'=>Auth::user()->id,'payment_status'=>'paid','status'=>1])->first();
                                        if(isset($course_d)){
                                            if($course_d->class_type == 'Group Classes'){
                                                $c_class_type = 'Group Class';
                                                $coursesss = DB::table('courses')->where(['level'=>$course_d->course_level,'class_type'=>$c_class_type,'user_type'=>'Teacher','course_type'=>'training'])->first();
                                            }else{
                                                $c_class_type = $course_d->class_type;
                                                $coursesss = DB::table('courses')->where(['level'=>$course_d->course_level,'class_type'=>$c_class_type,'user_type'=>'Teacher','course_type'=>'training'])->first();
                                            }
                                        }
                                    @endphp
                                    @if(isset($course_d))
                                    <li><a href="https://merithub.com/sso/cjhqbn85utj49margtg0?token={{base64_encode(Auth::user()->id)}}" target="_blank">Go to Session</a></li>
                                    @endif
                                    <li><a href="https://merithub.com/sso/cjhqbn85utj49margtg0?token={{base64_encode(Auth::user()->id)}}" target="_blank">Go to Training Session</a></li>

                                   </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-5 col-6">
                            <div class="h2_header-left">
                            <nav class="h2_main-menu mobile-menu" id="mobile-menu">
                                   <ul>
                                       <li class="menu-has-child">
                                            <a href="#">
                                                <img src="{{asset('assets/img/users.png')}}" style="width: 30px" class="" /> {{Auth::user()->name.' '.Auth::user()->l_name ?? 'user name'}}
                                            </a>
                                            @php 
                                                $teachers = DB::table('teachers')->where('user_id',Auth::user()->id)->first();
                                            @endphp
                                            <ul class="submenu">
                                                <li><a href="{{url('/teacher-view-profile')}}">Profile ({{$teachers->class_type_preference ?? 'Online'}})</a></li>
                                               <li><a href="{{url('/teacher-change-password')}}">Change Password</a></li>
                                               @php 
                                                    $student = DB::table('teacher_pairings')->where('teacher_id',Auth::user()->id)->where('status',1)->get();
                                                    $group_check = DB::table('teachers')->where('user_id',Auth::user()->id)->where('status',1)->first();
                                                @endphp
                                                @if(isset($group_check) && $group_check->class_type_preference != 'Group Classes')
                                                    @if(count($student) > 0)
                                                        <li><a href="{{url('/teacher-student-list')}}">Select a student </a></li>
                                                    @else
                                                        <li><a href="{{url('/teacher-student-list')}}">Select a student </a></li>
                                                    @endif
                                                @endif
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
