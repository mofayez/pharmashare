<?php $__env->startSection('styles'); ?>
    <style media="screen">
        .has-success.input-lg:after, .has-danger.input-lg:after {
            right: 85% !important;
            top: 15px !important;
        }

        input::placeholder {
            color: #555 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>
    <?php echo $__env->make('front_site.templates.nav_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <body class="login-page">
    <div class="page-header header-filter" filter-color="purple">
        <div class="page-header-image"
             style="background:url('<?php echo e(asset('assets/img/bg.jpg')); ?>')  left center;background-size: cover;"></div>
        <div class="content">
            <div class="container">
                <div class="col-md-5 m-auto">
                    <div class="card card-login card-plain">
                        <?php echo e(Form::open([
                          'id'=>'form',
                          'class'=>'form',
                          'route'=>'handleresetPassword',
                          'method'=>'post'
                          ])); ?>

                        <div class="card-header text-center">
                            <div class="logo-container" style="width: 100%">
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group" dir="rtl">
                                <input type="tel" style="width: 70%;text-align: left;" id="phone" name="phone" dir="ltr"
                                       class="form-control" value="" autocomplete="off">
                                <input type="tel" style="width: 30%;" id="prefix" name="prefix" dir="ltr"
                                       class="form-control text-center" value="971" autocomplete="off">
                            </div>
                            <div class="error" style="position:relative">
                                <?php if($errors->has('phone')): ?>
                                    <span style="position:relative;bottom: 10px;font-size: 10px;color: red;">
                                  <?php echo e($errors->first('phone')); ?>

                                </span>
                                <?php endif; ?>
                                <?php if(session()->has('error')): ?>
                                    <span style="position:relative;bottom: 10px;font-size: 10px;color: red;">
                                  <?php echo e(session()->get('error')); ?>

                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-main btn-round btn-lg btn-block"
                                    type="submit"><?php echo e(app()->getLocale() == 'ar' ? ' استعادة كلمة السر' : 'Reset Password'); ?>

                            </button>
                        </div>
                        <?php echo e(Form::close()); ?>

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
                                <a href="<?php echo e(route("setAr")); ?>">
                                    العربية
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route("setEn")); ?>">
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <!--Hotlinked Account Kit SDK-->
    <script src="https://sdk.accountkit.com/en_EN/sdk.js"></script>
    <script>
        $(document).ready(function () {

            $('#form').on('submit', function (evt) {
                evt.preventDefault();

                phone_btn_onclick();


            });

            $('._5xrj').on('click', function (evt) {
                evt.preventDefault();

                $.ajax({
                    url: "<?php echo e(route('FbActivation')); ?>",
                    method: 'GET',
                    async: false,
                    data: {code: $('._55r1 _5xrg _5xri').val()},
                    success: function (result) {
                        console.log(result.status);
                    }
                });
            });
        })
    </script>

    <script>
        // initialize Account Kit with CSRF protection
        AccountKit_OnInteractive = function () {
            AccountKit.init(
                {
                    appId: 1924855164257064,
                    state: "abcd",
                    version: "v1.0",
                    debug: true
                }
                //If your Account Kit configuration requires app_secret, you have to include ir above
            );
        };

        // login callback
        function loginCallback(response) {
            console.log(response);
            if (response.status === "PARTIALLY_AUTHENTICATED") {
                // document.getElementById("code").value = response.code;
                // document.getElementById("csrf_nonce").value = response.state;
                // document.getElementById("my_form").submit();
                $('#form')[0].submit();

            }
            else if (response.status === "NOT_AUTHENTICATED") {
                // handle authentication failure
                console.log("Authentication failure");
            }
            else if (response.status === "BAD_PARAMS") {
                // handle bad parameters
                console.log("Bad parameters");
            }
        }

        // phone form submission handler
        function phone_btn_onclick() {
            // var countryCode = document.getElementById("prefix").value;
            // var phoneNumber = document.getElementById("phone").value;
            var countryCode = $('input[name="prefix"]').val();
            var phoneNumber = $('input[name="phone"]').val();
            console.log(countryCode);
            console.log(phoneNumber);
            // you can add countryCode and phoneNumber to set values
            AccountKit.login('PHONE',
                {countryCode: '+' + countryCode, phoneNumber: phoneNumber},
                loginCallback);
        }

        // destroying session
        function logout() {
            document.location = 'logout.php';
        }

    </script>
    <script>
        $("#footer").remove()
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>