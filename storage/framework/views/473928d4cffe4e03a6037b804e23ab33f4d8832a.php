<div id="content" class="section direction" style="background: #eceff0">
    <div class="container-fluid">
        <div class="button-container">

        </div> 

        <div class="row mt-3">
            <div class="col-md-3 text-left">
                <?php echo $__env->make("pages.profile.user.templates.right_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-9 text-center">
                <?php echo $__env->make("pages.profile.user.templates.center_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div> 
        </div>

    </div>

</div>
