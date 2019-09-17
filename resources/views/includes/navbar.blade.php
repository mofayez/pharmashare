<style>
    @media screen and (max-width: 991px) {
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
            {{--<img class="img-responsive" style="width: 100px" src="https://dcnetworks.ie/wp/wp-content/uploads/2017/11/placeholder-logo-2.png" alt="..">--}}
        </div>

        <ul class="navbar-nav ml-auto d-md-flex d-lg-flex  direction">

            <li class="nav-item d-lg-block d-none">
                <a href="{{route('getGroupPosts')}}" class="nav-link btn btn-main btn-round text-white">
                    <p>{{__('profile.feeds')}}</p>
                </a>
            </li>

            @if(auth()->user()->role_id == 1)
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getAdminAddProductView')}}">
                        <!--<i class="now-ui-icons fas fa-prescription-bottle"></i>-->
                        <p>{{__('profile.add_drug')}}  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getApproveProductsView')}}">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                        <p>{{__('profile.approve_drugs')}}  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getApprovePosts')}}">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                        <p>{{__('profile.approve_posts')}}  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getUsersAccounts')}}">
                        <!--<i class="now-ui-icons users_single-02"></i>-->
                        <p>{{__('profile.users')}}  </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getAdminSalesView')}}">
                        <!--<i class="now-ui-icons users_single-02"></i>-->
                        <p>{{app()->getLocale() == 'ar' ? 'الطلبات' : 'Sales Orders'}}  </p>
                    </a>
                </li>

            @endif

            @if(auth()->user()->role_id == 2)
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link"  href="{{route('getAddToFavouritesView')}}">
                        <!--<i class="now-ui-icons shopping_tag-content"></i>-->
                        <p>   {{__('profile.add_drug_store')}}  </p>
                    </a>
                </li>
                <!--<li class="nav-item  d-none d-lg-block">-->
                <!--    <a class="nav-link"  href="{{route('getShowFavouritesView')}}">-->
                        <!--<i class="now-ui-icons shopping_tag-content"></i>-->
                <!--        <p>   {{__('profile.show_favorite_link')}}  </p>-->
                <!--    </a>-->
                <!--</li>-->
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link"  href="{{route('getAllProductsView')}}">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                        <p>{{__('profile.store')}} </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link"  href="{{route('getSalesView')}}">
                        <!--<i class="now-ui-icons users_single-02"></i>-->
                        <p>{{__('profile.customers')}} </p>
                    </a>
                </li>
            @endif

            @if(auth()->user()->role_id == 3)
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getProductsView')}}">
                        <!--<i class="now-ui-icons shopping_cart-simple"></i>-->
                        <p>   {{__('profile.shop_now')}}</p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getBoughtsView')}}">
                        <!--<i class="now-ui-icons users_circle-08"></i>-->
                        <p> {{__('profile.orders')}} </p>
                    </a>
                </li>
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('drugStoreMapView')}}">
                        <!--<i class="now-ui-icons location_pin"></i>-->
                        <p> {{__('profile.map')}} </p>
                    </a>
                </li>
            @endif

            <li class="nav-item  d-none d-lg-block">
                <a class="nav-link" href="{{route('getPostJobsView')}}">
                    <!--<i class="now-ui-icons business_badge"></i>-->
                    <p> {{__('profile.jobs')}} </p>
                </a>
            </li>


            @if(auth()->user()->role_id == 1)
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getApproveOffersView')}}">
                        <!--<i class="now-ui-icons clothes_tie-bow"></i>-->
                        <p> {{__('profile.offers')}} </p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->role_id == 2)
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getAllUserOffersView')}}">
                        <!--<i class="now-ui-icons clothes_tie-bow"></i>-->
                        <p> {{__('profile.offers')}} </p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->role_id == 3)
                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getAllUserOffersView')}}">
                        <!--<i class="now-ui-icons clothes_tie-bow"></i>-->
                        <p> {{__('profile.offers')}} </p>
                    </a>
                </li>
            @endif


            <li class="nav-item text-center   pt-1">
                <div class="col-md-12 text-right">
                    <div class="languages">
                        @if(auth()->user()->role_id == 3)
                            <div class="dropdown  p-0">
                                <a href="{{route('getCartView')}}" class="nav-link btn-round" class="dropdown-toggle" >
                                    <div id="cart-count" class="chat-count p-0">{{$basket_item_count}}</div>
                                    <i class="now-ui-icons shopping_basket"></i>
                                </a>
                            </div>
                        @endif
                        @if(auth()->user()->role_id == 2)
                            <!--<div class="dropdown  p-0">-->
                            <!--    <a href="{{route('getShowFavouritesView')}}" class="nav-link btn-round" class="dropdown-toggle">-->
                            <!--        <div class="chat-count p-0">{{$favourites_item_count}}</div>-->
                            <!--        <i class="now-ui-icons shopping_box"></i>-->
                            <!--    </a>-->
                            <!--</div>-->
                        @endif

                        <div class="dropdown d-md-inline-block d-lg-none p-0">
                            <a href="{{route('getChatView')}}" class="nav-link btn-round" class="dropdown-toggle">
                                <div class="chat-count p-0">{{$messgaes_count}}</div>
                                <i class="now-ui-icons ui-2_chat-round"></i>
                            </a>
                        </div>

                        <div class="dropdown d-md-inline-block d-lg-none p-0">
                            <a href="{{route('getNotificationsSettingView')}}" class="nav-link btn-round" class="dropdown-toggle">
                                <div class="chat-count p-0">{{$notifications_count}}</div>
                                <i class="now-ui-icons ui-1_bell-53"></i>
                            </a>
                        </div>

                        <div class="dropdown d-md-inline-block d-lg-none p-0">
                            <a href="{{route('handleLogout')}}" class="nav-link btn-round" class="dropdown-toggle">
                                <i class="fas fa-sign-out-alt" style="font-size: 18px"></i>
                            </a>
                        </div>

                        <div class="dropdown d-lg-inline-block d-none p-0">
                            <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="notification"
                               data-toggle="dropdown">
                                <div class="chat-count p-0">{{$notifications_count}}</div>
                                <i class="now-ui-icons ui-1_bell-53"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="notification" style="min-width: 260px;overflow: hidden;">
                                @if(count($notification_list) == 0)

                                    <a class="dropdown-item p-1" href="{{route('getNotificationsSettingView')}}">
                                        <div class="media-body direction">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="m-0">{{__('profile.no_notifications')}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                @foreach($notification_list as $notification)

                                    <a class="dropdown-item p-1" href="{{route('getNotificationsSettingView')}}"
                                       @if((auth()->user()->role->title ?? null) == 'admin')
                                            style="background: {{$notification->read_at_admin ? '#FFF' : '#e6e6e6'}}"
                                       @else
                                            style="background: {{$notification->read_at ? '#FFF' : '#e6e6e6'}}"
                                       @endif
                                    >
                                        <div class="media-body direction w-100">
                                            <div class="media w-100">
                                                <div class="media-body"
                                                     style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
                                                    <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                                        style="flex:4">
                                                        {{app()->getLocale() == 'ar' ? $notification->title : $notification->title_en}}
                                                        <br>
                                                        <span style="font-size:10px;margin-top:5px;color:#6536be"
                                                              class="text-info">{{$notification->created_at}}</span>
                                                        <br>
                                                        <span style="font-weight: 100;font-size:10px">{{app()->getLocale() == 'ar' ? $notification->description : $notification->description_en}}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="dropdown d-lg-inline-block d-none p-0">
                            <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="messages"
                               data-toggle="dropdown">
                                <div class="chat-count message_counter  p-0">{{$messgaes_count}}</div>
                                <i class="now-ui-icons ui-2_chat-round"></i>
                            </a>
                            <div class="dropdown-menu" id="message_unread" aria-labelledby="messages"
                                 style="min-width: 260px;overflow: hidden;">
                                @if(count($message_list) == 0)
                                    <a class="dropdown-item p-1" href="{{route('getChatView')}}" id="no_message">
                                        <div class="media-body direction">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4 class="m-0"> {{__('profile.no_messages')}} </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                @foreach($message_list as $message)
                                    <a class="dropdown-item p-1" id="message_link_{{$message->fromUser->id}}"
                                       href="{{route('getChatView',['chat_id'=>$message->fromUser->id])}}">
                                        <div class="media-body direction">
                                            <div class="media">
                                                <div class="media-body"
                                                     style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
                                                    <img style="width: 35px;height:42px;flex:1;border-radius: 50%;margin: 0;"
                                                         class="media-object avatar img-raised" alt="64x64"
                                                         src="{{$message->fromUser->image_path ?? asset('assets/img/user_avatar.jpg')}}">
                                                    <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                                        style="flex:4">
                                                        {{$message->fromUser->firstname . ' ' . $message->fromUser->lastname}}
                                                        <br>
                                                        <span class="msg" style="font-size:10px;font-weight: 100;">
                                                            {{$message->message}}
                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="dropdown d-lg-inline-block d-none  p-0">
                            <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="settings"
                               data-toggle="dropdown">
                                <i class="now-ui-icons ui-1_settings-gear-63"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="settings">


                                <a class="dropdown-item"
                                   href="{{route('getProfileSettingView')}}">  {{__('profile.general_settings')}} </a>
                                {{--<div class="dropdown-divider"></div>--}}
                                @if($user->role_id != 1)
                                    <a class="dropdown-item"
                                       href="{{route("getCreateComplaintsUs")}}">  {{__('settings.complaints')}}</a>
                                @endif
                                <a class="dropdown-item" href="{{route("handleLogout")}}">  {{__('profile.log_out')}}</a>
                            </div>
                        </div>

                        <div class="{{app()->getLocale() == 'ar' ? 'active': ''}}">
                            <a href="{{route('setAr')}}">AR</a>
                        </div>

                        <div class="{{app()->getLocale() == 'en' ? 'active': ''}}">
                            <a href="{{route('setEn')}}">EN</a>
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
                             src="{{$user->image_path ?? asset("assets/img/user_avatar.jpg")}}">
                    </a>
                </div>
            </div>
            <div class="col-8" style="padding-top: 50px;">
                <h5 class="mb-1 text-white" dir="ltr">{{"@".$user->username }}</h5>
                <h6 style="color: #999"> {{$user->firstname . " " . $user->lastname }}</h6>
            </div>
            <div class="col-12" style="margin-top:30px">
                <fieldset>
                    <legend style="color: #ddd;font-size: 20px;">Main Links</legend>
                    <ul class="list-unstyled text-left" style="padding-{{app()->getLocale() == 'ar' ? 'right': 'left'}}: 20px;">
                        @if(auth()->user()->role_id == 1)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getAdminAddProductView')}}">
                                    <i class="fas  fa-prescription-bottle" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">{{__('profile.add_drug')}}  </p>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 2)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getAddProductView')}}">
                                    <i class="now-ui-icons shopping_tag-content" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.add_drug_store')}}  </p>
                                </a>
                            </li>
                            <!--<li>-->
                            <!--    <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getShowFavouritesView')}}">-->
                            <!--        <i class="now-ui-icons ui-2_favourite-28" style="font-size: 18px"></i>-->
                            <!--        <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.show_favorite_link')}}  </p>-->
                            <!--    </a>-->
                            <!--</li>-->
                        @endif
                        @if(auth()->user()->role_id == 3)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getProductsView')}}">
                                    <i class="now-ui-icons shopping_cart-simple" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.shop_now')}}</p>
                                </a>
                            </li>
                        @endif


                        @if(auth()->user()->role_id == 1)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getApproveProductsView')}}">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">{{__('profile.approve_drugs')}}  </p>
                                </a>
                            </li>
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getApprovePosts')}}">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">{{__('profile.approve_posts')}}  </p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role_id == 1)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getAdminSalesView')}}">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">{{app()->getLocale() == 'ar' ? 'الطلبات' : 'Sales Orders'}} </p>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->role_id == 2)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getAllProductsView')}}">
                                    <i class="now-ui-icons shopping_box" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.store')}}  </p>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 3)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getBoughtsView')}}">
                                    <i class="now-ui-icons users_circle-08" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.orders')}}</p>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getChatView')}}">
                                <i class="now-ui-icons ui-2_chat-round" style="font-size: 18px"></i>
                                <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">{{__('profile.chat')}}  </p>
                            </a>
                        </li>


                        @if(auth()->user()->role_id == 1)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getUsersAccounts')}}">
                                    <i class="fas  fa-user-astronaut" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">{{__('profile.users')}}  </p>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 2)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getSalesView')}}">
                                    <i class="fas  fa-user-md" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.customers')}}  </p>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 3)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('drugStoreMapView')}}">
                                    <i class="now-ui-icons location_pin" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.map')}}</p>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getGroupPosts')}}">
                                <i class="now-ui-icons ui-1_send" style="font-size: 18px"></i>
                                <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.feeds')}}</p>
                            </a>
                        </li>

                        @if(auth()->user()->role_id != 4)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getPostJobsView')}}">
                                    <i class="now-ui-icons business_briefcase-24" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.jobs')}}</p>
                                </a>
                            </li>
                        @endif



                        @if(auth()->user()->role_id == 1)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getApproveOffersView')}}">
                                    <i class="now-ui-icons objects_diamond" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">{{__('profile.offers')}}  </p>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 2)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getAllUserOffersView')}}">
                                    <i class="now-ui-icons objects_diamond" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.offers')}}  </p>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role_id == 3)
                            <li>
                                <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getAllUserOffersView')}}">
                                    <i class="now-ui-icons objects_diamond" style="font-size: 18px"></i>
                                    <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.offers')}}</p>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a class="btn btn-link btn-block text-white text-left m-0" href="{{route('getProfileSettingView')}}">
                                <i class="now-ui-icons ui-2_settings-90" style="font-size: 18px"></i>
                                <p style="display: inline-block;padding: 0 50px 0 50px;margin: 0;">   {{__('profile.settings')}}</p>
                            </a>
                        </li>
                    </ul>
                </fieldset>
            </div>
        </div>
        <div class="text-center">
            <a href="{{route('handleLogout')}}" class="nav-link" style="position: absolute;width: 100%;left: 0;bottom: 0;background: linear-gradient(90deg,#673AB7,#6b39c5);height: 55px;padding-top:18px;">
                <i class="fas fa-sign-out-alt" style="font-size: 18px"></i>
                {{app()->getLocale() == 'ar' ? 'تسجيل الخروج' : 'Logout' }}
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

