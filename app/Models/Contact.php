<?php 

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Contact { 
    public function insertContact($first, $last, $email, $num, $gender, $text) {
        DB::table("sent")
        ->insert([
            "name" => $first,
            "surname" => $last,
            "num" => $email,
            "email" => $num,
            "gender" => $gender,
            "text" => $text
        ]);
    }

    public function getAllContacts(){
        return DB::table("sent")
        ->get();
    }
}