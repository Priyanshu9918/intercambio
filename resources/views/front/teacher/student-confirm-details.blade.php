<div class="modal-body" id="confirm-d">
    <h6>You have selected:</h6>
    <form class="card-body" action="{{ route('teacher.teacher_pairing') }}" method="POST" id="createFrm" enctype="multipart/form-data">
        @csrf
        @php
            $avaibility = DB::table('availabilities')->where('user_id',$st_id)->get();
            $user = DB::table('users')->where('id',$st_id)->first();
            $t_data = DB::table('teachers')->where('user_id',Auth::user()->id)->first();

        @endphp
        <input type="hidden" name="student_id" value="{{$st_id}}">
        <input type="hidden" name="level" value="{{$user->level}}">
        <input type="hidden" name="type" value="{{$t_data->class_teaching_type}}">
        <div class="course_details-top mb-0">
            <h3 class="course_details-title">{{$user->name}}</h3>
            <div class="course_details-meta flex-wrap ">
                <div class="course_details-meta-left">
                    <div class="course_details-author-info">
                        <span>Available:</span>
                        <h5>
                            @foreach($avaibility as $avil)
                            <a>{{$avil->day}}, {{$avil->time_from}} to {{$avil->time_to}}</a><br>
                            @endforeach
                        </h5>
                    </div>
                </div>
                <div class="course_details-category">
                    <span>English Level:</span>
                    <h5><a href="">{{$user->level}}</a></h5>
                </div>

            </div>
            <h6 style="margin-top: 3vh;">Please confirm that you would like to be paired and start meeting with this student.
            </h6>
            <div class="row justify-content-end w-100">
                <div class="col-md-6">
                    <div class="account-form-button mb-0">
                        <button type="button" data-bs-dismiss="modal" class="account-btn bg-light border text-black">Go
                            Back</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="account-form-button  mb-0">
                        <button type="submit" class="account-btn ">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>