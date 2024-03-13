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
</style>
<div class="col-xl-9 col-lg-9 col-md-9">
    <div class="">
        <div class="">
            <div class="blog-item blog-item-h mb-30">
                <div class="blog-img">
                    <a href="#"><img src="{{ asset('front/assets/img/pairing.png')}}" alt=""></a>
                </div>
                @php
                $student =
                DB::table('teacher_pairings')->where('student_id',Auth::user()->id)->where('status',1)->first();
                @endphp
                @if(isset($student))
                <div class="blog-content flex-fill">
                    @php
                    $st_data = DB::table('users')->where('id',$student->teacher_id)->where('status',1)->first();
                    @endphp
                    <h4>Current Pairing</h4>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <p class="mb-0 lh-1"> <small>Teacher Name </small></p>
                            <p class="mb-0 fw-bold text-black">{{$st_data->name ?? ''}}</p>
                        </div>
                        <div class="col-md-6  mt-3">
                            <p class="mb-0 lh-1"> <small>Total Classes Taken </small></p>
                            <p class="mb-0 fw-bold text-black">0 </p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <p class="mb-0 lh-1"> <small>Student English Level </small></p>
                            <p class="mb-0 fw-bold text-black">{{$st_data->level ?? ''}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a class="btn-small-ds mt-3 me-3" data-bs-toggle="modal" data-bs-target="#changestudent"
                            href="#">View Details </a>
                    </div>

                </div>
                @else
                <div class="blog-content flex-fill">
                    <h4>Current time you are not pairing with any teacher!</h4>
                </div>
                @endif
            </div>
            @php
            $student_history = DB::table('teacher_pairings')->where('student_id',Auth::user()->id)->get();
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
                        @if(count($student_history))
                        @foreach($student_history as $key=>$st_h)
                        @php
                        $user_d = DB::table('users')->where('id',$st_h->teacher_id)->where('status',1)->first();
                        $course_l =
                        DB::table('courses')->where('level',$user_d->level)->where('class_type',$st_h->class_type)->where('user_type','Student')->first();
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


</div>
<!-- Modal -->
<div class="modal fade" id="changestudent" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @php
            if(isset($student)){
            $stude_v = DB::table('teachers')->where('user_id',$student->teacher_id)->where('status',1)->first();
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
                                    <h5><a href="#">{{$stude_v->email ?? ''}}</a></h5>
                                </div>
                            </div> -->
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
    $('#plan-mode').modal('show');
});
$(document).on('submit', 'form#createFrm', function(event) {
    $('p.error_container').html("");
    var formData = new FormData($(this)[0]);
    // $('.pre-loader').show();
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
                    // window.location.href = "{{url('/student/student-my-order')}}";
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
    $.ajax({
        url: "{{ route('student.stripe-val') }}",
        type: "get",
        data: {
            'value': value,
            'type': type,
            'classes': classes,
            'datas': datas,
        },
        success: function(response) {
            console.log(response);
            $('#data-rand').replaceWith(response);
            $('#plan-mode').modal('hide');
            $('#exampleModalCenter').modal('show');
        }
    });
});
</script>
@endpush