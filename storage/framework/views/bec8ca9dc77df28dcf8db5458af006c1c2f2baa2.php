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
                                    <h3>   <?php echo e(__('store.points')); ?>  </h3>
                                </div>
                                <div class="col-md-12">

                                    <?php echo e(Form::open([
                                        'method'=>'post',
                                        'route'=>'handleCreatePoints'
                                    ])); ?>

                                    <div class="row text-left">
                                        <div class="col-md-12">
                                            <div class="text-left">
                                                <button class="btn btn-main" id="add_button" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                            <table class="table table-bordered" id="myTable">
                                                <thead>
                                                <tr class="text-left">
                                                    <th></th>
                                                    <th><?php echo e(__('store.amount_request')); ?></th>
                                                    <th><?php echo e(__('store.discount_calc')); ?></th>
                                                    <th><?php echo e(__('store.points')); ?></th>
                                                    <th><?php echo e(__('store.active')); ?></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$foc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>

                                                        <td>
                                                            <button type="button" class="btn btn-danger removerow">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </td>

                                                        <td>
                                                            <input name="foc_on[<?php echo e($k); ?>]" class="form-control text-center" type="hidden"
                                                                   value="<?php echo e($foc->foc_on); ?>">
                                                            <input name="foc_quantity[<?php echo e($k); ?>]" class="form-control text-center"
                                                                   type="number"
                                                                   value="<?php echo e($foc->foc_quantity); ?>">

                                                        </td>

                                                        <td>
                                                            <input name="foc_discount[<?php echo e($k); ?>]" class="form-control text-center"
                                                                   type="number"
                                                                   value="<?php echo e($foc->foc_discount); ?>">
                                                        </td>

                                                        <td><input name="reward_points[<?php echo e($k); ?>]" class="form-control text-center"
                                                                   type="number"
                                                                   value="<?php echo e($foc->reward_points); ?>">
                                                        </td>

                                                        <td>
                                                            <select name="is_activated[<?php echo e($k); ?>]" class="form-control text-center">
                                                                <option <?php if($foc->is_activated): ?> selected <?php endif; ?> value="1">Yes</option>
                                                                <option <?php if(!$foc->is_activated): ?> selected <?php endif; ?> value="0">No</option>
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center  m-auto">
                                            <button class="btn btn-main">
                                                <?php echo e(__('settings.update')); ?>

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