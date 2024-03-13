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
                                <h3 class="account-title">Review Student Registration Form</h3>
                                <form action="#" class="account-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>First name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter First name" class="readonly"
                                                        disabled="true" value="{{ $students->name }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Last Name <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter Last Name" class="readonly"
                                                        disabled="true" value="{{ $students->l_name }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Your Email <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter Your Email" class="readonly"
                                                        disabled="true" value="{{ $students->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Mobile Phone <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter Mobile Phone"
                                                        value="{{ $students->phone }}" class="readonly" disabled="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                        $formattedDate = date('d/m/Y', strtotime($students->birthday));
                                    ?>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Birthdate <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="" value="<?= $formattedDate ?>"
                                                        class="readonly" disabled="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>Gender <span class="text-danger">*</span></label>
                                                </div>
                                                <select name="select" class="has-nice-select ds-custom-select readonly"
                                                    disabled style="display: none;">
                                                    <option value="1">Select Gender</option>
                                                    <option value="male"
                                                        @if ($students->gender == 'male') selected @endif>Male</option>
                                                    <option value="female"
                                                        @if ($students->gender == 'female') selected @endif>Female</option>
                                                    <option value="non-binary"
                                                        @if ($students->gender == 'non-binary') selected @endif>Non-Binary
                                                    </option>
                                                </select>
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
                                                    <input type="text" placeholder="Enter Street Address"
                                                        value="{{ $students->street_address }}" class="readonly"
                                                        disabled="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label>City <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="account-form-input">
                                                    <input type="text" placeholder="Enter City" class="readonly"
                                                        value="{{ $students->city }}" disabled="true">
                                                </div>
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
                                                <select name="select" class="has-nice-select ds-custom-select readonly"
                                                    disabled="true" style="display: none;">
                                                    <option value="{{ $name ? $name->id : '' }}">
                                                        {{ $name ? $name->short_name : '--' }}</option>
                                                    @foreach ($state as $st)
                                                        <option value="{{ $st->id }}">{{ $st->short_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
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
                                                    <input type="text" placeholder="Enter Zip Code" class="readonly"
                                                        value="{{ $students->zip }}" disabled="true">
                                                </div>
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
                                                <select name="select" class="has-nice-select ds-custom-select"
                                                    disabled="true" style="display: none;">
                                                    <option value="{{ $name ? $name->id : '' }}">
                                                        {{ $name ? $name->timezone : '--' }}</option>
                                                    @foreach ($time_zone as $tz)
                                                        <option value="{{ $tz->id }}">{{ $tz->timezone }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $questions = DB::table('questions')
                                            ->select('questions.*', 'question_options.option', 'question_entries.*')
                                            ->leftJoin('question_entries', 'questions.id', '=', 'question_entries.question_id')
                                            ->leftJoin('question_options', 'question_entries.option_id', '=', 'question_options.id')
                                            ->where('questions.status', 1)
                                            ->where('questions.question_type', 0)
                                            ->where('question_entries.user_id', $students->user_id)
                                            ->take(4)
                                            ->get();
                                    @endphp
                                    @foreach ($questions as $tz)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="account-form-item mb-20">
                                                    <div class="account-form-label">
                                                        <label>{{ $tz->question }}<span
                                                                class="text-danger">*</span></label>
                                                    </div>
                                                    <select name="select" class="has-nice-select ds-custom-select"
                                                        disabled="true" style="display: none;">
                                                        <option value="">
                                                            {{ $tz->option }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>
                                    <h5>Please tell us about yourself</h5>
                                    @php
                                        $questiondata = DB::table('questions')
                                            ->select('questions.*', 'question_options.option', 'question_entries.*')
                                            ->leftJoin('question_entries', 'questions.id', '=', 'question_entries.question_id')
                                            ->leftJoin('question_options', 'question_entries.option_id', '=', 'question_options.id')
                                            ->where('questions.status', 1)
                                            ->where('questions.question_type', 0)
                                            ->where('question_entries.user_id', $students->user_id)
                                            ->skip(4) // Skip the first 4 records
                                            ->take(7) // Take the next 4 records
                                            ->get();
                                    @endphp
                                    <div class="row">
                                        @foreach ($questiondata as $tz)
                                            <div class="col-md-6">
                                                <div class="account-form-item mb-20">
                                                    <div class="account-form-label">
                                                        <label class="d-block mb-0">{{ $tz->question }}
                                                        </label>
                                                    </div>
                                                    <label class="d-block answer_label">{{ $tz->option }}</label>
                                                </div>
                                            </div>
                                        @endforeach


                                        <div class="col-md-12">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label class="d-block mb-0">How many children under age 18 live in your
                                                        home?</label>
                                                </div>
                                                <label class="d-block answer_label">{{ $students->under_age }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label class="d-block mb-0">Emergency Contact Name </label>
                                                </div>
                                                <label
                                                    class="d-block answer_label">{{ $students->emergency_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label class="d-block mb-0">Emergency Contact Phone Number </label>
                                                </div>
                                                <label
                                                    class="d-block answer_label">{{ $students->emergency_number }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Your Goals</h5>
                                    @php
                                        $goals = DB::table('questions')
                                            ->select('questions.*', 'question_options.option', 'question_entries.*')
                                            ->leftJoin('question_entries', 'questions.id', '=', 'question_entries.question_id')
                                            ->leftJoin('question_options', 'question_entries.option_id', '=', 'question_options.id')
                                            ->where('questions.status', 1)
                                            ->where('questions.question_type', 1)
                                            ->where('question_entries.user_id', $students->user_id)
                                            ->get();
                                        // dd($goals);
                                    @endphp
                                    <div class="row">
                                        @foreach ($goals as $tz)
                                            <div class="col-md-12">
                                                <div class="account-form-item mb-20">
                                                    <div class="account-form-label">
                                                        <label class="d-block mb-0">{{ $tz->question }}</label>
                                                    </div>
                                                    <label class="d-block answer_label">{{ $tz->option }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                        @php
                                            $questionlast = DB::table('questions')
                                                ->select('questions.*', 'question_options.option', 'question_entries.*')
                                                ->leftJoin('question_entries', 'questions.id', '=', 'question_entries.question_id')
                                                ->leftJoin('question_options', 'question_entries.option_id', '=', 'question_options.id')
                                                ->where('questions.status', 1)
                                                ->where('questions.question_type', 0)
                                                ->where('question_entries.user_id', $students->user_id)
                                                ->orderBy('questions.id', 'DESC')
                                                ->take(1)
                                                ->get();
                                            // dd($questionlast);
                                        @endphp
                                        @foreach ($questionlast as $last)
                                            <div class="col-md-12">
                                                <div class="account-form-item mb-20">
                                                    <div class="account-form-label">
                                                        <label class="d-block mb-0">{{ $last->question }}</label>
                                                    </div>
                                                    <label class="d-block answer_label">{{ $last->option }}</label>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                    <h5>Time Scheduling</h5>
                                    @php
                                        $days = DB::table('availabilities')
                                            ->where('user_id', $students->user_id)
                                            ->get();
                                    @endphp
                                    <div class="row">
                                        @foreach($days as $day)
                                        <div class="col-md-6">
                                            <div class="account-form-item mb-20">
                                                <div class="account-form-label">
                                                    <label class="d-block mb-0">{{$day->day}}</label>
                                                </div>
                                                <label class="d-block answer_label">{{$day->time_from}} - {{$day->time_to}}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="row justify-content-end mt-4">
                                        <div class="col-md-4">
                                            <div class="account-form-button">
                                                <a href="{{url('/student-signup-register/'.$students->user_id)}}" class="account-btn bg-light border text-black" style="text-align: center;">Edit</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="account-form-button">
                                                <a href="{{url('/student-zip-check/'.$students->user_id)}}" class="account-btn" style="text-align:center;">Submit</a>
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
    <script></script>
@endpush
