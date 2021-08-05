<?php 

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Korisnik;

class AuthController extends Controller {
    

    public function __construct(){
        
    }

    public function register(RegRequest $r) {
        $username = $r->input("username");
        $email = $r->input("email");
        $pw = md5($r->input("pw1"));
        $model = new Korisnik();
        $id = $model->insertUser($username, $email, $pw);
        $user = $model->getUser($id);
        if($user){
                $r->session()->put('user', $user);
                return json_encode("Registered");
            } else {
                return json_encode("Failed registration");
            }
    } 

    public function login(LoginRequest $r){
            $username = $r->input('username');
            $password= $r->input('pw');
 
            $korisnik = new Korisnik();
            $user = $korisnik->checkUser($username, $password);
 
            if($user){
                $r->session()->put('user', $user);
                return json_encode("Logged in.");
            } else {
                return json_encode("Login failed");
            }
         
     }
 
     public function logout(Request $request){
         if($request->session()->has('user')){
             $request->session()->forget('user');
             $request->session()->flush();
             return redirect("/");
         }
     }

     public function home() {
         return view("pages.home");
     }
}