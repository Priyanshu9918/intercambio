@extends('layouts.student.master')
@section('content')
<style>
.h2_main-menu ul li .submenu {
    right: 0;
    left: unset;
    width: 160px;
}

.h2_main-menu ul li .submenu li a {
    padding: 5px 15px;
    font-size: 13px;
}

.input-with-icon {
    position: relative;
}

.input-with-icon input[type="password"] {
    padding-right: 35px; /* Adjust this value according to your icon's width */
}

.input-with-icon i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 10px; /* Adjust this value according to your design */
    cursor: pointer;
}
</style>

<div class="col-xl-9 col-lg-9 col-md-9">
    <div class="account-wrap">
        <div class="account-main">
            <h3 class="account-title">Change Password</h3>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('student.password.update') }}" method="post" class="account-form">
                @csrf
                <div class="account-form-item mb-15 input-with-icon">
                    <div class="account-form-label">
                        <label>Your Old Password</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="password" name="old_password" id="old_password" placeholder="**********">
                        <i class="fas fa-eye" id="toggle_old_password" onclick="togglePassword('old_password')"></i>
                    </div>
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="account-form-item mb-15 input-with-icon">
                    <div class="account-form-label">
                        <label>New Password</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="password" name="password" id="password" placeholder="*********">
                        <i class="fas fa-eye" id="toggle_password" onclick="togglePassword('password')"></i>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="account-form-item mb-15 input-with-icon">
                    <div class="account-form-label">
                        <label>Confirm password</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="*********">
                        <i class="fas fa-eye" id="toggle_password_confirmation" onclick="togglePassword('password_confirmation')"></i>
                    </div>
                </div>
                <div class="account-form-button">
                    <button type="submit" class="account-btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById('toggle_' + inputId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

@endsection
