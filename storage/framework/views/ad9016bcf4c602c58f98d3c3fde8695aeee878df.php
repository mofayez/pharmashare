<style>
    .update-profile-loader {
        position: absolute;
        z-index: 10;
        bottom: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        line-height: 50px;
        color: #fff;
        transition: all 0.5s ease-in-out;
        display: none;
    }

    .update-profile-loader i {
        line-height: 280px;
        font-size: 30px;
    }

    .update-profile {
        position: absolute;
        z-index: 9;
        bottom: 0;
        width: 100%;
        height: 50px;
        background: rgba(0, 0, 0, 0.5);
        line-height: 50px;
        color: #ccc;
        opacity: 0;
        transition: all 0.5s ease-in-out;
    }

    .update-profile .title {
        margin: 0;
        padding: 0;
        line-height: 50px;
        cursor: pointer;
    }

    .card-image:hover .update-profile {
        opacity: 1;
    }
</style>
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
                                        'route'=>'uploadImagesAds',
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
                                                <?php echo e(__('admin.upload_image')); ?>   16:9
                                            </span>
                                        </label>
                                        <label class="btn btn-info btn-upload" for="inputImage"
                                               title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage" name="image"
                                                   accept="image/*">
                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                  title="Import image with Blob URLs">
                                              <i class="now-ui-icons arrows-1_share-66"></i>
                                                  <?php echo e(__('admin.upload_image')); ?> 2:1
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <span class="text-danger " style="display: none;" id="image_error"></span>
                                    </div>
                                    <div class="form-group text-left">
                                        <label>  <?php echo e(__('admin.link')); ?></label>
                                        <input name="link" type="url" autocomplete="off" class="form-control"/>
                                        <span class="text-danger " style="display: none" id="link_error"></span>
                                    </div>
                                    <div class=" text-left">
                                        <div class="form-group">
                                            <label>  <?php echo e(__('admin.viewed_by')); ?> </label>
                                            <select name="image_ad_type_id" class="form-control">
                                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
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
                                                <option value="<?php echo e($image_package->id); ?>"><?php echo e($image_package->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="text-danger " style="display: none" id="image_package_id_error"></span>
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
                                        <?php echo e(__('admin.add')); ?>

                                    </button>
                                    <?php echo e(Form::close()); ?>

                                </div>

                                <div class="col-md-8">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <img id="image2" src="<?php echo e(asset('assets/img/cropper.jpg')); ?>">
                                        </div>

                                        <div class="col-md-12">
                                            <img id="image" src="<?php echo e(asset('assets/img/cropper.jpg')); ?>">
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