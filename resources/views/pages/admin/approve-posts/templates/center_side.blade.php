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
                        {{--                        <form action="" class="form-inline mb-2">--}}
                        {{--                            <input type="text" class="form-control text-center bg-white typeahead" name="query"--}}
                        {{--                                   autocomplete="off"--}}
                        {{--                                   style="width:65%"--}}
                        {{--                                   value="{{request()->get('query')}}"--}}
                        {{--                                   placeholder="{{__('pharmacy.search_place')}}"/>--}}
                        {{--                            <div class="mb-2"></div>--}}
                        {{--                            <select class="form-control" name="limit">--}}
                        {{--                                <option value="5" {{request()->limit == 5 ? 'selected':''}}>5 per page</option>--}}
                        {{--                                <option value="10" {{request()->limit == 10 ? 'selected':''}}>10 per page</option>--}}
                        {{--                                <option value="50" {{request()->limit == 50 ? 'selected':''}}>50 per page</option>--}}
                        {{--                                <option value="100" {{request()->limit == 100 ? 'selected':''}}>100 per page</option>--}}
                        {{--                                <option value="500" {{request()->limit == 500 ? 'selected':''}}>500 per page</option>--}}
                        {{--                                <option value="1000" {{request()->limit == 1000 ? 'selected':''}}>1000 per page</option>--}}
                        {{--                            </select>--}}
                        {{--                            <input type="hidden" name="page" value="{{request()->get('page') ?? 1}}">--}}
                        {{--                            <button type="submit" class="btn btn-main   btn-round">--}}
                        {{--                                <i class="now-ui-icons ui-1_check"></i>--}}
                        {{--                            </button>--}}
                        {{--                        </form>--}}
                    </div>
                </div>
                <div class="col-md-12 table-scroll">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{app()->getLocale() == 'ar' ? 'نوع المنشور ' : 'Post Type'}}</th>
                            <th>{{app()->getLocale() == 'ar' ? ' المستخدم' : 'User'}}</th>
                            <th width="70%">{{app()->getLocale() == 'ar' ? ' المحتوي' : 'Content'}}</th>
                            <th>{{app()->getLocale() == 'ar' ? 'تاريخ النشر ' : 'Posted At'}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($posts)==0)
                            <tr>
                                <td colspan="12">{{__('admin.no_data')}}</td>
                            </tr>
                        @endif
                        @foreach($posts as $post)
                            <tr id="_{{$post->id}}">
                                <td>00{{$post->id}}</td>
                                <td class="text-uppercase">{{$post->post_type}}</td>
                                <td>{{$post->user->firstname ?? ''}} {{$post->user->lastname ?? ''}}</td>
                                <td class="text-left">
                                    <span class="text-primary">{{app()->getLocale() == 'ar' ? 'المحتوي' : 'Content'}}:</span>
                                    <b>{{$post->post ?? '-'}}</b>
                                    <br>
                                    <span class="text-primary">{{app()->getLocale() == 'ar' ? ' مرفقات' : 'Attachment'}}:</span>
                                    @foreach($post->files as $file)
                                        <a class="text-info" target="_blank" href="{{$file['name']}}">Attached File</a>
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{$post->user->created_at}}</td>
                                <td>
                                    <div class="btn-group direction">
                                        <button class="btn btn-main p-2 pl-3 pr-3"
                                                onclick="approve('{{$post->id}}')">
                                            <i class="now-ui-icons ui-1_check"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="col-md-12">
                    {{$posts->appends(request()->except('page'))->render('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>