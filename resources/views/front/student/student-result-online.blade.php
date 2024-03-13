@extends('layouts.front.master')
@section('content')
<style>
    #timer {
        font-size: 10vmin;
    }
</style>
    <main>
        <div class="account-area pt-30 pb-120">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="account-wrap">
                            @if(isset($level) && $level == '6L')
                                <h3 class="account-title mb-2 text-center">Congratulations! </h3>
                                <img  src="{{asset('assets/img/congra.png')}}" style="max-width:100px;" class="d-block mx-auto mb-4 mt-5" />
                                <p style="font-weight: 500;color: #000;" class="text-center">Your Placement Score is <br><b class="result-space">{{$total}}</b></p>
                                <p style="color: #000;    font-size: 19px;" class="text-center">  Your level is <b>{{$level}}</b></p>
                                <p style="color: #000000a8;font-size: 13px;line-height: 20px;" class="text-center">Your score on our Placement Test indicates that your English level is too advanced for our program. You would not be able to improve your English in our program. We encourage you to keep practicing by reading, listening, and speaking English as much as you can! We are unable to enroll you in our program.</p>
                            @else
                            <div class="account-main">
                                <h3 class="account-title mb-2 text-center">Congratulations! </h3>
                                <p style="font-weight: 500;color: #000;" class="text-center">You've completed the registration process.  </p>
                                <img  src="{{asset('assets/img/congra.png')}}" style="max-width:100px;" class="d-block mx-auto mb-4 mt-5" />
                                <p style="font-weight: 500;color: #000;" class="text-center">Your Placement Score is <br><b class="result-space">{{$total}}</b></p>
                                <p style="color: #000;    font-size: 19px;" class="text-center">  You've been enrolled in <b>Level {{$level}}</b></p>
                                <p style="color: #000000a8;font-size: 13px;line-height: 20px;" class="text-center">You are now on the waiting list to study English with your own teacher. We will contact you by email once we have found a teacher for you.</p>
                                <!-- <p class="text-center fw-semibold color_2_ds mt-40">Didn't receive an email in inbox?</p>
                                <div class="account-form-button col-4 mx-auto">
                                        <button type="submit" class="account-btn">Resend Email</button>
                                </div> -->
                                <!-- <p style="color: #000000a8;font-size: 13px;line-height: 20px;" class="text-center">Please Wait 30 sec to redirect on Dashboard.</p> -->

                                <!-- <div class="d-flex text-bold justify-content-center align-items-center" id="timer"></div> -->
                                
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('script')
<!-- <script>
    var time_limit = 30;
        var time_out = setInterval(() => {
        if(time_limit == 0) {
            $('#timer').html('Time Over');
        } else {
            if(time_limit < 10) {
            time_limit = 0 + '' + time_limit;
            }
            $('#timer').html('00:' + time_limit);
            time_limit -= 1;
        }
    }, 1000);
    $(document).ready(function() {
        setTimeout(function() {
            window.location = "{{ url('/') }}/student-pairing-control";
        }, 30000); // 30 seconds in milliseconds
    });
</script> -->
@endpush