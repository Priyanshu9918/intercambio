<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use DB;
class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        static $firstRowSkipped = false;
        if (!$firstRowSkipped) {
            $firstRowSkipped = true;
            return;
        }
        // dd($row[0]);
        $user = new User([
            "name" => $row[0],
            "l_name" => $row[1],
            "email" => $row[2],
            "phone" => $row[3],
            "role_id" => $row[4],
            "email_verified_at" => $row[5], // Make sure it's a valid datetime string or null
            "password" => Hash::make($row[6]), // Hash the actual password
            "c_password" => $row[6],
            "image" => $row[8],
            "status" => $row[10],
            "is_verified" => $row[14],
            "user_type" => $row[19],
        ]);
    
        $user->save();
    
        $studentId = $user->id;
        $data = [
            'user_id' => $studentId,
            'name' => $user->name,
            'l_name' => $user->l_name,
            'email' => $user->email,
            'password' => $user->password,
            'phone' => $user->phone,
            'created_by' => $studentId,
            'trem_condition' =>1
        ]; 
        DB::table('students')->insert($data);
    }
}
