<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    
    <meta charset="utf-8"/>
    
    <title><?php echo e($pageTitle ?? "SITE"); ?></title>
    
    <link rel="apple-touch-icon" sizes="76x76" href="">
    <link rel="icon" type="image/png" href="">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    
    <link rel="canonical" href="<?php echo e(app('request')->url()); ?>"/>
    
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <?php echo e(Html::style('assets/css/bootstrap-rtl.min.css')); ?>

    <?php echo e(Html::style('assets/css/now-ui-kit.min.css')); ?>

    <?php echo e(Html::style('assets/css/animate.css')); ?>

    <?php echo e(Html::style('assets/css/demo.css')); ?>

    <?php echo e(Html::style('assets/css/main.css')); ?>

    <?php echo e(Html::style('assets/css/sweetalert2.min.css')); ?>

    <?php echo e(Html::style('assets/css/all.min.css')); ?>

    <?php echo e(Html::style('assets/css/sidebar-ar.css')); ?>

    <?php echo e(Html::style('assets/css/ar.css')); ?>

    <?php echo $__env->yieldContent('styles'); ?>

</head>
<?php echo $__env->yieldContent('body'); ?>

<?php echo $__env->make("includes.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo e(Html::script('assets/js/core/jquery.min.js')); ?>

<?php echo e(Html::script('assets/js/core/popper.min.js')); ?>

<?php echo e(Html::script('assets/js/core/bootstrap.min.js')); ?>

<?php echo e(Html::script('assets/js/now-ui-kit.min.js')); ?>

<?php echo e(Html::script('assets/js/sweetalert2.min.js')); ?>

<?php echo e(Html::script('assets/js/bootstrap-growl.min.js')); ?>



<?php if(session()->has('message')): ?>
    <script>
        $.growl({
            message: `<p><?php echo e(session()->get('message')); ?></p>`
        }, {
            type: 'info',
            allow_dismiss: !1,
            label: "Cancel",
            className: "btn-xs text-right btn-inverse",
            placement: {
                from: "bottom",
                align: "right"
            },
            delay: 2500,
            animate: {
                enter: "animated bounceInUp",
                exit: "animated fadeOut"
            },
            offset: {
                x: 30,
                y: 30
            }
        });
    </script>
<?php endif; ?>
<?php echo e(Html::script("assets/js/bootstrap-typeahead.js")); ?>

<?php echo $__env->yieldContent('scripts'); ?>
 
</html>
