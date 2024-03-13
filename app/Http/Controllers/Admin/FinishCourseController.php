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

class FinishCourseController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax())
        {
            // Your DataTables logic
            $user = DB::table('finish_courses')->orderBy('id','DESC')->get();
            $datatables = Datatables::of($user)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('st_name', function ($row) {
                    $games2 = DB::table('users')->where('id', $row->student_id)->first();
                    return $games2->name ?? '__';
                })
                ->editColumn('t_name', function ($row) {
                    $games3 = DB::table('users')->where('id', $row->teacher_id)->first();
                    return $games3->name ?? '___';
                })
                ->editColumn('level', function ($row) {
                    return $row->level ?? '___';
                })
                ->editColumn('created_at', function ($row) {
                    return date('d M, Y', strtotime($row->created_at));
                })
                ->addColumn('action', function($row) {
                    $action_1 = '';
                    if($row->status == 2){
                        $action_1 = '<select class="form-select '.($row->status == 2 ? 'statusSelect' : '').'" aria-label="Default select example" data-id="'.base64_encode($row->id).'">
                            <option value="" '.($row->status == 2 ? 'selected' : '').'>Select</option>
                            <option value="'.base64_encode('disable').'" '.($row->status == 0 ? 'selected' : '').'>Reject</option>
                            <option value="'.base64_encode('enable').'" '.($row->status == 1 ? 'selected' : '').'>Approve</option>
                            </select>';
                    }
                    if($row->status == 0){
                        $action_1 = '<select class="form-select '.($row->status == 2 ? 'statusSelect' : '').'" aria-label="Default select example" data-id="'.base64_encode($row->id).'">
                            <option value="'.base64_encode('disable').'" '.($row->status == 0 ? 'selected' : '').'>Reject</option>
                            </select>';
                    }
                    if($row->status == 1){
                        $action_1 = '<select class="form-select '.($row->status == 2 ? 'statusSelect' : '').'" aria-label="Default select example" data-id="'.base64_encode($row->id).'">
                            <option value="'.base64_encode('enable').'" '.($row->status == 1 ? 'selected' : '').'>Approve</option>
                            </select>';
                    }
                    $action = '';
                    $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                        '.$action_1.'
                                    </div>
                                </div>';
                    return $action;
                });
    
            $datatables = $datatables->rawColumns(['check','action'])->make(true);
    
            return $datatables;
        }
        else {
            return view('admin.finish-current-course.index');
        }
    }
}