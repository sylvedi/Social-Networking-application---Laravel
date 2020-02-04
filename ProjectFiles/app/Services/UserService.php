<?php

namespace App\Services;

use \PDO;
use PDOException;
use App\Models\UserModel;
use App\Models\RegistrationModel;
use Illuminate\Support\Facades\Log;

class UserService
{
    
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    
    // Registers the given user in the database and returns a success/failure boolean
    public function registerUser(RegistrationModel $user){
        
        $service = new UserDAO($this->db);
        $result = $service->addUser($user);
        
        return $result;
        
    }
    
    // Reads profile data from the database
    // TODO make this include past jobs
    public function getProfile($id){
        
        $service = new UserDAO($this->db);
        $user = $service->getUser($id);
        if($user == null) $user = new UserModel(null, null, null, null, null, null, null, null, null, null, null, null);
        return $user;
        
    }
    
    // Reads all users from the database
    // TODO make this include past jobs
    public function getProfiles(){
        
        $service = new UserDAO($this->db);
        $users = $service->getUsers();
        return $users;
        
    }
    
    public function suspendUser($id){
        
        $service = new UserDAO($this->db);
        $user = $this->getProfile($id);
        $user->setSuspended(true);
        $result = $service->updateUser($user);
        return $result;
        
    }
    
    public function unsuspendUser($id){
        
        $service = new UserDAO($this->db);
        $user = $this->getProfile($id);
        $user->setSuspended(false);
        $result = $service->updateUser($user);
        return $result;
        
    }
    
    public function updateUser($user){
        
        $service = new UserDAO($this->db);
        $result = $service->updateUser($user);
        if($result) return true;
        else return false;
        
    }
    
    public function deleteUser($id){
        
        $service = new UserDAO($this->db);
        $cService = new CredentialsDAO($this->db);
        $pjService = new PastJobsDAO($this->db);
        $result = $pjService->deletePastJobs($id);
        if($result) {
            $result2 = $service->deleteUser($id);
            if($result2){
                $result3 = $cService->deleteCredential($id);
                if($result3){
                    return true;
                } else {return false; }
            } else { return false; }
        } else { return false; }
        
    }
    
}

