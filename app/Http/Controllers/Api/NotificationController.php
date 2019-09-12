<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Sale;
use Carbon\Carbon;

class NotificationController extends Controller
{

    private $notificationModel;

    private $saleModel;


    public function __construct()
    {
        $this->notificationModel = new Notification;
        $this->saleModel = new Sale;
    }


    public function saveNotification(array $data)
    {

        $notification = $this->notificationModel->create($data);

        return $notification;
    }

    public function makeNotificationRead($notification_id)
    {

        $notification = $this->notificationModel->find($notification_id);
        $notification->update(['read' => 1]);


        return return_msg(true, 'ok', compact('notification'));
    }

    public function deleteNotification($notification_id)
    {

        $notification = $this->notificationModel->find($notification_id);
        $notification->delete();

        return return_msg(true, 'ok');
    }


    public function getNotification($notification_id)
    {

        $notification = $this->notificationModel->find($notification_id);

        return return_msg(true, 'ok', compact('notification'));
    }

    public function getLatestNotifications($role, $user_id, $num_msg = 150)
    {

        switch ($role) {
            case 'admin':
                return $this->getLastNumberOfNotificationsForAdmin($user_id, $num_msg);
                break;
            case 'store':
                return $this->getLastNumberOfNotificationsForStore($user_id, $num_msg);
                break;
            case 'pharmacy':
                return $this->getLastNumberOfNotificationsForUser($user_id, $num_msg);
                break;
            default:
                return $this->getLastNumberOfNotificationsFor_User($user_id, $num_msg);
                break;
        }
    }

    public function getLastNumberOfNotificationsForAdmin($admin_id, $num_msg = 150)
    {

        $notifications = $this->getAdminNotifications($admin_id)['data']['notifications'];

        $notifications = $notifications->take($num_msg);
        $notifications_count = count($notifications->where('read_at_admin',null) ?? []);

        return return_msg(true, 'ok', compact('notifications', 'notifications_count'));
    }

    public function getLastNumberOfNotificationsFor_User($user_id, $num_msg = 150)
    {

        $notifications = $this->get_UserNotifications($user_id)['data']['notifications'];

        $notifications = $notifications->take($num_msg);
        $notifications_count = count($notifications->where('read_at',null) ?? []);

        return return_msg(true, 'ok', compact('notifications', 'notifications_count'));
    }

    public function getAdminNotifications($user_id)
    {

        $notifications = $this->notificationModel
            ->orderBy('created_at', 'desc')
            ->where('type', 'UnApprovedDrugInsertion')
            ->orWhere('type', 'CreateUser')
            ->get();

        $this->getNotificationsOnPeriod($notifications);

        $notifications->map(function ($notification) {

            $notification->url = route('getApproveProductsView');
        });

//        $notifications = $notifications->where('notifiable_id', $user_id);

        return return_msg(true, 'ok', compact('notifications'));
    }

    public function getLastNumberOfNotificationsForStore($store_id, $num_msg = 150)
    {

        $notifications = $this->getStoreNotifications($store_id)['data']['notifications'];

        $notifications = $notifications->take($num_msg);
        $notifications_count = count($notifications->where('read_at',null) ?? []);

        return return_msg(true, 'ok', compact('notifications', 'notifications_count'));
    }

    public function getStoreNotifications($store_id)
    {

        $notifications = $this->notificationModel
            ->orderBy('created_at', 'desc')
            ->where('type', 'RejectDrug')
            ->orWhere('type', 'ApprovedDrug')
            ->orWhere('type', 'ActivateUser')
            ->orWhere('type', 'NewOrder') 
            ->get();

        $this->getNotificationsOnPeriod($notifications);

        $notifications = $notifications->where('notifiable_id', $store_id);

        return return_msg(true, 'ok', compact('notifications'));
    }
    public function get_UserNotifications($user_id)
    {

        $notifications = $this->notificationModel
            ->orderBy('created_at', 'desc')
            ->where('type', 'CreateUser')
            ->orWhere('type', 'ActivateUser')
            ->get();

        $this->getNotificationsOnPeriod($notifications);

        $notifications = $notifications->where('notifiable_id', $user_id);

        return return_msg(true, 'ok', compact('notifications'));
    }

    public function getLastNumberOfNotificationsForUser($pharmacy_id, $num_msg = 5)
    {

        $notifications = $this->getSaleNotificationForPharmacy($pharmacy_id)['data']['notifications'];

        $notifications = $notifications->take($num_msg);
        $notifications_count = count($notifications->where('read_at',null) ?? []);

        return return_msg(true, 'ok', compact('notifications', 'notifications_count'));
    }

    public function getSaleNotificationForPharmacy($pharmacy_id)
    {
        $sale_ids = $this->saleModel->wherePharmacyId($pharmacy_id)->pluck('id');
        
        $notifications = $this->notificationModel
            ->orderBy('created_at', 'desc')
            ->whereIn('notifiable_id', $sale_ids->toArray())
            ->get();
             
         $notifications = $notifications->filter(function($notify){
             if ($notify->type == 'rejectSale' || $notify->type == 'approveSale'){
                 return $notify;
             }
         });
         
        
        $this->getNotificationsOnPeriod($notifications);

        return return_msg(true, 'ok', compact('notifications'));
    }

    protected function getNotificationsOnPeriod(&$notifications)
    {

        $notifications = $notifications->filter(function ($notification) {

            return Carbon::parse($notification->created_at)->diffInMonths(Carbon::now()) <= 1;
        });
    }
        public function updateNotificationReadAt(&$notifications)
    {

        foreach ($notifications as $notification){
            $notification->where('read_at',null)->update([
                'read_at' => Carbon::now()
            ]);
        }

    }
    public function updateNotificationReadAtAdmin(&$notifications)
    {
        foreach ($notifications as $notification){
            $notification->where('read_at_admin',null)->update([
                'read_at_admin' => Carbon::now()
            ]);
        }

    }

}
