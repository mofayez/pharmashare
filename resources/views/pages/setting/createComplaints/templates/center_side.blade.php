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
                                    <h3>   {{__('settings.complaints')}}  </h3>
                                </div>
                                <div class="col-md-12">

                                    {{Form::open([
                                        'method'=>'post',
                                        'route'=>'handelCreateComplaintsUs'
                                    ])}}
                                    <div class="row text-left">
                                        <div class="col-md-4">
                                            <label>
                                                {{__('settings.subject')}}
                                            </label>
                                            <input type="text" name="subject" class="form-control" value="{{old('subject')}}">
                                            @if($errors->has('subject'))
                                                <span class="text-danger">{{$errors->first('subject')}}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label>
                                                {{__('settings.message')}}
                                            </label>
                                            <textarea type="text" name="message" class="form-control">{{old('message')}}</textarea>
                                            @if($errors->has('message'))
                                                <span class="text-danger">{{$errors->first('message')}}</span>
                                            @endif
                                        </div>
                                        <div class="text-center  m-auto">
                                            <button class="btn btn-main">
                                                {{__('settings.add_complaint')}}
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