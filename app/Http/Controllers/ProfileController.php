<?php 

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Korisnik;
use App\Models\Follow;
use App\Models\Post;
use App\Models\Like;
use App\Models\UserImage;

class ProfileController extends Controller { 
    public function showProfiles(Request $r){
        $user = new Korisnik();
        $users = $user->getAllUsers();
        $me = $r->session()->get("user");
        $img = new UserImage();
        $imgs = $img->getUserImages();
        $followNums = [];
        $doIFollow = [];
        $f = new Follow();
        foreach($users as $u){
            if($f->doIFollow($me->IdUser,$u->IdUser)){
                array_push($doIFollow,true);
            } else {
                array_push($doIFollow,false);
            }
            array_push($followNums,$f->countUserFollows($u->IdUser));
        }
        $data["user"] = $me;
        $data["users"] = $users;
        $data["imgs"] = $imgs;
        $data["followNums"] = $followNums;
        $data["doIFollow"] = $doIFollow;
        return view("pages.profile",["data" => $data]);
    }

    public function showUser($id,Request $r){
        $u = new Korisnik();
        $user = $u->getUser($id);
        $img = new UserImage();
        $pic= $img->getUserImage($user->IdUser);
        $post = new Post();
        $posts= $post->getAllPosts($user->IdUser);
        $likes = [];
        $dislikes = [];
        $likeNums = [];
        $dislikeNums = [];
        $like = new Like();
        foreach($posts as $p){
            if($like->didILike($p->IdPost,$r->session()->get("user")->IdUser)){
                array_push($likes,true);
            } else { array_push($likes,false); }
            if($like->didIDislike($p->IdPost,$r->session()->get("user")->IdUser)){
                array_push($dislikes,true);
            } else { array_push($dislikes,false); }
            array_push($likeNums,$like->countPostLikes($p->IdPost));
            array_push($dislikeNums,$like->countPostDislikes($p->IdPost));
        }
        $f = new Follow();
        $doIFollow=false;
        if($f->doIFollow($r->session()->get("user")->IdUser,$user->IdUser)){
            $doIFollow = true;
        }
        $followNums = $f->countUserFollows($user->IdUser);
        $followedNums = $f->countWhoUserFollowed($user->IdUser);
        $data["user"] = $user;
        $data["pic"] = $pic;
        $data["posts"] = $posts;
        $data["likes"] = $likes;
        $data["dislikes"] = $dislikes;
        $data["likeNums"] = $likeNums;
        $data["dislikeNums"] = $dislikeNums;
        $data["doIFollow"] = $doIFollow;
        $data["followNums"] = $followNums;
        $data["followedNums"] = $followedNums;
        $data["viewing"] = 1;
        return view("pages.profile",["data" => $data]);
    }
}
