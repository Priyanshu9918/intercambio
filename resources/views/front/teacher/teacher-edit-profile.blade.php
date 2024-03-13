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
    </style>

    <div class="col-xl-9 col-lg-9 col-md-9">
        <div class="account-wrap">
            <div class="account-main">
                <h3 class="account-title">Edit Profile</h3>

                <form id="editFrm" action="{{ route('teacher.update.profile') }}" method="POST">
                    @csrf
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="name">First Name</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="name" name="name" placeholder="Jemma Barsby"
                                value="{{ Auth::user()->name }}">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>

                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="name">Last Name</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="l_name" name="l_name" placeholder="Jemma Barsby"
                                value="{{ Auth::user()->l_name }}">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-l_name"></p>

                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="email">Your Email</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="email" id="email" name="email" placeholder="someusername@gmail.com"
                                value="{{ Auth::user()->email }}" readonly>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="phone">Mobile Phone</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="phone" name="phone" placeholder="+1 587 469 8545"
                                value="{{ $student->phone }}">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone"></p>
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="gender">Gender</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="gender" name="gender" placeholder="Male"
                                value="{{ $student->gender }}">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-gender"></p>
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="birthdate">Birthdate</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="date" id="birthday" name="birthday" placeholder="26 Dec 1995"
                                value="{{ $student->birthday }}">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-birthday"></p>

                        </div>
                    </div>
                    <div class="account-form-button">
                        <button type="submit" class="account-btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            // When a form with the ID 'editFrm' is submitted
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
                            $('.submit').html('Submit');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {

                            //notify
                            toastr.success("Profile updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/teacher-view-profile";
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
