<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use \PDO;
use \PDOException;

/*
 * Contains methods to manage permissions tables
 */
class SecurityDAO
{
    
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    
    /*
     * Verify that the given ID is contained in the admin table
     */
    public function checkAdmin($id){
        Log::info("Entering SecurityDAO.checkAdmin()");
        
        try{
            
            $stmt = $this->db->prepare("SELECT * FROM ADMINS WHERE USERS_ID = :id;");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            if($stmt->rowCount() >= 1){
                Log::info("Exit SecurityDAO.checkAdmin() with true");
                return true;
            } else {
                Log::info("Exit SecurityDAO.checkAdmin() with false");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /*
     * Add a user to the admin table
     */
    public function addAdmin($id){
        
        Log::info("Entering UserDAO.addAdmin()");
        
        try{
            
            $stmt = $this->db->prepare("INSERT INTO ADMINS VALUES(:id)");
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();
            
            if($result){
                
                Log::info("Exit UserDAO.addAdmin() with success");
                return true;
                
            } else {
                
                Log::info("Exit UserDAO.addAdmin() with failure");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    /*
     * Remove a user from the admin table
     */
    public function removeAdmin($id){
        
        Log::info("Entering UserDAO.removeAdmin()");
        
        try{
            
            $stmt = $this->db->prepare("DELETE FROM ADMINS WHERE USERS_ID = :id");
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();
            
            if($result){
                
                Log::info("Exit UserDAO.removeAdmin() with success");
                return true;
                
            } else {
                
                Log::info("Exit UserDAO.removeAdmin() with failure");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    // TODO [NEXT MILESTONE] finish CRUD operations
    
}