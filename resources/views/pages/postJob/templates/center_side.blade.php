<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }

    #map {
        width: 100%;
        height: 50vh;
        position: relative;
        display: flex;
    }

</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        @if($user->role_id != 4)
            <div class="float-right">
                <a href="{{route('getAllJob')}}" class="btn btn-main">
                    {{__('jobs.all_jobs')}}
                </a>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h2>{{__('jobs.add_new_job')}}</h2>
            </div>
            <div class="col-md-4 d-none d-md-block">
                @if(in_array('jobs',(array)$allowed_ads))
                    @if(count($first_ratio) == 0)
                        <img src="{{asset('assets/img/pharmacist-1.png')}}" class="img-responsive" alt="">
                    @endif
                    @foreach($first_ratio as $ads)
                        @if($loop->iteration == 1)
                            <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                                <img src="{{asset('assets/img/cron.png')}}" alt="">
                                <h4 class="" style="position: absolute;top: 0px;right:20%;color: #FFF">
                                    {{__('profile.ads')}}
                                </h4>
                            </div>
                            <a href="{{$ads['link'] ?? '#'}}" target="_blank">
                                <img src="{{$ads['second_image']}}" alt="">
                            </a>
                        @else
                            @break
                        @endif
                    @endforeach
                @else
                    <img src="{{asset('assets/img/pharmacist-1.png')}}" class="img-responsive" alt="">
                @endif

            </div>
            <div class="col-md-8 text-left">
                {{Form::open([
                    'method'=>'post',
                    'route'=>'handlePostJob'
                ])}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('jobs.job_title')}}  </label>
                            <input type="text" class="form-control" name="job_name"
                                   placeholder="{{__('jobs.job_title')}}">
                        </div>
                        @if($errors->has('job_name'))
                            <span style="top: -10px;position: relative;"
                                  class="text-danger">{{$errors->first('job_name')}}</span>
                        @endif
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__('jobs.salary')}}</label>
                            <select name="job_type_id" class="form-control" onchange="changeType()">
                                @foreach($job_types as $job_type)
                                    @if(app()->getLocale() == 'ar')
                                        <option value="{{$job_type->id}}">{{$job_type->name}}</option>
                                    @else
                                        <option value="{{$job_type->id}}">{{$job_type->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('job_type_id'))
                            <span style="top: -10px;position: relative;"
                                  class="text-danger">{{$errors->first('job_type_id')}}</span>
                        @endif
                    </div>
                    <div class="col-md-6" id="range" style="display:none">
                        <div class="form-group">
                            <label>{{__('jobs.salary_range')}}</label>
                            <br>
                            <label>{{__('jobs.salary_between')}}
                                (<span id="salaryfrom"></span> - <span id="salaryto"></span>)
                            </label>
                            <div id="sliderSalary" class="slider slider-info"></div>
                            <input type="hidden" name="salary">
                            <input type="hidden" name="max_salary">
                        </div>
                        @if($errors->has('salary'))
                            <span style="top: -10px;position: relative;"
                                  class="text-danger">{{$errors->first('salary')}}</span>
                        @endif
                        @if($errors->has('max_salary'))
                            <span style="top: -10px;position: relative;"
                                  class="text-danger">{{$errors->first('max_salary')}}</span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{__('jobs.requirements')}}  </label>
                            <textarea class="form-control" name="requirements" rows="8"
                                      placeholder="{{__('jobs.requirements')}} "></textarea>
                        </div>
                        @if($errors->has('requirements'))
                            <span style="top: -10px;position: relative;"
                                  class="text-danger">{{$errors->first('requirements')}}</span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{__('jobs.contacts')}}  </label>
                            <textarea class="form-control" rows="8" name="contacts"
                                      placeholder="{{__('jobs.contacts')}}"></textarea>
                        </div>
                        @if($errors->has('contacts'))
                            <span style="top: -10px;position: relative;"
                                  class="text-danger">{{$errors->first('contacts')}}</span>
                        @endif
                    </div>
                    <div class="text-center  m-auto">
                        <button type="submit" class="btn btn-main">
                            {{__('jobs.add_job')}}
                        </button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
        {{--<div class="text-center col-md-12  m-auto">--}}
        {{--<div id='map'></div>--}}
        {{--</div>--}}
    </div>
</div>