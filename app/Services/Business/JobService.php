<?php

namespace App\Services\Business;

use App\Services\Data\JobDAO;
use App\Models\JobModel;

/*
 * Contains methods to manage users
 */
class JobService
{

    private $db;

    public function __construct()
    {
        $this->db = DataService::connect();
    }

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

    public function createJob($job)
    {
        $service = new JobDAO($this->db);

        $result = $service->create($job);
        if ($result)
            return true;
        else
            return false;
    }

    public function updateJob($job)
    {
        $service = new JobDAO($this->db);

        $result = $service->update($job);
        if ($result)
            return true;
        else
            return false;
    }

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

