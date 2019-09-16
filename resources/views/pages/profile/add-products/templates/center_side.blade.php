<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }

    .input-append.date .add-on, .input-prepend.date .add-on {
        cursor: pointer
    }

    .input-append.date .add-on i, .input-prepend.date .add-on i {
        margin-top: 3px
    }

    .input-daterange input {
        text-align: center
    }

    .input-daterange input:first-child {
        border-radius: 3px 0 0 3px
    }

    .input-daterange input:last-child {
        border-radius: 0 3px 3px 0
    }

    .input-daterange
</style>
<div class="row" style="position: relative;z-index: 9">
    <div class="col-md-12">
        <div class="card direction">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="false">
                            {{__('store.add_one_product')}}
                            <i class="now-ui-icons shopping_bag-16"></i>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link " data-toggle="tab" href="#profile" role="tab"-->
                    <!--       aria-selected="true">-->
                    <!--        {{__('store.upload_csv_sheet')}}-->
                    <!--        <i class="now-ui-icons arrows-1_cloud-upload-94"></i>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('getAddToFavouritesView')}}">
                            {{__('store.name_first')}}
                            <i class="now-ui-icons ui-2_favourite-28"></i>
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
                            'route'=>'addPostNewProduct',
                        ])}}
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-left m-0 text_purple_gradient">{{__('store.main_info')}}  </h3>
                                <hr class="mt-0">
                            </div>
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label>{{__('store.bar_code')}} </label>
                                    <input type="text" class="form-control typeahead"
                                           id="typeahead_barcode" autocomplete="off" name="pharmashare_code"
                                           value="{{old('pharmashare_code')}}">
                                </div>
                                @if($errors->has('pharmashare_code'))
                                    <span class="text-danger">{{$errors->first('pharmashare_code')}}</span>
                                @endif
                            </div>
                            <!--<div class="col-md-3 text-left">-->
                            <!--    <div class="form-group">-->
                            <!--        <label>{{__('store.product_category')}}  </label>-->
                            <!--        <input type="typeahead"-->
                            <!--               autocomplete="off" id="typeahead_category" class="form-control typeahead"-->
                            <!--               name="form"-->
                            <!--               value="{{old('form')}}">-->
                            <!--    </div>-->
                            <!--    @if($errors->has('form'))-->
                            <!--        <span class="text-danger">{{$errors->first('form')}}</span>-->
                            <!--    @endif-->
                            <!--</div>-->
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label>{{__('store.product_name')}}  </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="trade_name"
                                           value="{{old('trade_name')}}">
                                </div>
                                @if($errors->has('trade_name'))
                                    <span class="text-danger">{{$errors->first('trade_name')}}</span>
                                @endif
                            </div>
                            <div class="col-md-4 text-left"></div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>{{__('store.packet_size')}}   </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="pack_size" value="{{old('pack_size')}}">
                                </div>
                                @if($errors->has('pack_size'))
                                    <span class="text-danger">{{$errors->first('pack_size')}}</span>
                                @endif
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label> {{__('store.origin')}}   </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="active_ingredient"
                                           value="{{old('active_ingredient')}}">
                                </div>
                                @if($errors->has('active_ingredient'))
                                    <span class="text-danger">{{$errors->first('active_ingredient')}}</span>
                                @endif
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label> {{__('store.manufacturer')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="manufacturer"
                                           value="{{old('manufacturer')}}">
                                </div>
                                @if($errors->has('manufacturer'))
                                    <span class="text-danger">{{$errors->first('manufacturer')}}</span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label>{{__('store.strength')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="strength" value="{{old('strength')}}">
                                </div>
                                @if($errors->has('strength'))
                                    <span class="text-danger">{{$errors->first('strength')}}</span>
                                @endif
                            </div>

                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> {{__('store.amount')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="available_quantity_in_packs"
                                           value="{{old('available_quantity_in_packs')}}">
                                </div>
                                @if($errors->has('available_quantity_in_packs'))
                                    <span class="text-danger">{{$errors->first('available_quantity_in_packs')}}</span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> {{__('store.cost')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="offered_price_or_bonus"
                                           value="{{old('offered_price_or_bonus')}}">
                                </div>
                                @if($errors->has('offered_price_or_bonus'))
                                    <span class="text-danger">{{$errors->first('offered_price_or_bonus')}}</span>
                                @endif
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label>{{__('store.min_amount')}}</label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="minimum_order_value_or_quantity"
                                           value="{{old('minimum_order_value_or_quantity')}}">
                                </div>
                                @if($errors->has('minimum_order_value_or_quantity'))
                                    <span class="text-danger">{{$errors->first('minimum_order_value_or_quantity')}}</span>
                                @endif
                            </div>

                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> {{app()->getLocale() == 'ar' ? 'سعر الشراء' : 'Pharmacy Price'}} </label>
                                    <h5 class="m-0" id="pharmacy_ead">0</h5>
                                </div>
                            </div>

                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> {{app()->getLocale() == 'ar' ? 'سعر الجمهور' : 'public Price'}} </label>
                                    <h5 class="m-0" id="public_ead">0</h5>
                                </div>
                            </div>
                            <div class="col-md-12 text-left">
                                <div class="form-group">
                                    <label> {{__('store.notes')}} </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="store_remarks"
                                           value="{{old('store_remarks')}}">
                                </div>
                                @if($errors->has('store_remarks'))
                                    <span class="text-danger">{{$errors->first('store_remarks')}}</span>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <h3 class="text-left m-0 text_purple_gradient">{{__('store.discount_info')}}</h3>
                                <div class="table-scroll">
                                    <table class="table" id="discount_table">
                                        <thead>
                                        <tr>
                                            <td width="10px">
                                                <button type="button" id="add_button" class="btn btn-info">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </td>
                                            <td>{{__('store.amount_request')}}</td>
                                            <td>{{__('store.discount_calc')}}</td>
                                            <td>{{__('store.points')}}</td>
                                            <td>{{__('store.active')}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-center col-md-12  m-auto">
                                <button class="btn btn-main">
                                    {{__('store.add')}}
                                </button>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <a href="{{route('api.getDefaultDrugsSheet')}}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                            Download CSV Sheet
                        </a>
                        {{Form::open([
                            'method'=>'post',
                            'route'=>'addPostProductSheet',
                            'enctype'=>'multipart/form-data'
                        ])}}

                        <input type="file" name="drugsxlsx">
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>