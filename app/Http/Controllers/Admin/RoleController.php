<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Helpers\Helper;

class RoleController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $role = DB::table('roles')->where('status', '<>', 2)->orderBy('id', 'DESC')->get();
            $datatables = Datatables::of($role)
                ->editColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" class=" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
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
                ->addColumn('action', function ($row) {
                    $action_1 = '';
                    if ($row->status == 0) {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="javascript:void(0)" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="javascript:void(0)" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                        //dd($action_1);
                    } else {
                        $action_1 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn d-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Inactive" href="javascript:void(0)" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:red;"></i>                                        </span>
                                    </a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover statusBtn"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-bs-original-title="Active" href="javascript:void(0)" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                        <span class="icon">
                                        <i class="fas fa-circle-dot" style="color:green;"></i>                                        </span>
                                    </a>';
                    }

                    $edit_url = url('/admin/role/edit', ['id' => base64_encode($row->id)]);

                    $action_2 = '<a href="' . $edit_url . '" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                    $action_3 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover deleteBtn"
                data-bs-toggle="tooltip" data-placement="top" title=""
                data-bs-original-title="Delete" href="javascript:void(0)" data-id="' . base64_encode($row->id) . '">
                <i class="fas fa-trash text-danger"></i>
            </a>';
                    $permission_url = url('/admin/role-permission', ['id' => base64_encode($row->id)]);

                    $action_4 = '<a href="' . $permission_url . '" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="fas fa-key text-success"></i></a>';


                    $action = '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                ' . $action_1 . '
                                    ' . $action_2 . '
                                    ' . $action_3 . '
                                    ' . $action_4 . '
                                </div>
                            </div>';
                    return $action;
                });

            $datatables = $datatables->rawColumns(['name', 'check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.role.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('admin.role.create');
        }

        $rules = [
            'role' => ['required', 'regex:/^[a-zA-Z\s]+$/i', 'unique:roles,name'],
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
                'name' => $request->input('role'),
                'description' => $request->input('description'),
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('roles')->insert($data);

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
        $role_id = base64_decode($request->id);

        if ($request->isMethod('get')) {
            $role = DB::table('roles')->where('id', $role_id)->first();


            return view('admin.role.edit', compact('role'));
        }

        $rules = [
            'role' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
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
                'name' => $request->input('role'),
                'description' => $request->input('description'),
                'updated_by' => Auth::user()->id,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('roles')->where('id', $role_id)->update($data);

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
    public function getAddPermissionPage(Request $request)
    {
        // ->whereNotIn('parent_id','0')
        $role_id = base64_decode($request->id);
        $business_id = Auth::user()->business_id;

        $role_data = DB::table('roles')->where(['status' => '1', 'id' => $role_id])->first();
        // dd($role_data);
        $action_route_count = DB::table('role_permissions')->where(['role_id' => $role_id])->count();
        $action_route = DB::table('role_permissions')->where(['role_id' => $role_id])->first();
        $permission  = DB::table('action_masters')->where(['status' => '1', 'parent_id' => '0'])->orderBy('display_order', 'ASC')->get();
        //dd($permission);
        return view('admin.role.permission', compact('permission', 'role_id', 'action_route', 'role_data', 'action_route_count'));
    }
    public function updateRolePermission(Request $request)
    {

        $user = $request->all();

        $rules = [
            'permissions' => 'required',
        ];

        $validation = Validator::make($user, $rules);

        if ($validation->fails()) {
            $messages = $validation->errors();
            // dd($messages);
            return redirect()->back()->withInput()->withErrors($messages)->with('error', 'Please Select permissions');
        }

        DB::beginTransaction();
        try {
            $role = DB::table('role_permissions')->where('role_id', $request->input('role_id'))->first();
            $permission =  implode(',', $request->permissions);

            if ($role != NULL) {
                $data = [
                    'permission_id' => $permission,
                    'role_id' => $request->input('role_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('role_permissions')->where('role_id', $request->input('role_id'))->update($data);
            } else {
                $data = [
                    'permission_id' => $permission,
                    'role_id' => $request->input('role_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('role_permissions')->insert($data);
            }


            DB::commit();
            return redirect()->route('admin.role')->with('success', 'Profile created successfully. Please login');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }
}
