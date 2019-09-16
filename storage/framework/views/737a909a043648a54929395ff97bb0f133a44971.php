<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("body"); ?>

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <?php echo $__env->make("includes.navbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="wrapper">
        <?php echo $__env->make("pages.shopping.shipping.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.shopping.shipping.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        $('#form').on('submit', function (e) {
            e.preventDefault();
            let form_data = $(this).serializeArray();
            $('.loading-overlay').show();

            $.ajax({
                method: 'post',
                url: '<?php echo e(route('submitPayment')); ?>',
                data: form_data,
                success: function (response) {
                    console.log(response);
                    setTimeout(() => {
                        $('.loading-overlay').fadeOut();
                        if (response.status){

                            location.href = "<?php echo e(route('getCheckoutView')); ?>";
                        }
                    }, 800);
                },
                error: function (errors) {

                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>