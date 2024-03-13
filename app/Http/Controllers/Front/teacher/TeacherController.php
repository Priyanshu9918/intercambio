<?php

namespace App\Http\Controllers\Front\teacher;

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
use Illuminate\Support\Facades\Http;

class teacherController extends Controller
{
    public function teacher_pairing(Request $request)
    {

        DB::beginTransaction();
        try {
            // dd($request->all());
            $b_id = null;
            $merithub  = DB::table('merithub_creditionals')->first();
            $u_level = DB::table('users')->where('id',$request->input('student_id'))->first();
            $userLevel = $u_level ? $u_level->level : null;
            if($request->type == 'In Person'){
                $course = DB::table('courses')->where('level',$userLevel)->where('user_type','student')->where('class_type','One To One')->where('course_type','resources')->first();
                $types = 'One To One';
            }else{
                $course = DB::table('courses')->where('level',$userLevel)->where('user_type','student')->where('class_type','Online')->where('course_type','resources')->first();
                $types = 'Online';
            }

            // $client_id = $merithub->client_id;
            // $course_id = $course->course_id;
            // $access_token = $merithub->merithub_token;
            // $endpoint = "https://course2.meritgraph.com/v1/$client_id/$course_id/batches";
            
            // // Extracting data from the request body
            // $title = $userLevel . ' Lessons ' . $u_level->name . ', ' . Auth::user()->name . now()->format('Y-m-d H:i');
            // $type = 'Materialssss';
            // // $batchToImportContentFrom = $course_id;
            
            // // Data to be sent in the request body
            // $data = [
            //     'title' => $title,
            //     'type' => $type,
            // ];
            
            // // Sending POST request with required headers and data
            // $response = Http::withHeaders([
            //     'Authorization' => $access_token,
            //     'Content-Type' => 'application/json',
            // ])->post($endpoint, $data);
            // // Extracting the batchId from the response
            // $batchId = $response->json('batchId');
            // if(!$batchId){
            //     return 'duplicate batch entry';
            // }
            // // You can return the batchId or handle the response in any other way

            // $data1 = [
            //     'course_id'=>$course_id,
            //     'new_batch_id'=>$batchId,
            //     'new_batch_name'=>$title,
            //     'student_id' => $request->input('student_id'),
            //     'teacher_id' => Auth::user()->id,
            //     'level'=>$userLevel,
            //     'class_type' => $types,
            //     'created_at' => date('Y-m-d H:i:s')
            // ];

            // $b_id = DB::table('new_batch_pairs')->insertGetId($data1);

            $data = [
                'new_batch_id' => $b_id,
                'course_id' => $course->course_id,
                'batch_id' => $course->batch_id,
                'batch_name' =>$course->batch_name,
                'student_id' => $request->input('student_id'),
                'teacher_id' => Auth::user()->id,
                'course_level' => $request->input('level'),
                'class_type' =>  $types,
                'payment_status' => 'unpaid',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $u_id = DB::table('teacher_pairings')->insertGetId($data);

            $user_d = DB::table('users')->where('id',$request->input('student_id'))->first();

            $email1=[
                'sender_email' => $user_d->email,
                'inext_email' => env('MAIL_USERNAME'),
                'name'=> $user_d->name,
            ];
            Mail::send('mail.teacher-t03', $email1, function ($messages) use ($email1) {
                $messages->to($email1['sender_email'])
                    ->from($email1['inext_email'], 'Intercambio');
                $messages->subject("Intercambio teacher onboarding complete!");
            });

            $email=[
                'sender_email' => Auth::user()->email,
                'inext_email' => env('MAIL_USERNAME'),
                'name'=>Auth::user()->name,
            ];
            Mail::send('mail.teacher-t03', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                    ->from($email['inext_email'], 'Intercambio');
                $messages->subject("Thank you for selecting your student!");
            });



            DB::commit();

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function finish_course(Request $request){
        DB::beginTransaction();
        try {

            $teacher_p = $request->id;

            $p_data = DB::table('teacher_pairings')->where('id',$teacher_p)->first();

            $f_course = DB::table('finish_courses')->where('pairing_id',$p_data->id)->first();
            if(isset($f_course)){
                return response()->json([
                    'success1' => false,
                ]); 
            }else{
                $data = [
                    'pairing_id' => $p_data->id,
                    'student_id' => $p_data->student_id,
                    'teacher_id' => $p_data->teacher_id,
                    'level' => $p_data->course_level,
                    'reason' => 'Finished current course',
                    'status' => 2,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('finish_courses')->insert($data);
            }


            DB::commit();

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong finish_courses
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function merithub(Request $request){
        DB::beginTransaction();
        try {
            dd($request->all());
            $b_id = '';
            $merithub  = DB::table('merithub_creditionals')->first();
            $u_level = DB::table('users')->where('id',$request->input('student_id'))->first();
            $userLevel = $u_level ? $u_level->level : null;
            if($request->type == 'In Person'){
                $course = DB::table('courses')->where('level',$userLevel)->where('user_type','student')->where('class_type','One To One')->where('course_type','resources')->first();
                $types = 'One To One';
            }else{
                $course = DB::table('courses')->where('level',$userLevel)->where('user_type','student')->where('course_type','resources')->where('class_type','Online')->first();
                $types = 'Online';
            }

            $client_id = $merithub->client_id;
            $course_id = $course->course_id;
            $access_token = $merithub->merithub_token;
            $endpoint = "https://course2.meritgraph.com/v1/$client_id/$course_id/batches";
            
            // Extracting data from the request body
            $title = $userLevel . ' Lessons ' . $u_level->name . ', ' . Auth::user()->name . now()->format('Y-m-d H:i');
            $type = 'Materialssss';
            // $batchToImportContentFrom = $course_id;
            
            // Data to be sent in the request body
            $data = [
                'title' => $title,
                'type' => $type,
            ];
            
            // Sending POST request with required headers and data
            $response = Http::withHeaders([
                'Authorization' => $access_token,
                'Content-Type' => 'application/json',
            ])->post($endpoint, $data);
            // Extracting the batchId from the response
            $batchId = $response->json('batchId');
            if(!$batchId){
                return 'duplicate batch entry';
            }
            // You can return the batchId or handle the response in any other way

            $data1 = [
                'course_id'=>$course_id,
                'new_batch_id'=>$batchId,
                'new_batch_name'=>$title,
                'student_id' => $request->input('student_id'),
                'teacher_id' => Auth::user()->id,
                'level'=>$userLevel,
                'class_type' => $types,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $b_id = DB::table('new_batch_pairs')->insertGetId($data1);

            $data = [
                'new_batch_id' => $b_id,
                'course_id' => $course_id,
                'batch_id' => $batchId,
                'batch_name' =>$title,
                'student_id' => $request->input('student_id'),
                'teacher_id' => Auth::user()->id,
                'course_level' => $request->input('level'),
                'class_type' =>  $types,
                'payment_status' => 'unpaid',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $u_id = DB::table('teacher_pairings')->insertGetId($data);

            $user_d = DB::table('users')->where('id',$request->input('student_id'))->first();

            $email1=[
                'sender_email' => $user_d->email,
                'inext_email' => env('MAIL_USERNAME'),
                'name'=> $user_d->name,
            ];
            Mail::send('mail.teacher-t03', $email1, function ($messages) use ($email1) {
                $messages->to($email1['sender_email'])
                    ->from($email1['inext_email'], 'Intercambio');
                $messages->subject("Intercambio teacher onboarding complete!");
            });

            $email=[
                'sender_email' => Auth::user()->email,
                'inext_email' => env('MAIL_USERNAME'),
                'name'=>Auth::user()->name,
            ];
            Mail::send('mail.teacher-t03', $email, function ($messages) use ($email) {
                $messages->to($email['sender_email'])
                    ->from($email['inext_email'], 'Intercambio');
                $messages->subject("Thank you for selecting your student!");
            });



            DB::commit();

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function studentlist()
    {
        $teacher = DB::table('teachers')->where('user_id',Auth::user()->id)->first();
        $students = [];
        if($teacher->class_teaching_type == 'Online'){
            $students  = Helper::zipcheck('not matched'); 
        }else{
            $students  = Helper::zipcheck('matched');
        }
        return view('front.teacher.teacher-student-list',compact('teacher','students'));
    }
    public function StudentFilter(Request $request)
    {
        $level = $request->level;
        $avail = $request->availibility;

        $teacher = DB::table('teachers')->where('user_id',Auth::user()->id)->first();
        if($teacher->class_teaching_type == 'Online'){
            $s_id = DB::table('students')->where('zip_match', 'not matched')->pluck('user_id');
            if($s_id){
                if($avail != NULL){
                    $a_id = DB::table('availabilities')->whereIn('user_id',$s_id)->whereIn('day', $avail)->pluck('user_id');
                }else{
                    $a_id = [];
                }
                if(count($a_id) > 0){
                    if($level != NULL){
                        $u_id = DB::table('users')->whereIn('id', $a_id)->whereIn('level', $level)->pluck('id');
                        $student = DB::table('students')->whereIn('user_id', $u_id)->get();
                    }else{
                        $student = DB::table('students')->whereIn('user_id', $a_id)->get();
                    }
                }else{
                    if($level != NULL){
                        $u_id = DB::table('users')->whereIn('id', $s_id)->whereIn('level', $level)->pluck('id');
                        $student = DB::table('students')->whereIn('user_id', $u_id)->get();
                    }else{
                        $student = DB::table('students')->whereIn('user_id', $s_id)->get();  
                    }
                }
            }else{
                $student = [];
            }

        }else{
            $s_id = DB::table('students')->where('zip_match', 'matched')->pluck('user_id');
            if($s_id){
                if($avail != NULL){
                    $a_id = DB::table('availabilities')->whereIn('user_id',$s_id)->whereIn('day', $avail)->pluck('user_id');
                }else{
                    $a_id = [];
                }
                if(count($a_id) > 0){
                    if($level != NULL){
                        $u_id = DB::table('users')->whereIn('id', $a_id)->whereIn('level', $level)->pluck('id');
                        $student = DB::table('students')->whereIn('user_id', $u_id)->get();
                    }else{
                        $student = DB::table('students')->whereIn('user_id', $a_id)->get();
                    }
                }else{
                    if($level != NULL){
                        $u_id = DB::table('users')->whereIn('id', $a_id)->whereIn('level', $level)->pluck('id');
                        $student = DB::table('students')->whereIn('user_id', $u_id)->get();
                    }else{
                        $student = DB::table('students')->whereIn('user_id', $a_id)->get();  
                    }
                }
            }else{
                $student = [];
            }
        }
        return view('front.teacher.teacher-student-list1',compact('teacher','student'));
    }
}
