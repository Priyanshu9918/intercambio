@extends('layouts.front.master')
@section('content')
<style>
.select2-container{
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
.state {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    padding: 8px 12px;
    font-size: 16px;
    border-radius: 4px;
    width: 100%;
    max-width: 300px; /* Adjust width as needed */
}

.state:focus {
    outline: none;
    border-color: #007bff; /* Change border color on focus */
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
                                <h3 class="account-title"> Student Registration Form</h3>
                                <form action="{{ route('front.student-signup-register', ['id' => $students->user_id]) }}"
                                    method="POST" id="editFrm" enctype="multipart/form-data" class="account-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>First name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="name" placeholder="Enter First name"
                                                        value="{{ $students->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Last Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="l_name" placeholder="Enter Last Name"
                                                        value="{{ $students->l_name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Your Email <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="email" class="readonly"
                                                        placeholder="Enter Your Email" value="{{ $students->email }}">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="account-form-condition">
                                        <label class="condition_label">
                                            By checking the box below and providing your phone number, you consent to
                                            receiving text messages from Intercambio Uniting Communities. Message and data
                                            rates may apply. You should anticipate receiving 1-2 texts weekly, and you
                                            retain the ability to opt-out at any time by texting the word STOP. View our <a
                                                href="https://intercambio.org/privacy-policy/" target="_blank"
                                                class="color_2_ds">Privacy Policy.</a>
                                            <input type="checkbox" name="trem_condition" value="1"
                                                onchange="changeColor()" @if ($students->trem_condition == '1') checked @endif
                                                style="background-color: @if ($students->trem_condition == '1') green @endif;">
                                            <span class="check_mark"></span>
                                        </label>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-trem_condition"></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Mobile Phone <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="phone" value="{{ $students->phone }}"
                                                        placeholder="Enter Mobile Phone">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-phone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Birthdate <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="date" name="birthday" value="{{ $students->birthday }}"
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-birthday">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Gender <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="gender" id="gender"
                                                    class="has-nice-select ds-custom-select" style="display: none;">
                                                    <option value="">Select Gender</option>
                                                    <option value="male"
                                                        @if ($students->gender == 'male') selected @endif>Male</option>
                                                    <option value="female"
                                                        @if ($students->gender == 'female') selected @endif>Female</option>
                                                    <option value="non-binary"
                                                        @if ($students->gender == 'non-binary') selected @endif>Non-Binary
                                                    </option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-gender">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Street Address <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="street_address" id="street_address"
                                                        value="{{ $students->street_address }}"
                                                        placeholder="Enter Street Address">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-street_address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>City <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="city" id="city"
                                                        value="{{ $students->city }}" placeholder="Enter City">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-city">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @php
                                                $state = DB::table('states')
                                                    ->where('status', 1)
                                                    ->get();
                                                $name = DB::table('states')
                                                    ->where('id', $students->state)
                                                    ->first();

                                            @endphp
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>State <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="state" class="state" id="state_id">
                                                    <option value="{{ $name ? $name->id : '' }}">
                                                        {{ $name ? $name->short_name : 'Select State' }}</option>
                                                    @foreach ($state as $st)
                                                        <option value="{{ $st->id }}">{{ $st->short_name }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-state">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Zip Code <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" name="zip" id="zip"
                                                        value="{{ $students->zip }}" placeholder="Enter Zip Code">
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-zip">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @php
                                                $time_zone = DB::table('time_zones')
                                                    ->where('status', 1)
                                                    ->get();
                                                $name = DB::table('time_zones')
                                                    ->where('id', $students->time_zone)
                                                    ->first();

                                            @endphp
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Time Zone <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="time_zone" class="js-example-basic-singlee"
                                                    style="display: none;" id="time_id">
                                                    <option value="{{ $name ? $name->id : '' }}">
                                                        {{ $name ? $name->timezone : 'Select Time Zone' }}</option>
                                                    @foreach ($time_zone as $tz)
                                                        <option value="{{ $tz->id }}">{{ $tz->timezone }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-time_zone">
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $question = DB::table('questions')
                                            ->where('status', 1)
                                            ->where('question_type', 0)
                                            ->where('user_type', 0)
                                            ->orderBy(DB::raw('CAST(q_id AS SIGNED)'), 'ASC')
                                            ->take(4)
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
                                                        <label>{{ $tz->question }}<span
                                                                class="text-danger"> *</span></label>
                                                    </div>
                                                    <select name="question[{{ $tz->id }}]" id="question_{{ $tz->id }}"
                                                        class="js-example-basic-singlee" style="display: none;">
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
                                    <div class="account-form-button">
                                        <a href=""><button type="submit" class="account-btn submit">Next</button></a>
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-singlee').select2();
        });

        function changeColor() {
            var checkbox = document.querySelector('input[name="trem_condition"]');
            var checkMark = document.querySelector('.check_mark');

            if (checkbox.checked) {
                checkMark.style.backgroundColor = 'green';
            } else {
                checkMark.style.backgroundColor = '';
            }
        }
        $(document).on('change','.state',function(){
            var id = $('#state_id').val();
            $.ajax({
                    type:"get",
                    url:"{{route('timezone-list')}}",
                    data:{'id':id,"_token": "{{ csrf_token() }}"},
                    success:function(data)
                    {
                        $("#time_id").empty();
                        $("#time_id").html('<option value="">Select TimeZone</option>');
                        $.each(data.value,function(key,value){
                            $("#time_id").append('<option value="'+value.id+'">'+value.timezone+'</option>');
                        });
                    }

                });
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
                            //     "The essential information of the student has been submitted successfully."
                            // );
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/student-signup-pre-survey" +
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
