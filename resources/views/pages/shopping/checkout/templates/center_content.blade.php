<div id="content" class="section direction">
    <div class="container-fluid">
        <div class="button-container" style="margin-top: -121px">
            <ul class="list-unstyled list-inline ">
                <li class="list-inline-item">
                    <div class="cart-path">
                        <h2 class="text_h2_gradient">1</h2>
                    </div>
                    <h4 class="mt-1">{{__('pharmacy.cart')}}  </h4>
                </li>
                <li class="list-inline-item">
                    <div class="cart-path">
                        <h2 class="text_h2_gradient">2</h2>
                    </div>
                    <h4 class="mt-1">  {{__('pharmacy.shipping')}}  </h4>
                </li>
                <li class="list-inline-item">
                    <div class="cart-path">
                        <h2 class="text_h2_gradient">3</h2>
                    </div>
                    <h4 class="mt-1 cart-active">{{__('pharmacy.checkout')}}   </h4>
                </li>
            </ul>
        </div>


        <div class="row mt-3">
            <div class="col-md-2 p-0">
                @if(in_array('checkout',(array)$allowed_ads))
                    @foreach($first_ratio as $item)
                        @if($loop->iteration == 2)
                            @break
                        @endif
                        @if($item['original_image'])
                            <div class="">
                                <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                                    <img src="{{asset('assets/img/cron.png')}}" alt="">
                                    <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                        {{__('profile.ads')}}
                                    </h6>
                                </div>
                                <a href="{{$item['link'] ?? '#'}}" target="_blank">
                                    <img src="{{$item['second_image']}}" alt="">
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="col-md-8 text-center mt-4">
                @include("pages.shopping.checkout.templates.center_side")
            </div>
            <div class="col-md-2 p-0">
                @if(in_array('checkout',(array)$allowed_ads))
                    @foreach(array_reverse($first_ratio,true) as $item)
                        @if($loop->iteration == 2)
                            @break
                        @endif
                        @if($item['original_image'])
                            <div class="p-0">
                                <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                                    <img src="{{asset('assets/img/cron.png')}}" alt="">
                                    <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                        {{__('profile.ads')}}
                                    </h6>
                                </div>
                                <a href="{{$item['link'] ?? '#'}}" target="_blank">
                                    <img src="{{$item['second_image']}}" alt="">
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>

    </div>

</div>