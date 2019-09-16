<div class="row d-none d-md-block">
    <div class="col-md-12" style="max-height: 365px;">
        <div class="card card-plain">
            <div class="card card-blog card-plain card-body profile-float">
                <div class="card-image">
                    <a href="#">
                        <img class="img img-responsive img-thumbnail rounded img-raised" width="100%"
                             src="{{$user->image_path ?? asset("assets/img/user_avatar.jpg")}}">
                    </a>
                </div>
                <div class="card-body bg-white mr-2 ml-2">

                    <ul class="list-unstyled">
                        <li>
                            <h5 class="mb-1" dir="ltr">{{"@".$user->username }}</h5>
                            <h6 style="color: #999"> {{$user->firstname . " " . $user->lastname }}</h6>
                            <hr>
                            <label class="badge badge-default">{{$user->role->title}}</label>
                            @if($user->activated)
                                <label class="badge badge-success">activated</label>
                            @else
                                <label class="badge badge-danger">not activated</label>
                            @endif
                        </li>
                        @if($user->email)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -695px;"></div>
                                    <span class="pr-2 pl-2" style="font-size: 11px">
                                    {{$user->email}}
                                </span>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                        @if(!$user->activated)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1808px;"></div>
                                    <span class="pr-2 pl-2" style="font-size: 11px">
                                    @if(app()->getLocale() == 'ar')
                                        {{$user->hint_ar ? $user->hint_ar : 'من فضلك تأكد من تسجيل البيانات لتفعيل الحساب'}}
                                    @else
                                        {{$user->hint_en ? $user->hint_en : 'Please Complete Registertion Info'}}
                                    @endif
                                </span>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif 
                        @if($user->phone)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1409px;"></div>
                                    <div class="pr-2 pl-2" style="direction:ltr;font-size: 11px;display: inline-block">
                                        +({{$user->prefix}}) {{$user->phone}}
                                    </div>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                        @if($user->full_address)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1472px;"></div>
                                    <div class="mr-2 ml-2" style="display: inline-block;font-size: 11px">
                                        {{$user->full_address}}
                                    </div>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                        @if($user->location)
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1472px;"></div>
                                    <div class="mr-2 ml-2 float-right"
                                         style="display: inline-block;font-size: 11px;width: 85%">
                                        {{$user->location->location}}
                                    </div>
                                    <hr class="mt-1" style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        @endif
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1975px;"></div>
                                    <div class="mr-2 ml-2 mt-1 float-right"
                                         style="display: inline-block;font-size: 11px;width: 85%">
                                        <a href="mailto:sales@pharmashare.ae">sales@pharmashare.ae</a>
                                    </div>
                                    <hr class="mt-1" style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1975px;"></div>
                                    <div class="mr-2 ml-2 mt-1 float-right"
                                         style="display: inline-block;font-size: 11px;width: 85%">
                                         <a href="mailto:info@pharmashare.ae">info@pharmashare.ae</a>
                                    </div>
                                    <hr class="mt-1" style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    @if(in_array('feeds',(array)$allowed_ads))
        @foreach($first_ratio as $item)
            @if($loop->index % 2 == 0)
                @continue
            @endif
            @if($item['original_image'])
                <div class="col-md-12 mb-2">
                    <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                        <img src="{{asset('assets/img/cron.png')}}" alt="">
                        <h3 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                            {{__('profile.ads')}}
                        </h3>
                    </div>
                    <a href="{{$item['link'] ?? '#'}}" target="_blank">
                        <img src="{{$item['second_image']}}" alt="">
                    </a>
                </div>
            @endif
        @endforeach
    @endif
</div>