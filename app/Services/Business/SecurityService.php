<?php
namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Models\LoginModel;
use App\Models\RegistrationModel;
use App\Models\UserModel;
use App\Services\Data\AdminDAO;
use App\Services\Data\UserDAO;
use App\Services\Data\CredentialDAO;

/**
 * Contains methods and logic for processing permissions and security-related functionality
 *
 * @author Jake McDermitt
 *        
 */
class SecurityService
{

    private $db;

    public function __construct()
    {
        $this->db = DataService::connect();
    }

    /**
     * Verify the username and password of a given user
     *
     * @param LoginModel|RegistrationModel|UserModel $user
     * @return mixed|boolean
     */
    public function authenticate($user)
    {
        Log::info("Entering SecurityService.login()");

        $service = new CredentialDAO($this->db);
        $result = $service->readByModel($user);

        if ($result) {
            Log::info("Exit SecurityService.login() with success.");
            return $result->fetch(PDO::FETCH_ASSOC);
        } else {
            Log::info("Exit SecurityService.login() with failure.");
            return false;
        }
    }

    /**
     * Verify that the given user ID is an admin
     *
     * @param int $id
     * @return boolean
     */
    public function isAdmin($id)
    {
        $service = new AdminDAO($this->db);
        $result = $service->readById($id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Verify that the given user has permission to edit the second user by ID
     *
     * @param int $id
     * @param int $userId
     * @return boolean
     */
    public function canEditUser($id, $userId)
    {
        if ($userId == $id || $this->isAdmin($userId)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Suspend a user
     *
     * @param int $id
     * @return boolean
     */
    public function suspendUser($id)
    {
        $service = new UserDAO($this->db);
        $user = $this->getProfile($id);
        $user->setPassword(null); // keep the password from updating
        $user->setSuspended(true);
        $result = $service->update($user);
        return $result;
    }

    /**
     * Restore a user from a suspended state
     *
     * @param int $id
     * @return boolean
     */
    public function unsuspendUser($id)
    {
        $service = new UserDAO($this->db);
        $user = $this->getProfile($id);
        $user->setPassword(null); // keep the password from updating
        $user->setSuspended(false);
        $result = $service->update($user);
        return $result;
    }
}

