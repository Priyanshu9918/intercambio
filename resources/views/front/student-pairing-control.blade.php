@extends('layouts.student.master')
@section('content')
    <style>
        .form-check label {
            font-size: 13px;
            line-height: 20px;
        }

        .form-check-input[type=radio] {
            margin-top: 5px;
        }

        .btn-data {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    @php
        $student = DB::table('students')
            ->where('user_id', Auth::user()->id)
            ->where('zip_match', '!=', 'not matched')
            ->first();
    @endphp
    <div class="col-xl-9 col-lg-9 col-md-9">
        @if (isset($student))
            @php
                $g_class = DB::table('courses')
                    ->where('level', Auth::user()->level)
                    ->where('user_type', 'Student')
                    ->where('class_type','Group Class')
                    ->orderBy('created_at', 'desc')
                    ->first();
            @endphp
            <div class="">
                <div class="">
                    @php
                        $payment_history = DB::table('student_pairings')
                            ->where('user_id', Auth::user()->id)
                            ->where('status', 1)
                            ->get();

                        $student_pairing = DB::table('teacher_pairings')
                            ->where('student_id', Auth::user()->id)
                            ->where('status', 1)
                            ->first();
                        @endphp
                    @if(count($payment_history) > 0)
                        <div class="blog-item  mb-30">
                            <p style="text-align: center;font-size: 19px;line-height: 40px;"> You are currently on the
                                waitlist for Intercambio English Classes.<br> Please email <a
                                    href="mailto:online@intercambio.org"
                                    style="color:#118fac;font-weight: 500;">online@intercambio.org</a> if you have any
                                questions. Thank you for your patience!</p>
                        </div>
                    @elseif($student->is_group_class == 0 && !isset($student_pairing))
                    <div class="blog-item  mb-30">
                            <p style="text-align: center;font-size: 19px;line-height: 40px;"> You are currently on the
                                waitlist for Intercambio English Classes.<br> Please email <a
                                    href="mailto:volunteer@intercambio.org"
                                    style="color:#118fac;font-weight: 500;">volunteer@intercambio.org</a> if you have any
                                questions. Thank you for your patience!</p>
                        </div>
                    @else
                        @if (isset($student_pairing))
                            <div class="blog-item blog-item-h mb-30">
                                <div class="blog-img">
                                    <a href="#"><img src="{{ asset('front/assets/img/pairing.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="blog-content flex-fill">
                                    @php
                                        $st_data = DB::table('users')
                                            ->where('id', $student_pairing->teacher_id)
                                            ->where('status', 1)
                                            ->first();
                                    @endphp
                                    <h4>Current Pairing</h4>
                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <p class="mb-0 lh-1"> <small>Teacher Name </small></p>
                                            <p class="mb-0 fw-bold text-black">{{ $st_data->name ?? '' }}</p>
                                        </div>
                                        <div class="col-md-6  mt-3">
                                            <p class="mb-0 lh-1"> <small>Total Classes Taken </small></p>
                                            <p class="mb-0 fw-bold text-black">0 </p>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <p class="mb-0 lh-1"> <small>Student English Level </small></p>
                                            <p class="mb-0 fw-bold text-black">{{ $st_data->level ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <a class="btn-small-ds mt-3 me-3" data-bs-toggle="modal"
                                            data-bs-target="#changestudent" href="#">View Details </a>
                                        @if ($student_pairing->payment_status == 'unpaid')
                                            <a class="btn-small-ds mt-3 me-3" href="javascript:void(0)"
                                                data-id="{{ $student_pairing->id }}" id="r_pay">Remaining Payments </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            @php
                                $student_history = DB::table('teacher_pairings')
                                    ->where('student_id', Auth::user()->id)
                                    ->get();
                            @endphp
                            <div class="blog-item  mb-30">
                                <h4>Course History</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No.</th>
                                            <th scope="col">Teacher Name</th>
                                            <th scope="col">Batch Name</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($student_history))
                                            @foreach ($student_history as $key => $st_h)
                                                @php
                                                    $user_d = DB::table('users')
                                                        ->where('id', $st_h->teacher_id)
                                                        ->where('status', 1)
                                                        ->first();
                                                    $course_l = DB::table('courses')
                                                        ->where('level', $user_d->level)
                                                        ->where('class_type', $st_h->class_type)
                                                        ->where('user_type', 'Student')
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ $user_d->name ?? null }}</td>
                                                    <td>{{ $st_h->batch_name ?? null }}</td>
                                                    <td>{{ $st_h->created_at }}</td>
                                                    @if ($st_h->status == 1)
                                                        <td>In progess</td>
                                                    @else
                                                        <td>{{ $st_h->updated_at ?? '' }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @else
                            @if (isset($g_class))
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item  mb-3">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button style="color: #000000;font-weight: 500;background-color: #ffffff;"
                                                class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                {{ $g_class->title ?? null }}
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @php
                                                    $batches = explode(',', $g_class->batch_id);
                                                    $batches = array_filter($batches, 'strlen');

                                                    $batches_name = explode(',', $g_class->batch_name);
                                                    $batches_name = array_filter($batches_name, 'strlen');
                                                @endphp
                                                @if (count($batches) > 0 && count($batches_name))
                                                    @foreach ($batches as $key => $batche)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="batch_selection"
                                                                data-value="{{ $g_class->id }}|{{ $batches[$key] }}|{{ $batches_name[$key] }}"
                                                                id="b_ids{{$key}}">
                                                            <label class="form-check-label" for="b_ids{{$key}}">
                                                                {{ $batches_name[$key] ?? '' }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                        id="error-val"></p>
                                                    <a class="btn-small-ds mt-3 me-3" href="javascript:void(0)"
                                                        id="stripe">Next</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h3>No Any Class Found</h3>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        @else
            @php
                $student_pairing = DB::table('teacher_pairings')
                    ->where('student_id', Auth::user()->id)
                    ->where('status', 1)
                    ->first();
            @endphp
            @if (isset($student_pairing))
                <div class="blog-item blog-item-h mb-30">
                    <div class="blog-img">
                        <a href="#"><img src="{{ asset('front/assets/img/pairing.png') }}" alt=""></a>
                    </div>
                    <div class="blog-content flex-fill">
                        @php
                            $st_data = DB::table('users')
                                ->where('id', $student_pairing->teacher_id)
                                ->where('status', 1)
                                ->first();
                        @endphp
                        <h4>Current Pairing</h4>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <p class="mb-0 lh-1"> <small>Teacher Name </small></p>
                                <p class="mb-0 fw-bold text-black">{{ $st_data->name ?? '' }}</p>
                            </div>
                            <div class="col-md-6  mt-3">
                                <p class="mb-0 lh-1"> <small>Total Classes Taken </small></p>
                                <p class="mb-0 fw-bold text-black">0 </p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p class="mb-0 lh-1"> <small>Student English Level </small></p>
                                <p class="mb-0 fw-bold text-black">{{ Auth::user()->level ?? '' }}</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <a class="btn-small-ds mt-3 me-3" data-bs-toggle="modal" data-bs-target="#changestudent"
                                href="#">View Details </a>
                            @if ($student_pairing->payment_status == 'unpaid')
                                <a class="btn-small-ds mt-3 me-3" href="javascript:void(0)"
                                    data-id="{{ $student_pairing->id }}" id="r_pay">Remaining Payments </a>
                            @endif
                        </div>

                    </div>
                </div>
                @php
                    $student_history = DB::table('teacher_pairings')
                        ->where('student_id', Auth::user()->id)
                        ->get();
                @endphp
                <div class="blog-item  mb-30">
                    <h4>Course History</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">S.No.</th>
                                <th scope="col">Teacher Name</th>
                                <th scope="col">Batch Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($student_history))
                                @foreach ($student_history as $key => $st_h)
                                    @php
                                        $user_d = DB::table('users')
                                            ->where('id', $st_h->teacher_id)
                                            ->where('status', 1)
                                            ->first();
                                        $course_l = DB::table('courses')
                                            ->where('level', $user_d->level)
                                            ->where('class_type', $st_h->class_type)
                                            ->where('user_type', 'Student')
                                            ->first();
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $user_d->name ?? null }}</td>
                                        <td>{{ $st_h->batch_name ?? null }}</td>
                                        <td>{{ $st_h->created_at }}</td>
                                        @if ($st_h->status == 1)
                                            <td>In progess</td>
                                        @else
                                            <td>{{ $st_h->updated_at ?? '' }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @else
                <div class="blog-item  mb-30">
                    <p style="text-align: center;font-size: 19px;line-height: 40px;"> You are currently on the waitlist for
                        Intercambio English Classes.<br> Please email <a href="mailto:online@intercambio.org"
                            style="color:#118fac;font-weight: 500;">online@intercambio.org</a> if you have any questions.
                        Thank you for your patience!</p>
                    <!-- <p style="text-align: center;font-size: 19px;line-height: 40px;"> You are not yet confirmed for your Intercambio Class. <br><span>Please email <a href="mailto:volunteer@intercambio.org" style="color:#118fac;font-weight: 500;">volunteer@intercambio.org</a> if you have any questions!</span></p> -->
                </div>
            @endif
        @endif
    </div>

    <!-- sign in area end -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
            <div class="modal-content" style="height:650px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Stripe Payment</h5>
                </div>
                <div class="modal-body">
                    <main id="data-rand">

                    </main>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="plan-mode" tabindex="-1" role="dialog" aria-labelledby="plan-modeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Stripe Payment</h5>
                </div>
                <div class="modal-body" id="sub_plan">
                    <input type="hidden" name="plan_data" id="plan_val">
                    <h2 class="fs-5">Term Basis Plan</h2>
                    @php
                        $basic_price = DB::table('payments')->where('class_type', 'Group Class')->where('payment_type', 'terms basis')->orderBy('created_at', 'desc')->first();
                    @endphp
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="plan_selection" data-value="60"
                            data-type="basic" data-credit="16">
                        <label class="form-check-label">
                            <span>$60 | 16 Classes</span>
                            {{-- <span>${{$basic_price->fee ?? ''}} | {{$basic_price->no_of_classes}} Classes</span> --}}
                        </label>
                    </div>
                    {{-- <hr>
                <h2 class="fs-5">Subscriptions Plan</h2>
                @php
                    $sub_price = DB::table('payments')->where('class_type','Group Class')->where('payment_type','subscriptions')->orderBy('created_at','desc')->first();
                @endphp
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="plan_selection"
                        data-value="{{$sub_price->fee ?? ''}}" data-type="subscription" data-credit="0">
                    <label class="form-check-label">
                        <span>${{$sub_price->fee ?? ''}}</span>
                    </label>
                </div> --}}
                </div>
                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-val1"></p>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" class="stripe btn btn-primary">Pay Now</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="changestudent" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @php
                    if (isset($student_pairing)) {
                        $stude_v = DB::table('teachers')
                            ->where('user_id', $student_pairing->teacher_id)
                            ->where('status', 1)
                            ->first();
                        $state = DB::table('states')
                            ->where('id', $stude_v->state)
                            ->first();
                    } else {
                        $stude_v = null;
                    }
                @endphp
                <div class="modal-body">
                    <!-- <h6>You have selected:</h6> -->
                    <div class="course_details-top mb-0">
                        <h3 class="course_details-title text-center pb-3">{{ $stude_v->name ?? '' }}</h3>
                        <div class="course_details-meta flex-wrap ">
                            <div class="course_details-meta-left flex-wrap">
                                <div class="course_details-author">
                                    <div>
                                        <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                    </div>
                                    <div class="course_details-author-info">
                                        <span>City:</span>
                                        <h5><a href="#">{{ $stude_v->city ?? '' }}</a></h5>
                                    </div>
                                </div>
                                <div class="course_details-author">
                                    <div>
                                        <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                    </div>
                                    <div class="course_details-author-info">
                                        <span>State:</span>
                                        <h5><a href="#">{{ $state->name ?? '' }}</a></h5>
                                    </div>
                                </div>
                                <!-- <div class="course_details-author">
                                    <div>
                                        <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>

                                    </div>
                                    <div class="course_details-author-info">
                                        <span>Email:</span>
                                        <h5><a href="#">{{ $stude_v->email ?? '' }}</a></h5>
                                    </div>
                                </div> -->
                                <div class="course_details-author">
                                    <div>
                                        <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                        </svg>


                                    </div>
                                    <div class="course_details-author-info">
                                        <span>Student English Level:</span>
                                        <h5><a href="#">{{ Auth::user()->level ?? '' }}</a></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="supportmsg1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1Title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="course_details-top mb-0 text-center">
                        <div class="course_details-meta flex-wrap ">
                            <div class="course_details-meta-left flex-wrap">
                                <p>Sorry, this level is full. Please contact <a href="mailto:online@intercambio.org"
                                        style="color:blue;"> online@intercambio.org </a> for assistance.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cl_sup1">Close</button>
            </div> -->
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).on('click', '#stripe', function() {
            var val_id = $('input[name="batch_selection"]:checked').attr('data-value');
            var id_val = $('input[name="batch_selection"]:checked').val();
            if (id_val == null || id_val === undefined) {
                $('#error-val').html('Firstly! You need to select a batch to proceed with the payment!');
                return;
            }
            $('#plan_val').val(val_id);
            $('#error-val').html('');
            $.ajax({
                url: "{{ route('student.groupcheck') }}",
                type: "get",
                data: {
                    'value': val_id,
                },
                success: function(response) {
                    if (response.success == true) {
                        $('#plan-mode').modal('show');
                    }
                    if (response.success1 == true) {
                        $('#supportmsg1').modal('show');
                    }
                }
            });

        });
        $(document).on('submit', 'form#createFrm', function(event) {
            $('p.error_container').html("");
            var formData = new FormData($(this)[0]);
            $('.pre-loader').show();
            var form = $(this);
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
                data: formData, // Use formData instead of data
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    //console.log(response);
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Save');
                    }, 2000);
                    if (response.success == true) {
                        $('.pre-loader').hide();

                        toastr.success("Payment created Successfully");

                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'Payment Created Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // })
                        window.setTimeout(() => {
                            // window.location.href = "{{ url('/student/student-my-order') }}";
                            location.reload();
                        }, 1000);
                    }
                    //show the form validates error
                    if (response.success == false) {
                        $('#error1').html(response.errors);
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                            // $('#error-'+error_text).html(response.errors[error_text][0]);
                            // console.log('#error-'+error_text);
                            $('.pre-loader').hide();
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

        $(document).on('click', '.stripe', function() {
            var id_val = $('input[name="plan_selection"]:checked').val();
            if (id_val == null || id_val === undefined) {
                $('#error-val1').html('Firstly! You need to select a batch to proceed with the payment!');
                return;
            }
            $('#error-val').html('');
            var value = $('input[name="plan_selection"]:checked').attr('data-value');
            var type = $('input[name="plan_selection"]:checked').attr('data-type');
            var classes = $('input[name="plan_selection"]:checked').attr('data-credit');
            var datas = $('#plan_val').val();
            var pair_id = $('#pair_id').val();
            $.ajax({
                url: "{{ route('student.stripe-val') }}",
                type: "get",
                data: {
                    'value': value,
                    'type': type,
                    'classes': classes,
                    'datas': datas,
                    'pair_id': pair_id,
                },
                success: function(response) {
                    console.log(response);
                    $('#data-rand').replaceWith(response);
                    $('#plan-mode').modal('hide');
                    $('#exampleModalCenter').modal('show');
                }
            });
        });

        $(document).on('click', '#r_pay', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('student.pay_bal') }}",
                type: "get",
                data: {
                    'id': id,
                },
                success: function(response) {
                    $('#sub_plan').replaceWith(response);
                    $('#plan-mode').modal('show');
                }
            });
        });
    </script>
@endpush
