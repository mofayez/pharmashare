{{Html::script('assets/js/bootstrap-switch.js')}}
<script>

    $(document).on('switchChange.bootstrapSwitch', '.bootstrap-switch', function (e) {
        e.preventDefault();
                @if(app()->getLocale() == 'ar')
        let link = "{{route('setEn')}}";
                @else
        let link = "{{route('setAr')}}";
        @endif
            location.href = link;
    });
</script>
<style>
    .languages div{ 
        display: inline-block;
        padding: 3px 10px;
        margin: 0;
        text-transform: uppercase;
    }
    
    .languages div.active{ 
        border: 1px solid;
        background:#6237bd;
        color:#FFF;
    }
    .languages div.active a{ 
        
        color:#FFF!important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-transparent bg-white fixed-top direction" color-on-scroll="100">
    <div class="container">

        <div class="navbar-translate">
            <a href="{{route('getIndexView')}}">
                <img src="{{asset('front_assets/images/logo.png')}}" style="width: 150px;" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar top-bar"></span>
                <span class="navbar-toggler-bar middle-bar"></span>
                <span class="navbar-toggler-bar bottom-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse show" data-nav-image="./assets/img//blurred-image-1.jpg"
             data-color="orange">

            @if(app()->getLocale() == 'ar')
                <ul class="navbar-nav direction" style="margin-right: auto">
                    @else
                        <ul class="navbar-nav ml-auto direction" style="margin-left: auto">
                            @endif

                            <li class="nav-item text-center">
                                <a href="{{route('getIndexView')}}" class="nav-link btn btn-main btn-round text-white">
                                    <p> {{__('front.home')}}</p>
                                </a>
                            </li>

                            <li class="nav-item text-center">
                                <a href="{{route('getContactView')}}" class="nav-link">
                                    <p>{{__('front.contact_us')}}  </p>
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{route('getJobsView')}}" class="nav-link">
                                    <p>{{__('front.find_job')}}</p>
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{route('getPharamcyView')}}" class="nav-link">
                                    <p>{{__('front.map')}}</p>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link btn-round" id="settings" data-toggle="dropdown">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </a>
                                <div class="dropdown-menu text-left" aria-labelledby="settings">
                                    <a class="dropdown-header">{{__('front.account')}}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('getLoginView')}}">{{__('front.login')}}</a>
                                    <a class="dropdown-item d-md-none"
                                       href="{{route('getRegisterView')}}"> {{__('front.register')}}   </a>
                                    @if(app()->getLocale() == 'ar')
                                        <a class="dropdown-item" href="{{route('setEn')}}">

                                            الانجليزية

                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{route('setAr')}}">

                                            Arabic

                                        </a>
                                    @endif

                                </div>
                            </li>

                            <li class="nav-item text-center d-none d-md-block pt-1">

                                <div class="col-md-12 text-right">
                                    <div class="languages">
                                        <div class="{{app()->getLocale() == 'ar' ? 'active': ''}}">
                                            <a href="{{route('setAr')}}">عربي</a>
                                        </div>
                                        
                                        <div class="{{app()->getLocale() == 'en' ? 'active': ''}}">
                                            <a href="{{route('setEn')}}">english</a>
                                        </div>
                                    </div>
                                    @if(app()->getLocale() == 'ar')
                                        <!--<label> العربية </label>-->
                                    @else
                                        <!--<label> English </label>-->
                                    @endif
                                    {{-- <input type="checkbox" class="bootstrap-switch"
                                           @if(app()->getLocale() == 'ar') checked="checked" @endif /> --}}
                                </div>
                            </li>
                        </ul>

        </div>

    </div>

</nav>