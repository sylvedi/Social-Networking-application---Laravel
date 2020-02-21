<?php
namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Data\AdminDAO;
use App\Services\Data\CredentialDAO;

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
        
        Log::info("Entering SecurityService.login()");
        
        $service = new CredentialDAO($this->db);
        $result = $service->readByModel($user);
        
        if($result){
            Log::info("Exit SecurityService.login() with success.");
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            Log::info("Exit SecurityService.login() with failure.");
            return false;
        }
        
    }
    
    /*
     * Verify that the given user ID is an admin
     */
    public function checkAdmin($id){
        
        Log::info("Entering SecurityService.checkAdmin($id)");
        
        $service = new AdminDAO($this->db);
        $result = $service->readById($id);
        
        if(!$result){
            Log::info("Exit SecurityService.checkAdmin($id) with failure.");
            return false;
        } else {
            Log::info("Exit SecurityService.checkAdmin($id) with success.");
            return true;
        }
        
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

