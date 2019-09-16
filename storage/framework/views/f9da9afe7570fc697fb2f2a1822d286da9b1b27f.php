<div class="modal fade" id="all-users-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-center">
                <?php echo e(Form::open([
                    'route'=>'chatPostSendMessage',
                    'method'=>'post',
                    'id'=>'compose_message'
                ])); ?>

                <div class="row direction">
                    <input type="hidden" name="from_user_id" value="<?php echo e($user->id); ?>">
                    <div class="col-md-5 text-left">
                        <select name="to_user_id" class="selectpicker form-control"  data-live-search="true" 
                                    data-size="7"  data-style="btn-main" >
                            <?php $__currentLoopData = $all_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($user->id != $_user->id): ?>
                                <option value="<?php echo e($_user->id); ?>">
                                    <?php echo e($_user->firstname . " " . $_user->lastname); ?> | <?php echo e('@'.$_user->username); ?>

                                </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control bg-transparent"  name="message" placeholder="Write Your Message" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-main">
                        <i class="now-ui-icons ui-1_send"></i> Send Message
                    </button>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</div>