<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Business\UserService;
use App\Models\LoginModel;
use App\Models\RegistrationModel;
use App\Services\Data\CredentialDAO;

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
        $reg = new RegistrationModel(null, $userUsername, $userPassword, $userFirstName, $userLastName, $userEmail, $userCity, $userState);
        $service = new UserService();
        $success = $service->registerUser($reg);
        
        if($success == 1) {
            return view("registerandlogin")->with(['message'=>"Account created successfully. Please log in.", 'doLogin'=>true]);
        } else if($success == 2){
            return view("registerandlogin")->with(['message'=>"A user with that username already exists."]);
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
        
        // Services
        $service = new SecurityService();
        $uService = new UserService();
        
        // Authenticate
        $loginResult = $service->authenticate(new LoginModel(null, $userUsername, $userPassword));
        
        if($loginResult){
            $userId = $loginResult['id'];
            $isAdmin = $service->checkAdmin($userId);
            $userData = $uService->getProfile($userId);
            
            if($userData->getSuspended()){
                return view("registerandlogin")->with(['message'=>"Your account has been suspended.", 'doLogin'=>true]);
            } else {
                session(['LoggedIn'=>true]);
                session(['UserID'=>$userId]);
                session(['IsAdmin'=>$isAdmin]);
                session(['user'=>$userData]);
                return view("welcome");
            }
        } else {
            return view("registerandlogin")->with(['message'=>"That username and password does not exist.", 'doLogin'=>true]);
        }
        
    }
    
    public function logout(Request $request){
        session(['LoggedIn'=>null]);
        session(['UserID'=>null]);
        session(['IsAdmin'=>null]);
        session(['user'=>null]);
        return view("registerandlogin")->with(['message'=>"You have been logged out.", 'doLogin'=>true]);
    }
    
}
