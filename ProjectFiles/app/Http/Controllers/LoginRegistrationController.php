<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
    }
    
    // Login a user
    public function loginUser(Request $request){
        
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');
        
    }
    
}
