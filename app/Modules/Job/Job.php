<?php

namespace App\Modules\Job;


use App\Models\Job as JobModel;

class Job
{

    private $jobModel;


    public function __construct()
    {

        $this->jobModel = new JobModel;
    }


    public function createJob(array $data)
    {

        $job = $this->jobModel->create($data);

        return return_msg(true, 'ok', compact('job'));
    }


    public function updateJob(array $data)
    {

        $job = $this->findJob($data['job_id']);
        if (!$job) {

            return return_msg(false, 'No fount', [
                'validation_errors' => []
            ]);
        }
        $job->update($data);

        return return_msg(true, 'ok', compact('job'));
    }

    public function findJob($id)
    {

        return $this->jobModel->find($id);
    }

    public function getJob($id)
    {
        $job = $this->findJob($id);
        if (!$job) {

            return return_msg(false, 'No fount');
        }

        $job->load(['jobType']);
        return return_msg(true, 'ok', compact('job'));
    }


    public function getAllJobs($query = null)
    {

        if ($query) {

            $jobs = $this->jobModel
                ->with('jobType')
                ->where('job_name', 'LIKE', '%' . $query . '%')
                ->get();
        } else {

            $jobs = $this->jobModel
                ->with('jobType')
                ->get();
        }

        return return_msg(true, 'ok', compact('jobs'));
    }


    public function getUserJobs($user_id)
    {

        $jobs = $this->jobModel
            ->whereUserId($user_id)
            ->get();

        return return_msg(true, 'ok', compact('jobs'));
    }


    public function deleteJob($id)
    {

        $job = $this->findJob($id);
        if (!$job) {

            return return_msg(false, 'No fount');
        }

        $job->delete();

        return return_msg(true, 'ok');
    }

    public function searchJobs(string $query)
    {

        $jobs = $this->jobModel->where('job_name', 'LIKE', '%' . $query . '%');

        return return_msg(true, 'ok', compact('jobs'));
    }
}