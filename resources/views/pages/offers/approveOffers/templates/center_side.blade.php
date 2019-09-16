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
                                        {{__('admin.accept_image_ads')}}
                                    </h3>
                                </div>
                                <div class="col-md-12 table-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>{{__('admin.client')}}</th>
                                            <th>{{__('admin.package')}}</th>
                                            <th>{{__('admin.images')}}</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ads as $ad)
                                            @if($ad->created_by_admin)
                                                @continue
                                            @endif
                                            <tr>
                                                <td>{{$ad->user->firstname ?? ''}} {{ $ad->user->lastname ?? ''}}</td>
                                                <td>{{$ad->package->name ?? ''}} … {{$ad->package->price}}</td>
                                                <td>
                                                    @if($ad->original_image)
                                                        <a class="d-inline-block" data-fancybox="images"
                                                           href="{{$ad->original_image}}">
                                                            <img class="img-fluid" style="width: 100px;"
                                                                 src="{{$ad->original_image}}">
                                                        </a>
                                                    @endif
                                                    @if($ad->scaled_image)
                                                        <a class="d-inline-block" data-fancybox="images"
                                                           href="{{$ad->scaled_image}}">
                                                            <img class="img-fluid" style="width: 100px;"
                                                                 src="{{$ad->scaled_image}}">
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" dir="rtl">
                                                        @if($ad->approved)
                                                            <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                    onclick="reject('{{$ad->id}}')">
                                                                <i class="now-ui-icons ui-1_simple-remove"></i>
                                                            </button>
                                                        @endif
                                                        @if(!$ad->approved)
                                                            <button class="btn btn-main p-2 pl-3 pr-3"
                                                                    onclick="approve('{{$ad->id}}')">
                                                                <i class="now-ui-icons ui-1_check"></i>
                                                            </button>
                                                        @endif
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