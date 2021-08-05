<?php 

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PostImage {
    public function insertImage ($path,$alt) {
        return DB::table("post_images")->insertGetId([
            "path" => $path,
            "alt" => $alt
        ]);
    }
}