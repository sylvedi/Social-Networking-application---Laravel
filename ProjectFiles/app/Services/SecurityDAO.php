<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use \PDO;
use \PDOException;

class SecurityDAO
{
    
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    
    public function checkAdmin($id){
        Log::info("Entering SecurityDAO.checkAdmin()");
        
        try{
            
            $stmt = $this->db->prepare("SELECT ID FROM ADMINS WHERE USERS_ID = :id;");
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
    
    // TODO [NEXT MILESTONE] finish CRUD operations
    
}