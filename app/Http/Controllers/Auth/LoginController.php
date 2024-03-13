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
use DB;

class LoginController extends Controller
{
    public function login(Request $request){

         $request->validate([
             'email' => 'required|exists:users,email',
             'password' => 'required'
         ],
         [
             'email.exists' => 'This Email is Not Registered in Our System'
         ]
         );

         $is_deleted = User::where(['email'=>$request->email,'status'=>'2'])->latest()->first();
             if($is_deleted!=NULL)
             {
                 Session::flash('message', 'Your English Level is too advanced for our program, So we are unable to enroll in our program!');
                 Session::flash('alert-class', 'alert-danger');

                 return redirect()->back();
             }

         $deactive = User::where(['email'=>$request->email,'status'=>'0'])->latest()->first();

         if($deactive!=NULL)
         {
             Session::flash('message', 'Your account has been created & is under review. You will be notified once your account is approved.');
             Session::flash('alert-class', 'alert-danger');

             return redirect()->back();
         }

         $deactive1 = User::where(['email'=>$request->email,'is_verified'=>'0'])->latest()->first();

         if($deactive1 != NULL )
         {
             Session::flash('message', 'Please Check your mail and click verify email.');
             Session::flash('alert-class', 'alert-danger');

             return redirect()->back();
         }
         $user = User::where(['email'=>$request->email])->first();//,'user_type'=>'1'
         if($user){
             $check = $request->only('email','password');

             if(Auth::attempt($check))
             {
                if(Auth::user()->user_type == 2){
                    if(Auth::user()->is_completed == 0){
                        return redirect()->to('teacher-signup-register/' . Auth::user()->id);
                    }else{
                        // return redirect('/teacher-student-list');
                        return redirect('/teacher-pairing-control');
                    }
                }
                if(Auth::user()->user_type == 3 ){
                    if( Auth::user()->is_completed == 0){
                        $students  = DB::table('students')->where('user_id', Auth::user()->id)->first();
                        return view('front.student-signup-register', compact('students'));
                    }else{
                        return redirect('/student-pairing-control');
                    }
                }
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
     public function logout1(Request $request)
     {
         Auth::logout();

         return redirect()->route('front.index');
     }
     public function login_view(Request $request)
     {
        if(Auth::check() && Auth::user()->user_type != 0){
            return redirect('/');
        }else{
            return view('front.index');
        }
    }
    public function verify_email(Request $request)
    {
        DB::table('users')->where('id',$request->id)->update(['is_verified' => 1]);
        return view('front.index');
   }

}
