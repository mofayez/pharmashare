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
    @if(count($my_orders) == 0)
        <div class="col-md-12 mt-5">
            <img src="{{asset('assets/img/empty-cart.png')}}" alt="">
            @if(app()->getLocale() == 'ar')
                <h4>ﻻ توجد طلبات</h4>
            @else
                <h4>No Orders</h4>
            @endif
        </div>
    @endif
    @foreach($my_orders  as $k => $order)
        <div class="col-md-12">
            <div class="card" style="min-height: 300px">
                <div class="card card-blog card-plain card-body">
                    <div class="row">
                        @if($loop->first)
                            <div class="col-md-12">
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="all"
                                               @if(!app('request')->get('status') || app('request')->get('status') == "all") checked="checked" @endif
                                        >
                                        <span class="form-check-sign"></span>
                                        {{__('pharmacy.all_status')}}
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="order"
                                               @if(app('request')->get('status') == 'order') checked="checked" @endif
                                        >
                                        <span class="form-check-sign"></span>
                                        {{__('pharmacy.new_status')}}
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="approved"
                                               @if(app('request')->get('status') == 'approved') checked="checked" @endif
                                        >
                                        <span class="form-check-sign"></span>
                                        {{__('pharmacy.accept_status')}}
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="rejected"
                                               @if(app('request')->get('status') == 'rejected') checked="checked" @endif
                                        >
                                        <span class="form-check-sign"></span>
                                        {{__('pharmacy.reject_status')}}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="row">
                                    @if(in_array('pharmacy_orders',(array)$allowed_ads))
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
                        @endif
                        <div class="col-6 text-left">
                            <h5 class="m-0">
                                {{__('pharmacy.order_no')}}:
                                <span dir="ltr">#{{$order->first()->id}}#</span>
                            </h5>
                            <h5 class="m-0">
                                {{__('pharmacy.total')}}  :
                                <span dir="ltr">
                                        {{$order->sum('total_cost')}}
                                </span>
                            </h5>
                        </div>
                        <div class="col-6 text-right">
                            <h5 class="m-0 mb-4">
                                {{__('pharmacy.date')}}:
                                <span>{{$order->first()->created_at->format('Y-m-d')}}</span>
                            </h5>
                        </div>

                        @foreach($order as $drug_store)
                            <div class="col-md-6 text-left">
                                <button class="btn btn-main" type="button" data-toggle="collapse"
                                        data-target="#collapseExample{{$drug_store->id}}" aria-expanded="false"
                                        aria-controls="collapseExample{{$drug_store->id}}">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                    {{__('pharmacy.store_name')}}:
                                    {{$drug_store->store->firstname . ' ' . $drug_store->store->lastname}}
                                </button>
                                @if(!$drug_store->store->blocked)
                                    <button class="btn btn-danger" onclick="block_store('{{$drug_store->store->id}}')"
                                            type="button">
                                        <i class="fas fa-user-lock"></i>
                                        {{__('pharmacy.block')}}
                                    </button>
                                @endif
                                <button class="btn btn-info" type="button" data-toggle="modal"
                                        data-store-id="{{$drug_store->store->id}}" data-target="#rates_modal">
                                    <i class="fas fa-star text-black"></i>
                                    {{__('pharmacy.rate')}}

                                </button>
                                <button class="btn btn-default"
                                        onclick="printreport('{{$drug_store->id}}','{{$drug_store->sale_number}}')">
                                    <i class="fas fa-print"></i>
                                </button>
                                @if($drug_store->store->blocked)
                                    <label class="badge badge-danger">{{__('pharmacy.blocked')}}</label>
                                @endif
                            </div>

                            <div class="col-md-6 text-right">
                                <ul>
                                    <li class="list-inline-item">
                                        <h4 class="m-0 mt-2">
                                            {{__('pharmacy.total')}}:
                                            <span>{{$drug_store->total_cost}}</span>
                                        </h4>
                                    </li>
                                    <li class="list-inline-item">
                                        @if($drug_store->status->title == 'order')
                                            <div class="bg-info mt-2 position-relative"
                                                 style="width:20px;height:20px;border-radius: 50%;top:5px"></div>
                                        @elseif($drug_store->status->title == 'approved')
                                            <div class="bg-success mt-2 position-relative"
                                                 style="width:20px;height:20px;border-radius: 50%;top:5px"></div>
                                        @else
                                            <div class="bg-danger mt-2 position-relative"
                                                 style="width:20px;height:20px;border-radius: 50%;top:5px"></div>
                                        @endif
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-12">
                                <div class="collapse" id="collapseExample{{$drug_store->id}}">
                                    <div class="cards card-bodys">
                                        <div class="row">
                                            <div class="col-md-12 table-scroll text-left">
                                                <h3 class="m-0 text_purple_gradient">{{__('pharmacy.store_items')}}</h3>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('pharmacy.product_name')}}</th>
                                                        <th>{{__('pharmacy.amount')}}</th>
                                                        <th>{{__('pharmacy.cost')}}</th>
                                                        <th>{{__('pharmacy.total')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $sum = 0;?>
                                                    @foreach($drug_store->details as $detail)
                                                        <tr>
                                                            <td>{{$detail->drugStore->drug->trade_name}}</td>
                                                            <td>{{$detail->quantity}}</td>
                                                            <td>{{$detail->drugStore->offered_price_or_bonus}}</td>
                                                            <td>{{$detail->drugStore->offered_price_or_bonus * $detail->quantity}}</td>
                                                        </tr>
                                                        <?php $sum += $detail->drugStore->offered_price_or_bonus * $detail->quantity;?>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="text-right">
                                                            <h4 class="m-0">{{__('pharmacy.total')}}</h4>
                                                        </td>
                                                        <td class="text-left text-danger">
                                                            {{$sum}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="text-right">
                                                            <h4 class="m-0">{{__('pharmacy.payment_type')}}  </h4>
                                                        </td>
                                                        <td class="text-left text-white bg-warning">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$drug_store->paymentType->display_name_ar}}
                                                            @else
                                                                {{$drug_store->paymentType->display_name_en}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="m-0">
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
