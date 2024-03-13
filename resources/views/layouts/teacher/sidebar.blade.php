<div class="col-xl-3 col-lg-3 col-md-3">
    <div class="account-wrap">
        <div class="account-main">
            <ul class="side_menu_ds" >
                @php 
                    $student = DB::table('teacher_pairings')->where('teacher_id',Auth::user()->id)->where('status',1)->get();
                    $group_check = DB::table('teachers')->where('user_id',Auth::user()->id)->where('status',1)->first();
                @endphp
                @if(isset($group_check) && $group_check->class_type_preference != 'Group Classes')
                <a href="{{url('teacher-student-list')}}"><li class="{{Request::segment(1) == 'teacher-student-list' ? 'active' : ''  }}">Select a Student</li></a>
                @endif
                <a href="{{url('teacher-pairing-control')}}"><li class="{{Request::segment(1) == 'teacher-pairing-control' ? 'active' : ''  }}">Courses and Students</li></a>
                <a href="{{url('teacher-support')}}"><li class="{{Request::segment(1) == 'teacher-support' ? 'active' : ''  }}">Support</li></a>
            </ul>
        </div>
    </div>
</div>