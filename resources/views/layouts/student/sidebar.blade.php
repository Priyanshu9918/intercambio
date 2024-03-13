<div class="col-xl-3 col-lg-3 col-md-3">
    <div class="account-wrap">
        <div class="account-main">
            <ul class="side_menu_ds">
                <a href="{{url('/student-pairing-control')}}"><li class="{{Request::segment(1) == 'student-pairing-control' ? 'active' : ''  }}">Courses and Teachers</li></a>
                <!-- <li class="{{Request::segment(1) == 'student-pairing' ? 'active' : ''  }}"><a href="{{url('/student-pairing')}}">Teacher Pairing</a></li> -->
                <a href="{{url('student-payment')}}"><li class="{{Request::segment(1) == 'student-payment' ? 'active' : ''  }}">Payments</li></a>
                <!-- <li class="{{Request::segment(1) == 'student-change-password' ? 'active' : ''  }}"><a href="{{ url('/student-change-password') }}">Change Password</a></li> -->
                <a href="{{ url('/student/support') }}"><li class="{{Request::segment(2) == 'support' ? 'active' : ''  }}">Support</li></a>
            </ul>
        </div>
    </div>
</div>
