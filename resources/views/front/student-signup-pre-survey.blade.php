@extends('layouts.front.master')
@section('content')
    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box !important;
            cursor: pointer !important;
            display: block;
            height: 50px !important;
            user-select: none !important;
            -webkit-user-select: none !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: rgba(83, 82, 87, 0.6) !important;
            line-height: 48px !important;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaaaaa73 !important;
            border-radius: 17px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }
    </style>
    <main>
        <!-- sign in area start -->
        <div class="account-area pt-4 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="account-wrap">
                            <div class="account-main">
                                <h3 class="account-title">Please tell us about yourself </h3>
                                <form action="{{ route('front.student-signup-pre-survey', ['id' => $students->user_id]) }}"
                                    method="POST" id="editFrm" enctype="multipart/form-data" class="account-form">
                                    @csrf
                                    @php
                                        $question = DB::table('questions')
                                            ->where('status', 1)
                                            ->where('question_type', 0)
                                            ->where('user_type', 0)
                                            ->orderBy(DB::raw('CAST(q_id AS SIGNED)'), 'ASC')
                                            ->skip(4)
                                            ->take(7)
                                            ->get();
                                        $studentques = DB::table('question_entries')
                                            ->where('user_id', $students->user_id)
                                            ->get();
                                        foreach ($studentques as $ques) {
                                            $q[$ques->question_id] = $ques->option_id;
                                        }
                                    @endphp
                                    @foreach ($question as $tz)
                                        @php
                                            $question_options = DB::table('question_options')
                                                ->where('status', 1)
                                                ->where('question_id', $tz->id)
                                                ->get();
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="account-form-item mb-20">
                                                    <div class="account-form-label">
                                                        <label>{{ $tz->question }}<span class="text-danger"> *</span></label>
                                                    </div>
                                                    <select name="question[{{ $tz->id }}]"
                                                        id="question_{{ $tz->id }}" class="js-example-basic-singlee"
                                                        style="display: none;">
                                                        <option value="">Select</option>
                                                        @foreach ($question_options as $ques)
                                                            <option value="{{ $ques->id }}"
                                                                @if (isset($q[$tz->id]) && $q[$tz->id] == $ques->id) selected @endif>
                                                                {{ $ques->option }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p style="margin-bottom: 0px;" class="text-danger error_container"
                                                        id="error-question_{{ $tz->id }}"></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>How many children under age 18 live in your home? <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="under_age"
                                                        value="{{ $students->under_age }}" placeholder="Enter here">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-under_age">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Emergency Contact Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="emergency_name"
                                                        value="{{ $students->emergency_name }}" placeholder="Enter Name">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-emergency_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Emergency Contact Phone Number <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="emergency_number"
                                                        value="{{ $students->emergency_number }}"
                                                        placeholder="Enter Phone Number">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-emergency_number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="account-form-button">
                                        <button type="submit" class="account-btn submit">Next</button>
                                    </div>
                                </form>
                                <div class="account-bottom">
                                    <div class="account-bottom-text">
                                        <!-- <p>Already have an account ?  <a href="#">Sign In for here</a></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sign in area end -->
    </main>
@endsection
@push('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-singlee').select2();
        });
        $(document).ready(function() {
            // var $url = "";
            // var $url = "{{ route('front.student-signup-pre-survey', ['id' => $students->id]) }}";
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
                            $('.submit').html('Next');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {

                            //notify
                            // toastr.success(
                            //     "The initial set of pre-survey questions has been submitted and processed successfully."
                            //     );
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/student-signup-survey" +
                                    "/{{ $students->user_id }}";


                                // "{{ route('front.student-signup-pre-survey', ['id' => $students->user_id]) }";
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control]);
                                $('input[name='+error_text+']').focus();
                                $('select[name="' + error_text + '"]').focus();
                                console.log(error_text);
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
