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

class SupportController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $user = DB::table('supports')
            ->select('supports.*','teacher_pairings.teacher_id as t_name','teacher_pairings.student_id as s_name','teacher_pairings.course_level as c_level')
            ->join('teacher_pairings','supports.pairing_id','=','teacher_pairings.id')
            ->orderBy('id','DESC')->get();
            $datatables = Datatables::of($user)
            ->editColumn('check', function ($row) {
                return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
            })
            ->editColumn('st_name', function ($row) {
                $games2 = DB::table('users')->where('id', $row->s_name)->first();
                return $games2->name ?? '__';
            })
            ->editColumn('t_name', function ($row) {
                $games3 = DB::table('users')->where('id', $row->t_name)->first();
                return $games3->name ?? '___';
            })
            ->editColumn('level', function ($row) {
                return $row->c_level ?? '___';
            })
            ->editColumn('created_at', function ($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->addColumn('action', function($row) {
                $action_1 = '';
                if($row->status == 2){
                    $action_1 = '<select class="form-select '.($row->status == 2 ? 'statusSelect1' : '').'"  data-id="'.base64_encode($row->id).'" style="width: 100px;">
                        <option value="" '.($row->status == 2 ? 'selected' : '').'>Select</option>
                        <option value="'.base64_encode('disable').'" '.($row->status == 0 ? 'selected' : '').'>Reject</option>
                        <option value="'.base64_encode('enable').'" '.($row->status == 1 ? 'selected' : '').'>Approve</option>
                        </select>';
                }
                if($row->status == 0){
                    $action_1 = '<select class="form-select '.($row->status == 2 ? 'statusSelect' : '').'"  data-id="'.base64_encode($row->id).'" style="width: 100px;">
                        <option value="'.base64_encode('disable').'" '.($row->status == 0 ? 'selected' : '').'>Reject</option>
                        </select>';
                }
                if($row->status == 1){
                    $action_1 = '<select class="form-select '.($row->status == 2 ? 'statusSelect' : '').'"  data-id="'.base64_encode($row->id).'" style="width: 100px;">
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

        return view('admin.support');
    }

    public function index1(Request $request)
    {
        if($request->ajax())
        {
            $user = DB::table('new_batch_pairs')->orderBy('id','DESC')->get();
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
            });
            // ->addColumn('action', function($row) {
            //     $action_1 = '';
            //     if($row->status==0)
            //     {
            //     $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
            //                     data-bs-toggle="tooltip" data-placement="top" title=""
            //                     data-bs-original-title="Inactive" href="#" data-dc="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'">
            //                     <span class="icon">
            //                     <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
            //                 </a>';
            //     }
            //     else
            //     {
            //         $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
            //                         data-bs-toggle="tooltip" data-placement="top" title=""
            //                         data-bs-original-title="Active" href="#" data-ac="'.base64_encode($row->id).'" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'">
            //                         <span class="icon">
            //                         <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
            //                     </a>';
            //     }
            //     $action = '';
            //         $action = '<div class="d-flex align-items-center">
            //                         <div class="d-flex">
            //                             '.$action_1.'
            //                         </div>
            //                     </div>';
            //     return $action;
            // });

            $datatables = $datatables->rawColumns(['check','action'])->make(true);

            return $datatables;
        }

        return view('admin.Batches.index');
    }

}
