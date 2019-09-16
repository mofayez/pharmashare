<?php echo e(Html::script('assets/js/core/jquery.min.js')); ?>

<?php echo e(Html::script('assets/js/core/popper.min.js')); ?>

<?php echo e(Html::script('assets/js/core/bootstrap.min.js')); ?>

<?php echo e(Html::script('assets/js/bootstrap-datepicker.js')); ?>

<?php echo e(Html::script('assets/js/bootstrap-selectpicker.js')); ?>

<?php echo e(Html::script('assets/js/sweetalert2.min.js')); ?>

<?php echo e(Html::script('assets/js/bootstrap-switch.js')); ?>

<?php echo e(Html::script('assets/js/nouislider.min.js')); ?>

<?php echo e(Html::script('assets/js/now-ui-kit.min.js')); ?>

<?php echo e(Html::script('assets/js/bootstrap-growl.min.js')); ?>

<?php echo e(Html::script("assets/js/bootstrap-typeahead.js")); ?>

<?php echo e(Html::script('assets/js/snap.svg-min.js')); ?>

<?php echo e(Html::script('assets/js/emotion-ratings.min.js')); ?>

<?php echo e(Html::script('assets/js/classie.js')); ?>

<?php echo e(Html::script('assets/js/plugin.js')); ?>




<?php echo e(Html::style('assets/css/flatpickr.min.css')); ?>

<?php echo e(Html::script('assets/js/flatpickr.min.js')); ?>

<script>
    window.user = '<?php echo e(auth()->user()->id ?? ''); ?>';
    window.user_role = '<?php echo e(auth()->user()->role_id ?? ''); ?>';

    function globalAddNotify(message, type) {

        $.growl({
            message: `<b>   ${message}   </b>`
        }, {
            type: type,
            allow_dismiss: !1,
            label: "Cancel",
            className: "btn-xs text-right btn-inverse",
            placement: {
                from: "bottom",
                align: "center"
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
    }
</script>
<script>

    // $(document).on('switchChange.bootstrapSwitch', '.bootstrap-switch', function (e) {
    //     e.preventDefault();
    //     let link;
    //     <?php if(app()->getLocale() == 'ar'): ?>
    //         link = "<?php echo e(route('setEn')); ?>";
    //     <?php else: ?>
    //         link = "<?php echo e(route('setAr')); ?>";
    //     <?php endif; ?>
    //         location.href = link;
    // });
</script>
<?php echo e(Html::script('public/js/general.js')); ?>