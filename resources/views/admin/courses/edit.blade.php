@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Edit courses</h4>
            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <h5 class="card-header">Edit Courses </h5>
                        <form class="card-body" action="{{ route('admin.courses.edit', ['id' => base64_encode($courses->id)]) }}"
                            method="POST" id="editFrm" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select name="user_type" class="form-control" id="user_type">
                                            <option value="">Select User Type</option>
                                            <option value="Student" @if ($courses->user_type == 'Student') selected @endif>
                                                Student</option>
                                            <option value="Teacher" @if ($courses->user_type == 'Teacher') selected @endif>
                                                Teacher</option>
                                        </select>
                                        <label class="form-label" for="user_type">Select User Type<b
                                                class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-user_type">
                                </div>
                                <div class="col-md-6" id="c_type">
                                    <div class="form-floating form-floating-outline mb-4">
                                        <select name="course_type" class="form-control" id="course_type">
                                            <option value="">Select Course Type</option>
                                            <option value="normal" @if ($courses->course_type == 'normal') selected @endif>Normal
                                            </option>
                                            <option value="training" @if ($courses->course_type == 'training') selected @endif>
                                                Training</option>
                                            <option value="resources" @if ($courses->course_type == 'resources') selected @endif>
                                                Resources</option>
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
                                            <option value="Group Class" @if ($courses->class_type == 'Group Class') selected @endif>
                                                Group Class</option>
                                            <option value="One To One" @if ($courses->class_type == 'One To One') selected @endif>One
                                                To One</option>
                                            <option value="Online" @if ($courses->class_type == 'Online') selected @endif>Online
                                            </option>
                                        </select>
                                        <label class="form-label" for="class_type">Select Class Type<b
                                                class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-class_type"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="level" name="level" class="form-control"
                                            value="{{ $courses->level ?? '' }}">
                                        <label for="level">Level<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-level"></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="title" name="title"
                                            value="{{ $courses->title ?? '' }}" class="form-control">
                                        <label for="title">Title<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="course_id" name="course_id"
                                            value="{{ $courses->course_id ?? '' }}" class="form-control">
                                        <label for="course_id">Course Id<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-course_id">
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="course_name" name="course_name"
                                            value="{{ $courses->course_name ?? '' }}" class="form-control">
                                        <label for="course_name">Course Name<b class="text-danger">*</b></label>
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-course_name"></p>
                                </div>
                                <div class="col-md-12 p-6" id="locationCommentDiv">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" name="short_description" aria-label="short_description"
                                            id="basic-default-short_description">{{ $courses->short_description ?? '' }}</textarea>
                                        <label for="basic-default-short_description">Short Description</label>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-short_description"></p>
                                    </div>
                                </div>
                                @php
                                    $batches = explode(',', $courses->batch_id);
                                    $batches = array_filter($batches, 'strlen');

                                    $batches_name = explode(',', $courses->batch_name);
                                    $batches_name = array_filter($batches_name, 'strlen');

                                    $start_date = explode(',', $courses->start_date);
                                    $start_date = array_filter($start_date, 'strlen');
                                    $end_date = explode(',', $courses->end_date);
                                    $end_date = array_filter($end_date, 'strlen');

                                @endphp
                                @if (count($batches) > 0 || count($batches_name) || count($start_date) || count($end_date))
                                    @foreach ($batches as $key => $batche)
                                        <div class="row g-4" id="row{{ $key }}">
                                            <div class="col-md-3 pt-2">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="batch_id" name="batch_id[]"
                                                        class="form-control" value="{{ $batches[$key] ?? '' }}">
                                                    <label for="batch_id">Batch Id<b class="text-danger">*</b></label>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-batch_id_{{ $key }}">
                                                </p>

                                            </div>
                                            <div class="col-md-3 pt-2">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="batch_name" name="batch_name[]"
                                                        class="form-control" value="{{ $batches_name[$key] ?? '' }}">
                                                    <label for="batch_name">Batch Name<b class="text-danger">*</b></label>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-batch_name_{{ $key }}"></p>
                                            </div>

                                            <div class="col-md-2 pt-2">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="date" class="form-control" name="start_date[]"
                                                        value="{{ $start_date[$key] ?? '' }}" placeholder="Start Date">
                                                    <label for="start_date">Start Date<b class="text-danger">*</b></label>
                                                </div>
                                                <p style="margin-bottom: 2px;"
                                                    class="text-danger error_container start_date_error"
                                                    id="error-start_date_${key}"></p>
                                            </div>
                                            <div class="col-md-2 pt-2">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="date" class="form-control" name="end_date[]"
                                                        value="{{ $end_date[$key] ?? '' }}" placeholder="End Date">
                                                    <label for="end_date">End Date<b class="text-danger">*</b></label>
                                                </div>
                                                <p style="margin-bottom: 2px;"
                                                    class="text-danger error_container end_date_error"
                                                    id="error-end_date_${key}"></p>
                                            </div>

                                            @if ($key == 0)
                                                <div class="col-md-2 pt-3">
                                                    <button type="button" class="btn btn-primary add-area-btn1"
                                                        data-id="Aaddress" id="add1"><i
                                                            class="fa fa-plus"></i></button>
                                                </div>
                                            @else
                                                <div class="col-md-2 pt-3">
                                                    <button type="button" name="remove" id="{{ $key }}"
                                                        class="btn btn-danger btn_remove"><i
                                                            class="fa fa-minus"></i></button>
                                                </div>
                                            @endif
                                    @endforeach
                            </div>
                            <div class="col-md-12" id="mt12"></div>
                    </div>
                    @endif
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
                    cancelButtonText: "CONTINUE EDITING",
                    confirmButtonText: 'DISCARD CHANGES'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "{{ url('/') }}" + "/admin/courses";
                    }
                });
            });
        });
        $(document).ready(function() {
            var i = {{ count($batches) - 1 }};

            $("#add1").click(function() {
                ++i;
                $("#mt12").append(`
                <div class="row g-4" id="row${i}">
                    <div class="col-md-3 pt-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="batch_id[]" placeholder="Batch ID">
                            <label for="batch_id">Batch ID<b class="text-danger">*</b></label>
                        </div>
                        <p style="margin-bottom: 2px;" class="text-danger error_container batch_id_error" id="error-batch_id_${i}"></p>
                    </div>
                    <div class="col-md-3 pt-2">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" name="batch_name[]" placeholder="Batch Name">
                            <label for="batch_name">Batch Name<b class="text-danger">*</b></label>
                        </div>
                        <p style="margin-bottom: 2px;" class="text-danger error_container batch_name_error" id="error-batch_name_${i}"></p>
                    </div>
                    <div class="col-md-2 pt-2">
                        <div class="form-floating form-floating-outline">
                            <input type="date" class="form-control" name="start_date[]" placeholder="Start date">
                            <label for="start_date">Start date<b class="text-danger">*</b></label>
                        </div>
                        <p style="margin-bottom: 2px;" class="text-danger error_container start_date_error" id="error-start_date_${i}"></p>
                    </div>
                    <div class="col-md-2 pt-2">
                        <div class="form-floating form-floating-outline">
                            <input type="date" class="form-control" name="end_date[]" placeholder="End date">
                            <label for="end_date">End date<b class="text-danger">*</b></label>
                        </div>
                        <p style="margin-bottom: 2px;" class="text-danger error_container end_date_error" id="error-end_date_${i}"></p>
                    </div>
                    <div class="col-md-2 pt-2">
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

            $(document).on('submit', 'form#editFrm', function(event) {
                event.preventDefault();
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

                var StartDate = $('input[name="start_date[]"]').map(function() {
                    return $(this).val();
                }).get().join(',');

                formData.append('start_dates', StartDate);

                var EndDate = $('input[name="end_date[]"]').map(function() {
                    return $(this).val();
                }).get().join(',');

                formData.append('end_dates', EndDate);
                // var data = new FormData($(this)[0]);
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
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                    if (response.success == true) {
                        toastr.success("Courses updated Successfully");
                        setTimeout(function() { // Corrected function name
                            window.location = "{{ url('/') }}/admin/courses"; // Corrected URL
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
            event.stopImmediatePropagation();
            return false;
        });
    });

    </script>
@endpush
