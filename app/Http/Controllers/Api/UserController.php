<?php

namespace App\Http\Controllers\Api;


use App\Events\CreateUser;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Controllers\Api\NotificationController;
use App\Modules\User\Steps\StepThree;
use App\Modules\User\Steps\StepTwo;
use App\Modules\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;


    private $userLocation;


    private $userPapers;
    
    
    private $notificationsController;

    public function __construct()
    {

        $this->user = new User();
        $this->userLocation = new StepTwo();
        $this->userPapers = new StepThree();
        $this->notificationsController = new NotificationController();
    }


    public function registerBasicUserInfo(Request $request)
    {

        $validation = $this->validateCreateNewUserBasicInfoRequest($request);
        if ($validation->fails()) {
            return [
                'status' => false,
                'msg' => 'validation errors...',
                'data' => [
                    'validation_errors' => $validation->getMessageBag()->getMessages()
                ]
            ];
        }

        $user = $this->user->create($request->all());

        
        $notification_data = [
            'notifiable_id' => $user->id,
            'admin_role_id' => 1,
            'notifiable_type' => 'App\\Models\\User',
            'title' => 'حساب جديد',
            'title_en' => 'New Account',
            'type' => 'CreateUser',
            'description' => 'تم انشاء حساب المستخدم ' . $user->username,
            'description_en' => 'New Account By User ' . $user->username
        ];
        
        $this->notificationsController->saveNotification($notification_data);

        event(new CreateUser(compact('user')));

        return return_msg(true, 'user created...', compact('user'));
    }

    protected function validateCreateNewUserBasicInfoRequest(Request $request)
    {

        return validator($request->all(), [
            'username' => 'required||min:2|max:20|unique:users,username,NULL,id,deleted_at,NULL',
            'email' => 'nullable|email',
            'firstname' => 'required|min:2|max:50',
            'lastname' => 'required|min:2|max:50',
            'role_id' => 'required|numeric',
            'prefix' => 'required',
            'phone' => 'required|digits_between:8,12|unique:users,phone,NULL,id,deleted_at,NULL',
            'password' => 'required|min:6|max:50|confirmed',
        ]);
    }

    public function registerUserLocation(Request $request)
    {

        $validation = $this->validateCreateNewUserLocationRequest($request);
        if ($validation->fails()) {
            return [
                'status' => false,
                'msg' => 'validation errors...',
                'data' => [
                    'validation_errors' => $validation->getMessageBag()->getMessages()
                ]
            ];
        }
        $address = $this->getLocationLatLng($request->lat , $request->lng);
        $request->request->add(['geo_location'=>$address]);
        $location = $this->userLocation->saveLocation($request->all());

        return return_msg(true, 'location created...', compact('location'));
    }


    // muhammad awd created 20-03-2019
    protected function getLocationLatLng($lat,$lng)
    {
 
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&key=' . env('GOOGLE_MAP_API') . '&sensor=false');
        $output = json_decode($geocode); 
        $formatted_address = '';
        if ($output->status == "OK") {

            $formatted_address = $output->results[0]->formatted_address ?? ''; 
        }
        return $formatted_address;
    }
    
    protected function validateCreateNewUserLocationRequest(Request $request)
    {

        return validator($request->all(), [
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'user_id' => 'required',
        ]);
    }

    public function registerUserPapers(Request $request)
    {

        $validation = $this->validateCreateNewUserPapersRequest($request);
        if ($validation->fails()) {
            return [
                'status' => false,
                'msg' => 'validation errors...',
                'data' => [
                    'validation_errors' => $validation->getMessageBag()->getMessages()
                ]
            ];
        }

        $location = $this->userPapers->savePapers($request->all());

        return return_msg(true, 'papers created...', compact('location'));
    }

    protected function validateCreateNewUserPapersRequest(Request $request)
    {

        return validator($request->all(), [
            // 'trade_license' => 'nullable|image|mimes:jpeg,jpg,png',
            // 'passport' => 'nullable|image|mimes:jpeg,jpg,png',
            // 'pharmacy_license' => 'nullable|image|mimes:jpeg,jpg,png',
            'user_id' => 'required',
        ]);
    }


    public function activateUser($user_id)
    {

        return $this->user->activateUser($user_id);
    }
    public function deactivateUser($user_id, $message = null , $message_en = null)
    {

        return $this->user->deactivateUser($user_id ,$message ,$message_en);
    }


    public function deleteUserAccount($user_id)
    {

        return $this->user->deleteUserAccount($user_id);
    }


    public function savePaymentTypes(Request $request)
    {

        $validation = $this->validateSavePaymentTypesRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation_errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->user->savePaymentTypes($request->all());
    }

    public function validateSavePaymentTypesRequest(Request $request)
    {

        $validation = validator($request->all(), [
            'user_id' => 'required'
        ]);

        return $validation;
    }


    public function getDisActivatedUsers()
    {

        $users = $this->user
            ->all()
            ->where('role_id', '!=', $this->getRoleWhere('admin')->id ?? '')
            ->where('activated', 0)
            ->values()
            ->all();

        return return_msg(true, 'ok', compact('users'));
    }

    public function getActivatedUsers()
    {

        $users = $this->user
            ->all()
            ->where('role_id', '!=', $this->getRoleWhere('admin')->id ?? '')
            ->where('activated', 1)
            ->values()
            ->all();

        return return_msg(true, 'ok', compact('users'));
    }


    public function getAllUsers()
    {

        $users = $this->user
            ->all()
            ->where('role_id', '!=', $this->getRoleWhere('admin')->id ?? '')
            ->values()
            ->all();

        return return_msg(true, 'ok', compact('users'));
    }

    public function getDrugStoreLocations()
    {

        $_users = $this->user
            ->all()
            ->where('role_id', '=', $this->getRoleWhere('drug_store')->id)
            ->where('activated', 1);

        $_users->load(['location']);

        $users = [];

        foreach ($_users as $_user) {

            $location = [];
            if ($_location = $_user->location) {
                $location = [
                    'lat' => $_location->lat,
                    'lng' => $_location->lng,
                ];
            }
            $user = [
                'username' => $_user->username,
                'name' => "{$_user->firstname} {$_user->lastname}",
                'phone' => $_user->prefix . $_user->phone,
            ];

            if (count($location) > 0) {
                $user['lat'] = $location['lat'];
                $user['lng'] = $location['lng'];
            }

            $users[] = $user;
        }

        return return_msg(true, 'ok', compact('users'));
    }


    protected function getRoleWhere($role)
    {

        return Role::whereRole($role)->first();
    }


    public function updateUser(Request $request)
    {

        if (!$request->password) {
            unset($request['password'], $request['password_confirmation']);
        }

        $validation = $this->validateUpdateUserBasicInfoRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        if ($request->password) {
            $request['password'] = bcrypt($request['password']);
        }

        $this->user->update($request->all());

        return return_msg(true, 'ok');
    }


    public function saveUserImage(Request $request)
    {

        $validation = $this->validateSaveUserImageRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $user = $this->user->find($request->user_id);
        if (!$user['status']) {

            return $user;
        }

        $user = $user['data']['user'];
        $this->user->saveUserImage($user, $request->all());

        return return_msg(true, 'ok');
    }

    protected function validateUpdateUserBasicInfoRequest(Request $request)
    {
//dd($request->user_id);
        return validator($request->all(), [
            'email' => 'nullable|email',
            'firstname' => 'required|min:2|max:50',
            'lastname' => 'required|min:2|max:50',
            'prefix' => 'required',
            'phone' => 'required|digits_between:8,12|unique:users,phone,' . $request->user_id . ',id,deleted_at,NULL',
            'password' => 'nullable|min:6|max:50|confirmed',
            'user_id' => 'required'
        ]);
    }


    protected function validateSaveUserImageRequest(Request $request)
    {

        return validator($request->all(), [
            'user_id' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ]);
    }


    public function getPapersByUserId($user_id)
    {

        return $this->user->getPapersByUserId($user_id);
    }
    
    public function getFindUser($user_id)
    {

        return $this->user->find($user_id);
    }


}
