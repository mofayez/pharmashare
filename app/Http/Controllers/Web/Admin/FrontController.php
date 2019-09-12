<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Drug;
use App\Models\DrugStore;
use App\Models\Service;
use App\Models\Translation;
use App\Models\User;
use App\Modules\Front\Contact;
use App\Modules\Front\Slider;
use App\Modules\Job\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    /**
     * @var Slider
     */
    private $slider_module;
    /**
     * @var \App\Modules\Front\Service
     */
    private $service_module;
    /**
     * @var Job
     */
    private $job_module;
    /**
     * @var Contact
     */
    private $contact_module;
    /**
     * @var \App\Modules\Front\Pricing
     */
    private $pricing_module;
    /**
     * @var \App\Modules\Front\Tesimonial
     */
    private $testimonial_module;
    /**
     * @var \App\Modules\Front\FAQ
     */
    private $faq_module;

    /**
     * FrontController constructor.
     */
    public function __construct()
    {
        $this->slider_module = new Slider();
        $this->job_module = new Job();
        $this->contact_module = new Contact();
        $this->service_module = new \App\Modules\Front\Service();
        $this->pricing_module = new \App\Modules\Front\Pricing();
        $this->testimonial_module = new \App\Modules\Front\Tesimonial();
        $this->faq_module = new \App\Modules\Front\FAQ();
    }

    /**
     * @return array|null
     */
    public function getAllSliders()
    {
        return $this->slider_module->all();
    }

    /**
     * @return array|null
     */
    public function getAllServices()
    {
        return $this->service_module->all();
    }

    /**
     * @return array|null
     */
    public function getAllPricing()
    {
        return $this->pricing_module->all();
    }

    /**
     * @return array|null
     */
    public function getAllTestimonial()
    {
        return $this->testimonial_module->all();
    }

    /**
     * @return array|null
     */
    public function getAllFAQ()
    {
        return $this->faq_module->all();
    }

    /**
     * @param null $query
     * @return array|null
     */
    public function getAllJobs($query = null)
    {
        return $this->job_module->getAllJobs($query);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|null
     */
    public function getFindSlide(Request $request, $id)
    {
        return $this->slider_module->find($id);
    }


    /**
     * @param Request $request
     * @param $id
     * @return array|null
     */
    public function getDeleteSlide(Request $request, $id)
    {
        return $this->slider_module->delete($id);
    }


    /**
     * @param Request $request
     * @return array|null
     */
    public function createSlider(Request $request)
    {
        return $this->slider_module->store($request);
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function updateSlider(Request $request)
    {
        return $this->slider_module->update($request);
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function updateTestimonial(Request $request)
    {
        return $this->testimonial_module->update($request);
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function updateFAQ(Request $request)
    {
        return $this->faq_module->update($request);
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function updateService(Request $request)
    {
        return $this->service_module->update($request);
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function updatePrice(Request $request)
    {
        return $this->pricing_module->update($request);
    }

    /**
     * @return array
     */
    public function getStatistics()
    {
        $store = User::where('role_id', 2)->count();
        $pharmacy = User::where('role_id', 3)->count();
        $drugs = Drug::count();
        $drugs_store = DrugStore::count();
        return compact('pharmacy', 'store', 'drugs', 'drugs_store');
    }

    public function getTranslations()
    {
        return Translation::all();
    }

    public function handleTranslations(Request $request)
    {
        $this->validate($request, [
            'text_ar' => 'required',
            'text_en' => 'required',
            'id' => 'required',
        ]);

        $id = $request->get('id');
        $text_ar = $request->get('text_ar');
        $text_en = $request->get('text_en');

        $translation = Translation::find($id);
        if (!$translation) {

            return [
                'status' => false,
                'data' => [],
            ];
        }
        $translation->text_ar = $text_ar;
        $translation->text_en = $text_en;
        $translation->save();

        return [
            'status' => true,
            'data' => compact('translation'),
        ];
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function createContact(Request $request)
    {
        return $this->contact_module->createContact($request);
    }

    /**
     * @return mixed
     */
    public function getPharmacyLocations(Request $request)
    {
        $type = $request->type;
        
        if(!$type){
            $users = User::get(['id', 'firstname', 'lastname', 'phone']);
        }
        if($type == 'all'){
            $users = User::get(['id', 'firstname', 'lastname', 'phone']);
        }
        if($type == 'pharmacy'){
            $users = User::where('role_id', 3)->get(['id', 'firstname', 'lastname', 'phone']);
        }
        if($type == 'store'){
            $users = User::where('role_id', 2)->get(['id', 'firstname', 'lastname', 'phone']);
        }
        
        $users->load('location');
        return $users;
         
    }
}
