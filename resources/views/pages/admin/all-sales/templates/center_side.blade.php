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
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 267px;">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-8 offsets-md-2">
                        <form action="" class="form-inline mb-2">
                            <input type="text" class="form-control text-center bg-white typeahead" name="query"
                                   autocomplete="off"
                                   style="width:65%"
                                   value="{{request()->get('query')}}"
                                   placeholder="{{__('pharmacy.search_place')}}"/>
                            <!--<div class="mb-2"></div>-->
                            <select class="form-control" name="limit">
                                <option value="1" {{request()->limit == 1 ? 'selected':''}}>1 per page</option>
                                <option value="5" {{request()->limit == 5 ? 'selected':''}}>5 per page</option>
                                <option value="10" {{request()->limit == 10 ? 'selected':''}}>10 per page</option>
                                <option value="50" {{request()->limit == 50 ? 'selected':''}}>50 per page</option>
                                <option value="100" {{request()->limit == 100 ? 'selected':''}}>100 per page</option>
                                <option value="500" {{request()->limit == 500 ? 'selected':''}}>500 per page</option>
                                <option value="1000" {{request()->limit == 1000 ? 'selected':''}}>1000 per page</option>
                            </select>
                            <input type="hidden" name="page" value="{{request()->get('page') ?? 1}}">
                            <button type="submit" class="btn btn-main   btn-round">
                                <i class="now-ui-icons ui-1_check"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 table-scroll">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Serial</th>
                            <th>{{__('admin.status')}}</th>
                            <th>Store</th>
                            <th>Pharmacy</th>
                            <th>{{__('admin.payment')}}</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($orders)==0)
                            <tr>
                                <td colspan="12">{{__('admin.no_data')}}</td>
                            </tr>
                        @endif
                        @foreach($orders as $order)
                            <tr>
                                <td>00{{$order->id}}</td>
                                <td>#{{$order->sale_number}}</td> 
                                <td>{{$order->status->title ?? ''}}</td>
                                <td>{{$order->store->firstname ?? ''}} {{$order->store->lastname ?? ''}}</td>
                                <td>{{$order->pharmacy->firstname ?? ''}} {{$order->pharmacy->lastname ?? ''}}</td>
                                <td>{{$order->paymentType->display_name_en ?? ''}}</td>
                                <td>{{$order->total_cost}}</td> 
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <button class="btn btn-info" data-order-id="{{$order->id}}"
                                            data-store-id="{{$order->store->id}}" 
                                            data-status="{{$order->status->title}}"
                                            data-toggle="modal"
                                            data-target="#showinfo_modal">
                                        {{__('store.show_details')}}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12">
                    {{$orders->appends(request()->except('page'))->render('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>