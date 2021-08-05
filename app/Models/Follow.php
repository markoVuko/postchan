<?php 

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Follow { 
    public function countUserFollows($id){
        return DB::table("follows")
        ->where("Follow","=",$id)
        ->count();
    }

    public function countWhoUserFollowed($id){
        return DB::table("follows")
        ->where("FollowedBy","=",$id)
        ->count();
    }

    public function doIFollow($me,$them){
        $b = DB::table("follows")
        ->where([["FollowedBy", "=", $me],["Follow","=", $them]])
        ->first();
        if($b)
            return true;
        else
            return false;
    }

    public function followUser($them,$me){
        return DB::table("follows")->insertGetId([
            "Follow" => $them,
            "FollowedBy" => $me
        ]);
    }

    public function unfollowUser($them,$me){
         DB::table("follows")
        ->where([["Follow","=",$them],["FollowedBy","=",$me]])
        ->delete();
    }
}