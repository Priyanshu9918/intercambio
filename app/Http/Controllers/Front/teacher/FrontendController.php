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

class FrontendController extends Controller
{
    public function teacher(Request $request)
    {
        return view('front.teacher.teacher-pre-signup');
    }

    public function teacher_submit(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('front.student-signup');
        }

        $rules = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'l_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ];

        $customMessages = [
            'l_name.required' => 'The Last Name field is required.',
        ];

        $validation = Validator::make($request->all(), $rules ,$customMessages);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }

        DB::beginTransaction();
        try {
            $hashed_random_password = Hash::make($request->input('password'));

            $data = [
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'password' => $hashed_random_password,
                'user_type' => 2,
                'is_completed' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $u_id = DB::table('users')->insertGetId($data);

            $email2 =[
                        'sender_email' => $request->input('email'),
                        'sender_name' => $request->input('name'),
                        'id' => $u_id,
                        'inext_email' => env('MAIL_USERNAME'),
                        'title' => 'Verify Email!',
                    ];

            Mail::send('mail.teacher_verify_email', $email2, function ($messages) use ($email2) {
                $messages->to($email2['sender_email'])
                    ->from($email2['inext_email'], 'Intercombio');
                $messages->subject("Welcome to Intercambio!");
            });

            $datauser = [
                'user_id' => $u_id,
                'name' => $request->input('name'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            DB::table('teachers')->insert($datauser);

            DB::commit();

            return response()->json([
                'success' => true,
                'value' => $u_id
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

    public function teacher_survey(Request $request)
    {
        $teacher_id = $request->id;
        // dd($teacher_id);
        if ($request->isMethod('get')) {
            $teachers  = DB::table('users')->where('id', $teacher_id)->first();
            $teachers1  = DB::table('teachers')->where('user_id', $teacher_id)->first();
            return view('front.teacher.teacher-signup', compact('teachers','teachers1'));
        }

        $rules = [
            'name' => 'required',
            'l_name' => 'required',
            'volunteer_information' => 'required',
            'here_about_us' => 'required',
            'phone' => 'required|numeric|unique:users',
            'birthday' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'class_teaching_type' => 'required',
            'class_type_preference' => 'required_if:class_teaching_type,In Person',
            'voluntee_location' => 'required_if:class_teaching_type,In Person',
            'time_commitment' => 'required',
            'voluntee_for_intercombio' => 'required',

        ];
        $messages = [
            'birthday.required' => 'Required fields have not been completed',
            'phone.unique' => 'The phone number has already been taken.',

        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()

            ]);
        }

        DB::beginTransaction();
        try {
            // dd($students_id);
            $userData = [
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('users')->where('id',$teacher_id)->update($userData);

            $teacherData = [
                'volunteer_information' => $request->input('volunteer_information'),
                'here_about_us' => $request->input('here_about_us'),
                'receiving_text_message' => $request->input('receiving_text_message'),
                'phone' => $request->input('phone'),
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip'),
                'class_teaching_type' => $request->input('class_teaching_type'),
                'class_type_preference' => $request->input('class_type_preference'),
                'voluntee_location' => $request->input('voluntee_location'),
                'location_comment' => $request->input('location_comment'),
                'time_commitment' => $request->input('time_commitment'),
                'voluntee_for_intercombio' => $request->input('voluntee_for_intercombio'),
                'other_info' => $request->input('other_info'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('teachers')->where('user_id', $teacher_id)->update($teacherData);

            DB::commit();

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function teacher_review(Request $request)
    {
        $teacher_id = $request->id;
        // dd($teacher_id);
        if ($request->isMethod('get')) {
            $teachers  = DB::table('users')->where('id', $teacher_id)->first();
            $teachers1  = DB::table('teachers')->where('user_id', $teacher_id)->first();
            return view('front.teacher.teacher-review', compact('teachers','teachers1'));
        }
    }
    public function teacher_verify(Request $request)
    {
        $teacher_id = $request->id;
        return view('front.teacher.verify-email', compact('teacher_id'));
    }
    public function student_verify(Request $request)
    {
        $teacher_id = $request->id;
        return view('front.teacher.verify-email', compact('teacher_id'));
    }
    public function resend_email(Request $request)
    {
        $teacher_id = $request->id;

        $u_id = DB::table('users')->where('id',$teacher_id)->first();

        $email2 =[
                    'sender_email' => $u_id->email,
                    'sender_name' => $u_id->name,
                    'id' => $teacher_id,
                    'inext_email' => env('MAIL_USERNAME'),
                    'title' => 'Verify Email!',
                ];

        Mail::send('mail.teacher_verify_email', $email2, function ($messages) use ($email2) {
            $messages->to($email2['sender_email'])
                ->from($email2['inext_email'], 'Intercombio');
            $messages->subject("Welcome to Intercambio!");
        });

        return back()->with('message', 'Verification mail sent successfully!');

    }
    public function teacher_zip_check(Request $request)
    {
        $teacher_id = $request->id;
        if ($request->isMethod('get')) {
            DB::table('users')->where('id', $teacher_id)->update(['is_completed'=>1]);
            $zipcode = DB::table('zip_codes')->where('status',1)->pluck('zipcode')->toArray();
            $teachers1  = DB::table('teachers')->where('user_id', $teacher_id)->first();
            if(in_array($teachers1->zip,$zipcode)){
                DB::table('teachers')->where('user_id', $teacher_id)->update(['zip_match'=>'matched']);
            }else{
                DB::table('teachers')->where('user_id', $teacher_id)->update(['zip_match'=>'not matched']);
            }
            // return view('front.api-test',compact('teacher_id'));
            return redirect('https://merithub.com/sso/cjhqbn85utj49margtg0?token='.base64_encode($teacher_id));
            // return redirect()->away('https://merithub.com/sso/cjhqbn85utj49margtg0?token='.base64_encode($teacher_id));

        }
    }

    public function teachercontrol()
    {
        return view('front.teacher.teacher-pairing-control');
    }

    public function teachersupport()
    {
        return view('front.teacher.teacher-support');
    }
    public function teacher_after_check(Request $request)
    {
        $student_id = Auth::user()->id;
        if(Auth::user()->level == null){
            return response()->json([
                'success' => false,
            ]);
        }else{
                DB::table('users')->where('id', $student_id)->update(['is_completed'=>1]);
                $zipcode = DB::table('zip_codes')->where('status',1)->pluck('zipcode')->toArray();
                $students1  = DB::table('teachers')->where('user_id', $student_id)->first();
                if(in_array($students1->zip,$zipcode)){
                    DB::table('teachers')->where('user_id', $student_id)->update(['zip_match'=>'matched']);
                    return response()->json([
                        'success' => true,
                        'value' => 'Group',
                    ]);
                }else{
                    DB::table('teachers')->where('user_id', $student_id)->update(['zip_match'=>'not matched']);
                    return response()->json([
                        'success' => true,
                        'value' => 'Online',
                    ]);
                }
                // return view('front.api-test-two',compact('student_id'));
                // return redirect('https://merithub.com/sso/cjhqbn85utj49margtg0?token='.base64_encode($student_id));
        }
    }
    public function stdetails(Request $request)
    {
        $st_id = $request->st_id;
        return view('front.teacher.student-confirm-details',compact('st_id'));
    }
    public function editProfile(Request $request)
    {
        $studentId = Auth::user()->id;
        $student = DB::table('teachers')->where('user_id', $studentId)->first();
        return view('front.teacher.teacher-edit-profile', compact('student'));
    }
    public function updateProfile(Request $request)
    {
        $studentId = Auth::user()->id;
        $student = DB::table('teachers')->where('user_id', $studentId)->first();
        $rules = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'l_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'phone' => 'required|string|max:15',
            'gender' => 'required',
            'birthday' => 'required',
            // 'birthday' => 'required|date|before:today -18 years',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }
        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'phone' => $request->input('phone'),
                'updated_at' => now()
            ];
            DB::table('users')->where('id', $student->user_id)->update($userData);

            $studentData = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('gender'),
                'status' => 1,
                // 'updated_by' => Auth::user()->id,
                'updated_at' => now()
            ];
            DB::table('teachers')->where('user_id', $studentId)->update($studentData);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function showProfile(Request $request)
    {
        $studentId = Auth::user()->id;
        $student = DB::table('teachers')->where('user_id', $studentId)->first();
        // dd($student);
        return view('front.teacher.teacher-view-profile', compact('student'));
    }


}
