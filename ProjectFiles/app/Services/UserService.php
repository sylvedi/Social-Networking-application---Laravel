<?php

namespace App\Services;

use App\Models\UserModel;
use App\Models\RegistrationModel;
use Illuminate\Support\Facades\Log;

/*
 * Contains methods to manage users
 */
class UserService
{
    
    private $db;
    public function __construct(){
        $this->db = DataService::connect();
    }
    
    /*
     * Registers the given user in the database and returns a success/failure boolean
     */
    public function registerUser(RegistrationModel $user){
        
        $service = new UserDAO($this->db);
        $result = $service->addUser($user);
        
        return $result;
        
    }
    
    /*
     * Get a full profile from the database
     */
    // TODO make this include past jobs
    public function getProfile($id){
        
        $service = new UserDAO($this->db);
        $user = $service->getUser($id);
        if($user == null) $user = new UserModel(null, null, null, null, null, null, null, null, null, null, null, null);
        return $user;
        
    }
    
    /*
     * Get all profiles from the database
     */
    // TODO make this include past jobs
    public function getProfiles(){
        
        $service = new UserDAO($this->db);
        $users = $service->getUsers();
        return $users;
        
    }
    
    /*
     * Suspend a user
     */
    public function suspendUser($id){
        
        $service = new UserDAO($this->db);
        $user = $this->getProfile($id);
        $user->setSuspended(true);
        $result = $service->updateUser($user);
        return $result;
        
    }
    
    /*
     * Remove suspension on a user
     */
    public function unsuspendUser($id){
        
        $service = new UserDAO($this->db);
        $user = $this->getProfile($id);
        $user->setSuspended(false);
        $result = $service->updateUser($user);
        return $result;
        
    }
    
    /*
     * Update a user
     */
    public function updateUser($user){
        
        $service = new UserDAO($this->db);
        $result = $service->updateUser($user);
        if($result) return true;
        else return false;
        
    }
    
    /*
     * Delete a user
     */
    public function deleteUser($id){
        
        $service = new UserDAO($this->db);
        $cService = new CredentialsDAO($this->db);
        $pjService = new PastJobsDAO($this->db);
        $result = $pjService->deletePastJobs($id);
        if($result) {
            $result2 = $service->deleteUser($id);
            if($result2){
                $result3 = $service->removeAdmin($id);
                if($result3){
                    $result4 = $cService->deleteCredential($id);
                    if($result4){
                        return true;
                    } else {return false; }
                } else {return false; }
            } else { return false; }
        } else { return false; }
        
    }
    
}

