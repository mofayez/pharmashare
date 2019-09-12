<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    @include('pages.offers.navigators')
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        {{__('admin.packages')}}
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist">
                                                {{__('admin.ads_feature_packages')}}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#link2" role="tablist">
                                                {{__('admin.ads_image_packages')}}
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-space">
                                        <div class="tab-pane active" id="link1">

                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>  {{__('admin.package')}}</th>
                                                        <th>{{__('admin.drugs')}}</th>
                                                        <th>{{__('admin.price')}}</th>
                                                        <th>{{__('admin.days')}}</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($packages as $package)
                                                        <tr>
                                                            <td>{{$package->name}}</td>
                                                            <td>{{$package->min_number_of_drugs .' : '. $package->max_number_of_drugs}}</td>
                                                            <td>{{$package->price}}</td>
                                                            <td>{{$package->period_in_days}}</td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    <a href="{{route('getEditOfferPackagesView',['id'=>$package->id])}}"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        {{__('admin.edit')}}
                                                                    </a>
                                                                    <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                            onclick="deleteAdsPackage('{{$package->id}}')">
                                                                        {{__('admin.delete')}}
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="link2">
                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th> {{__('admin.ads_type')}}</th>
                                                        <th>{{__('admin.price')}}</th>
                                                        <th>{{__('admin.period')}}</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($image_packages as $image_package)
                                                        <tr>
                                                            <td>{{$image_package->name}}</td>
                                                            <td>{{$image_package->price}}</td>
                                                            <td>{{$image_package->period_in_days}}</td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    <a href="{{route('getEditOfferImagePackagesView',['id'=>$image_package->id])}}"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        {{__('admin.edit')}}
                                                                    </a>
                                                                    <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                            onclick="deleteAdsImagePackage('{{$image_package->id}}')">
                                                                        {{__('admin.delete')}}
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>