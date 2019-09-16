<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }

    .form-check {
        display: inline-block;
    }
</style>
<div class="row">
    <?php if(count($my_orders) == 0): ?>
        <div class="col-md-12 mt-5">
            <img src="<?php echo e(asset('assets/img/empty-cart.png')); ?>" alt="">
            <?php if(app()->getLocale() == 'ar'): ?>
                <h4>ﻻ توجد طلبات</h4>
            <?php else: ?>
                <h4>No Orders</h4>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php $__currentLoopData = $my_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12">
            <div class="card" style="min-height: 300px">
                <div class="card card-blog card-plain card-body">
                    <div class="row">
                        <?php if($loop->first): ?>
                            <div class="col-md-12">
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="all"
                                               <?php if(!app('request')->get('status') || app('request')->get('status') == "all"): ?> checked="checked" <?php endif; ?>
                                        >
                                        <span class="form-check-sign"></span>
                                        <?php echo e(__('pharmacy.all_status')); ?>

                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="order"
                                               <?php if(app('request')->get('status') == 'order'): ?> checked="checked" <?php endif; ?>
                                        >
                                        <span class="form-check-sign"></span>
                                        <?php echo e(__('pharmacy.new_status')); ?>

                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="approved"
                                               <?php if(app('request')->get('status') == 'approved'): ?> checked="checked" <?php endif; ?>
                                        >
                                        <span class="form-check-sign"></span>
                                        <?php echo e(__('pharmacy.accept_status')); ?>

                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="rejected"
                                               <?php if(app('request')->get('status') == 'rejected'): ?> checked="checked" <?php endif; ?>
                                        >
                                        <span class="form-check-sign"></span>
                                        <?php echo e(__('pharmacy.reject_status')); ?>

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="row">
                                    <?php if(in_array('pharmacy_orders',(array)$allowed_ads)): ?>
                                        <?php $__currentLoopData = $second_ratio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($loop->iteration == 3): ?>
                                                <?php break; ?>
                                            <?php endif; ?>

                                            <?php if($loop->iteration == 2): ?>
                                                <div class="col-md-4">
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-md-4">
                                                <div style="position: absolute;z-index: 9;width: 30%;top: -20px;right: 0;">
                                                    <img src="<?php echo e(asset('assets/img/cron.png')); ?>" alt="">
                                                    <h6 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                                        <?php echo e(__('profile.ads')); ?>

                                                    </h6>
                                                </div>
                                                <a href="<?php echo e($ads['link'] ?? '#'); ?>" target="_blank">
                                                    <img src="<?php echo e($ads['third_image']); ?>" alt="">
                                                </a>
                                            </div>


                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-6 text-left">
                            <h5 class="m-0">
                                <?php echo e(__('pharmacy.order_no')); ?>:
                                <span dir="ltr">#<?php echo e($order->first()->id); ?>#</span>
                            </h5>
                            <h5 class="m-0">
                                <?php echo e(__('pharmacy.total')); ?>  :
                                <span dir="ltr">
                                        <?php echo e($order->sum('total_cost')); ?>

                                </span>
                            </h5>
                        </div>
                        <div class="col-6 text-right">
                            <h5 class="m-0 mb-4">
                                <?php echo e(__('pharmacy.date')); ?>:
                                <span><?php echo e($order->first()->created_at->format('Y-m-d')); ?></span>
                            </h5>
                        </div>

                        <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug_store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 text-left">
                                <button class="btn btn-main" type="button" data-toggle="collapse"
                                        data-target="#collapseExample<?php echo e($drug_store->id); ?>" aria-expanded="false"
                                        aria-controls="collapseExample<?php echo e($drug_store->id); ?>">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                    <?php echo e(__('pharmacy.store_name')); ?>:
                                    <?php echo e($drug_store->store->firstname . ' ' . $drug_store->store->lastname); ?>

                                </button>
                                <?php if(!$drug_store->store->blocked): ?>
                                    <button class="btn btn-danger" onclick="block_store('<?php echo e($drug_store->store->id); ?>')"
                                            type="button">
                                        <i class="fas fa-user-lock"></i>
                                        <?php echo e(__('pharmacy.block')); ?>

                                    </button>
                                <?php endif; ?>
                                <button class="btn btn-info" type="button" data-toggle="modal"
                                        data-store-id="<?php echo e($drug_store->store->id); ?>" data-target="#rates_modal">
                                    <i class="fas fa-star text-black"></i>
                                    <?php echo e(__('pharmacy.rate')); ?>


                                </button>
                                <button class="btn btn-default"
                                        onclick="printreport('<?php echo e($drug_store->id); ?>','<?php echo e($drug_store->sale_number); ?>')">
                                    <i class="fas fa-print"></i>
                                </button>
                                <?php if($drug_store->store->blocked): ?>
                                    <label class="badge badge-danger"><?php echo e(__('pharmacy.blocked')); ?></label>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 text-right">
                                <ul>
                                    <li class="list-inline-item">
                                        <h4 class="m-0 mt-2">
                                            <?php echo e(__('pharmacy.total')); ?>:
                                            <span><?php echo e($drug_store->total_cost); ?></span>
                                        </h4>
                                    </li>
                                    <li class="list-inline-item">
                                        <?php if($drug_store->status->title == 'order'): ?>
                                            <div class="bg-info mt-2 position-relative"
                                                 style="width:20px;height:20px;border-radius: 50%;top:5px"></div>
                                        <?php elseif($drug_store->status->title == 'approved'): ?>
                                            <div class="bg-success mt-2 position-relative"
                                                 style="width:20px;height:20px;border-radius: 50%;top:5px"></div>
                                        <?php else: ?>
                                            <div class="bg-danger mt-2 position-relative"
                                                 style="width:20px;height:20px;border-radius: 50%;top:5px"></div>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-12">
                                <div class="collapse" id="collapseExample<?php echo e($drug_store->id); ?>">
                                    <div class="cards card-bodys">
                                        <div class="row">
                                            <div class="col-md-12 table-scroll text-left">
                                                <h3 class="m-0 text_purple_gradient"><?php echo e(__('pharmacy.store_items')); ?></h3>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('pharmacy.product_name')); ?></th>
                                                        <th><?php echo e(__('pharmacy.amount')); ?></th>
                                                        <th><?php echo e(__('pharmacy.cost')); ?></th>
                                                        <th><?php echo e(__('pharmacy.total')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $sum = 0;?>
                                                    <?php $__currentLoopData = $drug_store->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($detail->drugStore->drug->trade_name); ?></td>
                                                            <td><?php echo e($detail->quantity); ?></td>
                                                            <td><?php echo e($detail->drugStore->offered_price_or_bonus); ?></td>
                                                            <td><?php echo e($detail->drugStore->offered_price_or_bonus * $detail->quantity); ?></td>
                                                        </tr>
                                                        <?php $sum += $detail->drugStore->offered_price_or_bonus * $detail->quantity;?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="text-right">
                                                            <h4 class="m-0"><?php echo e(__('pharmacy.total')); ?></h4>
                                                        </td>
                                                        <td class="text-left text-danger">
                                                            <?php echo e($sum); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td class="text-right">
                                                            <h4 class="m-0"><?php echo e(__('pharmacy.payment_type')); ?>  </h4>
                                                        </td>
                                                        <td class="text-left text-white bg-warning">
                                                            <?php if(app()->getLocale() == 'ar'): ?>
                                                                <?php echo e($drug_store->paymentType->display_name_ar); ?>

                                                            <?php else: ?>
                                                                <?php echo e($drug_store->paymentType->display_name_en); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr class="m-0">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
