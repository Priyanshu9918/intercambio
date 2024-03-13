<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\MyMail;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function tinfo(Request $request)
    {
        $header = $request->header();
        $hasHeader = $request->hasHeader('authorization');
        if($hasHeader == true){
            $beare = explode(' ',$header['authorization'][0]);
            $id = base64_decode($beare[1]);
            $user_type = DB::table('users')->where('id',$id)->first();
            if(isset($user_type)){
                if($user_type->user_type == 2){
                    $course_d = DB::table('teacher_pairings')->where(['teacher_id'=>$id,'payment_status'=>'paid','status'=>1])->first();
                    $teacher =DB::table('users')
                    ->join('teachers', 'users.id', '=', 'teachers.user_id')
                    ->select('users.id as id','users.name as name','users.email as email','users.phone as phone','users.user_type as user_type','teachers.city as city_name','teachers.zip as zipcode','teachers.country_code as country_code','teachers.country as country',
                    'teachers.timezone as timezone','teachers.class_teaching_type as class_teaching_type','teachers.class_type_preference as class_type_preference')
                    ->where('users.status', 1)
                    ->where('user_type',2)
                    ->where('users.id',$id)
                    ->orderBy('users.id', 'DESC')
                    ->first();
                    if($teacher->class_type_preference == 'Group Classes'){
                        $t_type = 'Group Class';
                    }elseif($teacher->class_type_preference == 'One-on-One Tutoring'){
                        $t_type = 'One To One';
                    }else{
                        $t_type = 'Online';
                    }
                    $t_course = DB::table('courses')->where(['user_type'=>'Teacher','course_type'=>'training','level'=>$user_type->level,'class_type'=>$t_type])->first();

                    if($teacher != NULL){
                        if($user_type->mh_user_id != null){
                            $teacher->update = true;
                        }else{
                            $teacher->update = false;
                            $teacher->redirectUrl = 'https://merithub.com/cjhqbn85utj49margtg0/cmo9oqr92kqetv5iebog/cmo9oqr92kqetv5iebp0/batchdetails';
                            $teacher->courses = [
                                [
                                    "courseId" => 'cmo9oqr92kqetv5iebog',
                                    "batchIds" => ['cmo9oqr92kqetv5iebp0']
                                ]
                            ];
                        }
                        if(isset($course_d)){
                            $teacher->redirectUrl = 'https://merithub.com/cjhqbn85utj49margtg0/'.$course_d->course_id.'/'.$course_d->batch_id.'/batchdetails';
                            $teacher->courses = [
                                [
                                    "courseId" => $course_d->course_id,
                                    "batchIds" => [$course_d->batch_id]
                                ]
                            ];
                        }
                        $teacher->img = 'https://intercambio.org/wp-content/uploads/2021/12/logo-intercambio-new.svg?fsum=78aeaeedf8bd';
                        $teacher->role = 'C';
                        $teacher->id = (string) $teacher->id;
                    }
                    return response()->json($teacher);
                }
                if($user_type->user_type == 3){
                    $course_d = DB::table('teacher_pairings')->where(['student_id'=>$id,'payment_status'=>'paid','status'=>1])->first();
                    $student =DB::table('users')
                    ->join('students', 'users.id', '=', 'students.user_id')
                    ->select('users.id as id','users.name as name','users.email as email','users.phone as phone','users.user_type as user_type','students.city as city_name','students.zip as zipcode','students.zip as zipcode','students.zip_match as zip_match',
                    'students.time_zone as timezone')
                    ->where('users.status', 1)
                    ->where('user_type',3)
                    ->where('users.id',$id)
                    ->orderBy('users.id', 'DESC')
                    ->first();

                    $t_course = DB::table('courses')->where(['user_type'=>'Student','course_type'=>'training','level'=>$user_type->level,'class_type'=>'Online'])->first();
                    if($student != NULL){
                        if($student->zip_match == 'not matched'){
                            if($user_type->mh_user_id != null){
                                $student->update = true;
                            }else{
                                $student->update = false;
                                $student->redirectUrl = 'https://merithub.com/cjhqbn85utj49margtg0/'.$t_course->course_id.'/'.$t_course->batch_id.'/batchdetails';
                                $student->courses = [
                                    [
                                        "courseId" => $t_course->course_id,
                                        "batchIds" => [$t_course->batch_id]
                                    ]
                                ];
                            }
                            if(isset($course_d)){
                                $student->redirectUrl = 'https://merithub.com/cjhqbn85utj49margtg0/'.$course_d->course_id.'/'.$course_d->batch_id.'/batchdetails';
                                $student->courses = [
                                    [
                                        "courseId" => $course_d->course_id,
                                        "batchIds" => [$course_d->batch_id,$t_course->batch_id]
                                    ]
                                ];
                            }
                        }else{
                            if($user_type->mh_user_id != null){
                                $student->update = true;
                            }else{
                                $student->update = false;
                            }
                            if(isset($course_d)){
                                $student->redirectUrl = 'https://merithub.com/cjhqbn85utj49margtg0/'.$course_d->course_id.'/'.$course_d->batch_id.'/batchdetails';
                                $student->courses = [
                                    [
                                        "courseId" => $course_d->course_id,
                                        "batchIds" => [$course_d->batch_id]
                                    ]
                                ];
                            }
                        }
                        $student->img = 'https://intercambio.org/wp-content/uploads/2021/12/logo-intercambio-new.svg?fsum=78aeaeedf8bd';
                        $student->role = 'M';
                        $student->id = (string) $student->id;
                    }
                    return response()->json($student);
                }
            }else{
                return response()->json(['status'=>false ,'data' => 'no any data found']);
            }
            
        }
    }
    public function sinfo(Request $request)
    {
        $header = $request->header();
        $hasHeader = $request->hasHeader('authorization');
        if($hasHeader == true){
            $beare = explode(' ',$header['authorization'][0]);
            $id = $beare[1];
            dd($id);
            $student =DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->select('users.id as id','users.name as name','users.email as email','users.phone as phone','users.user_type as user_type','students.city as city_name','students.zip as zipcode',
            'students.time_zone as time_zone')
            ->where('users.status', 1)
            ->where('user_type',3)
            ->where('users.id',$request->id)
            ->orderBy('users.id', 'DESC')
            ->get();
            return response()->json([$student]);
        }
    }
    public function status_url1(Request $request){

        // $data = $request->json()->all();
        // dd($request['totalScore']);
        Log::info('Received print request:'.$request['totalScore']);

        return response()->json(['status' => 'success', 'message' => 'Print request received and processed']);

        //  {"totalScore":30,"totalQuestions":5,"attemptedQuestions":0,"maxScore":50,"duration":0,"attemptTime":1703749074,"attemptId":"cm6iangmvcv2ljpg7i3g","userId":"cm6iah9nuvt60nadrl00","id":"OA==","quizId":"catm5p1nuvt2lce3h5p0"} 
    }
    public function status_url(Request $request){

        $data = $request->json()->all();

        $id= base64_decode($request['id']);
        // dd($request['id']);
        Log::info('Received print request:',$request->all());

        if($request['totalScore'] >= 0 && $request['totalScore'] <= 2) {
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'intro','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 3 && $request['totalScore'] <= 14){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'1L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 15 && $request['totalScore'] <= 31){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'2L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 32 && $request['totalScore'] <= 44){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'3L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 45 && $request['totalScore'] <= 58){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'4L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 59 && $request['totalScore'] <= 71){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'5L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] < 0){ // Check for negative score
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'intro','total_mark'=>$request['totalScore'] ]);
        }else{
            DB::table('users')->where('id',$id)->update(['is_completed'=>'0','is_verified'=>'0','status'=>'0','level'=>'6L','total_mark'=>$request['totalScore'] ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Print request received and processed']);

    }
    public function status_url2(Request $request){

        $data = $request->json()->all();

        $id= base64_decode($request['id']);
        Log::info('Received print request:',$request->all());

        if($request['totalScore'] >= 0 && $request['totalScore'] <= 2) {
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'intro','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 3 && $request['totalScore'] <= 14){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'1L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 15 && $request['totalScore'] <= 31){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'2L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 32 && $request['totalScore'] <= 44){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'3L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 45 && $request['totalScore'] <= 58){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'4L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] >= 59 && $request['totalScore'] <= 71){
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'5L','total_mark'=>$request['totalScore'] ]);
        }elseif($request['totalScore'] < 0){ // Check for negative score
            DB::table('users')->where('id',$id)->update(['is_completed'=>'1','level'=>'intro','total_mark'=>$request['totalScore'] ]);
        }else{
            DB::table('users')->where('id',$id)->update(['is_completed'=>'0','is_verified'=>'0','status'=>'0','level'=>'6L','total_mark'=>$request['totalScore'] ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Print request received and processed']);

    }
    public function statusinfo(Request $request)
    {
        log::info($request->all());
        $header = $request->header();
        $hasHeader = $request->hasHeader('authorization');
        if($hasHeader == true){
            $beare = explode(' ',$header['authorization'][0]);
            $id = base64_decode($beare[1]);
            DB::table('users')->where('id',$id)->update(['mh_user_id'=>$request['userId']]);
        }
    }   
}
