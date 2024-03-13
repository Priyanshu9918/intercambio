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

class UserController extends Controller
{
    // public function index(){
    //     return view('admin.user.index');
    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = DB::table('users')->where('status', '<>', 2)->where('user_type', 1)->orderBy('id', 'DESC')->get();
            $datatables = Datatables::of($user)
                ->editColumn('check', function ($row) {
                    return '<span class="form-check mb-0"><input type="checkbox" id="chk_sel_"><label class="form-check-label" for="chk_sel_"></label></span>';
                })
                ->editColumn('rname', function ($row) {
                    $games4 = DB::table('roles')->where('id', $row->role_id)->first();
                    return $games4->name ?? '___';
                })

                ->editColumn('created_by', function ($row) {
                    $games2 = DB::table('users')->where('id', $row->created_by)->first();
                    return $games2->name ?? '___';
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
                    $edit_url = url('/admin/user/edit', ['id' => base64_encode($row->id)]);
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

            $datatables = $datatables->rawColumns(['check', 'action'])->make(true);

            return $datatables;
        }

        return view('admin.user.index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            $role  = DB::table('roles')->where('status','1')->get();

            return view('admin.user.create', compact('role'));
        }

        $rules = [
            'user_name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'phone' => 'required|numeric',
            // 'role_id' => 'required',


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
            // if ($request->file('image')) {

            //     $image = $request->file('image');
            //     $date = date('YmdHis');
            //     $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
            //     $random_no = substr($no, 0, 2);
            //     $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

            //     $destination_path = public_path('/uploads/user/');
            //     if (!File::exists($destination_path)) {
            //         File::makeDirectory($destination_path, $mode = 0777, true, true);
            //     }
            //     $image->move($destination_path, $final_image_name);
            // }
            $data = [
                'name' => $request->input('user_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => $hashed_random_password,
                'c_password' => $request->input('password'),
                'role_id' => $request->input('role'),
                // 'image' => !empty($final_image_name) ? $final_image_name : NULL,
                'user_type' => 1,
                'status' => 1,
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ];

            DB::table('users')->insert($data);

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
        $user_id = base64_decode($request->id);

        if ($request->isMethod('get')) {
            $role  = DB::table('roles')->where('status','1')->get();
            $user  = DB::table('users')->where('id',$user_id)->first();

            return view('admin.user.edit', compact('user','role'));
        }

        $rules = [
            'user_name' => 'required|alpha|max:255',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required|numeric',
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
            $u_image = DB::table('users')->where('id', $user_id)->first();

            // if ($request->file('image')) {
            //     $image = $request->file('image');
            //     $date = date('YmdHis');
            //     $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
            //     $random_no = substr($no, 0, 2);
            //     $final_image_name = $date . $random_no . '.' . $image->getClientOriginalExtension();

            //     $destination_path = public_path('/uploads/user/');
            //     if (!File::exists($destination_path)) {
            //         File::makeDirectory($destination_path, $mode = 0777, true, true);
            //     }
            //     $image->move($destination_path, $final_image_name);
            // } else {
            //     $final_image_name = $u_image->image;
            // }

            $hashed_random_password = Hash::make($request->input('password'));

            $data = [
                'name' => $request->input('user_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => $hashed_random_password,
                'role_id' => $request->input('role'),
                'user_type' => 1,
                'c_password' => $request->input('password'),
                'updated_by' => Auth::user()->id,
                'status' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('users')->where('id', $user_id)->update($data);

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

    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'current_password' => 'required',
    //         'new_password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = Auth::user();

    //     if (!Hash::check($request->current_password, $user->password)) {
    //         return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    //     }

    //     $user->update([
    //         'password' => Hash::make($request->new_password),
    //     ]);

    //     return redirect()->back()->with('success', 'Password updated successfully.');
    // }
}
