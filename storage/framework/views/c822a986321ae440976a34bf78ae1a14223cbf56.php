<div id="content" class="section direction" style="background: #eceff0">
    <div class="container-fluid">
        <div class="button-container">
            <button class="btn btn-main-bordered btn-round btn-lg" data-toggle="modal" data-target="#all-users-modal-lg">
                <span>
                    <?php echo e(__('profile.allusers')); ?>

                </span>
            </button>
            <a href="#" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="تابعنا هنا">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="تابعنا هنا">
                <i class="fab fa-instagram"></i>
            </a>
        </div>


        <div class="row mt-3">
            <div class="col-md-3 text-left">
                <?php echo $__env->make("pages.feeds.templates.right_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-6 text-center">
                <?php echo $__env->make("pages.feeds.templates.center_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-3 text-right">
                <?php echo $__env->make("pages.feeds.templates.left_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>

    </div>

</div>