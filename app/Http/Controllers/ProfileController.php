<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\UserService;
use App\Services\Business\SecurityService;
use App\Models\EducationModel;
use App\Models\SkillModel;
use App\Models\UserModel;
use App\Models\ExperienceModel;

/**
 * Manages profile data and display, including job experience, skills, and education.
 * @author Jake McDermitt
 *
 */
class ProfileController extends Controller
{

    /**
     * Display a profile by id
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayProfile(Request $request)
    {

        // GET parameters
        $id = $request->id;

        $service = new UserService();
        $user = $service->getProfile($id);
        $experience = $service->getExperience($id);
        $skills = $service->getSkills($id);
        $education = $service->getEducation($id);
        
        return view("profile")->with([
            'user' => $user,
            'experience' => $experience,
            'skills' => $skills,
            'education' => $education,
            'id' => $id
        ]);
        
    }

    /**
     * Retrieve a form for editing a user profile by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayProfileForEdit(Request $request)
    {
        // GET parameters
        $id = $request->id;

        $service = new UserService();
        $sService = new SecurityService();

        // If the logged in user has permission to edit the profile
        if ($sService->canEditUser($id, $request->session()->get('UserID'))) {
            $user = $service->getProfile($id);
            return view("profileedit")->with([
                'user' => $user,
                'id' => $id
            ]);
        } else {
            return view("profile")->with([
                'message' => "No permissions to modify user."
            ]);
        }
    }
    
    /**
     * Retrieve a form for editing a user education entry by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayEducationForEdit(Request $request)
    {
        
        // GET parameters
        $id = $request->id;
        
        $service = new UserService();
        $sService = new SecurityService();
        
        // If the logged in user has permission to edit the profile
        if ($sService->canEditUser($id, $request->session()->get('UserID'))) {
            $data = $service->getSingleEducation($id);
            return view("addEducation")->with([
                'education' => $data,
                'editing' => true,
            ]);
        } else {
            return $this->displayProfile($id);
        }
    }
    
    /**
     * Retrieve a form for editing a skill by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displaySkillForEdit(Request $request)
    {
        
        // GET parameters
        $id = $request->id;
        
        $service = new UserService();
        $sService = new SecurityService();
        
        // If the logged in user has permission to edit the profile
        if ($sService->canEditUser($id, $request->session()->get('UserID'))) {
            $data = $service->getSingleSkill($id);
            return view("addSkill")->with([
                'skill' => $data,
                'editing' => true
            ]);
        } else {
            return view("profile")->with([
                'message' => "No permissions to modify user."
            ]);
        }
    }
    
    /**
     * Retrieve a form for editing a user experience entry by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayExperienceForEdit(Request $request)
    {
        
        // GET parameters
        $id = $request->id;
        
        $service = new UserService();
        $sService = new SecurityService();
        
        // If the logged in user has permission to edit the profile
        if ($sService->canEditUser($id, $request->session()->get('UserID'))) {
            $data = $service->getSingleExperience($id);
            return view("addExperience")->with([
                'experience' => $data,
                'editing' => true
            ]);
        } else {
            return view("profile")->with([
                'message' => "No permissions to modify user."
            ]);
        }
    }

    /**
     * Add an education entry from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createEducation(Request $request)
    {
        
        $request->validate(EducationModel::getRules());
        
        $userId = $request->session()->get('UserID');
        $school = $request->input('school');
        $description = $request->input('description');
        
        $service = new UserService();
        
        $education = new EducationModel(null, $userId, $school, $description);
        
        $sService = new SecurityService();
        
        if ($sService->canEditUser($userId, $request->session()->get('UserID'))) {
            $result = $service->createEducation($education);
            
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                return view("addEducation")->with([
                    'education' => $education,
                    'editing' => false,
                    'message'=> "There was an error updating this entry."
                ]);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
        
    }
    
    /**
     * Update an education entry from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateEducation(Request $request)
    {
        
        $request->validate(EducationModel::getRules());
        
        $id = $request->input("id");
        $userId = $request->input('userId');
        $school = $request->input('school');
        $description = $request->input('description');
        
        $service = new UserService();
        
        $education = new EducationModel($id, $userId, $school, $description);
        
        $sService = new SecurityService();
        
        if ($sService->canEditUser($userId, $request->session()->get('UserID'))) {
            $result = $service->updateEducation($education);
            
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                return view("editprofileeducation")->with([
                    'education' => $education,
                    'editing' => true,
                    'message'=> "There was an error updating this entry."
                ]);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
        
    }
    
    /**
     * Delete an eduaction entry by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteEducation(Request $request)
    {
        $id = $request->input("id");
        $userId = $request->session()->get('UserID');
        
        $service = new UserService();
        
        $sService = new SecurityService();
            
        // If the user has permission to edit user
        if ($sService->canEditUser($id, $request->session()->get('UserID'))) {
            // Perform deletion task
            $result = $service->deleteEducation($id);
            
            // TODO make this return a different view for admin/non-admin
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                $request->id = $userId;
                return $this->displayProfile($request)->with(['message'=>'There was an error processing the request.']);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
    }
    
    /**
     * Add a skill entry from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createSkill(Request $request)
    {
        
        $request->validate(SkillModel::getRules());
        
        $userId = $request->session()->get('UserID');
        $years = $request->input('years');
        $description = $request->input('description');
        
        $service = new UserService();
        
        $data = new SkillModel(null, $userId, $description, $years);
        
        $sService = new SecurityService();
        
        if ($sService->canEditUser($userId, $request->session()->get('UserID'))) {
            $result = $service->createSkill($data);
            
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                return view("addSkill")->with([
                    'skill' => $data,
                    'editing' => false,
                    'message'=> "There was an error updating this entry."
                ]);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
        
    }
    
    /**
     * Update a skill entry from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateSkill(Request $request)
    {
        
        $request->validate(SkillModel::getRules());
        
        $id = $request->input("id");
        $userId = $request->input('userId');
        $years = $request->input('years');
        $description = $request->input('description');
        
        $service = new UserService();
        
        $data = new SkillModel($id, $userId, $description, $years);
        
        $sService = new SecurityService();
        
        if ($sService->canEditUser($userId, $request->session()->get('UserID'))) {
            $result = $service->updateSkill($data);
            
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                return view("editprofileskill")->with([
                    'skill' => $data,
                    'editing' => true,
                    'message'=> "There was an error updating this entry."
                ]);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
        
    }
    
    /**
     * Delete a skill entry by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteSkill(Request $request)
    {
        $id = $request->input("id");
        $userId = $request->session()->get('UserID');
        
        $service = new UserService();
        
        $sService = new SecurityService();
        
        // If the user has permission to edit user
        if ($sService->canEditUser($id, $request->session()->get('UserID'))) {
            // Perform deletion task
            $result = $service->deleteSkill($id);
            
            // TODO make this return a different view for admin/non-admin
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                $request->id = $userId;
                return $this->displayProfile($request)->with(['message'=>'There was an error processing the request.']);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
    }
    
    /**
     * Add an experience entry from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createExperience(Request $request)
    {
        
        $request->validate(ExperienceModel::getRules());
        
        $userId = $request->session()->get('UserID');
        $jobtitle = $request->input('jobtitle');
        $company = $request->input('company');
        $description = $request->input('description');
        $currentjob = $request->input('currentjob');
        $startdate = $request->input('startdate');
        $enddate = $request->input('enddate');
        
        $service = new UserService();
        
        $experience = new ExperienceModel(null, $userId, $company, $jobtitle, $description, $startdate, $enddate, $currentjob);
        
        $sService = new SecurityService();
        
        if ($sService->canEditUser($userId, $request->session()->get('UserID'))) {
            $result = $service->createExperience($experience);
            
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                return view("addEducation")->with([
                    'experience' => $experience,
                    'editing' => false,
                    'message'=> "There was an error updating this entry."
                ]);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
        
    }
    
    /**
     * Update an experience entry from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateExperience(Request $request)
    {
        
        $request->validate(ExperienceModel::getRules());
        
        $id = $request->input("id");
        $userId = $request->input('userId');
        $jobtitle = $request->input('jobtitle');
        $company = $request->input('company');
        $description = $request->input('description');
        $currentjob = ($request->input('currentjob') == null) ? false : true;
        $startdate = $request->input('startdate');
        $enddate = $request->input('enddate');
        
        $service = new UserService();
        
        $experience = new ExperienceModel($id, $userId, $company, $jobtitle, $description, $startdate, $enddate, $currentjob);
        
        $sService = new SecurityService();
        
        if ($sService->canEditUser($userId, $request->session()->get('UserID'))) {
            $result = $service->updateExperience($experience);
            
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                return view("editprofileeducation")->with([
                    'experience' => $experience,
                    'editing' => true,
                    'message'=> "There was an error updating this entry."
                ]);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
        
    }
    
    /**
     * Delete an experience entry by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteExperience(Request $request)
    {
        $id = $request->input("id");
        $userId = $request->session()->get('UserID');
        
        $service = new UserService();
        
        $sService = new SecurityService();
        
        // If the user has permission to edit user
        if ($sService->canEditUser($id, $request->session()->get('UserID'))) {
            // Perform deletion task
            $result = $service->deleteExperience($id);
            
            // TODO make this return a different view for admin/non-admin
            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                $request->id = $userId;
                return $this->displayProfile($request)->with(['message'=>'There was an error processing the request.']);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
    }
    
    /**
     * Update a user profile from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateUser(Request $request)
    {
        
        $request->validate(UserModel::getRules());
        
        $userId = $request->input("id");
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');

        $userFirstname = $request->input('firstname');
        $userLastname = $request->input('lastname');

        $userEmail = $request->input('email');

        $userCity = $request->input('city');
        $userState = $request->input('state');

        $userSuspended = $request->input('suspended');

        $userBirthday = $request->input('birthday');
        $userTagline = $request->input('tagline');
        $userPhoto = $request->input('photo');

        $service = new UserService();

        $user = new UserModel($userId, $userUsername, $userPassword, $userFirstname, $userLastname, $userEmail, $userCity, $userState, $userSuspended, $userBirthday, $userTagline, $userPhoto);

        $sService = new SecurityService();

        if ($sService->canEditUser($userId, $request->session()->get('UserID'))) {
            $result = $service->updateUser($user);

            if ($result) {
                $request->id = $userId;
                return $this->displayProfile($request);
            } else {
                return view("profileedit")->with([
                    'id' => $userId,
                    'message',
                    "There was an error updating user."
                ]);
            }
        } else {
            $request->id = $userId;
            return $this->displayProfile($request);
        }
            
    }

    /**
     * Delete a user by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteUser(Request $request)
    {
        $id = $request->input("id");

        $service = new UserService();

        $sService = new SecurityService();

        // If the user is not deleting their own account
        if ($request->session()->get('UserID') != $id) {

            // If the user has permission to edit user
            if ($sService->canEditUser($id, $request->session()->get('UserID'))) {

                // Perform deletion task
                $result = $service->deleteUser($id);

                // TODO make this return a different view for admin/non-admin
                if ($result) {
                    return view("admin")->with([
                        'message' => "User has been deleted.",
                        'users' => $service->getProfiles()
                    ]);
                } else {
                    return view("admin")->with([
                        'message' => "There was an error deleting user.",
                        'users' => $service->getProfiles()
                    ]);
                }
            } else {
                return view("admin")->with([
                    'message' => "No permissions to modify user.",
                    'users' => $service->getProfiles()
                ]);
            }
        } else {

            return view("admin")->with([
                'message' => "You cannot perform this action on yourself.",
                'users' => $service->getProfiles()
            ]);
        }
    }
}
