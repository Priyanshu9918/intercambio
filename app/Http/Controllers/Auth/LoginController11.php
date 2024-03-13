<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
class LoginController extends Controller
{
    public function login(Request $request){

        $val = session()->get('find_t');
     //    dd($val);

         $request->validate([
             'email' => 'required|exists:users,email',
             'password' => 'required'
         ],
         [
             'email.exists' => 'This Email is Not Registered in Our System'
         ]
         );

         $is_email = User::where(['email'=>$request->email,'status'=>'0'])->latest()->first();
         $is_email1 = User::where(['email'=>$request->email,'status'=>'1'])->latest()->first();
         if(!$is_email && !$is_email1){
             if($is_deleted!=NULL)
             {
                 Session::flash('message', 'Your Account Has Been Deleted, Please Contact to System Administrator !!');
                 Session::flash('alert-class', 'alert-danger');

                 return redirect()->back();
             }
         }

         $deactive = User::where(['email'=>$request->email,'status'=>'0'])->latest()->first();

         if($deactive!=NULL)
         {
             Session::flash('message', 'Your account has been created & is under review. You will be notified once your account is approved.');
             Session::flash('alert-class', 'alert-danger');

             return redirect()->back();
         }
         $user = User::where(['email'=>$request->email])->where('user_type','1')->latest()->first();//,'user_type'=>'1'
         if($user){
             $check = $request->only('email','password');

             if(Auth::attempt($check))
             {
                    return redirect('/');
             }
             else
             {
                 Session::flash('message', "The password that you've entered is incorrect.");
                 Session::flash('alert-class', 'alert-danger');

                 return redirect()->back();
             }
         }
         else
         {
             Session::flash('message', 'Login Failed!');
             Session::flash('alert-class', 'alert-danger');

             return redirect()->back();
         }
     }
     public function logout(Request $request)
     {
         Auth::logout();

         return redirect()->route('front.login');
     }
     public function login_view(Request $request)
     {
        if(Auth::check() && Auth::user()->user_type != 0){
            return redirect('/');
        }else{
            return view('front.index');
        }
    }

}
