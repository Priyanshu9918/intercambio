@extends('layouts.front.master')
@section('content')
    <main>
        <!-- sign in area start -->
        <div class="account-area pt-4 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="account-wrap">
                            <div class="account-main">
                                <h3 class="account-title">Teacher Registration Form</h3>

                                <form action="#"
                                    method="POST" id="editFrm" enctype="multipart/form-data" class="account-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>First name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter First name" value="{{$teachers->name ?? ''}}" name="name" readonly>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Last Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter Last Name" value="{{$teachers->l_name ?? ''}}" name="l_name" readonly>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-l_name">
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
                                                    <input type="text" placeholder="Enter Your Email"
                                                        value="{{$teachers->email ?? ''}}" name="email" readonly>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="account-form-item ">
                                                <div class="account-form-label lh-1 mb-0">
                                                    <label>Volunteer Information <span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="account-form-condition mb-3">
                                            <label class="condition_label">I have read the Volunteer Information page : <a
                                                    href="https://intercambio.org/volunteer-opportunities/teaching-english/"
                                                    target="_blank" class="color_2_ds">Click here </a>to read page
                                                <input type="checkbox" name="volunteer_information" value="1" @if(isset($teachers1) && $teachers1->volunteer_information == 1) checked @endif>
                                                <span class="check_mark"></span>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-volunteer_information">
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>How did you hear about us? <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <select name="here_about_us" class="has-nice-select ds-custom-select"
                                                    style="display: none;" readonly>
                                                    <option value="">Select</option>
                                                    <option value="Social Media" @if(isset($teachers1) && $teachers1->here_about_us == 'Social Media') selected @endif>Social Media</option>
                                                    <option value="Friend" @if(isset($teachers1) && $teachers1->here_about_us == 'Friend') selected @endif>Friend</option>
                                                    <option value="Email" @if(isset($teachers1) && $teachers1->here_about_us == 'Email') selected @endif>Email</option>
                                                    <option value="Conference" @if(isset($teachers1) && $teachers1->here_about_us == 'Conference') selected @endif>Conference</option>
                                                    <option value="Flyer" @if(isset($teachers1) && $teachers1->here_about_us == 'Flyer') selected @endif>Flyer</option>
                                                    <option value="Event" @if(isset($teachers1) && $teachers1->here_about_us == 'Event') selected @endif>Event</option>
                                                    <option value="Newspaper" @if(isset($teachers1) && $teachers1->here_about_us == 'Newspaper') selected @endif>Newspaper</option>
                                                    <option value="Online Search" @if(isset($teachers1) && $teachers1->here_about_us == 'Online Search') selected @endif>Online Search</option>
                                                    <option value="Radio" @if(isset($teachers1) && $teachers1->here_about_us == 'Radio') selected @endif>Radio</option>
                                                    <option value="Schools" @if(isset($teachers1) && $teachers1->here_about_us == 'Schools') selected @endif>Schools</option>
                                                    <option value="Signs" @if(isset($teachers1) && $teachers1->here_about_us == 'Signs') selected @endif>Signs</option>
                                                    <option value="University" @if(isset($teachers1) && $teachers1->here_about_us == 'University') selected @endif>University</option>
                                                    <option value="Volunteer Agency" @if(isset($teachers1) && $teachers1->here_about_us == 'Volunteer Agency') selected @endif>Volunteer Agency</option>
                                                    <option value="Volunteer Fair" @if(isset($teachers1) && $teachers1->here_about_us == 'Volunteer Fair') selected @endif>Volunteer Fair</option>
                                                    <option value="Other" @if(isset($teachers1) && $teachers1->here_about_us == 'Other') selected @endif>Other</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-here_about_us">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="account-form-condition">
                                        <label class="condition_label">By checking this box and providing your phone number,
                                            you consent to receiving text messages from Intercambio Uniting Communities. You
                                            should anticipate receiving 1-2 texts weekly, and you retain the ability to
                                            opt-out at any time by texting the word STOP.
                                            <input type="checkbox" name="receiving_text_message" value="1" @if(isset($teachers1) && $teachers1->receiving_text_message == 1) checked @endif>
                                            <span class="check_mark"></span>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-receiving_text_message">
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Mobile Phone <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter Mobile Phone" name="phone" value="{{$teachers1->phone ?? ''}}" readonly>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone">
                                                </div>
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
                                                    <input type="date" placeholder="" name="birthday" value="{{$teachers1->birthday ?? ''}}" readonly>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-birthday">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Gender <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="gender" class="has-nice-select ds-custom-select"
                                                    style="display: none;" readonly>
                                                    <option value=" ">Select Gender</option>
                                                    <option value="male" @if(isset($teachers1) && $teachers1->gender == 'male') selected @endif>Male</option>
                                                    <option value="female" @if(isset($teachers1) && $teachers1->gender == 'female') selected @endif>Female</option>
                                                    <option value="non-binary" @if(isset($teachers1) && $teachers1->gender == 'non-binary') selected @endif>Non-Binary</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-gender">
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
                                                    <input type="text" placeholder="Enter Street Address" name="address" value="{{$teachers1->address ?? ''}}" readonly>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>City <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter City" name="city" value="{{$teachers1->city ?? ''}}" readonly>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-city">
                                                </div>
                                            </div>
                                        </div>
                                        @php
                                            $state = DB::table('states')
                                                ->where('status', 1)
                                                ->get();
                                        @endphp
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>State <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="state" class="has-nice-select ds-custom-select"
                                                    style="display: none;" readonly>
                                                    <option value="">Select State</option>
                                                    @foreach ($state as $st)
                                                        <option value="{{ $st->id }}" @if(isset($teachers1) && $teachers1->state == $teachers1->state) selected @endif>{{ $st->short_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-state">
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
                                                    <input type="text" placeholder="Enter Zip Code" name="zip" value="{{$teachers1->zip ?? ''}}" readonly>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-zip">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Class Teaching Type <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="class_teaching_type" class="has-nice-select ds-custom-select"
                                                    style="display: none;" id="class_type" readonly>
                                                    <option value="">Select type</option>
                                                    <option value="In Person" @if(isset($teachers1) && $teachers1->class_teaching_type == 'In Person') selected @endif>In Person</option>
                                                    <option value="Online" @if(isset($teachers1) && $teachers1->class_teaching_type == 'Online') selected @endif>Online</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-class_teaching_type">
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="type_pre">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Class Type Preference <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="class_type_preference" class="has-nice-select ds-custom-select"
                                                    style="display: none;" id="type_pre1" readonly>
                                                    <option value="" >Select type</option>
                                                    <option value="Group Classes"  @if(isset($teachers1) && $teachers1->class_type_preference == 'Group Classes') selected @endif>Group Classes</option>
                                                    <option value="One-on-One Tutoring"  @if(isset($teachers1) && $teachers1->class_type_preference == 'One-on-One Tutoring') selected @endif>One-on-One Tutoring</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-class_type_preference">
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="vol_loc">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Preferred Volunteer Locations <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                                <select name="voluntee_location" class="has-nice-select ds-custom-select"
                                                    style="display: none;" readonly>
                                                    <option value="">Select type</option>
                                                    <option value="Boulder" @if(isset($teachers1) && $teachers1->voluntee_location == 'Boulder') selected @endif>Boulder</option>
                                                    <option value="Longmont" @if(isset($teachers1) && $teachers1->voluntee_location == 'Longmont') selected @endif>Longmont</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-voluntee_location">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" id="loc_com">
                                            <div class="account-form-item mb-20 contact-form-input">
                                                <div class="account-form-label">
                                                    <label>Location Comments </label>
                                                </div>
                                                <textarea name="location_comment" id="loc_com1" readonly> {{ $teachers1->location_comment ?? '' }} </textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-location_comment">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="account-form-item ">
                                                <div class="account-form-label lh-1 mb-0">
                                                    <label>Time Commitment <span class="text-danger">*</span></label>
                                                </div>
                                                <small class="mb-2 d-block">ldeally, we are looking for volunteers who are
                                                    able to make a long-term commitment to our program (short, pre-arranged
                                                    breaks are okay). Given this, do you expect to be able to commit to a
                                                    consistent teaching schedule twice a week for 3 to 6 months?</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-20">
                                                <input class="form-check-input" type="radio" name="time_commitment"
                                                    id="Yes" value="yes" @if(isset($teachers1) && $teachers1->time_commitment == 'yes') checked @endif>
                                                <label class="form-check-label" for="1">
                                                    Yes
                                                </label>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-time_commitment">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mb-20">
                                                <input class="form-check-input" type="radio" name="time_commitment"
                                                    id="No" value="No" @if(isset($teachers1) && $teachers1->time_commitment == 'No') checked @endif>
                                                <label class="form-check-label" for="2">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20 contact-form-input">
                                                <div class="account-form-label">
                                                    <label>Why would you like to volunteer for Intercambio?</label>

                                                </div>
                                                <textarea name="voluntee_for_intercombio" readonly>{{$teachers1->voluntee_for_intercombio ?? ''}}</textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-voluntee_for_intercombio">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20 contact-form-input">
                                                <div class="account-form-label">
                                                    <label>Other Information </label>

                                                </div>
                                                <small class="mb-2 d-block">Please share anything else that you would like
                                                    us to know – such as helpful contacts for our program, or issues that
                                                    may pose a challenge to your volunteering with our program.</small>
                                                <textarea name="other_info" readonly> {{$teachers1->other_info ?? ''}} </textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-other_info">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end mt-4">
                                        <div class="col-md-4">
                                            <div class="account-form-button">
                                                <a href="{{url('/teacher-signup-register/'.$teachers->id)}}" class="account-btn bg-light border text-black" style="text-align:center;">Edit</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="account-form-button">
                                                @if(Auth::user()->level != null)
                                                    <a href="{{url('/teacher-student-list')}}" class="account-btn" style="text-align:center;">Submit</a>
                                                @else
                                                    <a href="{{url('/teacher-zip-check/'.$teachers->id)}}" class="account-btn" style="text-align:center;">Submit</a>
                                                @endif
                                            </div>
                                        </div>
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
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
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
                            toastr.success("Teacher Registration  Successfully");
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/student-signup-pre-survey" + "/{{$teachers->id}}";


                                // "{{ route('front.student-signup-pre-survey', ['id' => $students->user_id]) }";
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

            $(document).on('change', '#class_type', function(event) {
                var type = $('#class_type').val();
                if(type == 'Online'){
                    $('#type_pre').addClass('d-none');
                    $('#vol_loc').addClass('d-none');
                    $('#loc_com').addClass('d-none');
                }else{
                    $('#type_pre').removeClass('d-none');
                    $('#vol_loc').removeClass('d-none');
                    $('#loc_com').removeClass('d-none');
                }
            });
            $(document).ready(function() {
                var type = $('#class_type').val();
                // alert(type);
                if(type == 'Online'){
                    $('#type_pre').addClass('d-none');
                    $('#vol_loc').addClass('d-none');
                    $('#loc_com').addClass('d-none');
                }else{
                    $('#type_pre').removeClass('d-none');
                    $('#vol_loc').removeClass('d-none');
                    $('#loc_com').removeClass('d-none');
                }
            });
        });
    </script>
@endpush
