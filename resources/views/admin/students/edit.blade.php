@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">students/</span> Edit students </h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit students </h5>
                    <form class="card-body" action="{{ route('admin.students.edit', ['id' => base64_encode($students->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $students->name ?? '' }}" placeholder="students-name">
                                    <label for="name">Student Name</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="l_name" name="l_name" class="form-control" value="{{ $students->l_name ?? '' }}" placeholder="students-name">
                                    <label for="l_name">Student Last Name</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-l_name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="email" name="email" value="{{ $students->email ?? '' }}" class="form-control" placeholder="students-email">
                                    <label for="email">Student Email</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="phone" name="phone" value="{{ $students->phone ?? '' }}" class="form-control" placeholder="students-number">
                                    <label for="phone">Student Phone</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone"></p>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" id="birthday" name="birthday" value="{{ $students->birthday ?? '' }}" class="form-control" placeholder="students-number">
                                    <label for="birthday">Student birth day</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-birthday">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline ">
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="">Select Gender</option>
                                        <option value="male" @if ($students->gender == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($students->gender == 'female') selected @endif>Female
                                        </option>
                                        <option value="non-binary" @if ($students->gender == 'non-binary') selected @endif>Non
                                            Binary</option>
                                    </select>
                                    <label class="form-label" for="gender">Select Gender<b class="text-danger">*</b></label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-gender"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="street_address" name="street_address" value="{{ $students->street_address }}" class="form-control">
                                    <label for="street_address" class="text-dark">Street Address
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-street_address"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="city" name="city" value="{{ $students->city }}" class="form-control">
                                    <label for="city" class="text-dark">City
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-city">
                                </p>
                            </div>
                            <div class="col-md-6">
                                @php
                                $state = DB::table('states')
                                ->where('status', 1)
                                ->get();
                                $name = DB::table('states')
                                ->where('id', $students->state)
                                ->first();

                                @endphp
                                <div class="form-floating form-floating-outline ">
                                    <select name="state" id="state" class="form-select">
                                        <option value="{{ $name ? $name->id : '' }}">
                                            {{ $name ? $name->short_name : '--' }}
                                        </option>
                                        @foreach ($state as $st)
                                        <option value="{{ $st->id }}">{{ $st->short_name }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-dark" for="state">Select State<b class="text-danger">*</b></label>

                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-state"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="zip" name="zip" value="{{ $students->zip }}" class="form-control">
                                    <label for="zip" class="text-dark">Zip Code
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-zip">
                                </p>
                            </div>
                            <div class="col-md-6">
                                @php
                                $time_zone = DB::table('time_zones')
                                ->where('status', 1)
                                ->get();
                                $name = DB::table('time_zones')
                                ->where('id', $students->time_zone)
                                ->first();

                                @endphp
                                <div class="form-floating form-floating-outline ">
                                    <select name="time_zone" id="time_zone" class="form-select">
                                        <option value="{{ $name ? $name->id : '' }}">
                                            {{ $name ? $name->timezone : '--' }}
                                        </option>
                                        @foreach ($time_zone as $tz)
                                        <option value="{{ $tz->id }}">{{ $tz->timezone }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-dark" for="state">Select Time Zone<b class="text-danger">*</b></label>

                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-time_zone"></p>
                                </div>
                            </div>

                            <h5>Please tell us about yourself</h5>


                            @php
                            $question = DB::table('questions')
                            ->where('status', 1)
                            ->where('question_type', 0)
                            ->where('user_type', 0)
                            ->get();
                            $studentques = DB::table('question_entries')
                            ->where('user_id', $students->user_id)
                            ->get();
                            foreach ($studentques as $ques) {
                            $q[$ques->question_id] = $ques->option_id;
                            }
                            @endphp
                            @foreach ($question as $tz)
                            @php
                            $question_options = DB::table('question_options')
                            ->where('status', 1)
                            ->where('question_id', $tz->id)
                            ->get();
                            @endphp
                            <div class="col-md-6">

                                <div class="form-floating form-floating-outline ">
                                    <select name="question[{{ $tz->id }}]" id="question" class="form-select">
                                        <option value="">Select</option>
                                        @foreach ($question_options as $ques)
                                        <option value="{{ $ques->id }}" @if (isset($q[$tz->id]) && $q[$tz->id] == $ques->id) selected @endif>
                                            {{ $ques->option }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-dark" for="state">{{ $tz->question }}<b class="text-danger">*</b></label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-time_zone"></p>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="under_age" name="under_age" value="{{ $students->under_age }}" class="form-control">
                                    <label class="text-dark" for="under_age">How many children under age 18 live in
                                        your home?
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-under_age"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="emergency_name" name="emergency_name" value="{{ $students->emergency_name }}" class="form-control">
                                    <label class="text-dark" for="emergency_name">Emergency Contact Name
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-emergency_name"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="emergency_number" name="emergency_number" value="{{ $students->emergency_number }}" class="form-control">
                                    <label class="text-dark" for="emergency_number">Emergency Contact Phone Number?
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-emergency_number"></p>
                            </div>
                            <h5>Your Goals</h5>
                            @php
                            $questionM = DB::table('questions')
                            ->where('status', 1)
                            ->where('question_type', 1)
                            ->where('user_type', 0)
                            ->get();
                            $studentques = DB::table('question_entries')
                            ->where('user_id', $students->user_id)
                            ->get();
                            foreach ($studentques as $ques) {
                            $q[$ques->question_id] = $ques->option_id;
                            }
                            @endphp
                            @foreach ($questionM as $tz)
                            @php
                            $question_optionsM = DB::table('question_options')
                            ->where('status', 1)
                            ->where('question_id', $tz->id)
                            ->get();
                            @endphp
                            <div class="col-md-6 p-6">
                                <small class="text-dark fw-medium">{{ $tz->question }}<b class="text-danger">*</b></small>
                                @foreach ($question_optionsM as $ques)
                                <div class="form-check mt-3">
                                    <input name="question[{{ $tz->id }}]" class="form-check-input" type="radio" value=" {{ $ques->id }}" id="defaultRadio1" @if (isset($q[$tz->id]) && $q[$tz->id] == $ques->id) checked @endif>
                                    <label class="form-check-label" for="defaultRadio1">
                                        {{ $ques->option }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                        <h5>Time Scheduling</h5>
                        @php
                        $data = DB::table('availabilities')
                        ->where(['day' => 'Monday', 'user_id' => $students->user_id])
                        ->first();
                        $data1 = DB::table('availabilities')
                        ->where(['day' => 'Tuesday', 'user_id' => $students->user_id])
                        ->first();

                        $data2 = DB::table('availabilities')
                        ->where(['day' => 'Wednesday', 'user_id' => $students->user_id])

                        ->first();
                        $data3 = DB::table('availabilities')
                        ->where(['day' => 'Thursday', 'user_id' => $students->user_id])
                        ->first();
                        $data4 = DB::table('availabilities')
                        ->where('day', 'Friday')
                        ->where(['day' => 'Monday', 'user_id' => $students->user_id])
                        ->first();
                        $data5 = DB::table('availabilities')
                        ->where(['day' => 'Saturday', 'user_id' => $students->user_id])

                        ->first();
                        $data6 = DB::table('availabilities')
                        ->where(['day' => 'Sunday', 'user_id' => $students->user_id])
                        ->first();
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check mb-3 mt-3">
                                    <input class="form-check-input" type="checkbox" name="day[]" value="Monday" id="Monday" @if ($data !=null && $data->day == 'Monday') checked @endif>
                                    <label class="form-check-label" for="Monday">
                                        Monday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_from[]" value="{{ $data->time_from ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_to[]" value="{{ $data->time_to ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check mb-3 mt-3">
                                    <input class="form-check-input" type="checkbox" name="day[]" value="Tuesday" id="Tuesday" @if ($data1 !=null && $data1->day == 'Tuesday') checked @endif>
                                    <label class="form-check-label" for="Tuesday">
                                        Tuesday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_from[]" value="{{ $data1->time_from ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_to[]" value="{{ $data1->time_to ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check mb-3 mt-3">
                                    <input class="form-check-input" name="day[]" type="checkbox" value="Wednesday" id="Wednesday" @if ($data2 !=null && $data2->day == 'Wednesday') checked @endif>
                                    <label class="form-check-label" for="Wednesday">
                                        Wednesday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_from[]" value="{{ $data2->time_from ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_to[]" value="{{ $data2->time_to ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check mb-3 mt-3">
                                    <input class="form-check-input" name="day[]" type="checkbox" value="Thursday" id="Thursday" @if ($data3 !=null && $data3->day == 'Thursday') checked @endif>
                                    <label class="form-check-label" for="Thursday">
                                        Thursday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_from[]" value="{{ $data3->time_from ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_to[]" value="{{ $data3->time_to ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check mb-3 mt-3">
                                    <input class="form-check-input" name="day[]" type="checkbox" value="Friday" id="Friday" @if ($data4 !=null && $data4->day == 'Friday') checked @endif>
                                    <label class="form-check-label" for="Friday">
                                        Friday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_from[]" value="{{ $data4->time_from ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_to[]" value="{{ $data4->time_to ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check mb-3 mt-3">
                                    <input class="form-check-input" name="day[]" type="checkbox" value="Saturday" id="Saturday" @if ($data5 !=null && $data5->day == 'Saturday') checked @endif>
                                    <label class="form-check-label" for="Saturday">
                                        Saturday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_from[]" value="{{ $data5->time_from ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_to[]" value="{{ $data5->time_to ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check mb-3 mt-3">
                                    <input class="form-check-input" name="day[]" type="checkbox" value="Sunday" id="Sunday" @if ($data6 !=null && $data6->day == 'Sunday') checked @endif>
                                    <label class="form-check-label" for="Sunday">
                                        Sunday
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_from[]" value="{{ $data6->time_from ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="time" name="time_to[]" value="{{ $data6->time_to ?? '' }}" class="form-control timepickers">
                                    <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                </p>
                            </div>
                        </div>
                        <div class="pt-4" style="text-align-last: Right;">
                            <button type="button" class="btn btn-danger waves-effect" id="cancelButton">Cancel</button>
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('.form-check-input').each(function() {
            var isChecked = $(this).prop('checked');
            var parentCol = $(this).closest('.col-md-12');
            var fromInput = parentCol.next('.col-md-6').find(
                '.form-control.timepickers[name="time_from[]"]');
            var toInput = parentCol.next('.col-md-6').next('.col-md-6').find(
                '.form-control.timepickers[name="time_to[]"]');

            fromInput.prop('disabled', !isChecked);
            toInput.prop('disabled', !isChecked);
        });
        $('.form-check-input').change(function() {
            var isChecked = $(this).prop('checked');
            var parentCol = $(this).closest('.col-md-12');
            var fromInput = parentCol.next('.col-md-6').find(
                '.form-control.timepickers[name="time_from[]"]');
            var toInput = parentCol.next('.col-md-6').next('.col-md-6').find(
                '.form-control.timepickers[name="time_to[]"]');

            fromInput.prop('disabled', !isChecked);
            toInput.prop('disabled', !isChecked);
        });
    });
    $(document).ready(function() {
        $(document).on('click', '#cancelButton', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure you want to discard the changes?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#2092b1',
                cancelButtonText: "CONTINUE EDITING",
                confirmButtonText: 'DISCARD CHANGES'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "{{ url('/') }}" + "/admin/students";
                }
            });
        });
    });
    $(document).ready(function() {

        $(document).on('submit', 'form#editFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

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
                        $('.submit').html('Update');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {
                        toastr.success("students Updated Successfully");
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" +
                                "/admin/students";
                        }, 2000);

                    }
                    //show the form validates error
                    if (response.success == false) {
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
    });
</script>
@endpush
