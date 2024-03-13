@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Courses</h4>
            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <h5 class="card-header">Courses</h5>
                        <form class="card-body" action="{{ route('admin.courses.create') }}" method="POST" id="createFrm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select name="user_type" class="form-control" id="user_type">
                                            <option value="">Select User Type</option>
                                            <option value="Student">Student</option>
                                            <option value="Teacher">Teacher</option>
                                        </select>
                                        <label class="form-label" for="user_type">Select User Type<b
                                                class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-user_type">
                                    </p>
                                </div>
                                <div class="col-md-6" id="c_type">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select name="course_type" class="form-control" id="course_type">
                                            <option value="">Select Course Type</option>
                                            <option value="normal">Normal</option>
                                            <option value="training">Training</option>
                                            <option value="resources">Resources</option>
                                        </select>
                                        <label class="form-label" for="course_type">Select Course Type<b
                                                class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-course_type"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select name="class_type" class="form-control">
                                            <option value="">Select Class Type</option>
                                            <option value="Group Class">Group Class</option>
                                            <option value="One To One">One To One</option>
                                            <option value="Online">Online</option>
                                        </select>
                                        <label class="form-label" for="class_type">Select Class Type<b
                                                class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-class_type"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="level" name="level" class="form-control">
                                        <label for="level">Level</label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-level"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="title" name="title" class="form-control">
                                        <label for="title">Title<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="course_id" name="course_id" class="form-control">
                                        <label for="course_id">Course Id<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-course_id">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="course_name" name="course_name" class="form-control">
                                        <label for="course_name">Course Name<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-course_name">
                                    </p>
                                </div>
                                <div class="col-md-12 p-6" id="locationCommentDiv">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" name="short_description" aria-label="short_description"
                                            id="basic-default-short_description"></textarea>
                                        <label for="basic-default-short_description">Short Description</label>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-short_description"></p>
                                    </div>
                                </div>
                                <div class="row g-4">

                                    <div class="col-md-3 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="batch_id" name="batch_id[]" class="form-control">
                                            <label for="batch_id">Batch Id<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-batch_id_0">
                                        </p>

                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="batch_name" name="batch_name[]"
                                                class="form-control">
                                            <label for="batch_name">Batch Name<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-batch_name_0"></p>
                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" id="start_date" name="start_date[]"
                                                class="form-control">
                                            <label for="start_date">Start Date<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-start_date_0">
                                        </p>

                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" id="end_date" name="end_date[]" class="form-control">
                                            <label for="end_date">End Date<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-end_date_0"></p>
                                    </div>

                                    <div class="col-md-2 pt-3">
                                        <button type="button" class="btn btn-primary add-area-btn1" data-id="Aaddress"
                                            id="add1"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-12" id="mt12">
                                    </div>
                                </div>

                            </div>
                            <div class="pt-4" style="text-align-last: Right;">
                                <button type="button" class="btn btn-danger waves-effect"
                                    id="cancelButton">Cancel</button>
                                <button type="submit"
                                    class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Save</button>
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
                    cancelButtonText: "CANCEL",
                    confirmButtonText: 'CONFIRM'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "{{ url('/') }}" + "/admin/courses";
                    }
                });
            });

        });
        $(document).ready(function() {
            var i = 0;

            $("#add1").click(function() {
                ++i;
                $("#mt12").append(`
            <div class="row g-4" id="row${i}">
                <div class="col-md-3 pt-2">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="batch_id[]">
                        <label for="batch_id">Batch Id<b class="text-danger">*</b></label>
                    </div>
                    <p style="margin-bottom: 2px;" class="text-danger error_container batch_id_${i}" id="error-batch_id_${i}"></p>
                </div>
                <div class="col-md-3 pt-2">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" name="batch_name[]">
                        <label for="batch_name">Batch name<b class="text-danger">*</b></label>
                    </div>
                    <p style="margin-bottom: 2px;" class="text-danger error_container batch_name_${i}" id="error-batch_name_${i}"></p>
                </div>
                <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" id="start_date" name="start_date[]" class="form-control">
                                            <label for="start_date">Start Date<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-start_date_0">
                                        </p>

                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" id="end_date" name="end_date[]"
                                                class="form-control">
                                            <label for="end_date">End Date<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-end_date_0"></p>
                                    </div>
                <div class="col-md-2 pt-2">
                    <p style="margin-bottom: 2px;" class="text-danger error_container Answer_error"></p>
                    <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button>
                </div>
            </div>
        `);
            });
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id).remove();
            });
        });
    </script>
    <script>
        $(document).ready(function() {



            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                // Clearing the error msg
                $('p.error_container').html("");

                var formData = new FormData($(this)[0]);

                var batchIds = $('input[name="batch_id[]"]').map(function() {
                    return $(this).val();
                }).get().join(',');

                formData.append('batch_ids', batchIds);

                var batchNames = $('input[name="batch_name[]"]').map(function() {
                    return $(this).val();
                }).get().join(',');

                formData.append('batch_names', batchNames);

                var StartDates = $('input[name="start_date[]"]').map(function() {
                    return $(this).val();
                }).get().join(',');

                formData.append('start_dates', StartDates);

                var EndDates = $('input[name="end_date[]"]').map(function() {
                    return $(this).val();
                }).get().join(',');

                formData.append('end_dates', EndDates);

                var form = $(this);
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
                    data: formData, // Use formData instead of data
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
                            toastr.success("Courses Created Successfully");
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/admin/courses";
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
            });
            event.stopImmediatePropagation();
            return false;
        });
    </script>
@endpush
