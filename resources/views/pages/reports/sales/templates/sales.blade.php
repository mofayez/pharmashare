<div class="row">
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card card-blog card-plain card-body">
                <div class="row">
                    <div class="col-md-4 text-right">
                        <img src="{{$sale->store->image_path ? $sale->store->image_path : asset('assets/img/me.jpg')}}"
                             style="width: 180px" alt="">
                    </div>
                    <div class="col-md-8 text-left">
                        <h4>
                            {{app()->getLocale() == 'ar' ? 'عرض جميع المبيعات الحالية' : 'Show All Sales'}}
                        </h4>
                        <ul class="list-unstyled">
                            <li>
                                <h5 dir="rtl">
                                    {{app()->getLocale() == 'ar' ? 'اسم التاجر' : 'Store name'}}:
                                    <span>{{$sale->store->firstname . '  ' . $sale->store->lastname}}</span>
                                </h5>
                            </li>
                            <li>
                                <h5 dir="rtl">
                                    {{app()->getLocale() == 'ar' ? 'اسم العميل' : 'Pharmacy name'}}:
                                    <span>{{$sale->pharmacy->firstname . '  ' . $sale->pharmacy->lastname}}</span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    {{app()->getLocale() == 'ar' ? '  رقم هاتف الصيدلية ' : 'Pharmacy phone number'}}:
                                    <span dir="ltr">{{$sale->pharmacy->prefix . '-' . $sale->pharmacy->phone}}</span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    {{app()->getLocale() == 'ar' ? '  عنوان الصيدلية ' : 'Pharmacy Address'}}:
                                    <span dir="ltr">{{$sale->pharmacy->full_address}}</span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    {{app()->getLocale() == 'ar' ? 'التاريخ' : 'Date'}}:
                                    <span>{{$sale->created_at->format('Y-m-d')}} </span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    {{app()->getLocale() == 'ar' ? 'الحالة' : 'Status'}}:
                                    @if(app()->getLocale() == 'ar')
                                        <span>{{$sale->status->display_name_ar}} </span>
                                    @else
                                        <span>{{$sale->status->display_name_en}} </span>
                                    @endif
                                </h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12 direction">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{app()->getLocale() == 'ar' ? 'اسم  المنتج' : ' Product name '}}  </th>
                                <th>{{app()->getLocale() == 'ar' ? '  الكمية المطلوبة' : 'Amount'}}: </th>
                                <th>{{app()->getLocale() == 'ar' ? 'تكلفة الوحدة  ' : 'Unit Price'}}</th>
                                <th>{{app()->getLocale() == 'ar' ? 'الاجمالي' : '  Total'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sale->details as $detail)
                                <tr>
                                    <td>{{$detail->drugStore->id}}</td>
                                    <td>{{$detail->drugStore->drug->trade_name}}
                                        <br> 
                                        @php
                                            $discount = null;
                                            foreach(collect($detail->drugStore->FOC)->sortByDesc('foc_quantity') as $foc){ 
                                                if($detail->quantity >= $foc->foc_quantity){
                                                    $discount = $foc;
                                                    echo '<span class="text-danger">';
                                                    echo app()->getLocale() == 'ar' ? 'قيمة الخصم : ' . $foc->foc_discount .'%' : 'Discount Is :' . $foc->foc_discount .'%';
                                                    echo '</span>';
                                                    break;
                                                }
                                            }
                                        @endphp
                                    </td>
                                    <td>{{$detail->quantity}}</td>
                                    <td>{{$detail->drugStore->offered_price_or_bonus}}</td>
                                    <td>
                                        @if($discount)
                                            <del class="text-danger">{{$detail->drugStore->offered_price_or_bonus * $detail->quantity}}</del><br>
                                            {{($detail->drugStore->offered_price_or_bonus - ($detail->drugStore->offered_price_or_bonus * ($discount->foc_discount/100))) * $detail->quantity}}
                                        @else
                                            {{$detail->drugStore->offered_price_or_bonus * $detail->quantity}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    {{app()->getLocale() == 'ar' ? 'الاجمالي' : '  Total'}}  
                                </td>
                                <td class="bg-warning">
                                    {{$sale->total_cost}}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                     <div class="col-md-4">
                        {{app()->getLocale() == 'ar' ? ' هذه الاسعار غير شامله ضريبه المبيعات ' : 'Vat Not Included '}}  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>