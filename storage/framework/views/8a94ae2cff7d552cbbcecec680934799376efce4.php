<div class="modal fade" id="showLicense_modal" tabindex="-1" role="dialog" aria-labelledby="#showLicense_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body text-left">
                <h4 class="text_purple_gradient m-0"><?php echo e(__('admin.details')); ?></h4>
                <div class="row direction" id="user_info">
                    <div class="col-md-4">
                        <h5 class="text_purple_gradient"><?php echo e(__('admin.name')); ?></h5>
                        <p id="_fullname"></p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text_purple_gradient"><?php echo e(__('admin.user')); ?></h5>
                        <p id="_username"></p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text_purple_gradient"><?php echo e(__('admin.permission')); ?></h5>
                        <p id="_permission"></p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text_purple_gradient"><?php echo e(__('admin.phone')); ?></h5>
                        <p id="_phone"></p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text_purple_gradient"><?php echo e(__('admin.email')); ?></h5>
                        <p id="_email"></p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text_purple_gradient"><?php echo e(__('admin.full_address')); ?></h5>
                        <p id="_full_address"></p>
                    </div>
                </div>

                <div class="row direction" id="map_location">
                </div>

                <hr>
                <h4 class="text_purple_gradient m-0"><?php echo e(__('admin.license')); ?></h4>
                <div class="row direction" id="license_images">
                    <div class="col-md-6 text-center">
                        <img src="<?php echo e(asset('assets/img/no-image-icon-4.png')); ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
