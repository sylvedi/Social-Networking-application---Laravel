<?php
namespace App\Services;

use \PDO;

class AuthService
{
    
    public static function login(PDO $db, $username, $password){
        
        $result = $db->query("SELECT * FROM credentials WHERE USERNAME='$username' AND PASSWORD=AES_ENCRYPT($password, UNHEX(SHA2('GCU-CST-256-2020-McDermitt-Edi',512)))");
        if(!$result){
            session_start();
            $_SESSION['LoggedIn'] = false;
            return false;
        } else {
            $user = $result->fetch();
            session_start();
            $_SESSION['LoggedIn'] = true;
            $_SESSION['USERNAME'] = $user['USERNAME'];
            return true;
        }
        
    }
    
}

