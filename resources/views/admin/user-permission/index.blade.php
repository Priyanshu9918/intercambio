@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Utility/</span>User Permission</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">User Permission</h5>
                    <form class="card-body" action="{{url('admin/role-permission/update')}}" method="POST" id="createFrm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-12">
                                <div class="position-relative" data-select2-id="25">
                                    <select id="user_name" class="form-select" data-allow-clear="true" tabindex="-1" aria-hidden="true" name="user_name">
                                        <option value="" data-select2-id="9">Select</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-user_name"></p>
                            </div>
                            <div class="col-md-12">
                                <div id="perm">
                                <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">Menu</th>
                                            <th scope="col">Sub Menu</th>
                                            <th scope="col">Add	</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Del</th>
                                            <th scope="col">View</th>
                                        </tr>
                                        </thead>    
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4" style="text-align-last: center;">
                            <button type="submit"
                                class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
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
                    toastr.success("Permission Updated Successfully");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        window.location = "{{ url('/') }}" + "/admin/user-permission";
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

    $(document).on('change', '#user_name', function(event) {
        var user = $('#user_name').val();
        $.ajax({
            url: "{{ route('admin.permission') }}",
            type: "get",
            data: {
                'user': user,
            },
            success: function(response) {
                $('#perm').replaceWith(response);
            }
        });
    });
});
</script>
@endpush