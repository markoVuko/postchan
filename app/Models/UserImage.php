<?php 

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class UserImage { 
    public function getUserImage($id){
        return \DB::table("user_images")
        ->leftJoin("users","users.IdImg","=","user_images.IdImg")
        ->where("users.IdUser","=",$id)
        ->first();
    }

    public function insertImage($path,$alt) {
        return \DB::table("user_images")
        ->insertGetId([
            'path' => $path,
            'alt' => $alt
    ]);
    }

    public function getUserImages(){
        return DB::table("user_images")
        ->get();
    }
}