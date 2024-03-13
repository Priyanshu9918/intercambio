<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */



    public function ForgetPassword() {
        return view('auth.forget-password');
    }

    public function ForgetPasswordStore(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user_name = DB::table('users')->where('email',$request->email)->first();
        $email=[
            'sender_email' => $request->email,
            'inext_email' => env('MAIL_USERNAME'),
            'name'=>$user_name->name,
            'token' => $token,
        ];
        Mail::send('mail.forget-password-email', $email, function ($messages) use ($email) {
            $messages->to($email['sender_email'])
                ->from($email['inext_email'], 'Intercambio');
            $messages->subject("Reset Password!");
        });

        return back()->with('message', 'We have emailed your password reset link!');
    }

    public function ResetPassword($token) {
        // return view('auth.forget-password-link', ['token' => $token]);
        $data = DB::table('password_resets')->where('token',$token)->first();
        // dd($data);
        return view('auth.forget-password-link', ['token' => $token, 'data' => $data]);
    }

    public function ResetPasswordStore(Request $request) {
        // dd($request->email);
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $randomPassword = $request->password;

        if (!preg_match("/^(?=.{10,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@%£!]).*$/", $randomPassword)){
            return back()->withInput()->withErrors(['password'=>['Password must be atleast 10 characters long including (Atleast 1 uppercase letter(A–Z), Lowercase letter(a–z), 1 number(0–9), 1 non-alphanumeric symbol(‘$%£!’) !']]);
        }

        $update = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->first();
        if(!$update){
            return back()->withInput()->with('error', 'Invalid token!');
        }
       

        $user = DB::table('users')->where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        // Delete password_resets record
        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/')->with('message', 'Your password has been successfully changed!');
    }
}
