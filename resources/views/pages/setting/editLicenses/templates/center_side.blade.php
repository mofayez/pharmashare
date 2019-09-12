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
                            {{Form::open([
                                'method'=>'post',
                                'route'=>'postEditLicenses',
                                'enctype'=>'multipart/form-data'
                            ])}}
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        {{__('settings.edit_licenses')}}
                                    </h3>
                                </div>
                                <div class="col-md-12 text-left">
                                    <div class="row">
                                        
                                        @if(auth()->user()->role_id != 4)
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label>  {{__('auth.trade_license')}}      </label>
                                                <input type="file" name="trade_license"
                                                       style="opacity: 1;position: relative"
                                                       class="form-controls text-left"
                                                       autocomplete="off"
                                                       placeholder=" {{__('auth.trade_license')}}  ">
                                            </div>
                                            @if($errors->has('trade_license'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('trade_license')}}</span>
                                            @endif
                                            <div class="row">
                                                @if($user->papers)
                                                    <div class="col-md-12">
                                                        <h4>
                                                            <a href="{{$user->papers->trade_license_path}}">
                                                                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                {{app()->getLocale() == 'ar' ? 'تحميل' : 'Download File' }}
                                                            </a>
                                                        </h4>
                                                        <img class="img-responsive"
                                                             src="{{$user->papers->trade_license_path}}" alt="">
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        <img class="img-responsive"
                                                             src="{{asset('assets/img/no-image-icon-4.png')}}" alt="">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if(auth()->user()->role_id != 4)
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label>  {{__('auth.passport')}}    </label>
                                                <input type="file" name="passport" style="opacity: 1;position: relative"
                                                       class="form-controls text-left" autocomplete="off"
                                                       placeholder=" {{__('auth.passport')}}  ">
                                            </div>
                                            @if($errors->has('passport'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('passport')}}</span>
                                            @endif
                                            <div class="row">
                                                @if($user->papers)
                                                    <div class="col-md-12">
                                                        <h4>
                                                            <a href="{{$user->papers->passport_license_path}}">
                                                                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                {{app()->getLocale() == 'ar' ? 'تحميل' : 'Download File' }}
                                                            </a>
                                                        </h4>
                                                        <img class="img-responsive"
                                                             src="{{$user->papers->passport_license_path}}" alt="">
                                                    </div>
                                                @else
                                                    <div class="col-md-6">
                                                        <img class="img-responsive"
                                                             src="{{asset('assets/img/no-image-icon-4.png')}}" alt="">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> 
                                                        @if(auth()->user()->role_id != 4)
                                                            {{__('auth.pharmacy_license')}}  
                                                        @else
                                                            {{__('auth.role4_files')}}  
                                                        @endif
                                                    </label>
                                                    <input type="file" name="pharmacy_license"
                                                           style="opacity: 1;position: relative"
                                                           class="form-controls text-left"
                                                           autocomplete="off"
                                                           placeholder=" {{__('auth.pharmacy_license')}}  ">
                                                </div>
                                                @if($errors->has('pharmacy_license'))
                                                    <span style="top: -10px;position: relative;"
                                                          class="text-danger">{{$errors->first('pharmacy_license')}}</span>
                                                @endif
                                                <div class="row">
                                                    @if($user->papers)
                                                        <div class="col-md-12">
                                                        <h4>
                                                            <a href="{{$user->papers->pharmacy_license_path}}">
                                                                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                {{app()->getLocale() == 'ar' ? 'تحميل' : 'Download File' }}
                                                            </a>
                                                        </h4>
                                                            <img class="img-responsive"
                                                                 src="{{$user->papers->pharmacy_license_path}}" alt="">
                                                        </div>
                                                    @else
                                                        <div class="col-md-6">
                                                            <img class="img-responsive"
                                                                 src="{{asset('assets/img/no-image-icon-4.png')}}" alt="">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
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