<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\DataService;
use App\Services\SecurityService;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function displayProfile(Request $request)
    {
        $id = $request->id;

        $db = DataService::connect();
        $service = new UserService($db);
        $user = $service->getProfile($id);

        return view("profile")->with([
            'user' => $user,
            'id' => $id
        ]);
    }

    public function displayProfileForEdit(Request $request)
    {
        $id = $request->id;

        $db = DataService::connect();
        $service = new UserService($db);
        $sService = new SecurityService($db);

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

    public function suspendUser(Request $request)
    {
        $userId = $request->input("id");

        $db = DataService::connect();
        $service = new UserService($db);

        if (session('UserID') != $userId) {
            $result = $service->suspendUser($userId);
            if ($result) {
                return view("admin")->with([
                    'message' => "The user was suspended.",
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

    public function unsuspendUser(Request $request)
    {
        $userId = $request->input("id");

        $db = DataService::connect();
        $service = new UserService($db);

        if (session('UserID') != $userId) {
            $result = $service->unsuspendUser($userId);
            if ($result) {
                return view("admin")->with([
                    'message' => "The user was restored.",
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

    public function updateUser(Request $request)
    {
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

        $db = DataService::connect();
        $service = new UserService($db);

        $user = new UserModel($userId, $userUsername, $userPassword, $userFirstname, $userLastname, $userEmail, $userCity, $userState, $userSuspended, $userBirthday, $userTagline, $userPhoto);

        $sService = new SecurityService($db);

        if ($sService->canEditUser($userId)) {
            $result = $service->updateUser($user);

            if ($result) {
                return view("profile")->with([
                    'user' => $user,
                    'id' => $userId
                ]);
            } else {
                return view("profile")->with([
                    'id' => $userId,
                    'message',
                    "There was an error updating user."
                ]);
            }
        } else {
            return view("profile")->with([
                'message' => "No permissions to modify user."
            ]);
        }
    }

    public function deleteUser(Request $request)
    {

        // TODO authenticate against session ID
        $id = $request->input("id");

        $db = DataService::connect();
        $service = new UserService($db);

        $sService = new SecurityService($db);

        if (session('UserID') != $id) {
            if ($sService->canEditUser($id)) {
                $result = $service->deleteUser($id);

                // TODO make this return a different view for admin/non-admin
                if ($result) {
                    return view("admin")->with([
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
