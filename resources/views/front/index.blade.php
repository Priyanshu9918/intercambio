@extends('layouts.front.master')
@section('content')
        <main>
            <!-- sign in area start -->
            <div class="account-area pt-60 pb-120">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-7 col-lg-8 col-md-10">
                            <div class="account-wrap">
                                <div class="account-main">
                                    <h3 class="account-title">Sign-in to the Intercambio Learning System</h3>
                                    <div class="row">
                                        <div class="col-12">
                                            @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <form method="post" action="{{route('user.dologin')}}" class="singin-form">
                        		        @csrf
                                        <div class="account-form-item mb-20">
                                            <div class="account-form-label">
                                                <label>Your Email</label>
                                            </div>
                                            <div class="account-form-input">
                                                <input type="email" name="email" placeholder="Enter Your Email">
                                                @error('email')
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="account-form-item mb-15">
                                            <div class="account-form-label">
                                                <label>Your Password</label>
                                                <a href="forget-password">Forgot Password ?</a>
                                            </div>
                                            <div class="account-form-input account-form-input-pass">
                                                <input type="password" name="password" value="">
                                                @error('password')
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                @enderror
                                                <span><i class="fa-thin fa-eye"></i></span>
                                            </div>
                                        </div> --}}
                                        <div class="account-form-item mb-15">
                                            <div class="account-form-label">
                                                <label>Your Password</label>
                                                <a href="forget-password">Forgot Password?</a>
                                            </div>
                                            <div class="account-form-input account-form-input-pass">
                                                <input type="password" name="password" value="" id="password-input">
                                                @error('password')
                                                    <p class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                @enderror
                                                <span id="toggle-password"><i class="fa-thin fa-eye"></i></span>
                                            </div>
                                        </div>
                                        
                                        <div class="account-form-condition">
                                            <label class="condition_label">Remember Me
                                                <input type="checkbox">
                                                <span class="check_mark"></span>
                                            </label>
                                        </div>
                                        <div class="account-form-button">
                                            <button type="submit" class="account-btn">Sign In</button>
                                        </div>
                                    </form>
                                    <div class="account-bottom">
                                        <div class="account-bottom-text">
                                            <p>Don’t have an account ?  <a href="{{route('front.signup-account-select')}}">Sign Up </a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sign in area end -->
        </main>
        @endsection
        @push('script')
    <script>
   $(document).ready(function () {
        // Toggle password visibility
        $("#toggle-password").click(function () {
            var passwordInput = $("#password-input");
            var icon = $(this).find("i");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
    </script>
    @endpush
