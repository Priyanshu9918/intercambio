@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Edit Questionnaire</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Questionnaire</h5>
                    <form class="card-body" action="{{ route('admin.questions.edit', ['id' => base64_encode($questions->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="question" name="question" class="form-control" value="{{ $questions->question ?? '' }}" placeholder="user-name">
                                    <label for="question">Question</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-question ">
                                </p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select name="question_type" class="form-control">
                                        <option value="">Select Question Type</option>
                                        <option value="0" {{ $questions->question_type == 0 ? 'selected' : '' }}>
                                            Picklists</option>
                                        <option value="1" {{ $questions->question_type == 1 ? 'selected' : '' }}>
                                            Multiple choice</option>
                                        <option value="2" {{ $questions->question_type == 2 ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                    <label class="form-label" for="question_type">Select Question Type<b class="text-danger">*</b></label>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select name="user_type" class="form-control">
                                        <option value="">Select User Type</option>
                                        <option value="0" {{ $questions->user_type == 0 ? 'selected' : '' }}>
                                            Students</option>
                                        <option value="1" {{ $questions->user_type == 1 ? 'selected' : '' }}>
                                            Teachers</option>
                                    </select>
                                    <label class="form-label" for="user_type">Select User Type<b class="text-danger">*</b></label>

                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="q_id" name="q_id" class="form-control" value="{{ $questions->q_id ?? '' }}">
                                    <label for="q_id">Question Id</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-q_id "></p>
                            </div>
                        </div>
                        <div class="pt-4" style="text-align-last: right;">
                            <button type="button" class="btn btn-danger waves-effect" id="cancelButton">Cancel</button>
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
                            <!-- <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button> -->
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
                    window.location = "{{ url('/') }}" + "/admin/questions";
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
                        toastr.success("questions updated Successfully");
                        // Swal.fire({
                        // position: 'top-end',
                        // icon: 'success',
                        // title: 'Blog Updated Successfully',
                        // showConfirmButton: false,
                        // timer: 1500
                        // })
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" +
                                "/admin/questions";
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
