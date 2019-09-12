<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 267px;">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-8 offsets-md-2">
                        <form action="" class="form-inline mb-2">
                            <input type="text" class="form-control text-center bg-white typeahead" name="query"
                                   autocomplete="off"
                                   style="width:65%"
                                   value="<?php echo e(request()->get('query')); ?>"
                                   placeholder="<?php echo e(__('pharmacy.search_place')); ?>"/>
                            <!--<div class="mb-2"></div>-->
                            <select class="form-control" name="limit">
                                <option value="1" <?php echo e(request()->limit == 1 ? 'selected':''); ?>>1 per page</option>
                                <option value="5" <?php echo e(request()->limit == 5 ? 'selected':''); ?>>5 per page</option>
                                <option value="10" <?php echo e(request()->limit == 10 ? 'selected':''); ?>>10 per page</option>
                                <option value="50" <?php echo e(request()->limit == 50 ? 'selected':''); ?>>50 per page</option>
                                <option value="100" <?php echo e(request()->limit == 100 ? 'selected':''); ?>>100 per page</option>
                                <option value="500" <?php echo e(request()->limit == 500 ? 'selected':''); ?>>500 per page</option>
                                <option value="1000" <?php echo e(request()->limit == 1000 ? 'selected':''); ?>>1000 per page</option>
                            </select>
                            <input type="hidden" name="page" value="<?php echo e(request()->get('page') ?? 1); ?>">
                            <button type="submit" class="btn btn-main   btn-round">
                                <i class="now-ui-icons ui-1_check"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 table-scroll">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Serial</th>
                            <th><?php echo e(__('admin.status')); ?></th>
                            <th>Store</th>
                            <th>Pharmacy</th>
                            <th><?php echo e(__('admin.payment')); ?></th>
                            <th>Total</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($orders)==0): ?>
                            <tr>
                                <td colspan="12"><?php echo e(__('admin.no_data')); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>00<?php echo e($order->id); ?></td>
                                <td>#<?php echo e($order->sale_number); ?></td> 
                                <td><?php echo e($order->status->title ?? ''); ?></td>
                                <td><?php echo e($order->store->firstname ?? ''); ?> <?php echo e($order->store->lastname ?? ''); ?></td>
                                <td><?php echo e($order->pharmacy->firstname ?? ''); ?> <?php echo e($order->pharmacy->lastname ?? ''); ?></td>
                                <td><?php echo e($order->paymentType->display_name_en ?? ''); ?></td>
                                <td><?php echo e($order->total_cost); ?></td> 
                                <td><?php echo e($order->created_at); ?></td>
                                <td>
                                    <button class="btn btn-info" data-order-id="<?php echo e($order->id); ?>"
                                            data-store-id="<?php echo e($order->store->id); ?>" 
                                            data-status="<?php echo e($order->status->title); ?>"
                                            data-toggle="modal"
                                            data-target="#showinfo_modal">
                                        <?php echo e(__('store.show_details')); ?>

                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12">
                    <?php echo e($orders->appends(request()->except('page'))->render('pagination::bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </div>
</div>