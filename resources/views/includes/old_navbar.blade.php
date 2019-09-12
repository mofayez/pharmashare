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
    .languages div{ 
        display: inline-block;
        padding: 3px 10px;
        margin: 0;
        text-transform: uppercase;
    }
    
    .languages div.active{ 
        border: 1px solid;
        background:#6237bd;
        color:#FFF;
    }
    .languages div.active a{ 
        
        color:#FFF!important;
    }
</style>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent direction" color-on-scroll="100">
    <div class="container">

        <div class="navbar-translate">
            {{--<img class="img-responsive" style="width: 100px" src="https://dcnetworks.ie/wp/wp-content/uploads/2017/11/placeholder-logo-2.png" alt="..">--}}
        </div>

        <ul class="navbar-nav ml-auto d-md-flex d-lg-flex  direction">

            <li class="nav-item d-md-block d-none">
                <a href="{{route('getGroupPosts')}}" class="nav-link btn btn-main btn-round text-white">
                    <p>{{__('profile.home')}}</p>
                </a>
            </li>

            <li class="nav-item dropdown">
                @if(auth()->user()->role_id == 3)
                    <a href="{{route('getCartView')}}" class="nav-link btn-round position-relative d-inline-block">
                        <div id="cart-count" class="chat-count">{{$basket_item_count}}</div>
                        <i class="now-ui-icons shopping_basket"></i>
                    </a>
                @endif
                <a href="{{route('getChatView')}}"
                   class="nav-link btn-round d-md-none position-relative d-inline-block">
                    <div class="chat-count">{{$messgaes_count}}</div>
                    <i class="now-ui-icons ui-2_chat-round"></i>
                </a>
                <a href="{{route('getNotificationsSettingView')}}"
                   class="nav-link btn-round d-md-none d-inline-block position-relative">
                    <div class="chat-count">{{$notifications_count}}</div>
                    <i class="now-ui-icons ui-1_bell-53"></i>
                </a>
                <a href="{{route('handleLogout')}}"
                   class="nav-link btn-round d-md-none d-inline-block position-relative">
                    <i class="fas fa-sign-out-alt" style="font-size: 18px"></i>
                </a>
            </li>

            <li class="nav-item dropdown d-md-block d-none">
                <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="notification"
                   data-toggle="dropdown">
                    <div class="chat-count">{{$notifications_count}}</div>
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
                        
                        <a class="dropdown-item p-1" href="{{route('getNotificationsSettingView')}}">
                            <div class="media-body direction">
                                    <div class="media">
                                        <div class="media-body"
                                             style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
                                            <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                                style="flex:4">
                                                {{$notification->title}}
                                                <br>
                                                <span style="font-size:10px;margin-top:5px;color:#6536be" class="text-info">{{$notification->created_at}}</span>
                                                <br>
                                                <span style="font-weight: 100;font-size:10px">{{$notification->description}}</span>
                                            </h6>
                                        </div>
                                    </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown d-md-block d-none">
                <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="messages"
                   data-toggle="dropdown">
                    <div class="chat-count message_counter">{{$messgaes_count}}</div>
                    <i class="now-ui-icons ui-2_chat-round"></i>
                </a>
                <div class="dropdown-menu" id="message_unread" aria-labelledby="messages" style="min-width: 260px;overflow: hidden;">
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
                        <a class="dropdown-item p-1" id="message_link_{{$message->fromUser->id}}" href="{{route('getChatView',['chat_id'=>$message->fromUser->id])}}">
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
            </li>

            <li class="nav-item dropdown d-md-block d-none">
                <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="settings"
                   data-toggle="dropdown">
                    <i class="now-ui-icons ui-1_settings-gear-63"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="settings">
                    <a class="dropdown-header">{{__('profile.settings')}} </a>
                    {{--<a class="dropdown-item" href="#">{{__('profile.account')}}  </a>--}}
                    {{--<a class="dropdown-item" href="#">{{__('profile.activity')}}  </a>--}}
                    <a class="dropdown-item" href="{{route('getProfileSettingView')}}">  {{__('profile.general_settings')}} </a>
                    {{--<div class="dropdown-divider"></div>--}}
                    @if($user->role_id != 1)
                        <a class="dropdown-item"
                           href="{{route("getCreateComplaintsUs")}}">  {{__('settings.complaints')}}</a>
                    @endif
                    <a class="dropdown-item" href="{{route("handleLogout")}}">  {{__('profile.log_out')}}</a>
                </div>
            </li>

            <li class="nav-item text-center d-none d-md-block pt-1">
                <div class="col-md-12 text-right">
                    <div class="languages">
                        <div class="{{app()->getLocale() == 'ar' ? 'active': ''}}">
                            <a href="{{route('setAr')}}">عربي</a>
                        </div>
                        
                        <div class="{{app()->getLocale() == 'en' ? 'active': ''}}">
                            <a href="{{route('setEn')}}">english</a>
                        </div>
                    </div>
                   <!-- @if(app()->getLocale() == 'ar')-->
                   <!--     <label> العربية </label>-->
                   <!-- @else-->
                   <!--     <label> English </label>-->
                   <!-- @endif-->
                   <!-- <input type="checkbox" class="bootstrap-switch"-->
                   <!--@if(app()->getLocale() == 'ar') checked="checked" @endif />-->
                </div>
            </li>
        </ul>
    </div>

