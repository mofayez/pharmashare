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
                                    @if(count($notifications) == 0)
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <img class="img-responsive" src="{{asset('assets/img/empty-cart.png')}}"
                                                     alt="">
                                                <h3>{{__('profile.no_notifications')}}</h3>
                                            </div>
                                        </div>
                                    @endif
                                    @foreach($notifications as $notification) 
                                        <div class="col-md-12">
                                            
                                            <a @if(in_array($notification->type , ['ApprovedDrug','RejectDrug','UnApprovedDrugInsertion'])) href="{{$notification->url}}" @endif >
                                                <div class="media-area"> 
                                                    <span class="float-right">{{$notification->notified_at}}</span>
                                                    <div class="media">
                                                        <!--<a class="float-left" href="{{$notification->url}}">-->
                                                        <!--    <div class="avatar">-->
                                                        <!--        <img class="media-object img-raised"-->
                                                        <!--             style="width: 50px;height: 50px;border-radius: 50%"-->
                                                        <!--             src="{{asset("assets/img/user_avatar.jpg")}}"-->
                                                        <!--             alt="...">-->
                                                        <!--    </div>-->
                                                        <!--</a>-->
                                                        <div class="media-body p-2 text-left">
                                                            <h6 class="media-heading text-left mb-0 text-capitalize"> {{app()->getLocale() == 'ar' ? $notification->title : $notification->title_en }}
                                                                <label class="badge badge-info">{{$notification->type}}</label>
                                                            </h6>
                                                            <span style="color: #722fc2;font-size: 13px;">{{$notification->created_at}}</span>
                                                            <br/>
                                                            <small style="font-size: 12px;"
                                                                   class="text-left text-muted">{{app()->getLocale() == 'ar' ? $notification->description :  $notification->description_en}}</small>
                                                        </div>
                                                    </div>
                                                    <hr class="m-0">
                                                </div>
                                            </a>
                                        </div>  
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>