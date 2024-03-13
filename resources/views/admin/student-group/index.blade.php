@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Student List</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="group-datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Course Name</th>
                            <th>Batch Name</th>
                            <th>Amount</th>
                            <th>Pairing Status</th>
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('admin.pairings') }}" method="POST" id="createFrm2222">
        @csrf
        <input type="hidden" name="student_id" id="student_id">
        <input type="hidden" name="pay_id" id="pay_id">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pairing With Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <select name="teacher_id" class="form-control" id="user_type">
                            </select>
                            <label class="form-label" for="user_type">Select Teacher<b
                                    class="text-danger">*</b></label>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-d"></p>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-teacher_id"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">submit</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function() {

    if ($("#group-datatable").length > 0) {
        /*Checkbox Add*/
        var tdCnt = 0;
        var targetDt = $('#group-datatable').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{route('admin.group-class')}}",

            columns: [

                //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {
                    data: 'check',
                    name: 'check'
                },

                {
                    data: 'student',
                    name: 'student'
                },

                {
                    data: 'course',

                    name: 'course'
                },

                {
                    data: 'batch',

                    name: 'batch'
                },

                {
                    data: 'amount',

                    name: 'amount'
                },

                {
                    data: 'p_status',

                    name: 'p_status'
                },

                {
                    data: 'action',
                    name: 'action'
                },

            ],
            // dom: 'Bfrtip',
            // buttons: [
            //       'copy', 'csv', 'excel', 'pdf', 'print'
            // ],


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
        var sid = $(this).attr('data-sid');
        $.ajax({
            url: "{{ route('admin.t_list') }}",
            type: "get",
            data: {
                'id': id,
                'st_id': sid,
            },
            success: function(data) {
                $("#user_type").empty();
                $("#user_type").html('<option value="">Select Teacher</option>');
                $.each(data.value, function(key, value) {
                    $("#user_type").append('<option value="' + value.user_id + '">' + value
                        .name + '</option>');
                });
                $('#student_id').val(data.st);
                $('#pay_id').val(data.st_p);
                $('#staticBackdrop').modal('show');
            }
        });
    });

    $(document).on('submit', 'form#createFrm2222', function(event) {
        event.preventDefault();
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
                    $('.submit').html('Save');
                }, 2000);
                if (response.success == true) {

                    toastr.success("Pairing updated Successfully");

                    window.setTimeout(function() {
                        location.reload();
                    }, 2000);

                }
                if (response.success1 == true) {

                    $('#error-d').text('*Group class of this batch full to this teacher! So pls select another teacher.')
                    // toastr.success("Pairing updated Successfully");

                    // window.setTimeout(function() {
                    //     location.reload();
                    // }, 2000);

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