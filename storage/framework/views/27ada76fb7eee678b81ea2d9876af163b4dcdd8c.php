<style>
    @media  screen and (max-width: 991px) {
        .navbar .navbar-nav {
            margin-top: 0;
        }
    }

    .bootstrap-switch {
        position: relative;
        top: 5px;
    }

    .languages div {
        display: inline-block;
        padding: 3px 10px;
        margin: 0;
        text-transform: uppercase;
    }

    .languages div.active {
        border: 1px solid;
        background: #6237bd;
        color: #FFF;
    }

    .languages div.active a {

        color: #FFF !important;
    }
</style>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent direction" color-on-scroll="100">
    <div class="container">

        <div class="navbar-translate">
            
        </div>

        <ul class="navbar-nav ml-auto d-md-flex d-lg-flex  direction">

            <li class="nav-item d-lg-block d-none">
                <a href="<?php echo e(route('getGroupPosts')); ?>" class="nav-link btn btn-main btn-round text-white">
                    <p><?php echo e(__('profile.feeds')); ?></p>
                </a>
            </li>

            <?php if(auth()->user()->role_id == 1): ?>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getAdminAddProductView')); ?>">
                        <!--<i class="now-ui-icons fas fa-prescription-bottle"></i>-->
                        <p><?php echo e(__('profile.add_drug')); ?>  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getApproveProductsView')); ?>">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                        <p><?php echo e(__('profile.approve_drugs')); ?>  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getApprovePosts')); ?>">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                        <p><?php echo e(__('profile.approve_posts')); ?>  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getUsersAccounts')); ?>">
                        <!--<i class="now-ui-icons users_single-02"></i>-->
                        <p><?php echo e(__('profile.users')); ?>  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getAdminSalesView')); ?>">
                        <!--<i class="now-ui-icons users_single-02"></i>-->
                        <p><?php echo e(app()->getLocale() == 'ar' ? 'الطلبات' : 'Sales Orders'); ?>  </p>
                    </a>
                </li>

            <?php endif; ?>

            <?php if(auth()->user()->role_id == 2): ?>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link"  href="<?php echo e(route('getAddToFavouritesView')); ?>">
                        <!--<i class="now-ui-icons shopping_tag-content"></i>-->
                        <p>   <?php echo e(__('profile.add_drug_store')); ?>  </p>
                    </a>
                </li>
                <!--<li class="nav-item  d-none d-lg-block">-->
                <!--    <a class="nav-link"  href="<?php echo e(route('getShowFavouritesView')); ?>">-->
                        <!--<i class="now-ui-icons shopping_tag-content"></i>-->
                <!--        <p>   <?php echo e(__('profile.show_favorite_link')); ?>  </p>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link"  href="<?php echo e(route('getAllProductsView')); ?>">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                        <p><?php echo e(__('profile.store')); ?> </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link"  href="<?php echo e(route('getSalesView')); ?>">
                        <!--<i class="now-ui-icons users_single-02"></i>-->
                        <p><?php echo e(__('profile.customers')); ?> </p>
                    </a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->role_id == 3): ?>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getProductsView')); ?>">
                        <!--<i class="now-ui-icons shopping_cart-simple"></i>-->
                        <p>   <?php echo e(__('profile.shop_now')); ?></p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getBoughtsView')); ?>">
                        <!--<i class="now-ui-icons users_circle-08"></i>-->
                        <p> <?php echo e(__('profile.orders')); ?> </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('drugStoreMapView')); ?>">
                        <!--<i class="now-ui-icons location_pin"></i>-->
                        <p> <?php echo e(__('profile.map')); ?> </p>
                    </a>
                </li>
            <?php endif; ?>

            <li class="nav-item  d-none d-lg-block">
                <a class="nav-link" href="<?php echo e(route('getPostJobsView')); ?>">
                    <!--<i class="now-ui-icons business_badge"></i>-->
                    <p> <?php echo e(__('profile.jobs')); ?> </p>
                </a>
            </li>


            <?php if(auth()->user()->role_id == 1): ?>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getApproveOffersView')); ?>">
                        <!--<i class="now-ui-icons clothes_tie-bow"></i>-->
                        <p> <?php echo e(__('profile.offers')); ?> </p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->role_id == 2): ?>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getAllUserOffersView')); ?>">
                        <!--<i class="now-ui-icons clothes_tie-bow"></i>-->
                        <p> <?php echo e(__('profile.offers')); ?> </p>
                    </a>
                </li>
            <?php endif; ?>
            <?php if(auth()->user()->role_id == 3): ?>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="<?php echo e(route('getAllUserOffersView')); ?>">
                        <!--<i class="now-ui-icons clothes_tie-bow"></i>-->
                        <p> <?php echo e(__('profile.offers')); ?> </p>
                    </a>
                </li>
            <?php endif; ?>


            <li class="nav-item text-center   pt-1">
                <div class="col-md-12 text-right">
                    <div class="languages">
                        <?php if(auth()->user()->role_id == 3): ?>
                            <div class="dropdown  p-0">
                                <a href="<?php echo e(route('getCartView')); ?>" class="nav-link btn-round" class="dropdown-toggle" >
                                    <div id="cart-count" class="chat-count p-0"><?php echo e($basket_item_count); ?></div>
                                    <i class="now-ui-icons shopping_basket"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 2): ?>
                            <!--<div class="dropdown  p-0">-->
                            <!--    <a href="<?php echo e(route('getShowFavouritesView')); ?>" class="nav-link btn-round" class="dropdown-toggle">-->
                            <!--        <div class="chat-count p-0"><?php echo e($favourites_item_count); ?></div>-->
                            <!--        <i class="now-ui-icons shopping_box"></i>-->
                            <!--    </a>-->
                            <!--</div>-->
                        <?php endif; ?>

                        <div class="dropdown d-md-inline-block d-lg-none p-0">
                            <a href="<?php echo e(route('getChatView')); ?>" class="nav-link btn-round" class="dropdown-toggle">
                                <div class="chat-count p-0"><?php echo e($messgaes_count); ?></div>
                                <i class="now-ui-icons ui-2_chat-round"></i>
                            </a>
                        </div>

                        <div class="dropdown d-md-inline-block d-lg-none p-0">
                            <a href="<?php echo e(route('getNotificationsSettingView')); ?>" class="nav-link btn-round" class="dropdown-toggle">
                                <div class="chat-count p-0"><?php echo e($notifications_count); ?></div>
                                <i class="now-ui-icons ui-1_bell-53"></i>
                            </a>
                        </div>

                        <div class="dropdown d-md-inline-block d-lg-none p-0">
                            <a href="<?php echo e(route('handleLogout')); ?>" class="nav-link btn-round" class="dropdown-toggle">
                                <i class="fas fa-sign-out-alt" style="font-size: 18px"></i>
                            </a>
                        </div>

                        <div class="dropdown d-lg-inline-block d-none p-0">
                            <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="notification"
                               data-toggle="dropdown">
                                <div class="chat-count p-0"><?php echo e($notifications_count); ?></div>
                                <i class="now-ui-icons ui-1_bell-53"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="notification" style="min-width: 260px;overflow: hidden;">
                                <?php if(count($notification_list) == 0): ?>

                                    <a class="dropdown-item p-1" href="<?php echo e(route('getNotificationsSettingView')); ?>">
                                        <div class="media-body direction">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="m-0"><?php echo e(__('profile.no_notifications')); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                                <?php $__currentLoopData = $notification_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <a class="dropdown-item p-1" href="<?php echo e(route('getNotificationsSettingView')); ?>"
                                       <?php if((auth()->user()->role->title ?? null) == 'admin'): ?>
                                            style="background: <?php echo e($notification->read_at_admin ? '#FFF' : '#e6e6e6'); ?>"
                                       <?php else: ?>
                                            style="background: <?php echo e($notification->read_at ? '#FFF' : '#e6e6e6'); ?>"
                                       <?php endif; ?>
                                    >
                                        <div class="media-body direction w-100">
                                            <div class="media w-100">
                                                <div class="media-body"
                                                     style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
                                                    <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                                        style="flex:4">
                                                        <?php echo e(app()->getLocale() == 'ar' ? $notification->title : $notification->title_en); ?>

                                                        <br>
                                                        <span style="font-size:10px;margin-top:5px;color:#6536be"
                                                              class="text-info"><?php echo e($notification->created_at); ?></span>
                                                        <br>
                                                        <span style="font-weight: 100;font-size:10px"><?php echo e(app()->getLocale() == 'ar' ? $notification->description : $notification->description_en); ?></span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="dropdown d-lg-inline-block d-none p-0">
                            <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="messages"
                               data-toggle="dropdown">
                                <div class="chat-count message_counter  p-0"><?php echo e($messgaes_count); ?></div>
                                <i class="now-ui-icons ui-2_chat-round"></i>
                            </a>
                            <div class="dropdown-menu" id="message_unread" aria-labelledby="messages"
                                 style="min-width: 260px;overflow: hidden;">
                                <?php if(count($message_list) == 0): ?>
                                    <a class="dropdown-item p-1" href="<?php echo e(route('getChatView')); ?>" id="no_message">
                                        <div class="media-body direction">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="m-0"> <?php echo e(__('profile.no_messages')); ?> </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                                <?php $__currentLoopData = $message_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a class="dropdown-item p-1" id="message_link_<?php echo e($message->fromUser->id); ?>"
                                       href="<?php echo e(route('getChatView',['chat_id'=>$message->fromUser->id])); ?>">
                                        <div class="media-body direction">
                                            <div class="media">
                                                <div class="media-body"
                                                     style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
                                                    <img style="width: 35px;height:42px;flex:1;border-radius: 50%;margin: 0;"
                                                         class="media-object avatar img-raised" alt="64x64"
                                                         src="<?php echo e($message->fromUser->image_path ?? asset('assets/img/user_avatar.jpg')); ?>">
                                                    <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                                        style="flex:4">
                                                        <?php echo e($message->fromUser->firstname . ' ' . $message->fromUser->lastname); ?>

                                                        <br>
                                                        <span class="msg" style="font-size:10px;font-weight: 100;">
                                                            <?php echo e($message->message); ?>

                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="dropdown d-lg-inline-block d-none  p-0">
                            <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="settings"
                               data-toggle="dropdown">
                                <i class="now-ui-icons ui-1_settings-gear-63"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="settings">


                                <a class="dropdown-item"
                                   href="<?php echo e(route('getProfileSettingView')); ?>">  <?php echo e(__('profile.general_settings')); ?> </a>
                                
                                <?php if($user->role_id != 1): ?>
                                    <a class="dropdown-item"
                                       href="<?php echo e(route("getCreateComplaintsUs")); ?>">  <?php echo e(__('settings.complaints')); ?></a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="<?php echo e(route("handleLogout")); ?>">  <?php echo e(__('profile.log_out')); ?></a>
                            </div>
                        </div>

                        <div class="<?php echo e(app()->getLocale() == 'ar' ? 'active': ''); ?>">
                            <a href="<?php echo e(route('setAr')); ?>">AR</a>
                        </div>

                        <div class="<?php echo e(app()->getLocale() == 'en' ? 'active': ''); ?>">
                            <a href="<?php echo e(route('setEn')); ?>">EN</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

