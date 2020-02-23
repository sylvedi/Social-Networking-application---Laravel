<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Business\UserService;
use App\Models\LoginModel;
use App\Models\RegistrationModel;

/**
 * Manages authentication related tasks such as login and logout
 *
 * @author Jake McDermitt
 *        
 */
class AuthenticationController extends Controller
{

    /**
     * Register a user from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function registerNewUser(Request $request)
    {

        // POST parameters
        $userFirstName = $request->input('firstname');
        $userLastName = $request->input('lastname');

        $userCity = $request->input('city');
        $userState = $request->input('state');

        $userEmail = $request->input('email');

        $userUsername = $request->input('username');
        $userPassword = $request->input('password');

        // Insert user
        $reg = new RegistrationModel(null, $userUsername, $userPassword, $userFirstName, $userLastName, $userEmail, $userCity, $userState);
        $service = new UserService();
        $success = $service->registerUser($reg);

        if ($success == 1) {
            return view("registerandlogin")->with([
                'message' => "Account created successfully. Please log in.",
                'doLogin' => true
            ]);
        } else if ($success == 2) {
            return view("registerandlogin")->with([
                'message' => "A user with that username already exists."
            ]);
        } else {
            return view("registerandlogin")->with([
                'message' => "There was an error during registration."
            ]);
        }
    }

    /**
     * Process login from a form
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function loginUser(Request $request)
    {

        // POST parameters
        $userUsername = $request->input('username');
        $userPassword = $request->input('password');

        // Services
        $service = new SecurityService();
        $uService = new UserService();

        // Authenticate
        $loginResult = $service->authenticate(new LoginModel(null, $userUsername, $userPassword));

        if ($loginResult) {
            $userId = $loginResult['id'];
            $isAdmin = $service->isAdmin($userId);
            $userData = $uService->getProfile($userId);

            if ($userData->getSuspended()) {
                return view("registerandlogin")->with([
                    'message' => "Your account has been suspended.",
                    'doLogin' => true
                ]);
            } else {
                $request->session()->put([
                    'LoggedIn' => true
                ]);
                $request->session()->put([
                    'UserID' => $userId
                ]);
                $request->session()->put([
                    'IsAdmin' => $isAdmin
                ]);
                $request->session()->put([
                    'user' => $userData
                ]);
                return view("welcome");
            }
        } else {
            return view("registerandlogin")->with([
                'message' => "That username and password does not exist.",
                'doLogin' => true
            ]);
        }
    }

    /**
     * Logout the user and clear session data
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function logout(Request $request)
    {
        $request->session()->put([
            'LoggedIn' => null
        ]);
        $request->session()->put([
            'UserID' => null
        ]);
        $request->session()->put([
            'IsAdmin' => null
        ]);
        $request->session()->put(['user'=>null]);
        return view("registerandlogin")->with(['message'=>"You have been logged out.", 'doLogin'=>true]);
    }
    
}
