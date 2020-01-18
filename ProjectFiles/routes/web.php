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

// Login/registration page route

// Landing page route

// Process login route
Route::post('/api/' . $_APIVER . "/user/login", "LoginRegistrationController@loginUser");

// Process registration route
Route::post('/api/' . $_APIVER . "/user/register", "LoginRegistrationController@registerNewUser");