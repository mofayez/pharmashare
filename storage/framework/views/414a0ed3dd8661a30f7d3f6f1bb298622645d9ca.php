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
                <div class="col-md-4">
                    <?php echo e(Form::open([
                        'method'=>'post',
                        'route'=>'handleDefaultSettings'
                    ])); ?>

                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3>
                                        <?php echo e(app()->getLocale() == 'ar' ? 'اقصي عدد طلبات' : 'Max Transaction Number'); ?>

                                    </h3>
                                    <label for=""><?php echo e(app()->getLocale() == 'ar' ? 'اقصي عدد طلبات' : 'Max Transaction Number'); ?></label>
                                    <input type="number" name="max_transaction_number" class="form-control" value="<?php echo e($settings->max_transaction_number ?? 0); ?>">
                                    <?php if($errors->has('max_transaction_number')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('max_transaction_number')); ?></span>
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