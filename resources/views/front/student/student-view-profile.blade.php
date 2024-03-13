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
        .profile-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.button-container {
  margin-left: auto;
}
    </style>
    <div class="col-xl-9 col-lg-9 col-md-9">
        <div class="account-wrap">
            <div class="account-main">
                <div class="profile-header">
                    <h3 class="account-title">Profile</h3>
                    <div class="button-container">
                      <button class="btn btn-sm btn-success"><a href="{{ url('/student-edit-profile') }}">Edit <i class="fa-thin fa-pencil"></i></a></button>
                    </div>
                  </div>
                <div class="account-form-item mb-15">
                    <div class="account-form-label">
                        <label for="name">Name</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="text" id="name" name="name" placeholder="Jemma Barsby"
                            value="{{ Auth::user()->name.' '.Auth::user()->l_name ?? '' }}" readonly>
                    </div>
                </div>
                <div class="account-form-item mb-15">
                    <div class="account-form-label">
                        <label for="email">Your Email</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="email" id="email" name="email" placeholder="someusername@gmail.com"
                            value="{{ $student->email ?? '' }}" readonly>
                    </div>
                </div>
                <div class="account-form-item mb-15">
                    <div class="account-form-label">
                        <label for="phone">Mobile Phone</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="text" id="phone" name="phone" placeholder="+1 587 469 8545"
                            value="{{ $student->phone ?? '' }}" readonly>
                    </div>
                </div>
                <div class="account-form-item mb-15">
                    <div class="account-form-label">
                        <label for="gender">Gender</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="text" id="gender" name="gender" placeholder="Male"
                            value="{{ $student->gender ?? '' }}" readonly>
                    </div>
                </div>
                <div class="account-form-item mb-15">
                    <div class="account-form-label">
                        <label for="birthdate">Birthdate</label>
                    </div>
                    <div class="account-form-input account-form-input-pass">
                        <input type="date" id="birthday" name="birthday" placeholder="26 Dec 1995"
                            value="{{ $student->birthday ?? '' }}" readonly>
                    </div>
                </div>
                {{-- <div class="account-form-button">
                    <a href="">
                        <button type="submit" class="account-btn">Edit Profile</button></a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
