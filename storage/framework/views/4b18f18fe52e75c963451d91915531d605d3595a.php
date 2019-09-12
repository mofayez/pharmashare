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
                            <?php echo e(Form::open([
                                'method'=>"post",
                                'route'=>['updateDrugsItemsAds', $package_user->id]
                            ])); ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <?php echo e(__('admin.edit')); ?>

                                    </h3>
                                </div>
                                <div class="col-md-4 text-left mb-2">
                                    <label> <?php echo e(__('admin.package')); ?></label>
                                    <select name="package_id" class="form-control">
                                        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($package_user->package->id == $package->id): ?>
                                                    selected
                                                    <?php endif; ?>
                                                    value="<?php echo e($package->id); ?>"><?php echo e($package->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('package_id')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('package_id')); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12 table-scroll">
                                    <?php if($errors->has('drug_store_ids')): ?>
                                        <span class="text-danger"><?php echo e($errors->first('drug_store_ids')); ?></span>
                                    <?php endif; ?>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="100px"></th>
                                            <th><?php echo e(__('admin.product_name')); ?></th>
                                            <th><?php echo e(__('admin.amount')); ?></th>
                                            <th><?php echo e(__('admin.price')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check m-auto text-center">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" name="drug_store_ids[]"
                                                                   <?php if(in_array($drug->id , $drug_ids->toArray())): ?> checked <?php endif; ?>
                                                                   value="<?php echo e($drug->id); ?>" type="checkbox">
                                                            <span class="form-check-sign"></span>

                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo e($drug->drug->trade_name); ?>

                                                    <br>
                                                    (<?php echo e($drug->drug->drugCategory->title ?? ''); ?>)
                                                </td>
                                                <td><?php echo e($drug->available_quantity_in_packs); ?></td>
                                                <td><?php echo e($drug->offered_price_or_bonus); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-main">
                                        <?php echo e(__('admin.edit')); ?>

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