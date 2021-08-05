<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::get('/', function () {
        return view('pages.welcome');
    })->name("welcome");
    
    Route::get("/home",'PostController@home')->name("home")->middleware('userauth');
    Route::get("/contact",'ContactController@index')->name("contact");
    Route::get("/admin","AdminController@index")->name("admin")->middleware("adminauth");
    Route::get("/profiles",'ProfileController@showProfiles')->name("profiles")->middleware('userauth');
    Route::get("/profiles/{id}",'ProfileController@showUser')->name("profid")->middleware('userauth');
    Route::get("/logout",'AuthController@logout')->name("logout")->middleware('userauth');
    
    Route::post("/regForm","AuthController@register");
    Route::post("/logForm","AuthController@login");
    Route::post("/submitPost","PostController@createPost");
    Route::post("/deletePost/{pid}","PostController@deletePost")->name("deletepost");
    Route::post("/editPost","PostController@editPost")->name("editpost");
    Route::post("/editUser","UserController@edituser")->name("edituser");
    Route::post("/likePost","PostController@likePost")->name("likepost");
    Route::post("/followUser","UserController@followUser")->name("followuser");
    Route::post("/searchUser","UserController@searchUser")->name("searchuser");
    Route::post("/insertUser","AdminController@insertUser")->name("insertuser");
    Route::post("/loadUser","AdminController@loadUser")->name("loaduser");
    Route::post("/adminEditUser","UserController@adminEditUser")->name("adminedituser");
    Route::post("/contact","ContactController@insertContact")->name("contact");

Auth::routes();

