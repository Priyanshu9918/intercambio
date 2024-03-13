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

class CourseController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $user = DB::table('courses')->orderBy('id','DESC')->get();
            $datatables = Datatables::of($user)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
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
            ->addColumn('action', function($row) {
                $action_1 = '';
                if($row->status==0)
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                }
                else
                {
                    $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                }
                $edit_url = url('/admin/courses/edit',['id'=>base64_encode($row->id)]);
                $action_2 = '<a href="'.$edit_url.'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                            data-bs-toggle="tooltip" data-placement="top" title=""
                            data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                            <i class="fas fa-trash text-danger"></i>
                        </a>';

                $action = '';


                    $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                       '.$action_1.'
                                        '.$action_2.'
                                        '.$action_3.'
                                    </div>
                                </div>';


                return $action;
            });

            $datatables = $datatables->rawColumns(['check','action'])->make(true);

            return $datatables;
        }

        return view('admin.courses.index');
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.courses.create');
        }
        // dd($request->all());

        $rules = [
            'user_type' => 'required',
            'class_type' => 'required',
            'course_name' => 'required',
            'course_type' => 'required',
            'short_description' => 'required',
            'level' => 'required',
            'title' => 'required',
            'course_id' => 'required',
            'batch_id.*' => 'required',
            'batch_name.*' => 'required',
            'start_date.*' => 'required',
            'end_date.*' => 'required',
        ];
        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }


        DB::beginTransaction();
        try{
            $batchIds = $request->input('batch_ids');
            $batchNames = $request->input('batch_names');
            $StartDates = $request->input('start_dates');
            $endDates = $request->input('end_dates');
            $data = [
                'level' => $request->input('level'),
                'title' => $request->input('title'),
                'class_type' => $request->input('class_type'),
                'user_type' => $request->input('user_type'),
                'course_id' => $request->input('course_id'),
                'course_name' => $request->input('course_name'),
                'course_type' => $request->input('course_type'),
                'batch_id' => $batchIds,
                'batch_name' => $batchNames,
                'Start_date' => $StartDates,
                'end_date' => $endDates,
                'short_description' => $request->input('short_description'),
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('courses')->insert($data);

            DB::commit();
            return response()->json([
                'success' => true
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function edit(Request $request)
    {
        $courses_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $courses  = DB::table('courses')->where('id',$courses_id)->first();

            return view('admin.courses.edit',compact('courses'));
        }

        $rules = [
            'user_type' => 'required',
            'class_type' => 'required',
            'course_name' => 'required',
            'course_type' => 'required',
            'short_description' => 'required',
            'level' => 'required',
            'title' => 'required',
            'course_id' => 'required',
            'batch_id.*' => 'required',
            'batch_name.*' => 'required',
            'start_date.*' => 'required',
            'end_date.*' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }


        try{

                  $batchIds = $request->input('batch_ids');
                  $batchNames = $request->input('batch_names');
                  $StartDate = $request->input('start_dates');
                  $EndDate = $request->input('end_dates');
                  $data = [
                      'level' => $request->input('level'),
                      'title' => $request->input('title'),
                      'class_type' => $request->input('class_type'),
                      'user_type' => $request->input('user_type'),
                      'course_id' => $request->input('course_id'),
                      'course_name' => $request->input('course_name'),
                      'course_type' => $request->input('course_type'),
                      'batch_id' => $batchIds,
                      'batch_name' => $batchNames,
                      'start_date' => $StartDate,
                      'end_date' => $EndDate,
                      'short_description' => $request->input('short_description'),
                      'status' => 1,
                      'updated_by' => Auth::user()->id,
                      'updated_at' => date('Y-m-d H:i:s')
                  ];

                  DB::table('courses')->where('id',$courses_id)->update($data);

                  DB::commit();
                  return response()->json([
                      'success' => true
                  ]);
              }
              catch (\Exception $e) {
                  DB::rollback();
                  // something went wrong
                  return $e;
              }
          }
      }
