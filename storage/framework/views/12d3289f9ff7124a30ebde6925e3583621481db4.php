<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
<?php if(app()->getLocale() == 'ar'): ?>
    <?php echo e(Html::style('assets/css/bootstrap-rtl.min.css')); ?>

<?php else: ?>
    <?php echo e(Html::style('assets/css/bootstrap.min.css')); ?>

<?php endif; ?>

<?php echo e(Html::style("assets/css/emojionearea.min.css")); ?>


<?php echo e(Html::style('assets/css/now-ui-kit.min.css')); ?>

<?php echo e(Html::style('assets/css/animate.css')); ?>

<?php echo e(Html::style('assets/css/demo.css')); ?>

<?php echo e(Html::style('assets/css/main.css')); ?>

<?php echo e(Html::style('assets/css/sweetalert2.min.css')); ?>

<?php echo e(Html::style('assets/css/all.min.css')); ?>




<?php if(app()->getLocale() == 'ar'): ?>
    <?php echo e(Html::style('assets/css/sidebar-ar.css')); ?>

    <?php echo e(Html::style('assets/css/ar.css')); ?>

<?php else: ?>
    <?php echo e(Html::style('assets/css/sidebar.css')); ?>

    <?php echo e(Html::style('assets/css/en.css')); ?>

<?php endif; ?>
