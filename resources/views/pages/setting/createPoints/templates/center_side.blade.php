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
                                                    <th>{{__('store.amount_request')}}</th>
                                                    <th>{{__('store.discount_calc')}}</th>
                                                    <th>{{__('store.points')}}</th>
                                                    <th>{{__('store.active')}}</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach([] as $k=>$foc)
                                                    <tr>

                                                        <td>
                                                            <button type="button" class="btn btn-danger removerow">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </td>

                                                        <td>
                                                            <input name="foc_on[{{$k}}]" class="form-control text-center" type="hidden"
                                                                   value="{{$foc->foc_on}}">
                                                            <input name="foc_quantity[{{$k}}]" class="form-control text-center"
                                                                   type="number"
                                                                   value="{{$foc->foc_quantity}}">

                                                        </td>

                                                        <td>
                                                            <input name="foc_discount[{{$k}}]" class="form-control text-center"
                                                                   type="number"
                                                                   value="{{$foc->foc_discount}}">
                                                        </td>

                                                        <td><input name="reward_points[{{$k}}]" class="form-control text-center"
                                                                   type="number"
                                                                   value="{{$foc->reward_points}}">
                                                        </td>

                                                        <td>
                                                            <select name="is_activated[{{$k}}]" class="form-control text-center">
                                                                <option @if($foc->is_activated) selected @endif value="1">Yes</option>
                                                                <option @if(!$foc->is_activated) selected @endif value="0">No</option>
                                                            </select>
                                                        </td>
                                                        <td></td>
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