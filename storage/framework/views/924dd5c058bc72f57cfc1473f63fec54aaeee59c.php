<div class="page-header page-header-small header-filter" filter-color="purple" color-on-scroll="200">

    <div class="page-header-image" data-parallax="true" style="background-image:url('<?php echo e(asset("assets/img/bg.jpg")); ?>');">
    </div>

    <div class="container">

        <div class="photo-container">
            <img src="<?php echo e(asset("assets/img/me.jpg")); ?>" alt="">
        </div>

        <p class="category"> <?php echo e(app()->getLocale() == 'ar' ? 'الادوية' : 'Drugs'); ?> </p>

    </div>
</div>
