<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('pages.setting.navigators', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <?php echo e(Form::open([
                                'method'=>'post',
                                'route'=>'postEditLicenses',
                                'enctype'=>'multipart/form-data'
                            ])); ?>

                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        <?php echo e(__('settings.edit_licenses')); ?>

                                    </h3>
                                </div>
                                <div class="col-md-12 text-left">
                                    <div class="row">
                                        
                                        <?php if(auth()->user()->role_id != 4): ?>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label>  <?php echo e(__('auth.trade_license')); ?>      </label>
                                                <input type="file" name="trade_license"
                                                       style="opacity: 1;position: relative"
                                                       class="form-controls text-left"
                                                       autocomplete="off"
                                                       placeholder=" <?php echo e(__('auth.trade_license')); ?>  ">
                                            </div>
                                            <?php if($errors->has('trade_license')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('trade_license')); ?></span>
                                            <?php endif; ?>
                                            <div class="row">
                                                <?php if($user->papers): ?>
                                                    <div class="col-md-12">
                                                        <h4>
                                                            <a href="<?php echo e($user->papers->trade_license_path); ?>">
                                                                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                <?php echo e(app()->getLocale() == 'ar' ? 'تحميل' : 'Download File'); ?>

                                                            </a>
                                                        </h4>
                                                        <img class="img-responsive"
                                                             src="<?php echo e($user->papers->trade_license_path); ?>" alt="">
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-md-6">
                                                        <img class="img-responsive"
                                                             src="<?php echo e(asset('assets/img/no-image-icon-4.png')); ?>" alt="">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if(auth()->user()->role_id != 4): ?>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label>  <?php echo e(__('auth.passport')); ?>    </label>
                                                <input type="file" name="passport" style="opacity: 1;position: relative"
                                                       class="form-controls text-left" autocomplete="off"
                                                       placeholder=" <?php echo e(__('auth.passport')); ?>  ">
                                            </div>
                                            <?php if($errors->has('passport')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('passport')); ?></span>
                                            <?php endif; ?>
                                            <div class="row">
                                                <?php if($user->papers): ?>
                                                    <div class="col-md-12">
                                                        <h4>
                                                            <a href="<?php echo e($user->papers->passport_license_path); ?>">
                                                                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                <?php echo e(app()->getLocale() == 'ar' ? 'تحميل' : 'Download File'); ?>

                                                            </a>
                                                        </h4>
                                                        <img class="img-responsive"
                                                             src="<?php echo e($user->papers->passport_license_path); ?>" alt="">
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-md-6">
                                                        <img class="img-responsive"
                                                             src="<?php echo e(asset('assets/img/no-image-icon-4.png')); ?>" alt="">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> 
                                                        <?php if(auth()->user()->role_id != 4): ?>
                                                            <?php echo e(__('auth.pharmacy_license')); ?>  
                                                        <?php else: ?>
                                                            <?php echo e(__('auth.role4_files')); ?>  
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="file" name="pharmacy_license"
                                                           style="opacity: 1;position: relative"
                                                           class="form-controls text-left"
                                                           autocomplete="off"
                                                           placeholder=" <?php echo e(__('auth.pharmacy_license')); ?>  ">
                                                </div>
                                                <?php if($errors->has('pharmacy_license')): ?>
                                                    <span style="top: -10px;position: relative;"
                                                          class="text-danger"><?php echo e($errors->first('pharmacy_license')); ?></span>
                                                <?php endif; ?>
                                                <div class="row">
                                                    <?php if($user->papers): ?>
                                                        <div class="col-md-12">
                                                        <h4>
                                                            <a href="<?php echo e($user->papers->pharmacy_license_path); ?>">
                                                                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                <?php echo e(app()->getLocale() == 'ar' ? 'تحميل' : 'Download File'); ?>

                                                            </a>
                                                        </h4>
                                                            <img class="img-responsive"
                                                                 src="<?php echo e($user->papers->pharmacy_license_path); ?>" alt="">
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="col-md-6">
                                                            <img class="img-responsive"
                                                                 src="<?php echo e(asset('assets/img/no-image-icon-4.png')); ?>" alt="">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-main">
                                            <?php echo e(__('settings.update')); ?>

                                        </button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>