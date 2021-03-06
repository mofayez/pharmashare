<div class="page-header page-header-small header-filter" filter-color="purple" color-on-scroll="200">

    <div class="page-header-image" data-parallax="true" style="background-image:url('{{asset("assets/img/bg.jpg")}}');">
    </div>

    <div class="container">

        <div class="photo-container">
            <img src="{{asset("assets/img/me.jpg")}}" alt="">
        </div>

        <h3 class="title pb-2">{{__('profile.name')}}   </h3>
        <p class="category">  {{__('profile.profile')}} </p>

        <div class="content d-md-none text-left">
           <ul class="list-unstyled">
                        <li>
                            <h5 class="mb-1" dir="ltr">{{"@".$current_user->username }}</h5>
                            <h6 style="color: #999"> {{$current_user->firstname . " " . $current_user->lastname }}</h6>
                            <hr>
                            <label class="badge badge-default">{{$current_user->role->title}}</label>
                            @if($current_user->activated)
                                <label class="badge badge-success">activated</label>
                            @else
                                <label class="badge badge-danger">not activated</label>
                            @endif
                        </li>
                        @if($current_user->email)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -695px;"></div>
                                    <span class="pr-2 pl-2" style="font-size: 11px">
                                    {{$current_user->email}}
                                </span>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                        @if($current_user->phone)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1409px;"></div>
                                    <div class="pr-2 pl-2" style="direction:ltr;font-size: 11px;display: inline-block">
                                        +({{$current_user->prefix}}) {{$current_user->phone}}
                                    </div>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                        @if($current_user->full_address)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1472px;"></div>
                                    <div class="mr-2 ml-2" style="display: inline-block;font-size: 11px">
                                        {{$current_user->full_address}}
                                    </div>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                        @if($current_user->location)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1472px;"></div>
                                    <div class="mr-2 ml-2 float-right"
                                         style="display: inline-block;font-size: 11px;width: 85%">
                                        {{$current_user->location->location}}
                                    </div>
                                    <hr class="mt-3" style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                    </ul>
        </div>

    </div>
</div>
