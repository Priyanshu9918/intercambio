@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Email Template</h4>
            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <h5 class="card-header">Email Template</h5>
                        <form class="card-body" action="{{ route('admin.email.create') }}" method="POST" id="createFrm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-12 p-6">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" aria-label="description" id="basic-default-description" name="description"></textarea>
                                        <label for="basic-default-description">Description</label>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-description"></p>
                                    </div>
                                </div>
                                <div class="col-md-12 p-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="title" name="title" class="form-control">
                                        <label for="title">Subject<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                </div>

                                <div class="col-md-12 p-6">
                                        <label for="basic-default-content">Content<b class="text-danger">*</b></label>

                                    <div class="form-floating form-floating-outline">
                                        <textarea class="summernote form-control h-px-100" aria-label="content" id="basic-default-content" name="content"></textarea>
                                    </div>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-content"></p>
                            </div>
                           
                    </div>
                    {{-- <div class="row g-4"> --}}

                    {{-- </div> --}}
                    <div class="pt-4" style="text-align-last: Right;">
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
                    cancelButtonText: "CANCEL",
                    confirmButtonText: 'CONFIRM'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect or perform any other action on cancel
                        window.location = "{{ url('/') }}" + "/admin/email";
                    }
                });
            });
        });
        $(document).ready(function() {

            $(document).on('submit', 'form#createFrm', function(event) {
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
                            toastr.success("Email Template Created Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                "/admin/email";
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

            $(document).ready(function() {
                $('.summernote').summernote();
            });
        });
    </script>
@endpush
