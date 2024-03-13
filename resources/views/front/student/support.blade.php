@extends('layouts.student.master')
@section('content')
<style>
.form-check label {
    font-size: 13px;
    line-height: 20px;
}

.form-check-input[type=radio] {
    margin-top: 5px;
}

.support-form .support-input {
    width: 20px !important;
    height: 20px !important;
    margin-top: 5px;
}
.contect-sec{
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
}
.contect-sec .conbox{
    line-height: 20px;
}
.contect-sec li{
    list-style: none;    
}
</style>
<div class="col-xl-9 col-lg-9 col-md-9">
    <div class="account-wrap">
        <div class="account-main">
            <h3 class="account-title">Support</h3>
            <!-- <p class="mb-0">Email for tech support : <a href="mailto:students@intercambio.org" class="text-primary">students@intercambio.org</a></p>            
            <p>Link to tech support docs : <a href="#" class="text-primary">Click here</a></p> -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="contect-sec">
                    <div>
                        <svg style="width:30px;" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24">
                            <path d="m8.5,9.5c0,.551.128,1.073.356,1.537-.49.628-.795,1.407-.836,2.256-.941-.988-1.52-2.324-1.52-3.792,0-3.411,3.122-6.107,6.659-5.381,2.082.428,3.769,2.105,4.213,4.184.134.628.159,1.243.091,1.831-.058.498-.495.866-.997.866h-.045c-.592,0-1.008-.527-.943-1.115.044-.395.021-.81-.08-1.233-.298-1.253-1.32-2.268-2.575-2.557-2.286-.525-4.324,1.207-4.324,3.405Zm-3.89-1.295c.274-1.593,1.053-3.045,2.261-4.178,1.529-1.433,3.531-2.141,5.63-2.011,3.953.256,7.044,3.719,6.998,7.865-.019,1.736-1.473,3.118-3.208,3.118h-2.406c-.244-.829-1.002-1.439-1.91-1.439-1.105,0-2,.895-2,2s.895,2,2,2c.538,0,1.025-.215,1.384-.561h2.932c2.819,0,5.168-2.245,5.208-5.063C21.573,4.715,17.651.345,12.63.021c-2.664-.173-5.191.732-7.126,2.548-1.499,1.405-2.496,3.265-2.855,5.266-.109.608.372,1.166.989,1.166.472,0,.893-.329.972-.795Zm7.39,8.795c-3.695,0-6.892,2.292-7.955,5.702-.165.527.13,1.088.657,1.253.526.159,1.087-.131,1.252-.657.789-2.53,3.274-4.298,6.045-4.298s5.257,1.768,6.045,4.298c.134.428.528.702.955.702.099,0,.198-.015.298-.045.527-.165.821-.726.657-1.253-1.063-3.41-4.26-5.702-7.955-5.702Z"/>
                          </svg>
                    </div>
                    <div class="conbox">
                        <li class="fw-bold">Email for tech support :</li>
                        <li><a href="mailto:online@intercambio.org"  style="color:#118fac;font-weight: 500;">online@intercambio.org</a></li>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contect-sec">
                        <div>
                            <svg  style="width:30px;" id="Layer_1"  viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"><path d="m17 14a1 1 0 0 1 -1 1h-8a1 1 0 0 1 0-2h8a1 1 0 0 1 1 1zm-4 3h-5a1 1 0 0 0 0 2h5a1 1 0 0 0 0-2zm9-6.515v8.515a5.006 5.006 0 0 1 -5 5h-10a5.006 5.006 0 0 1 -5-5v-14a5.006 5.006 0 0 1 5-5h4.515a6.958 6.958 0 0 1 4.95 2.05l3.484 3.486a6.951 6.951 0 0 1 2.051 4.949zm-6.949-7.021a5.01 5.01 0 0 0 -1.051-.78v4.316a1 1 0 0 0 1 1h4.316a4.983 4.983 0 0 0 -.781-1.05zm4.949 7.021c0-.165-.032-.323-.047-.485h-4.953a3 3 0 0 1 -3-3v-4.953c-.162-.015-.321-.047-.485-.047h-4.515a3 3 0 0 0 -3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3z"/></svg>
                        </div>
                        <div class="conbox">
                            <li class="fw-bold">Link to tech support docs :</li>
                            <li><a href="https://intercambio.org/resource-hub"><span style="color:#118fac;font-weight: 500;">Click Here</span></a></li>
                        </div>
                    </div>
                </div>
                </div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed py-2" style="    background-color: #70a943;
                                                color: #fff;" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Request Cancellation
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form class="card-body" action="{{ route('student.support') }}" method="POST" id="createFrm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="account-form-item mb-15">
                                    <div class="account-form-label">
                                        <label class="fw-bold">Request Cancellation</label>
                                    </div>
                                    <div class="account-form-input-pass">
                                        <div class="">
                                            <input type="radio" id="cancel1" name="cancel" value="I wish to stop learning English with Intercambio">
                                            <label for="cancel1">I wish to stop learning English with Intercambio</label><br>
                                            <input type="radio" id="cancel2" name="cancel" value="I’d like to work with a different teacher">
                                            <label for="cancel2">I’d like to work with a different teacher</label><br>
                                            <input type="radio" id="cancel3" name="cancel" value="My teacher doesn’t want to meet anymore – I’d like a new teacher">
                                            <label for="cancel3">My teacher doesn’t want to meet anymore – I’d like a new teacher</label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-cancel">
                                    </div>
                                </div>
                                <div class="account-form-button">
                                    <button type="submit" class="account-btn">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="supportmsg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
      
        <div class="modal-body">
            <div class="course_details-top mb-0 text-center">
                <div class="course_details-meta flex-wrap ">
                    <div class="course_details-meta-left flex-wrap">
                        <p>Thank you for learning with us! We will cancel your payment and membership in the Intercambio Learning System. If you would like to learn with us again in the future, please go to our website <a href="https://intercambio.org" style="color:blue;">https://intercambio.org</a> , and sign up again</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cl_sup">Close</button>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="supportmsg1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-body">
            <div class="mb-0 text-center">
                <div class="flex-wrap ">
                    <div class=" flex-wrap">
                        <span class="d-flex justify-content-end fs-4" style="cursor: pointer;" id="cl_sup1">&times;</span>
                        <h5 class="text-center">Thank you for learning with us!</h5>
                        <p> Someone will contact you soon.</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).on('click','#cl_sup', function(event){
    $('#supportmsg').modal('hide');
    location.reload();
});
$(document).on('click','#cl_sup1', function(event){
    $('#supportmsg1').modal('hide');
    location.reload();
});
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
                toastr.success("Request Cancellation submitted successfully!");
                $('#supportmsg').modal('show');
            }
            if (response.success2 == true) {
                toastr.success("Request Cancellation submitted successfully!");
                $('#supportmsg1').modal('show');
            }
            if (response.success1 == false) {
                $('#error-cancel').html('Currently! You are not paired up with any teacher');
            }
            if (response.success12 == false) {
                $('#error-cancel').html('Your cancellation request already registered!');
            }
            if (response.success == false) {
                for (control in response.errors) {
                    var error_text = control.replace('.', "_");
                    $('#error-' + error_text).html(response.errors[control]);
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
</script>
@endpush