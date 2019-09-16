<style>
    @media screen and (max-width: 991px) {
        .navbar .navbar-nav {
            margin-top: 0;
        }
    }
</style>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white fixed-top navbar-transparent direction" color-on-scroll="200">
    <div class="container">

        <div class="navbar-translate">
            {{--<img class="img-responsive" style="width: 100px" src="https://dcnetworks.ie/wp/wp-content/uploads/2017/11/placeholder-logo-2.png" alt="..">--}}
        </div>

        <ul class="navbar-nav ml-auto d-md-flex d-lg-flex  direction">

            <li class="nav-item d-md-block d-none">
                <a href="{{route('getGroupPosts')}}" class="nav-link btn btn-main btn-round text-white">
                    <p>{{__('profile.feeds')}}</p>
                </a>
            </li>

            <li class="nav-item dropdown">
                @if(auth()->user()->role_id == 3)
                    <a href="{{route('getCartView')}}" class="nav-link btn-round position-relative d-inline-block">
                        <div id="cart-count" class="chat-count">{{$basket_item_count}}</div>
                        <i class="now-ui-icons shopping_basket"></i>
                    </a>
                @endif
                <a href="{{route('getGroupPosts')}}"
                   class="nav-link btn-round d-md-none position-relative d-inline-block">
                    <i class="now-ui-icons business_bank"></i>
                </a>
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
                    <i class="fa fa-sign-out-alt" style="font-size: 18px"></i>
                </a>
            </li>

                <li class="nav-item  d-none d-lg-block">
                    <a class="nav-link" href="{{route('getSearchJobsView')}}">
                        <!--<i class="now-ui-icons fas fa-prescription-bottle"></i>-->
                        <p>{{__('profile.jobs')}}  </p>
                    </a>
                </li>
            <li class="nav-item dropdown d-md-block d-none">
                <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="notification"
                   data-toggle="dropdown">
                    <div class="chat-count">{{$notifications_count}}</div>
                    <i class="now-ui-icons ui-1_bell-53"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="notification" style="width: 260px;overflow: hidden;">
                    <a class="dropdown-item p-1" href="{{route('getNotificationsSettingView')}}">
                        <div class="media-body direction">
                            @if(count($notification_list) == 0)
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="m-0">{{__('profile.no_notifications')}}</h4>
                                    </div>
                                </div>
                            @endif
                            @foreach($notification_list as $notification)
                                <div class="media">
                                    <div class="media-body"
                                         style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
                                        <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                            style="flex:4">
                                            {{$notification->title}}
                                            <br>
                                            <small style="font-size:10px">{{$notification->description}}</small>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown d-md-block d-none">
                <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="messages"
                   data-toggle="dropdown">
                    <div class="chat-count">{{$messgaes_count}}</div>
                    <i class="now-ui-icons ui-2_chat-round"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="messages">
                    <a class="dropdown-item p-1" href="{{route('getChatView')}}">
                        <div class="media-body direction">
                            @if(count($message_list) == 0)
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="m-0"> {{__('profile.no_messages')}} </h4>
                                    </div>
                                </div>
                            @endif
                            @foreach($message_list as $message)
                                <div class="media">
                                    <div class="media-body"
                                         style="display: flex;border-bottom: 1px solid #eee;padding-bottom: 5px;margin-bottom: 5px;">
                                        <div>
                                            <img style="width: 35px;height:35px;flex:1;border-radius: 50%;margin: 0;"
                                                 class="media-object avatar img-raised" alt="64x64"
                                                 src="{{$message->fromUser->image_path ?? asset('assets/img/user_avatar.jpg')}}">
                                        </div>
                                        <h6 class="text-capitalize media-heading text-left p-1 text-dark"
                                            style="flex:4">
                                            {{$message->fromUser->firstname . ' ' . $message->fromUser->lastname}}
                                            <br>
                                            <small style="font-size:10px">
                                                {{$message->message}}
                                            </small>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown d-md-block d-none">
                <a href="#" class="nav-link btn-round" class="dropdown-toggle" id="settings"
                   data-toggle="dropdown">
                    <i class="now-ui-icons ui-1_settings-gear-63"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="settings">
                    <!--<a class="dropdown-header">{{__('profile.settings')}} </a>-->
                    {{--<a class="dropdown-item" href="#">{{__('profile.account')}}  </a>--}}
                    {{--<a class="dropdown-item" href="#">{{__('profile.activity')}}  </a>--}}
                    {{--<a class="dropdown-item" href="#">  {{__('profile.general_settings')}} </a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    <a class="dropdown-item"
                       href="{{route('getProfileSettingView')}}">  {{__('profile.general_settings')}} </a>
                    <a class="dropdown-item" href="{{route("handleLogout")}}">  {{__('profile.log_out')}}</a>
                </div>
            </li>

        </ul>
    </div>

</nav>
<!-- End Navbar -->

<nav id="menu" class="menu">
    <!--<button class="navbar-brand bg-transparent border-0 text-danger menu__handle" href="#">-->
    <!--    <span class="button-bar dark-scroll"></span>-->
    <!--    <span class="button-bar dark-scroll"></span>-->
    <!--    <span class="button-bar dark-scroll"></span>-->
    <!--</button>-->
    <div class="menu__inner direction" style="background: rgba(0,0,0,0.8);">
        <div class="row mt-3" style="width: 100%">
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
                <a href="{{route("getChatView")}}">
                    <img src="{{asset('assets/icons/101-doctor-1.svg')}}" style="width:100px"/>
                    <!--<i class="now-ui-icons ui-2_chat-round"></i>-->
                    {{--<div class="position-absolute side-count">2</div>--}}
                    <p>{{__('profile.chat')}}</p>
                    <label class="badge badge-default">All</label>
                    <br>
                    <span> {{__('profile.chat_p')}}</span>
                </a>
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
            <div class="col-md-3 griditem text-center">

            </div>
            <div class="col-md-3 griditem text-center">

            </div>
            <div class="col-md-3 griditem text-center">

            </div>
            <div class="col-md-3 griditem text-center">

            </div>
            <div class="col-md-3 griditem text-center">

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

