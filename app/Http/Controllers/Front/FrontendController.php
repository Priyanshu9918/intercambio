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



class FrontendController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('front.login');
    }
    public function login_view(Request $request)
    {
        if (Auth::check() && Auth::user()->user_type != 0) {
            return redirect('/');
        } else {
            return view('front.index');
        }
    }

    public function student(Request $request)
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
        $messages = [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name field must contain only letters and spaces.',

            'l_name.required' => 'The last name field is required.',
            'l_name.regex' => 'The last name field must contain only letters and spaces.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 6 characters long.',

            'confirm_password.required' => 'The confirm password field is required.',
            'confirm_password.same' => 'The confirm password must match the password.',
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
            $hashed_random_password = Hash::make($request->input('password'));

            $data = [
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'user_type' => 3,
                'is_completed' => 0,
                'password' => $hashed_random_password,
                'created_at' => now(),
                'updated_at' => now()
            ];

            $u_id = DB::table('users')->insertGetId($data);

            $user = DB::table('users')->where('id', $u_id)->first();
            $data['url']    = url('verify_email', $user->id);
            //    dd($data);
            Mail::to(['email' => $user->email])->send(new MyMail($data));
            $datauser = [
                'user_id' => $u_id,
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                // 'phone' => $request->input('phone'),
                'password' => $hashed_random_password,
                'status' => 1,
                'created_by' => $u_id,
                'created_at' => now(),
                'updated_at' => now()
            ];

            DB::table('students')->insert($datauser);


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

    public function student_survey(Request $request)
    {
        $students_id = $request->id;
        // dd($students_id);
        if ($request->isMethod('get')) {
            $students  = DB::table('students')->where('user_id', $students_id)->first();
            return view('front.student-signup-register', compact('students'));
        }


        if ($request->has('phone')) {
            $rules['phone'] = 'required|numeric|unique:users|unique:students';
            $customMessages['phone.required'] = 'The phone field is required.';
            $customMessages['phone.numeric'] = 'The phone must be a numeric value.';
            $customMessages['phone.unique'] = 'The phone number has already been taken.';
        } else {
            $rules['phone'] = 'nullable';
        }
        $rules = [
            'birthday' => 'required|date|before:today -18 years',
            'gender' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'time_zone' => 'required',
            'question.*' => 'required',

        ];
        $customMessages = [
            'birthday.required' => 'The birthday field is required.',
            'birthday.date' => 'The birthday must be a valid date.',
            'birthday.before' => 'The date of birth should reflect an age of 18 years or older.',
            'gender.required' => 'The gender field is required.',
            'street_address.required' => 'The street address field is required.',
            'city.required' => 'The city field is required.',
            'state.required' => 'The state field is required.',
            'zip.required' => 'The zip code field is required.',
            'time_zone.required' => 'The time zone field is required.',
            'question.*.required' => 'Required fields have not been completed.',

        ];
        $validation = Validator::make($request->all(), $rules, $customMessages);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()

            ]);
        }

        DB::beginTransaction();
        try {
            $student  = DB::table('students')->where('user_id', $students_id)->first();
            $userData = [
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('users')->where('id',  $student->user_id)->update($userData);
            $studentData = [
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'trem_condition' => $request->input('trem_condition'),
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('gender'),
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip'),
                'time_zone' => $request->input('time_zone'),
                'status' => 1,
                'updated_by' => $student->user_id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('students')->where('user_id', $student->user_id)->update($studentData);
            $question = $request->question;

            foreach ($question as $ques => $ans) {
                $dataques[] = [
                    'user_id' => $student->user_id,
                    'question_id' => $ques,
                    'option_id' => $ans,
                    'created_at' => now(),
                ];
            }
            if ($student->user_id === null) {
                DB::table('question_entries')->insert($dataques);
            } else {
                foreach ($dataques as $dataque) {
                    DB::table('question_entries')
                        ->updateOrInsert(
                            [
                                'user_id' => $dataque['user_id'],
                                'question_id' => $dataque['question_id'],
                            ],
                            $dataque
                        );
                }
            }

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

    public function student_pre_survey(Request $request)
    {

        $students_id = $request->id;
        if ($request->isMethod('get')) {
            $students  = DB::table('students')->where('user_id', $students_id)->first();

            return view('front.student-signup-pre-survey', compact('students'));
        }
        if ($request->has('emergency_number')) {
            $rules['emergency_number'] = 'required|numeric|unique:students';
            $customMessages['emergency_number.required'] = 'The emergency number field is required.';
            $customMessages['emergency_number.numeric'] = 'The emergency number must be a numeric value.';
            $customMessages['emergency_number.unique'] = 'The emergency number number has already been taken.';
        } else {
            $rules['phone'] = 'nullable';
        }
        $rules = [
            'question.*' => 'required',
            'emergency_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            // 'emergency_number' => 'required|numeric|unique:students',
            'under_age' => 'required',
        ];
        $messages = [
            'question.*.required' => 'Required fields have not been completed',
            'emergency_name.required' => 'The emergency name field is required.',
            'emergency_name.regex' => 'The emergency contact name field should exclusively consist of letters and spaces',
            // 'emergency_number.required' => 'The emergency number field is required.',
            // 'emergency_number.numeric' => 'The emergency contact number field should exclusively consist of numbers.',
            // 'emergency_number.unique' => 'The phone number has already been taken.',
            'under_age.required' => 'The under age field is required.',
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
            $student  = DB::table('students')->where('id', $students_id)->first();
            $studentData = [
                'emergency_name' => $request->input('emergency_name'),
                'emergency_number' => $request->input('emergency_number'),
                'under_age' => $request->input('under_age'),
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('students')->where('user_id', $students_id)->update($studentData);
            $question = $request->question;

            foreach ($question as $ques => $ans) {
                $dataques = [
                    'user_id' => $students_id,
                    'question_id' => $ques,
                    'option_id' => $ans,
                    'created_at' => now(),
                ];
                DB::table('question_entries')->updateOrInsert(
                    ['user_id' => $students_id, 'question_id' => $ques],
                    $dataques
                );
            }
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
    /////////////////last question step//////////////////
    public function student_pre_survey_complete(Request $request)
    {
        $students_id = $request->id;
        if ($request->isMethod('get')) {
            $students  = DB::table('students')->where('user_id', $students_id)->first();

            return view('front.student-signup-survey', compact('students'));
        }
        $rules = [
            'question.*' => 'required',
        ];

        $messages = [
            'question.*.required' => 'Required fields have not been completed',
        ];


        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()

            ]);
        }

        // dd($request->all());

        DB::beginTransaction();
        try {
            $question = $request->question;

            foreach ($question as $ques => $ans) {
                $dataques[] = [
                    'user_id' => $students_id,
                    'question_id' => $ques,
                    'option_id' => $ans,
                    'created_at' => now(),
                ];
            }
            foreach ($dataques as $dataque) {
                // Convert option_id to a JSON string
                $optionIdsJson = json_encode($dataque['option_id']);
            
                DB::table('question_entries')->updateOrInsert(
                    [
                        'user_id' => $dataque['user_id'],
                        'question_id' => $dataque['question_id'],
                    ],
                    [
                        'user_id' => $dataque['user_id'],
                        'question_id' => $dataque['question_id'],
                        'option_id' => $optionIdsJson, // Store option IDs as JSON string
                        'created_at' => $dataque['created_at'],
                    ]
                );
            }
            

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
    public function student_scheduling(Request $request)
    {
        $students_id = $request->id;
    
        // Handle GET request
        if ($request->isMethod('get')) {
            // Retrieve student information
            $students = DB::table('students')->where('user_id', $students_id)->first();
            // Return view with student data
            return view('front.student-signup-time-scheduling', compact('students'));
        }
    
        // Handle POST request (submitting scheduling data)
        $rules = [];
    
        // Validate the request data
        $validation = Validator::make($request->all(), $rules);
    
        // If validation fails, return error response
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        // dd($request->all());
        // Begin database transaction
        DB::beginTransaction();
        try {
            // Retrieve scheduling data from the request
            $dayss = $request->day;
            $time_from = $request->time_from;
            $time_to = $request->time_to;
    
            DB::table('availabilities')->where('user_id', $students_id)->delete();

            // Loop through each day
            for ($i = 0; $i < count($dayss); $i++) {
                // Construct the data array for insertion or update
                $dataques = [
                    'user_id' => $students_id,
                    'day' => $dayss[$i],
                    'time_from' => $time_from[$i],
                    'time_to' => $time_to[$i],
                    'created_at' => now(),
                ];
                // Check if new data is sent for the current day
                if (!empty($time_from[$i]) && !empty($time_to[$i])) {
                    // Delete existing record for the user and day

                    
                    // Insert new record
                    DB::table('availabilities')->insert($dataques);
                }
            }
    
            // Commit the transaction
            DB::commit();
    
            // Return success response
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollback();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    

    public function student_review(Request $request)
    {
        $students_id = $request->id;
        // dd($students_id);
        if ($request->isMethod('get')) {
            $students  = DB::table('students')->where('user_id', $students_id)->first();

            return view('front.student-signup-review ', compact('students'));
        }
    }
    public function teacher(Request $request)
    {
        return view('front.teacher-signup');
    }

    public function signup(Request $request)
    {
        return view('front.signup-account-select');
    }
    public function student_verify(Request $request)
    {
        $student_id = $request->id;
        return view('front.verify-email', compact('$student_id'));
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

  public function teacher_zip_check1(Request $request)
    {
        $student_id = $request->id;
        if ($request->isMethod('get')) {
            DB::table('users')->where('id', $student_id)->update(['is_completed'=>0]);
            $zipcode = DB::table('zip_codes')->where('status',1)->pluck('zipcode')->toArray();
            $students1  = DB::table('students')->where('user_id', $student_id)->first();
            if(in_array($students1->zip,$zipcode)){
                DB::table('students')->where('user_id', $student_id)->update(['zip_match'=>'matched']);
            }else{
                DB::table('students')->where('user_id', $student_id)->update(['zip_match'=>'not matched']);
            }
            return view('front.api-test-two',compact('student_id'));
            // return redirect('https://merithub.com/sso/cjhqbn85utj49margtg0?token='.base64_encode($student_id));
        }
    }
    public function student_zip_check(Request $request)
    {
        $student_id = $request->id;
        if ($request->isMethod('get')) {
            DB::table('users')->where('id', $student_id)->update(['is_completed'=>0]);
            $zipcode = DB::table('zip_codes')->where('status',1)->pluck('zipcode')->toArray();
            $students1  = DB::table('students')->where('user_id', $student_id)->first();
            if(in_array($students1->zip,$zipcode)){
                DB::table('students')->where('user_id', $student_id)->update(['zip_match'=>'matched']);
            }else{
                DB::table('students')->where('user_id', $student_id)->update(['zip_match'=>'not matched']);
            }
            return view('front.api-test-two',compact('student_id'));
            // return redirect('https://merithub.com/sso/cjhqbn85utj49margtg0?token='.base64_encode($student_id));
        }
    }
    public function studentcontrol()
    {
        return view('front.student-pairing-control');
    }
    public function studentcontrol1()
    {
        DB::table('students')->where(['user_id'=>Auth::user()->id])->update(['is_group_class'=>1]);
        return view('front.student-pairing-control');
    }
    public function studentchangepass()
    {
        return view('front.student-change-password');
    }


    public function studentpairing(){
        return view('front.student.teacher-pairing');
    }

    public function editProfile(Request $request)
    {
        $studentId = Auth::user()->id;
        $student = DB::table('students')->where('user_id', $studentId)->first();
        return view('front.student.student-edit-profile', compact('student'));
    }
    public function updateProfile(Request $request)
    {
        $studentId = Auth::user()->id;
        $student = DB::table('students')->where('user_id', $studentId)->first();
        $rules = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'l_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'gender' => 'required',
            'birthday' => 'required|date|before:today -18 years',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'updated_at' => now()
            ];
            DB::table('users')->where('id', $student->user_id)->update($userData);

            $studentData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('gender'),
                'status' => 1,
                'updated_by' => Auth::user()->id,
                'updated_at' => now()
            ];
            DB::table('students')->where('user_id', $studentId)->update($studentData);

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
    public function student_scheduling1(Request $request)
    {
        $students_id = Auth::user()->id;
        if ($request->isMethod('get')) {
            $students  = DB::table('students')->where('user_id', $students_id)->first();
            return view('front.student.student-time-scheduling', compact('students'));
        }
        $rules = [];
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $dayss = $request->day;
            $time_from = $request->time_from;
            $time_to = $request->time_to;
            
            DB::table('availabilities')->where('user_id', $students_id)->delete();

            for ($i = 0; $i < count($dayss); $i++) {
                $dataques = [
                    'user_id' => $students_id,
                    'day' => $dayss[$i],
                    'time_from' => $time_from[$i],
                    'time_to' => $time_to[$i],
                    'created_at' => now(),
                ];
                if (!empty($time_from[$i]) && !empty($time_to[$i])) {
                    DB::table('availabilities')->insert($dataques);
                }
            }
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

    public function showProfile(Request $request)
    {
        $studentId = Auth::user()->id;
        $student = DB::table('students')->where('user_id', $studentId)->first();
        return view('front.student.student-view-profile', compact('student'));
    }




}
    //////////////////student profile img///////////////
