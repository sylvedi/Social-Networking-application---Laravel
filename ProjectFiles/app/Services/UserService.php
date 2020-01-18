<?php

namespace App\Services;

use \PDO;
use PDOException;

class UserService
{
    
    public static function registerUser(PDO $db, $userFirstName, $userLastName, $userCity, $userState, $userEmail, $userUsername, $userPassword){
        
        $db->beginTransaction();
        
        // insert credential
        try{
            $db->query("INSERT INTO `CREDENTIALS`(`id`, `USERNAME`, `PASSWORD`) VALUES (NULL, '$userUsername', AES_ENCRYPT($userPassword, UNHEX(SHA2('GCU-CST-256-2020-McDermitt-Edi',512))))");
        } catch(PDOException $e){
            echo "FAILURE " . $db->errorInfo();
        }
        
        // insert user
        try{
            $db->query("INSERT INTO `USERS`(`id`, `CREDENTIALS_id`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `CITY`, `STATE`) VALUES (NULL, LAST_INSERT_ID(), '$userFirstName', '$userLastName', '$userEmail', '$userCity', '$userState') ");
        } catch(PDOException $e){
            echo "FAILURE " . $db->errorInfo();
        }
        
        $db->commit();
        
    }
    
}

