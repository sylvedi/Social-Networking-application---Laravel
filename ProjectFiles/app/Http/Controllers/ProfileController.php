<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\UserService;
use App\Services\Business\SecurityService;
use App\Models\UserModel;

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

        return view("profile")->with([
            'user' => $user,
            'id' => $id
        ]);
    }
    
    // TODO list skill
    // TODO list education
    // TODO list experience

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
        if ($sService->canEditUser($id)) {
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
     * Retrieve a form for editing a skill by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displaySkillForEdit(Request $request)
    {
        
        // TODO Display skill for edit
        // GET parameters
        $id = $request->id;
        
        $service = new UserService();
        $sService = new SecurityService();
        
        // If the logged in user has permission to edit the profile
        if ($sService->canEditUser($id)) {
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
     * Retrieve a form for editing a user experience entry by ID
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayExperienceForEdit(Request $request)
    {
        
        // TODO Display experience for edit
        
        // GET parameters
        $id = $request->id;
        
        $service = new UserService();
        $sService = new SecurityService();
        
        // If the logged in user has permission to edit the profile
        if ($sService->canEditUser($id)) {
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
        
        // TODO Display education for edit
        
        // GET parameters
        $id = $request->id;
        
        $service = new UserService();
        $sService = new SecurityService();
        
        // If the logged in user has permission to edit the profile
        if ($sService->canEditUser($id)) {
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
     * Update a user profile from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateUser(Request $request)
    {
        
        $request->validate(UserModel::$rules);
        
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

        if ($sService->canEditUser($userId)) {
            $result = $service->updateUser($user);

            if ($result) {
                return view("profile")->with([
                    'user' => $user,
                    'id' => $userId
                ]);
            } else {
                return view("profileedit")->with([
                    'id' => $userId,
                    'message',
                    "There was an error updating user."
                ]);
            }
        } else {
            return view("profile")->with([
                'user' => $user,
                'message' => "No permissions to modify user."
            ]);
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
        if (session('UserID') != $id) {

            // If the user has permission to edit user
            if ($sService->canEditUser($id)) {

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
