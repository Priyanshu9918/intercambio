@extends('layouts.admin.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">
                <div>
                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">Add Student</a>
                    <a href="{{ url('/admin/group-class') }}" class="btn btn-primary">Student List</a>
                    <a href="javascript:void(0)" class="btn btn-primary" id="importfile">Imports</a>
                </div>
            </h4>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Student</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="students-datatable">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Phone</th>
                                <th>Level</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Updated By</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
    </div>
    </div>


<div class="modal fade" id="importmodal" tabindex="-1" role="dialog" aria-labelledby="importmodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Import File</h5>
      </div>
      <form class="card-body" action="{{ route('admin.ImportData') }}" method="POST" id="createFrm" enctype="multipart/form-data">
        @csrf        
        <div class="modal-body">
          <div class="form-group">
            <label for="fileInput">Choose File:</label>
            <input type="file" class="form-control-file" id="fileInput" name="fileInput" accept=".csv, .xlsx, .xls">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Import</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection
@push('script')
    <script>
        $(document).ready(function() {

            $(document).on('click', '#importfile', function(event) {
                $('#importmodal').modal('show');
            });

            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                // Clearing the error msg
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
                var password = $('#password').val();
                var confirmPassword = $('#confirm_password').val();
                if (password !== confirmPassword) {
                    $('#error-confirm_password').html('Password and Confirm Password do not match.');
                    $('.submit').attr('disabled', false);
                    $('.form-control').attr('readonly', false);
                    $('.form-control').removeClass('disabled-link');
                    $('.error-control').removeClass('disabled-link');
                    $('.submit').html('Submit');
                    return false;
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
                            toastr.success("Import Data Successfully!");
                            window.setTimeout(function() {
                                location.reload();
                            }, 2000);
                        }

                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control][0]);
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

            if ($("#students-datatable").length > 0) {
                /*Checkbox Add*/
                var tdCnt = 0;
                var targetDt = $('#students-datatable').DataTable({

                    processing: true,

                    serverSide: true,

                    ajax: "{{ route('admin.students') }}",

                    columns: [

                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'l_name',
                            name: 'l_name'
                        },

                        {
                            data: 'email',
                            name: 'email'
                        },

                        {
                            data: 'type',
                            name: 'type'
                        },

                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'level',
                            name: 'level'
                        },
                        
                        {
                            data: 'created_by',
                            name: 'created_by'
                        },

                        {
                            data: 'created_at',
                            name: 'created_at'
                        },

                        {
                            data: 'updated_by',
                            name: 'updated_by'
                        },

                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },

                        {
                            data: 'action',
                            name: 'action'
                        },

                    ],
                    dom: 'Bfrtip',
                    // buttons: [
                    //       'copy', 'csv', 'excel', 'pdf', 'print'
                    // ],
                    buttons: [
                         'excel'
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
                //  alert(students_id);
                var table = 'students';
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

                                    //console.log(response);
                                    if (response.success) {
                                        // window.setTimeout(function(){
                                        //    location.reload();
                                        // },2000);
                                        // toastr.success("Status Changed Successfully");

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
                                error: function(xhr, textStatus, errorThrown) {
                                    // alert("Error: " + errorThrown);
                                }

                            });
                        } else {
                            swal.close();
                        }
                    });

            });

            $(document).on('click', '.deleteBtn', function() {

                var _this = $(this);
                // var result=confirm("Are You Sure You Want to Delete?");
                var id = $(this).data('id');
                var table = 'students';
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
