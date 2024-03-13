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

class ZipCodeController extends Controller
{
    // public function index(){
    //     return view('admin.user.index');
    // }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $user = DB::table('zip_codes')->orderBy('id','DESC')->get();
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
                $edit_url = url('/admin/zipcode/edit',['id'=>base64_encode($row->id)]);
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

        return view('admin.zip.index');
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.zip.create');
        }
        $rules = [
            'zipcode' => ['required'],
            // 'country_code' => 'required',
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
                'zipcode' => $request->input('zipcode'),
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('zip_codes')->insert($data);

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
        $time_zones_id = base64_decode($request->id);

        if($request->isMethod('get'))
        {
            $zipcode  = DB::table('zip_codes')->where('id',$time_zones_id)->first();
            return view('admin.zip.edit',compact('zipcode'));
        }

        $rules = [
            'zipcode' => 'required',
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
                'zipcode' => $request->input('zipcode'),
                'updated_by' => Auth::user()->id,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('zip_codes')->where('id',$time_zones_id)->update($data);

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
