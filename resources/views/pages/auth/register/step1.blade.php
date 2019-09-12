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
            /*padding: 10px 25px;*/
        }

        .form-content {
            margin-top: 20%;
            position: relative;
            z-index: 999;
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
    {{Html::style('assets/css/intlTelInput.min.css')}}
    {{Html::style('assets/css/mobiledemo.css')}}
@endsection
@section('body')

    {{--@include('front_site.templates.navbar')--}}
    <body class="login-page register">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <img src="{{asset('assets/img/register_pattern2.png')}}" class="messages-img" alt="">
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

            {{Form::open([
                'method'=>'post',
                'route'=>'handleRegister',
                'id'=>'form'
            ])}}
            <div class="row direction margin-form">
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{__('auth.username')}}  </label>
                        <input type="text" name="username" value="{{old('username')}}" class="form-control text-left"
                               autocomplete="off"
                               placeholder="{{__('auth.username')}}  ">
                    </div> 
                        <span id="username" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('username') ?? null}}</span> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{__('auth.phone')}} </label>
                        <input type="hidden" id="prefixs" name="prefix" autocomplete="off">
                        <input type="tel" id="phones" name="phone" dir="ltr" class="form-control text-left" value="{{old('phone')}}"
                               autocomplete="off">
                    </div> 
                        <span id="phone" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('phone') ?? null}}</span> 
                        <span id="prefix" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('prefix') ?? null}}</span> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{__('auth.firstname')}}  </label>
                        <input type="text" name="firstname" value="{{old('firstname')}}" class="form-control text-left"
                               autocomplete="off"
                               placeholder="{{__('auth.firstname')}}">
                    </div> 
                        <span id="firstname" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('firstname') ?? null}}</span> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{__('auth.lastname')}}  </label>
                        <input type="text" name="lastname" value="{{old('lastname')}}" class="form-control text-left"
                               autocomplete="off"
                               placeholder="{{__('auth.lastname')}}">
                    </div> 
                        <span id="lastname" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('lastname') ?? null}}</span> 
                </div>
                <div class="col-md-6 col-6">
                    <div class="form-group">
                        <label> {{__('auth.password')}}  </label>
                        <i class="fa fa-eye" style="position: absolute;left: 20px;top: 43px;"></i>
                        <input type="password" name="password" class="form-control text-left" autocomplete="off"
                               placeholder="{{__('auth.password')}}">
                    </div> 
                        <span id="password" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('password') ?? null}}</span> 
                </div>
                <div class="col-md-6 col-6">
                    <div class="form-group">
                        <label>  {{__('auth.re_password')}} </label>
                        <i class="fa fa-eye" style="position: absolute;left: 20px;top: 43px;"></i>
                        <input type="password" name="password_confirmation" class="form-control text-left"
                               autocomplete="off"
                               placeholder="{{__('auth.re_password')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>  {{__('auth.email')}}</label>
                        <input type="text" name="email" value="{{old('email')}}" class="form-control text-left"
                               autocomplete="off"
                               placeholder="{{__('auth.email')}}">
                    </div> 
                        <span id="email" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('email') ?? null}}</span> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label> {{__('auth.user_type')}} </label>
                        <select name="role_id" class="form-control" id="role_select">
                            @foreach($roles as $role)
                                @if($role->role != "admin")
                                    <option value="{{$role->id}}" @if($role->id == old('role_id')) selected @endif>{{$role->title}}</option>
                                @endif
                            @endforeach
                        </select> 
                            <span id="role_id" style="top: -10px;position: relative;"
                                  class="text-danger">{{$errors->first('role_id') ?? null}}</span> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>  {{__('auth.full_address')}}</label>
                        <input type="text" name="full_address" value="{{old('full_address')}}" class="form-control text-left"
                               autocomplete="off"
                               placeholder="{{__('auth.full_address')}}">
                    </div> 
                        <span id="full_address" style="top: -10px;position: relative;"
                              class="text-danger">{{$errors->first('full_address') ?? null}}</span> 
                </div>
                {{--<div class="col-md-12 d-sm-block d-md-none">--}}
                {{--<div class="btn-group" style="display: flex;flex: 1">--}}
                {{--<div style="flex: 50;position: relative">--}}
                {{--<div style="background: url('{{asset("assets/img/facebookgoogle.jpg")}}') center center no-repeat;position: absolute;width: 30px;height: 30px;background-size: cover;top: 12px;left: 5px;background-position: 7px 2px;z-index: 9"></div>--}}
                {{--<button class="btn btn-default bg-white"--}}
                {{--style="width: 100%;border-radius:0;color:#000;text-align: right;border: 1px solid transparent;">--}}
                {{--تسجيل بواسطة فيسبوك--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--<div style="flex: 50;position: relative">--}}
                {{--<div style="background: url('{{asset("assets/img/facebookgoogle.jpg")}}') center center no-repeat;position: absolute;width: 30px;height: 30px;background-size: cover;top: 12px;left: 5px;background-position: -23px 2px;z-index: 9"></div>--}}
                {{--<button class="btn btn-default bg-white"--}}
                {{--style="width: 100%;border-radius:0;color:#000;text-align: right;border: 1px solid transparent;">--}}
                {{--تسجيل بواسطة جوجل--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="col-md-12 text-center mt-2">
                    <button id="submit_step" type="submit" class="btn btn-main btn-round text-white">
                        {{__('auth.complete_step1')}}
                    </button>
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
                    <div class="mdl-card mdl-shadow--2dp" id="stepper">

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
            <!--<div class="col-md-5">-->
            <!--    <div style="background: url('{{asset("assets/img/facebookgoogle.jpg")}}') center center no-repeat;position: absolute;width: 30px;height: 30px;background-size: cover;top: 12px;left: 80px;background-position: -23px 2px;"></div>-->
            <!--    <button class="btn btn-default bg-white" style="min-width:80%;color:#000;text-align: right">-->
            <!--        {{__('auth.login_gmail')}}-->
            <!--    </button>-->
            <!--</div>-->
            <!--<div class="col-md-5">-->
            <!--    <div style="background: url('{{asset("assets/img/facebookgoogle.jpg")}}') center center no-repeat;position: absolute;width: 30px;height: 30px;background-size: cover;top: 12px;left: 80px;background-position: 6px 2px;"></div>-->
            <!--    <button class="btn btn-default bg-white" style="min-width:80%;color:#000;text-align: right">-->
            <!--        {{__('auth.login_facebook')}}-->
            <!--    </button>-->
            <!--</div>-->
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
    </div>
    </body>

@endsection
@section('scripts')
    {{Html::script('assets/js/jquery.min.js')}}
    {{Html::script('assets/js/intlTelInput.min.js')}}
    {{Html::script('assets/js/utils.js')}}
    <script>
        $(document).ready(function () {
            var telInput = $("#phones");
            // initialise plugin
            telInput.intlTelInput({
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js",
                initialCountry: "auto",
                // separateDialCode: true,
                geoIpLookup: function (callback) {
                    $.get('https://ipinfo.io', function () {
                    }, "jsonp").always(function (resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback('AE');
                        setTimeout(() => {
                            $('#prefixs').val(telInput.intlTelInput("getSelectedCountryData").dialCode);
                        }, 1000)
                    });
                }
            });

            telInput.on("keyup change",
                function () {
                    setTimeout(() => {
                        $('#prefix').val(telInput.intlTelInput("getSelectedCountryData").dialCode);
                    }, 100)
                }
            );

        });
    </script>
    {{--{{Html::script('assets/js/mobileregister.js')}}--}}
    <script>
        $("#footer").remove();
        let error_elements = [];
        let elements = [];
        getAllElements();
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });
        $("#form").submit(function (e) {
            e.preventDefault();
            let data = new FormData(this);
            $('.loading-overlay').show();
            $.ajax({
                url: "{{route('handleRegister')}}",
                type: "post",
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                data: data,
                success: function (response) { 
                    setTimeout(function () {
                        $('.loading-overlay').fadeOut();
                    }, 1000);


                    if (response.status) {
                        setTimeout(function () {
                            window.location.href = "{{route('getRegisterView2')}}"+"/"+response.data.user.id;
                        }, 1000);
                    } else {
                        validation_messages(response.data.validation_errors)
                    }
                }
            }) 
            // setTimeout(() => {
            //     document.getElementById("form").submit();
            // }, 1000);
        });
        
        
        function getAllElements() {
            elements = []
            $("#form input , #form select").each(function (index) {
                let input = $(this);
                let name = input.attr('name')
                name = name.replace(/\]/g, '');
                name = name.replace(/\[/g, '.');
                elements.push(name)

            });
        }
        function validation_messages(errors) { 
            error_elements = []
            $.each(errors, function (key, value) {
                error_elements.push(key)
            });
            
            $.each(elements, function (i, element) {
                if (error_elements.includes(element)) {
                    let selector = element.replace(/\./g, '');
                    $(`#${selector}`).text(errors[element][0])
                } else {
                    let selector = element.replace(/\./g, '');
                    $(`#${selector}`).text('')
                }
            });
        }
        
        $('#role_select').change(function(e){
            let role = $(this).val();
            if (role == 4){
                $('#stepper').fadeOut();
                @if(app()->getLocale() == 'ar')
                    $('#submit_step').text('اتمام التسجيل');
                @else
                    $('#submit_step').text('Register');
                @endif
            } else {
                $('#stepper').fadeIn();
                $('#submit_step').text('{{__('auth.complete_step1')}}');
            }
        });
    </script>
@endsection