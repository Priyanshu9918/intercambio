<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Helper;
use Illuminate\Support\Facades\Http;
use Excel;
use App\Imports\UsersImport;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = DB::table('students')->where('status', '<>', 2)->orderBy('id', 'DESC')->get();
            $datatables = Datatables::of($students)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('created_by', function ($row) {
                    $games2 = DB::table('students')->where('id', $row->created_by)->first();
                    return $games2->name ?? '___';
                })

                ->editColumn('updated_by', function ($row) {
                    $games3 = DB::table('users')->where('id', $row->updated_by)->first();
                    return $games3->name ?? '___';
                })
                ->editColumn('level', function ($row) {
                    $u_level = DB::table('users')->where('id', $row->user_id)->first();
                    return $u_level->level ?? '___';
                })
                ->editColumn('type', function ($row) {
                    if($row->zip_match != null){
                        if($row->zip_match == 'matched'){
                            return 'In-Person';
                        }else{
                            return 'Online';
                        }
                    }else{
                        return '___';
                    }
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->editColumn('updated_at', function ($row) {
                    return date('d M, Y', strtotime($row->updated_at));
                })
                ->addColumn('action', function ($row) {
                    $action_1 = '';
                    if ($row->status == 0) {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                        //dd($action_1);
                    } else {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                    }
                    $edit_url = url('/admin/students/edit', ['id' => base64_encode($row->id)]);
                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                            data-bs-toggle="tooltip" data-placement="top" title=""
                            data-bs-original-title="Delete" href="javascript:void(0)" data-id="' . base64_encode($row->id) . '">
                            <i class="fas fa-trash text-danger"></i>
                        </a>';

                    $action = ''; // Initialize the $action variable outside the loop


                        $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                        ' . $action_1 . '
                                        ' . $action_2 . '
                                        ' . $action_3 . '
                                    </div>
                                </div>';


                    return $action;
                });

            $datatables = $datatables->rawColumns(['check','level','action','created_at','updated_at'])->make(true);

            return $datatables;
        }

        return view('admin.students.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.students.create');
        }
        //  dd($request->all());
        $rules = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'l_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
            'birthday' => 'required|date|before:today -18 years',
            'gender' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'time_zone' => 'required',
            'emergency_name' => 'required',
            'emergency_number' => 'required',
            'under_age' => 'required',

        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }

        $hashed_random_password = Hash::make($request->input('password'));

        DB::beginTransaction();
        try {

            $datauser = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'user_type' => 3,
                'is_verified' => 1,
                'password' => $hashed_random_password,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('users')->insertGetId($datauser);
            $data = [
                'user_id' => $u_id,
                'name' => $request->input('name'),
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => $hashed_random_password,
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('gender'),
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip'),
                'time_zone' => $request->input('time_zone'),
                'emergency_name' => $request->input('emergency_name'),
                'emergency_number' => $request->input('emergency_number'),
                'under_age' => $request->input('under_age'),
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            DB::table('students')->insert($data);
            $question = $request->question;
            foreach($question as $ques=>$ans){
                $dataques[] = [
                    'user_id' => $u_id,
                    'question_id' => $ques,
                    'option_id' => $ans,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }
            DB::table('question_entries')->insert($dataques);
            $dayss = $request->day;
            $time_from = $request->time_from;
            $time_to = $request->time_to;

            for ($i = 0; $i < count($dayss); $i++) {
                $dataques = [
                    'user_id' => $u_id,
                    'day' => $dayss[$i],
                    'time_from' => $time_from[$i],
                    'time_to' => $time_to[$i],
                    'created_at' => now(),
                ];

                DB::table('availabilities')->updateOrInsert(
                    [
                        'user_id' => $u_id,
                        'day' => $dayss[$i],
                    ],
                    $dataques
                );
            }

            DB::commit();
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function edit(Request $request)
     {
         $students_id = base64_decode($request->id);
        if ($request->isMethod('get')) {
            $students  = DB::table('students')->where('id',$students_id)->first();

             return view('admin.students.edit', compact('students'));
         }
        $rules = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'l_name' => 'required|alpha|max:255',
            'phone' => 'required|string|max:15',
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
            $student  = DB::table('students')->where('id',$students_id)->first();

            $userData = [
                'name' => $request->input('name'),
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
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('gender'),
                'street_address' => $request->input('street_address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip' => $request->input('zip'),
                'time_zone' => $request->input('time_zone'),
                'emergency_name' => $request->input('emergency_name'),
                'emergency_number' => $request->input('emergency_number'),
                'under_age' => $request->input('under_age'),
                'status' => 1,
                'updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('students')->where('id', $students_id)->update($studentData);
            $questionData = $request->question;
            $student1 = DB::table('students')->where('id', $students_id)->first();

            foreach ($questionData as $ques => $ans) {
                $entry = DB::table('question_entries')
                    ->where(['user_id' => $student1->user_id, 'question_id' => $ques])
                    ->first();

                if ($entry) {
                    DB::table('question_entries')
                        ->where(['user_id' => $student1->user_id, 'question_id' => $ques])
                        ->update(['option_id' => $ans, 'updated_at' => date('Y-m-d H:i:s')]);
                } else {
                    DB::table('question_entries')->insert([
                        'user_id' => $student1->user_id,
                        'question_id' => $ques,
                        'option_id' => $ans,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
            $dayss = $request->day;
            $time_from = $request->time_from;
            $time_to = $request->time_to;

            for ($i = 0; $i < count($dayss); $i++) {
                $dataques = [
                    'user_id' => $student1->user_id,
                    'day' => $dayss[$i],
                    'time_from' => $time_from[$i],
                    'time_to' => $time_to[$i],
                    'created_at' => now(),
                ];

                DB::table('availabilities')->updateOrInsert(
                    [
                        'user_id' => $student1->user_id,
                        'day' => $dayss[$i],
                    ],
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

    public function GroupIndex(Request $request)
    {
        if ($request->ajax()) {
            $students = DB::table('student_pairings')
            ->select('student_pairings.*','purchase_classes.course_id as c_id','purchase_classes.batch_name as b_id')
            ->join('purchase_classes','student_pairings.order_id','=','purchase_classes.id')
            ->where('student_pairings.status','<>',2)->orderBy('id', 'DESC')->get();

            $datatables = Datatables::of($students)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('student', function ($row) {
                    $games2 = DB::table('users')->where('id', $row->user_id)->first();
                    return $games2->name ?? '___';
                })

                ->editColumn('course', function ($row) {
                    $data = DB::table('courses')->where('id', $row->c_id)->first();
                    return $data->course_name ?? '___';
                })
                ->editColumn('batch', function ($row) {
                    return $row->b_id ?? '___';

                })
                ->editColumn('p_status', function ($row) {
                    return $row->pairing_id ? 'Paired' : 'Waitlist';

                })
                ->addColumn('action', function ($row) {
                    if($row->pairing_id){
                        $action_2 = '<a href="javascript:void(0);" data-id="'. $row->id .'" data-sid="'. $row->user_id .'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" title="Pairing Teacher"><i class="fas fa-check text-info"></i></a>';
                    }else{
                        $action_2 = '<a href="javascript:void(0);" data-id="'. $row->id .'" data-sid="'. $row->user_id .'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn" title="Pairing Teacher"><i class="fas fa-sync text-info"></i></a>';
                    }

                    $action = '';

                        $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                        ' . $action_2 . '
                                    </div>
                                </div>';


                    return $action;
                });

            $datatables = $datatables->rawColumns(['check','student','course','batch','action','p_status'])->make(true);

            return $datatables;
        }

        return view('admin.student-group.index');
    }

    public function t_list(Request $request)
    {
        $student_id = $request->st_id;
        $id = $request->id;

        // $t_id = DB::table('teacher_pairings')->where('status',1)->pluck('teacher_id');
        $teacher = DB::table('teachers')->where('class_type_preference','Group Classes')->get();

        return response()->json([
            'success' => true,
            'value' => $teacher,
            'st' =>  $student_id,
            'st_p' =>  $id,
        ]);
        return response()->json($teacher);

    }

    public function pairings(Request $request)
    {
        $rules = [
            'teacher_id' => ['required'],
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


            $st_p = DB::table('student_pairings')->where('id',$request->pay_id)->first();
            $order_id = DB::table('purchase_classes')->where('id', $st_p->order_id)->first();
            $u_level = DB::table('users')->where('id',$request->input('student_id'))->first();
            $userLevel = $u_level ? $u_level->level : null;

            $course = DB::table('courses')->where('id',$order_id->course_id)->first();
            $types = 'Group Classes';

            $course_id = $course->course_id;

            $t_count = DB::table('teacher_pairings')->where(['teacher_id'=>$request->teacher_id,'course_id'=>$course_id,'batch_id'=>$order_id->batch_id,'status'=>1])->count();
            if($t_count <= 15){
                $data = [
                    'course_id' => $course_id,
                    'batch_id' => $order_id->batch_id,
                    'batch_name' =>$order_id->batch_name,
                    'student_id' => $request->input('student_id'),
                    'teacher_id' =>  $request->teacher_id,
                    'course_level' => $userLevel,
                    'class_type' =>  $types,
                    'payment_status' => 'paid',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $u_id = DB::table('teacher_pairings')->insertGetId($data);

                DB::table('student_pairings')->where('id',$request->pay_id)->update(['pairing_id'=>$u_id,'status'=>0]);

                DB::commit();

                return response()->json([
                    'success' => true,
                ]);
            }else{
                DB::commit();

                return response()->json([
                    'success1' => true,
                ]);
            }


            // $user_d = DB::table('users')->where('id',$request->input('student_id'))->first();

            // $email1=[
            //     'sender_email' => $user_d->email,
            //     'inext_email' => env('MAIL_USERNAME'),
            //     'name'=> $user_d->name,
            // ];
            // Mail::send('mail.teacher-t03', $email1, function ($messages) use ($email1) {
            //     $messages->to($email1['sender_email'])
            //         ->from($email1['inext_email'], 'Intercambio');
            //     $messages->subject("Intercambio teacher onboarding complete!");
            // });

            // $email=[
            //     'sender_email' => $teacher->email,
            //     'inext_email' => env('MAIL_USERNAME'),
            //     'name'=>$teacher->name,
            // ];
            // Mail::send('mail.teacher-t03', $email, function ($messages) use ($email) {
            //     $messages->to($email['sender_email'])
            //         ->from($email['inext_email'], 'Intercambio');
            //     $messages->subject("Thank you for selecting your student!");
            // });
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }

    }
    public function ImportData(Request $request)
    {
        Excel::import(new UsersImport, $request->fileInput);
        return response()->json([
            'success' => true,
        ]);
    }
}
