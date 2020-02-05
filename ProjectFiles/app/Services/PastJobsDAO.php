<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use \PDO;
use \PDOException;

/*
 * Contains CRUD operations for the PASTJOBS table
 */
class PastJobsDAO
{
    
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    
    /*
     * Delete a past jobs entry by ID
     */
    public function deletePastJobs($id){
        Log::info("Entering PastJobsDAO.deletePastJobs($id)");
        
        try{
            
            $stmt = $this->db->prepare("DELETE FROM PASTJOBS WHERE USERS_ID = :id");
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();
            
            if($result){
                Log::info("Exit PastJobsDAO.deletePastJobs() with true");
                return true;
            } else {
                Log::info("Exit PastJobsDAO.deletePastJobs() with false");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    // TODO [NEXT MILESTONE] finish CRUD operations
    
}