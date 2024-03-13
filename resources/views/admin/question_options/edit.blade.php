@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Edit Question Option Master </h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Question Option Master</h5>
                    <form class="card-body" action="{{ route('admin.question_options.edit',['id'=>base64_encode($question_options->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            @php
                                    $states = DB::table('states')->get();
                                @endphp
                                  <div class="col-md-6">
                                <div class="form-floating form-floating-outline mb-4">
                                    <select name="question_id" class="form-select" id="question_id">
                                        @php
                                            $data2 = DB::table('questions')->get();
                                            $question = DB::table('questions')->where('id', $question_options->question_id)->first();
                                        @endphp
                                        <option value="{{ $question ? $question->id : '' }}">{{ $question ? $question->question : '--' }}</option>
                                        @foreach ($data2 as $row)
                                            <option value="{{ $row->id }}">{{ $row->question }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="option" name="option" class="form-control" value="{{$question_options->option ?? ''}}" placeholder="user-name">
                                    <label for="option">Question Option</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-option"></p>
                            </div>
                        </div>
                        <div class="pt-4" style="text-align-last: center;">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
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

                $(document).on('submit', 'form#editFrm', function (event) {
                    event.preventDefault();
                    //clearing the error msg
                    $('p.error_container').html("");

                    var form = $(this);
                    var data = new FormData($(this)[0]);
                    var url = form.attr("action");
                    var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
                    $('.submit').attr('disabled',true);
                    $('.form-control').attr('readonly',true);
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
                        success: function (response) {
                            window.setTimeout(function(){
                                $('.submit').attr('disabled',false);
                                $('.form-control').attr('readonly',false);
                                $('.form-control').removeClass('disabled-link');
                                $('.error-control').removeClass('disabled-link');
                                $('.submit').html('Update');
                            },2000);
                            //console.log(response);
                            if(response.success==true) {

                                //notify
                                toastr.success("question_options updated Successfully");
                                // Swal.fire({
                                // position: 'top-end',
                                // icon: 'success',
                                // title: 'Blog Updated Successfully',
                                // showConfirmButton: false,
                                // timer: 1500
                                // })
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/')}}"+"/admin/question-options";
                                }, 2000);

                            }
                            //show the form validates error
                            if(response.success==false ) {
                                for (control in response.errors) {
                                var error_text = control.replace('.',"_");
                                $('#error-'+error_text).html(response.errors[control]);
                                // $('#error-'+error_text).html(response.errors[error_text][0]);
                                // console.log('#error-'+error_text);
                                }
                                // console.log(response.errors);
                            }
                        },
                        error: function (response) {
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
