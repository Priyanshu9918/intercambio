@extends('layouts.admin.master')
@section('content')
    <style>
        .dataTable tbody td .form-check {
            padding-left: 0px !important;
        }
    </style>

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Add Courses</a>
            </h4>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">courses</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="courses-datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Type</th>
                                <th>Course Type</th>
                                <th>Class Type</th>
                                <th>Level</th>
                                <th>Title</th>
                                <th>Course Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            if ($("#courses-datatable").length > 0) {
                /*Checkbox Add*/
                var tdCnt = 0;
                var targetDt = $('#courses-datatable').DataTable({

                    processing: true,

                    serverSide: true,

                    ajax: "{{ route('admin.courses') }}",

                    columns: [
                        {
                            data: 'check',
                            name: 'check'
                        },

                        {
                            data: 'user_type',
                            name: 'user_type'
                        },

                        {
                            data: 'course_type',
                            name: 'course_type'
                        },

                        {
                            data: 'class_type',
                            name: 'class_type'
                        },

                        {
                            data: 'level',
                            name: 'level'
                        },

                        {
                            data: 'title',
                            name: 'title'
                        },

                        {
                            data: 'course_name',
                            name: 'course_name'
                        },

                        {
                            data: 'short_description',
                            name: 'short_description'
                        },

                        {
                            data: 'action',
                            name: 'action'
                        },

                    ],
                    "ordering": true,

                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": [0, 3]
                    }],

                });
            }
            $(document).on('click', '.statusBtn', function(event) {

                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                //  alert(user_id);
                var table = 'courses';
                swal({
                        // icon: "warning",
                        type: "warning",
                        title: " Are You Sure Want to change the Status?",
                        text: "",
                        dangerMode: true,
                        showCancelButton: true,
                        confirmButtonColor: "#007358",
                        confirmButtonText: "YES",
                        cancelButtonText: "CANCEL",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(e) {
                        if (e == true) {
                            $.ajax({
                                type: 'POST',
                                url: "{{ route('admin.status-action') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id': id,
                                    'table_name': table,
                                    'type': type
                                },
                                success: function(response) {
                                    if (response.success) {
                                        if (response.type == 'enable') {
                                            $('table.categoryTable tr').find("[data-ac='" +
                                                id + "']").fadeIn("slow");
                                            $('table.categoryTable tr').find("[data-ac='" +
                                                id + "']").removeClass("d-none");

                                            $('table.categoryTable tr').find("[data-dc='" +
                                                id + "']").fadeOut("slow");

                                            $('table.categoryTable tr').find("[data-dc='" +
                                                id + "']").addClass("d-none");

                                        } else if (response.type == 'disable') {
                                            $('table.categoryTable tr').find("[data-dc='" +
                                                id + "']").fadeIn("slow");
                                            $('table.categoryTable tr').find("[data-dc='" +
                                                id + "']").removeClass("d-none");

                                            $('table.categoryTable tr').find("[data-ac='" +
                                                id + "']").fadeOut("slow");

                                            $('table.categoryTable tr').find("[data-ac='" +
                                                id + "']").addClass("d-none");
                                        }

                                        toastr.success(response.message);

                                        window.setTimeout(() => {
                                            window.location.reload();
                                        }, 2000);
                                    } else {

                                    }

                                    swal.close();

                                },
                                error: function(xhr, textStatus, errorThrown) {}

                            });
                        } else {
                            swal.close();
                        }
                    });

            });
            $(document).on('click', '.deleteBtn', function() {

                var _this = $(this);
                var id = $(this).data('id');
                var table = 'courses';
                swal({
                        // icon: "warning",
                        type: "warning",
                        title: "Are You Sure You Want to Delete?",
                        text: "",
                        dangerMode: true,
                        showCancelButton: true,
                        confirmButtonColor: "#007358",
                        confirmButtonText: "YES",
                        cancelButtonText: "CANCEL",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(e) {
                        if (e == true) {
                            _this.addClass('disabled-link');
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "{{ route('admin.delete-action') }}",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id': id,
                                    'table_name': table
                                },
                                success: function(data) {
                                    console.log(data);
                                    window.setTimeout(function() {
                                        _this.removeClass('disabled-link');
                                    }, 2000);

                                    if (data.code == 200) {
                                        window.setTimeout(function() {
                                            window.location.reload();
                                        }, 2000);
                                    }
                                },
                                error: function(response) {
                                    console.log(response);
                                }
                            });
                            swal.close();
                        } else {
                            swal.close();
                        }
                    }
                );
            });
        });
    </script>
@endpush
