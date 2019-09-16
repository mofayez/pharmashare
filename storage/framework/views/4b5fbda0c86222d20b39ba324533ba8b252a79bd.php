<div class="modal fade" id="all-users-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-center">
                <div class="row direction">
                    <?php $__currentLoopData = $all_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3">
                            <div class="media direction">
                                <a href="<?php echo e(route('getUserProfileView',['username'=>'@'.$user->username , 'id'=>$user->id])); ?>" class="media-body"
                                     style="display: flex;padding-bottom: 2px;margin-bottom: 5px;">
                                    <img style="width: 40px;height:45px;flex:1;border-radius: 50%;"
                                         class="media-object avatar img-raised" alt="64x64"
                                         src="<?php echo e($user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>">
                                    <h6 class="text-capitalize media-heading text-left p-1" style="flex:4;color: #524b5f;">
                                        <?php echo e($user->firstname . " " . $user->lastname); ?>

                                        <br>
                                        <small style="font-size:10px"><?php echo e("@" . $user->username); ?></small>
                                    </h6>
                                </a>
                            </div> 
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>