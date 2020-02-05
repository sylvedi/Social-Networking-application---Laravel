<?php
namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\SecurityService;
use Illuminate\Http\Request;

/*
 * Controls functions found on the administrator-level pages
 */
class AdministrationController extends Controller
{

    /*
     * Displays the administrator landing page if the logged in user has admin privileges.
     */
    public function displayAdminPage(Request $request)
    {
        $service = new SecurityService();
        if ($service->isAdminSession()) {
            $uService = new UserService();
            $allUsers = $uService->getProfiles();
            return view("admin")->with([
                'users' => $allUsers
            ]);
        } else {
            return view("welcome");
        }
    }

    /*
     * Suspend a user by ID
     */
    public function suspendUser(Request $request)
    {

        // POST parameters
        $userId = $request->input("id");

        $service = new UserService();

        // If the ID is not that of the logged in user
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

    /*
     * Remove user suspension by ID
     */
    public function unsuspendUser(Request $request)
    {

        // POST parameters
        $userId = $request->input("id");

        $service = new UserService();

        // If the ID is not that of the logged in user
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
}
