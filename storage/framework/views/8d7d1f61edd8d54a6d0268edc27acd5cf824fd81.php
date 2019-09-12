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

                                <div class="col-md-4">
                                    <?php echo e(Form::open([
                                        'id'=>'form',
                                        'route'=>'uploadUpdateImagesAds',
                                        'enctype'=>'multipart/form-data'
                                    ])); ?>

                                    <div class="btn-group">
                                        <label class="btn btn-info btn-upload" for="inputImage2"
                                               title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage2" name="image2"
                                                   accept="image/*">
                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                  title="Import image with Blob URLs">
                                              <i class="now-ui-icons arrows-1_share-66"></i>
                                                 <?php echo e(__('admin.upload_image')); ?> 16:9
                                            </span>
                                        </label>
                                        <label class="btn btn-info btn-upload" for="inputImage"
                                               title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage" name="image"
                                                   accept="image/*">
                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                  title="Import image with Blob URLs">
                                              <i class="now-ui-icons arrows-1_share-66"></i>
                                                <?php echo e(__('admin.upload_image')); ?>   2:1
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <span class="text-danger " style="display: none;" id="image_error"></span>
                                    </div>
                                    <div class="form-group text-left">
                                        <label><?php echo e(__('admin.link')); ?>  </label>
                                        <input name="link" type="url" autocomplete="off" value="<?php echo e($image_ads->link); ?>"
                                               class="form-control"/>
                                        <span class="text-danger " style="display: none" id="link_error"></span>
                                    </div>
                                    <div class="text-left">
                                        <div class="form-group">
                                            <label>  <?php echo e(__('admin.viewed_by')); ?> </label>
                                            <select name="image_ad_type_id" class="form-control">
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($type->id == $image_ads->type->id): ?> selected
                                                            <?php endif; ?> value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <?php if($errors->has('package_id')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('package_id')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group text-left">
                                        <label><?php echo e(__('admin.package')); ?> </label>
                                        <select name="image_package_id" class="form-control">
                                            <?php $__currentLoopData = $image_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image_package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($image_ads->package->id == $image_package->id): ?> selected
                                                        <?php endif; ?> value="<?php echo e($image_package->id); ?>"><?php echo e($image_package->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger " style="display: none"
                                              id="image_package_id_error"></span>
                                    </div>
                                    <div class="docs-preview clearfix">
                                        <h4 class="m-0 text-left"><?php echo e(__('admin.format')); ?></h4>
                                        <div id="preview2" class="img-preview preview-lg"></div>
                                    </div>
                                    <div class="docs-preview clearfix">
                                        <h4 class="m-0 text-left"><?php echo e(__('admin.format')); ?></h4>
                                        <div id="preview1" class="img-preview preview-lg"></div>
                                    </div>
                                    <button type="submit" class="btn btn-main">
                                        <?php echo e(__('admin.edit')); ?>

                                    </button>
                                    <?php echo e(Form::close()); ?>

                                </div>

                                <div class="col-md-8">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <?php if($image_ads->scaled_image): ?>
                                                <img id="image2" src="<?php echo e($image_ads->scaled_image); ?>">
                                            <?php else: ?>
                                                <img id="image2" src="<?php echo e(asset('assets/img/cropper.jpg')); ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-12">
                                            <?php if($image_ads->original_image): ?>
                                                <img id="image" src="<?php echo e($image_ads->original_image); ?>">
                                            <?php else: ?>
                                                <img id="image" src="<?php echo e(asset('assets/img/cropper.jpg')); ?>">
                                            <?php endif; ?>
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