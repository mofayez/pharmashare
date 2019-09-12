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
                                        <?php echo e(__('admin.packages')); ?>

                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#link1" role="tablist">
                                                <?php echo e(__('admin.ads_feature_packages')); ?>

                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#link2" role="tablist">
                                                <?php echo e(__('admin.ads_image_packages')); ?>

                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-space">
                                        <div class="tab-pane active" id="link1">

                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>  <?php echo e(__('admin.package')); ?></th>
                                                        <th><?php echo e(__('admin.drugs')); ?></th>
                                                        <th><?php echo e(__('admin.price')); ?></th>
                                                        <th><?php echo e(__('admin.days')); ?></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($package->name); ?></td>
                                                            <td><?php echo e($package->min_number_of_drugs .' : '. $package->max_number_of_drugs); ?></td>
                                                            <td><?php echo e($package->price); ?></td>
                                                            <td><?php echo e($package->period_in_days); ?></td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    <a href="<?php echo e(route('getEditOfferPackagesView',['id'=>$package->id])); ?>"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        <?php echo e(__('admin.edit')); ?>

                                                                    </a>
                                                                    <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                            onclick="deleteAdsPackage('<?php echo e($package->id); ?>')">
                                                                        <?php echo e(__('admin.delete')); ?>

                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="link2">
                                            <div class="col-md-12 table-scroll">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th> <?php echo e(__('admin.ads_type')); ?></th>
                                                        <th><?php echo e(__('admin.price')); ?></th>
                                                        <th><?php echo e(__('admin.period')); ?></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $image_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image_package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($image_package->name); ?></td>
                                                            <td><?php echo e($image_package->price); ?></td>
                                                            <td><?php echo e($image_package->period_in_days); ?></td>
                                                            <td>
                                                                <div class="btn-group direction">
                                                                    <a href="<?php echo e(route('getEditOfferImagePackagesView',['id'=>$image_package->id])); ?>"
                                                                       class="btn btn-info p-2 pl-3 pr-3">
                                                                        <?php echo e(__('admin.edit')); ?>

                                                                    </a>
                                                                    <button class="btn btn-danger p-2 pr-3 pl-3"
                                                                            onclick="deleteAdsImagePackage('<?php echo e($image_package->id); ?>')">
                                                                        <?php echo e(__('admin.delete')); ?>

                                                                    </button>
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