<style>
    .my-group input {
        height: 40px !important;
        max-width: 55% !important;
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
    .pagination {
        justify-content: center;
    }

    .form-check {
        display: inline-block;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-blog card-plain card-body">
                <div class="row">
                    <div class="col-md-8"> 
                            <div class="input-group my-group">
                                <input type="text" class="form-control bg-white" name="query" autocomplete="off"
                                       placeholder=" {{__('store.search_place')}} " value=" {{app('request')->get('query')}}">
                                <button class="btn btn-default btn-main m-0 form-control border-0"
                                        onclick="filter()">  {{__('store.search')}}
                                </button>  
                           </div>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control text-center" id="datarange" dir="ltr">
                    </div>
                    <div class="col-md-12">
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="all"
                                       @if(!app('request')->get('status') || app('request')->get('status') == "all") checked="checked" @endif
                                >
                                <span class="form-check-sign"></span>
                                {{__('store.all_status')}}
                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="order"
                                       @if(app('request')->get('status') == 'order') checked="checked" @endif
                                >
                                <span class="form-check-sign"></span>
                                {{__('store.new_status')}}
                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="approved"
                                       @if(app('request')->get('status') == 'approved') checked="checked" @endif
                                >
                                <span class="form-check-sign"></span>
                                {{__('store.accept_status')}}
                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="rejected"
                                       @if(app('request')->get('status') == 'rejected') checked="checked" @endif
                                >
                                <span class="form-check-sign"></span>
                                {{__('store.reject_status')}}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            @if(in_array('store_orders',(array)$allowed_ads))
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
                    <div class="col-md-12 text-left">
                        <h4>
                            {{__('store.orders')}}
                        </h4>
                    </div>
                    <div class="col-md-12 table-scroll">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('store.client')}}  </th>
                                <th>{{__('store.phone')}}  </th>
                                <th>{{app()->getLocale() =='ar' ? 'العنوان':'Location'}}  </th>
                                <th>{{__('store.total')}}  </th>
                                <th>{{__('store.date')}}</th>
                                <th>{{__('store.status')}}</th>
                                <th style="width: 100px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>#{{$order->id}}#</td>
                                    <td>{{$order['pharmacy']->firstname . ' ' . $order['pharmacy']->lastname}}</td>
                                    <td>{{$order['pharmacy']->phone}}</td>
                                    <td>{{$order['pharmacy']->location->geo_location ?? ''}}</td>
                                    <td>{{$order->total_cost}}</td>
                                    <td>{{$order->created_at->format('Y-m-d')}}</td>
                                    <td>
                                        @if($order->status->title == 'order')
                                            <label class="badge badge-info">
                                                @if(app()->getLocale() == 'ar')
                                                    {{$order->status->display_name_ar}}
                                                @else
                                                    {{$order->status->display_name_en}}
                                                @endif
                                            </label>
                                        @elseif($order->status->title == 'approved')
                                            <label class="badge badge-success">
                                                @if(app()->getLocale() == 'ar')
                                                    {{$order->status->display_name_ar}}
                                                @else
                                                    {{$order->status->display_name_en}}
                                                @endif
                                            </label>
                                        @else
                                            <label class="badge badge-danger">
                                                @if(app()->getLocale() == 'ar')
                                                    {{$order->status->display_name_ar}}
                                                @else
                                                    {{$order->status->display_name_en}}
                                                @endif
                                            </label>
                                        @endif
                                    </td>
                                    <td class="p-0">
                                        <div class="btn-group direction">
                                            <button class="btn btn-info" data-order-id="{{$order->id}}"
                                                    data-status="{{$order->status->title}}"
                                                    data-toggle="modal"
                                                    data-target="#showinfo_modal">
                                                {{__('store.show_details')}}
                                            </button>
                                            {{--@if($order->status->title != 'approved')--}}
                                            {{--<button class="btn btn-main" onclick="payment('{{$order->id}}');">دفع--}}
                                            {{--الطلب--}}
                                            {{--</button>--}}
                                            {{--@endif--}}
                                            <a href="{{route('getChatView')}}?user_id={{$order['pharmacy']->id}}"
                                               class="btn btn-main">
                                                <i class="now-ui-icons ui-1_send"></i>
                                            </a>
                                            <button class="btn btn-warning"
                                                    onclick="printreport('{{$order->id}}','{{$order->sale_number}}');">
                                                {{__('store.bill')}}
                                            </button>

                                            @if(!in_array($order['pharmacy']->id, auth()->user()->blockedPharmaciesIds()))
                                                <button class="btn btn-danger"
                                                        onclick="block_pharmacy('{{$order['pharmacy']->id}}');">
                                                    {{__('store.block')}}
                                                </button>
                                            @else
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            
                    <div class="col-md-12  justify-content-center">
                        {{$orders->links('vendor.pagination.bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>