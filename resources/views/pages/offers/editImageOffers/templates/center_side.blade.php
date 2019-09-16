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

                                <div class="col-md-4">
                                    {{Form::open([
                                        'id'=>'form',
                                        'route'=>'uploadUpdateImagesAds',
                                        'enctype'=>'multipart/form-data'
                                    ])}}
                                    <div class="btn-group">
                                        <label class="btn btn-info btn-upload" for="inputImage2"
                                               title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage2" name="image2"
                                                   accept="image/*">
                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                  title="Import image with Blob URLs">
                                              <i class="now-ui-icons arrows-1_share-66"></i>
                                                 {{__('admin.upload_image')}} 16:9
                                            </span>
                                        </label>
                                        <label class="btn btn-info btn-upload" for="inputImage"
                                               title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage" name="image"
                                                   accept="image/*">
                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                  title="Import image with Blob URLs">
                                              <i class="now-ui-icons arrows-1_share-66"></i>
                                                {{__('admin.upload_image')}}   2:1
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <span class="text-danger " style="display: none;" id="image_error"></span>
                                    </div>
                                    <div class="form-group text-left">
                                        <label>{{__('admin.link')}}  </label>
                                        <input name="link" type="url" autocomplete="off" value="{{$image_ads->link}}"
                                               class="form-control"/>
                                        <span class="text-danger " style="display: none" id="link_error"></span>
                                    </div>
                                    <div class="text-left">
                                        <div class="form-group">
                                            <label>  {{__('admin.viewed_by')}} </label>
                                            <select name="image_ad_type_id" class="form-control">
                                                @foreach($types as $type)
                                                    <option @if($type->id == $image_ads->type->id) selected
                                                            @endif value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->has('package_id'))
                                            <span class="text-danger">{{$errors->first('package_id')}}</span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left">
                                        <label>{{__('admin.package')}} </label>
                                        <select name="image_package_id" class="form-control">
                                            @foreach($image_packages as $image_package)
                                                <option @if($image_ads->package->id == $image_package->id) selected
                                                        @endif value="{{$image_package->id}}">{{$image_package->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger " style="display: none"
                                              id="image_package_id_error"></span>
                                    </div>
                                    <div class="docs-preview clearfix">
                                        <h4 class="m-0 text-left">{{__('admin.format')}}</h4>
                                        <div id="preview2" class="img-preview preview-lg"></div>
                                    </div>
                                    <div class="docs-preview clearfix">
                                        <h4 class="m-0 text-left">{{__('admin.format')}}</h4>
                                        <div id="preview1" class="img-preview preview-lg"></div>
                                    </div>
                                    <button type="submit" class="btn btn-main">
                                        {{__('admin.edit')}}
                                    </button>
                                    {{Form::close()}}
                                </div>

                                <div class="col-md-8">
                                    <div class="row">

                                        <div class="col-md-12">
                                            @if($image_ads->scaled_image)
                                                <img id="image2" src="{{$image_ads->scaled_image}}">
                                            @else
                                                <img id="image2" src="{{asset('assets/img/cropper.jpg')}}">
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            @if($image_ads->original_image)
                                                <img id="image" src="{{$image_ads->original_image}}">
                                            @else
                                                <img id="image" src="{{asset('assets/img/cropper.jpg')}}">
                                            @endif
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