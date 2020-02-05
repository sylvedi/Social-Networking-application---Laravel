<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use \PDO;
use \PDOException;

/*
 * Contains CRUD operations for the CREDENTIALS table
 */
class CredentialsDAO
{
    
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    
    /*
     * Delete a credential by ID
     */
    public function deleteCredential($id){
        Log::info("Entering CredentialsDAO.deleteCredential($id)");
        
        try {
            
            $stmt = $this->db->prepare("DELETE FROM CREDENTIALS WHERE ID = :id");
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();
            
            if($result){
                Log::info("Exit CredentialsDAO.deleteCredential() with true");
                return true;
            } else {
                Log::info("Exit CredentialsDAO.deleteCredential() with false");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // TODO [NEXT MILESTONE] finish CRUD operations
    
}