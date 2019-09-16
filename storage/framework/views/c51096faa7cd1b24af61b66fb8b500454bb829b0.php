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

    <?php echo $__env->make('includes.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('styles'); ?>

</head>
<?php echo $__env->yieldContent('body'); ?>

<?php echo $__env->make("includes.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('includes.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('scripts'); ?>

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
</html>
