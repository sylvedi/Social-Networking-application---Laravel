<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\UserModel;
use App\Services\Utility\DatabaseException;
use \PDO;
use \PDOException;
use \ArrayObject;

class UserDAO
{
    
    private $db;
    public function __construct($db){
        $this->db = $db;
    }
    
    public function findByUser($user){
        Log::info("Entering UserDAO.findByUser()");
        
        try{
            
            $name = $user->getUsername();
            $pw = $user->getPassword();
            $stmt = $this->db->prepare("SELECT * FROM CREDENTIALS t1 INNER JOIN USERS t2 ON t1.ID = t2.CREDENTIALS_ID WHERE USERNAME = :username AND PASSWORD = AES_ENCRYPT(:password, UNHEX(SHA2('GCU-CST-256-2020-McDermitt-Edi',512)));");
            $stmt->bindParam(':username', $name);
            $stmt->bindParam(':password', $pw);
            $stmt->execute();
            
            if($stmt->rowCount() == 1){
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new UserModel($data['CREDENTIALS_ID'], $data['USERNAME'], $data['PASSWORD'], $data['FIRSTNAME'], $data['LASTNAME'], $data['EMAIL'], $data['CITY'], $data['STATE'], $data['SUSPENDED'], $data['BIRTHDAY'], $data['TAGLINE'], $data['PHOTO']);
                Log::info("Exit UserDAO.findByUser() with true");
                return $user;
            } else {
                Log::info("Exit UserDAO.findByUser() with false");
                return null;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    public function getUser($id){
        Log::info("Entering UserDAO.getUser($id)");
        
        try{
            
            $stmt = $this->db->prepare("SELECT * FROM USERS t1 INNER JOIN CREDENTIALS t2 ON t1.CREDENTIALS_ID = t2.ID WHERE t1.CREDENTIALS_ID = :id;");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new UserModel($data['id'], $data['USERNAME'], $data['PASSWORD'], $data['FIRSTNAME'], $data['LASTNAME'], $data['EMAIL'], $data['CITY'], $data['STATE'], $data['SUSPENDED'], $data['BIRTHDAY'], $data['TAGLINE'], $data['PHOTO']);
                Log::info("Exit UserDAO.getUser() with " . print_r($data, true));
                return $user;
            } else {
                Log::info("Exit UserDAO.getUser() with null");
                return null;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    // Return ALL users as models
    public function getUsers(){
        
        Log::info("Entering UserDAO.getUsers()");
        
        try{
            
            $stmt = $this->db->prepare("SELECT * FROM USERS t1 INNER JOIN CREDENTIALS t2 ON t1.CREDENTIALS_ID = t2.ID;");
            $stmt->execute();
            
            $users = new ArrayObject();
            
            if($stmt->rowCount() >= 1){
                while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $user = new UserModel($data['id'], $data['USERNAME'], $data['PASSWORD'], $data['FIRSTNAME'], $data['LASTNAME'], $data['EMAIL'], $data['CITY'], $data['STATE'], $data['SUSPENDED'], $data['BIRTHDAY'], $data['TAGLINE'], $data['PHOTO']);
                    $users->append($user);
                }
                Log::info("Exit UserDAO.getUsers()");
                return $users;
            } else {
                Log::info("Exit UserDAO.getUsers()");
                return null;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    public function addUser($user){
        
        Log::info("Entering UserDAO.addUser()");
        
        try{
            
            $username = $user->getUsername();
            $password = $user->getPassword();
            $firstname = $user->getFirstname();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $city = $user->getCity();
            $state = $user->getState();
            
            $stmt = $this->db->prepare("INSERT INTO `CREDENTIALS`(`id`, `USERNAME`, `PASSWORD`) VALUES (NULL, :username, AES_ENCRYPT(:password, UNHEX(SHA2('GCU-CST-256-2020-McDermitt-Edi',512))))");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $result = $stmt->execute();
            
            if($result){
                
                $stmt2 = $this->db->prepare("INSERT INTO `USERS`(`id`, `CREDENTIALS_id`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `CITY`, `STATE`) VALUES (NULL, LAST_INSERT_ID(), :firstname, :lastname, :email, :city, :state);");
                $stmt2->bindParam(':firstname', $firstname);
                $stmt2->bindParam(':lastname', $lastname);
                $stmt2->bindParam(':email', $email);
                $stmt2->bindParam(':city', $city);
                $stmt2->bindParam(':state', $state);
                
                $result2 = $stmt2->execute();
                
                if($result2){
                    Log::info("Exit UserDAO.addUser() with success");
                    return true;
                } else {
                    Log::info("Exit UserDAO.addUser() with failure");
                    return false;
                }
                
            } else {
                
                Log::info("Exit UserDAO.addUser() with failure");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    public function updateUser($user){
        
        Log::info("Entering UserDAO.updateUser()");
        
        try{
            
            $id = $user->getId();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $firstname = $user->getFirstname();
            $lastname = $user->getLastname();
            $email = $user->getEmail();
            $city = $user->getCity();
            $state = $user->getState();
            $birthday = $user->getBirthday();
            $tagline = $user->getTagline();
            $photo = $user->getPhoto();
            $suspended = $user->getSuspended();
            
            $stmt = $this->db->prepare("UPDATE CREDENTIALS SET `username` = :username, `password` = :password WHERE ID = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $result = $stmt->execute();
            
            if($result){
                
                $stmt2 = $this->db->prepare("UPDATE USERS SET `FIRSTNAME` = :firstname, `LASTNAME` = :lastname, `EMAIL` = :email, `CITY` = :city, `STATE` = :state, `SUSPENDED` = :suspended, `BIRTHDAY` = :birthday, `TAGLINE` = :tagline, `PHOTO` = :photo WHERE CREDENTIALS_ID = :id");
                $stmt2->bindParam(':id', $id);
                $stmt2->bindParam(':firstname', $firstname);
                $stmt2->bindParam(':lastname', $lastname);
                $stmt2->bindParam(':email', $email);
                $stmt2->bindParam(':city', $city);
                $stmt2->bindParam(':state', $state);
                if($suspended){ $s = 1; } else { $s = 0; }
                $stmt2->bindParam(':suspended', $s);
                $stmt2->bindParam(':birthday', $birthday);
                $stmt2->bindParam(':tagline', $tagline);
                $stmt2->bindParam(':photo', $photo);
                
                $result2 = $stmt2->execute();
                
                if($result2){
                    Log::info("Exit UserDAO.updateUser() with success");
                    return true;
                } else {
                    Log::info("Exit UserDAO.updateUser() with failure");
                    return false;
                }
                
            } else {
                
                Log::info("Exit UserDAO.updateUser() with failure");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    public function deleteUser($id){
        
        Log::info("Entering UserDAO.deleteUser()");
        
        try{
            
            $stmt = $this->db->prepare("DELETE FROM USERS WHERE CREDENTIALS_ID = :id");
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();
            
            if($result){
                
                Log::info("Exit UserDAO.deleteUser() with success");
                return true;
                
            } else {
                
                Log::info("Exit UserDAO.deleteUser() with failure");
                return false;
            }
            
        } catch(PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
    }
    
    // TODO add admin
    // TODO remove admin
    
}

