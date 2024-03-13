@extends('layouts.student.master')
@section('content')
<style>
    .form-check label {
        font-size: 13px;
        line-height: 20px;
    }
    .form-check-input[type=radio]{
        margin-top: 5px;
    }
</style>

    <div class="col-xl-9 col-lg-9 col-md-9">
        <div class="account-wrap">
            <div class="account-main">
                <h3 class="account-title">Edit Profile</h3>
                <form id="editFrm" action="{{ route('update.profile') }}" method="POST">
                    @csrf
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="name">First Name</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="name" name="name" placeholder="Jemma Barsby" value="{{ Auth::user()->name?? '' }}">
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="name">Last Name</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="name" name="l_name" placeholder="Jemma Barsby" value="{{ Auth::user()->l_name?? '' }}">
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="email">Your Email</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="email" id="email" name="email" placeholder="someusername@gmail.com" value="{{ $student->email?? '' }}" readonly>
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="phone">Mobile Phone</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="phone" name="phone" placeholder="+1 587 469 8545" value="{{ $student->phone ?? '' }}">
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="gender">Gender</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="text" id="gender" name="gender" placeholder="Male" value="{{ $student->gender ?? '' }}">
                        </div>
                    </div>
                    <div class="account-form-item mb-15">
                        <div class="account-form-label">
                            <label for="birthdate">Birthdate</label>
                        </div>
                        <div class="account-form-input account-form-input-pass">
                            <input type="date" id="birthday" name="birthday" placeholder="26 Dec 1995" value="{{ $student->birthday ??''}}">
                        </div>
                    </div>
                    <div class="account-form-button">
                        <button type="submit" class="account-btn">Submit</button>
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
            event.preventDefault(); // Prevent default form submission

            // Clear any previous error messages
            $('p.error_container').html("");

            // Get form data and construct FormData object
            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");

            // Show loading indicator
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
            $('.form-control').addClass('disabled-link');
            $('.error-control').addClass('disabled-link');
            if ($('.submit').html() !== loadingText) {
                $('.submit').html(loadingText);
            }

            // Send AJAX request
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Reset form state after successful response
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Update');
                    }, 2000);

                    // Handle response based on success or failure
                    if (response.success == true) {
                        toastr.success("Profile updated Successfully");
                        window.setTimeout(function() {
                            window.location =
                                "{{ url('/student-view-profile') }}";
                        }, 2000);
                    } else if (response.success == false) {
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

            // Prevent further propagation of the event
            event.stopImmediatePropagation();
            return false;
        });
    });
</script>

        @endpush
