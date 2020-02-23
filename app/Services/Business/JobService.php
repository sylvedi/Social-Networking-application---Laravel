<?php
namespace App\Services\Business;

use App\Services\Data\JobDAO;
use App\Models\JobModel;

/**
 * Contains methods for managing job postings and applications
 *
 * @author Jake McDermitt
 *        
 */
class JobService
{

    private $db;

    public function __construct()
    {
        $this->db = DataService::connect();
    }

    /**
     * Get an array of all job postings
     *
     * @return array|boolean|array
     */
    public function getJobs()
    {
        $service = new JobDAO($this->db);
        $result = $service->readAll();
        if (! $result) {
            return array();
        } else {
            return $result;
        }
    }

    /**
     * Get a job posting by id
     *
     * @param int $id
     * @return \App\Models\JobModel|boolean|\App\Models\JobModel
     */
    public function getJob($id)
    {
        $service = new JobDAO($this->db);
        $result = $service->readById($id);
        if (! $result) {
            return new JobModel(null, null, null, null);
        } else {
            return $result;
        }
    }

    /**
     * Create a job posting from a form
     *
     * @param JobModel $job
     * @return boolean
     */
    public function createJob($job)
    {
        $service = new JobDAO($this->db);

        $result = $service->create($job);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Update a job posting from a form
     *
     * @param JobModel $job
     * @return boolean
     */
    public function updateJob($job)
    {
        $service = new JobDAO($this->db);

        $result = $service->update($job);
        if ($result)
            return true;
        else
            return false;
    }

    /**
     * Delete a job posting by id
     *
     * @param int $id
     * @return boolean
     */
    public function deleteJob($id)
    {
        $service = new JobDAO($this->db);

        $result = $service->delete($id);
        if ($result)
            return true;
        else
            return false;
    }
}

