<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }

    .form-check {
        display: inline-block;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 300px">
            <div class="card card-blog card-plain card-body">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            @if(in_array('map',(array)$allowed_ads))
                                @foreach($second_ratio as $ads)

                                    @if($loop->iteration == 3)
                                        @break
                                    @endif

                                    @if($loop->iteration == 2)
                                        <div class="col-md-4">
                                        </div>
                                    @endif
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
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!--<div class="col-md-3">-->
                    <!--    <select class="select_types bg-white form-control" style="height: 56px;" name="types">-->
                    <!--        <option value="all" {{app('request')->get('type') == 'all' || !app('request')->get('type') ? 'selected' : ''}}>-->
                    <!--            {{app()->getLocale() == 'ar' ? 'الكل': 'All'}}-->
                    <!--        </option>-->
                    <!--        <option value="pharmacy" {{app('request')->get('type') == 'pharmacy' ? 'selected' : ''}}>-->
                    <!--            {{app()->getLocale() == 'ar' ? 'الصيدلي': 'Pharmacy'}}-->
                    <!--        </option>-->
                    <!--        <option value="store" {{app('request')->get('type') == 'store' ? 'selected' : ''}}>-->
                    <!--            {{app()->getLocale() == 'ar' ? 'المخزن': 'Store'}}-->
                    <!--        </option>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <div class="mt-2" id='map'></div>
                </div>
            </div>
        </div>
    </div>
</div>
