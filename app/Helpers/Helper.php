<?php
namespace App\Helpers;
use CountryFlag;
use Request;

use Illuminate\Support\Facades\DB;
use Auth;
use Stevebauman\Location\Facades\Location;

class Helper {
    public static function get_user_permission()
    {
        $role = Auth::user()->role_id;
        $action = DB::table('role_permissions')->where('role_id',$role)->first();
        $permission = explode(',', $action->permission_id ?? '');
        return $permission;
    }
    public static function zipcheck($zip)
    {
        $student = DB::table('students')->where('zip_match',$zip)->get();
        return $student;
    }
}

?>

