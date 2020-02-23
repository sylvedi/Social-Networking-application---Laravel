<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use App\Services\Data\CredentialDAO;
use App\Services\Business\DataService;

class DebugController extends Controller
{
    
    public function scratchPad(Request $request){
        
        $s = new CredentialDAO(DataService::connect());
        $lm = new LoginModel(null, "john", "pass");
        $result = $s->readByModel($lm);
        if($result->rowCount() == 1){
            echo "Success search. ";
            
        } else {
            echo "Failure search. ";
        }
        
    }
    
}
