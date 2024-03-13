@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">User/</span> Edit User </h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit User </h5>
                    <form class="card-body" action="{{ route('admin.user.edit', ['id' => base64_encode($user->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="user_name" name="user_name" class="form-control" value="{{ $user->name ?? '' }}" placeholder="user-name">
                                    <label for="user_name">User Name</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-user_name">
                                </p>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="password" name="password" value="{{$user->email ?? ''}}" class="form-control" autocomplete="new-password" placeholder="password">
                            <label for="password">Password</label>
                        </div>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-password"></p>
                </div> --}}
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="email" name="email" value="{{ $user->email ?? '' }}" class="form-control" placeholder="user-email">
                        <label for="email">User Email</label>
                    </div>
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="phone" name="phone" value="{{ $user->phone ?? '' }}" class="form-control" placeholder="user-number">
                        <label for="phone">User Phone</label>
                    </div>
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone"></p>
                </div>
                <div class="col-md-6">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="password" name="password" value="{{ $user->c_password ?? '' }}" class="form-control" autocomplete="new-password" placeholder="password">
                        <label for="email">Password</label>
                    </div>
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-password">
                    </p>
                </div>
                <div class="col-md-12">
                    <div class="form-floating form-floating-outline mb-4">
                        <select name="role" id="role" class="form-select">
                            @foreach ($role as $roles)
                            <option value="{{ $roles->id }}" @if ($roles->id == $user->role_id) selected="" @endif>
                                {{ $roles->name }}
                            </option>
                            @endforeach
                        </select>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-role">
                        </p>
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
{{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {

        // Other existing code...

        // SweetAlert for the cancel button
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
                    // Redirect or perform any other action on cancel
                    window.location = "{{ url('/') }}" + "/admin/user";
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

                        //notify
                        toastr.success("User Updated Successfully");
                        // Swal.fire({
                        // position: 'top-end',
                        // icon: 'success',
                        // title: 'Blog Updated Successfully',
                        // showConfirmButton: false,
                        // timer: 1500
                        // })
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" + "/admin/user";
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