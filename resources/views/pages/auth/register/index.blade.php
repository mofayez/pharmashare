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
            background: #FFF;
            border-radius: 8px;
        }

        .form-group .form-control, .input-group .form-control {
            padding: 10px 25px;
        }

        .form-content {
            margin-top: 25%;
        }

        .margin-form {
            margin-right: 10%;
            margin-left: 10%;
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
            position: absolute;
            z-index: 9;
            bottom: 0;
            right: 50%;
            width: 15%;
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
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            z-index: 0;
            clip-path: polygon(26% 0, 100% 0, 100% 100%, 6% 100%, 0% 38%);
        }
        label{
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
    {{--<img src="{{asset('assets/img/register_pattern.png')}}" class="messages-img" alt="">--}}
    {{--<img src="https://img2.exportersindia.com/product_images/bc-full/dir_57/1697714/-398158.png" class="messages-img"   alt="">--}}
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

            <div class="row direction margin-form">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> الاسم</label>
                        <input type="text" name="comment" class="form-control text-left" autocomplete="off"
                               placeholder="اكتب اسمك هنا">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> البريد الالكتروني</label>
                        <input type="text" name="comment" class="form-control text-left" autocomplete="off"
                               placeholder="اكتب البريد الالكتروني">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> كلمة السر</label>
                        <i class="fa fa-eye" style="position: absolute;left: 20px;top: 50px;"></i>
                        <input type="text" name="comment" class="form-control text-left" autocomplete="off"
                               placeholder="اكتب كلمة السر">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> كلمة السر مرة اخرى</label>
                        <i class="fa fa-eye" style="position: absolute;left: 20px;top: 50px;"></i>
                        <input type="text" name="comment" class="form-control text-left" autocomplete="off"
                               placeholder="اكتب كلمة السر مرة اخري">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label> رقم الهاتف </label>
                        <input type="text" name="comment" class="form-control text-left" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-12 text-center mt-2">
                    <button class="btn btn-main btn-round text-white">
                        اتمام الخطوة الاولى
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="rightside" filter-color="purple"></div>
    <div class="page-header header-filter register-part-one" filter-color="purple"
         style="clip-path: polygon(26% 0, 100% 0, 100% 100%, 6% 100%, 0% 38%);">
        {{--<div class="page-header-image"--}}
        {{--style="clip-path: polygon(0 0, 100% 0%, 75% 100%, 0% 100%);--}}
        {{--background:url('{{asset('assets/img/bg.jpg')}}')  left center;background-size: cover;"></div>--}}
        <div class="content">
            <div class="container">
                <div class="col-md-12">
                    <h3 class="title text-left">تسجيل مستخدم جديد</h3>
                    <div class="mdl-card mdl-shadow--2dp">

                        <div class="mdl-card__supporting-text direction">

                            <div class="mdl-stepper-horizontal-alternative">
                                <div class="mdl-stepper-step active-step  editable-step">
                                    <div class="mdl-stepper-circle"><span>1</span></div>
                                    <div class="mdl-stepper-title">الخطوة الاولى</div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                                <div class="mdl-stepper-step active-step">
                                    <div class="mdl-stepper-circle"><span>2</span></div>
                                    <div class="mdl-stepper-title">الخطوة الثانية</div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                                <div class="mdl-stepper-step active-step">
                                    <div class="mdl-stepper-circle"><span>3</span></div>
                                    <div class="mdl-stepper-title">الخطوة الثالثة</div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row form-content" style="position:absolute;display: inline-flex;z-index: 99;width: 100%;left: 0;">
            <div class="col-md-6">
                <div style="background: url('{{asset("assets/img/facebookgoogle.jpg")}}') center center no-repeat;position: absolute;width: 30px;height: 30px;background-size: cover;top: 12px;left: 100px;background-position: -23px 2px;"></div>
                <button class="btn btn-default bg-white" style="min-width:80%;color:#000;text-align: right">
                    تسجيل باستخدام جوجل
                </button>
            </div>
            <div class="col-md-6">
                <div style="background: url('{{asset("assets/img/facebookgoogle.jpg")}}') center center no-repeat;position: absolute;width: 30px;height: 30px;background-size: cover;top: 12px;left: 100px;background-position: 6px 2px;"></div>
                <button class="btn btn-default bg-white" style="min-width:80%;color:#000;text-align: right">
                    تسجيل باستخدام فيسبوك
                </button>
            </div>
        </div>
    </div>
    </body>

@endsection
@section('scripts')
    <script>
        $("#footer").remove()
    </script>
@endsection