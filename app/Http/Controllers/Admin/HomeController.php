<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\Category;
use App\Models\BookSession;
use App\Models\Blog;
use App\Models\Enquiry;
use App\Models\WriteReview;

class HomeController extends Controller
{
    public function index()
    {
        $student = DB::table('users')->where('user_type', 3)->count();
        $teacher = DB::table('users')->where('user_type', 2)->count();
        $user = DB::table('users')->where('user_type', 1)->count();
        $course = DB::table('courses')->where('status', 1)->count();
        $sques = DB::table('questions')->where('user_type', 0)->count();
        $tques = DB::table('questions')->where('user_type', 1)->count();
        $zip = DB::table('zip_codes')->where('status', 1)->count();
        $states = DB::table('states')->where('status', 1)->count();
        $city = DB::table('cities')->where('status', 1)->count();
        $timezone = DB::table('time_zones')->where('status', 1)->count();

        return view('admin.dashboard', compact('student', 'teacher', 'user','course','sques','tques','zip','states','city','timezone'));
    }
}
