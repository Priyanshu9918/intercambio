@extends('layouts.front.master')
@section('content')
<style>
  .containor{
    margin-left: 150px;
    margin-top: 35px;
  }
</style>
  <div class="containor">
    <a class="btn btn-primary" href="javascript:void(0)" id="checkzip">click here after submit the Training test.</a>
    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-value"></p>
  </div>
  <iframe id="inlineFrameExample" title="Inline Frame Example" width="100%" height="500" src="https://merithub.com/bur9tq9ueuvrkvehnirg/quizzes/join/sG8K7WN.svBUsAb_pQJO2KIOoV8cLcpys42FwRCmZg_LTIXqUWJmFu-Rx-rQMZ3Pb90GEc3fLyDDmnFajI3daq5sFA?iframe=true&id={{base64_encode($teacher_id)}}&url={{url('api/status-result')}}"></iframe>
    
@endsection
@push('script')
    <script type="text/javascript">
        $(document).on("click", "#checkzip", function() {
          $('.pre-loader').show();
            var active = 4;
            $.ajax({
                url: "{{ route('teacher-after-test') }}",
                type: 'GET',
                data: {
                    id: active,
                },
                dataType: 'json',
                success: function(data) {
                    if(data.success == true){
                      if(data.value == 'Group'){
                        window.setTimeout(function() {
                          window.location = "{{ url('/') }}/teacher-pairing-control";
                        }, 2000);
                      }
                      if(data.value == 'Online'){
                        window.setTimeout(function() {
                          window.location = "{{ url('/') }}/teacher-pairing-control";
                        }, 2000);
                      }
                    }
                    if(data.success == false){
                      $('#error-value').html('Please Complete the Training test then click on this button!');
                      $('.pre-loader').hide();  
                    }
                }
            });

        });
    </script>
@endpush