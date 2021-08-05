<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Korisnik;
use App\Models\Follow;
use App\Models\UserImage;
use App\Models\Contact;

class AdminController extends Controller{
    public function index(Request $r){
        $k = new Korisnik();
        $users = $k->getAllUsers();
        $c = new Contact();
        $contacts = $c->getAllContacts();
        $data["users"] = $users;
        $data["contacts"] = $contacts;
        return view("pages.admin.panel",["data" => $data]);
    }

    public function insertUser(Request $r){
        $username = $r->input("username");
        $email = $r->input("email");
        $pw = $r->input("pw");
        $role = $r->input("role");
        if(!empty($username)||!empty($email)||!empty($pw)||!empty($role)){
            $k = new Korisnik();
            $a = $k->insertUserWithRole($username,$email,md5($pw),$role);
            if($a){
                return json_encode("Inserted user");
            } else {
                return json_encode("Failed to insert user.");
            }
        }
        
    }

    public function loadUser(Request $r){
        $username = $r->input("username");
        if($username){
            $k = new Korisnik();
            $user = $k->getUserWithImg($username);
            return json_encode($user);
        }
    }
}