</nav>
<!-- End Navbar -->

<nav id="menu" class="menu">
    <button class="navbar-brand bg-transparent border-0 text-danger menu__handle d-lg-none" href="#">
        <span class="button-bar dark-scroll"></span>
        <span class="button-bar dark-scroll"></span>
        <span class="button-bar dark-scroll"></span>
    </button>
    <div class="menu__inner direction" style="background:linear-gradient(45deg, #050208, #753fd6)">
        <div class="row" style="margin-top: 50px;">
            <div class="col-4">
                <div class="card-image">
                    <a href="#">
                        <img class="img img-responsive img-thumbnail rounded img-raised" width="100%" style="border-radius: 50%!important;"
                             src="<?php echo e($user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>">
                    </a>
                </div>
            </div>
            <div class="col-8" style="padding-top: 50px;">
                <h5 class="mb-1 text-white" dir="ltr"><?php echo e("@".$user->username); ?></h5>
                <h6 style="color: #999"> <?php echo e($user->firstname . " " . $user->lastname); ?></h6>
            </div>
            <div class="col-12" style="margin-top:30px">
                <fieldset>
                    <legend style="color: #ddd;font-size: 20px;">Main Links</legend>
                    <ul class="list-unstyled text-left" style="padding-<?php echo e(app()->getLocale() == 'ar' ? 'right': 'left'); ?>: 20px;">
                        <?php if(auth()->user()->role_id == 1): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getAdminAddProductView')); ?>">
                                    <i class="fas  fa-prescription-bottle" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;"><?php echo e(__('profile.add_drug')); ?>  </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 2): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getAddProductView')); ?>">
                                    <i class="now-ui-icons shopping_tag-content" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.add_drug_store')); ?>  </p>
                                </a>
                            </li>
                            <!--<li>-->
                            <!--    <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getShowFavouritesView')); ?>">-->
                            <!--        <i class="now-ui-icons ui-2_favourite-28" style="font-size: 18px"></i>-->
                            <!--        <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.show_favorite_link')); ?>  </p>-->
                            <!--    </a>-->
                            <!--</li>-->
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 3): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getProductsView')); ?>">
                                    <i class="now-ui-icons shopping_cart-simple" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.shop_now')); ?></p>
                                </a>
                            </li>
                        <?php endif; ?>


                        <?php if(auth()->user()->role_id == 1): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getApproveProductsView')); ?>">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;"><?php echo e(__('profile.approve_drugs')); ?>  </p>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getApprovePosts')); ?>">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;"><?php echo e(__('profile.approve_posts')); ?>  </p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->role_id == 1): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getAdminSalesView')); ?>">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;"><?php echo e(app()->getLocale() == 'ar' ? 'الطلبات' : 'Sales Orders'); ?> </p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->role_id == 2): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getAllProductsView')); ?>">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.store')); ?>  </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 3): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getBoughtsView')); ?>">
                                    <i class="now-ui-icons users_circle-08" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.orders')); ?></p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getChatView')); ?>">
                                <i class="now-ui-icons ui-2_chat-round" style="font-size: 18px"></i>
                                <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;"><?php echo e(__('profile.chat')); ?>  </p>
                            </a>
                        </li>


                        <?php if(auth()->user()->role_id == 1): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getUsersAccounts')); ?>">
                                    <i class="fas  fa-user-astronaut" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;"><?php echo e(__('profile.users')); ?>  </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 2): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getSalesView')); ?>">
                                    <i class="fas  fa-user-md" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.customers')); ?>  </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 3): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('drugStoreMapView')); ?>">
                                    <i class="now-ui-icons location_pin" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.map')); ?></p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getGroupPosts')); ?>">
                                <i class="now-ui-icons ui-1_send" style="font-size: 18px"></i>
                                <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.feeds')); ?></p>
                            </a>
                        </li>

                        <?php if(auth()->user()->role_id != 4): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getPostJobsView')); ?>">
                                    <i class="now-ui-icons business_briefcase-24" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.jobs')); ?></p>
                                </a>
                            </li>
                        <?php endif; ?>



                        <?php if(auth()->user()->role_id == 1): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getApproveOffersView')); ?>">
                                    <i class="now-ui-icons objects_diamond" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;"><?php echo e(__('profile.offers')); ?>  </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 2): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getAllUserOffersView')); ?>">
                                    <i class="now-ui-icons objects_diamond" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.offers')); ?>  </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role_id == 3): ?>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getAllUserOffersView')); ?>">
                                    <i class="now-ui-icons objects_diamond" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.offers')); ?></p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a class="btn btn-link btn-block text-white text-left m-0" href="<?php echo e(route('getProfileSettingView')); ?>">
                                <i class="now-ui-icons ui-2_settings-90" style="font-size: 18px"></i>
                                <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   <?php echo e(__('profile.settings')); ?></p>
                            </a>
                        </li>
                    </ul>
                </fieldset>
            </div>
        </div>
        <div class="text-center">
            <a href="<?php echo e(route('handleLogout')); ?>" class="nav-link" style="position: absolute;width: 100%;left: 0;bottom: 0;background: linear-gradient(90deg,#673AB7,#6b39c5);height: 55px;padding-top:18px;">
                <i class="fas fa-sign-out-alt" style="font-size: 18px"></i>
                <?php echo e(app()->getLocale() == 'ar' ? 'تسجيل الخروج' : 'Logout'); ?>

            </a>
        </div>

    </div>
    <div class="morph-shape" data-morph-close="M300-10c0,0,295,164,295,410c0,232-295,410-295,410"
         data-morph-open="M300-10C300-10,5,154,5,400c0,232,295,410,295,410">
        <svg width="100%" height="100%" viewBox="0 0 600 800" preserveAspectRatio="none">
            <path fill="none" d="M300-10c0,0,0,164,0,410c0,232,0,410,0,410"/>
        </svg>
    </div>
</nav>

