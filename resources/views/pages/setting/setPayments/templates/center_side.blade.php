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
                <div class="col-md-5">
                    {{Form::open([
                        'method'=>'post',
                        'route'=>'setPaymentTypes'
                    ])}}
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        {{__('settings.update_payments')}}
                                    </h3>
                                    @foreach($payments as $payment)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="payment_types_ids[]"
                                                       value="{{$payment->id}}"
                                                       @if(in_array($payment->id , $current_payments))
                                                       checked=""
                                                       @endif
                                                       type="checkbox">
                                                <span class="form-check-sign"></span>
                                                @if(app()->getLocale() == 'ar')
                                                    {{$payment->display_name_ar}}
                                                @else
                                                    {{$payment->display_name_en}}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center  m-auto">
                        <button class="btn btn-main">
                            {{__('settings.update')}}
                        </button>
                    </div>
                    {{Form::close()}}
                </div>
                <div class="col-md-4">
                    {{Form::open([
                        'method'=>'post',
                        'route'=>'setMinOrderPricing'
                    ])}}
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        {{__('settings.update_pricing')}}
                                    </h3>
                                    <label for="">{{__('settings.update_pricing')}}</label>
                                    <input type="number" name="min_order_price" class="form-control" value="{{$store_setting->min_order_price ?? 0}}">
                                    @if($errors->has('min_order_price'))
                                        <span class="text-danger">{{$errors->first('min_order_price')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center  m-auto">
                        <button class="btn btn-main">
                            {{__('settings.update')}}
                        </button>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>