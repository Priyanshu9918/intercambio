@extends('layouts.front.master')
@section('content')
    <!-- sign in area start -->
    <div class="account-area pt-4 pb-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="account-wrap">
                        <div class="account-main">
                            <h3 class="account-title">Create Your Teacher Account</h3>
                            <form action="{{ route('teacher.teacher-submit') }}" method="POST"
                                id="createFrm"class="account-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="account-form-item mb-20">
                                            <div class="account-form-label">
                                                <label>First name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="account-form-input">
                                                <input type="text" name="name" id="name"
                                                    placeholder="Enter First name">
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-name">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="account-form-item mb-20">
                                            <div class="account-form-label">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="account-form-input">
                                                <input type="text" name="l_name" id="l_name"
                                                    placeholder="Enter Last Name">
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-l_name">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="account-form-item mb-20">
                                            <div class="account-form-label">
                                                <label>Your Email <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="account-form-input">
                                                <input type="text" name="email" placeholder="Enter Your Email">
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-email"></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="account-form-item mb-15">
                                            <div class="account-form-label">
                                                <label>Enter Password <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="account-form-input account-form-input-pass">
                                                <input type="password" name="password" placeholder="*********" id="password">
                                                <span><i class="fa-thin fa-eye" id="togglePassword"></i></span>
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-password">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="account-form-item mb-15">
                                            <div class="account-form-label">
                                                <label>Confirm Password <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="account-form-input account-form-input-pass">
                                                <input type="password" name="confirm_password" placeholder="*********" id="password_confirmation">
                                                <span><i class="fa-thin fa-eye" id="togglePassword1"></i></span>
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-confirm_password"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-form-button">
                                    <button type="submit" class="account-btn">Sign Up</button>
                                </div>
                            </form>
                            <div class="account-bottom">
                                <div class="account-bottom-text">
                                    <p>Already have an account ? <a href="{{ route('front.index') }}">Sign In</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sign in area end -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                // Clearing the error msg
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

                        if (response.success == true) {
                            toastr.success("Registration Successfully! Please Check email for verification");
                            window.setTimeout(function() {
                                window.location = "{{ url('/')}}" + "/teacher-verify/"+response.value;
                            }, 2000);
                        }

                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control][0]);
                                $('.pre-loader').hide();
                            }
                        }
                    },
                    error: function(response) {
                        $('.pre-loader').hide();
                        console.log(response);
                    }
                });
                event.stopImmediatePropagation();
                return false;
            });
        });
        $(document).ready(function() {
            const togglePassword1 = document.querySelector('#togglePassword1');
                const password1 = document.querySelector('#password_confirmation');

                togglePassword1.addEventListener('click', function(e) {
                    // toggle the type attribute
                    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                    password1.setAttribute('type', type);
                    // toggle the eye slash icon
                    // this.classList.toggle('fa-eye-slash');
                    $(this).toggleClass('fa fa-eye fa-eye-slash');
                });


                const togglePassword = document.querySelector('#togglePassword');
                const password = document.querySelector('#password');

                togglePassword.addEventListener('click', function(e) {
                    // toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    // toggle the eye slash icon
                    // this.classList.toggle('fa-eye-slash');
                    $(this).toggleClass('fa fa-eye fa-eye-slash');
                });
            });
    </script>
@endpush
