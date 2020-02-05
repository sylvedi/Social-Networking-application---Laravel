<?php
namespace App\Services;

use App\Models\LoginModel;
use Illuminate\Support\Facades\Log;
use \PDO;

/*
 * Contains methods and logic for processing permissions and security-related functionality
 */
class SecurityService
{
    
    private $db;
    
    public function __construct(){
        $this->db = DataService::connect();
    }
    
    /*
     * Verify the username and password of a given user
     */
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
    
    /*
     * Verify that the given user ID is an admin
     */
    public function checkAdmin($id){
        
        Log::info("Entering SecurityService.checkAdmin()");
        
        $service = SecurityDAO();
        $result = $service->checkAdmin($id);
        
        return $result;
        
    }
    
    /*
     * Verify that the currently logged in user is an admin
     */
    public function isAdminSession(){
        
        if(session('LoggedIn') && session('IsAdmin')){
            return true;
        } else {
            return false;
        }
        
    }
    
    /*
     * Verify that the currently logged in user has permission to edit the given user by ID
     */
    public function canEditUser($id){
        if(session('LoggedIn') && (session('UserID') == $id || session('IsAdmin'))){
            return true;
        } else {
            return false;
        }
    }
    
}

