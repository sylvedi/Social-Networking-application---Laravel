<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
use App\Models\ExperienceModel;
use App\Models\SkillModel;
use App\Models\EducationModel;
use App\Models\JobModel;

/**
 * PAGE ROUTES
 */

// Landing page route
Route::get('/', [
    'as' => 'welcome',
    'uses' => 'JobController@displayJobs'
]);

// Login/registration page route
Route::get('/signin', function () {
    return view('registerandlogin');
})->name('signin');

// Logout route
Route::get('/logout', [
    'as' => 'logout',
    'uses' => "AuthenticationController@logout"
]);

// Admin page route
Route::get('/admin', [
    'as' => 'admin',
    'uses' => "AdministrationController@displayAdminPage"
]);

// Profile page route
Route::get('/profile', [
    'as' => 'profile',
    'uses' => "ProfileController@displayProfile"
]);

// Profile edit page route
Route::get('/profile/edit', [
    'as' => 'editprofile',
    'uses' => "ProfileController@displayProfileForEdit"
]);

// Education edit page
Route::get('/profile/education/edit', [
    'as' => 'editprofileeducation',
    'uses' => "ProfileController@displayEducationForEdit"
]);
Route::get('/profile/education/add', function () {
    return view('addEducation')->with([
        'editing' => false,
        'education' => new EducationModel(null, null, null, null)
    ]);
})->name('addprofileeducation');

// Skill edit page
Route::get('/profile/skill/edit', [
    'as' => 'editprofileskill',
    'uses' => "ProfileController@displaySkillForEdit"
]);
Route::get('/profile/skill/add', function () {
    return view('addSkill')->with([
        'editing' => false,
        'skill' => new SkillModel(null, null, null, null)
    ]);
})->name('addprofileskill');

// Experience edit page
Route::get('/profile/experience/edit', [
    'as' => 'editprofileexperience',
    'uses' => "ProfileController@displayExperienceForEdit"
]);
Route::get('/profile/experience/add', function () {
    return view('addExperience')->with([
        'editing' => false,
        'experience' => new ExperienceModel(null, null, null, null, null, null, null, null)
    ]);
})->name('addprofileexperience');

// Edit job route
Route::get('/job/add', function () {
    return view('addJob')->with([
        'editing' => false,
        'job' => new JobModel(null, null, null, null)
    ]);
})->name('addNewJob');

// Edit job route
Route::get('/job/edit', [
    'as' => 'editjob',
    'uses' => "JobController@displayJobForEdit"
]);

/*
 * API ROUTES
 */

$_APIVER = "vx";

// Process login route
Route::post('/api/' . $_APIVER . "/user/login", [
    'as' => 'login',
    'uses' => "AuthenticationController@loginUser"
]);

// Process registration route
Route::post('/api/' . $_APIVER . "/user/register", [
    'as' => 'register',
    'uses' => "AuthenticationController@registerNewUser"
]);

// Process update user route
Route::post('/api/' . $_APIVER . "/user/update", [
    'as' => 'updateUser',
    'uses' => "ProfileController@updateUser"
]);

// Process delete user route
Route::post('/api/' . $_APIVER . "/user/delete", [
    'as' => 'deleteUser',
    'uses' => "ProfileController@deleteUser"
]);

// Suspend user route
Route::post('/api/' . $_APIVER . "/user/unsuspend", [
    'as' => 'unsuspendUser',
    'uses' => "AdministrationController@unsuspendUser"
]);

// Unsuspend user route
Route::post('/api/' . $_APIVER . "/user/suspend", [
    'as' => 'suspendUser',
    'uses' => "AdministrationController@suspendUser"
]);

// Add Education
Route::post('/api/' . $_APIVER . "/education/create", [
    'as' => 'addEducation',
    'uses' => "ProfileController@createEducation"
]);

// Edit Education
Route::post('/api/' . $_APIVER . "/education/update", [
    'as' => 'updateEducation',
    'uses' => "ProfileController@updateEducation"
]);

// Delete Education
Route::post('/api/' . $_APIVER . "/education/delete", [
    'as' => 'deleteEducation',
    'uses' => "ProfileController@deleteEducation"
]);
Route::get('/api/' . $_APIVER . "/education/delete", [
    'as' => 'deleteEducation',
    'uses' => "ProfileController@deleteEducation"
]);

// Add Skill
Route::post('/api/' . $_APIVER . "/skill/create", [
    'as' => 'addSkill',
    'uses' => "ProfileController@createSkill"
]);

// Edit Skill
Route::post('/api/' . $_APIVER . "/skill/update", [
    'as' => 'updateSkill',
    'uses' => "ProfileController@updateSkill"
]);

// Delete Skill
Route::post('/api/' . $_APIVER . "/skill/delete", [
    'as' => 'deleteSkill',
    'uses' => "ProfileController@deleteSkill"
]);
Route::get('/api/' . $_APIVER . "/skill/delete", [
    'as' => 'deleteSkill',
    'uses' => "ProfileController@deleteSkill"
]);

// Add Experience
Route::post('/api/' . $_APIVER . "/experience/create", [
    'as' => 'addExperience',
    'uses' => "ProfileController@createExperience"
]);

// Edit Experience
Route::post('/api/' . $_APIVER . "/experience/update", [
    'as' => 'updateExperience',
    'uses' => "ProfileController@updateExperience"
]);

// Delete Experience
Route::post('/api/' . $_APIVER . "/experience/delete", [
    'as' => 'deleteExperience',
    'uses' => "ProfileController@deleteExperience"
]);
Route::get('/api/' . $_APIVER . "/experience/delete", [
    'as' => 'deleteExperience',
    'uses' => "ProfileController@deleteExperience"
]);

// Add Job
Route::post('/api/' . $_APIVER . "/job/create", [
    'as' => 'addJob',
    'uses' => "JobController@createJob"
]);

// Edit Job
Route::post('/api/' . $_APIVER . "/job/update", [
    'as' => 'updateJob',
    'uses' => "JobController@updateJob"
]);

// Delete Job
Route::post('/api/' . $_APIVER . "/job/delete", [
    'as' => 'deleteJob',
    'uses' => "JobController@deleteJob"
]);

/*
 * DEBUG ROUTES
 */
// Debug route
Route::get('/debug', "DebugController@scratchPad");