<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 267px;">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-6 offset-md-2">
                        <form action="" class="form-inline mb-2">
                            <input type="text" class="form-control text-center bg-white typeahead" name="query"
                                   autocomplete="off"
                                   style="width:65%"
                                   value="{{request()->get('query')}}"
                                   placeholder="{{__('pharmacy.search_place')}}"/>
                            <div class="mb-2"></div>
                            <select class="form-control" name="limit">
                                <option value="5" {{request()->limit == 5 ? 'selected':''}}>5 per page</option>
                                <option value="10" {{request()->limit == 10 ? 'selected':''}}>10 per page</option>
                                <option value="50" {{request()->limit == 50 ? 'selected':''}}>50 per page</option>
                                <option value="100" {{request()->limit == 100 ? 'selected':''}}>100 per page</option>
                                <option value="500" {{request()->limit == 500 ? 'selected':''}}>500 per page</option>
                                <option value="1000" {{request()->limit == 1000 ? 'selected':''}}>1000 per page</option>
                            </select>
                            <input type="hidden" name="page" value="{{request()->get('page') ?? 1}}">
                            <button type="submit" class="btn btn-main   btn-round">
                                <i class="now-ui-icons ui-1_check"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 table-scroll">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin.bar_code')}}</th>
                            <th>{{__('admin.product_name')}}</th>
                            <th>{{__('admin.product_category')}}</th>
                            <th>{{__('admin.origin')}}</th>
                            <th>{{__('admin.manufacturer')}}</th>
                            <th>{{__('admin.strength')}}</th>
                            <th>{{__('admin.packet_size')}}</th>
                            <th width="80px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($drugs)==0)
                            <tr>
                                <td colspan="12">{{__('admin.no_data')}}</td>
                            </tr>
                        @endif
                        @foreach($drugs as $drug)
                            <tr>
                                <td>00{{$drug->id}}</td>
                                <td>{{$drug->pharmashare_code}}</td>
                                <td>{{$drug->trade_name}}</td>
                                <td>{{$drug->drugCategory->title ?? ''}}</td>
                                <td>{{$drug->active_ingredient}}</td>
                                <td>{{$drug->manufacturer}}</td>
                                <td>{{$drug->strength}}</td>
                                <td>{{$drug->pack_size}}</td>
                                <td>
                                    <div class="btn-group direction">
                                        <a href="{{route('getAdminEditProductView',['id'=>$drug->id])}}"
                                           class="btn btn-main p-2 pl-3 pr-3">
                                            {{__('settings.update')}}
                                        </a>
                                        <button class="btn btn-danger p-2 pr-3 pl-3"
                                                onclick="removeItem('{{$drug->id}}')">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12">
                    {{$drugs->appends(request()->except('page'))->render('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>