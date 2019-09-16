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
                <div class="col-md-4">
                    {{Form::open([
                        'method'=>'post',
                        'route'=>'handleDefaultSettings'
                    ])}}
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        {{app()->getLocale() == 'ar' ? 'اقصي عدد طلبات' : 'Max Transaction Number'}}
                                    </h3>
                                    <label for="">{{app()->getLocale() == 'ar' ? 'اقصي عدد طلبات' : 'Max Transaction Number'}}</label>
                                    <input type="number" name="max_transaction_number" class="form-control" value="{{$settings->max_transaction_number ?? 0}}">
                                    @if($errors->has('max_transaction_number'))
                                        <span class="text-danger">{{$errors->first('max_transaction_number')}}</span>
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