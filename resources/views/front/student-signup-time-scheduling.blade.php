@extends('layouts.front.master')
@section('content')
    <!-- header area end -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/MDtimepickers.css') }}">
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
                                <h3 class="account-title111" style="font-size: 27px;">Time Scheduling </h3>
                                <p style="margin-top: -10px">Please select the days and times you are available for classes.
                                    Please make sure you are
                                    selecting time periods that are at least 90 minutes in length. Time periods that are
                                    longer are fine. Please make sure you are telling us ALL of the times and days you are
                                    available so that we can find a teacher for you.
                                </p>
                                <div class="error-message" style="color: red;"></div>

                                <form
                                    action="{{ route('front.student-signup-time-scheduling', ['id' => $students->user_id]) }}"
                                    method="POST" id="editFrm" enctype="multipart/form-data" class="account-form">
                                    @csrf
                                    @php
                                        $data = DB::table('availabilities')
                                            ->where(['day' => 'Monday', 'user_id' => $students->user_id])
                                            ->first();
                                        $data1 = DB::table('availabilities')
                                            ->where(['day' => 'Tuesday', 'user_id' => $students->user_id])

                                            ->first();
                                        $data2 = DB::table('availabilities')
                                            ->where(['day' => 'Wednesday', 'user_id' => $students->user_id])

                                            ->first();
                                        $data3 = DB::table('availabilities')
                                            ->where(['day' => 'Thursday', 'user_id' => $students->user_id])
                                            ->first();
                                        $data4 = DB::table('availabilities')
                                            ->where(['day' => 'Friday', 'user_id' => $students->user_id])
                                            ->first();
                                        $data5 = DB::table('availabilities')
                                            ->where(['day' => 'Saturday', 'user_id' => $students->user_id])
                                            ->first();
                                        $data6 = DB::table('availabilities')
                                            ->where(['day' => 'Sunday', 'user_id' => $students->user_id])
                                            ->first();
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">Monday
                                                        <input type="checkbox" name="day[]" value="Monday"
                                                            class="day-checkbox"
                                                            @if ($data != null && $data->day == 'Monday') checked @endif>
                                                        <span class="check_mark"></span>
                                                    </label>
                                                </div>

                                                <div class="account-form-input">
                                                    <input type="time" name="time_from[]"
                                                        value="{{ $data->time_from ?? '' }}"  class="timepickers" placeholder="From" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label">&nbsp;</label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_to[]"
                                                        value="{{ $data->time_to ?? '' }}" class="timepickers"
                                                        placeholder="To" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">
                                                        Tuesday
                                                        <input type="checkbox" name="day[]" value="Tuesday"
                                                            class="day-checkbox"
                                                            @if ($data1 != null && $data1->day == 'Tuesday' ?? '') checked @endif>
                                                        <span class="check_mark"></span>
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_from[]"
                                                        value="{{ $data1->time_from ?? '' }}" class="timepickers"
                                                        placeholder="From">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label">&nbsp;
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_to[]"
                                                        value="{{ $data1->time_to ?? '' }}" class="timepickers"
                                                        placeholder="To ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">Wednesday
                                                        <input type="checkbox" name="day[]" value="Wednesday"
                                                            class="day-checkbox"
                                                            @if ($data2 != null && $data2->day == 'Wednesday') checked @endif>
                                                        <span class="check_mark"></span>
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_from[]"
                                                        value="{{ $data2->time_from ?? '' }}" class="timepickers"
                                                        placeholder="From">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label">&nbsp;
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_to[]"
                                                        value="{{ $data2->time_to ?? '' }}" class="timepickers"
                                                        placeholder="To ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">Thursday
                                                        <input type="checkbox" name="day[]" value="Thursday"
                                                            class="day-checkbox"
                                                            @if ($data3 != null && $data3->day == 'Thursday') checked @endif>
                                                        <span class="check_mark"></span>
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_from[]"
                                                        value="{{ $data3->time_from ?? '' }}" class="timepickers"
                                                        placeholder="From">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label">&nbsp;
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_to[]"
                                                        value="{{ $data3->time_to ?? '' }}" class="timepickers"
                                                        placeholder="To ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">Friday
                                                        <input type="checkbox" name="day[]" value="Friday"
                                                            class="day-checkbox"
                                                            @if ($data4 != null && $data4->day == 'Friday') checked @endif>
                                                        <span class="check_mark"></span>
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_from[]"
                                                        value="{{ $data4->time_from ?? '' }}" class="timepickers"
                                                        placeholder="From">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">&nbsp;
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_to[]"
                                                        value="{{ $data4->time_to ?? '' }}" class="timepickers"
                                                        placeholder="To ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">Saturday
                                                        <input type="checkbox" name="day[]" value="Saturday"
                                                            class="day-checkbox"
                                                            @if ($data5 != null && $data5->day == 'Saturday') checked @endif>
                                                        <span class="check_mark"></span>
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_from[]"
                                                        value="{{ $data5->time_from ?? '' }}" class="timepickers"
                                                        placeholder="From">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label">&nbsp;
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_to[]"
                                                        value="{{ $data5->time_to ?? '' }}" class="timepickers"
                                                        placeholder="To">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label text-black fw-semibold">Sunday
                                                        <input type="checkbox" name="day[]" value="Sunday"
                                                            class="day-checkbox"
                                                            @if ($data6 != null && $data6->day == 'Sunday') checked @endif>
                                                        <span class="check_mark"></span>
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_from[]"
                                                        value="{{ $data6->time_from ?? '' }}" class="timepickers"
                                                        placeholder="From">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-condition m-0">
                                                    <label class="condition_label">&nbsp;
                                                    </label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="time" name="time_to[]"
                                                        value="{{ $data6->time_to ?? '' }}" class="timepickers"
                                                        placeholder="To">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="account-form-button">
                                        <button type="submit" class="account-btn submit">Submit</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-singlee').select2();
        });
        $(document).ready(function() {

            function toggleTimeInputs(dayCheckbox, timeFromInput, timeToInput) {
                var isChecked = dayCheckbox.prop('checked');
                var hasValue = timeFromInput.val() !== '' && timeToInput.val() !== '';

                if (isChecked && hasValue) {
                    timeFromInput.prop('disabled', false);
                    timeToInput.prop('disabled', false);
                } else {
                    timeFromInput.prop('disabled', true);
                    timeToInput.prop('disabled', true);
                }
            }
            // Disable time inputs initially
            $('[name="time_from[]"]').each(function() {
                if ($(this).val() === '') {
                    $(this).prop('disabled', true);
                }
            });

            $('[name="time_to[]"]').each(function() {
                if ($(this).val() === '') {
                    $(this).prop('disabled', true);
                }
            });
            $('.day-checkbox').each(function() {
                var timeFromInput = $(this).closest('.account-form-item').find('[name="time_from[]"]');
                var timeToInput = $(this).closest('.row').find('[name="time_to[]"]');

                toggleTimeInputs($(this), timeFromInput, timeToInput);
            });

            $('.day-checkbox').change(function() {
                var timeFromInput = $(this).closest('.account-form-item').find('[name="time_from[]"]');
                var timeToInput = $(this).closest('.row').find('[name="time_to[]"]');

                toggleTimeInputs($(this), timeFromInput, timeToInput);
            });

            $('.day-checkbox').change(function() {
                var timeFromInput = $(this).closest('.account-form-item').find('[name="time_from[]"]');
                var timeToInput = $(this).closest('.row').find('[name="time_to[]"]');

                if ($(this).prop('checked')) {
                    timeFromInput.val('09:00');
                    timeToInput.val('17:00');
                    timeFromInput.prop('disabled', false);
                    timeToInput.prop('disabled', false);
                } else {
                    timeFromInput.val('');
                    timeToInput.val('');
                    timeFromInput.prop('disabled', true);
                    timeToInput.prop('disabled', true);
                }
            });

            $('#editFrm').submit(function(e) {
                var checkedCheckboxes = $('.day-checkbox:checked');

                if (checkedCheckboxes.length < 2) {
                    e.preventDefault();
                    $('.error-message').text('Please select a minimum of two days for availability.')
                        .show();
                } else {

                    $('.error-message').text('').hide();

                    submitForm();
                }
            });

            function submitForm() {
                $(document).on('submit', 'form#editFrm', function(event) {
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
                                $('.submit').html('Submit');
                            }, 2000);
                            //console.log(response);
                            if (response.success == true) {
                                // Notify
                                toastr.success(
                                    "The Time schedules have been submitted successfully."

                                );
                                window.setTimeout(function() {
                                    window.location =
                                        "{{ url('/student-signup-review') }}" +
                                        "/" + "{{ $students->user_id }}";
                                }, 2000);
                            }
                            // Show the form validates error
                            if (response.success == false) {
                                for (control in response.errors) {
                                    var error_text = control.replace('.', "_");
                                    $('#error-' + error_text).html(response.errors[control]);
                                }
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
            }
        });
    </script>
    <script src="{{ asset('front/assets/js/MDtimepickers.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.timepickers').mdtimepickers();
        });

        var inputEle = document.getElementById('timeInput');



    </script>
@endpush
