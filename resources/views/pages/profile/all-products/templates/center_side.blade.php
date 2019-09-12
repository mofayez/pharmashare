<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }

    @media only screen and (max-width: 600px) {
        .my-group .btn-main {
            max-width: 25% !important;
        }
    }
</style>
<div class="row" style="z-index: 9;position:relative;">
    <div class="col-md-12">
        <div class="card" style="margin-top: -140px">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-8">
                        <form action="">
                            <div class="input-group my-group">
                                <input type="text" class="form-control bg-white" name="query" autocomplete="off"
                                       value="{{app('request')->get('query')}}"
                                       placeholder="{{__('store.search_place')}}">
                                <select class="form-control" name="limit" style="height: 40px!important;padding: 5px;">
                                    <option value="5" {{request()->limit == 5 ? 'selected':''}}>5 per page</option>
                                    <option value="10" {{request()->limit == 10 ? 'selected':''}}>10 per page</option>
                                    <option value="50" {{request()->limit == 50 ? 'selected':''}}>50 per page</option>
                                    <option value="100" {{request()->limit == 100 ? 'selected':''}}>100 per page
                                    </option>
                                    <option value="500" {{request()->limit == 500 ? 'selected':''}}>500 per page
                                    </option>
                                    <option value="1000" {{request()->limit == 1000 ? 'selected':''}}>1000 per page
                                    </option>
                                </select>
                                <input type="hidden" name="page" value="{{request()->get('page') ?? 1}}">
                                <button class="btn btn-default btn-main m-0 form-control border-0"
                                        type="submit"> {{__('store.search')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                    <div class="col-md-2" style="position: absolute;right: 0;top: 0;">
                        <a href="{{route('getAddProductView')}}" class="btn btn-main">
                           {{app()->getLocale() == 'ar' ? 'اضافة منتج' : 'Add Product' }}
                        </a>
                    </div>
                <div class="col-md-12 table-scroll">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            {{--<th>باركود</th>--}}
                            <th>{{__('store.product_name')}}  </th>
                            <th>{{__('store.manufacturer')}}</th>
                            <th>{{__('store.strength')}}</th>
                            <th>{{__('store.origin')}}</th>
                            <th>{{__('store.packet_size')}}</th>
                            <th width="100">{{__('store.amount')}}</th>
                            <th width="100">{{__('store.cost')}}</th>
                            <th width="100">{{__('store.min_amount')}}</th>
                            <th>{{__('store.notes')}}</th>
                            {{--                            <th>{{__('store.date')}}</th>--}}
                            <th style="width: 50px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($all_drugs) == 0)
                            <tr>
                                <td colspan="11">
                                    {{app()->getLocale() == 'ar' ? 'ﻻ توجد بيانات ' : 'No Data'}}
                                </td>
                            </tr>
                        @endif
                        @foreach($all_drugs as $drug)
                            {{Form::open([
                                'method'=>'post',
                                'route'=>['getEditStoreView',$drug->id],
                            ])}}
                            <tr>
                                <td>00{{$drug->id}}</td>
                                {{--<td>{{$drug->drug->pharmashare_code}}</td>--}}
                                <td>
                                    {{$drug->drug->trade_name}}
                                    <br>
                                    ({{$drug->drug->drugCategory->title ?? ''}})
                                </td>
                                <td>{{$drug->drug->manufacturer}}</td>
                                <td>{{$drug->drug->strength}}</td>
                                <td>{{$drug->drug->active_ingredient}}</td>
                                <td>{{$drug->drug->pack_size}}</td>
                                <td class="position-relative">
                                    {{--<div class="input-group">--}}
                                    <input type="text" class="form-control" name="available_quantity_in_packs"
                                           autocomplete="off"
                                           value="{{$drug->available_quantity_in_packs}}">
                                    {{--<div class="input-group-append">--}}
                                    @if($drug->minimum_order_value_or_quantity > $drug->available_quantity_in_packs)
                                        <i class="text-danger fas fa-arrow-alt-circle-down"
                                           style="position: absolute;right: 10px;top: 43%;"></i>
                                    @else
                                        <i class="text-success fas fa-arrow-alt-circle-up"
                                           style="position: absolute;right: 10px;top: 43%;"></i>
                                    @endif

                                    {{--</div>--}}
                                    {{--</div>--}}
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="offered_price_or_bonus"
                                           autocomplete="off"
                                           value="{{$drug->offered_price_or_bonus}}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="minimum_order_value_or_quantity"
                                           autocomplete="off"
                                           value="{{$drug->minimum_order_value_or_quantity}}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="store_remarks"
                                           style="min-width: 120px" autocomplete="off"
                                           value="{{$drug->store_remarks}}">
                                </td>
                                {{--<td>{{$drug->updated_at}}</td>--}}
                                <td>
                                    <div class="btn-group direction">
                                        <button type="submit" class="btn btn-main p-2 pr-3 pl-3">
                                            {{app()->getLocale() == 'ar' ? 'تحديث':'Update'}}
                                        </button>
                                        <a href="{{route('getEditStoreView',['id'=>$drug->id])}}"
                                           class="btn btn-info p-2 pr-3 pl-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger p-2 pr-3 pl-3"
                                                onclick="remove('{{$drug->id}}');">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            {{Form::close()}}
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12">
                    {{$all_drugs->appends(request()->except('page'))->render('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>