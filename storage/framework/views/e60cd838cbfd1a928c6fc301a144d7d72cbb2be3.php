<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>


    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <?php echo e(Html::style('assets/css/multiple-select.css')); ?>

    <style>
        .section {
            padding: 10px 0;
        }
    </style>
    <style>
        .my-group select {
            height: auto !important;
            max-width: 25% !important;
        }

        .my-group .btn-main {
            height: auto !important;
            min-width: 15% !important;
        }

        .form-check {
            margin-top: -17px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("body"); ?>

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <?php echo $__env->make("includes.navbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="wrapper">
        <?php echo $__env->make("pages.admin.approve-posts.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.approve-posts.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script("assets/js/multiple-select.js")); ?>

    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

    </script>
    <script>

        function approve(id) {
            swal({
                title: '<?php echo e(__('settings.warning')); ?>',
                text: '<?php echo e(__('settings.are_you_sure')); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('settings.yes')); ?>',
                cancelButtonText:  '<?php echo e(__('settings.no')); ?>',
            }).then((result) => {
                if (result) {
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo e(route('handleApprovePosts')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: id
                        },
                        success:function (response) {
                            console.log(response)
                            if (response.status){
                                // location.reload();
                                $('#_'+id).remove();
                            }
                        }
                    })
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>