<?php

namespace App\Services\Business;

use \PDO;

/*
 * Contains static methods for accessing the database
 */
class DataService
{
    
    /*
     * Connect to the mySQL database
     */
    public static function connect(){
        $servername = config("database.connections.mysql.host");
        $port = config("database.connections.mysql.port");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $dbname = config("database.connections.mysql.database");
        $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }
    
}

