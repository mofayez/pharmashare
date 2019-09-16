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

        {{Form::open([
            'id'=>'form',
            'method'=>'post',
            'route'=>'submitPayment'
        ])}}

        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group">
                    <label> {{__('pharmacy.shipping_type')}}   </label>
                    <select name="shipment" class="form-control p-1">
                        <option value="with"> {{__('pharmacy.with_shipping')}}     </option>
                        <option value="without"> {{__('pharmacy.with_out_shipping')}}   </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-12 text-left">
                <label>{{__('pharmacy.payment_type')}}    </label>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            {{__('pharmacy.store_name')}}
                        </th>
                        <th>
                            {{__('pharmacy.total')}}
                        </th>
                        <th>
                            {{__('pharmacy.payment_type')}}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                     @if(count($all_payments) == 0)
                     <tr>
                         <td colspan="3">
                             {{app()->getLocale() == 'ar' ? 'ﻻ توجد بيانات لشرائك منتجات غير متوفرة' : 'no data'}}
                         </td>
                     </tr>
                     @endif
                    @foreach($all_payments as $payment)
                        <tr>
                            <td>
                                {{$payment['store']->firstname . " " .  $payment['store']->lastname }}
                            </td>
                            <td>
                                <input type="hidden" name="store_id[]" value="{{$payment['store']->id}}">
                                {{$payment['total_store_cost']}}
                            </td>
                            <td>
                                <select name="choosed_payments[]" class="form-control p-1">
                                    @foreach($payment['store']->paymentTypes as $type)
                                        <option value="{{$type->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$type->display_name_ar}}
                                            @else
                                                {{$type->display_name_en}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if(count($all_payments) != 0)
        <div class="text-center  m-auto">
            <button class="btn btn-main" type="submit">
                {{__('pharmacy.submit_shipping')}}
            </button>
        </div>
        @endif
        {{Form::close()}}
    </div>
</div>