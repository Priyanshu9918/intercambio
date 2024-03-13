<?php

namespace App\Http\Controllers\Front\student;

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

class StudentController extends Controller
{
    public function student_zip_check(Request $request)
    {
        $student_id = Auth::user()->id;
        if(Auth::user()->level == null){
            return response()->json([
                'success' => false,
            ]);
        }else{
                DB::table('users')->where('id', $student_id)->update(['is_completed'=>1]);
                $zipcode = DB::table('zip_codes')->where('status',1)->pluck('zipcode')->toArray();
                $students1  = DB::table('students')->where('user_id', $student_id)->first();
                if(in_array($students1->zip,$zipcode)){
                    DB::table('students')->where('user_id', $student_id)->update(['zip_match'=>'matched']);
                    return response()->json([
                        'success' => true,
                        'value' => 'Group',
                    ]);
                }else{
                    DB::table('students')->where('user_id', $student_id)->update(['zip_match'=>'not matched']);
                    return response()->json([
                        'success' => true,
                        'value' => 'Online',
                    ]);
                }
                // return view('front.api-test-two',compact('student_id'));
                // return redirect('https://merithub.com/sso/cjhqbn85utj49margtg0?token='.base64_encode($student_id));
        }
    } 
    public function student_result(Request $request)
    {
        $level = Auth::user()->level;
        $total = Auth::user()->total_mark;

        $email=[
            'sender_email' => Auth::user()->email,
            'inext_email' => env('MAIL_USERNAME'),
            'name'=>Auth::user()->name,
            'level'=>$level
        ];
        Mail::send('mail.student-s02', $email, function ($messages) use ($email) {
            $messages->to($email['sender_email'])
                ->from($email['inext_email'], 'Intercambio');
            $messages->subject("Registration Complete, Select Your Class!");
        });

        return view('front.student.student-result',compact('level','total'));
    }
    public function student_result1(Request $request)
    {
        $level = Auth::user()->level;
        $total = Auth::user()->total_mark;
        $email=[
            'sender_email' => Auth::user()->email,
            'inext_email' => env('MAIL_USERNAME'),
            'name'=>Auth::user()->name,
        ];
        Mail::send('mail.student-s07', $email, function ($messages) use ($email) {
            $messages->to($email['sender_email'])
                ->from($email['inext_email'], 'Intercambio');
            $messages->subject("Registration Complete, Select Your Class!");
        });
        return view('front.student.student-result-online',compact('level','total'));
    }
    public function groupcheck(Request $request){
        // dd($request->all());
        $val = $request->value;
        $data = explode('|',$val);
        $course_id=$data[0];
        $batch_id=$data[1];
        $batch_name=$data[2];

        $t_count = DB::table('purchase_classes')->where(['course_id'=>$course_id,'batch_id'=>$batch_id,'is_completed'=>1])->count();
        // $c_count = DB::table('teacher_pairings')->whereIn('order_id',$t_count)->where('status')->count();

        if($t_count <= 15){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success1' => true,
            ]);
        }

    }
    public function merithub(Request $request)
    {
        DB::beginTransaction();
        try {
    
            $merithub  = DB::table('merithub_creditionals')->first();
            $pairing = DB::table('teacher_pairings')->where(['student_id'=>Auth::user()->id,'status'=>'1'])->first();
            $coursesss = DB::table('courses')->where(['level'=>$pairing->course_level,'class_type'=>'Online','user_type'=>'student','course_type'=>'training'])->first();
            $clientId = $merithub->client_id;
            $courseId = $coursesss->course_id;
            $accessToken = $merithub->merithub_token;
    
            $endpoint = "https://course2.meritgraph.com/v1/{$clientId}/{$courseId}/links";

            // Make the HTTP GET request
            $response = Http::withHeaders([
                'Authorization' => $accessToken,
                'Content-Type' => 'application/json',
            ])->get($endpoint);

            if ($response->successful()) {
                $responseData = $response->json();
                $learnerLink = $responseData['links']['learnerLink'];
            } else {
                $statusCode = $response->status();
                // Handle the error
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to fetch learner link',
                    'status' => $statusCode
                ]);
            }

            $postData = [
                "batchIds" => [$coursesss->batch_id],
                "users" => [
                    [
                        "userId" => Auth::user()->mh_user_id,
                        "link" => $learnerLink
                    ]
                ]
            ];
            
            $endpoint1 = "https://course2.meritgraph.com/v1/{$clientId}/{$courseId}/users";
            
            $response = Http::withHeaders([
                'Authorization' => $accessToken,
                'Content-Type' => 'application/json',
            ])
            ->post($endpoint1,$postData);


            if ($response->successful()) {
                DB::commit();
                $responseData = $response->json();
                return response()->json([
                    'success' => true,
                    'data' => $responseData
                ]);
            } else {
                $statusCode = $response->status();
                // Handle the error
                dd($response->json());
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to post data to MeritGraph',
                    'status' => $statusCode
                ]);
            }
    
        } catch (\Exception $e) {
            DB::rollback();
            // Handle the exception
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    
}
