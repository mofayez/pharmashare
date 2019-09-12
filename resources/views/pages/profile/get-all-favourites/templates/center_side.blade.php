<style>
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        white-space: pre;
    }
</style>
<div class="row" style="z-index: 9;position:relative;"> 
    <div class="col-md-12">
        <div class="card" style="margin-top: -140px">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-2"style="position: absolute;top: -62px;left: 0;">
                        <a href="{{route('getAddToFavouritesView')}}" class="btn btn-main">
                            {{app()->getLocale() == 'ar' ? 'اضافة الي المخزن' : 'Add To Store  '}} 
                        </a>
                    </div>
                    <div class="col-md-12 text-center" id="no_data" style="{{count($favourites) > 0 ? 'display:none': ''}}">
                        <img class="img-responsive" src="{{asset('assets/img/empty-cart.png')}}" alt="">
                        <h3>{{__('profile.no_data')}}</h3>
                    </div>  
                    @foreach($favourites as $favourite)
                        <div class="col-md-4" id="_{{$favourite->id}}">
                            <div class="card card-contact card-raised" style="min-height: 350px">
                                {{Form::open([
                                    'route'=>'submitFavourite',
                                    'method'=>'post',
                                    'class'=>'fav_form'
                                ])}}
                                <div class="card-header text-center">
                                    <h5 class="card-title">{{$favourite->drug->trade_name ?? '-'}}</h5>
                                    <h6 class="card-title">{{$favourite->drug->pharmashare_code ?? ''}}</h6>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class=" table-scroll">
                                                <table class="table table-bordered table-scroll">
                                                    <tr>
                                                        <td>{{__('store.origin')}}</td>
                                                        <td>{{__('store.manufacturer')}}</td>
                                                        <td>{{__('store.strength')}}</td>
                                                        <td>{{__('store.packet_size')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{$favourite->drug->active_ingredient}}</td>
                                                        <td>{{$favourite->drug->manufacturer}}</td>
                                                        <td>{{$favourite->drug->strength}}</td>
                                                        <td>{{$favourite->drug->pack_size}}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="pharmashare_code"
                                           value="{{$favourite->drug->pharmashare_code}}">
                                    <input type="hidden" name="fav_id" value="{{$favourite->id}}">
                                    <input type="hidden" name="form" value="{{$favourite->drug->form}}">
                                    <input type="hidden" name="trade_name" value="{{$favourite->drug->trade_name}}">
                                    <input type="hidden" name="pack_size" value="{{$favourite->drug->pack_size}}">
                                    <input type="hidden" name="active_ingredient"
                                           value="{{$favourite->drug->active_ingredient}}">
                                    <input type="hidden" name="manufacturer" value="{{$favourite->drug->manufacturer}}">
                                    <input type="hidden" name="strength" value="{{$favourite->drug->strength}}">

                                    <div class="row">
                                        <div class="col-md-4 text-left">
                                            <div class="form-group">
                                                <label>{{__('store.amount')}}</label>
                                                <input type="text" class="form-control"
                                                       name="available_quantity_in_packs"
                                                       placeholder="{{__('store.amount')}}">
                                                <span class="error_amount text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-left">
                                            <div class="form-group">
                                                <label>{{__('store.cost')}}</label>
                                                <input name="offered_price_or_bonus" type="text" class="form-control"
                                                       placeholder="{{__('store.cost')}}">
                                                <span class="error_cost text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-left">
                                            <div class="form-group">
                                                <label>{{__('store.min_amount')}}</label>
                                                <input name="minimum_order_value_or_quantity" type="text"
                                                       class="form-control"
                                                       placeholder="{{__('store.min_amount')}}">
                                                <span class="error_min_amount text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12 text-center">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-main btn-round pull-right">
                                                    {{app()->getLocale() == 'ar' ? 'تحديث' : 'Update'}}
                                                </button>
                                                <button type="button" class="btn btn-danger btn-round pull-right"
                                                        onclick="deleteFav('{{$favourite->id}}')">
                                                    {{app()->getLocale() == 'ar' ? 'الغاء' : 'Delete'}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{Form::close()}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>