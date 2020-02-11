<?php
namespace App\Models;

class AdminModel
{
    
    private $id;
    
    function __construct($id, $username, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
}

