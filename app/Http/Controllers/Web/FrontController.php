<?php

namespace App\Http\Controllers\Web;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{

    /**
     * @var Admin\FrontController
     */
    private $front;

    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->front = new \App\Http\Controllers\Web\Admin\FrontController();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndexView(Request $request)
    {
        $jobs = [];
        $slider = [];
        $services = [];
        $pricing = [];
        $testimonials = [];
        $faq = [];
        $response = $this->front->getAllJobs();
        $response2 = $this->front->getAllSliders();
        $response3 = $this->front->getAllServices();
        $response4 = $this->front->getAllPricing();
        $response5 = $this->front->getAllTestimonial();
        $response6 = $this->front->getAllFAQ();
        $statistics = $this->front->getStatistics();
        $translation = Translation::get(['text_ar', 'text_en', 'title']);

        if ($response['status']) {
            $jobs = $response['data']['jobs'];
        }
        if ($response2['status']) {
            $slider = $response2['data']['slides'];
        }
        if ($response3['status']) {
            $services = $response3['data']['services'];
        }
        if ($response4['status']) {
            $pricing = $response4['data']['pricings'];
        }
        if ($response5['status']) {
            $testimonials = $response5['data']['testimonials'];
        }
        if ($response6['status']) {
            $faq = $response6['data']['faq'];
        }

        return view('front_site.index', compact('jobs', 'statistics', 'slider', 'services', 'pricing', 'testimonials', 'translation', 'faq'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContactView()
    {
        return view('front_site.contactus');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getJobsView(Request $request)
    {
        $jobs = [];
        $response = $this->front->getAllJobs($request->search);
        if ($response['status']) {
            $jobs = $response['data']['jobs'];
        }
        return view('front_site.jobs', compact('jobs'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPharamcyView(Request $request)
    {
        $users = $this->front->getPharmacyLocations($request);
        // return $users;
        return view('front_site.findPharmacy', compact('users'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleContactUs(Request $request)
    {
        $response = $this->front->createContact($request);
        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }

        return back()->with('success', 'تم الارسال بنجاح');
    }
}
