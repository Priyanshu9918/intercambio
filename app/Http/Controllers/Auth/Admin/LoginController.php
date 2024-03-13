<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login_view(){
        Auth::logout();
        return view('admin.login');
    }

    public function login(Request $request){

    $request->validate([
        'email' => 'required|exists:users,email',
        'password' => 'required'
    ],
    [
        'email' => 'This User-email is Required.',
        'email.exists' => 'This User-email is Not Registered in Our System'
    ]
    );

    $deactive = User::where(['email'=>$request->email,'status'=>'0'])->latest()->first();

    if($deactive!=NULL)
    {
        Session::flash('message', 'Your Account Has Been Deactivated, Please Contact to System Administrator !!');
        Session::flash('alert-class', 'alert-danger');

        return redirect()->back();
    }

        $check = $request->only('email','password');

        if(Auth::attempt($check))
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            Session::flash('message', 'Credentials Not Matched!');
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }


}
public function logout(Request $request)
{
    Auth::logout();

    return redirect('/admin/login');
}

}
