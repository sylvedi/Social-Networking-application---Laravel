<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SecurityService;
use App\Services\UserService;
use App\Models\LoginModel;
use App\Models\RegistrationModel;

class AuthenticationController extends Controller
{
    
    /*
     * Register a new user from a form
     */
    public function registerNewUser(Request $request){
        
        // POST parameters
        $userFirstName = $request->input('firstname');
        $userLastName = $request->input('lastname');
        
        $userCity = $request->input('city');
        $userState = $request->input('state');
        
        $userEmail = $request->input('email');
        
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');
        
        // Insert user
        $reg = new RegistrationModel($userUsername, $userPassword, $userFirstName, $userLastName, $userEmail, $userCity, $userState);
        $service = new UserService();
        $success = $service->registerUser($reg);
        
        if($success) {
            return view("registerandlogin");
        } else {
            return view("registerandlogin")->with(['message'=>"There was an error during registration."]);
        }
        
    }
    
    /*
     * Process login from a form
     */
    public function loginUser(Request $request){
        
        // POST parameters
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');
        
        // Authenticate
        $service = new SecurityService();
        $loginResult = $service->authenticate(new LoginModel(null, $userUsername, $userPassword));
        
        if($loginResult){
            $userId = $loginResult->getId();
            $isAdmin = $service->checkAdmin($userId);
            session(['LoggedIn'=>true]);
            session(['UserID'=>$userId]);
            session(['IsAdmin'=>$isAdmin]);
            session(['user'=>$loginResult]);
            return view("welcome"); // TODO SYLVANUS change landing page
        } else {
            return view("registerandlogin");
        }
        
    }
    
}
