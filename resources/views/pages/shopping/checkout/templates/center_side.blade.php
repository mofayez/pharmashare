<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }
</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="row">
            <div class="col-md-6 text-left">
                <fieldset>
                    <legend class="text_purple_gradient">{{__('pharmacy.client_info')}}   </legend>
                    <div class="row">
                        <div class="col-md-4 d-none d-md-block">
                            <img class="img img-responsive img-thumbnail rounded img-raised" width="100%"
                                 src="{{$user->image_path ?? asset("assets/img/user_avatar.jpg")}}">
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-capitalize m-0">{{$user->firstname . " " . $user->lastname}}</h4>
                            <h5 dir="ltr">{{"@".$user->username}}</h5>
                            <h6 dir="ltr">+({{$user->prefix}}) {{$user->phone}}</h6>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6 text-left">
                <fieldset>
                    <legend class="text_purple_gradient">{{__('pharmacy.shipping_info')}}     </legend>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-capitalize m-0">
                                {{__('pharmacy.shipping_type')}} :
                                @if($cart_before_save[0]['shipment'])
                                    @if($cart_before_save[0]['shipment'] == 'with')
                                        <span>{{__('pharmacy.with_shipping')}} </span>
                                    @else
                                        <span>{{__('pharmacy.without_shipping')}} </span>
                                    @endif
                                @endif
                            </h5>
                        </div>
                        <div class="col-md-12" style="overflow: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>{{__('pharmacy.store_name')}} </th>
                                    <th>{{__('pharmacy.total')}}   </th>
                                    <th>{{__('store.points')}}   </th>
                                    <th>{{__('pharmacy.payment_type')}}   </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart_before_save as $item)
                                    <tr>
                                        <td>{{$item['store']->firstname . " " . $item['store']->lastname}}
                                            <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#all_packages_modal"
                                                    onclick="redeemPoints('{{$item['store']->id}}','{{$item['total_points_with_pharmacy']}}')">{{app()->getLocale() == 'ar' ? 'خصومات' : 'redeem'}}</button>
                                        </td>
                                        <td>{{$item['total_store_cost']}}</td>
                                        <td>{{$item['total_points_with_pharmacy']}}</td>
                                        @if(app()->getLocale() == 'ar')
                                            <td>{{$item['choosed_payment']->display_name_ar}}</td>
                                        @else
                                            <td>{{$item['choosed_payment']->display_name_en}}</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 text-left">
                <fieldset>
                    <legend class="text_purple_gradient">{{__('pharmacy.cart')}}   </legend>
                    <div class="row">
                        <div class="col-md-12" style="overflow: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{__('pharmacy.product_name')}}   </th>
                                    <th>{{__('pharmacy.amount')}} </th>
                                    <th width="100px">{{__('pharmacy.cost')}}   </th>
                                    <th width="200px">{{__('pharmacy.store_name')}}   </th>
                                    <th>{{__('pharmacy.total')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total = 0;
                                $total_discount = 0;

                                ?>
                                @foreach($cart_before_save as $trader)
                                    @foreach($trader['items'] as $item)
                                        <tr>
                                            <td>
                                                {{$item->drug->trade_name}} <br>
                                                ({{$item->drug->drugCategory->title}})
                                                <br>
                                                @php
                                                    $discount = null;
                                                    foreach(collect($item->FOC)->sortByDesc('foc_quantity') as $foc){
                                                        if($item->quantity >= $foc->foc_quantity){
                                                            $discount = $foc;
                                                            echo '<span class="text-danger">';
                                                            echo app()->getLocale() == 'ar' ? 'قيمة الخصم : ' . $foc->foc_discount .'%' : 'Discount Is :' . $foc->foc_discount .'%';
                                                            echo '</span>';
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->offered_price_or_bonus}}</td>
                                            <td>{{$trader['store']->firstname . " " . $trader['store']->lastname}}</td>
                                            <td>
                                                @if($discount)
                                                    <del class="text-danger">{{$item->cost}}</del><br>
                                                    {{($item->cost - ($item->cost * ($discount->foc_discount/100)))}}
                                                @else
                                                    {{$item->cost}}
                                                @endif
                                            </td>
                                            <?php //$total += $discount ? ($item->cost - ($item->cost * ($discount->foc_discount / 100))) : $item->cost;?>
                                        </tr>
                                    @endforeach
                                    <?php $total += $trader['total_store_cost'];?>
                                    <?php $total_discount += $trader['total_store_discount'];?>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>
                                        {{__('pharmacy.total')}}
                                    </td>
                                    <td class="bg-warning">
                                        {{$total}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>
                                        {{__('store.discount')}}
                                    </td>
                                    <td class="bg-danger text-white">
                                        {{$total_discount}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>
                                        {{__('pharmacy.total_plus')}}
                                    </td>
                                    <td class="bg-warning">
                                        {{$total-$total_discount}}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="text-center  m-auto">
            {{Form::open([
                'id'=>'form',
                'method'=>'post',
                'route'=>'submitCheckout'
            ])}}
            <button class="btn btn-main" type="submit">
                {{__('pharmacy.submit_checkout')}}
            </button>
            {{Form::close()}}
            {{--<button class="btn btn-main" data-toggle="modal" data-target="#rates_modal">--}}
            {{--تقييم--}}
            {{--</button>--}}
        </div>
    </div>
</div>