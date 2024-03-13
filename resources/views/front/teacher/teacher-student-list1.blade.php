<div class="col-md-9" id="data_change">
    @if($teacher->class_teaching_type == 'Online')
    @if(count($student) > 0)
        @foreach($student as $st)
        @php $student_data_p = DB::table('teacher_pairings')->where('student_id',$st->user_id)->where('status',1)->first(); @endphp
        @if(!isset($student_data_p) )
        @php
            $avaibility = DB::table('availabilities')->where('user_id',$st->user_id)->get();
            $user = DB::table('users')->where('id',$st->user_id)->where('level','!=',null)->first();
        @endphp
            @if($user && isset($st->gender) && ($teacher->gender == $st->gender || $st->gender == 'Non-Binary'))
            <div class="course_details-top mb-20">
                <h3 class="course_details-title">{{$st->name ?? ''}}</h3>
                <div class="course_details-meta">
                    <div class="course_details-meta-left">
                        <div class="course_details-author">
                            
                            <div class="course_details-author-info">
                                <span>Available:</span>
                                <h5>
                                    @foreach($avaibility as $avil)
                                    <a>{{$avil->day}}, {{$avil->time_from}} to
                                        {{$avil->time_to}}</a><br>
                                    @endforeach
                                </h5>
                            </div>
                        </div>
                        <div class="course_details-category">
                            <span>English Level:</span>
                            <h5><a href="">{{$user->level}}</a></h5>
                        </div>

                    </div>
                    <div class="course_details-meta-right">
                        <a href="javascript:void(0)" data-id="{{$st->user_id}}" id="st-submit"
                            class="theme-btn ds-btn-blue px-3 py-1">Select Student</a>
                    </div>
                </div>
            </div>
            @endif
        @endif
        @endforeach
        @endif
    @else 
    @if(count($students) > 0)
        @foreach($students as $student)
            @php
                $student_data = DB::table('student_pairings')->where('user_id',$student->user_id)->where('status',1)->first(); // Fetch student pairing data
                $teacher_data = DB::table('teacher_pairings')->where('student_id',$student->user_id)->where('status',1)->first(); // Fetch teacher pairing data
                $availability = DB::table('availabilities')->where('user_id',$student->user_id)->get(); // Fetch student's availability
                $user = DB::table('users')->where('id',$student->user_id)->where('level','!=',null)->first(); // Fetch user information
            @endphp

            @if(!isset($student_data) && !isset($teacher_data))
                @if($user && isset($student->gender) && ($teacher->gender == $student->gender || $student->gender == 'Non-Binary'))
                    <div class="course_details-top mb-20">
                        <h3 class="course_details-title">{{$student->name ?? ''}}</h3>
                        <div class="course_details-meta">
                            <div class="course_details-meta-left">
                                <div class="course_details-author">
                                    <div class="course_details-author-info">
                                        <span>Available:</span>
                                        <h5>
                                            @foreach($availability as $avail)
                                                <a>{{$avail->day}}, {{$avail->time_from}} to {{$avail->time_to}}</a><br>
                                            @endforeach
                                        </h5>
                                    </div>
                                </div>
                                <div class="course_details-category">
                                    <span>English Level:</span>
                                    <h5><a href="">{{$user->level}}</a></h5>
                                </div>
                            </div>
                            <div class="course_details-meta-right">
                                <a href="javascript:void(0)" data-id="{{$student->user_id}}" id="st-submit" class="theme-btn ds-btn-blue px-3 py-1">Select Student</a>
                            </div>
                        </div>
                    </div>
                @endif
            @else
            @endif
        @endforeach
    @endif
    @endif
</div>