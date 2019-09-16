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

    <body class="login-page">
    <div class="page-header header-filter" filter-color="purple">
        <div class="page-header-image"
             style="background:url('<?php echo e(asset('assets/img/bg.jpg')); ?>')  left center;background-size: cover;"></div>
        <div class="content">
            <div class="container">
                <div class="col-md-5 m-auto">
                    <div class="card card-login card-plain">
                        <?php echo e(Form::open([
                          'class'=>'form',
                          'route'=>'handleChangePassword',
                          'method'=>'post'
                          ])); ?>

                        <div class="card-header text-center">
                            <div class="logo-container" style="width: 100%">
                                
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="input-group form-group-no-border input-lg  <?php if($errors->has('password')): ?> has-danger <?php endif; ?>">
                                <input type="password" class="form-control bg-white text-center text-dark" name="password"
                                       placeholder=" كلمة السر الجديدة ">
                            </div>
                            <div class="error" style="position:relative">
                                <?php if($errors->has('password')): ?>
                                    <span style="position:relative;bottom: 10px;font-size: 10px;color: red;">
                                  <?php echo e($errors->first('password')); ?>

                                </span>
                                <?php endif; ?>
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
    <script>
        $("#footer").remove()
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>