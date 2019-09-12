@extends('layouts.auth')
@section('styles')
    <style media="screen">
        .has-success.input-lg:after, .has-danger.input-lg:after {
            top: 15px !important;
        }

        @-webkit-keyframes wave1 {
            0% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
            50% {
                -webkit-transform: skewX(-50deg);
                transform: skewX(-50deg);
            }
            100% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
        }

        @keyframes wave1 {
            0% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
            50% {
                -webkit-transform: skewX(-50deg);
                transform: skewX(-50deg);
            }
            100% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
        }

        @-webkit-keyframes wave2 {
            0% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
            50% {
                -webkit-transform: skewX(-40deg);
                transform: skewX(-40deg);
            }
            100% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
        }

        @keyframes wave2 {
            0% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
            50% {
                -webkit-transform: skewX(-40deg);
                transform: skewX(-40deg);
            }
            100% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
        }

        @-webkit-keyframes wave3 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
            50% {
                -webkit-transform: skewX(-60deg);
                transform: skewX(-60deg);
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
        }

        @keyframes wave3 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
            50% {
                -webkit-transform: skewX(-60deg);
                transform: skewX(-60deg);
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
        }

        @-webkit-keyframes wave4 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
            50% {
                -webkit-transform: skewX(-60deg) rotateX(50deg);
                transform: skewX(-60deg) rotateX(50deg);
                border-radius: 90%;
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
        }

        @keyframes wave4 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
            50% {
                -webkit-transform: skewX(-60deg) rotateX(50deg);
                transform: skewX(-60deg) rotateX(50deg);
                border-radius: 90%;
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
        }

        .stripe {
            position: absolute;
            width: 500px;
            height: 500px;
        }

        .stripe1 {
            top: -300px;
            left: -300px;
            -webkit-transform: skewX(-55deg);
            transform: skewX(-55deg);
            background: rgba(103, 58, 183, 0.3);
            -webkit-animation: wave1 6s infinite;
            animation: wave1 6s infinite;
        }

        .stripe2 {
            top: -350px;
            left: -350px;
            -webkit-transform: skewX(-45deg);
            transform: skewX(-45deg);
            background: rgba(103, 58, 183, 0.2);
            -webkit-animation: wave2 6s infinite;
            animation: wave2 6s infinite;
        }

        .stripe3 {
            top: -356px;
            left: -200px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.1);
            -webkit-animation: wave3 6s infinite;
            animation: wave3 6s infinite;
        }

        .stripe4 {
            top: -322px;
            left: -200px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.1);
            -webkit-animation: wave3 6s infinite;
            animation: wave3 6s infinite;
        }

        .stripe5 {
            top: -380px;
            left: -200px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.4);
            -webkit-animation: wave3 6s infinite;
            animation: wave3 6s infinite;
        }

        .stripe6 {
            top: -179px;
            left: -191px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.08);
            -webkit-animation: wave4 6s infinite linear;
            animation: wave4 6s infinite linear;
        }

        .stripe7 {
            top: -316px;
            left: 51px;
            -webkit-transform: skewX(-55deg);
            transform: skewX(-55deg);
            background: rgba(103, 58, 183, 0.06);
            -webkit-animation: wave4 6s infinite linear;
            animation: wave4 6s infinite linear;
        }

        .rightside {
            background: url('{{asset('assets/img/bg.jpg')}}') center center no-repeat;
            background-size: cover;
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            z-index: 0;
            clip-path: polygon(25% 0%, 100% 1%, 100% 100%, 25% 100%, 0 31%);
        }

        input::placeholder {
            color: #555 !important;
        }
    </style>
