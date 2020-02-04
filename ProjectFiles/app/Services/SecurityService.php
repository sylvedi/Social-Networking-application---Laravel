<?php
namespace App\Services;

use App\Models\LoginModel;
use Illuminate\Support\Facades\Log;
use \PDO;

class SecurityService
{
    
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function authenticate($user){
        
        Log::info("entering SecurityService.login()");
        
        $service = new UserDAO($this->db);
        $result = $service->findByUser($user);
        
        if($result != null){
            Log::info("Exit SecurityService.login() with success.");
            return $result;
        } else {
            Log::info("Exit SecurityService.login() with failure.");
            return false;
        }
        
    }
    
    public function checkAdmin($id){
        
        // TODO checkAdmin
        return true;
        
    }
    
    public function isAdminSession(){
        
        if(session('LoggedIn') && session('IsAdmin')){
            return true;
        } else {
            return false;
        }
        
    }
    
    public function canEditUser($id){
        if(session('LoggedIn') && (session('UserID') == $id || session('IsAdmin'))){
            return true;
        } else {
            return false;
        }
    }
    
}

