<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\API\ComplaintController;
use App\Http\Controllers\Api\DrugStoreController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PharmacyController;
use App\Http\Controllers\Api\PointsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Web\Admin\FrontController;
use App\Http\Controllers\Web\UtilityController;
use App\Models\AdsControl;
use App\Models\Contact;
use App\Models\Slider;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Modules\User\User as UserModule;
use App\Http\Controllers\Controller;

/**
 * Class SettingController
 * @package App\Http\Controllers\Web\Profile
 */
class SettingController extends Controller
{
    /**
     * @var UserModule
     */
    private $user;
    /**
     * @var UserController
     */
    private $user_crtl;
    /**
     * @var PharmacyController
     */
    private $pharmacy_ctrl;
    /**
     * @var DrugStoreController
     */
    private $store_ctrl;
    /**
     * @var UtilityController
     */
    private $utilty;
    /**
     * @var FrontController
     */
    private $front;
    /**
     * @var NotificationController
     */
    private $notification;
    private $complaints;
    private $settings;
    private $points;

    /**
     * SettingController constructor.
     */
    public function __construct()
    {
        $this->user = new UserModule();
        $this->utilty = new UtilityController();
        $this->user_crtl = new UserController();
        $this->notification = new NotificationController();
        $this->pharmacy_ctrl = new PharmacyController();
        $this->store_ctrl = new DrugStoreController();
        $this->front = new FrontController();
        $this->complaints = new ComplaintController();
        $this->settings = new Settings();
        $this->points = new PointsController();

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfileSettingView()
    {
        $page_title = "Settings";
        $user = auth()->user();
        $nav = 1;
        $this->user->getUserImagePath($user);

        return view('pages.setting.editProfile.index', compact('page_title', 'user', 'nav'));
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Database\Eloquent\Model|null
     */
    public function updateProfileImage(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        return $this->user_crtl->saveUserImage($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileInfo(Request $request)
    {
        $response = $this->user_crtl->updateUser($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPaymentsSettingView()
    {
        $page_title = "Settings";
        $user = auth()->user();
        $nav = 2;
        $this->user->getUserImagePath($user);
        $current_payments = auth()->user()->paymentTypes->pluck('id')->toArray();
        $payments = $this->utilty->getPaymentTypes();
        $store_setting = $this->utilty->getStoreSettings($user->id);

        return view('pages.setting.setPayments.index', compact('page_title', 'user', 'nav', 'payments', 'current_payments', 'store_setting'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPaymentTypes(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $response = $this->user_crtl->savePaymentTypes($request);
        if ($response['status']) {
            return back()->with('success', __('settings.edit_success'));
        }
        return back()->with('error', 'Error');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNotificationsSettingView()
    {
        $page_title = "Notifications";
        $user = auth()->user();
        $nav = 4;
        $this->user->getUserImagePath($user);

        $notifications = [];

        $role = $user->role->title;


        $response = (new NotificationController())->getLatestNotifications($role, auth()->user()->id);

        if ($response['status']) {
            $notifications = $response['data']['notifications'];
            if ($role == 'admin') {
                $this->notification->updateNotificationReadAtAdmin($notifications);
            } else {
                $this->notification->updateNotificationReadAt($notifications);
            }
        }
        // return $notifications;
        return view('pages.setting.notifications.index', compact('page_title', 'user', 'nav', 'notifications'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPharmacyBlacklist()
    {
        $page_title = "Settings";
        $user = auth()->user();
        $nav = 5;
        $this->user->getUserImagePath($user);

        $blocked_stores = $user->load(['blockedStores.store']);

        return view('pages.setting.pharmacyBlocklist.index', compact('page_title', 'user', 'nav', 'blocked_stores'));
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function unblockStore(Request $request)
    {
        return $this->pharmacy_ctrl->unBlockStore($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStoreBlacklist()
    {
        $page_title = "Settings";
        $user = auth()->user();
        $nav = 5;
        $this->user->getUserImagePath($user);

        $blocked_pharmacies = $user->load(['blockedPharmacies.pharmacy']);
        return view('pages.setting.storeBlocklist.index', compact('page_title', 'user', 'nav', 'blocked_pharmacies'));
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function unblockPharmacy(Request $request)
    {
        return $this->store_ctrl->unBlockPharmacy($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setMinOrderPricing(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $response = $this->store_ctrl->saveSettings($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHeaderSite()
    {
        $page_title = "Header Site";
        $user = auth()->user();
        $nav = 6;
        $this->user->getUserImagePath($user);
        $response = $this->front->getAllSliders();
        $response2 = $this->front->getAllServices();
        $response3 = $this->front->getAllPricing();
        $response4 = $this->front->getAllTestimonial();
        $response5 = $this->front->getAllFAQ();
        $translations = $this->front->getTranslations();
        $slider = [];
        if ($response['status']) {
            $slider = $response['data']['slides'];
        }
        $slide = $slider->last() ?? [];
        $services = [];
        if ($response2['status']) {
            $services = $response2['data']['services'];
        }
        $pricing = [];
        if ($response3['status']) {
            $pricing = $response3['data']['pricings'];
        }
        $testimonials = [];
        if ($response4['status']) {
            $testimonials = $response4['data']['testimonials'];
        }
        $faqs = [];
        if ($response5['status']) {
            $faqs = $response5['data']['faq'];
        }
        return view('pages.setting.getSlideHeader.index', compact('page_title', 'user', 'nav', 'slide', 'services', 'pricing', 'testimonials', 'faqs', 'translations'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleServiceSite(Request $request)
    {
        $response = $this->front->updateService($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleTestimonialSite(Request $request)
    {
        $response = $this->front->updateTestimonial($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleFaqSite(Request $request)
    {
        $response = $this->front->updateFAQ($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handlePriceSite(Request $request)
    {
        $response = $this->front->updatePrice($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleHeaderSite(Request $request)
    {
        $response = $this->front->updateSlider($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function handleHeaderUpdateImage(Request $request)
    {
        $file = $request->file('file');
        $slide_id = $request->input('slide_id');

        if ($file) {
            $slide = Slider::find($slide_id);
            if ($slide->image) {
                @unlink(storage_path('files/slider') . $slide->image->name);
            }

            $slide->image()->delete();

            // save image
            $file_name = time() . '.' . $file->extension();


            $file->move(storage_path('files/slider'), $file_name);

            $slide->image()->create([
                'name' => $file_name
            ]);
            return [
                'status' => true,
            ];
        }

        return [
            'status' => false,
        ];

    }

    public function handleTranslation(Request $request)
    {
        $this->validate($request, [
            'text_ar' => 'required',
            'text_en' => 'required',
            'id' => 'required',
        ]);
        $response = $this->front->handleTranslations($request);
        if ($response['status']) {

            return back()->with('success', __('settings.edit_success'));
        }
        return back()->with('error', 'error');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContactUs()
    {
        $page_title = "Contact";
        $user = auth()->user();
        $nav = 7;
        $this->user->getUserImagePath($user);

        $contacts = Contact::all();
        return view('pages.setting.getAllContacts.index', compact('page_title', 'user', 'nav', 'contacts'));
    }

    public function deleteContactUs(Request $request)
    {
        $contact = Contact::find($request->id);
        if ($contact) {
            $contact->delete();
            return return_msg(true, 'deleted', []);
        }
        return return_msg(false, 'not found', []);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditLicensesView()
    {

        $page_title = "Settings";
        $user = auth()->user();
        $nav = 3;
        $this->user->getUserImagePath($user);
        $user->papers = $this->user_crtl->getPapersByUserId($user->id)['data']['user']['papers'] ?? '';
        return view('pages.setting.editLicenses.index', compact('page_title', 'user', 'nav'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditLicenses(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $response = $this->user_crtl->registerUserPapers($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.edit_success'));
    }

    public function postEditLocations(Request $request)
    {
        $location = $request->location ?? '-';
        $request->request->add(['location' => $location]);
        $response = $this->user_crtl->registerUserLocation($request);

        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }

        return back()->with('success', __('settings.edit_success'));
    }

    public function getComplaintsUs()
    {
        $page_title = "Complaints";
        $user = auth()->user();
        $nav = 8;
        $this->user->getUserImagePath($user);
        $complaints = [];
        $response = $this->complaints->getAllComplaints();
        if ($response['status']) {
            $complaints = $response['data']['complaints'];
        }
//        return $complaints;
        return view('pages.setting.getAllComplaints.index', compact('page_title', 'user', 'nav', 'complaints'));

    }

    public function getCreatePoints()
    {

        $page_title = "Points";
        $user = auth()->user();
        $nav = 12;
        $this->user->getUserImagePath($user);
        return view('pages.setting.createPoints.index', compact('page_title', 'user', 'nav'));

    }

    public function handleCreatePoints(Request $request)
    {

        $page_title = "Points";
        $user = auth()->user();
        $request->request->add(['store_id' => $user->id]);
        return $this->points->create($request);
        return view('pages.setting.createPoints.index', compact('page_title', 'user', 'nav'));

    }


    public function getCreateComplaintsUs()
    {

        $page_title = "Complaints";
        $user = auth()->user();
        $nav = 9;
        $this->user->getUserImagePath($user);
        return view('pages.setting.createComplaints.index', compact('page_title', 'user', 'nav'));

    }

    public function handelCreateComplaintsUs(Request $request)
    {

        $request['user_id'] = auth()->user()->id;
        $response = $this->complaints->saveComplaint($request);
        if (!$response['status']) {
            return back()->withInput()->withErrors($response['data']['validation_errors']);
        }
        return back()->with('success', __('settings.add_success'));
    }


    public function getAdsControl()
    {

        $page_title = "Ads Control";
        $user = auth()->user();
        $nav = 10;
        $this->user->getUserImagePath($user);
        $ads_controls = AdsControl::all();

        return view('pages.setting.adsControlling.index', compact('page_title', 'user', 'nav', 'ads_controls'));

    }

    public function handleAdsControl(Request $request)
    {
        $ads_controls = (array)$request->ads_controls;

        AdsControl::Where('status', 1)->update(['status' => 0]);

        AdsControl::whereIn('title', $ads_controls)
            ->update(['status' => 1]);

        return back()->with('success', __('settings.edit_success'));
    }


    public function getDefaultSettings()
    {

        $page_title = "Ads Control";
        $user = auth()->user();
        $nav = 11;
        $settings = $this->settings->all()->first();

        if (!$settings) {
            return back()->with('error', 'error');
        }

        return view('pages.setting.updateSettings.index', compact('page_title', 'user', 'nav', 'settings'));

    }

    public function handleDefaultSettings(Request $request)
    {
        $settings = $this->settings->all()->first();

        if (!$settings) {
            return back()->with('error', 'error');
        }

        $settings->update([
            'max_transaction_number' => $request->max_transaction_number
        ]);

        return back()->with('success', __('settings.edit_success'));
    }
}
