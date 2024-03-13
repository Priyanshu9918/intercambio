@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Student/</span>Add Student</h4>
            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <h5 class="card-header">Add Student</h5>
                        <form class="card-body" action="{{ route('admin.students.create') }}" method="POST" id="createFrm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="name" name="name" class="form-control">
                                        <label for="name" class="text-dark">Student First Name
                                            <b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="l_name" name="l_name" class="form-control">
                                        <label for="l_name" class="text-dark">Student Last Name
                                            <b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-l_name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="email" name="email" class="form-control">
                                        <label for="email" class="text-dark">Student Email<b
                                                class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="phone" name="phone" class="form-control">
                                        <label for="phone" class="text-dark">Phone<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="password" name="password" class="form-control"
                                            autocomplete="new-password">
                                        <label for="password" class="text-dark">Password<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-password">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="confirm_password" name="confirm_password"
                                            class="form-control" autocomplete="new-password">
                                        <label for="confirm_password" class="text-dark">Confirm Password<b
                                                class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-confirm_password"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" id="birthday" name="birthday" class="form-control">
                                        <label for="birthday" class="text-dark">Birth date
                                            <b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-birthday">
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="gender" id="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="non-binary">Non Binary</option>
                                        </select>
                                        <label class="form-label" for="gender">Select Gender<b
                                                class="text-danger">*</b></label>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-gender"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="street_address" name="street_address"
                                            class="form-control">
                                        <label for="street_address" class="text-dark">Street Address
                                            <b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-street_address"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="city" name="city" class="form-control">
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
                                    @endphp
                                    <div class="form-floating form-floating-outline ">
                                        <select name="state" id="state" class="form-select">
                                            <option value="">Select State</option>
                                            @foreach ($state as $st)
                                                <option value="{{ $st->id }}">{{ $st->short_name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label text-dark" for="state">Select State<b
                                                class="text-danger">*</b></label>

                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-state"></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="zip" name="zip" class="form-control">
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
                                    @endphp
                                    <div class="form-floating form-floating-outline ">
                                        <select name="time_zone" id="time_zone" class="form-select">
                                            <option value="">Select Time Zone</option>
                                            @foreach ($time_zone as $tz)
                                                <option value="{{ $tz->id }}">{{ $tz->timezone }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label text-dark" for="state">Select Time Zone<b
                                                class="text-danger">*</b></label>

                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-time_zone"></p>
                                    </div>
                                </div>
                                <h5 class="card-header">Please tell us about yourself</h5>

                                @php
                                    $question = DB::table('questions')
                                        ->where('status', 1)
                                        ->where('question_type', 0)
                                        ->get();
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
                                            <select name="question[{{ $tz->id }}]" id="question"
                                                class="form-select">
                                                <option value="">Select</option>
                                                @foreach ($question_options as $ques)
                                                    <option value="{{ $ques->id }}">{{ $ques->option }}</option>
                                                @endforeach
                                            </select>
                                            <label class="form-label text-dark" for="state">{{ $tz->question }}<b
                                                    class="text-danger">*</b></label>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-question"></p>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="under_age" name="under_age" class="form-control">
                                        <label class="text-dark" for="under_age">How many children under age 18 live in
                                            your home?
                                            <b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-under_age"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="emergency_name" name="emergency_name"
                                            class="form-control">
                                        <label class="text-dark" for="emergency_name">Emergency Contact Name
                                            <b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-emergency_name"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="emergency_number" name="emergency_number"
                                            class="form-control">
                                        <label class="text-dark" for="emergency_number">Emergency Contact Phone Number?
                                            <b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-emergency_number"></p>
                                </div>
                                <h5 class="card-header">Your Goals</h5>

                                @php
                                    $questionM = DB::table('questions')
                                        ->where('status', 1)
                                        ->where('question_type', 1)
                                        ->get();
                                @endphp
                                @foreach ($questionM as $tz)
                                    @php
                                        $question_optionsM = DB::table('question_options')
                                            ->where('status', 1)
                                            ->where('question_id', $tz->id)
                                            ->get();
                                    @endphp
                                    <div class="col-md-6 p-6">
                                        <small class="text-dark fw-medium">{{ $tz->question }}<b
                                                class="text-danger">*</b></small>
                                        @foreach ($question_optionsM as $ques)
                                            <div class="form-check mt-3">
                                                <input name="question[{{ $tz->id }}]" class="form-check-input"
                                                    type="radio" value=" {{ $ques->id }}" id="defaultRadio1">
                                                <label class="form-check-label" for="option">
                                                    {{ $ques->option }}
                                                </label>
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-option"></p>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <h5 class="card-header">Time Scheduling</h5>
                            <p>Please select the days and times you are available for classes. Please make sure you are selecting time periods that are at least 90 minutes in length. Time periods that are longer are fine. Please make sure you are telling us ALL of the times and days you are available so that we can find a teacher for you.</p>
                            <div class="error-message" style="color: red;"></div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check mb-3 mt-3">
                                        <input class="form-check-input" name="day[]" type="checkbox" value="Monday"
                                            id="Monday">
                                        <label class="form-check-label" for="Monday">
                                            Monday
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_from[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_to[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 mt-3">
                                        <input class="form-check-input" name="day[]" type="checkbox" value="Tuesday"
                                            id="Tuesday">
                                        <label class="form-check-label" for="Tuesday">
                                            Tuesday
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_from[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_to[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 mt-3">
                                        <input class="form-check-input" name="day[]" type="checkbox" value="Wednesday"
                                            id="Wednesday">
                                        <label class="form-check-label" for="Wednesday">
                                            Wednesday
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_from[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_to[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 mt-3">
                                        <input class="form-check-input" name="day[]" type="checkbox" value="Thursday"
                                            id="Thursday">
                                        <label class="form-check-label" for="Thursday">
                                            Thursday
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_from[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_to[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 mt-3">
                                        <input class="form-check-input" name="day[]" type="checkbox" value="Friday"
                                            id="Friday">
                                        <label class="form-check-label" for="Friday">
                                            Friday
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_from[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_to[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 mt-3">
                                        <input class="form-check-input" name="day[]" type="checkbox" value="Saturday"
                                            id="Saturday">
                                        <label class="form-check-label" for="Saturday">
                                            Saturday
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_from[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_to[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check mb-3 mt-3">
                                        <input class="form-check-input" name="day[]" type="checkbox" value="Sunday"
                                            id="Sunday">
                                        <label class="form-check-label" for="Sunday">
                                            Sunday
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_from[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">From<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="time" name="time_to[]" class="form-control timepickers">
                                        <label for="name" class="text-dark">To<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                    </p>
                                </div>
                            </div>
                            <div class="pt-4" style="text-align-last: Right;">
                                <button type="button" class="btn btn-danger waves-effect"
                                    id="cancelButton">Cancel</button>

                                <button type="submit"
                                    class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
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
        $('#createFrm').submit(function(e) {
            var checkedCheckboxes = $('.day-form-check-input');

            if (checkedCheckboxes.length < 2) {
                e.preventDefault();
                $('.error-message').text('Please select a minimum of two days for availability.')
                    .show();
            } else {
                $('.error-message').text('').hide();
                submitForm();
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                // Clearing the error msg
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
                var password = $('#password').val();
                var confirmPassword = $('#confirm_password').val();
                if (password !== confirmPassword) {
                    $('#error-confirm_password').html('Password and Confirm Password do not match.');
                    $('.submit').attr('disabled', false);
                    $('.form-control').attr('readonly', false);
                    $('.form-control').removeClass('disabled-link');
                    $('.error-control').removeClass('disabled-link');
                    $('.submit').html('Submit');
                    return false;
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

                        if (response.success == true) {
                            toastr.success("Student Created Successfully");
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/admin/students";
                            }, 2000);
                        }

                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control][0]);
                            }
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
                event.stopImmediatePropagation();
                return false;
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
                    cancelButtonText: "CANCEL",
                    confirmButtonText: 'CONFIRM'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect or perform any other action on cancel
                        window.location = "{{ url('/') }}" + "/admin/students";
                    }
                });
            });
        });
    </script>
@endpush
