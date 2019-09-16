<style>
    .form-check .form-check-label {
        padding-left: 0px;
        padding-right: 35px;
    }

    .form-check .form-check-sign:after, .form-check .form-check-sign:before {
        right: 0;
        left: auto;
    }
</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.setting.navigators')
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            {{Form::open([
                                'route'=>'handleAdsControl',
                                'method'=>'post',
                            ])}}
                            <div class="row">

                                <div class="col-md-12 text-left">
                                    <h3>   {{__('settings.ads_control')}}  </h3>
                                </div>
                                @foreach($ads_controls as $control)
                                    <div class="col-md-3 text-left">

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="ads_controls[]"
                                                       @if($control->status)
                                                       checked=""
                                                       @endif
                                                       value="{{$control->title}}"
                                                       type="checkbox">
                                                <span class="form-check-sign"></span>
                                                @if(app()->getLocale() == 'ar')
                                                    {{$control->name_ar}}
                                                @else
                                                    {{$control->name_en}}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-main">{{__('settings.update')}}</button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>