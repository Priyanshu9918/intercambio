@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Teacher/</span>Add Teacher</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Add Teacher</h5>
                    <form class="card-body" action="{{ route('admin.teachers.edit', ['id' => base64_encode($teachers->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="name" value="{{ $teachers->name }}" class="form-control">
                                    <label for="name" class="text-dark">Name
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                            </div>
                            @php
                            $data = DB::table('users')
                            ->where('id', $teachers->user_id)
                            ->first();
                            @endphp
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="email" name="email" value="{{ $data->email }}" class="form-control">
                                    <label for="email" class="text-dark">Email<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="phone" name="phone" value="{{ $teachers->phone }}" class="form-control">
                                    <label for="phone" class="text-dark">Phone<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone"></p>
                            </div>
                            @php
                            $question = DB::table('questions')
                            ->where('status', 1)
                            ->where('question_type', 0)
                            ->where('user_type', 1)
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
                                    <select name="here_about_us" id="here_about_us" class="form-select">
                                        <option value="">Select</option>
                                        @foreach ($question_options as $ques)
                                        <option value="{{ $ques->option }}">{{ $ques->option }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label text-dark" for="here_about_us">{{ $tz->question }}<b class="text-danger">*</b></label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-here_about_us"></p>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-md-6">
                                <div class="account-form-condition mb-3">
                                    <label class="condition_label">I have read the Volunteer Information page : <a href="https://intercambio.org/volunteer-opportunities/teaching-english/" target="_blank" class="color_2_ds">Click here </a>to read page
                                        <input type="checkbox" name="volunteer_information" value="1" @if (isset($teachers) && $teachers->volunteer_information == 1) checked @endif>
                                        <span class="check_mark"></span>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-volunteer_information">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <div class="account-form-condition">
                                    <label class="condition_label">By checking this box and providing your phone
                                        number,
                                        you consent to receiving text messages from Intercambio Uniting Communities. You
                                        should anticipate receiving 1-2 texts weekly, and you retain the ability to
                                        opt-out at any time by texting the word STOP.
                                        <input type="checkbox" name="receiving_text_message" value="1" @if (isset($teachers) && $teachers->receiving_text_message == 1) checked @endif>
                                        <span class="check_mark"></span>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-receiving_text_message">
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" id="birthday" name="birthday" value="{{ $teachers->birthday }}" class="form-control">
                                    <label for="birthday" class="text-dark">Birth date
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-birthday">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline ">
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="">Select Gender</option>
                                        <option value="male" @if ($teachers->gender == 'male') selected @endif>Male
                                        </option>
                                        <option value="female" @if ($teachers->gender == 'female') selected @endif>Female
                                        </option>
                                        <option value="non-binary" @if ($teachers->gender == 'non-binary') selected @endif>
                                            Non
                                            Binary</option>
                                    </select>
                                    <label class="form-label" for="gender">Select Gender<b class="text-danger">*</b></label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-gender"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="address" name="address" value="{{ $teachers->address }}" class="form-control">
                                    <label for="address" class="text-dark">Street Address
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-address"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="city" name="city" value="{{ $teachers->city }}" class="form-control">
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
                                ->where('id', $teachers->state)
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
                                    <input type="text" id="zip" name="zip" value="{{ $teachers->zip }}" class="form-control">
                                    <label for="zip" class="text-dark">Zip Code
                                        <b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-zip">
                                </p>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline ">
                                    <select name="class_teaching_type" id="class_teaching_type" class="form-select">
                                        <option value="">Select Type</option>
                                        <option value="In Person" @if ($teachers->class_teaching_type == 'In Person') selected @endif>In
                                            Person</option>
                                        <option value="Online" @if ($teachers->class_teaching_type == 'Online') selected @endif>Online
                                        </option>
                                    </select>
                                    <label class="form-label" for="class_teaching_type">Class Teaching Type<b class="text-danger">*</b></label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-class_teaching_type"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline ">
                                    <select name="class_type_preference" id="class_type_preference" class="form-select">
                                        <option value="">Select Type</option>
                                        <option value="Group Classes" @if ($teachers->class_type_preference == 'Group Classes') selected @endif>Group Classes</option>
                                        <option value="One-on-One Tutoring" @if ($teachers->class_type_preference == 'One-on-One Tutoring') selected @endif>One-on-One Tutoring
                                        </option>
                                    </select>
                                    <label class="form-label" for="class_type_preference">Class Type Preference<b class="text-danger">*</b></label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-class_type_preference"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline ">
                                    <select name="voluntee_location" id="voluntee_location" class="form-select">
                                        <option value="">Select Type</option>
                                        <option value="Boulder" @if ($teachers->voluntee_location == 'Boulder') selected @endif>
                                            Boulder</option>
                                        <option value="Longmont" @if ($teachers->voluntee_location == 'Longmont') selected @endif>
                                            Longmont</option>
                                    </select>
                                    <label class="form-label" for="voluntee_location">Preferred Volunteer Locations<b class="text-danger">*</b></label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-voluntee_location"></p>
                                </div>
                            </div>
                            <div class="col-md-6 p-6">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-200" aria-label="location_comment" id="basic-default-location_comment">{{ $teachers->location_comment }}</textarea>
                                    <label for="basic-default-location_comment">location comment</label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-location_comment"></p>
                                </div>
                            </div>
                            <div class="col-md-6 p-6">
                                <small class="text-dark fw-medium"><b>Time Commitment</b><b class="text-danger">*</b>
                                    <br>
                                    ldeally, we are looking for volunteers who are able to make a long-term
                                    commitment
                                    to our program (short, pre-arranged breaks are okay). Given this, do you expect
                                    to
                                    be able to commit to a consistent teaching schedule twice a week for 3 to 6
                                    months?
                                </small>

                                <div class="form-check mt-3">
                                    <input name="location_comment" class="form-check-input" type="radio" value="yes" id="defaultRadio1" @if ($teachers->location_comment == 'yes') checked @endif>
                                    <label class="form-check-label" for="option">
                                        yes
                                    </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input name="location_comment" class="form-check-input" type="radio" value="No" id="defaultRadio1" @if ($teachers->location_comment == 'No') checked @endif>
                                    <label class="form-check-label" for="option">
                                        No
                                    </label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-option">
                                </p>
                            </div>
                            <div class="col-md-6 p-6">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" aria-label="time_commitment" id="basic-default-time_commitment" name="time_commitment">{{ $teachers->time_commitment }}</textarea>
                                    <label for="basic-default-time_commitment">Time Commitment</label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-time_commitment"></p>
                                </div>
                            </div>
                            <div class="col-md-6 p-6">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" aria-label="voluntee_for_intercombio" id="basic-default-voluntee_for_intercombio" name="voluntee_for_intercombio">{{ $teachers->voluntee_for_intercombio }}</textarea>
                                    <label for="basic-default-voluntee_for_intercombio">Voluntee For
                                        Intercambio</label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-voluntee_for_intercombio"></p>
                                </div>
                            </div>
                            <div class="col-md-12 p-6">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" aria-label="other_info" id="basic-default-other_info" name="other_info">{{ $teachers->other_info }}</textarea>
                                    <label for="basic-default-other_info">Other Info</label>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-other_info"></p>
                                </div>
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
                    window.location = "{{ url('/') }}" + "/admin/teachers";
                }
            });
        });
    });
    $(document).ready(function() {
        $(document).on('submit', 'form#editFrm', function(event) {
            event.preventDefault();
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
                    if (response.success == true) {
                        toastr.success("teachers Updated Successfully");
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" +
                                "/admin/teachers";
                        }, 2000);

                    }
                    if (response.success == false) {
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);

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
</script>
@endpush