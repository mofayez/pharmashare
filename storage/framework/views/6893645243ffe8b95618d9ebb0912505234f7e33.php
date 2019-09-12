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
                    <?php echo $__env->make('pages.setting.navigators', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <?php echo e(Form::open([
                                'route'=>'handleAdsControl',
                                'method'=>'post',
                            ])); ?>

                            <div class="row">

                                <div class="col-md-12 text-left">
                                    <h3>   <?php echo e(__('settings.ads_control')); ?>  </h3>
                                </div>
                                <?php $__currentLoopData = $ads_controls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3 text-left">

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="ads_controls[]"
                                                       <?php if($control->status): ?>
                                                       checked=""
                                                       <?php endif; ?>
                                                       value="<?php echo e($control->title); ?>"
                                                       type="checkbox">
                                                <span class="form-check-sign"></span>
                                                <?php if(app()->getLocale() == 'ar'): ?>
                                                    <?php echo e($control->name_ar); ?>

                                                <?php else: ?>
                                                    <?php echo e($control->name_en); ?>

                                                <?php endif; ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-main"><?php echo e(__('settings.update')); ?></button>
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