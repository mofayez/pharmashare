<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
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
</style>
<div class="row" style="z-index: 9;position:relative;">
    <div class="col-md-12">
        <div class="card" style="margin-top: -140px">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-8">
                        <form action="">
                            <div class="input-group my-group">
                                <input type="text" class="form-control bg-white" name="query" autocomplete="off"
                                       value="<?php echo e(app('request')->get('query')); ?>"
                                       placeholder="<?php echo e(__('store.search_place')); ?>">
                                <select class="form-control" name="limit" style="height: 40px!important;padding: 5px;">
                                    <option value="5" <?php echo e(request()->limit == 5 ? 'selected':''); ?>>5 per page</option>
                                    <option value="10" <?php echo e(request()->limit == 10 ? 'selected':''); ?>>10 per page</option>
                                    <option value="50" <?php echo e(request()->limit == 50 ? 'selected':''); ?>>50 per page</option>
                                    <option value="100" <?php echo e(request()->limit == 100 ? 'selected':''); ?>>100 per page
                                    </option>
                                    <option value="500" <?php echo e(request()->limit == 500 ? 'selected':''); ?>>500 per page
                                    </option>
                                    <option value="1000" <?php echo e(request()->limit == 1000 ? 'selected':''); ?>>1000 per page
                                    </option>
                                </select>
                                <input type="hidden" name="page" value="<?php echo e(request()->get('page') ?? 1); ?>">
                                <button class="btn btn-default btn-main m-0 form-control border-0"
                                        type="submit"> <?php echo e(__('store.search')); ?>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 text-center"
                     style="position: absolute;<?php echo e(app()->getLocale() == 'ar' ? 'left' : 'right'); ?>: 0;top: 0;">
                    <a href="<?php echo e(route('getAddProductView')); ?>" class="btn btn-main">
                        <?php echo e(app()->getLocale() == 'ar' ? 'اضافة منتج' : 'Add Product'); ?>

                    </a>
                    <a href="<?php echo e(route('getAddPointsView')); ?>" class="btn btn-danger">
                        <?php echo e(app()->getLocale() == 'ar' ? 'خصم على جميع المنتجات' : 'Discount All Over Products'); ?>

                    </a>
                </div>
                <div class="col-md-12 table-scroll">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            
                            <th><?php echo e(__('store.product_name')); ?>  </th>
                            <th><?php echo e(__('store.manufacturer')); ?></th>
                            <th><?php echo e(__('store.strength')); ?></th>
                            <th><?php echo e(__('store.origin')); ?></th>
                            <th><?php echo e(__('store.packet_size')); ?></th>
                            <th width="100"><?php echo e(__('store.amount')); ?></th>
                            <th width="100"><?php echo e(__('store.cost')); ?></th>
                            <th width="100"><?php echo e(__('store.min_amount')); ?></th>
                            <th><?php echo e(__('store.notes')); ?></th>
                            
                            <th style="width: 50px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($all_drugs) == 0): ?>
                            <tr>
                                <td colspan="11">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'ﻻ توجد بيانات ' : 'No Data'); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $all_drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(Form::open([
                                'method'=>'post',
                                'route'=>['getEditStoreView',$drug->id],
                            ])); ?>

                            <tr>
                                <td>00<?php echo e($drug->id); ?></td>
                                
                                <td>
                                    <?php echo e($drug->drug->trade_name); ?>

                                    <br>
                                    (<?php echo e($drug->drug->drugCategory->title ?? ''); ?>)
                                </td>
                                <td><?php echo e($drug->drug->manufacturer); ?></td>
                                <td><?php echo e($drug->drug->strength); ?></td>
                                <td><?php echo e($drug->drug->active_ingredient); ?></td>
                                <td><?php echo e($drug->drug->pack_size); ?></td>
                                <td class="position-relative">
                                    
                                    <input type="text" class="form-control" name="available_quantity_in_packs"
                                           autocomplete="off"
                                           value="<?php echo e($drug->available_quantity_in_packs); ?>">
                                    
                                    <?php if($drug->minimum_order_value_or_quantity > $drug->available_quantity_in_packs): ?>
                                        <i class="text-danger fas fa-arrow-alt-circle-down"
                                           style="position: absolute;right: 10px;top: 43%;"></i>
                                    <?php else: ?>
                                        <i class="text-success fas fa-arrow-alt-circle-up"
                                           style="position: absolute;right: 10px;top: 43%;"></i>
                                    <?php endif; ?>

                                    
                                    
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="offered_price_or_bonus"
                                           autocomplete="off"
                                           value="<?php echo e($drug->offered_price_or_bonus); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="minimum_order_value_or_quantity"
                                           autocomplete="off"
                                           value="<?php echo e($drug->minimum_order_value_or_quantity); ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="store_remarks"
                                           style="min-width: 120px" autocomplete="off"
                                           value="<?php echo e($drug->store_remarks); ?>">
                                </td>
                                
                                <td>
                                    <div class="btn-group direction">
                                        <button type="submit" class="btn btn-main p-2 pr-3 pl-3">
                                            <?php echo e(app()->getLocale() == 'ar' ? 'تحديث':'Update'); ?>

                                        </button>
                                        <a href="<?php echo e(route('getEditStoreView',['id'=>$drug->id])); ?>"
                                           class="btn btn-info p-2 pr-3 pl-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger p-2 pr-3 pl-3"
                                                onclick="remove('<?php echo e($drug->id); ?>');">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php echo e(Form::close()); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12">
                    <?php echo e($all_drugs->appends(request()->except('page'))->render('pagination::bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </div>
</div>