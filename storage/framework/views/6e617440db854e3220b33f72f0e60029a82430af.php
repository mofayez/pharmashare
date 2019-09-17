<?php echo e(Form::open([
    'route'=>'handleAddPoints',
    'method'=>'post'
])); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-blog card-plain card-body pt-0">
                <div class="card-body bg-white mr-2 ml-2">
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
                        <?php $__currentLoopData = $foces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$foc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="text-center">
                        <button class="btn btn-main" type="submit">
                            <?php echo e(__('store.add')); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo e(Form::close()); ?>