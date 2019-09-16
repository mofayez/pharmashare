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
        <div class="row">
            <div class="col-md-6 text-left">
                <fieldset>
                    <legend class="text_purple_gradient"><?php echo e(__('pharmacy.client_info')); ?>   </legend>
                    <div class="row">
                        <div class="col-md-4 d-none d-md-block">
                            <img class="img img-responsive img-thumbnail rounded img-raised" width="100%"
                                 src="<?php echo e($user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>">
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-capitalize m-0"><?php echo e($user->firstname . " " . $user->lastname); ?></h4>
                            <h5 dir="ltr"><?php echo e("@".$user->username); ?></h5>
                            <h6 dir="ltr">+(<?php echo e($user->prefix); ?>) <?php echo e($user->phone); ?></h6>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6 text-left">
                <fieldset>
                    <legend class="text_purple_gradient"><?php echo e(__('pharmacy.shipping_info')); ?>     </legend>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-capitalize m-0">
                                <?php echo e(__('pharmacy.shipping_type')); ?> :
                                <?php if($cart_before_save[0]['shipment']): ?>
                                    <?php if($cart_before_save[0]['shipment'] == 'with'): ?>
                                        <span><?php echo e(__('pharmacy.with_shipping')); ?> </span>
                                    <?php else: ?>
                                        <span><?php echo e(__('pharmacy.without_shipping')); ?> </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </h5>
                        </div>
                        <div class="col-md-12" style="overflow: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th><?php echo e(__('pharmacy.store_name')); ?> </th>
                                    <th><?php echo e(__('pharmacy.total')); ?>   </th>
                                    <th><?php echo e(__('pharmacy.payment_type')); ?>   </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $cart_before_save; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item['store']->firstname . " " . $item['store']->lastname); ?></td>
                                        <td><?php echo e($item['total_store_cost']); ?></td>
                                        <?php if(app()->getLocale() == 'ar'): ?>
                                            <td><?php echo e($item['choosed_payment']->display_name_ar); ?></td>
                                        <?php else: ?>
                                            <td><?php echo e($item['choosed_payment']->display_name_en); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 text-left">
                <fieldset>
                    <legend class="text_purple_gradient"><?php echo e(__('pharmacy.cart')); ?>   </legend>
                    <div class="row">
                        <div class="col-md-12"  style="overflow: scroll;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('pharmacy.product_name')); ?>   </th>
                                    <th><?php echo e(__('pharmacy.amount')); ?> </th>
                                    <th width="100px"><?php echo e(__('pharmacy.cost')); ?>   </th>
                                    <th width="200px"><?php echo e(__('pharmacy.store_name')); ?>   </th>
                                    <th><?php echo e(__('pharmacy.total')); ?> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total = 0 ?>
                                <?php $__currentLoopData = $cart_before_save; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $trader['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <?php echo e($item->drug->trade_name); ?> <br>
                                                (<?php echo e($item->drug->drugCategory->title); ?>)
                                                <br>
                                                <?php
                                                    $discount = null;
                                                    foreach(collect($item->FOC)->sortByDesc('foc_quantity') as $foc){
                                                        if($item->quantity >= $foc->foc_quantity){
                                                            $discount = $foc;
                                                            echo '<span class="text-danger">';
                                                            echo app()->getLocale() == 'ar' ? 'قيمة الخصم : ' . $foc->foc_discount .'%' : 'Discount Is :' . $foc->foc_discount .'%';
                                                            echo '</span>';
                                                            break;
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo e($item->quantity); ?></td>
                                            <td><?php echo e($item->offered_price_or_bonus); ?></td>
                                            <td><?php echo e($trader['store']->firstname . " " . $trader['store']->lastname); ?></td>
                                            <td>
                                                <?php if($discount): ?>
                                                    <del class="text-danger"><?php echo e($item->cost); ?></del><br>
                                                    <?php echo e(($item->cost - ($item->cost * ($discount->foc_discount/100)))); ?>

                                                <?php else: ?>
                                                    <?php echo e($item->cost); ?>

                                                <?php endif; ?>
                                            </td>
                                            <?php $total += $discount ? ($item->cost - ($item->cost * ($discount->foc_discount/100))) : $item->cost;?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <td>
                                        <?php echo e(__('pharmacy.total_plus')); ?>

                                    </td>
                                    <td class="bg-warning">
                                        <?php echo e($total); ?>

                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="text-center  m-auto">
            <?php echo e(Form::open([
                'id'=>'form',
                'method'=>'post',
                'route'=>'submitCheckout'
            ])); ?>

            <button class="btn btn-main" type="submit">
                <?php echo e(__('pharmacy.submit_checkout')); ?>

            </button>
            <?php echo e(Form::close()); ?>

            
            
            
        </div>
    </div>
</div>