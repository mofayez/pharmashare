<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-blog card-plain card-body pt-0">
                <div class="card-body bg-white mr-2 ml-2">
                    <button id="toggle_bars" class="btn btn-main p-2 d-none d-md-block float-right">
                        <i class="fas fa-filter"></i>
                        <?php echo e(__('pharmacy.filter')); ?>

                    </button>
                    <h4 class="text-left text_purple_gradient"><?php echo e(__('pharmacy.show_products')); ?></h4>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                        <tr>

                            <th></th>
                            <th width="35%"><?php echo e(__('pharmacy.product_name')); ?></th>
                            <th><?php echo e(__('pharmacy.cost')); ?></th>
                            <th><?php echo e(__('pharmacy.manufacturer')); ?></th>
                            <th><?php echo e(__('pharmacy.origin')); ?></th>
                            <th><?php echo e(__('pharmacy.store_name')); ?></th>
                            <th><?php echo e(__('pharmacy.strength')); ?></th>
                            <th><?php echo e(__('pharmacy.packet_size')); ?></th>
                            <th><?php echo e(__('pharmacy.rate')); ?></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="row">
                        <?php if(in_array('shopping',(array)$allowed_ads)): ?>
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
            </div>
        </div>
    </div>
</div>
