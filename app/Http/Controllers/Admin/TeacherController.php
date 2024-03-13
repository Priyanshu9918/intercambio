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
class TeacherController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $teachers = DB::table('teachers')->orderBy('id', 'DESC')->get();
            $datatables = Datatables::of($teachers)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('created_by', function ($row) {
                    $games = DB::table('users')->where('id', $row->user_id)->first();
                    if($games){
                        $games2 = DB::table('users')->where('id', $games->created_by)->first();
                    }else{
                        $games2 ='';
                    }
                    return $games2->name ?? '___';
                })
                ->editColumn('updated_by', function ($row) {
                    $gamess = DB::table('users')->where('id', $row->user_id)->first();
                    if($gamess){
                        $games3 = DB::table('users')->where('id', $gamess->updated_by)->first();
                    }else{
                        $games3 ='';
                    }
                    return $games3->name ?? '___';
                })
                ->editColumn('email', function ($row) {
                    $gam = DB::table('users')->where('id', $row->user_id)->first();
                    return $gam->email ?? '___';
                })
                ->editColumn('type', function ($row) {
                    return $row->class_type_preference ?? 'Online';
                })
                ->editColumn('created_at', function ($row) {
                    if(isset($row->created_at)){
                        return date('d M, Y', strtotime($row->created_at));
                    }
                })
                ->editColumn('updated_at', function ($row) {
                    if(isset($row->updated_at)){
                        return date('d M, Y', strtotime($row->updated_at));
                    }
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
                    $edit_url = url('/admin/teachers/edit', ['id' => base64_encode($row->id)]);
                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                            data-bs-toggle="tooltip" data-placement="top" title=""
                            data-bs-original-title="Delete" href="javascript:void(0)" data-id="' . base64_encode($row->id) . '">
                            <i class="fas fa-trash text-danger"></i>
                        </a>';

                    $action = '';


                    $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                        ' . $action_1 . '
                                        ' . $action_2 . '
                                        ' . $action_3 . '
                                    </div>
                                </div>';


                    return $action;
                });

            $datatables = $datatables->rawColumns(['check', 'action','type'])->make(true);

            return $datatables;
        }

        return view('admin.teachers.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.teachers.create');
        }
        $rules = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'l_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'volunteer_information' => 'required',
            'here_about_us' => 'required',
            'receiving_text_message' => 'required',
            'phone' => 'required|string|max:15',
            'birthday' => 'required|date|before:today -18 years',
            'gender' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'class_teaching_type' => 'required',
            'class_type_preference' => 'required_if:class_teaching_type,In Person',
            'voluntee_location' => 'required_if:class_teaching_type,In Person',
            // 'location_comment' => 'required_if:class_teaching_type,In Person',
            'time_commitment' => 'required',
            'voluntee_for_intercombio' => 'required',
            // 'other_info' => 'required',
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
                'l_name' => $request->input('l_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => $hashed_random_password,
                'is_verified' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $u_id =    DB::table('users')->insertGetId($datauser);
            $data = [
                'user_id' => $u_id,
                'name' => $request->input('name'),
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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('teachers')->insert($data);
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
        $teachers_id = base64_decode($request->id);
        if ($request->isMethod('get')) {
            $teachers  = DB::table('teachers')->where('id', $teachers_id)->first();
            return view('admin.teachers.edit', compact('teachers'));
        }
        $rules = [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
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
            $student  = DB::table('teachers')->where('id', $teachers_id)->first();

            $userData = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('users')->where('id',  $student->user_id)->update($userData);
            $studentData = [
                'name' => $request->input('name'),
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

            DB::table('teachers')->where('id', $teachers_id)->update($studentData);
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
}
