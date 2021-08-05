<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Contact;

class ContactController extends Controller{ 
    public function index(){
        return view("pages.contact");
    }

    public function insertContact(Request $r){
        $first = $r->input("first");
        $last = $r->input("last");
        $num = $r->input("num");
        $email = $r->input("email");
        $gender = $r->input("gender");
        $text = $r->input("text");
        $firstNameRx = "/^[A-Z][a-z]{2,11}$/";
		$lastNameRx = "/^[A-Z][a-z]{2,19}$/";
		$numRX = "/^06[1-9](\s|-|\/)?[0-9]{3}(\s|-|\/)?[0-9]{3,4}$/";
        $greske = [];
        if(!preg_match($firstNameRx, $first)){
            array_push($greske, "Invalid first name.");
        }
        if(!preg_match($lastNameRx, $last)){
            array_push($greske, "Invalid last name.");
        }
        if(!preg_match($numRX, $num)){
            array_push($greske, "Invalid number.");
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($greske, "Invalid email.");
        }
        if(empty($gender)){
            array_push($greske, "Pick a gender.");
        }
        if(empty($text)){
            array_push($greske, "Write your feedback.");
        }
        if(count($greske)>0){
            echo json_encode($greske);
        }
        if(count($greske)==0){
            $contactModel = new Contact();
            $contactModel->insertContact($first, $last, $email, $num, $gender, $text);
        }
    }
}