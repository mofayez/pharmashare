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
@endsection
@section('body')

    <body class="login-page">
    <div class="page-header header-filter" filter-color="purple">
        <div class="page-header-image"
             style="background:url('{{asset('assets/img/bg.jpg')}}')  left center;background-size: cover;"></div>
        <div class="content">
            <div class="container">
                <div class="col-md-5 m-auto">
                    <div class="card card-login card-plain">
                        {{Form::open([
                          'class'=>'form',
                          'route'=>'handleChangePassword',
                          'method'=>'post'
                          ])}}
                        <div class="card-header text-center">
                            <div class="logo-container" style="width: 100%">
                                {{--<img src="{{asset('assets/img/logo.png')}}" alt="">--}}
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="input-group form-group-no-border input-lg  @if($errors->has('password')) has-danger @endif">
                                <input type="password" class="form-control bg-white text-center text-dark" name="password"
                                       placeholder=" كلمة السر الجديدة ">
                            </div>
                            <div class="error" style="position:relative">
                                @if($errors->has('password'))
                                    <span style="position:relative;bottom: 10px;font-size: 10px;color: red;">
                                  {{$errors->first('password')}}
                                </span>
                                @endif
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <input type="password" class="form-control bg-white text-center text-dark" name="password_confirmation"
                                       placeholder="تأكيد كلمة السر الجديدة">
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-main btn-round btn-lg btn-block"
                                    type="submit"> تغيير كلمة السر</button>
                        </div>
                        {{Form::close()}}
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
    <script>
        $("#footer").remove()
    </script>
@endsection