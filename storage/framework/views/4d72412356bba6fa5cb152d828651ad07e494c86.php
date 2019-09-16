<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }

    .form-check {
        display: inline-block;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 300px">
            <div class="card card-blog card-plain card-body">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <?php if(in_array('map',(array)$allowed_ads)): ?>
                                <?php $__currentLoopData = $second_ratio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($loop->iteration == 3): ?>
                                        <?php break; ?>
                                    <?php endif; ?>

                                    <?php if($loop->iteration == 2): ?>
                                        <div class="col-md-4">
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-md-4">
                                        <div style="position: absolute;z-index: 9;width: 30%;top: -20px;right: 0;">
                                            <img src="<?php echo e(asset('assets/img/cron.png')); ?>" alt="">
                                            <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                                <?php echo e(__('profile.ads')); ?>

                                            </h6>
                                        </div>
                                        <a href="<?php echo e($ads['link'] ?? '#'); ?>" target="_blank">
                                            <img src="<?php echo e($ads['third_image']); ?>" alt="">
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!--<div class="col-md-3">-->
                    <!--    <select class="select_types bg-white form-control" style="height: 56px;" name="types">-->
                    <!--        <option value="all" <?php echo e(app('request')->get('type') == 'all' || !app('request')->get('type') ? 'selected' : ''); ?>>-->
                    <!--            <?php echo e(app()->getLocale() == 'ar' ? 'الكل': 'All'); ?>-->
                    <!--        </option>-->
                    <!--        <option value="pharmacy" <?php echo e(app('request')->get('type') == 'pharmacy' ? 'selected' : ''); ?>>-->
                    <!--            <?php echo e(app()->getLocale() == 'ar' ? 'الصيدلي': 'Pharmacy'); ?>-->
                    <!--        </option>-->
                    <!--        <option value="store" <?php echo e(app('request')->get('type') == 'store' ? 'selected' : ''); ?>>-->
                    <!--            <?php echo e(app()->getLocale() == 'ar' ? 'المخزن': 'Store'); ?>-->
                    <!--        </option>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <div class="mt-2" id='map'></div>
                </div>
            </div>
        </div>
    </div>
</div>
