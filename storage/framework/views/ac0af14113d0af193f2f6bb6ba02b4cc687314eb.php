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
                <div class="col-md-5">
                    <?php echo e(Form::open([
                        'method'=>'post',
                        'route'=>'setPaymentTypes'
                    ])); ?>

                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        <?php echo e(__('settings.update_payments')); ?>

                                    </h3>
                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" name="payment_types_ids[]"
                                                       value="<?php echo e($payment->id); ?>"
                                                       <?php if(in_array($payment->id , $current_payments)): ?>
                                                       checked=""
                                                       <?php endif; ?>
                                                       type="checkbox">
                                                <span class="form-check-sign"></span>
                                                <?php if(app()->getLocale() == 'ar'): ?>
                                                    <?php echo e($payment->display_name_ar); ?>

                                                <?php else: ?>
                                                    <?php echo e($payment->display_name_en); ?>

                                                <?php endif; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center  m-auto">
                        <button class="btn btn-main">
                            <?php echo e(__('settings.update')); ?>

                        </button>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
                <div class="col-md-4">
                    <?php echo e(Form::open([
                        'method'=>'post',
                        'route'=>'setMinOrderPricing'
                    ])); ?>

                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        <?php echo e(__('settings.update_pricing')); ?>

                                    </h3>
                                    <label for=""><?php echo e(__('settings.update_pricing')); ?></label>
                                    <input type="number" name="min_order_price" class="form-control" value="<?php echo e($store_setting->min_order_price ?? 0); ?>">
                                    <?php if($errors->has('min_order_price')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('min_order_price')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center  m-auto">
                        <button class="btn btn-main">
                            <?php echo e(__('settings.update')); ?>

                        </button>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</div>