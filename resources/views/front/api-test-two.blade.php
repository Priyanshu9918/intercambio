

@extends('layouts.front.master')
@section('content')
<style>
  .containor{
    margin-left: 150px;
    margin-top: 35px;
  }
</style>
<div class="containor">
  <a class="btn btn-primary" href="javascript:void(0)" id="checkzip">click here after submit the placement test.</a>
  <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-value"></p>
</div>
  <iframe id="inlineFrameExample" title="Inline Frame Example" width="100%" height="500" src="https://merithub.com/cjhqbn85utj49margtg0/quizzes/join/30s93Xg.wnmFQdPTvCdoChIXN97NTnudNpdDmWjD3M6M9vVilKkOcmEHG8lQ-Y6zMlPnBuJKN8piQDliE2SLnLcRJw?iframe=true&id={{base64_encode($student_id)}}&url={{url('api/status-result2')}}"></iframe>
@endsection
@push('script')
<script type="text/javascript">
        // $('.tab-value').click(function() {
        //     var t = $(this).text();
        //     $('#addbtn').html('Add' + t);
        // });
        $(document).on("click", "#checkzip", function() {
          $('.pre-loader').show();
            var active = 4;
            $.ajax({
                url: "{{ route('student-after-test') }}",
                type: 'GET',
                data: {
                    id: active,
                },
                dataType: 'json',
                success: function(data) {
                    if(data.success == true){
                      if(data.value == 'Group'){
                        window.setTimeout(function() {
                          window.location = "{{ url('/') }}/student-result/?type=Group";
                        }, 2000);
                      }
                      if(data.value == 'Online'){
                        window.setTimeout(function() {
                          window.location = "{{ url('/') }}/student-result1/?type=Online";
                        }, 2000);
                      }
                    }
                    if(data.success == false){
                      $('#error-value').html('Please Complete the Placement quiz then click on this button!');
                      $('.pre-loader').hide();  
                    }
                }
            });

        });
    </script>
@endpush