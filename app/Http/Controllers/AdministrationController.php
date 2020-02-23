<?php
namespace App\Http\Controllers;

use App\Services\Business\UserService;
use App\Services\Business\JobService;
use App\Services\Business\SecurityService;
use Illuminate\Http\Request;

/**
 * Manages administrative tasks such as user suspension and admin view display.
 *
 * @author Jake McDermitt
 *        
 */
class AdministrationController extends Controller
{

    /**
     * Displays the administrator landing page if the logged in user has admin privileges.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayAdminPage(Request $request)
    {
        $service = new SecurityService();
        if ($service->isAdmin($request->session()
            ->get('UserID'))) {
            $uService = new UserService();
            $allUsers = $uService->getProfiles();
            $jService = new JobService();
            $allJobs = $jService->getJobs();
            return view("admin")->with([
                'users' => $allUsers,
                'jobs' => $allJobs
            ]);
        } else {
            return view("welcome");
        }
    }

    /**
     * Suspend a user by ID
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspendUser(Request $request)
    {

        // POST parameters
        $userId = $request->input("id");

        $service = new SecurityService();

        // If the ID is not that of the logged in user
        if (session('UserID') != $userId) {
            $result = $service->suspendUser($userId);
            if ($result) {
                return redirect()->route('admin')->with([
                    'message' => 'The user was suspended.'
                ]);
            }
        } else {
            return redirect()->route('admin')->with([
                'message' => 'You cannot perform this action on yourself'
            ]);
        }
    }

    /**
     * Restore a user by ID
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsuspendUser(Request $request)
    {

        // POST parameters
        $userId = $request->input("id");

        $service = new SecurityService();

        // If the ID is not that of the logged in user
        if (session('UserID') != $userId) {
            $result = $service->unsuspendUser($userId);
            if ($result) {
                return redirect()->route('admin')->with([
                    'message' => 'The user was restored.'
                ]);
            }
        } else {
            return redirect()->route('admin')->with(['message'=>'You cannot perform this action on yourself']);
        }
    }
}
