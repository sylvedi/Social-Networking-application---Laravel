<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobModel;
use App\Services\Business\JobService;
use App\Services\Business\SecurityService;

/**
 * Manages tasks relating to job posting and application
 *
 * @author Jake McDermitt
 *        
 */
class JobController extends Controller
{

    /**
     * Display all of the jobs in the database
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayJobs(Request $request)
    {
        $service = new JobService();
        $jobs = $service->getJobs();

        return view('welcome')->with([
            'jobs' => $jobs
        ]);
    }

    /**
     * Display a single job for editing
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function displayJobForEdit(Request $request)
    {

        // GET parameters
        $id = $request->id;

        $sService = new SecurityService();
        $isAdmin = $sService->isAdmin($request->session()
            ->get('UserID'));

        if ($isAdmin) {

            $jService = new JobService();
            $job = $jService->getJob($id);
            return view("addJob")->with([
                'job' => $job,
                'editing' => true
            ]);
        } else {
            return view("profile")->with([
                'message' => "No permissions to modify user."
            ]);
        }
    }

    /**
     * Delete a job by an id
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteJob(Request $request)
    {
        $id = $request->id;

        $sService = new SecurityService();
        $isAdmin = $sService->isAdmin($request->session()
            ->get('UserID'));

        if ($isAdmin) {

            $jService = new JobService();
            $result = $jService->deleteJob($id);

            if ($result) {
                return redirect()->route('admin');
            } else {
                return redirect()->route('admin')->with([
                    'message' => 'There was an error deleting the job.'
                ]);
            }
        }
    }

    /**
     * Create a job from a form
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createJob(Request $request)
    {
        $request->validate(JobModel::getRules());

        $title = $request->input('title');
        $description = $request->input('description');

        $sService = new SecurityService();
        $isAdmin = $sService->isAdmin($request->session()
            ->get('UserID'));

        if ($isAdmin) {

            $job = new JobModel(null, null, $title, $description);

            $jService = new JobService();
            $result = $jService->createJob($job);

            if ($result) {
                return redirect()->route('admin');
            } else {
                return redirect()->route('admin')->with([
                    'message' => 'There was an error creating the job.'
                ]);
            }
        }
    }

    /**
     * Update a job from a form
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateJob(Request $request)
    {
        $request->validate(JobModel::getRules());

        $id = $request->input('id');
        $companyid = $request->input('companyid');
        $title = $request->input('title');
        $description = $request->input('description');

        $sService = new SecurityService();
        $isAdmin = $sService->isAdmin($request->session()
            ->get('UserID'));

        if ($isAdmin) {

            $job = new JobModel($id, $companyid, $title, $description);

            $jService = new JobService();
            $result = $jService->updateJob($job);

            if ($result) {
                return redirect()->route('admin');
            } else {
                return redirect()->route('admin')->with([
                    'message' => 'There was an error updating the job.'
                ]);
            }
        }
    }
}
