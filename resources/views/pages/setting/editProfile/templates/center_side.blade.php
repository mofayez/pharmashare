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
    .modal-backdrop.show{
        z-index:98;
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
                                <div class="col-md-8">
                                    {{Form::open([
                                        'method'=>'post',
                                        'route'=>'updateProfileInfo'
                                    ])}}
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <div class="row direction text-left">
                                        <div class="col-md-12">
                                            <h3>
                                                {{__('settings.update_personal')}}
                                            </h3>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{__('auth.username')}}  </label>
                                                <input type="text" name="username" disabled value="{{$user->username}}"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="{{__('auth.username')}}">
                                            </div>
                                            @if($errors->has('username'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('username')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{__('auth.phone')}}   </label>
                                                <div class="input-group">
                                                    <input type="tel" style="width: 70%;text-align: left;" name="phone"
                                                           dir="ltr"
                                                           class="form-control"
                                                           value="{{$user->phone}}"
                                                           autocomplete="off">
                                                    <input type="tel" style="width: 30%;" name="prefix" dir="ltr"
                                                           class="form-control text-center"
                                                           value="{{$user->prefix}}"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                            @if($errors->has('phone'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('phone')}}</span>
                                            @endif
                                            @if($errors->has('prefix') && !$errors->has('phone'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('prefix')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{__('auth.firstname')}}</label>
                                                <input type="text" name="firstname" value="{{$user->firstname}}"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder=" {{__('auth.firsname')}}">
                                            </div>
                                            @if($errors->has('firstname'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('firstname')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{__('auth.lastname')}}  </label>
                                                <input type="text" name="lastname" value="{{$user->lastname}}"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="{{__('auth.lastname')}}">
                                            </div>
                                            @if($errors->has('lastname'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('lastname')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <label>   {{__('auth.password')}}</label>
                                                <input type="password" name="password" class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="{{__('auth.password')}}">
                                            </div>
                                            @if($errors->has('password'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('password')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <label> {{__('auth.re_password')}}</label>
                                                <input type="password" name="password_confirmation"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder=" {{__('auth.re_password')}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>  {{__('auth.email')}}  </label>
                                                <input type="text" name="email" value="{{$user->email}}"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="{{__('auth.email')}}    ">
                                            </div>
                                            @if($errors->has('email'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> {{__('settings.full_address')}} </label>
                                                <input type="text" name="full_address" value="{{$user->full_address}}"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="{{__('settings.full_address')}}  ">
                                            </div>
                                            @if($errors->has('full_address'))
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger">{{$errors->first('full_address')}}</span>
                                            @endif
                                        </div>
                                    <div class="text-center  m-auto">
                                        <button class="btn btn-main">
                                            {{__('settings.update')}}
                                        </button>
                                    </div>
                                    {{Form::close()}}
                                        <div class="col-md-12">
                                            <table class="table table-border">
                                                <thead>
                                                    <tr>
                                                        <th>{{app()->getLocale() == 'ar' ? 'Lat' : 'Lat' }}</th>
                                                        <th>{{app()->getLocale() == 'ar' ? 'Lng' : 'Lng' }}</th>
                                                        <th>{{app()->getLocale() == 'ar' ? 'العنوان بالبحث' : 'Search Location' }}</th>
                                                        <th>{{app()->getLocale() == 'ar' ? 'عنوان الخريطة' : 'GEO Location' }}</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$user->location->lat ?? ''}}</td>
                                                        <td>{{$user->location->lng ?? ''}}</td>
                                                        <td>{{$user->location->location ?? ''}}</td>
                                                        <td>{{$user->location->geo_location ?? ''}}</td> 
                                                        <td>
                                                            <button class="btn btn-info btn-sm" type="button" data-target="#jobs_modal" data-toggle="modal">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
<!-- Modal -->
<div class="modal fade" id="jobs_modal" tabindex="-1" role="dialog" aria-labelledby="jobs_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="transform: translate(0,65px);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobs_modal_lable"></h5>
            </div>
            {{Form::open([
                'method'=>'post',
                'id'=>'form',
                'route'=>'postEditLocations'
            ])}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="position:relative">
                            <div id='map'></div>
                            
                        <input type="hidden" name="user_id" value="{{$user->id ?? ''}}">
                        <input type="hidden" name="lat" value="{{$user->location->lat ?? ''}}">
                        <input type="hidden" name="lng" value="{{$user->location->lng ?? ''}}">
                        <input type="hidden" name="location" value="{{$user->location->location ?? ''}}">
                        <input type="hidden" name="geo_location" value="{{$user->location->geo_location ?? ''}}">
                        
                        
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-main"> {{__('settings.update')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            {{Form::close()}}
        </div>
    </div>
</div>
                                <div class="col-md-4">
                                    <div class="card card-blog card-plain card-body" style="bottom: 80px">
                                        <div class="card-image position-relative">
                                            <div class="update-profile-loader">
                                                <i class="fas fa-spin fa-spinner"></i>
                                            </div>
                                            <div class="update-profile" id="change_profile">
                                                <h4 class="title">{{__('settings.update_profile')}}    </h4>
                                            </div>
                                            <img id="image-preview"
                                                 class="img img-responsive img-thumbnail rounded profile-img img-raised"
                                                 width="100%"
                                                 src="{{$user->image_path ?? asset("assets/img/user_avatar.jpg")}}">
                                            <input type="file" name="profile-image" class="d-none" accept="image/*">
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