@extends('layouts.teacher.master')
@section('content')
<style>
.form-check label {
    font-size: 13px;
    line-height: 20px;
}

.form-check-input[type=radio] {
    margin-top: 5px;
}

.form-check-input {
    margin-top: 0.45em;
}

.account-wrap {
    max-width: 100%;
}

.course_details-top {
    padding: 15px 15px;
    box-shadow: 0px 10px 15px rgb(30 30 30 / 7%);
    border: 1px solid #00000014;
}
</style>
                    <div class="col-xl-9 col-lg-9 col-md-9">
                        @php 
                            $payment_history = DB::table('teacher_pairings')->where('teacher_id',Auth::user()->id)->where('status',1)->get();
                        @endphp
                        @if(count($payment_history) > 0)
                        <div class="account-wrap p-4">
                            <span style="display: block;text-align: center; margin-bottom: 28px;"><svg style="width: 79px;fill: #6ea843;height: auto;" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" ><path d="M24,15.5c0,3.584-2.916,6.5-6.5,6.5h-5c-3.584,0-6.5-2.916-6.5-6.5s2.916-6.5,6.5-6.5h1.471c-.137,1.14-.764,2-1.971,2-2.236,.26-4,2.196-4,4.5,0,2.481,2.019,4.5,4.5,4.5h5c2.481,0,4.5-2.019,4.5-4.5,0-1.778-1.045-3.304-2.545-4.034,.236-.631,.404-1.295,.484-1.987,2.378,.967,4.061,3.3,4.061,6.021ZM2,8.5c0-2.481,2.019-4.5,4.5-4.5h5c2.481,0,4.5,2.019,4.5,4.5,0,2.304-1.764,4.24-4,4.5-1.207,0-1.834,.86-1.971,2h1.471c3.584,0,6.5-2.916,6.5-6.5s-2.916-6.5-6.5-6.5H6.5C2.916,2,0,4.916,0,8.5c0,2.721,1.683,5.054,4.061,6.021,.08-.692,.247-1.355,.484-1.987-1.5-.731-2.545-2.256-2.545-4.034Z"/></svg>
                            </span>
                            <p style="text-align: center; max-width: 540px;margin: auto;">You are currently paired with a student already. Teachers are paired with only one student at a time. Please email <a href="mailto:online@intercambio.org" style="color:blue;">online@intercambio.org</a> if you have any questions or concerns!</p>
                        </div>
                        @else
                        <div class="account-wrap">
                            <div class="account-main">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Select a Student</h4>
                                        <ul
                                            style="font-size: 15px;line-height: 20px;list-style: disc outside;margin-bottom: 30px;padding-left: 20px; color:black;">
                                            <li>You have indicated that you would like to work with a student as a
                                                @if($teacher->class_teaching_type == 'Online') Online @else One-to-One @endif tutor. </li>
                                            <li>Please select a student to work with from the waiting list below. </li>
                                            <li>You may filter the list by students' availability and what English level
                                                they have currently achieved.</li>
                                            <li>When you have selected your student, you will receive an email that
                                                outlines the next steps you will need to take to start meeting with your
                                                student.</li>
                                            <li>If you are already paired with a student, you do not have the option to
                                                select another here. However, if you have successfully worked with a
                                                student for at least 2 months, or have completed one book, we would be
                                                happy to pair you with another student. Please contact @if($teacher->class_teaching_type == 'Online') <a href="mailto:online@intercambio.org" style="color:blue;">online@intercambio.org</a> @else <a href="mailto:volunteer@intercambio.org" style="color:blue;">volunteer@intercambio.org</a> @endif
                                                for help.</li>
                                        </ul>
                                    </div>  
                                    <div class="col-md-3">
                                        <div style="border-right: 1px solid #0000001c;">
                                            <h6>FILTER BY:</h6>
                                            <label class="fw-semibold filter_headline text-black">Availability
                                                Day</label>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="availability" type="checkbox" value="sunday"
                                                            id="1c">
                                                        <label class="form-check-label" for="1c">
                                                            Sunday
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="availability" type="checkbox" value="monday"
                                                            id="2c">
                                                        <label class="form-check-label" for="2c">
                                                            Monday
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="availability" type="checkbox" value="tuesday"
                                                            id="3c">
                                                        <label class="form-check-label" for="3c">
                                                            Tuesday
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="availability" type="checkbox" value="wednesday"
                                                            id="4c">
                                                        <label class="form-check-label" for="4c">
                                                            Wednesday
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="availability" type="checkbox" value="thursday"
                                                            id="5c">
                                                        <label class="form-check-label" for="5c">
                                                            Thursday
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="availability" type="checkbox" value="friday"
                                                            id="6c">
                                                        <label class="form-check-label" for="6c">
                                                            Friday
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="availability" type="checkbox" value="saturday"
                                                            id="7c">
                                                        <label class="form-check-label" for="7c">
                                                            Saturday
                                                        </label>
                                                    </div>
                                                </li>
                                            </ul>
                                            <label class="mt-3 fw-semibold filter_headline text-black">English
                                                Level</label>
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="level" type="checkbox" value="intro"
                                                            id="1cc">
                                                        <label class="form-check-label" for="1cc">
                                                            Intro
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="level" type="checkbox" value="1L"
                                                            id="2cc">
                                                        <label class="form-check-label" for="2cc">
                                                            Level 1
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="level" type="checkbox" value="2L"
                                                            id="3cc">
                                                        <label class="form-check-label" for="3cc">
                                                            Level 2
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="level" type="checkbox" value="3L"
                                                            id="4cc">
                                                        <label class="form-check-label" for="4cc">
                                                            Level 3
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="level" type="checkbox" value="4L"
                                                            id="5cc">
                                                        <label class="form-check-label" for="5cc">
                                                            Level 4
                                                        </label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input s_filter" name="level" type="checkbox" value="5L"
                                                            id="6cc">
                                                        <label class="form-check-label" for="6cc">
                                                            Level 5
                                                        </label>
                                                    </div>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-9" id="data_change">
                                        @if($teacher->class_teaching_type == 'Online')
                                        @if(isset($students) && !empty($students))
                                            @foreach($students as $st)
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
                                            @else
                                            <p>Currently no students listed to choose from</p>
                                            @endif
                                        @else 
                                            @if(isset($students))

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
                                            @else
                                                <p>Currently no students listed to choose from</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
    <!-- Modal -->
    <div class="modal fade" id="changestudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" id="confirm-d">

                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).on("click", "#st-submit", function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('teacher.st-data-details') }}",
                type: 'GET',
                data: {
                    st_id: id,
                },
                success: function(data) {
                    $('#confirm-d').replaceWith(data);
                    $('#changestudent').modal('show');
                }
            });

        });
        $(document).on('submit', 'form#createFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");
            $('.pre-loader').show();
            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
            $('.form-control').addClass('disabled-link');
            $('.error-control').addClass('disabled-link');
            if ($('.submit').html() !== loadingText) {
                $('.submit').html(loadingText);
            }
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Submit');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success("Pairing Created Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" + "/teacher-pairing-control";
                        }, 2000);

                    }
                    //show the form validates error
                    if (response.success == false) {
                        $('.pre-loader').hide();
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                            // $('#error-'+error_text).html(response.errors[error_text][0]);
                            // console.log('#error-'+error_text);
                        }
                        // console.log(response.errors);
                    }
                },
                error: function(response) {
                    // alert("Error: " + errorThrown);
                    console.log(response);
                }
            });
            event.stopImmediatePropagation();
            return false;
        });

        $(document).on("click", ".s_filter", function() {
            var availibility = [];
            $('input[name="availability"]:checked').each(function() {
                availibility.push($(this).val()); 
            });

            var level = [];
            $('input[name="level"]:checked').each(function() {
                level.push($(this).val()); 
            });
            $.ajax({
                url: "{{ route('teacher.filter') }}",
                type: 'GET',
                data: {
                    availibility: availibility,
                    level: level,
                },
                success: function(data) {
                    $('#data_change').replaceWith(data);
                }
            });

        });
    </script>
@endpush