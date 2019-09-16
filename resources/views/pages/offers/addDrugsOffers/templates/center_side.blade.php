<style>
    .update-profile-loader {
        position: absolute;
        z-index: 10;
        bottom: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        line-height: 50px;
        color: #fff;
        transition: all 0.5s ease-in-out;
        display: none;
    }

    .update-profile-loader i {
        line-height: 280px;
        font-size: 30px;
    }

    .update-profile {
        position: absolute;
        z-index: 9;
        bottom: 0;
        width: 100%;
        height: 50px;
        background: rgba(0, 0, 0, 0.5);
        line-height: 50px;
        color: #ccc;
        opacity: 0;
        transition: all 0.5s ease-in-out;
    }

    .update-profile .title {
        margin: 0;
        padding: 0;
        line-height: 50px;
        cursor: pointer;
    }

    .card-image:hover .update-profile {
        opacity: 1;
    }
</style>
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
                            {{Form::open([
                                'method'=>"post",
                                'route'=>'addDrugsItemsAds'
                            ])}}
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        {{__('admin.add_feature_ads')}}
                                    </h3>
                                </div>
                                <div class="col-md-4 text-left mb-2">
                                    <label> {{__('admin.package')}}</label>
                                    <select name="package_id" class="form-control">
                                        @foreach($packages as $package)
                                            <option value="{{$package->id}}">{{$package->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('package_id'))
                                        <span class="text-danger">{{$errors->first('package_id')}}</span>
                                    @endif
                                </div>
                                <div class="col-md-12 table-scroll">
                                    @if($errors->has('drug_store_ids'))
                                        <span class="text-danger">{{$errors->first('drug_store_ids')}}</span>
                                    @endif
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="100px"></th>
                                            <th>{{__('admin.product_name')}}</th>
                                            <th>{{__('admin.amount')}}  </th>
                                            <th>{{__('admin.price')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($drugs as $drug)
                                            <tr>
                                                <td>
                                                    <div class="form-check m-auto text-center">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="drug_store_ids[]"
                                                                   value="{{$drug->id}}" type="checkbox">
                                                            <span class="form-check-sign"></span>

                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$drug->drug->trade_name}}
                                                    <br>
                                                    ({{$drug->drug->drugCategory->title ?? ''}})
                                                </td>
                                                <td>{{$drug->available_quantity_in_packs}}</td>
                                                <td>{{$drug->offered_price_or_bonus}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-main">
                                        {{__('admin.add')}}
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