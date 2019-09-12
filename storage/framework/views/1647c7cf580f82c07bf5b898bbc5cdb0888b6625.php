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

                                <?php if(count($blocked_pharmacies->blockedPharmacies) == 0): ?>
                                    <div class="col-md-12 text-center">
                                        <img class="img-responsive" src="<?php echo e(asset('assets/img/empty-cart.png')); ?>" alt="">
                                        <h3> <?php echo e(__('settings.black_list')); ?> </h3>
                                    </div>
                                <?php else: ?>

                                    <div class="col-md-12 text-left">
                                        <h3> <?php echo e(__('settings.black_list')); ?> </h3>
                                    </div>
                                    <div class="col-md-12 table-scroll">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('auth.username')); ?> </th>
                                                <th> <?php echo e(__('auth.phone')); ?>   </th>
                                                <th width="100px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $blocked_pharmacies->blockedPharmacies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pharmacy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <?php echo e($pharmacy->pharmacy->firstname . ' ' . $pharmacy->pharmacy->lastname); ?>

                                                    </td>
                                                    <td dir="ltr">
                                                        <?php echo e($pharmacy->pharmacy->prefix . '-' . $pharmacy->pharmacy->phone); ?>

                                                    </td>
                                                    <td>
                                                        <button class="btn btn-warning"
                                                                onclick="unblock('<?php echo e($pharmacy->pharmacy->id); ?>')">
                                                            <?php echo e(__('settings.unblock')); ?>

                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>