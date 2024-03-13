@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span>Selection Menu</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Selection Menu</h5>
                    <form class="card-body" action="{{ route('admin.questions.add_option',['id'=>base64_encode($questions->id)]) }}" method="POST" id="createFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="option" name="option[]" class="form-control">
                                    <label for="option">Question Option<b class="text-danger">*</b></label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-option"></p>

                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary add-area-btn1" data-id="Aaddress" id="add1"><i class="fa fa-plus"></i></button>
                              </div>
                            <div class="col-md-12" id="mt12">
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
        {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script>
       $(document).ready(function () {
    
    // Other existing code...

    // SweetAlert for the cancel button
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
                // Redirect or perform any other action on cancel
                window.location = "{{ url('/') }}" + "/admin/questions";
            }
        });
    });
});
   
    $(document).ready(function() {
    var i = 0;
    $("#add1").click(function() {
        ++i;
    $("#mt12").append(`<div  class="row g-4" id="row${i}">
        <div class="col-md-6 pt-2">
            <div class="form-floating form-floating-outline">
            <input type="text" id="option" name="option[]" class="form-control">
            <label for="option">Question Option<b class="text-danger">*</b></label>
            </div>
            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-option"></p>
        </div>
        <div class="col-md-6 pt-2">
            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-Answer"></p>
            <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button>
            </div>
            </div>
            `);
            });
                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
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
                                toastr.success("Question Option Created Successfully");
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" + "/admin/questions";
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
