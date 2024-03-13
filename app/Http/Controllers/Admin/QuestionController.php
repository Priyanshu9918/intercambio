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

class QuestionController extends Controller
{
    // public function index(){
    //     return view('admin.user.index');
    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = DB::table('questions')->orderBy('q_id', 'ASC')->get();
            $datatables = Datatables::of($user)
                ->editColumn('check', function ($row) {
                    // return $row->q_id;
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_" value="' . $row->q_id . '"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('created_by', function ($row) {
                    $games2 = DB::table('users')->where('id', $row->created_by)->first();
                    return $games2->name ?? '__';
                })
                ->editColumn('user_type', function ($row) {
                    if($row->user_type == 0){
                        return 'Student';
                    }else{
                        return 'Teacher';
                    }
                })
                ->editColumn('updated_by', function ($row) {
                    $games3 = DB::table('users')->where('id', $row->updated_by)->first();
                    return $games3->name ?? '___';
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
                    $edit_url = url('/admin/questions/edit', ['id' => base64_encode($row->id)]);
                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $add_option = url('/admin/questions/add_option', ['id' => base64_encode($row->id)]);
                    $action_6 = '<a href="' . $add_option . '" class="btn btn-sm btn-clean btn-icon" title="add"><i class="fas fa-plus text-warning"></i></a>';

                    $add_option1 = url('/admin/questions/view', ['id' => base64_encode($row->id)]);
                    $action_7 = '<a href="' . $add_option1 . '" class="btn btn-sm btn-clean btn-icon" title="view"><i class="fas fa-eye text-success"></i></a>';

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
                                        ' . $action_6 . '
                                        ' . $action_7 . '

                                    </div>
                                </div>';


                    return $action;
                });

            $datatables = $datatables->rawColumns(['check', 'action','user_type'])->make(true);

            return $datatables;
        }

        return view('admin.questions.index');
    }

    public function view(Request $request)
    {
        if ($request->ajax()) {

            $questions_id = base64_decode($request->id);
            // dd($questions_id);

            $user1 = DB::table('question_options')->where('question_id', $questions_id)->get();
            $datatables = Datatables::of($user1)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })

                // ->editColumn('question', function ($row) {
                //     $games2 = DB::table('questions')->where('id', $row->question_id)->first();
                //     return $games2->question;
                // })

                ->editColumn('created_by', function ($row) {
                    $games2 = DB::table('users')->where('id', $row->created_by)->first();
                    return $games2->name ?? '__';
                })

                ->editColumn('updated_by', function ($row) {
                    $games3 = DB::table('users')->where('id', $row->updated_by)->first();
                    return $games3->name ?? '___';
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
                    $edit_url = url('/admin/questions/edit_option', ['id' => base64_encode($row->id)]);
                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-edit text-info"></i></a>';

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

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.questions.view');
    }
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.questions.create');
        }

        $rules = [
            'question' => 'required',
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

            $data = [
                'question' => $request->input('question'),
                'question_type' => $request->input('question_type'),
                'user_type' => $request->input('user_type'),
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('questions')->insert($data);

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
        $questions_id = base64_decode($request->id);

        if ($request->isMethod('get')) {
            $questions  = DB::table('questions')->where('id', $questions_id)->first();

            return view('admin.questions.edit', compact('questions'));
        }

        $rules = [
            'question' => 'required',
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

            $data = [
                'question' => $request->input('question'),
                'user_type' => $request->input('user_type'),
                'q_id' => $request->input('q_id'),
                'question_type' => $request->input('question_type'),
                'updated_by' => Auth::user()->id,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('questions')->where('id', $questions_id)->update($data);

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

    public function add_option(Request $request)
    {
        $questions_id = base64_decode($request->id);

        if ($request->isMethod('get')) {
            $questions = DB::table('questions')->where('id', $questions_id)->first();

            return view('admin.questions.add_option', compact('questions'));
        }

        $rules = [
            'option.*' => 'required', // Use wildcard to indicate an array of options
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
            $options = $request->input('option');

            // Create an array to store option data
            $optionsData = [];

            foreach ($options as $option) {
                $optionsData[] = [
                    'option' => $option,
                    'question_id' => $questions_id,
                    'status' => 1,
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert all options at once
            DB::table('question_options')->insert($optionsData);

            DB::commit();
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error occurred while adding options.'
            ]);
        }
    }
    public function edit_option(Request $request)
    {
        $question_options_id = base64_decode($request->id);

        if ($request->isMethod('get')) {
            $question_options  = DB::table('question_options')->where('id', $question_options_id)->first();


            return view('admin.questions.edit_option', compact('question_options'));
        }

        $rules = [
            'option' => 'required',
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
            // return $request->all();
            $data = [
                'option' => $request->input('option'),
                'question_id' => $request->input('question_id'),
                'status' => 1,
                'updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('question_options')->where('id', $question_options_id)->update($data);

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
}
