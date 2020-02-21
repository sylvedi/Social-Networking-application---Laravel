<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Models\LoginModel;
use App\Models\RegistrationModel;
use App\Services\Data\UserDAO;
use App\Services\Data\CredentialDAO;
use App\Services\Data\EducationDAO;
use App\Services\Data\SkillDAO;
use App\Services\Data\ExperienceDAO;
use App\Services\Data\AdminDAO;
use PDO;
use PDOException;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;

/*
 * Contains methods to manage users
 */
class UserService
{

    private $db;

    public function __construct()
    {
        $this->db = DataService::connect();
    }

    /*
     * Registers the given user in the database and returns a success/failure boolean
     */
    public function registerUser(RegistrationModel $user)
    {
        try {
            
            $this->db->beginTransaction();

            $cService = new CredentialDAO($this->db);
            $lm = new LoginModel(null, $user->getUsername(), $user->getPassword());
            $exists = $cService->readByModel($lm);
            if(!$exists || $exists->rowCount() == 0){
                $cID = $cService->create($lm);
    
                if (! $cID) {
                    return false;
                } else {
                    $service = new UserDAO($this->db);
                    $user->setId($cID);
                    $result = $service->create($user);
    
                    if($result){
                        $this->db->commit();
                        return 1;
                    } else {
                        return false;
                    }
                }
            } else {
                return 2; // User already exists
            }
            
        } catch (PDOException $e) {

            // Roll back changes
            $this->db->rollback();
            
            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
            
        }
    }

    /*
     * Get a full profile from the database
     */
    // TODO make this include past jobs
    public function getProfile($id)
    {
        $service = new UserDAO($this->db);
        $cService = new CredentialDAO($this->db);
        $resultUser = $service->readById($id);
        if (! $resultUser || $resultUser->rowCount() != 1) {
            $user = new UserModel(null, null, null, null, null, null, null, null, null, null, null, null);
            return $user;
        } else {
            $data = $resultUser->fetch(PDO::FETCH_ASSOC);
            $c = $cService->readById($data['CREDENTIALS_ID'])->fetch(PDO::FETCH_ASSOC);
            $user = new UserModel($data['CREDENTIALS_ID'], $c['USERNAME'], null, $data['FIRSTNAME'], $data['LASTNAME'], $data['EMAIL'], $data['CITY'], $data['STATE'], $data['SUSPENDED'], $data['BIRTHDAY'], $data['TAGLINE'], $data['PHOTO']);
            return $user;
        }
    }

    /*
     * Get all profiles from the database
     */
    // TODO make this include past jobs
    public function getProfiles()
    {
        $service = new UserDAO($this->db);
        $cService = new CredentialDAO($this->db);
        $result = $service->readAll();
        $users = array();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {
            $c = $cService->readById($row['CREDENTIALS_ID'])->fetch(PDO::FETCH_ASSOC);
            $u = new UserModel($row['CREDENTIALS_ID'], $c['USERNAME'], null, $row['FIRSTNAME'], $row['LASTNAME'], $row['EMAIL'], $row['CITY'], $row['STATE'], $row['SUSPENDED'], $row['BIRTHDAY'], $row['TAGLINE'], $row['PHOTO']);
            array_push($users, $u);
        }
        return $users;
    }

    /*
     * Suspend a user
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

    /*
     * Remove suspension on a user
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

    /*
     * Update a user
     */
    public function updateUser($user)
    {
        $service = new UserDAO($this->db);

        if($user->getUsername() != null || $user->getPassword() != null){
            $id = $user->getId();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $cred = new LoginModel($id, $username, $password); 
            
            $cService = new CredentialDAO($this->db);
            $result2 = $cService->update($cred);
        } else {
            $result2 = true;
        }
        
        $result = $service->update($user);
        if ($result && $result2)
            return true;
        else
            return false;
    }

    /*
     * Delete a user
     */
    public function deleteUser($id)
    {
        $sCredential = new CredentialDAO($this->db);

        $sAdmin = new AdminDAO($this->db);

        $sUser = new UserDAO($this->db);
        $sExperience = new ExperienceDAO($this->db);
        $sEducation = new EducationDAO($this->db);
        $sSkill = new SkillDAO($this->db);

        $adminDeleteResult = $sAdmin->delete($id);
        if ($adminDeleteResult) {

            $skillDeleteResult = $sSkill->delete($id);
            if ($skillDeleteResult) {

                $experienceDeleteResult = $sExperience->delete($id);
                if ($experienceDeleteResult) {

                    $educationDeleteResult = $sEducation->delete($id);
                    if ($educationDeleteResult) {

                        $userDeleteResult = $sUser->delete($id);
                        if ($userDeleteResult) {

                            $credentialDeleteResult = $sCredential->delete($id);
                            if ($credentialDeleteResult) {

                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

