@extends('layouts.admin.master')
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span> Edit State</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <h5 class="card-header">Edit State </h5>
                    <form class="card-body" action="{{ route('admin.state.edit',['id'=>base64_encode($state->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="short_name" name="short_name" class="form-control" value="{{$state->short_name ?? ''}}" placeholder="user-name">
                                    <label for="short_name">Abbreviation</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-short_name"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="state_name" name="state_name" class="form-control" value="{{$state->name ?? ''}}" placeholder="user-name">
                                    <label for="state_name">State Name</label>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-state_name"></p>
                            </div>
                            @php
                            $time_zones = DB::table('time_zones')->get();
                            @endphp
                            <div class="col-md-12">

                                <div class="form-floating form-floating-outline mb-4">
                                    <select name="time_zone" class="form-control" required="">
                                        @php
                                        $data2 = DB::table('time_zones')->get();
                                        $name = DB::table('time_zones')->where('id', $state->time_zone)->first();
                                        // dd($name);
                                        @endphp
                                        <option value="{{ $name ? $name->id : '' }}">{{ $name ? $name->timezone : '--' }}</option>
                                        @foreach ($data2 as $row)
                                        <option value="{{ $row->id }}">{{ $row->timezone }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label" for="state_id">Select TimeZone</label>

                                </div>
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
{{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
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
                cancelButtonText: "CONTINUE EDITING",
                confirmButtonText: 'DISCARD CHANGES'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect or perform any other action on cancel
                    window.location = "{{ url('/') }}" + "/admin/state";
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {

        $(document).on('submit', 'form#editFrm', function(event) {
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
                        $('.submit').html('Update');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success("state updated Successfully");
                        // Swal.fire({
                        // position: 'top-end',
                        // icon: 'success',
                        // title: 'Blog Updated Successfully',
                        // showConfirmButton: false,
                        // timer: 1500
                        // })
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/')}}" + "/admin/state";
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