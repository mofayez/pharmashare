<div class="row d-none d-md-block">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="card card-blog card-plain card-body profile-float">
                <div class="card-image">
                    <a href="#">
                        <img class="img img-responsive img-thumbnail rounded img-raised" style="margin-top:100px" width="100%"
                             src="<?php echo e($current_user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>">
                    </a>
                </div>
                <div class="card-body bg-white mr-2 ml-2">

                    <ul class="list-unstyled">
                        <li>
                            <h5 class="mb-1" dir="ltr"><?php echo e("@".$current_user->username); ?></h5>
                            <h6 style="color: #999"> <?php echo e($current_user->firstname . " " . $current_user->lastname); ?></h6>
                            <hr>
                            <label class="badge badge-default"><?php echo e($current_user->role->title); ?></label>
                            <?php if($current_user->activated): ?>
                                <label class="badge badge-success">activated</label>
                            <?php else: ?>
                                <label class="badge badge-danger">not activated</label>
                            <?php endif; ?>
                        </li>
                        <?php if($current_user->email): ?>
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -695px;"></div>
                                    <span class="pr-2 pl-2" style="font-size: 11px">
                                    <?php echo e($current_user->email); ?>

                                </span>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if($current_user->phone): ?>
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1409px;"></div>
                                    <div class="pr-2 pl-2" style="direction:ltr;font-size: 11px;display: inline-block">
                                        +(<?php echo e($current_user->prefix); ?>) <?php echo e($current_user->phone); ?>

                                    </div>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if($current_user->full_address): ?>
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1472px;"></div>
                                    <div class="mr-2 ml-2" style="display: inline-block;font-size: 11px">
                                        <?php echo e($current_user->full_address); ?>

                                    </div>
                                    <hr style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if($current_user->location): ?>
                            <li>
                                <div>
                                    <div class="btn-post-compose position-relative"
                                         style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -1472px;"></div>
                                    <div class="mr-2 ml-2 float-right"
                                         style="display: inline-block;font-size: 11px;width: 85%">
                                        <?php echo e($current_user->location->location); ?>

                                    </div>
                                    <hr class="mt-3" style="padding: 0;margin: 5px;">
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
