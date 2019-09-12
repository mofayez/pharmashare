<style>
    .form-check .form-check-label {
        padding-left: 0px;
        padding-right: 35px;
    }

    .form-check .form-check-sign:after, .form-check .form-check-sign:before {
        right: 0;
        left: auto;
    }
</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.setting.navigators')
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">

                                @if(count($blocked_stores->blockedStores) == 0)
                                    <div class="col-md-12 text-center">
                                        <img class="img-responsive" src="{{asset('assets/img/empty-cart.png')}}" alt="">
                                        <h3> {{__('profile.no_data')}} </h3>
                                    </div>
                                @else

                                    <div class="col-md-12 text-left">
                                        <h3> {{__('settings.black_list')}} </h3>
                                    </div>
                                    <div class="col-md-12 table-scroll">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th> {{__('auth.username')}} </th>
                                                <th> {{__('auth.phone')}}   </th>
                                                <th width="100px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($blocked_stores->blockedStores as $store)
                                                <tr>
                                                    <td>
                                                        {{$store->store->firstname . ' ' . $store->store->lastname}}
                                                    </td>
                                                    <td dir="ltr">
                                                        {{$store->store->prefix . '-' . $store->store->phone}}
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-warning"
                                                                onclick="unblock('{{$store->store->id}}')">
                                                            {{__('settings.unblock')}}
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>