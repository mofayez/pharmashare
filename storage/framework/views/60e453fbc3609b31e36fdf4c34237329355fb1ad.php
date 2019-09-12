<div id="content" class="section direction">
    <div class="container-fluid">
        <div class="button-container" style="margin-top: -121px">
            <ul class="list-unstyled list-inline ">
                <li class="list-inline-item">
                    <div class="cart-path">
                        <h2 class="text_h2_gradient">1</h2>
                    </div>
                    <h4 class="mt-1 cart-active"><?php echo e(__('pharmacy.cart')); ?> </h4>
                </li>
                <li class="list-inline-item">
                    <div class="cart-path">
                        <h2 class="text_h2_gradient">2</h2>
                    </div>
                    <h4 class="mt-1"><?php echo e(__('pharmacy.shipping')); ?></h4>
                </li>
                <li class="list-inline-item">
                    <div class="cart-path">
                        <h2 class="text_h2_gradient">3</h2>
                    </div>
                    <h4 class="mt-1"><?php echo e(__('pharmacy.checkout')); ?></h4>
                </li>
            </ul>
        </div>


        <div class="row mt-3">
            <div class="col-md-2 p-0">
                <?php if(in_array('cart',(array)$allowed_ads)): ?>
                    <?php $__currentLoopData = $first_ratio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->iteration == 2): ?>
                            <?php break; ?>
                        <?php endif; ?>
                        <?php if($item['original_image']): ?>
                            <div class="">
                                <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                                    <img src="<?php echo e(asset('assets/img/cron.png')); ?>" alt="">
                                    <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                        <?php echo e(__('profile.ads')); ?>

                                    </h6>
                                </div>
                                <a href="<?php echo e($item['link'] ?? '#'); ?>" target="_blank">
                                    <img src="<?php echo e($item['second_image']); ?>" alt="">
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>

            <div class="col-md-8 text-center mt-4">
                <?php echo $__env->make("pages.shopping.cart.templates.center_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div class="col-md-2 p-0">
                <?php if(in_array('cart',(array)$allowed_ads)): ?>
                    <?php $__currentLoopData = array_reverse($first_ratio,true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->iteration == 2): ?>
                            <?php break; ?>
                        <?php endif; ?>
                        <?php if($item['original_image']): ?>
                            <div class="p-0">
                                <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                                    <img src="<?php echo e(asset('assets/img/cron.png')); ?>" alt="">
                                    <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                        <?php echo e(__('profile.ads')); ?>

                                    </h6>
                                </div>
                                <a href="<?php echo e($item['link'] ?? '#'); ?>" target="_blank">
                                    <img src="<?php echo e($item['second_image']); ?>" alt="">
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>