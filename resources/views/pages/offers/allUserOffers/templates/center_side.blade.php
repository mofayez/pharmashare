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
                                        {{__('admin.my_ads')}}
                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                        @if($user->role_id == 2)
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#link1"
                                                   role="tablist">
                                                    {{__('admin.my_feature_ads')}}
                                                </a>
                                            </li>
                                        @endif
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#link2" role="tablist">
                                                {{__('admin.my_image_ads')}}
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-space">
                                        <div class="tab-pane" id="link1">

                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('admin.package')}}  </th>
                                                        <th>{{__('admin.drugs')}}</th>
                                                        <th>{{__('admin.start')}}</th>
                                                        <th>{{__('admin.end')}}</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($ads_features as $ads_feature)
                                                        <tr>
                                                            <td> {{$ads_feature->package->name}}</td>
                                                            <td> {{$ads_feature->package->min_number_of_drugs}}
                                                                : {{$ads_feature->package->max_number_of_drugs}}</td>
                                                            <td> {{ $ads_feature->created_at->format('Y-m-d') }}</td>
                                                            <td>{{$ads_feature->valid_until}}</td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    <a href=""
                                                                       class="btn btn-main p-2 pl-3 pr-3 disabled"
                                                                       disabled>
                                                                        {{__('admin.pay')}}
                                                                    </a>
                                                                    {{--                                                                    <a href="{{route('getViewFeatureAdsView',['id'=>$ads_feature->id])}}"--}}
                                                                    <a href="{{route('getViewFeatureAdsView',['id'=>$ads_feature->id])}}"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        {{__('admin.edit')}}
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <div id="accordion_{{$ads_feature->id}}" role="tablist"
                                                                     aria-multiselectable="true" class="card-collapse">
                                                                    <div class="card card-plain">
                                                                        <div class="card-header" role="tab"
                                                                             id="headingOne_{{$ads_feature->id}}">
                                                                            <a data-toggle="collapse"
                                                                               data-parent="#accordion"
                                                                               href="#collapse_{{$ads_feature->id}}"
                                                                               aria-expanded="false"
                                                                               aria-controls="collapseOne_{{$ads_feature->id}}"
                                                                               class="collapsed">
                                                                                <span dir="rtl">({{count($ads_feature->details)}})</span>
                                                                                {{__('admin.show_all_drugs')}}
                                                                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                                            </a>
                                                                        </div>

                                                                        <div id="collapse_{{$ads_feature->id}}"
                                                                             class="collapse" role="tabpanel"
                                                                             aria-labelledby="headingOne_{{$ads_feature->id}}"
                                                                             style="">
                                                                            <div class="card-body">
                                                                                <div class="row direction">
                                                                                    @foreach($ads_feature->details as $detail)
                                                                                        <div class="col-md-3 text-left">
                                                                                            <h5 class="m-0 p-0">{{$detail->drugStore->drug->trade_name ?? ''}}</h5>
                                                                                            <p class="p-0 m-0 text-info">{{$detail->drugStore->price ?? ''}}
                                                                                                <i class="fas fa-dollar-sign"></i>
                                                                                            </p>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane active" id="link2">

                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{__('admin.package')}}  </th>
                                                        <th>{{__('admin.admin_approve')}}</th>
                                                        <th>{{__('admin.payment')}}</th>
                                                        <th>{{__('admin.start')}}</th>
                                                        <th>{{__('admin.end')}}</th>
                                                        <th>{{__('admin.images')}}</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($ads_images as $ads_image)
                                                        <tr>
                                                            <td>{{$ads_image->package->name}}</td>
                                                            <td>{{$ads_image->approved ? 'تم التأكيد' : 'غير مؤكد'}}</td>
                                                            <td>{{$ads_image->paid_at ? \Carbon\Carbon::parse($ads_image->paid_at)->format('Y-m-d') : 'غير مدفوع'}}</td>
                                                            <td>{{$ads_image->created_at->format('Y-m-d')}}</td>
                                                            <td>{{$ads_image->valid_until}}</td>
                                                            <td>
                                                                @if($ads_image->original_image)
                                                                    <a class="d-inline-block" data-fancybox="images"
                                                                       href="{{$ads_image->original_image}}">
                                                                        <img class="img-fluid" style="width: 100px;"
                                                                             src="{{$ads_image->original_image}}">
                                                                    </a>
                                                                @endif
                                                                @if($ads_image->scaled_image)
                                                                    <a class="d-inline-block" data-fancybox="images"
                                                                       href="{{$ads_image->scaled_image}}">
                                                                        <img class="img-fluid" style="width: 100px;"
                                                                             src="{{$ads_image->scaled_image}}">
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    @if(!$ads_image->paid_at)
                                                                        <a href=""
                                                                           class="btn btn-main p-2 pl-3 pr-3 disabled"
                                                                           disabled="">
                                                                            {{__('admin.pay')}}
                                                                        </a>
                                                                    @endif
                                                                    @if($ads_image->open == 1)
                                                                        <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                                onclick="show_or_hide('{{$ads_image->id}}','0')">
                                                                            {{__('admin.stop')}}
                                                                        </button>
                                                                    @endif
                                                                    @if($ads_image->open == 0)
                                                                        <button class="btn btn-main p-2 pl-3 pr-3"
                                                                                onclick="show_or_hide('{{$ads_image->id}}','1')">
                                                                            {{__('admin.run')}}
                                                                        </button>
                                                                    @endif
                                                                    <a href="{{route('getViewImageAdsView',['id'=>$ads_image->id])}}"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        {{__('admin.edit')}}
                                                                    </a>
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