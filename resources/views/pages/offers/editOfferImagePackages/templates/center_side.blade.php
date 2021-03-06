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
                                    <div class="tab-content tab-space">
                                        <div class="tab-pane active" id="link1">
                                            {{Form::open([
                                                'route'=>['updateAdsImagePackages',$package->id],
                                                'method'=>'post'
                                            ])}}
                                            <div class="row text-left">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{__('admin.package_name')}}  </label>
                                                        <input type="text" class="form-control" name="name"
                                                               autocomplete="off"
                                                               placeholder=" " value="{{$package->name}}">
                                                    </div>
                                                    @if($errors->has('name'))
                                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                                    @endif
                                                </div>
                                                {{--<div class="col-md-3">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label>تظهر ل </label>--}}
                                                        {{--<select name="image_ad_type_id" class="form-control">--}}
                                                            {{--@foreach($types as $type)--}}
                                                                {{--<option @if($package->image_ad_type_id == $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>--}}
                                                            {{--@endforeach--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                    {{--@if($errors->has('package_id'))--}}
                                                        {{--<span class="text-danger">{{$errors->first('package_id')}}</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label> {{__('admin.days')}}     </label>
                                                        <input type="text" class="form-control" name="period_in_days"
                                                               autocomplete="off"
                                                               placeholder="    "
                                                               value="{{$package->period_in_days}}">
                                                    </div>
                                                    @if($errors->has('period_in_days'))
                                                        <span class="text-danger">{{$errors->first('period_in_days')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>{{__('admin.price')}}</label>
                                                        <input type="text" class="form-control" name="price"
                                                               autocomplete="off"
                                                               placeholder="  " value="{{$package->price}}">
                                                    </div>
                                                    @if($errors->has('price'))
                                                        <span class="text-danger">{{$errors->first('price')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-main">
                                                        {{__('admin.edit')}}
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
    </div>
</div>