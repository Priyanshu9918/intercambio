@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Payments</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Payments</h5>
                    <form class="card-body" action="{{ route('admin.payments.create') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                <select name="class_type" class="form-control">
                                    <option value="">Select Class Type</option>
                                    <option value="Group Class">Group Class</option>
                                    <option value="One tO One">One To One</option>
                                    <option value="Online">Online</option>
                                </select>
                                <label class="form-label" for="class_type">Select Class Type<b class="text-danger">*</b></label>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-class_type"></p>

                        </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select name="payment_type" id="payment_type" class="form-control">
                                        <option value="">Select Payment Type</option>
                                        <option value="subscription">Subscription</option>
                                        <option value="terms basis">Terms Basis</option>
                                    </select>
                                    <label class="form-label" for="payment_type">Select Payment Type<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-payment_type"></p>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="fee" name="fee" class="form-control">
                                    <label for="fee">Fee<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-fee"></p>
                            </div>

                            <div class="col-md-6" id="no_of_classes_container">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="no_of_classes" name="no_of_classes" class="form-control">
                                    <label for="no_of_classes">Number of Classes<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-no_of_classes"></p>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#no_of_classes_container").hide();
                $("#payment_type").change(function () {
                    if ($(this).val() === "terms basis") {
                        $("#no_of_classes_container").show();
                    } else {
                        $("#no_of_classes_container").hide();
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $(document).on('click', '#cancelButton', function () {
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
                            window.location = "{{ url('/') }}" + "/admin/payments";
                        }
                    });
                });
            });
        </script>
        <script>
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
                            if (response.success == true) {
                                toastr.success("payments Created Successfully");
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" + "/admin/payments";
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
