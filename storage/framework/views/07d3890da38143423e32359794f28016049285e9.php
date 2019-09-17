<style>
    .my-group input {
        height: 40px !important;
        max-width: 55% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }

    @media  only screen and (max-width: 600px) {
        .my-group .btn-main {
            max-width: 25% !important;
        }
    }

    .pagination {
        justify-content: center;
    }

    .form-check {
        display: inline-block;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card card-blog card-plain card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group my-group">
                            <input type="text" class="form-control bg-white" name="query" autocomplete="off"
                                   placeholder=" <?php echo e(__('store.search_place')); ?> "
                                   value=" <?php echo e(app('request')->get('query')); ?>">
                            <button class="btn btn-default btn-main m-0 form-control border-0"
                                    onclick="filter()">  <?php echo e(__('store.search')); ?>

                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control text-center" id="datarange" dir="ltr">
                    </div>
                    <div class="col-md-12">
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="all"
                                       <?php if(!app('request')->get('status') || app('request')->get('status') == "all"): ?> checked="checked" <?php endif; ?>
                                >
                                <span class="form-check-sign"></span>
                                <?php echo e(__('store.all_status')); ?>

                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="order"
                                       <?php if(app('request')->get('status') == 'order'): ?> checked="checked" <?php endif; ?>
                                >
                                <span class="form-check-sign"></span>
                                <?php echo e(__('store.new_status')); ?>

                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="approved"
                                       <?php if(app('request')->get('status') == 'approved'): ?> checked="checked" <?php endif; ?>
                                >
                                <span class="form-check-sign"></span>
                                <?php echo e(__('store.accept_status')); ?>

                            </label>
                        </div>
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="status" value="rejected"
                                       <?php if(app('request')->get('status') == 'rejected'): ?> checked="checked" <?php endif; ?>
                                >
                                <span class="form-check-sign"></span>
                                <?php echo e(__('store.reject_status')); ?>

                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <?php if(in_array('store_orders',(array)$allowed_ads)): ?>
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
                    <div class="col-md-12 text-left">
                        <h4>
                            <?php echo e(__('store.orders')); ?>

                        </h4>
                    </div>
                    <div class="col-md-12 table-scroll">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('store.client')); ?>  </th>
                                <th><?php echo e(__('store.phone')); ?>  </th>
                                <th><?php echo e(app()->getLocale() =='ar' ? 'العنوان':'Location'); ?>  </th>
                                <th><?php echo e(__('store.total')); ?>  </th>
                                <th><?php echo e(__('store.date')); ?></th>
                                <th><?php echo e(__('store.points')); ?></th>
                                <th><?php echo e(__('store.status')); ?></th>
                                <th style="width: 100px;"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>#<?php echo e($order->id); ?>#</td>
                                    <td><?php echo e($order['pharmacy']->firstname . ' ' . $order['pharmacy']->lastname); ?></td>
                                    <td><?php echo e($order['pharmacy']->phone); ?></td>
                                    <td><?php echo e($order['pharmacy']->location->geo_location ?? ''); ?></td>
                                    <td><?php echo e($order->total_cost); ?></td>
                                    <td><?php echo e($order->created_at->format('Y-m-d')); ?></td>
                                    <td>
                                        <i class="fa fa-arrow-up text-success"></i> <?php echo e($order->reward_points['in'] ?? 0); ?>

                                        |
                                        <?php echo e($order->reward_points['out'] ?? 0); ?> <i class="fa fa-arrow-down text-danger"></i>
                                    </td>
                                    <td>
                                        <?php if($order->status->title == 'order'): ?>
                                            <label class="badge badge-info">
                                                <?php if(app()->getLocale() == 'ar'): ?>
                                                    <?php echo e($order->status->display_name_ar); ?>

                                                <?php else: ?>
                                                    <?php echo e($order->status->display_name_en); ?>

                                                <?php endif; ?>
                                            </label>
                                        <?php elseif($order->status->title == 'approved'): ?>
                                            <label class="badge badge-success">
                                                <?php if(app()->getLocale() == 'ar'): ?>
                                                    <?php echo e($order->status->display_name_ar); ?>

                                                <?php else: ?>
                                                    <?php echo e($order->status->display_name_en); ?>

                                                <?php endif; ?>
                                            </label>
                                        <?php else: ?>
                                            <label class="badge badge-danger">
                                                <?php if(app()->getLocale() == 'ar'): ?>
                                                    <?php echo e($order->status->display_name_ar); ?>

                                                <?php else: ?>
                                                    <?php echo e($order->status->display_name_en); ?>

                                                <?php endif; ?>
                                            </label>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-0">
                                        <div class="btn-group direction">
                                            <button class="btn btn-info" data-order-id="<?php echo e($order->id); ?>"
                                                    data-status="<?php echo e($order->status->title); ?>"
                                                    data-toggle="modal"
                                                    data-target="#showinfo_modal">
                                                <?php echo e(__('store.show_details')); ?>

                                            </button>
                                            
                                            
                                            
                                            
                                            
                                            <a href="<?php echo e(route('getChatView')); ?>?user_id=<?php echo e($order['pharmacy']->id); ?>"
                                               class="btn btn-main">
                                                <i class="now-ui-icons ui-1_send"></i>
                                            </a>
                                            <button class="btn btn-warning"
                                                    onclick="printreport('<?php echo e($order->id); ?>','<?php echo e($order->sale_number); ?>');">
                                                <?php echo e(__('store.bill')); ?>

                                            </button>

                                            <?php if(!in_array($order['pharmacy']->id, auth()->user()->blockedPharmaciesIds())): ?>
                                                <button class="btn btn-danger"
                                                        onclick="block_pharmacy('<?php echo e($order['pharmacy']->id); ?>');">
                                                    <?php echo e(__('store.block')); ?>

                                                </button>
                                            <?php else: ?>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12  justify-content-center">
                        <?php echo e($orders->links('vendor.pagination.bootstrap-4')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>