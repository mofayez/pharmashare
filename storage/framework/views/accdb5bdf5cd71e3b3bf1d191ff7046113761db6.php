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
                            <div class="row">

                                <div class="col-md-12 text-left">
                                    <h3>   <?php echo e(__('settings.complaints')); ?>  </h3>
                                </div>
                                <div class="col-md-12">

                                    <?php echo e(Form::open([
                                        'method'=>'post',
                                        'route'=>'handelCreateComplaintsUs'
                                    ])); ?>

                                    <div class="row text-left">
                                        <div class="col-md-4">
                                            <label>
                                                <?php echo e(__('settings.subject')); ?>

                                            </label>
                                            <input type="text" name="subject" class="form-control" value="<?php echo e(old('subject')); ?>">
                                            <?php if($errors->has('subject')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('subject')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label>
                                                <?php echo e(__('settings.message')); ?>

                                            </label>
                                            <textarea type="text" name="message" class="form-control"><?php echo e(old('message')); ?></textarea>
                                            <?php if($errors->has('message')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('message')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="text-center  m-auto">
                                            <button class="btn btn-main">
                                                <?php echo e(__('settings.add_complaint')); ?>

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
    </div>
</div>