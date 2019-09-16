<?php

namespace App\Http\Controllers\Api;

use App\Modules\Job\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{

    private $job;

    public function __construct()
    {

        $this->job = new Job();
    }

    public function create(Request $request)
    {

        $validation = $this->validateCreateRequest($request);
        if ($validation->fails()) {
            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->job->createJob($request->all());
    }

    public function allOfUser($user_id)
    {

        $jobs = $this->job->getUserJobs($user_id);

        return $jobs;
    }


    public function update(Request $request)
    {

        $validation = $this->validateUpdateRequest($request);
        if ($validation->fails()) {
            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->job->updateJob($request->all());
    }

    public function getAllJobs($query = null)
    {

        return $this->job->getAllJobs($query);
    }


    public function getJob($id)
    {

        return $this->job->getJob($id);
    }

    public function deleteJob($id)
    {

        return $this->job->deleteJob($id);
    }



    protected function validateCreateRequest(Request $request)
    {

        return validator($request->all(), [
            'user_id' => 'required',
            'job_type_id' => 'required',
            'job_name' => 'required|min:2|max:50',
            'salary' => 'required|numeric',
            'max_salary' => 'required|numeric',
            'requirements' => 'required|min:2|max:500',
            'contacts' => 'required',
        ]);
    }

    protected function validateUpdateRequest(Request $request)
    {

        return validator($request->all(), [
            'job_id' => 'required',
            'user_id' => 'required',
            'job_type_id' => 'required',
            'job_name' => 'required|min:2|max:50',
            'salary' => 'required|numeric',
            'max_salary' => 'required|numeric',
            'requirements' => 'required|min:2|max:500',
            'contacts' => 'required',
        ]);
    }


    public function searchJobs($query)
    {

        $jobs = $this->job->searchJobs($query);

        return $jobs;
    }
}
