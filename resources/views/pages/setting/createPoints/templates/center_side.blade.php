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

                                <div class="col-md-12 text-left">
                                    <h3>   {{__('store.points')}}  </h3>
                                </div>
                                <div class="col-md-12">

                                    {{Form::open([
                                        'method'=>'post',
                                        'route'=>'handleCreatePoints'
                                    ])}}
                                    <div class="row text-left">
                                        <div class="col-md-12">
                                            <div class="text-left">
                                                <button class="btn btn-main" id="add_button" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <table class="table table-bordered" id="myTable">
                                                <thead>
                                                <tr class="text-left">
                                                    <th></th>
                                                    <th>{{__('store.points')}}</th>
                                                    <th></th>
                                                    <th>{{__('store.purchase_coupon')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($packages as $k=>$package)
                                                    <tr>

                                                        <td>
                                                            <button type="button" class="btn btn-danger removerow">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </td>

                                                        <td>
                                                            <input name="points[{{$k}}]" class="form-control text-center"
                                                                   type="number"
                                                                   value="{{$package->points}}">

                                                        </td>

                                                        <td>{{__('store.replace_by')}}</td>

                                                        <td>
                                                            <input name="price[{{$k}}]" class="form-control text-center"
                                                                   type="number"
                                                                   value="{{$package->price}}">
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center  m-auto">
                                            <button class="btn btn-main">
                                                {{__('settings.update')}}
                                            </button>
                                        </div>
                                    </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>