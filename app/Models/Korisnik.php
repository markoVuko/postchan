<?php 

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Korisnik {
    public function insertUser($u, $e, $pw){
        return \DB::table("users")->insertGetId([
                'username' => $u,
                'email' => $e,
                'password' => $pw,
                'IdROle' => 2
        ]);
    }

    public function insertUserWithRole($u, $e, $pw, $role){
        return \DB::table("users")->insertGetId([
            'username' => $u,
            'email' => $e,
            'password' => $pw,
            'IdROle' => $role
    ]);
    }

    public function getUser($id){
        return \DB::table("users")
        ->where("IdUser",$id)
        ->first();
    }

    public function checkUser($username, $password){
        return DB::table("users")
        ->where([
                ["username", "=", $username],
                ["password", "=", md5($password)]
            ])
        ->first();
    }

    public function changeEmail($id,$email){
        return \DB::table("users")
        ->where("IdUser",$id)
        ->update(["email" => $email]);
    }

    public function changeRole($id,$role){
        return \DB::table("users")
        ->where("IdUser",$id)
        ->update(["IdRole" => $role]);
    }

    public function changePassword($id,$pw){
        return \DB::table("users")
        ->where("IdUser",$id)
        ->update(["password" => md5($pw)]);
    }

    public function editUserImg($id, $pid){
        return \DB::table("users")
        ->where("IdUser",$id)
        ->update(["IdImg" => $pid]);
    }

    public function getAllUsers(){
        return DB::table("users")
        ->get();
    }

    public function searchUsers($name){
        return DB::table("users")
        ->leftJoin("user_images","users.IdImg","=","user_images.IdImg")
        ->where("users.username","LIKE","%".$name."%")
        ->get();
    }

    public function getUserWithImg($name){
        return DB::table("users")
        ->leftJoin("user_images","users.IdImg","=","user_images.IdImg")
        ->where("users.username","=",$name)
        ->get();
    }

    public function getOneUserWithImg($id){
        return DB::table("users")
        ->leftJoin("user_images","users.IdImg","=","user_images.IdImg")
        ->where("users.IdUser","=",$id)
        ->first();
    }
}