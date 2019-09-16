<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    .badge-success, .badge-success[href]:focus, .badge-success[href]:hover {
        border-color: #009688;
        background-color: #009688;
        color: #fff;
    }

    .btn-default {
        background-color: #979797;
    }

    legend {
        width: auto;
        margin: 0 5px;
        background: #fff;
        background: #5341b9;
        color: #FFF;
        border-radius: 26px;
    }
</style>

<div class="card">
    {{--<div style="background:url('{{asset('assets/img/backgrounds-vector-simple-4.png')}}') center center no-repeat;background-size: cover;position: absolute;width: 100%;height: 100%;z-index: 9"></div>--}}
    <div class="card card-blog card-plain card-body ">

        @if(!count($all_cart))
            <img src="{{asset('assets/img/empty-cart.png')}}" alt="">
            <h3>{{__('pharmacy.cart_null')}}</h3>
        @endif
        {{Form::open([
            'id'=>'form',
            'method'=>'post',
            'route'=>'submitCart'
        ])}}
        @foreach($all_cart as $cart_item)
            <fieldset class="mb-1 position-relative"
                      style="background: linear-gradient(to right, rgba(255, 255, 255, 0.74), rgb(255, 255, 255));border: 1px solid #666;z-index: 99">
                <legend class="text-left m-5 p-1" style="border: 1px solid #666">
                    <span> {{$cart_item['store']->firstname . $cart_item['store']->lastname}}  </span>
                </legend>
                <ul class="text-left list-unstyled ">
                    <li class="list-inline-item w-100">

                        <div class="p-3 pt-0 table-scroll ">
                            <table class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>{{__('pharmacy.product_name')}}</th>
                                    <th>{{__('pharmacy.status')}}</th>
                                    <th> {{__('pharmacy.cost')}}</th>
                                    <th> {{__('pharmacy.current_amount')}}</th>
                                    <th width="170px"> {{__('pharmacy.required_amount')}}  </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart_item['items'] as $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group direction">
                                                @if(count($item->FOC) > 0)
                                                    <button class="btn btn-info p-2" type="button" data-toggle="modal"
                                                            data-target="#all_discounts_modal"
                                                            data-discounts="{{json_encode($item->FOC)}}">
                                                        <i class="now-ui-icons business_bulb-63"></i>
                                                    </button>
                                                @endif
                                                <button class="btn btn-danger p-2" type="button"
                                                        onclick="removeItem('{{$item->id}}')">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <span>{{$item->drug->trade_name}}</span> <br>
                                            ({{$item->drug->drugCategory->title}})
                                        </td>
                                        <td>
                                            @if($item->available_quantity_in_packs)
                                                <label class="btn-success btn-simple"
                                                       style="font-size: 12px;padding: 3px;">{{__('pharmacy.available')}}</label>
                                                <br>
                                            @else
                                                <label class="btn-danger btn-simple"
                                                       style="font-size: 12px;padding: 3px;">{{__('pharmacy.out_stock')}}    </label>
                                                <br>
                                            @endif
                                            @if($item->isFeatured)
                                                <label class="btn-success btn-simple ads-flash"
                                                       style="font-size: 12px;padding: 3px;">{{__('pharmacy.ads')}}  </label>
                                            @endif
                                            @if(count($item->FOC) > 0)
                                                <label class="btn-info btn-simple" data-toggle="modal"
                                                       data-target="#all_discounts_modal"
                                                       data-discounts="{{json_encode($item->FOC)}}"
                                                       style="cursor:pointer;font-size: 12px;padding: 3px;">  {{__('pharmacy.discount')}}</label>
                                            @endif
                                            {{--btn-danger btn-simple p-1 mr-1 ml-1--}}
                                        </td>
                                        <td>
                                            {{$item->offered_price_or_bonus}}
                                        </td>
                                        <td>
                                            {{$item->available_quantity_in_packs}}
                                        </td>
                                        <td>
                                            <div class="input-group my-group direction">
                                                <button type="button"
                                                        class="btn m-0 form-control border-0 p-0 incr-btn @if($item->available_quantity_in_packs == 0) btn-default @else btn-main @endif">
                                                    <i class="now-ui-icons ui-1_simple-add"></i>
                                                </button>
                                                <input type="hidden" name="drug_store_id[]" value="{{$item->id}}">
                                                <input type="hidden" name="max_allowed[]"
                                                       value="{{$item->available_quantity_in_packs}}">
                                                <input type="number" class="form-control text-center bg-white"
                                                       name="count[]"
                                                       autocomplete="off"
                                                       @if($item->available_quantity_in_packs == 0)
                                                       value="0">
                                                @else
                                                    value="1">
                                                @endif
                                                <button type="button"
                                                        class="btn m-0 form-control border-0 p-0 decr-btn btn-default">
                                                    <i class="now-ui-icons ui-1_simple-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </fieldset>
        @endforeach
        @if(count($all_cart))
            <div class="text-center  m-auto">
                <button class="btn btn-main" type="submit">
                    {{__('pharmacy.submit_cart')}}
                    <i class="now-ui-icons shopping_bag-16"></i>
                </button>
                <button class="btn btn-danger" type="button" onclick="emptyCart()">
                    {{__('pharmacy.empty_cart')}}
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
            </div>
        @endif
        {{Form::close()}}
    </div>
</div>