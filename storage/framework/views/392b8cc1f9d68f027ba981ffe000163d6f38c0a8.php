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
<div class="row" style="position: relative;z-index: 9">
    <div class="col-md-12">
        <div class="card direction">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="false">
                            <?php echo e(__('admin.add_one_product')); ?>

                            <i class="now-ui-icons shopping_bag-16"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#profile" role="tab"
                           aria-selected="true">
                            <?php echo e(__('admin.upload_csv_sheet')); ?>

                            <i class="now-ui-icons arrows-1_cloud-upload-94"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('getAdminAllProductView')); ?>">
                            <?php echo e(__('admin.all_products')); ?>

                            <i class="now-ui-icons shopping_bag-16"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content text-center">
                    <div class="tab-pane active show" id="home" role="tabpanel">
                        <?php echo e(Form::open([
                            'method'=>'post',
                            'route'=>'addAdminPostNewProduct',
                        ])); ?>


                        <div class="row">
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label><?php echo e(__('admin.product_category')); ?>  </label>
                                    <input type="typeahead"
                                           autocomplete="off" class="form-control typeahead" name="form"
                                           value="<?php echo e(old('form')); ?>">
                                </div>
                                <?php if($errors->has('form')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('form')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label><?php echo e(__('admin.product_name')); ?></label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="trade_name"
                                           value="<?php echo e(old('trade_name')); ?>">
                                </div>
                                <?php if($errors->has('trade_name')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('trade_name')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 text-left">
                                <div class="form-group">
                                    <label><?php echo e(__('admin.bar_code')); ?> </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="pharmashare_code"
                                           value="<?php echo e(old('pharmashare_code')); ?>">
                                </div>
                                <?php if($errors->has('pharmashare_code')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('pharmashare_code')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label>  <?php echo e(__('admin.packet_size')); ?> </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="pack_size" value="<?php echo e(old('pack_size')); ?>">
                                </div>
                                <?php if($errors->has('pack_size')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('pack_size')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label><?php echo e(__('admin.origin')); ?>   </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="active_ingredient"
                                           value="<?php echo e(old('active_ingredient')); ?>">
                                </div>
                                <?php if($errors->has('active_ingredient')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('active_ingredient')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3 text-left">
                                <div class="form-group">
                                    <label> <?php echo e(__('admin.manufacturer')); ?> </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="manufacturer"
                                           value="<?php echo e(old('manufacturer')); ?>">
                                </div>
                                <?php if($errors->has('manufacturer')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('manufacturer')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> <?php echo e(app()->getLocale() == 'ar' ? 'سعر البيع' : 'Pharmacy Price'); ?> </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="pharmacy_price_aed"
                                           value="<?php echo e(old('pharmacy_price_aed')); ?>">
                                </div>
                                <?php if($errors->has('pharmacy_price_aed')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('pharmacy_price_aed')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label> <?php echo e(app()->getLocale() == 'ar' ? 'سعر الجمهور' : 'public Price'); ?> </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="public_price_aed"
                                           value="<?php echo e(old('public_price_aed')); ?>">
                                </div>
                                <?php if($errors->has('public_price_aed')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('public_price_aed')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2 text-left">
                                <div class="form-group">
                                    <label><?php echo e(__('admin.strength')); ?> </label>
                                    <input type="text" class="form-control"
                                           autocomplete="off" name="strength" value="<?php echo e(old('strength')); ?>">
                                </div>
                                <?php if($errors->has('strength')): ?>
                                    <span class="text-danger"><?php echo e($errors->first('strength')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="text-center col-md-12  m-auto">
                                <button class="btn btn-main">
                                    <?php echo e(__('admin.add')); ?>

                                </button>
                            </div>
                        </div>

                        <?php echo e(Form::close()); ?>

                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel">
                        <a href="<?php echo e(route('api.getDefaultAdminDrugsSheet')); ?>" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                            Download CSV Sheet
                        </a>
                        <?php echo e(Form::open([
                            'method'=>'post',
                            'route'=>'addAdminPostProductSheet',
                            'enctype'=>'multipart/form-data'
                        ])); ?>


                        <input type="file" name="drugsxlsx">
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>