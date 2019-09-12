<?php

namespace App\Providers;

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\DrugController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {

            if (auth()->user()) {

                $response = (new ChatController)->getLastNumberOfMessagesForUser(auth()->user()->id);

                $role = auth()->user()->role->title;


                $response2 = (new NotificationController())->getLatestNotifications($role, auth()->user()->id);

                if ($response['status']) {
                    $view->with('message_list', $response['data']['messages']);
                    $view->with('messgaes_count', $response['data']['messgaes_count']);
                } else {
                    $view->with('message_list', []);
                    $view->with('messgaes_count', 0);
                }
                if ($response2['status']) {
                    $view->with('notification_list', $response2['data']['notifications']);
                    $view->with('notifications_count', $response2['data']['notifications_count']);
                } else {
                    $view->with('notification_list', []);
                    $view->with('notifications_count', 0);
                }


                $request = ['store_id' => auth()->user()->id];
                $favourites = (new DrugController())->getStoreFavourites($request) ?? [];
                $view->with('favourites_item_count', count($favourites));

            }

            $view->with('basket_item_count', count(session()->get('cart_storage') ?? []));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->registerPolicies();
    }

    public function registerPolicies()
    {

        // public permissions
        Gate::define('create-post', function ($user) {
            return $this->checkActive($user);
        });

        Gate::define('create-comment', function ($user) {
            return $this->checkActive($user);
        });
        
        Gate::define('create-chat', function ($user) {
           return $this->checkActive($user);
        });
        
        
        
        // pharmacy permissions
        Gate::define('create-pharmacy-order', function ($user) {
           return $this->checkActive($user);
        });
        
        Gate::define('show-pharmacy-orders', function ($user) {
           return $this->checkActive($user);
        });
        
        Gate::define('get-jobs', function ($user) {
           return $this->checkActive($user);
        });
        
        Gate::define('get-offers', function ($user) {
           return $this->checkActive($user);
        });
        
        
        
        // store permissions
        Gate::define('add-favourites', function ($user) {
           return $this->checkActive($user);
        });
        
        Gate::define('add-product', function ($user) {
           return $this->checkActive($user);
        });
         
        Gate::define('get-sales', function ($user) {
           return $this->checkActive($user);
        });
        
        
    }
    
    
    public function checkActive($user){
        if($user->activated == '1'){
            return true;
        }
        return false;
    }
}
