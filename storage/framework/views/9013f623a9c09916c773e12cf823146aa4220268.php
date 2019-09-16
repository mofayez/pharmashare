<style>
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        white-space: pre;
    }
</style>
<div class="row" style="z-index: 9;position:relative;"> 
    <div class="col-md-12">
        <div class="card" style="margin-top: -140px">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-2"style="position: absolute;top: -62px;left: 0;">
                        <a href="<?php echo e(route('getAddToFavouritesView')); ?>" class="btn btn-main">
                            <?php echo e(app()->getLocale() == 'ar' ? 'اضافة الي المخزن' : 'Add To Store  '); ?> 
                        </a>
                    </div>
                    <div class="col-md-12 text-center" id="no_data" style="<?php echo e(count($favourites) > 0 ? 'display:none': ''); ?>">
                        <img class="img-responsive" src="<?php echo e(asset('assets/img/empty-cart.png')); ?>" alt="">
                        <h3><?php echo e(__('profile.no_data')); ?></h3>
                    </div>  
                    <?php $__currentLoopData = $favourites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favourite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4" id="_<?php echo e($favourite->id); ?>">
                            <div class="card card-contact card-raised" style="min-height: 350px">
                                <?php echo e(Form::open([
                                    'route'=>'submitFavourite',
                                    'method'=>'post',
                                    'class'=>'fav_form'
                                ])); ?>

                                <div class="card-header text-center">
                                    <h5 class="card-title"><?php echo e($favourite->drug->trade_name ?? '-'); ?></h5>
                                    <h6 class="card-title"><?php echo e($favourite->drug->pharmashare_code ?? ''); ?></h6>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class=" table-scroll">
                                                <table class="table table-bordered table-scroll">
                                                    <tr>
                                                        <td><?php echo e(__('store.origin')); ?></td>
                                                        <td><?php echo e(__('store.manufacturer')); ?></td>
                                                        <td><?php echo e(__('store.strength')); ?></td>
                                                        <td><?php echo e(__('store.packet_size')); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo e($favourite->drug->active_ingredient); ?></td>
                                                        <td><?php echo e($favourite->drug->manufacturer); ?></td>
                                                        <td><?php echo e($favourite->drug->strength); ?></td>
                                                        <td><?php echo e($favourite->drug->pack_size); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="pharmashare_code"
                                           value="<?php echo e($favourite->drug->pharmashare_code); ?>">
                                    <input type="hidden" name="fav_id" value="<?php echo e($favourite->id); ?>">
                                    <input type="hidden" name="form" value="<?php echo e($favourite->drug->form); ?>">
                                    <input type="hidden" name="trade_name" value="<?php echo e($favourite->drug->trade_name); ?>">
                                    <input type="hidden" name="pack_size" value="<?php echo e($favourite->drug->pack_size); ?>">
                                    <input type="hidden" name="active_ingredient"
                                           value="<?php echo e($favourite->drug->active_ingredient); ?>">
                                    <input type="hidden" name="manufacturer" value="<?php echo e($favourite->drug->manufacturer); ?>">
                                    <input type="hidden" name="strength" value="<?php echo e($favourite->drug->strength); ?>">

                                    <div class="row">
                                        <div class="col-md-4 text-left">
                                            <div class="form-group">
                                                <label><?php echo e(__('store.amount')); ?></label>
                                                <input type="text" class="form-control"
                                                       name="available_quantity_in_packs"
                                                       placeholder="<?php echo e(__('store.amount')); ?>">
                                                <span class="error_amount text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-left">
                                            <div class="form-group">
                                                <label><?php echo e(__('store.cost')); ?></label>
                                                <input name="offered_price_or_bonus" type="text" class="form-control"
                                                       placeholder="<?php echo e(__('store.cost')); ?>">
                                                <span class="error_cost text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-left">
                                            <div class="form-group">
                                                <label><?php echo e(__('store.min_amount')); ?></label>
                                                <input name="minimum_order_value_or_quantity" type="text"
                                                       class="form-control"
                                                       placeholder="<?php echo e(__('store.min_amount')); ?>">
                                                <span class="error_min_amount text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12 text-center">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-main btn-round pull-right">
                                                    <?php echo e(app()->getLocale() == 'ar' ? 'تحديث' : 'Update'); ?>

                                                </button>
                                                <button type="button" class="btn btn-danger btn-round pull-right"
                                                        onclick="deleteFav('<?php echo e($favourite->id); ?>')">
                                                    <?php echo e(app()->getLocale() == 'ar' ? 'الغاء' : 'Delete'); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>