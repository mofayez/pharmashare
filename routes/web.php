<?php

/**
 * front routes
 */
Route::group([
//    'middleware' => ['LanguageMiddleware', 'HttpsProtocol'],
    'middleware' => ['LanguageMiddleware'],
    'prefix' => '',
    'namespace' => 'Web'
], function () {

    Route::get('/', 'FrontController@getIndexView')->name('getIndexView');
    Route::get('/contact-us', 'FrontController@getContactView')->name('getContactView');
    Route::post('/contact-us', 'FrontController@handleContactUs')->name('handleContactUs');
    Route::get('/find-job', 'FrontController@getJobsView')->name('getJobsView');
    Route::get('/find-pharmacy', 'FrontController@getPharamcyView')->name('getPharamcyView');

    Route::get('/ar', 'UtilityController@setAr')->name('setAr');
    Route::get('/en', 'UtilityController@setEn')->name('setEn');
});

/**
 * app routes
 */
Route::group([
//    'middleware' => ['LanguageMiddleware', 'HttpsProtocol'],
    'middleware' => ['LanguageMiddleware'],
    'prefix' => 'store',
    'namespace' => 'Web'
], function () {

    Route::get('/login', 'AuthController@getLogin')->name('getLoginView');
    Route::get('/resetPassword', 'AuthController@resetPassword')->name('resetPassword');
    Route::post('/resetPassword', 'AuthController@handleresetPassword')->name('handleresetPassword');

    Route::get('/facebookActivation', 'AuthController@facebookActivation')->name('FbActivation');
    Route::get('/changePassword', 'AuthController@changePassword')->name('changePassword');
    Route::post('/handleChangePassword', 'AuthController@handleChangePassword')->name('handleChangePassword');

    Route::post('/login', 'AuthController@handleLogin')->name('handleLogin');
    Route::get('/handleLogout', 'AuthController@handleLogout')->name('handleLogout');

    Route::get('/register', 'AuthController@getRegister')->name('getRegisterView');
    Route::post('/register', 'AuthController@handleRegister')->name('handleRegister');


    /**
     * register auth step 2 , 3
     */
    Route::group([
        'middleware' => ['userAuth'],
    ], function () {
        Route::get('/register2/{id?}', 'AuthController@getRegister2')->name('getRegisterView2');
        Route::post('/register2/{id}', 'AuthController@handelRegister2')->name('postRegister2');
        Route::get('/register3/{id}', 'AuthController@getRegister3')->name('getRegisterView3');
        Route::post('/register3/{id}', 'AuthController@handelRegister3')->name('postRegister3');

    });

    /**
     * feed back
     */
    Route::group([
        'middleware' => ['userAuth'],
        'prefix' => 'feeds',
        'namespace' => 'Blog'
    ], function () {
        Route::get('/', 'PostController@getGroupPosts')->name('getGroupPosts');
        Route::post('/addNewGroupPosts', 'PostController@addNewGroupPosts')->name('addNewGroupPosts');
        Route::get('/getPostTemplateAjax', 'PostController@getPostTemplateAjax')->name('getPostTemplateAjax');
        Route::get('/getPostJsonAjax', 'PostController@getPostJsonAjax')->name('getPostJsonAjax');
        Route::get('/getUserMentions', 'PostController@getUserMentions')->name('getUserMentions');
        Route::post('/deletePost', 'PostController@deletePost')->name('deletePost');

        Route::post('/addPostLike', 'ReactionController@addPostLike')->name('addPostLike');
        Route::get('/getPostReactions', 'ReactionController@getPostReactions')->name('getPostReactions');

        Route::post('/addPostComment', 'CommentController@addPostComment')->name('addPostComment');
        Route::post('/deleteComment', 'CommentController@deleteComment')->name('deleteComment');


    });

    /**
     * chatting
     */
    Route::group([
        'middleware' => ['userAuth'],
        'prefix' => 'messages',
        'namespace' => 'Chat'
    ], function () {
        Route::get('/', 'ChatController@index')->name('getChatView')->middleware('can:create-chat');
        Route::post('/postSendMessage', 'ChatController@postSendMessage')->name('chatPostSendMessage');
        Route::get('/getChatMessages', 'ChatController@getChatMessages')->name('getChatMessages');
    });


    /**
     * AdminRole
     */
    Route::group([
        'middleware' => ['userAuth', 'AdminRole'],
        'prefix' => 'admin',
    ], function () {

        /**
         * admin routes
         */

        Route::group([
            'namespace' => 'Admin'
        ], function () {

            Route::get('/all-product', 'AdminController@getAdminAllProductView')->name('getAdminAllProductView');
            Route::get('/add-product', 'AdminController@getAdminAddProductView')->name('getAdminAddProductView');
            Route::delete('/delete-product', 'AdminController@deleteAdminProduct')->name('deleteAdminProduct');
            Route::get('/edit-product/{id}', 'AdminController@getAdminEditProductView')->name('getAdminEditProductView');
            Route::post('/update-product/{id}', 'AdminController@EditAdminPostNewProduct')->name('EditAdminPostNewProduct');

            Route::post('/add-product', 'AdminController@addAdminPostNewProduct')->name('addAdminPostNewProduct');
            Route::post('/add-products-sheet', 'AdminController@addAdminPostProductSheet')->name('addAdminPostProductSheet');
            Route::get('/approve-products', 'AdminController@getApproveProducts')->name('getApproveProductsView');
            Route::post('/approve-product', 'AdminController@approveDrug')->name('postApproveDrug');
            Route::post('/reject-product', 'AdminController@rejectDrug')->name('postRejectDrug');
            Route::get('/user-accounts', 'AdminController@getUsersAccounts')->name('getUsersAccounts');
            Route::get('/user-getStoreRates', 'AdminController@getStoreRates')->name('getStoreRates');
            Route::post('/activate-accounts', 'AdminController@activateAccount')->name('activateAccount');
            Route::post('/deactivate-accounts', 'AdminController@deactivateUser')->name('deactivateUser');
            Route::delete('/remove-accounts', 'AdminController@RemoveAccount')->name('RemoveAccount');

            Route::get('/approve-posts', 'AdminController@getApprovePosts')->name('getApprovePosts');
            Route::post('/approve-posts', 'AdminController@handleApprovePosts')->name('handleApprovePosts');

            Route::get('/get-all-sales', 'AdminController@getSalesView')->name('getAdminSalesView');
        });

        /**
         * front cms side
         */
        Route::group([
            'namespace' => 'Admin'
        ], function () {

//            Route::get('createContact','FrontController@createContact')->name('createContact');

//            Route::get('getAllSliders','FrontController@getAllSliders')->name('getAllSliders');
//            Route::get('createSlider','FrontController@createSlider')->name('createSlider');
//            Route::get('getStatistics','FrontController@getStatistics')->name('getStatistics');
//            Route::get('getFindSlide/{id}','FrontController@getFindSlide')->name('getFindSlide');
//            Route::get('getDeleteSlide/{id}','FrontController@getDeleteSlide')->name('getDeleteSlide');
        });


    });

    /**
     * StoreRole
     */
    Route::group([
        'middleware' => ['userAuth', 'StoreRole'],
        'prefix' => 'drug_store',
        'namespace' => 'Profile'
    ], function () {

        Route::get('/getAllCategories', 'ProfileController@getAllCategories')->name('getAllCategories');
        Route::get('/getAllBarcode', 'ProfileController@getAllBarcode')->name('getAllBarcode');
        Route::get('/getDrugNames', 'ProfileController@getDrugsData')->name('getStoreAutoCompleteDrugs');
        Route::get('/getDrug-FromModel', 'ProfileController@getDrugsFromModel')->name('getDrugsFromModel');
        Route::get('/add-favourites', 'ProfileController@getAddToFavouritesView')->name('getAddToFavouritesView')->middleware('can:add-favourites');
        Route::post('/add-item-favourites', 'ProfileController@addToFavourite')->name('addToFavourite');
        Route::get('/show-favourites', 'ProfileController@getShowFavouritesView')->name('getShowFavouritesView');
        Route::post('/submit-favourites', 'ProfileController@submitFavourite')->name('submitFavourite');
        Route::delete('/delete-favourites', 'ProfileController@deleteFavourite')->name('deleteFavourite');

        Route::get('/add-product', 'ProfileController@getAddProductView')->name('getAddProductView')->middleware('can:add-product');
        Route::post('/add-product', 'ProfileController@addPostNewProduct')->name('addPostNewProduct');
        Route::post('/add-products-sheet', 'ProfileController@addPostProductSheet')->name('addPostProductSheet');

        Route::get('/all-product', 'ProfileController@getAllProductsView')->name('getAllProductsView');
        Route::get('/edit-store/{id}', 'ProfileController@getEditStoreView')->name('getEditStoreView');
        Route::post('/edit-store/{id}', 'ProfileController@postEditDrugStore')->name('postEditDrugStore');
        Route::delete('/delete-store', 'ProfileController@deleteDrugStore')->name('deleteDrugStore');

        Route::get('/sales', 'ProfileController@getSalesView')->name('getSalesView')->middleware('can:get-sales');
        Route::post('ApproveOrder', 'ProfileController@ApproveOrder')->name('ApproveOrder');
        Route::post('RejectOrder', 'ProfileController@RejectOrder')->name('RejectOrder');
        Route::post('blockPharmacy', 'ProfileController@blockPharmacy')->name('blockPharmacy');

    });

    /**
     * PharmacyRole
     */
    Route::group([
        'middleware' => ['userAuth', 'PharmacyRole'],
        'prefix' => 'pharmacy',
    ], function () {

        Route::group([
            'namespace' => 'Profile'
        ], function () {
            Route::get('/my-orders', 'ProfileController@getBoughtsView')->name('getBoughtsView')->middleware('can:show-pharmacy-orders');
            Route::get('/findmap-drugStore', 'ProfileController@drugStoreMapView')->name('drugStoreMapView');
            Route::post('/blockStore', 'ProfileController@blockStore')->name('blockStore');
            Route::post('/RateStore', 'ProfileController@RateStore')->name('RateStore');

        });

        Route::group([
            'middleware' => ['ActivatedUser'],
            'namespace' => 'Store'
        ], function () {
            Route::get('/', 'IndexController@index')->name('getProductsView')->middleware('can:create-pharmacy-order');
            Route::get('/getDrugNames', 'IndexController@getDrugsData')->name('getAutoCompleteDrugs');
            Route::get('/getDrugNames-filtered', 'IndexController@getDrugsWithFilterData')->name('getDrugsWithFilterData');
            Route::get('/cart', 'ShoppingController@viewCart')->name('getCartView');
            Route::post('/addToCart', 'ShoppingController@addToCart')->name('addToCart');
            Route::post('/submitCart', 'ShoppingController@submitCart')->name('submitCart');
            Route::post('/emptyCart', 'ShoppingController@emptyCart')->name('emptyCart');
            Route::post('/removeCartItem', 'ShoppingController@removeCartItem')->name('removeCartItem');
            Route::get('/shipping', 'ShoppingController@viewShipping')->name('getShippingView');
            Route::post('/submitPayment', 'ShoppingController@submitPayment')->name('submitPayment');
            Route::get('/checkout', 'ShoppingController@viewCheckout')->name('getCheckoutView');
            Route::post('/submitCheckout', 'ShoppingController@submitCheckout')->name('submitCheckout');

        });

    });

    /**
     * public auth
     */
    Route::group([
        'middleware' => ['userAuth']
    ], function () {

        Route::group([
            'namespace' => 'Offers'
        ], function () {
            Route::get('/getAddImageOffers', 'OfferController@getAddImageOffersView')->name('getAddImageOffersView');
            Route::get('/getAddDrugsOffers', 'OfferController@getAddDrugsOffersView')->name('getAddDrugsOffersView');
            Route::get('/getAllUserOffers', 'OfferController@getAllUserOffersView')->name('getAllUserOffersView')->middleware('can:get-offers');

            Route::get('/addOfferImagePackages', 'OfferController@getAddOfferImagePackagesView')->name('getAddOfferImagePackagesView');
            Route::get('/editOfferImagePackages/{id}', 'OfferController@getEditOfferImagePackagesView')->name('getEditOfferImagePackagesView');

            Route::get('/addOfferPackages', 'OfferController@getAddOfferPackagesView')->name('getAddOfferPackagesView');
            Route::get('/editOfferPackages/{id}', 'OfferController@getEditOfferPackagesView')->name('getEditOfferPackagesView');
            Route::get('/offerPackages', 'OfferController@getOfferPackagesView')->name('getOfferPackagesView');

            Route::get('/viewFeatureAds/{id}', 'OfferController@getViewFeatureAdsView')->name('getViewFeatureAdsView');
            Route::get('/viewImageAdsView/{id}', 'OfferController@getViewImageAdsView')->name('getViewImageAdsView');

            Route::get('/getApproveOffers', 'OfferController@getApproveOffersView')->name('getApproveOffersView');

            Route::post('/uploadImagesAds', 'OfferController@uploadImagesAds')->name('uploadImagesAds');
            Route::post('/uploadUpdateImagesAds', 'OfferController@uploadUpdateImagesAds')->name('uploadUpdateImagesAds');
            Route::post('/addDrugsItemsAds', 'OfferController@addDrugsItemsAds')->name('addDrugsItemsAds');
            Route::post('/updateDrugsItemsAds/{id}', 'OfferController@updateDrugsItemsAds')->name('updateDrugsItemsAds');
            Route::post('/addAdsPackages', 'OfferController@addAdsPackages')->name('addAdsPackages');
            Route::post('/addAdsImagePackages', 'OfferController@addAdsImagePackages')->name('addAdsImagePackages');
            Route::post('/updateAdsPackages/{id}', 'OfferController@updateAdsPackages')->name('updateAdsPackages');
            Route::post('/updateAdsImagePackages/{id}', 'OfferController@updateAdsImagePackages')->name('updateAdsImagePackages');
            Route::post('/ShowOrHide', 'OfferController@ShowOrHide')->name('ShowOrHide');
            Route::delete('/deleteAdsPackage', 'OfferController@deleteAdsPackage')->name('deleteAdsPackage');
            Route::delete('/deleteAdsImagePackage', 'OfferController@deleteAdsImagePackage')->name('deleteAdsImagePackage');
            Route::post('/approveAds', 'OfferController@approveAds')->name('approveAds');
            Route::post('/rejectAds', 'OfferController@rejectAds')->name('rejectAds');

        });

        Route::group([
            'namespace' => 'Profile'
        ], function () {
            Route::get('/sales-report', 'ProfileController@getSalesReportView')->name('getSalesReportView');
            Route::get('/profile/{username}/{id}', 'ProfileController@getUserProfileView')->name('getUserProfileView');
            Route::get('/getOrderItems', 'ProfileController@getOrderItems')->name('getOrderItems');

        });

        Route::group([
            'prefix' => 'jobs',
            'namespace' => 'Job'
        ], function () {
            Route::get('/', 'JobController@index')->name('getPostJobsView')->middleware('can:get-jobs');
            Route::get('/searchJobs', 'JobController@searchJobs')->name('getSearchJobsView');
            Route::get('/all', 'JobController@getAllJobs')->name('getAllJob');
            Route::get('/edit/{id}', 'JobController@getEditJob')->name('getEditJob');
            Route::post('/edit/{id}', 'JobController@handleUpdateJob')->name('handleUpdateJob');
            Route::delete('/deleteJob', 'JobController@deleteJob')->name('deleteJob');
            Route::post('/post-job', 'JobController@handlePostJob')->name('handlePostJob');

        });

        Route::group([
            'prefix' => 'setting',
            'namespace' => 'Profile'
        ], function () {

            Route::get('/edit-license', 'SettingController@getEditLicensesView')->name('getEditLicensesView');
            Route::get('/edit-default-settings', 'SettingController@getDefaultSettings')->name('getDefaultSettings');
            Route::post('/edit-default-settings', 'SettingController@handleDefaultSettings')->name('handleDefaultSettings');
            Route::post('/postEditLicenses', 'SettingController@postEditLicenses')->name('postEditLicenses');
            Route::post('/postEditLocations', 'SettingController@postEditLocations')->name('postEditLocations');

            Route::get('/profile-edit', 'SettingController@getProfileSettingView')->name('getProfileSettingView');
            Route::post('/updateProfileImage', 'SettingController@updateProfileImage')->name('updateProfileImage');
            Route::post('/updateProfileInfo', 'SettingController@updateProfileInfo')->name('updateProfileInfo');
            Route::get('/set-payments', 'SettingController@getPaymentsSettingView')->name('getPaymentsSettingView');
            Route::post('/set-payments', 'SettingController@setPaymentTypes')->name('setPaymentTypes');
            Route::post('/set-order-pricing', 'SettingController@setMinOrderPricing')->name('setMinOrderPricing');
            Route::get('/notifications', 'SettingController@getNotificationsSettingView')->name('getNotificationsSettingView');

            Route::get('/pharmacy-blacklist', 'SettingController@getPharmacyBlacklist')->name('getPharmacyBlacklist');
            Route::post('/unblockStore', 'SettingController@unblockStore')->name('unblockStore');
            Route::get('/store-blacklist', 'SettingController@getStoreBlacklist')->name('getStoreBlacklist');
            Route::post('/unblockPharmacy', 'SettingController@unblockPharmacy')->name('unblockPharmacy');

            Route::get('/getCreateComplaintsUs', 'SettingController@getCreateComplaintsUs')->name('getCreateComplaintsUs');
            Route::post('/handelCreateComplaintsUs', 'SettingController@handelCreateComplaintsUs')->name('handelCreateComplaintsUs');

            Route::get('/getAdsControl', 'SettingController@getAdsControl')->name('getAdsControl');
            Route::post('/handleAdsControl', 'SettingController@handleAdsControl')->name('handleAdsControl');
            Route::get('/getComplaintsUs', 'SettingController@getComplaintsUs')->name('getComplaintsUs');
            Route::get('/getContactUs', 'SettingController@getContactUs')->name('getContactUs');
            Route::post('/deleteContactUs', 'SettingController@deleteContactUs')->name('deleteContactUs');
            Route::get('/getHeaderSite', 'SettingController@getHeaderSite')->name('getHeaderSite');
            Route::post('/getHeaderSite', 'SettingController@handleHeaderSite')->name('getHandleHeaderSite');
            Route::post('/handleServiceSite', 'SettingController@handleServiceSite')->name('handleServiceSite');
            Route::post('/handlePriceSite', 'SettingController@handlePriceSite')->name('handlePriceSite');
            Route::post('/handleTestimonialSite', 'SettingController@handleTestimonialSite')->name('handleTestimonialSite');
            Route::post('/handleFaqSite', 'SettingController@handleFaqSite')->name('handleFaqSite');
            Route::post('/handleTranslation', 'SettingController@handleTranslation')->name('handleTranslation');
            Route::post('/handleHeaderUpdateImage', 'SettingController@handleHeaderUpdateImage')->name('handleHeaderUpdateImage');
        });
    });

});
 

















