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

.course_details-author {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-basis: 45%;
}
#changedd h4{
    color: #6ea843;
}
</style>
</head>
<div class="col-xl-9 col-lg-9 col-md-9">
    @php
        $group_check = DB::table('teachers')->where('user_id',Auth::user()->id)->where('status',1)->first();
    @endphp
    @if(isset($group_check) && $group_check->class_type_preference != 'Group Classes')
    <div class="">
        <div class="">
            <div class="blog-item blog-item-h mb-30">
                <div class="blog-img">
                    <a href="#"><img src="{{ asset('front/assets/img/pairing.png')}}" alt=""></a>
                </div>
                @php
                $student = DB::table('teacher_pairings')->where('teacher_id',Auth::user()->id)->where('status',1)->first();
                @endphp
                @if(isset($student))
                <div class="blog-content flex-fill">
                    @php
                    $st_data = DB::table('users')->where('id',$student->student_id)->where('status',1)->first();
                    @endphp
                    <h4>Current Pairing</h4>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <p class="mb-0 lh-1"> <small>Student Name </small></p>
                            <p class="mb-0 fw-bold text-black">{{$st_data->name}}</p>
                        </div>
                        <div class="col-md-6  mt-3">
                            <p class="mb-0 lh-1"> <small>Total Classes Taken </small></p>
                            <p class="mb-0 fw-bold text-black">0 </p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <p class="mb-0 lh-1"> <small>Student English Level </small></p>
                            <p class="mb-0 fw-bold text-black">{{$st_data->level}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a class="btn-small-ds mt-3 me-3" data-bs-toggle="modal" data-bs-target="#changestudent"
                            href="#">View Details </a>
                        <a class="btn-small-ds mt-3" data-bs-toggle="modal" data-bs-target="#changedd" href="#">Finish
                            Current Course </a>
                    </div>

                </div>
                @else
                <div class="blog-content flex-fill">
                    <h5>Currently, you are not paired with any student! Please email @if($group_check->class_teaching_type == 'Online') <a href="mailto:online@intercambio.org" style="color:blue;">online@intercambio.org</a> @else <a href="mailto:volunteer@intercambio.org" style="color:blue;">volunteer@intercambio.org</a> @endif if you have any questions. Thank you for your patience!</h5>
                </div>
                @endif
            </div>
            @php
            $student_history = DB::table('teacher_pairings')->where('teacher_id',Auth::user()->id)->orderBy('created_at','desc')->get();
            @endphp
            <div class="blog-item  mb-30">
                <h4>Course History</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S.No.</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($student_history))
                        @foreach($student_history as $key=>$st_h)
                        @php
                        $user_d = DB::table('users')->where('id',$st_h->student_id)->where('status',1)->first();
                    //    dd($user_d);
                        // $course_l = DB::table('courses')->where('level',$user_d->level)->where('class_type',$st_h->class_type)->where('user_type','Student')->first();
                        @endphp
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{ $user_d->name ?? null}}</td>
                            <td>{{$st_h->batch_name ?? null}}</td>
                            <td>{{$st_h->created_at}}</td>
                            @if($st_h->status == 1)
                            <td>In progess</td>
                            @else
                            <td>{{$st_h->updated_at ?? ''}}</td>
                            @endif
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
        @php
            $student_history1 = DB::table('teacher_pairings')->where('teacher_id',Auth::user()->id)->where('status',1)->orderBy('created_at','desc')->get();
        @endphp
        <div class="blog-item  mb-30">
            <h4>Class Module</h4>
            @if(count($student_history1))
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Batch Name</th>
                        <th scope="col">Paring Date</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($student_history1 as $key=>$st_h)
                        @php
                        $user_d = DB::table('users')->where('id',$st_h->student_id)->where('status',1)->first();
                        @endphp
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{ $user_d->name ?? null}}</td>
                            <td>{{$st_h->batch_name ?? null}}</td>
                            <td>{{$st_h->created_at}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            @else
                <p style="text-align: center;font-size: 19px;line-height: 40px;"> You are not yet confirmed for your Intercambio Class. <br><span>Please email <a href="mailto:volunteer@intercambio.org"  style="color:#118fac;font-weight: 500;">volunteer@intercambio.org</a> if you have any questions!</span></p>
            @endif
        </div>
    @endif
</div>
<!-- Modal -->
<div class="modal fade" id="changestudent" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @php
            if(isset($student)){
            $stude_v = DB::table('students')->where('user_id',$student->student_id)->where('status',1)->first();
            $state = DB::table('states')->where('id',$stude_v->state)->first();
            }else{
            $stude_v = null;
            }
            @endphp
            <div class="modal-body">
                <!-- <h6>You have selected:</h6> -->
                <div class="course_details-top mb-0">
                    <h3 class="course_details-title text-center pb-3">{{$stude_v->name ?? ''}}</h3>
                    <div class="course_details-meta flex-wrap ">
                        <div class="course_details-meta-left flex-wrap">
                            <div class="course_details-author">
                                <div>
                                    <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                </div>
                                <div class="course_details-author-info">
                                    <span>City:</span>
                                    <h5><a href="#">{{$stude_v->city ?? ''}}</a></h5>
                                </div>
                            </div>
                            <div class="course_details-author">
                                <div>
                                    <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                </div>
                                <div class="course_details-author-info">
                                    <span>State:</span>
                                    <h5><a href="#">{{$state->name ?? ''}}</a></h5>
                                </div>
                            </div>
                            <div class="course_details-author">
                                <div>
                                    <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>

                                </div>
                                <div class="course_details-author-info">
                                    <span>Email:</span>
                                    <h5><a href="#">{{$stude_v->email ?? ''}}</a></h5>
                                </div>
                            </div>
                            <div class="course_details-author">
                                <div>
                                    <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                    </svg>


                                </div>
                                <div class="course_details-author-info">
                                    <span>Student English Level:</span>
                                    <h5><a href="#">{{$st_data->level ?? ''}}</a></h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="changedd" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <!-- <h6>You have selected:</h6> -->
                <div class="course_details-top mb-0 text-center">
                    <h3 class="course_details-title text-center pb-3">Finish Current Course</h3>
                    <div class="course_details-meta flex-wrap ">
                        <div class=" flex-wrap">
                            <!-- <p>Are you sure want to finsh the current course.</p> -->
                            <h4>Congratulations!</h4>
                           <p> You have completed the Final Progress Check on Lesson 16. Please email <b>online@intercambio.org</b> with the score your student received. </p> 
                        <div class="card py-2 px-3 text-start mb-3">
                        <p class="fw-bold text-black mb-0">Ready to start the next level? </p>
                        <p class="mb-0">By selecting "Yes", you and your student will be promoted to the next level. You will both gain access to the next set of resources, including the digital book and teaching slides. </p>
                        </div>
                        <div class="card py-2  px-3 text-start">
                        <p class="fw-bold text-black mb-0">Student Books:</p>
                        <p class="mb-0">Your student will receive a hard copy of the next book. Books ship out on Wednesdays and typically take 5-7 business days to arrive. The student will receive tracking information to their email address. </p>  
                        </div>
                        <p class="my-2 pt-2">If you or your student need any assistance, please email us at online@intercambio.org</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-block mx-auto">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="errorw"></p>
                        <div class="account-form-button  mb-0">
                            <button type="button" data-id="{{$student->id ?? ''}}" class="account-btn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
        $(document).on("click", ".account-btn", function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('teacher.finish-course') }}",
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(data) {
                    if(data.success == true){
                        toastr.success("Your request has been successfully submitted!");
                        window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/admin/courses";
                            location.reload();
                            }, 2000);
                    }
                    if(data.success1 == false){
                        $('#errorw').text('Your request already has been submitted!');
                    }
                    if(data.success == false){
                        toastr.warning("Some problem come in this script!");
                        location.reload();
                    }
                }
            });

        });
</script>
@endpush