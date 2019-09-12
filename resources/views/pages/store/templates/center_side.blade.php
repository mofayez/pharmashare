<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-blog card-plain card-body pt-0">
                <div class="card-body bg-white mr-2 ml-2">
                    <button id="toggle_bars" class="btn btn-main p-2 d-none d-md-block float-right">
                        <i class="fas fa-filter"></i>
                        {{__('pharmacy.filter')}}
                    </button>
                    <h4 class="text-left text_purple_gradient">{{__('pharmacy.show_products')}}</h4>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>

                            <th></th>
                            <th width="35%">{{__('pharmacy.product_name')}}</th>
                            <th>{{__('pharmacy.cost')}}</th>
                            <th>{{__('pharmacy.manufacturer')}}</th>
                            <th>{{__('pharmacy.origin')}}</th>
                            <th>{{__('pharmacy.store_name')}}</th>
                            <th>{{__('pharmacy.strength')}}</th>
                            <th>{{__('pharmacy.packet_size')}}</th>
                            <th>{{__('pharmacy.rate')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="row">
                        @if(in_array('shopping',(array)$allowed_ads))
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
            </div>
        </div>
    </div>
</div>
