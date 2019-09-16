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
                    <div class="col-md-6 offset-md-2">
                        <form action="" class="form-inline mb-2">
                            <input type="text" class="form-control text-center bg-white typeahead" name="query"
                                   autocomplete="off"
                                   style="width:65%"
                                   value="<?php echo e(request()->get('query')); ?>"
                                   placeholder="<?php echo e(__('pharmacy.search_place')); ?>"/>
                            <div class="mb-2"></div>
                            <select class="form-control" name="limit">
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
                            <th><?php echo e(__('admin.bar_code')); ?></th>
                            <th><?php echo e(__('admin.product_name')); ?></th>
                            <th><?php echo e(__('admin.product_category')); ?></th>
                            <th><?php echo e(__('admin.origin')); ?></th>
                            <th><?php echo e(__('admin.manufacturer')); ?></th>
                            <th><?php echo e(__('admin.strength')); ?></th>
                            <th><?php echo e(__('admin.packet_size')); ?></th>
                            <th width="80px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($drugs)==0): ?>
                            <tr>
                                <td colspan="12"><?php echo e(__('admin.no_data')); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>00<?php echo e($drug->id); ?></td>
                                <td><?php echo e($drug->pharmashare_code); ?></td>
                                <td><?php echo e($drug->trade_name); ?></td>
                                <td><?php echo e($drug->drugCategory->title ?? ''); ?></td>
                                <td><?php echo e($drug->active_ingredient); ?></td>
                                <td><?php echo e($drug->manufacturer); ?></td>
                                <td><?php echo e($drug->strength); ?></td>
                                <td><?php echo e($drug->pack_size); ?></td>
                                <td>
                                    <div class="btn-group direction">
                                        <a href="<?php echo e(route('getAdminEditProductView',['id'=>$drug->id])); ?>"
                                           class="btn btn-main p-2 pl-3 pr-3">
                                            <?php echo e(__('settings.update')); ?>

                                        </a>
                                        <button class="btn btn-danger p-2 pr-3 pl-3"
                                                onclick="removeItem('<?php echo e($drug->id); ?>')">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12">
                    <?php echo e($drugs->appends(request()->except('page'))->render('pagination::bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </div>
</div>