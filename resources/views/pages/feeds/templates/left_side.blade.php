<div class="row d-none d-md-block">
    {{--<div class="col-md-12">--}}
    {{--<div class="card card-plain">--}}
    {{--<div class="card card-blog card-plain card-body pt-0">--}}
    {{--<div class="card-body bg-white mr-2 ml-2">--}}
    {{--<h4 class="text-left">{{__('profile.online_users')}}</h4>--}}
    {{--<div class="media-body direction" id="current_online_users">--}}


    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    @if(in_array('feeds',(array)$allowed_ads))
        @foreach($first_ratio as $item)
            @if($loop->index % 2 != 0)
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