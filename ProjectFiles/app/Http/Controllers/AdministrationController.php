<?php

namespace App\Http\Controllers;

use App\Services\DataService;
use App\Services\UserService;
use App\Services\SecurityService;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    
    public function displayAdminPage(Request $request){
        
        $db = DataService::connect();
        $service = new SecurityService($db);
        if($service->isAdminSession()){
            $uService = new UserService($db);
            $allUsers = $uService->getProfiles();
            return view("admin")->with(['users'=>$allUsers]);
        } else {
            return view("welcome");
        }
        
    }
    
}