</nav>
<!-- End Navbar -->

<nav id="menu" class="menu">
    <button class="navbar-brand bg-transparent border-0 text-danger menu__handle" href="#">
        <span class="button-bar dark-scroll"></span>
        <span class="button-bar dark-scroll"></span>
        <span class="button-bar dark-scroll"></span>
    </button>
    <div class="menu__inner direction" style="background: rgba(0,0,0,0.8);">
        <div class="row mt-3" style="width: 100%">
            <div class="col-md-3 griditem text-center">
                @if(auth()->user()->role_id == 1)
                    <a href="{{route('getAdminAddProductView')}}">
                        <!--<i class="fas  fa-prescription-bottle"></i>-->
                        <img src="{{asset('assets/icons/101-medicine-1.svg')}}" style="width:100px"/>
                        <p>{{__('profile.add_drug')}}  </p>
                        <label class="badge badge-info">Admin</label>
                        <br>
                        <span> {{__('profile.add_drug_p')}}</span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 2)
                    <a href="{{route('getAddProductView')}}">
                        <!--<i class="now-ui-icons shopping_tag-content"></i>-->
                        <img src="{{asset('assets/icons/101-injection.svg')}}" style="width:100px"/>
                        <p>   {{__('profile.add_drug_store')}}  </p>
                        <label class="badge badge-danger">Drug Store</label>
                        <br>
                        <span>  {{__('profile.add_drug_store_p')}}</span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 3)
                    <a href="{{route('getProductsView')}}">
                        <!--<i class="now-ui-icons shopping_cart-simple"></i>-->
                    <!--<img src="{{asset('assets/icons/101-aeroplane.svg')}}" style="width:100px"/>-->
                    <img src="{{asset('assets/icons/shop_now.svg')}}" style="width:100px"/>
                        <p>   {{__('profile.shop_now')}}</p>
                        <label class="badge badge-warning">Pharmacist</label>
                        <br>
                        <span> {{__('profile.shop_now_p')}}</span>
                    </a>
                @endif
            </div>
            <div class="col-md-3 griditem text-center">
                @if(auth()->user()->role_id == 1)
                    <a href="{{route('getApproveProductsView')}}">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                    <img src="{{asset('assets/icons/101-medicine-2.svg')}}" style="width:100px"/>
                        <p> {{__('profile.approve_drugs')}} </p>
                        <label class="badge badge-info">admin</label>
                        <br>
                        <span> {{__('profile.approve_drugs_p')}} </span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 2)
                    <a href="{{route('getAllProductsView')}}">
                        <!--<i class="now-ui-icons shopping_box"></i>-->
                        <img src="{{asset('assets/icons/101-hospital.svg')}}" style="width:100px"/>
                        <p>{{__('profile.store')}} </p>
                        <label class="badge badge-danger">Drug Store</label>
                        <br>
                        <span>{{__('profile.store_p')}} </span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 3)
                    <a href="{{route('getBoughtsView')}}">
                        <!--<i class="now-ui-icons users_circle-08"></i>-->
                    <img src="{{asset('assets/icons/101-first-aid-kit.svg')}}" style="width:100px"/>
                        <p> {{__('profile.orders')}} </p>
                        <label class="badge badge-warning">Pharmacist</label>
                        <br>
                        <span>{{__('profile.orders_p')}}</span>
                    </a>
                @endif
            </div>
            <div class="col-md-3 griditem text-center">
                <a href="{{route("getChatView")}}">
                    <!--<i class="now-ui-icons ui-2_chat-round"></i>-->
                    <img src="{{asset('assets/icons/101-doctor-1.svg')}}" style="width:100px"/>
                    {{--<div class="position-absolute side-count">2</div>--}}
                    <p>{{__('profile.chat')}}</p>
                    <label class="badge badge-default">All</label>
                    <br>
                    <span> {{__('profile.chat_p')}}</span>
                </a>
            </div>
            <div class="col-md-3 griditem text-center">
                @if(auth()->user()->role_id == 1)
                    <a href="{{route('getUsersAccounts')}}">
                        {{--<i class="now-ui-icons users_single-02"></i>--}}
                        <!--<i class="fas  fa-user-astronaut"></i>-->
                        <img src="{{asset('assets/icons/101-app.svg')}}" style="width:100px"/>
                        <p>{{__('profile.users')}} </p>
                        <label class="badge badge-info">admin</label>
                        <br>
                        <span> {{__('profile.users_p')}}</span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 2)
                    <a href="{{route('getSalesView')}}">
                        {{--<i class="now-ui-icons users_single-02"></i>--}}
                        <!--<i class="fas  fa-user-md"></i>-->
                        <img src="{{asset('assets/icons/101-cardiogram-3.svg')}}" style="width:100px"/>
                        <p>{{__('profile.customers')}} </p>
                        <label class="badge badge-danger">Drug Store</label>
                        <br>
                        <span> {{__('profile.customers_p')}}</span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 3)
                    <a href="{{route('drugStoreMapView')}}">
                        <!--<i class="now-ui-icons location_pin"></i>-->
                    <img src="{{asset('assets/icons/101-worldwide-1.svg')}}" style="width:100px"/>
                        <p> {{__('profile.map')}} </p>
                        <label class="badge badge-warning">Pharmacist</label>
                        <br>
                        <span> {{__('profile.map_p')}}</span>
                    </a>
                @endif
            </div>
            <div class="col-md-3 griditem text-center">
                <a href="{{route("getGroupPosts")}}">
                    <img src="{{asset('assets/icons/101-newspaper.svg')}}"  style="width:100px"/>
                    <!--<i class="now-ui-icons ui-1_send"></i>-->
                    <p>{{__('profile.feeds')}}</p>
                    <label class="badge badge-default">All</label>
                    <br>
                    <span> {{__('profile.feeds_p')}} </span>
                </a>
            </div>
            <div class="col-md-3 griditem text-center">
                @if(auth()->user()->role_id != 4)
                    <a href="{{route("getPostJobsView")}}">
                        <img src="{{asset('assets/icons/101-medical-history.svg')}}"  style="width:100px"/>
                        <!--<i class="now-ui-icons business_briefcase-24"></i>-->
                        <p>{{__('profile.jobs')}}</p>
                        <label class="badge badge-default">All</label>
                        <br>
                        <span> {{__('profile.jobs_p')}} </span>
                    </a>

                @endif
            </div>
            <div class="col-md-3 griditem text-center">
                @if(auth()->user()->role_id == 3)
                    <a href="{{route('getAllUserOffersView')}}">
                        <!--<i class="now-ui-icons objects_diamond"></i>-->
                    <img src="{{asset('assets/icons/101-snellen-chart.svg')}}" style="width:100px"/>
                        <p>{{__('profile.offers')}}</p>
                        <label class="badge badge-warning">Pharmacist</label>
                        <br>
                        <span> {{__('profile.offers_p')}}</span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 2)
                    <a href="{{route('getAllUserOffersView')}}">
                        <!--<i class="now-ui-icons objects_diamond"></i>-->
                    <img src="{{asset('assets/icons/101-snellen-chart.svg')}}" style="width:100px"/>
                        <p>{{__('profile.offers')}}</p>
                        <label class="badge badge-danger">Drug Store</label>
                        <br>
                        <span> {{__('profile.offers_p')}}</span>
                    </a>
                @endif
                @if(auth()->user()->role_id == 1)
                    <a href="{{route('getApproveOffersView')}}">
                        <!--<i class="now-ui-icons objects_diamond"></i>-->
                    <img src="{{asset('assets/icons/101-snellen-chart.svg')}}" style="width:100px"/>
                        <p>{{__('profile.offers')}}</p>
                        <label class="badge badge-info">admin</label>
                        <br>
                        <span> {{__('profile.offers_p')}}</span>
                    </a>
                @endif
            </div>
            <div class="col-md-3 griditem text-center">
                <a href="{{route('getProfileSettingView')}}">
                    <img src="{{asset('assets/icons/101-smartphone.svg')}}" style="width:100px"/>
                    <!--<i class="now-ui-icons ui-2_settings-90"></i>-->
                    <p>{{__('profile.settings')}}</p>
                    <label class="badge badge-default">All</label>
                    <br>
                    <span> {{__('profile.settings_p')}}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="morph-shape" data-morph-close="M300-10c0,0,295,164,295,410c0,232-295,410-295,410"
         data-morph-open="M300-10C300-10,5,154,5,400c0,232,295,410,295,410">
        <svg width="100%" height="100%" viewBox="0 0 600 800" preserveAspectRatio="none">
            <path fill="none" d="M300-10c0,0,0,164,0,410c0,232,0,410,0,410"/>
        </svg>
    </div>
</nav>

