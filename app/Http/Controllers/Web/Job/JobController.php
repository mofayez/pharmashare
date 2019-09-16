<?php

namespace App\Http\Controllers\Web\Job;

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Web\UtilityController;
use App\Models\AdsControl;
use Illuminate\Http\Request;
use App\Modules\User\User as UserModule;
use App\Http\Controllers\Controller;

class JobController extends Controller
{

    private $user;
    private $utility;
    private $job_ctrl;
    private $ads;

    public function __construct()
    {
        $this->user = new UserModule();
        $this->utility = new UtilityController();
        $this->job_ctrl = new \App\Http\Controllers\Api\JobController();
        $this->ads = new AdsController();
    }


    public function index()
    {
        $page_title = "postJob";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $job_types = $this->utility->getJobTypes();

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $first_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {
            $first_ratio = $response2['data']['first_ratio'];
        }

        return view('pages.postJob.index', compact('page_title', 'user', 'all_users', 'job_types', 'allowed_ads', 'first_ratio'));

    }
    
    public function searchJobs(Request $request){
        
        $page_title = "search Job";
        $user = auth()->user();
        $q = $request->q;
        
        $jobs = [];
        $response = $this->job_ctrl->getAllJobs($q);
        if ($response['status']) {
            $jobs = $response['data']['jobs'];
        }
        
        return view('pages.searchJob.index', compact('page_title', 'user','jobs'));
    }
    
    public function handlePostJob(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        
        if($request->job_type_id != 3){
            $request->request->add(['salary'=>0]);    
            $request->request->add(['max_salary'=>0]);    
        }
         
        $response = $this->job_ctrl->create($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return redirect()->route('getAllJob');
    }

    public function getAllJobs()
    {
        $page_title = "postJob";
        $user = auth()->user();
        $this->user->getUserImagePath($user);

        $all_users = $this->user->all();
        $jobs = [];
        $response = $this->job_ctrl->allOfUser($user->id);
        if ($response['status']) {
            $jobs = $response['data']['jobs'];
        }

        return view('pages.allJobs.index', compact('page_title', 'user', 'all_users', 'jobs'));
    }

    public function getEditJob(Request $request, $id)
    {
        $response = $this->job_ctrl->getJob($id);
        $user = auth()->user();
        $this->user->getUserImagePath($user);
        $job = null;
        if ($response['status']) {
            $job = $response['data']['job'];

            if ($job->user_id != auth()->user()->id) {
                return back();
            }

            $job_types = $this->utility->getJobTypes();
            return view('pages.updateJob.index', compact('page_title', 'user', 'all_users', 'job_types', 'job'));
        }

        return redirect()->route('getAllJob');
    }

    public function handleUpdateJob(Request $request, $id)
    {
        $request['job_id'] = $id;
        $request['user_id'] = auth()->user()->id;
        $response = $this->job_ctrl->update($request);

        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }

        return back()->with('success', __('settings.edit_success'));
    }

    public function deleteJob(Request $request)
    {
        return $this->job_ctrl->deleteJob($request->job_id);
    }
}