@endsection
@section('body')
    @include('front_site.templates.nav_login')

    <body class="login-page">
    <div class="page-header header-filter" filter-color="purple">
        <div class="page-header-image"
             style="background:url('{{asset('assets/img/bg.jpg')}}')  left center;background-size: cover;"></div>
        <div class="content">
            <div class="container">
                <div class="col-md-5 m-auto">
                    <div class="card card-contact card-raised wow zoomInDown" style="position:relative;overflow: hidden">
                        <div style="height: 50px;position: absolute;width: 100%;z-index: 99">
                            <div class="stripes">
                                <div class="stripe stripe1"></div>
                                <div class="stripe stripe2"></div>
                                <div class="stripe stripe3"></div>
                                <div class="stripe stripe4"></div>
                                <div class="stripe stripe5"></div>
                                <div class="stripe stripe6"></div>
                                <div class="stripe stripe7"></div>
                            </div>
                        </div>
                            <div class="card-header text-center direction position-relative">

                                <h4 class="card-title {{count($errors) > 0 ? 'text-danger': 'text_purple_gradient'}} {{app()->getLocale() == 'ar' ? 'text-left': 'text-left' }} p-3"
                                    style="border-{{app()->getLocale() == 'ar' ? 'right':'right'}}: 4px solid {{count($errors) > 0 ? '#ff3636' : '#673ab7'}} ;">
                                    {{__('auth.login_btn')}}
                                </h4>
                            </div>
                            <div class="card-body">
                                {{Form::open([
                                      'class'=>'form',
                                      'route'=>'handleLogin',
                                      'method'=>'post'
                                      ])}}
                                <div class="card-header text-center">
                                    <div class="logo-container" style="width: 100%">
                                        {{--<img src="{{asset('assets/img/logo.png')}}" alt="">--}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="input-group form-group-no-border input-lg @if($errors->has('username')) has-danger @endif">
                                        <input type="text"
                                               class="form-control bg-white text-dark @if($errors->has('username')) form-control-danger @endif"
                                               name="username" placeholder=" {{__('auth.username')}} "
                                               value="{{old('username')}}"
                                               style="text-align: left;z-index:99"
                                               autocomplete="off">
                                    </div>
                                    <div class="error" style="position:relative">
                                        @if($errors->has('username'))
                                            <span style="position:relative;bottom: 10px;font-size: 14px;color: red;">
                                  {{$errors->first('username')}}
                                </span>
                                        @endif
                                        @if(session()->has('error'))
                                            <span style="position:relative;bottom: 10px;font-size: 14px;color: red;">
                                  {{session()->get('error')}}
                                </span>
                                        @endif
                                    </div>
                                    <div class="input-group form-group-no-border input-lg  @if($errors->has('password')) has-danger @endif">
                                        <input type="password" class="form-control bg-white text-dark" name="password"
                                               style="text-align: left"
                                               placeholder=" {{__('auth.password')}} ">
                                    </div>
                                    <div class="error" style="position:relative">
                                        @if($errors->has('password'))
                                            <span style="position:relative;bottom: 10px;font-size: 14px;color: red;">
                                  {{$errors->first('password')}}
                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="text-center position-absolute wow bounceInRight"
                         data-wow-delay="0.5s"
                         style="bottom: 35px;right: -15px;">
                        <button class="btn  btn-round btn-icon btn-lg {{count($errors) > 0 ? 'btn-danger':'btn-main'}}"
                                type="submit">
                            <i class="now-ui-icons arrows-1_minimal-right"></i>
                        </button>
                    </div>
                    {{Form::close()}}
                    <div class="pull-left">
                        <h6><a href="{{route('getRegisterView')}}" class="link footer-link">{{__('auth.register')}}</a>
                        </h6>
                    </div>
                    <div class="pull-right">
                        <h6><a href="{{route('resetPassword')}}" class="link footer-link">{{__('auth.reset')}}</a></h6>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer ">


            <div class="container">
                <div class="float-left">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{route("setAr")}}">
                                    العربية
                                </a>
                            </li>
                            <li>
                                <a href="{{route("setEn")}}">
                                    English
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="copyright float-right">
                    Copyright ©
                    <script>document.write(new Date().getFullYear())</script>
                    <a href="#">Approc</a> All Rights Reserved.
                </div>
            </div>


        </footer>

    </div>
    </body>

@endsection
@section('scripts')
    {{Html::script('assets/js/wow.min.js')}}
    <script>
        $("#footer").remove()
        new WOW().init();
    </script>
@endsection