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
})->name('welcome');

Route::get('/helloworld', function(){
    return "Hello World";
});

// Landing page route TODO
    
// Login/registration page route
Route::get('/signin', function(){
    return view('registerandlogin');
})->name('signin');

// Logout route
Route::get('/logout', function(){
    session()->flush();
    return view('registerandlogin');
})->name('logout');

// Admin page route
Route::get('/admin', "AdministrationController@displayAdminPage");

// Profile page route
Route::get('/profile', ['as'=>'profile', 'uses'=>"ProfileController@displayProfile"]);

// Profile edit page route
Route::get('/profile/edit', ['as'=>'editprofile', 'uses'=>"ProfileController@displayProfileForEdit"]);

// Process login route
Route::post('/api/' . $_APIVER . "/user/login", ['as'=>'login', 'uses'=>"AuthenticationController@loginUser"]);

// Process registration route
Route::post('/api/' . $_APIVER . "/user/register", ['as'=>'register', 'uses'=>"AuthenticationController@registerNewUser"]);

// Process update user route
Route::post('/api/' . $_APIVER . "/user/update", ['as'=>'updateUser', 'uses'=>"ProfileController@updateUser"]);

// Process delete user route
Route::post('/api/' . $_APIVER . "/user/delete", ['as'=>'deleteUser', 'uses'=>"ProfileController@deleteUser"]);

// Suspend user route
Route::post('/api/' . $_APIVER . "/user/unsuspend", ['as'=>'unsuspendUser', 'uses'=>"AdministrationController@unsuspendUser"]);

// Unsuspend user route
Route::post('/api/' . $_APIVER . "/user/suspend", ['as'=>'suspendUser', 'uses'=>"AdministrationController@suspendUser"]);

// Debug route
Route::get('/debug', function(){
   session_start();
   return var_dump(session()); 
});