<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }
</style>
<div class="row" style="position: relative;z-index: 9">
    <div class="col-md-12">
        <div class="card direction">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="false">
                            {{__('admin.edit_product_names')}}
                            <i class="now-ui-icons shopping_bag-16"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content text-center">
                    <div class="tab-pane active show" id="home" role="tabpanel">
                        {{Form::open([
                            'method'=>'post',
                            'route'=>['EditAdminPostNewProduct',$drug->id],
                        ])}}

                        <div class="row">
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>{{__('admin.product_category')}}  </label>
                                    <input type="typeahead"
                                           autocomplete="off" class="form-control typeahead" name="form"
                                           value="{{$drug->form}}">
                                </div>
                                @if($errors->has('form'))
                                    <span class="text-danger">{{$errors->first('form')}}</span>
                                @endif
                            </div>
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label>{{__('admin.product_name')}}</label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="trade_name"
                                           value="{{$drug->trade_name}}">
                                </div>
                                @if($errors->has('trade_name'))
                                    <span class="text-danger">{{$errors->first('trade_name')}}</span>
                                @endif
                            </div>
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label>{{__('admin.bar_code')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="pharmashare_code"
                                           value="{{$drug->pharmashare_code}}">
                                </div>
                                @if($errors->has('pharmashare_code'))
                                    <span class="text-danger">{{$errors->first('pharmashare_code')}}</span>
                                @endif
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>  {{__('admin.packet_size')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="pack_size" value="{{$drug->pack_size}}">
                                </div>
                                @if($errors->has('pack_size'))
                                    <span class="text-danger">{{$errors->first('pack_size')}}</span>
                                @endif
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>{{__('admin.origin')}}   </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="active_ingredient"
                                           value="{{$drug->active_ingredient}}">
                                </div>
                                @if($errors->has('active_ingredient'))
                                    <span class="text-danger">{{$errors->first('active_ingredient')}}</span>
                                @endif
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label> {{__('admin.manufacturer')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="manufacturer"
                                           value="{{$drug->manufacturer}}">
                                </div>
                                @if($errors->has('manufacturer'))
                                    <span class="text-danger">{{$errors->first('manufacturer')}}</span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> {{app()->getLocale() == 'ar' ? 'سعر البيع' : 'Pharmacy Price'}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="pharmacy_price_aed"
                                           value="{{$drug->pharmacy_price_aed}}">
                                </div>
                                @if($errors->has('pharmacy_price_aed'))
                                    <span class="text-danger">{{$errors->first('pharmacy_price_aed')}}</span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> {{app()->getLocale() == 'ar' ? 'سعر الجمهور' : 'public Price'}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="public_price_aed"
                                           value="{{$drug->public_price_aed}}">
                                </div>
                                @if($errors->has('public_price_aed'))
                                    <span class="text-danger">{{$errors->first('public_price_aed')}}</span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label>{{__('admin.strength')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="strength" value="{{$drug->strength}}">
                                </div>
                                @if($errors->has('strength'))
                                    <span class="text-danger">{{$errors->first('strength')}}</span>
                                @endif
                            </div>

                            <div class="text-center col-md-12  m-auto">
                                <button class="btn btn-main">
                                    {{__('admin.update')}}
                                </button>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>