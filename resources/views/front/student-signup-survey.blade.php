@extends('layouts.front.master')
@section('content')
    <style>
        .form-check label {
            font-size: 13px;
            line-height: 30px;
        }

        .form-check-input[type=radio] {
            margin-top: 5px;
        }
        .p_st{
            font-family: "Roboto", sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 28px;
            color: var(--clr-body-text);
        }
    </style>
    <main>
        <!-- sign in area start -->
        <div class="account-area pt-4 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-8 col-md-10">
                        <div class="account-wrap">
                            <div class="account-main">
                                <h3 class="account-title mb-0">Your Goals </h3>
                                
                                <p class="p_st">Students tell us they joined our English classes for their work, their
                                    education, to support their children and family, to be involved in the community, or
                                    other reasons. We would like to know about why you have chosen to take English classes
                                    so that we can help you meet your personal goals.</p>
                                <form action="{{ route('front.student-signup-survey', ['id' => $students->user_id]) }}"
                                    method="POST" id="editFrm" enctype="multipart/form-data" class="account-form">
                                    @csrf
                                    @php
                                        $questionM = DB::table('questions')
                                            ->where('status', 1)
                                            ->where('question_type', 1)
                                            ->where('user_type', 0)
                                            ->orderBy(DB::raw('CAST(q_id AS SIGNED)'), 'ASC')
                                            ->get();
                                            $studentques = DB::table('question_entries')
                                            ->where('user_id', $students->user_id)
                                            ->get();
                                        foreach ($studentques as $ques) {
                                            $q[$ques->question_id] = $ques->option_id;
                                        }
                                    @endphp
                                    @foreach ($questionM as $tz1)
                                        @php
                                            $question_optionsM = DB::table('question_options')
                                                ->where('status', 1)
                                                ->where('question_id', $tz1->id)
                                                ->get();
                                        @endphp
                                        <div class="row mb-20">
                                            <p style="margin-bottom: 0px;" class="text-danger error_container" id="error-question_{{ $tz1->id }}"></p>

                                            <div class="col-md-12">
                                                <div class="account-form-item ">
                                                    <div class="account-form-label">
                                                        <label>{{ $tz1->question }}<span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name ="question[{{ $tz1->id }}]">

                                            @foreach ($question_optionsM as $ques)
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        @php
                                                            $qArray = isset($q[$tz1->id]) ? json_decode($q[$tz1->id], true) : [];
                                                            $isChecked = is_array($qArray) && in_array($ques->id, $qArray);
                                                        @endphp
                                                        <input class="form-check-input" type="checkbox" name="question[{{ $tz1->id }}][]"
                                                            value="{{ $ques->id }}" @if ($isChecked) checked @endif>
                                                        <label class="form-check-label" for="{{ $ques->id }}">
                                                            {{ $ques->option }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    @php
                                        $question = DB::table('questions')
                                            ->where('status', 1)
                                            ->where('question_type', 0)
                                            ->where('user_type', 0)
                                            ->orderBy(DB::raw('CAST(q_id AS SIGNED)'), 'DESC')
                                            ->take(1)
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
                                                        <label>{{ $tz->question }}<span class="text-danger">*</span></label>
                                                    </div>
                                                    <select name="question[{{ $tz->id }}][]"
                                                        id="question_{{ $tz->id }}"
                                                        class="has-nice-select ds-custom-select" style="display: none;">
                                                        <option value="">Select</option>
                                                        @foreach ($question_options as $ques)
                                                            <option value="{{ $ques->id }}" @if (isset($q[$tz->id]) && $q[$tz->id] == $ques->id) selected @endif>
                                                                {{ $ques->option }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p style="margin-bottom: 0px;" class="text-danger error_container"
                                                        id="error-question_{{ $tz->id }}"></p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="account-form-button">
                                        <button type="submit" class="account-btn submit">Next</button>
                                    </div>
                                </form>
                                <div class="account-bottom">
                                    <div class="account-bottom-text">
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
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
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
                            // toastr.success("The second set of pre-survey questions has been submitted and processed successfully.");
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/student-signup-time-scheduling" +
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
