<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('pages.offers.navigators', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <?php echo e(__('admin.accept_image_ads')); ?>

                                    </h3>
                                </div>
                                <div class="col-md-12 table-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('admin.client')); ?></th>
                                            <th><?php echo e(__('admin.package')); ?></th>
                                            <th><?php echo e(__('admin.images')); ?></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($ad->created_by_admin): ?>
                                                <?php continue; ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td><?php echo e($ad->user->firstname ?? ''); ?> <?php echo e($ad->user->lastname ?? ''); ?></td>
                                                <td><?php echo e($ad->package->name ?? ''); ?> … <?php echo e($ad->package->price); ?></td>
                                                <td>
                                                    <?php if($ad->original_image): ?>
                                                        <a class="d-inline-block" data-fancybox="images"
                                                           href="<?php echo e($ad->original_image); ?>">
                                                            <img class="img-fluid" style="width: 100px;"
                                                                 src="<?php echo e($ad->original_image); ?>">
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($ad->scaled_image): ?>
                                                        <a class="d-inline-block" data-fancybox="images"
                                                           href="<?php echo e($ad->scaled_image); ?>">
                                                            <img class="img-fluid" style="width: 100px;"
                                                                 src="<?php echo e($ad->scaled_image); ?>">
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" dir="rtl">
                                                        <?php if($ad->approved): ?>
                                                            <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                    onclick="reject('<?php echo e($ad->id); ?>')">
                                                                <i class="now-ui-icons ui-1_simple-remove"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                        <?php if(!$ad->approved): ?>
                                                            <button class="btn btn-main p-2 pl-3 pr-3"
                                                                    onclick="approve('<?php echo e($ad->id); ?>')">
                                                                <i class="now-ui-icons ui-1_check"></i>
                                                            </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>