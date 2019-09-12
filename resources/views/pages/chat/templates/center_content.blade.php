<div id="content" class="section direction">
    <div class="container-fluid">
        <div class="button-container">
            <button class="btn btn-main-bordered btn-round btn-lg" id="comp_msg" data-toggle="modal"
                    data-target="#all-users-modal-lg">
                <span>
                    {{app()->getLocale() == 'ar' ? 'ارسال رسالة': 'Compose Message'}}
                </span>
            </button>
            <a href="#" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="تابعنا هنا">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="تابعنا هنا">
                <i class="fab fa-instagram"></i>
            </a>
        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <div class="row">
                    @if(in_array('chat',(array)$allowed_ads))
                        @foreach($second_ratio as $ads)
                            @if($loop->iteration == 1)

                                <div class="col-md-4">
                                    <div style="position: absolute;z-index: 9;width: 30%;top: -20px;right: 0;">
                                        <img src="{{asset('assets/img/cron.png')}}" alt="">
                                        <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                            {{__('profile.ads')}}
                                        </h6>
                                    </div>
                                    <a href="{{$ads['link'] ?? '#'}}" target="_blank">
                                        <img src="{{$ads['third_image']}}" alt="">
                                    </a>
                                </div>

                            @endif
                            @if($loop->iteration == 2)

                                <div class="col-md-4">

                                    <div class="card card-blog card-plain card-body sprofile-float">
                                        <div class="card-image text-center">
                                            <a href="#">
                                                <img class="img img-responsive img-thumbnail rounded img-raised m-auto" width="60%"
                                                     src="{{$user->image_path ?? asset("assets/img/user_avatar.jpg")}}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="position: absolute;z-index: 9;width: 30%;top: -20px;right: 0;">
                                        <img src="{{asset('assets/img/cron.png')}}" alt="">
                                        <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                            {{__('profile.ads')}}
                                        </h6>
                                    </div>
                                    <a href="{{$ads['link'] ?? '#'}}" target="_blank">
                                        <img src="{{$ads['third_image']}}" alt="">
                                    </a>
                                </div>
                            @endif
                            @if($loop->iteration == 3)
                                @break
                            @endif

                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-3 text-left">
                @if(!in_array('chat',(array)$allowed_ads))
                    @include("pages.chat.templates.right_side")
                @endif
            </div>
            <div class="col-md-12 text-center mt-4">
                @include("pages.chat.templates.center_side")
            </div>

        </div>

    </div>

</div>