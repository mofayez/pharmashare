<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }
</style>
<div class="card">
    <div class="card card-blog card-plain card-body">

        <?php echo e(Form::open([
            'id'=>'form',
            'method'=>'post',
            'route'=>'submitPayment'
        ])); ?>


        <div class="row">
            <div class="col-md-6 text-left">
                <div class="form-group">
                    <label> <?php echo e(__('pharmacy.shipping_type')); ?>   </label>
                    <select name="shipment" class="form-control p-1">
                        <option value="with"> <?php echo e(__('pharmacy.with_shipping')); ?>     </option>
                        <option value="without"> <?php echo e(__('pharmacy.with_out_shipping')); ?>   </option>
                    </select>
                </div>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-12 text-left">
                <label><?php echo e(__('pharmacy.payment_type')); ?>    </label>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            <?php echo e(__('pharmacy.store_name')); ?>

                        </th>
                        <th>
                            <?php echo e(__('pharmacy.total')); ?>

                        </th>
                        <th>
                            <?php echo e(__('pharmacy.payment_type')); ?>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php if(count($all_payments) == 0): ?>
                     <tr>
                         <td colspan="3">
                             <?php echo e(app()->getLocale() == 'ar' ? 'ﻻ توجد بيانات لشرائك منتجات غير متوفرة' : 'no data'); ?>

                         </td>
                     </tr>
                     <?php endif; ?>
                    <?php $__currentLoopData = $all_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($payment['store']->firstname . " " .  $payment['store']->lastname); ?>

                            </td>
                            <td>
                                <input type="hidden" name="store_id[]" value="<?php echo e($payment['store']->id); ?>">
                                <?php echo e($payment['total_store_cost']); ?>

                            </td>
                            <td>
                                <select name="choosed_payments[]" class="form-control p-1">
                                    <?php $__currentLoopData = $payment['store']->paymentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($type->id); ?>">
                                            <?php if(app()->getLocale() == 'ar'): ?>
                                                <?php echo e($type->display_name_ar); ?>

                                            <?php else: ?>
                                                <?php echo e($type->display_name_en); ?>

                                            <?php endif; ?>
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if(count($all_payments) != 0): ?>
        <div class="text-center  m-auto">
            <button class="btn btn-main" type="submit">
                <?php echo e(__('pharmacy.submit_shipping')); ?>

            </button>
        </div>
        <?php endif; ?>
        <?php echo e(Form::close()); ?>

    </div>
</div>