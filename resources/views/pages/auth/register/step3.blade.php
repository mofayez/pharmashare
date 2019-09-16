@extends('layouts.auth')
@section('styles')
    <style media="screen">
        .has-success.input-lg:after, .has-danger.input-lg:after {
            right: 85% !important;
            top: 15px !important;
        }

        input::placeholder {
            color: #555 !important;
        }
    </style>
    <style>
        .form-control {
            border-radius: 8px;
        }

        .form-group .form-control, .input-group .form-control {
            padding: 10px 25px;
        }

        .form-content {
            margin-top: 25%;
        }

        .margin-form {
            margin-right: 6%;
            margin-left: 6%;
        }
    </style>
    <style>
        .register {
            display: flex
        }

        .register-part-one {
            flex: 50
        }

        .register-part-two {
            flex: 50
        }

        .messages-img {
            position: fixed;
            z-index: 9;
            bottom: 0;
            left: 0;
            width: 30%;
        }

        .mdl-card {
            width: 550px;
            min-height: 0;
            margin: 10px auto;
        }

        .mdl-card__supporting-text {
            width: 100%;
            padding: 0;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step {
            width: 25%;
            /* 100 / no_of_steps */
        }

        /* Begin actual mdl-stepper css styles */

        .mdl-stepper-horizontal-alternative {
            display: table;
            width: 80%;
            /*margin: 0 auto;*/
            float: right;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step {
            display: table-cell;
            position: relative;
            padding: 24px;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:hover,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step:active {
            background-color: rgba(0, 0, 0, .06);
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:active {
            border-radius: 15% / 75%;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:first-child:active {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:last-child:active {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:hover .mdl-stepper-circle {
            background-color: #757575;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:first-child .mdl-stepper-bar-left,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step:last-child .mdl-stepper-bar-right {
            display: none;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-circle {
            width: 50px;
            height: 50px;
            margin: 0 auto;
            background-color: #9E9E9E;
            border-radius: 5px;
            text-align: center;
            line-height: 50px;
            font-size: 12px;
            color: white;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.active-step .mdl-stepper-circle {
            background-color: #5f2cbb;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.step-done .mdl-stepper-circle:before {
            content: "\2714";
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.step-done .mdl-stepper-circle *,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step.editable-step .mdl-stepper-circle * {
            /*display: none;*/
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.editable-step .mdl-stepper-circle {
            border: 3px solid #eee;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-title {
            margin-top: 16px;
            font-size: 14px;
            font-weight: normal;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-title,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-optional {
            text-align: center;
            color: #FFF;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.active-step .mdl-stepper-title {
            font-weight: bold;
            color: #FFF;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-optional {
            font-size: 12px;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.active-step .mdl-stepper-optional {
            color: rgba(0, 0, 0, .54);
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-left,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-right {
            position: absolute;
            top: 45px;
            height: 1px;
            border-top: 1px solid #BDBDBD;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-right {
            right: 0;
            left: 60%;
            margin-left: 20px;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-left {
            left: 0;
            right: 60%;
            margin-right: 20px;
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

        label {
            /*font-weight: bold;*/
        }

        /*small screens*/
        @media only screen and (max-width: 600px) {

            .register {
                display: block;
            }

            .register-part-one {
                display: none !important;
            }

            .rightside {
                display: none !important;
            }

            .register-part-two {
                flex: 1
            }

            .messages-img {
                width: 100%;
            }
        }
    </style>
@endsection
@section('body')

    <body class="login-page register">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <div class="register-part-two">
        <div class="stripes">
            <div class="stripe stripe1"></div>
            <div class="stripe stripe2"></div>
            <div class="stripe stripe3"></div>
            <div class="stripe stripe4"></div>
            <div class="stripe stripe5"></div>
            <div class="stripe stripe6"></div>
            <div class="stripe stripe7"></div>
        </div>
        <div class="form-content">

            {{Form::open([
                'method'=>'post',
                'route'=>['postRegister3',app('request')->id],
                'id'=>'form',
                'enctype'=>'multipart/form-data'
            ])}}
            <div class="row direction margin-form">
                <div class="col-md-8">
                    <div class="row">
                        @if($user->role_id != 4)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>  {{__('auth.trade_license')}}      </label>
                                    <input type="file" name="trade_license" style="opacity: 1;position: relative"
                                           class="form-controls text-left"
                                           autocomplete="off"
                                           placeholder=" {{__('auth.trade_license')}}  ">
                                </div>
                                @if($errors->has('trade_license'))
                                    <span style="top: -10px;position: relative;"
                                          class="text-danger">{{$errors->first('trade_license')}}</span>
                                @endif
                            </div>
                        @endif
                        
                        @if($user->role_id != 4)
                            <div class="col-md-12">
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
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>  
                                    @if($user->role_id == 4)
                                        {{__('auth.role4_files')}}    
                                    @elseif($user->role_id == 2)
                                        {{__('auth.store_license')}} 

                                    @else
                                        {{__('auth.pharmacy_license')}} 
                                        
                                    @endif
                                </label>
                                <input type="file" name="pharmacy_license" style="opacity: 1;position: relative"
                                       class="form-controls text-left"
                                       autocomplete="off"
                                       placeholder=" {{__('auth.pharmacy_license')}}  ">
                            </div>
                            @if($errors->has('pharmacy_license'))
                                <span style="top: -10px;position: relative;"
                                      class="text-danger">{{$errors->first('pharmacy_license')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('assets/img/pharmacist-1.png')}}" alt="">
                </div>
                <div class="col-md-12 text-center mt-2">
                    <button id="submit_step" type="submit" class="btn btn-main btn-round text-white">
                        {{__('auth.complete_step3')}}
                    </button>
                    <div class="col-md-12">
                        <div class="btn-group" style="display: flex;flex: 1">
                            <a href="{{route('getGroupPosts')}}" class="btn btn-default bg-white"
                               style="width: 100%;border-radius:0;color:#000;border: 1px solid transparent;">
                                {{__('auth.skip_step')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
    <div class="rightside" filter-color="purple"></div>
    <div class="page-header header-filter register-part-one" filter-color="purple"
         style="clip-path: polygon(25% 0%, 100% 1%, 100% 100%, 25% 100%, 0 31%);">
        {{--<div class="page-header-image"--}}
        {{--style="clip-path: polygon(0 0, 100% 0%, 75% 100%, 0% 100%);--}}
        {{--background:url('{{asset('assets/img/bg.jpg')}}')  left center;background-size: cover;"></div>--}}
        <div class="content">
            <div class="container">
                <div class="col-md-12">
                    <h3 class="title text-left">
                        {{__('auth.register_new_account')}}    </h3>
                    <div class="mdl-card mdl-shadow--2dp">

                        <div class="mdl-card__supporting-text direction">

                            <div class="mdl-stepper-horizontal-alternative">
                                <div class="mdl-stepper-step active-step  editable-step">
                                    <div class="mdl-stepper-circle"><span>1</span></div>
                                    <div class="mdl-stepper-title">
                                        {{__('auth.step1')}}   </div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                                <div class="mdl-stepper-step active-step">
                                    <div class="mdl-stepper-circle"><span>2</span></div>
                                    <div class="mdl-stepper-title">{{__('auth.step2')}}  </div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                                <div class="mdl-stepper-step active-step">
                                    <div class="mdl-stepper-circle"><span>3</span></div>
                                    <div class="mdl-stepper-title">{{__('auth.step3')}}  </div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row form-content" dir="rtl"
             style="position:absolute;display: inline-flex;z-index: 99;width: 100%;left: 0;">
            <div class="col-md-9  text-center">
                <h3 class="mb-0">40%</h3>
                <h5>{{__('auth.completed')}}</h5>
            </div>
        </div>
    </div>
    <div class="position-absolute" style="bottom: 0;right: 20px;z-index: 99">
        <nav>
            <ul class="list-unstyled">
                <li class="list-inline-item">
                    <a href="{{route("setAr")}}">
                        العربية
                    </a>
                </li>
                <li class="list-inline-item"> | </li>
                <li class="list-inline-item">
                    <a href="{{route("setEn")}}">
                        English
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    </body>

@endsection
@section('scripts')
    <script>
        $("#footer").remove();
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });
        $("#form").submit(function (e) {
            e.preventDefault();
            $('.loading-overlay').show();
            setTimeout(() => {
                document.getElementById("form").submit();
            }, 1000);
        })
    </script>
@endsection