<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Korisnik;
use App\Models\Follow;
use App\Models\UserImage;

class UserController extends Controller
{
    public function editUser(UserRequest $r){
        if($r->input("email")&&$r->input("id")) {
            $email = $r->input("email");
            $id = $r->input("id");
            $pw1 = $r->input("pw1");
            $pw2 = $r->input("pw2");
            $pic = $r->file("pic");
            $role = $r->input("role");
            $user = new Korisnik();
            $b=null;
            if($email!=$r->session()->get("user")->email){
                $b = $user->changeEmail($id,$email);
            }
            if($pw1&&$pw2&&$pw1==$pw2){
                $b = $user->changePassword($id,$pw1);
            }
            if($pic){
                $name = 'u-'.$pic->getClientOriginalName()."-".time().'.'.$pic->getClientOriginalExtension();  
                $path = $pic->storeAs("img",$name,"mup");
                $alt = $pic->getClientOriginalName() . " user picture";

                $userImage = new UserImage();
                $pid = $userImage->insertImage($path,$alt);
                if($pid){
                    $b = $user->editUserImg($id, $pid); 
                    if($b){
                        $r->session()->get("user")->IdImg=$pid;
                        return json_encode("img");
                    }
                }
            }
            if($role){
                $a = $user->changeRole($id,$role);
                if($a){
                    $ui = new UserImage();
                    $img = $ui->getUserImage($id);
                    if($img)
                        return json_encode($img);
                    else 
                        return json_encode("no");
                }
            }
            if($b){
                return json_encode("Profile settings changed.");
            } else {
                return json_encode("Failed to change settings");
            }
        } else {
            return json_encode("You can't delete your email!");
        }
    }

    public function adminEditUser(Request $r){
        if($r->input("email")&&$r->input("id")) {
            $email = $r->input("email");
            $id = $r->input("id");
            $pw1 = $r->input("pw1");
            $pw2 = $r->input("pw2");
            $pic = $r->file("pic");
            $role = $r->input("role");
            $user = new Korisnik();
            if($email){
                $user->changeEmail($id,$email);
            }
            if($pw1&&$pw2&&$pw1==$pw2){
                $user->changePassword($id,$pw1);
            }
            if($pic){
                $name = 'u-'.$pic->getClientOriginalName()."-".time().'.'.$pic->getClientOriginalExtension();  
                $path = $pic->storeAs("img",$name,"mup");
                $alt = $pic->getClientOriginalName() . " user picture";

                $userImage = new UserImage();
                $pid = $userImage->insertImage($path,$alt);
                if($pid){
                    $user->editUserImg($id, $pid); 
                }
            }
            if($role){
                $a = $user->changeRole($id,$role);
            }
    }
}
    

    public function followUser(Request $r){
        $followId = $r->input("fid");
        $f = new Follow();
        $follow = $r->input("follow") === "true";
        if($follow){
            $did = $f->followUser($followId,$r->session()->get("user")->IdUser);
            if($did){
                return json_encode("Followed user");
            } else {
                return json_encode("Follow failed");
            }
        } else {
            $f->unfollowUser($followId,$r->session()->get("user")->IdUser);
            return json_encode("Unfollowed user");
        }

    }

    public function searchUser(Request $r){
        $name = $r->input("name");
        $k = new Korisnik();
        $users = $k->searchUsers($name);
        $userinos = [];
        $a="";
        $followNums = 0;
        $f = new Follow();
        foreach($users as $u){
            $followNums = $f->countUserFollows($u->IdUser);
            $a =    '<div class="user">';
            if($u->path){
                $a .= '<img src="'.$u->path.'" alt="'.$u->alt.'" class="userListPic">';
            } else{
                $a .='<img src="img/profile.png" alt="'.$u->username.' picture" class="userListPic">';
            }
            $a .= ' <a href="profiles/'.$u->IdUser.'" class="userListName">'.$u->username.'</a>
            <span>'.$u->email.'</span><br>
            <span class="followers">Followers: <span class="folNum">'.$followNums.'</span></span>';            
            if($f->doIFollow($r->session()->get("user")->IdUser,$u->IdUser)){
                $a .= '<a href="'.$u->IdUser.'" class="follow">Unfollow</a>';}
            else{
                $a .= '<a href="'.$u->IdUser.'" class="follow">Follow</a>';}
            $a .= '</div>';
            array_push($userinos,$a);
        }
        return json_encode($userinos);
    }
}
