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

class StateController extends Controller
{
    // public function index(){
    //     return view('admin.user.index');
    // }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $user = DB::table('states')->orderBy('id','DESC')->get();
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
                    //dd($action_1);
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
                $edit_url = url('/admin/state/edit',['id'=>base64_encode($row->id)]);
                $action_2 = '<a href="'.$edit_url.'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                            data-bs-toggle="tooltip" data-placement="top" title=""
                            data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                            <i class="fas fa-trash text-danger"></i>
                        </a>';

                $action = ''; // Initialize the $action variable outside the loop


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

        return view('admin.state.index');
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.state.create');
        }

        $rules = [
            'state_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'short_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
        ];

        $messages = [
            'state_name.required' => 'The state name is required.',
            'state_name.alpha' => 'The state name should only contain alphabetic characters.',
            'state_name.max' => 'The state name should not exceed :max characters.',

            'short_name.required' => 'The Abbreviation is required.',
            'short_name.alpha' => 'The Abbreviation should only contain alphabetic characters.',
            'short_name.max' => 'The Abbreviation should not exceed :max characters.',
        ];

        $validation = Validator::make($request->all(), $rules , $messages);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }


        DB::beginTransaction();
        try{

            $data = [
                'name' => $request->input('state_name'),
                'short_name' => $request->input('short_name'),
                'time_zone' => $request->input('time_zone'),

                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('states')->insert($data);

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
        $state_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $state  = DB::table('states')->where('id',$state_id)->first();

            return view('admin.state.edit',compact('state'));
        }

        $rules = [
            'state_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'short_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],

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

            $data = [
                'name' => $request->input('state_name'),
                'short_name' => $request->input('short_name'),
                'time_zone' => $request->input('time_zone'),
                'updated_by' => Auth::user()->id,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('states')->where('id',$state_id)->update($data);

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
