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

class UserPermissionController extends Controller
{
    public function getAddPermissionPage(Request $request)
    {
        // ->whereNotIn('parent_id','0')
        $role_id = base64_decode($request->id);
        $business_id = Auth::user()->business_id;

        $role_data = DB::table('roles')->where(['status'=>'1','id'=>$role_id])->first();
       // dd($role_data);
       $action_route_count = DB::table('role_permissions')->where(['role_id'=>$role_id])->count();
       $action_route = DB::table('role_permissions')->where(['role_id'=>$role_id])->first();
       $permission  = DB::table('action_masters')->where(['status'=>'1','parent_id'=>'0'])->orderBy('display_order','ASC')->get();
       //dd($permission);
        return view('admin.role.permission',compact('permission','role_id','action_route','role_data','action_route_count'));
    }
    public function updateRolePermission(Request $request){

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
        try{
            $role = DB::table('role_permissions')->where('role_id',$request->input('role_id'))->first();
            $permission =  implode(',',$request->permissions);

            if($role != NULL){
                $data = [
                    'permission_id' => $permission,
                    'role_id' => $request->input('role_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('role_permissions')->where('role_id', $request->input('role_id'))->update($data);

            }else{
                $data = [
                    'permission_id' => $permission,
                    'role_id' => $request->input('role_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('role_permissions')->insert($data);

            }


            DB::commit();
            return redirect()->route('admin.role')->with('success', 'Profile created successfully. Please login');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }
}
