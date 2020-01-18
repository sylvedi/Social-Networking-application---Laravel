<?php

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

$_APIVER = "vx";

Route::get('/', function () {
    return view('welcome');
});

Route::get('/helloworld', function(){
    return "Hello World";
});

// Login/registration page route
Route::get('/login', function(){
    return view('registerandlogin');
});

// Landing page route TODO

// Process login route
Route::post('/api/' . $_APIVER . "/user/login", ['as'=>'login', 'uses'=>"LoginRegistrationController@loginUser"]);

// Process registration route
Route::post('/api/' . $_APIVER . "/user/register", ['as'=>'register', 'uses'=>"LoginRegistrationController@registerNewUser"]);

// Debug route
Route::get('/debug', function(){
   session_start();
   return print_r($_SESSION, true); 
});