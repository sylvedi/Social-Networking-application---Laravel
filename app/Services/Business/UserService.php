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
use App\Models\ExperienceModel;
use App\Models\SkillModel;
use App\Models\EducationModel;

/**
 * Contains methods to manage user related data including profiles, skills, education, and experience
 *
 * @author Jake McDermitt
 *        
 */
class UserService
{

    private $db;

    public function __construct()
    {
        $this->db = DataService::connect();
    }

    /**
     * Registers the given user in the database
     *
     * @param RegistrationModel $user
     * @throws DatabaseException
     * @return boolean|number
     */
    public function registerUser(RegistrationModel $user)
    {
        try {

            $this->db->beginTransaction();

            $cService = new CredentialDAO($this->db);
            $lm = new LoginModel(null, $user->getUsername(), $user->getPassword());
            $exists = $cService->readByModel($lm);
            if (! $exists || $exists->rowCount() == 0) {
                $cID = $cService->create($lm);

                if (! $cID) {
                    return false;
                } else {
                    $service = new UserDAO($this->db);
                    $user->setId($cID);
                    $result = $service->create($user);

                    if ($result) {
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

    /**
     * Get a profile from the database by id
     *
     * @param int $id
     * @return NULL|boolean|\App\Models\UserModel
     */
    public function getProfile($id)
    {
        $service = new UserDAO($this->db);
        $cService = new CredentialDAO($this->db);
        $resultUser = $service->readById($id);
        if (! $resultUser) {
            return null;
        } else {
            $c = $cService->readById($id)->fetch(PDO::FETCH_ASSOC);
            $resultUser->setUsername($c['USERNAME']);
            return $resultUser;
        }
    }

    /**
     * Get all profiles from the database
     *
     * @return array
     */
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

    /**
     * Get all experience entries associated with a user ID
     *
     * @param int $id
     * @return array|boolean|array
     */
    public function getExperience($id)
    {
        $service = new ExperienceDAO($this->db);
        $result = $service->readByModel(new ExperienceModel(null, $id, null, null, null, null, null, null));
        if (! $result) {
            return array();
        } else {
            return $result;
        }
    }

    /**
     * Get an experience entry by ID
     *
     * @param int $id
     * @return \App\Models\ExperienceModel|boolean|\App\Models\ExperienceModel
     */
    public function getSingleExperience($id)
    {
        $service = new ExperienceDAO($this->db);
        $result = $service->readById($id);
        if (! $result) {
            return new ExperienceModel(null, null, null, null);
        } else {
            return $result;
        }
    }

    /**
     * Get all skills associated with a user ID
     *
     * @param int $id
     * @return array|boolean|array
     */
    public function getSkills($id)
    {
        $service = new SkillDAO($this->db);
        $result = $service->readByModel(new SkillModel(null, $id, null, null));
        if (! $result) {
            return array();
        } else {
            return $result;
        }
    }

    /**
     * Get a skill by ID
     *
     * @param int $id
     * @return \App\Models\SkillModel|boolean|\App\Models\SkillModel
     */
    public function getSingleSkill($id)
    {
        $service = new SkillDAO($this->db);
        $result = $service->readById($id);
        if (! $result) {
            return new SkillModel(null, null, null, null);
        } else {
            return $result;
        }
    }

    /**
     * Get all education entries associated with a user ID
     *
     * @param int $id
     * @return array|boolean|array
     */
    public function getEducation($id)
    {
        $service = new EducationDAO($this->db);
        $result = $service->readByModel(new EducationModel(null, $id, null, null));
        if (! $result) {
            return array();
        } else {
            return $result;
        }
    }

    /**
     * Get an education entry by ID
     *
     * @param int $id
     * @return \App\Models\EducationModel|boolean|\App\Models\EducationModel
     */
    public function getSingleEducation($id)
    {
        $service = new EducationDAO($this->db);
        $result = $service->readById($id);
        if (! $result) {
            return new EducationModel(null, null, null, null);
        } else {
            return $result;
        }
    }

    /**
     * Create an education entry
     *
     * @param EducationModel $education
     * @return boolean
     */
    public function createEducation($education)
    {
        $service = new EducationDAO($this->db);

        $result = $service->create($education);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Update an education entry
     *
     * @param EducationModel $education
     * @return boolean
     */
    public function updateEducation($education)
    {
        $service = new EducationDAO($this->db);

        $result = $service->update($education);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Delete an education entry
     *
     * @param int $id
     * @return boolean
     */
    public function deleteEducation($id)
    {
        $service = new EducationDAO($this->db);

        $result = $service->delete($id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create a skill
     *
     * @param SkillModel $skill
     * @return boolean
     */
    public function createSkill($skill)
    {
        $service = new SkillDAO($this->db);

        $result = $service->create($skill);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Update a skill
     *
     * @param SkillModel $skill
     * @return boolean
     */
    public function updateSkill($skill)
    {
        $service = new SkillDAO($this->db);

        $result = $service->update($skill);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Delete a skill
     *
     * @param SkillModel $id
     * @return boolean
     */
    public function deleteSkill($id)
    {
        $service = new SkillDAO($this->db);

        $result = $service->delete($id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Create an experience entry
     *
     * @param ExperienceModel $experience
     * @return boolean
     */
    public function createExperience($experience)
    {
        $service = new ExperienceDAO($this->db);

        $result = $service->create($experience);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Update an experience entry
     *
     * @param ExperienceModel $experience
     * @return boolean
     */
    public function updateExperience($experience)
    {
        $service = new ExperienceDAO($this->db);

        $result = $service->update($experience);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Delete an experience entry
     *
     * @param ExperienceModel $id
     * @return boolean
     */
    public function deleteExperience($id)
    {
        $service = new ExperienceDAO($this->db);

        $result = $service->delete($id);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Update a user
     *
     * @param UserModel $user
     * @return boolean
     */
    public function updateUser($user)
    {
        $service = new UserDAO($this->db);

        if ($user->getUsername() != null || $user->getPassword() != null) {
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

    /**
     * Delete a user
     *
     * @param UserModel $id
     * @return boolean
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

