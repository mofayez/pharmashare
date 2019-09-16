<div class="page-header page-header-small header-filter" filter-color="purple" color-on-scroll="200">

    <div class="page-header-image" data-parallax="true" style="background-image:url('<?php echo e(asset("assets/img/bg.jpg")); ?>');">
    </div>

    <div class="container">

        <div class="photo-container">
            <img src="<?php echo e(asset("assets/img/me.jpg")); ?>" alt="">
        </div>

        <h3 class="title pb-2"><?php echo e(__('profile.name')); ?>   </h3>
        <p class="category">  <?php echo e(__('profile.job')); ?> </p>
        <p class="category d-md-none"> 
            <?php if($user->activated): ?>
                <label class="badge badge-success">activated</label>
            <?php else: ?>
                <label class="badge badge-danger">not activated</label>
            <?php endif; ?>
        </p>

        <div class="content">
            <div class="social-description" style="bottom: 35px;position: relative;">
                <h2><?php echo e(count($all_users)); ?></h2>
                <p><?php echo e(__('profile.members')); ?></p>
            </div>
            <div class="social-description" style="bottom: 35px;position: relative;">
                <h2><?php echo e(count($posts)); ?></h2>
                <p><?php echo e(__('profile.posts')); ?></p>
            </div>
        </div>

    </div>
</div>
