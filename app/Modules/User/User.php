<?php

namespace App\Modules\User;

use App\Events\ActivateUser;
use App\Models\PaymentType;
use App\Http\Controllers\Api\NotificationController;
use App\Models\User as UserModel;
use App\Models\StorePaymentTypes as StorePaymentTypesModel;
use App\Support\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class User
{


    /**
     * @var UserModel $user
     */
    private $user;
    private $storePaymentModel;


    /**
     * @var Repository $globalRepository
     */
    private $globalRepository;


    /**
     * @var string $userStoragePath
     */
    private $userStoragePath;


    /**
     * @var PaymentType
     */
    private $payemntType;
    
    
    /**
    * @var NotificationController
    */
    private $notificationsController;

    /**
     * User constructor.
     */
    public function __construct()
    {

        $this->user = new UserModel;
        $this->globalRepository = new Repository();
        $this->userStoragePath =  'https://s3.amazonaws.com/pharmashare-files/'; //storage_path('files/users');
        $this->getUsersStoragePath = 'https://s3.amazonaws.com/pharmashare-files/'; //asset('storage/files/users') . '/';
        $this->payemntType = new PaymentType;
        $this->notificationsController = new NotificationController();
        $this->storePaymentModel = new StorePaymentTypesModel;
    }


    /**
     * add new user to database...
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function create(array $data)
    {

        $data['password'] = bcrypt($data['password']);

        $user = $this->globalRepository->create($this->user, $data);
        
        $this->storePaymentModel->forceCreate([
                'user_id'=>$user->id,
                'payment_type_id'=>1,
            ]);
        
        // save image
        if (isset($data['file']) && $data['file']) {

            $file = $data['file'];
//            $file_name = time() . '.' . $file->extension();

            $file_name = $this->uploadFileToS3($file);
            $file_data = [
                'path' => $file_name,
            ];
//            $file->move($this->userStoragePath, $file_name);

            $this->globalRepository->applyRelation(
                $user,
                'file',
                'create',
                $file_data
            );
        }


        return $user;
    }


    /**
     * search for user by id...
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id)
    {
        // $user = $this->globalRepository->find($this->user, $id);
        
        $user = $this->user->with([
            'location'
            ])->find($id);

        if (!$user) {

            return return_msg(false, 'not found...', []);
        }

        if ($file = $user->image) {

            $this->getUserImagePath($user);
        }

        return return_msg(true, 'user...', compact('user'));
    }


    public function findUserByUsername(string $username)
    {

        $user = $this->globalRepository->findSingleWhere($this->user, [
            ['username' => $username]
        ]);

        if (!$user) {

            return return_msg(false, 'not found...', []);
        }

        if ($file = $user->file) {

            $this->getUserImagePath($user);
        }

        return return_msg(true, 'user...', compact('user'));
    }


    /**
     * update user...
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update(array $data)
    {

        $user = $this->find($data['user_id']);

        if (!$user['status']) {

            return null;
        }

        $user = $user['data']['user'];
        unset($user->image_path);
        $user = $this->globalRepository->update($user, $data);

        return $user;
    } // end of function


    /**
     * assign image to user
     *
     * @param $user
     * @param array $data
     * @return bool
     */
    public function saveUserImage($user, array $data)
    {

        if (isset($data['file']) && $data['file']) {

            // save image
            Storage::disk('s3')->delete($user->file->name ?? null);
//            @unlink($this->userStoragePath . $user->file->name);
            $this->globalRepository->applyRelation(
                $user,
                'image',
                'delete'
            );

            $file = $data['file'];
//            $file_name = time() . '.' . $file->extension();

            $file_name = $this->uploadFileToS3($file);

            $file_data = [
                'name' => $file_name,
            ];

//            $file->move($this->userStoragePath, $file_name);

            $this->globalRepository->applyRelation(
                $user,
                'image',
                'create',
                $file_data
            );
        }

        return true;
    }


    /**
     * delete user...
     *
     * @param int $user_id
     * @return bool|null|string
     */
    public function delete(int $user_id)
    {
        $user = $this->find($user_id);

        if (!$user) {

            return null;
        }

        unset($user->file);

        try {

            return $this->globalRepository->delete($user);
        } catch (\Exception $exception) {

            return $exception->getMessage();
        }
    }


    /**
     * get all users...
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function all()
    {

        $users = $this->globalRepository->all($this->user);
        $users->load(['role', 'papers']);

        foreach ($users as $user) {

            $this->getUserImagePath($user);
        } // end foreach

        return $users;
    }


    /**
     * get data of the user who created something (Post, Comment, Like)...
     * @param Model $model
     */
    public function getRelatedUserImagePath(Model &$model)
    {
        $model->user;
        $user_image = $model->user->image ?? null;
        if ($user_image){
          $model->user->image_path = $user_image ? $this->getUsersStoragePath . $user_image->name : null;
            unset($model->user->image);
        }
    }


    /**
     * get user's image full path...
     *
     * @param Model $user
     */
    public function getUserImagePath(Model &$user)
    {


        $user->image_path = $user->image ? $this->getUsersStoragePath . $user->image->name : null;
        unset($user->image);
    }


    public function activateUser($user_id)
    {

        $user = $this->user->find($user_id);

        if (!$user) {

            return return_msg(false, 'NotFound');
        }

        $user->activated = 1;
        $user->save();
        
        // Make All User Drugs Activated
        $this->activateUserDrugStore($user);
        
        $notification_data = [
            'notifiable_id' => $user->id,
            'admin_role_id' => 1,
            'notifiable_type' => 'App\\Models\\User',
            'title' => 'تنشيط حساب',
            'title_en' => 'Activate Account',
            'type' => 'ActivateUser',
            'description' => 'تم تنشيط حساب المستخدم ' . $user->username,
            'description_en' => 'User Account Activated' . $user->username
        ];
        
        $this->notificationsController->saveNotification($notification_data);
        
        if($user->email){ 
            send_email([
                'to'=> $user->email,
                'content'=>  __('auth.activate_msg'),
                'template'=>'mails.activate_mail',
                ]);
        }
        
        event(new ActivateUser($user->toArray()));

        return return_msg(true, 'ok');
    }
    
    public function activateUserDrugStore($user)
    {
        $user->drug_store()->update([
            'is_activate' => 1
            ]);
        
    }
    public function deActivateUserDrugStore($user)
    {
        $user->drug_store()->update([
            'is_activate' => 0
            ]);
        
    }

    public function deactivateUser($user_id, $message = null,$message_en = null)
    {

        $user = $this->user->find($user_id);

        if (!$user) {

            return return_msg(false, 'NotFound');
        }

        $user->activated = 0;
        $user->hint_ar = $message;
        $user->hint_en = $message_en;
        $user->save();
        
        // Make All User Drugs Un Activated
        $this->deActivateUserDrugStore($user);
        
        $notification_data = [
            'notifiable_id' => $user->id,
            'admin_role_id' => 1,
            'notifiable_type' => 'App\\Models\\User',
            'title' => 'تعطيل حساب',
            'title_en' => 'Activate Account',
            'type' => 'ActivateUser',
            'description' => 'تم تعطيل حساب المستخدم ' . $message . $user->username,
            'description_en' => 'User Account Deactivated' . $message_en . $user->username
        ];
        
        $this->notificationsController->saveNotification($notification_data);
        
        event(new ActivateUser($user->toArray()));

        return return_msg(true, 'ok');
    }


    public function deleteUserAccount($user_id)
    {
        $user = $this->user->find($user_id);

        if (!$user) {

            return return_msg(false, 'NotFound');
        }

        $user->delete();

        return return_msg(true, 'ok');
    }


    public function savePaymentTypes(array $data)
    {

        $user_id = $data['user_id'];
        $user = $this->user->find($user_id);
        if (!$user) {

            return return_msg(false, 'NotFound', 'validation_errors', [
                'validation_errors' => []
            ]);
        }

        $payment_types_ids = $data['payment_types_ids'] ?? [];

        $user->paymentTypes()->sync($payment_types_ids);

        return return_msg(true, 'ok');
    }

    public function findUserByPhone($phone)
    {

        $user = $this->user->wherePhone($phone)->first();

        if (!$user) {
            return return_msg(false, 'NotFound');
        }

        return return_msg(true, 'ok', compact('user'));
    }


    public function getPapersByUserId($user_id)
    {

        $user = $this->user->with(['papers'])->find($user_id);

        if (!$user) {
            return return_msg(false, 'NotFound');
        }

        return return_msg(true, 'ok', compact('user'));
    }


    public function updatePassword($user_id, $password)
    {

        $user = $this->user->find($user_id);

        if (!$user) {
            return return_msg(false, 'NotFound');
        }

        $password = bcrypt($password);
        $user->update(['password' => $password]);

        return return_msg(true, 'ok', compact('user'));
    }


    public function uploadFileToS3($file_name)
    {

        $file_name = $file_name->store(
            'user',
            's3'
        );
        return $file_name;
//
//        $s3 = Storage::disk('s3');
//        $filePath = '/imgs/' . $file_name;
//        $s3->put($filePath, file_get_contents($file_name), 'public');
    }

}