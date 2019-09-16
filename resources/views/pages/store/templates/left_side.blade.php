<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card card-blog card-plain card-body pt-0">
                <div class="card-body bg-white mr-2 ml-2">
                    <h4 class="text-left text_purple_gradient">{{__('pharmacy.filter')}}  </h4>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <label class=" float-left">  {{__('pharmacy.product_name')}} </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="1"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left">{{__('pharmacy.cost')}} </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="2"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"> {{__('pharmacy.manufacturer')}} </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="3"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left">{{__('pharmacy.origin')}}    </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="4"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left">  {{__('pharmacy.store_name')}}  </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="5" checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left">{{__('pharmacy.strength')}} </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="6" checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left">{{__('pharmacy.packet_size')}}   </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="7" checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left">{{__('pharmacy.rate')}} </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="8" checked/>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  {{__('pharmacy.price_avg')}}
                                (<span id="pricefrom"></span> - <span id="priceto"></span>)
                            </label>
                            <div id="sliderPrice" class="slider slider-warning"></div>
                            <br>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>{{__('pharmacy.location_avg')}}
                                (<span id="locationupto"></span>)  {{__('pharmacy.km')}}
                            </label>
                            <div id="sliderLocation" class="slider slider-info"></div>
                            <br>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>{{__('pharmacy.origin')}}</label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block" dir="ltr"
                                    data-size="7" name="active_ingredient">
                                <option value="0">All</option>
                                @foreach($active_ingredients as $active_ingredient)
                                    <option value="{{$active_ingredient->active_ingredient}}">{{$active_ingredient->active_ingredient}}</option>
                                @endforeach
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>{{__('pharmacy.manufacturer')}}</label>
                            <select class="selectpicker" name="manufacturer" data-style="btn btn-main btn-round btn-block"
                                    dir="ltr"
                                    data-size="7" name="manufacturer">
                                <option value="0">All</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{$manufacturer->manufacturer}}">{{$manufacturer->manufacturer}}</option>
                                @endforeach
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>{{__('pharmacy.strength')}} </label>
                            <select class="selectpicker" name="strength" data-style="btn btn-main btn-round btn-block"
                                    dir="ltr"
                                    data-size="7">
                                {{--<select class="form-control selectpicker" >--}}
                                <option value="0">All</option>
                                @foreach($strengths as $strength)
                                    <option value="{{$strength->strength}}">{{$strength->strength}}</option>
                                @endforeach
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  {{__('pharmacy.payment_type')}} </label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block"
                                    data-size="7" name="payment_type" dir="ltr">
                                <option value="0">All</option>
                                @if(app()->getLocale() == 'ar')
                                    <option value="1">الدفع عن التوصيل</option>
                                    <option value="2">دفع مؤجل</option>
                                @else
                                    <option value="1">Cash on delivery</option>
                                    <option value="2">Delayed check</option>
                                @endif
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  {{app()->getLocale() == 'ar' ? 'بها اعلان ممول' : 'Is Featured'}} </label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block"
                                    data-size="8" name="is_featured" dir="ltr">
                                @if(app()->getLocale() == 'ar')
                                    <option value="0">  الكل  </option>
                                    <option value="1">اعلان ممول  </option>
                                @else
                                    <option value="0">  All </option>
                                    <option value="1">Is Featured</option>
                                @endif
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  {{app()->getLocale() == 'ar' ? 'بها خصومات' : 'Has Discount'}} </label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block"
                                    data-size="7" name="foc" dir="ltr"> 
                                @if(app()->getLocale() == 'ar')
                                    <option value="0">   الكل  </option>
                                    <option value="1">بها خصومات  </option>
                                @else
                                    <option value="0">All</option>
                                    <option value="1">Has Discount</option>
                                @endif
                            </select>
                            <hr>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-main" onclick="updateTable()">{{__('pharmacy.filter')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>