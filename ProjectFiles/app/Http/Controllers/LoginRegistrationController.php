<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DataService;
use App\Services\UserService;
use App\Services\AuthService;

class LoginRegistrationController extends Controller
{
    
    // Register a new user
    public function registerNewUser(Request $request){
        
        $userFirstName = $request->input('firstname');
        $userLastName = $request->input('lastname');
        
        $userCity = $request->input('city');
        $userState = $request->input('state');
        
        $userEmail = $request->input('email');
        
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');
        
        $db = DataService::connect();
        
        UserService::registerUser($db, $userFirstName, $userLastName, $userCity, $userState, $userEmail, $userUsername, $userPassword);
        
        return view("registerandlogin");
        
    }
    
    // Login a user
    public function loginUser(Request $request){
        
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');
        
        $db = DataService::connect();
        
        $loginResult = AuthService::login($db, $userUsername, $userPassword);
        
        if($loginResult){
            return view("welcome"); // TODO change
        } else {
            return view("registerandlogin");
        }
        
    }
    
}
