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
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>
                                        <?php echo e(__('admin.packages')); ?>

                                    </h3>
                                </div>
                                <div class="col-md-12">
                                    <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="<?php echo e(route('getAddOfferPackagesView')); ?>"
                                               role="tablist">
                                                <?php echo e(__('admin.ads_feature_packages')); ?>

                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo e(route('getAddOfferImagePackagesView')); ?>"
                                               role="tablist">
                                                <?php echo e(__('admin.ads_image_packages')); ?>

                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-space">
                                        <div class="tab-pane active" id="link1">
                                            <?php echo e(Form::open([
                                                'route'=>'addAdsPackages',
                                                'method'=>'post'
                                            ])); ?>

                                            <div class="row text-left">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('admin.package_name')); ?> </label>
                                                        <input type="text" class="form-control" name="name"
                                                               autocomplete="off"
                                                               placeholder=" " value="<?php echo e(old('name')); ?>">
                                                    </div>
                                                    <?php if($errors->has('name')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label> <?php echo e(__('admin.drugs_from')); ?> </label>
                                                        <input type="number" class="form-control"
                                                               name="min_number_of_drugs" autocomplete="off"
                                                               placeholder="  "
                                                               value="<?php echo e(old('min_number_of_drugs')); ?>">
                                                    </div>
                                                    <?php if($errors->has('min_number_of_drugs')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('min_number_of_drugs')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('admin.drugs_to')); ?></label>
                                                        <input type="number" class="form-control"
                                                               name="max_number_of_drugs" autocomplete="off"
                                                               placeholder="  "
                                                               value="<?php echo e(old('max_number_of_drugs')); ?>">
                                                    </div>
                                                    <?php if($errors->has('max_number_of_drugs')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('max_number_of_drugs')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('admin.days')); ?>     </label>
                                                        <input type="text" class="form-control" name="period_in_days"
                                                               placeholder="    " autocomplete="off"
                                                               value="<?php echo e(old('period_in_days')); ?>">
                                                    </div>
                                                    <?php if($errors->has('period_in_days')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('period_in_days')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('admin.price')); ?></label>
                                                        <input type="text" class="form-control" name="price"
                                                               autocomplete="off"
                                                               placeholder="  " value="<?php echo e(old('price')); ?>">
                                                    </div>
                                                    <?php if($errors->has('price')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('price')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <button class="btn btn-main">
                                                        <?php echo e(__('admin.add')); ?>

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
            </div>
        </div>
    </div>
</div>