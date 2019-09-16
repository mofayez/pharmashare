{{Form::open([
    'route'=>'handleAddPoints',
    'method'=>'post'
])}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-blog card-plain card-body pt-0">
                <div class="card-body bg-white mr-2 ml-2">
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
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="btn btn-main" type="submit">
                            {{__('store.add')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{Form::close()}}