<?php 

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Follow;
use App\Models\PostImage;
use App\Models\UserImage;
use App\Http\Requests\PostRequest;
use App\Http\Requests\LikeRequest;


class PostController extends Controller {
    

    public function __construct(){
        
    }

    public function home(Request $r)
    {
        $user = $r->session()->get("user");
        $post = new Post();
        $posts= $post->getAllPosts($user->IdUser);
        $likes = [];
        $dislikes = [];
        $likeNums = [];
        $dislikeNums = [];
        $like = new Like();
        foreach($posts as $p){
            if($like->didILike($p->IdPost,$user->IdUser)){
                array_push($likes,true);
            } else { array_push($likes,false); }
            if($like->didIDislike($p->IdPost,$user->IdUser)){
                array_push($dislikes,true);
            } else { array_push($dislikes,false); }
            array_push($likeNums,$like->countPostLikes($p->IdPost));
            array_push($dislikeNums,$like->countPostDislikes($p->IdPost));
        }
        $f = new Follow();
         $followNums = $f->countUserFollows($user->IdUser);
        $followedNums = $f->countWhoUserFollowed($user->IdUser);
        $img = new UserImage();
        $pic= $img->getUserImage($user->IdUser);
        $data["user"]=$user;
        $data["posts"]=$posts;
        $data["pic"]=$pic;
        $data["likes"] = $likes;
        $data["dislikes"] = $dislikes;
        $data["likeNums"] = $likeNums;
        $data["dislikeNums"] = $dislikeNums;
        $data["followNums"] = $followNums;
        $data["followedNums"] = $followedNums;
        return view('pages.home',["data"=>$data]);
    }

    public function createPost(PostRequest $r) {
        $id = $r->input("pid");
        $ptext = $r->input("ptext");
        
        $ppic = $r->file("ppic");
        $name = 'p-'.$ppic->getClientOriginalName()."-".time().'.'.$ppic->getClientOriginalExtension();  
        $path = $ppic->storeAs("img",$name,"mup");
        $alt = $ppic->getClientOriginalName() . " post picture";

        $postImage = new PostImage();
        $pid = $postImage->insertImage($path,$alt);

         if($pid){
            $post = new Post();
            $post_id = $post->insertPost($ptext,$id, $pid);
            if($post_id){
                $json = $post->returnPost($post_id);
                return json_encode($json);
            } else { return "Failed to submit post"; }
        } else { return "Failed image upload."; }   
    }

    public function deletePost($pid){
        if($pid){
            $post = new Post();
            $b = $post->deletePostRow($pid);
            if($b){
                echo json_encode("Post deleted");
            } else { echo json_encode($pid);}
        } else {return json_encode($pid);}
    }

    public function editPost(Request $r){
        if($r->input("ptext")&&$r->input("pid")){
            $ptext= $r->input("ptext");
            $post_id= $r->input("pid");
            if($r->file("ppic")){
                $ppic = $r->file("ppic");
                $name = 'p-'.$ppic->getClientOriginalName()."-".time().'.'.$ppic->getClientOriginalExtension();  
                $path = $ppic->storeAs("img",$name,"mup");
                $alt = $ppic->getClientOriginalName() . " post picture";

                $postImage = new PostImage();
                $pid = $postImage->insertImage($path,$alt);
                if($pid){
                    $post = new Post();
                    $b = $post->editPostImg($post_id, $pid, $ptext);
                    if($b){ echo json_encode("Post edited");}
                    else { echo json_encode("Failed to edit post image and text");}
                } else { echo json_encode("Failed to upload image.");}
            } else {
                $post = new Post();
                $b = $post->editPostText($post_id, $ptext);
                if($b){ echo json_encode("Post edited");}
                else { echo json_encode("Failed to edit post text");}
            }
        } else { return json_encode("You cant submit an empty field."); }
    }

    public function likePost(LikeRequest $r){
        $isLike = $r->input("isLike") === 'true';
        $pid = $r->input("pid");
        $user = $r->session()->get("user");
        $p = new Post();
        $post = $p->returnPost($pid);
        if(!$post){
            return null;
        }
        $l = new Like();
        $like = $l->findPostLikedByUser($user->IdUser,$pid);
        $isLikeInt = (int)$isLike;
        if($like){
            $already = $like->isLike === 1;
            if($already == $isLike){
                $l->deleteLike($like->IdDL);
                return json_encode(PostController::getLikeInfo($user->IdUser,$pid));
            } else{
                $l->changeLike($like->IdDL,$isLikeInt);
                return json_encode(PostController::getLikeInfo($user->IdUser,$pid));
            }
        }
        $d = $l->insertLike($user->IdUser,$pid,$isLikeInt);
        if($d){
            return json_encode(PostController::getLikeInfo($user->IdUser,$pid));
        } else {
            return json_encode(PostController::getLikeInfo($user->IdUser,$pid));}
    }

    public function getLikeInfo($uid, $pid){
        $pl = new Like();
            $doILike = $pl->didILike($pid,$uid);
            $doIDislike = $pl->didIDislike($pid,$uid);
            $likeNum = $pl->countPostLikes($pid);
            $dislikeNum = $pl->countPostDislikes($pid);
            $likeData["doILike"] = $doILike;
            $likeData["doIDislike"] = $doIDislike;
            $likeData["likeNum"] = $likeNum;
            $likeData["dislikeNum"] = $dislikeNum;
            return $likeData;
    }
}