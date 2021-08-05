<?php 

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Like { 
    public function findPostLikedByUser($uid,$pid){
        return DB::table("dis_likes")
        ->where([["IdUser","=",$uid],["IdPost","=",$pid]])
        ->first();
    }

    public function changeLike($id,$isLike){
        DB::table("dis_likes")
        ->where("IdDL","=",$id)
        ->update(["isLike" => $isLike]);
    }
    public function insertLike($uid,$pid,$isLike){
        return DB::table("dis_likes")
        ->insertGetId([
            "IdUser" => $uid,
            "IdPost" => $pid,
            "isLike" => $isLike
        ]);
    }

    public function deleteLike($id){
        DB::table("dis_likes")
        ->where("IdDL","=",$id)
        ->delete();
    }

    public function didILike($pid,$uid){
        $b = DB::table("dis_likes")
        ->where([["IdUser", "=", $uid],["IdPost","=", $pid],["isLike","=",1]])
        ->first();
        if($b)
            return true;
        else
            return false;
    }

    public function didIDislike($pid,$uid){
        $b = DB::table("dis_likes")
        ->where([["IdUser", "=", $uid],["IdPost","=", $pid],["isLike","=",0]])
        ->first();
        if($b)
            return true;
        else
            return false;
    }

    public function countPostLikes($pid){
        return DB::table("dis_likes")
        ->where([["IdPost","=",$pid],["isLike","=",1]])
        ->count();
    }

    public function countPostDislikes($pid){
        return DB::table("dis_likes")
        ->where([["IdPost","=",$pid],["isLike","=",0]])
        ->count();
    }
}