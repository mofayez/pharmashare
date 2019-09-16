<div class="row d-none d-md-block">
    
    
    
    
    
    


    
    
    
    
    
    <?php if(in_array('feeds',(array)$allowed_ads)): ?>
        <?php $__currentLoopData = $first_ratio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->index % 2 != 0): ?>
                <?php continue; ?>
            <?php endif; ?>
            <?php if($item['original_image']): ?>
                <div class="col-md-12 mb-2">
                    <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                        <img src="<?php echo e(asset('assets/img/cron.png')); ?>" alt="">
                        <h3 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                            <?php echo e(__('profile.ads')); ?>

                        </h3>
                    </div>
                    <a href="<?php echo e($item['link'] ?? '#'); ?>" target="_blank">
                        <img src="<?php echo e($item['second_image']); ?>" alt="">
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>