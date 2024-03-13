<?php

namespace App\Http\Controllers\Front;

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

class SupportController extends Controller
{
    public function support(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('front.student.support');
        }
        $rules = [
            'cancel' => ['required'],
        ];
        $messages = [
            'cancel.required' => 'Please select reason of Request Cancellation.',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        $ch_sup = DB::table('supports')->where(['user_id'=>Auth::user()->id,'status'=>2])->first();
        if($ch_sup){
            return response()->json([
                'success12' => false,
            ]);
        }


        DB::beginTransaction();
        try {
            if(Auth::user()->user_type == 2){
                $user = DB::table('teacher_pairings')->where('teacher_id',Auth::user()->id)->where('status',1)->first();
                if($user){
                    
                    $data = [
                        'user_id' => Auth::user()->id,
                        'pairing_id' => $user->id,
                        'reason' => $request->cancel,
                        'status' => 2,
                        'user_type' => 'teacher',
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $u_id = DB::table('supports')->insertGetId($data);
    
                }else{
                    return response()->json([
                        'success1' => false,
                    ]);
                }
            DB::commit();
            return response()->json([
                'success' => true,
            ]);
            }else{
                $user = DB::table('teacher_pairings')->where('student_id', Auth::user()->id)->where('status',1)->first();
                if($user){
                    
                    $data = [
                        'user_id' => Auth::user()->id,
                        'pairing_id' => $user->id,
                        'reason' => $request->cancel,
                        'status' => 2,
                        'user_type' => 'student',
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $u_id = DB::table('supports')->insertGetId($data);
    
                }else{
                    return response()->json([
                        'success1' => false,
                    ]);
                }
                DB::commit();
                if($request->cancel == 'I wish to stop learning English with Intercambio'){
                    return response()->json([
                        'success' => true,
                    ]);
                }else{
                    return response()->json([
                        'success2' => true,
                    ]);
                }

            }



        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}