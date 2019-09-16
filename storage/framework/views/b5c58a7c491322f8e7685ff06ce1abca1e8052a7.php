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
                                        <?php echo e(__('admin.my_ads')); ?>

                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                        <?php if($user->role_id == 2): ?>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#link1"
                                                   role="tablist">
                                                    <?php echo e(__('admin.my_feature_ads')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#link2" role="tablist">
                                                <?php echo e(__('admin.my_image_ads')); ?>

                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-space">
                                        <div class="tab-pane" id="link1">

                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('admin.package')); ?>  </th>
                                                        <th><?php echo e(__('admin.drugs')); ?></th>
                                                        <th><?php echo e(__('admin.start')); ?></th>
                                                        <th><?php echo e(__('admin.end')); ?></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $ads_features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td> <?php echo e($ads_feature->package->name); ?></td>
                                                            <td> <?php echo e($ads_feature->package->min_number_of_drugs); ?>

                                                                : <?php echo e($ads_feature->package->max_number_of_drugs); ?></td>
                                                            <td> <?php echo e($ads_feature->created_at->format('Y-m-d')); ?></td>
                                                            <td><?php echo e($ads_feature->valid_until); ?></td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    <a href=""
                                                                       class="btn btn-main p-2 pl-3 pr-3 disabled"
                                                                       disabled>
                                                                        <?php echo e(__('admin.pay')); ?>

                                                                    </a>
                                                                    
                                                                    <a href="<?php echo e(route('getViewFeatureAdsView',['id'=>$ads_feature->id])); ?>"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        <?php echo e(__('admin.edit')); ?>

                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                <div id="accordion_<?php echo e($ads_feature->id); ?>" role="tablist"
                                                                     aria-multiselectable="true" class="card-collapse">
                                                                    <div class="card card-plain">
                                                                        <div class="card-header" role="tab"
                                                                             id="headingOne_<?php echo e($ads_feature->id); ?>">
                                                                            <a data-toggle="collapse"
                                                                               data-parent="#accordion"
                                                                               href="#collapse_<?php echo e($ads_feature->id); ?>"
                                                                               aria-expanded="false"
                                                                               aria-controls="collapseOne_<?php echo e($ads_feature->id); ?>"
                                                                               class="collapsed">
                                                                                <span dir="rtl">(<?php echo e(count($ads_feature->details)); ?>)</span>
                                                                                <?php echo e(__('admin.show_all_drugs')); ?>

                                                                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                                            </a>
                                                                        </div>

                                                                        <div id="collapse_<?php echo e($ads_feature->id); ?>"
                                                                             class="collapse" role="tabpanel"
                                                                             aria-labelledby="headingOne_<?php echo e($ads_feature->id); ?>"
                                                                             style="">
                                                                            <div class="card-body">
                                                                                <div class="row direction">
                                                                                    <?php $__currentLoopData = $ads_feature->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <div class="col-md-3 text-left">
                                                                                            <h5 class="m-0 p-0"><?php echo e($detail->drugStore->drug->trade_name ?? ''); ?></h5>
                                                                                            <p class="p-0 m-0 text-info"><?php echo e($detail->drugStore->price ?? ''); ?>

                                                                                                <i class="fas fa-dollar-sign"></i>
                                                                                            </p>
                                                                                        </div>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane active" id="link2">

                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('admin.package')); ?>  </th>
                                                        <th><?php echo e(__('admin.admin_approve')); ?></th>
                                                        <th><?php echo e(__('admin.payment')); ?></th>
                                                        <th><?php echo e(__('admin.start')); ?></th>
                                                        <th><?php echo e(__('admin.end')); ?></th>
                                                        <th><?php echo e(__('admin.images')); ?></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $ads_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($ads_image->package->name); ?></td>
                                                            <td><?php echo e($ads_image->approved ? 'تم التأكيد' : 'غير مؤكد'); ?></td>
                                                            <td><?php echo e($ads_image->paid_at ? \Carbon\Carbon::parse($ads_image->paid_at)->format('Y-m-d') : 'غير مدفوع'); ?></td>
                                                            <td><?php echo e($ads_image->created_at->format('Y-m-d')); ?></td>
                                                            <td><?php echo e($ads_image->valid_until); ?></td>
                                                            <td>
                                                                <?php if($ads_image->original_image): ?>
                                                                    <a class="d-inline-block" data-fancybox="images"
                                                                       href="<?php echo e($ads_image->original_image); ?>">
                                                                        <img class="img-fluid" style="width: 100px;"
                                                                             src="<?php echo e($ads_image->original_image); ?>">
                                                                    </a>
                                                                <?php endif; ?>
                                                                <?php if($ads_image->scaled_image): ?>
                                                                    <a class="d-inline-block" data-fancybox="images"
                                                                       href="<?php echo e($ads_image->scaled_image); ?>">
                                                                        <img class="img-fluid" style="width: 100px;"
                                                                             src="<?php echo e($ads_image->scaled_image); ?>">
                                                                    </a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    <?php if(!$ads_image->paid_at): ?>
                                                                        <a href=""
                                                                           class="btn btn-main p-2 pl-3 pr-3 disabled"
                                                                           disabled="">
                                                                            <?php echo e(__('admin.pay')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <?php if($ads_image->open == 1): ?>
                                                                        <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                                onclick="show_or_hide('<?php echo e($ads_image->id); ?>','0')">
                                                                            <?php echo e(__('admin.stop')); ?>

                                                                        </button>
                                                                    <?php endif; ?>
                                                                    <?php if($ads_image->open == 0): ?>
                                                                        <button class="btn btn-main p-2 pl-3 pr-3"
                                                                                onclick="show_or_hide('<?php echo e($ads_image->id); ?>','1')">
                                                                            <?php echo e(__('admin.run')); ?>

                                                                        </button>
                                                                    <?php endif; ?>
                                                                    <a href="<?php echo e(route('getViewImageAdsView',['id'=>$ads_image->id])); ?>"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        <?php echo e(__('admin.edit')); ?>

                                                                    </a>
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
        </div>
    </div>
</div>