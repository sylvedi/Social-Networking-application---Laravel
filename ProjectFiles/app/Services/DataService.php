<?php

namespace App\Services;

use \PDO;

class DataService
{
    
    public static function connect(){
        return new PDO('mysql:host=localhost;dbname=LinkMe', 'root', 'root');
    }
    
}

