<?php 

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post {
    public function insertPost ($text, $by, $img) {
        $post_dt = Carbon::now()->toDateTimeString();
        return DB::table("posts")->insertGetId([
            "text" => $text,
            "IdUser" => $by,
            "IdImg" => $img,
            "date" => $post_dt
        ]);
    }

    public function returnPost($id){
        return DB::table("posts")
        ->select("posts.IdPost","posts.text","posts.date","post_images.path","post_images.alt","users.username")
        ->join("post_images","posts.IdImg","=","post_images.IdImg")
        ->join("users","posts.IdUser","=","users.IdUser")
        ->where([["IdPost","=",$id],["isVisible","=",1]])
        ->first();
    }

    public function getAllPosts($id){
        return DB::table("posts")
        ->select("posts.IdPost","posts.text","posts.date","post_images.path","post_images.alt","users.username")
        ->join("post_images","posts.IdImg","=","post_images.IdImg")
        ->join("users","posts.IdUser","=","users.IdUser")
        ->where([["posts.IdUser","=",$id],["isVisible","=",1]])
        ->orderBy("date",'DESC')
        ->simplePaginate(6);
    }

    public function deletePostRow($pid){
        return DB::table("posts")
            ->where("IdPost","=",$pid)
            ->update(["isVisible" => 0]);
        
    }

    public function editPostText($pid, $text){
        return DB::table("posts")
        ->where("IdPost","=",$pid)
        ->update(["text" => $text]);
    }

    public function editPostImg($pid, $img, $text){
        return DB::table("posts")
        ->where("IdPost","=",$pid)
        ->update(["text" => $text,"IdImg" => $img]);
    }
}