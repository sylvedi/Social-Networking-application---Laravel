<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\DataService;
use App\Services\SecurityService;
use App\Services\UserService;
use App\Models\LoginModel;
use App\Models\RegistrationModel;

class AuthenticationController extends Controller
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
        
        $reg = new RegistrationModel($userUsername, $userPassword, $userFirstName, $userLastName, $userEmail, $userCity, $userState);
        $service = new UserService($db);
        $success = $service->registerUser($reg);
        
        if($success) {
            return view("registerandlogin");
        } else {
            return view("registerandlogin")->with(['message'=>"There was an error during registration."]);
        }
        
    }
    
    // Login a user
    public function loginUser(Request $request){
        
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');
        
        $db = DataService::connect();
        
        $service = new SecurityService($db);
        $loginResult = $service->authenticate(new LoginModel(null, $userUsername, $userPassword));
        
        if($loginResult){
            $userId = $loginResult->getId();
            Log::info(print_r($loginResult, true));
            Log::info($loginResult->getId());
            Log::info($userId);
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
