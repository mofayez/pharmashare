<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.js"></script>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
            background-color: #722ec2;
        }

        .docs-preview {
            margin-left: -1rem;
        }

        .img-preview {
            float: right;
            margin-bottom: .5rem;
            margin-left: .5rem;
            direction: ltr;
            overflow: hidden;
            margin: auto;
        }

        .img-preview > img {
            max-width: 100%;
        }

        .preview-lg {
            width: 100%;
            height: 240px;
            margin: auto;
        }

        .btn-primary.active:hover, .btn-primary:active:hover, .btn-primary:focus, .btn-primary:hover, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled):active:focus, .show > .btn-primary.dropdown-toggle, .show > .btn-primary.dropdown-toggle:focus, .show > .btn-primary.dropdown-toggle:hover {
            background-color: #463d3a;
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
        <?php echo $__env->make("pages.offers.allUserOffers.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.offers.allUserOffers.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });


        function show_or_hide(id, type) {

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
                console.log(result);
                if (result) {
                    $.ajax({
                        method: 'post',
                        url: '<?php echo e(route('ShowOrHide')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                            type: type,
                        },
                        success: function (response) {
                            console.log(response)
                            if (response.status) {
                                location.reload();
                            }
                        }
                    })
                }
            })
        }

        function runAds(id) {
            alert('sdsa');
        }

        <?php if(session()->has('success')): ?>
        globalAddNotify('<?php echo e(session()->get('success')); ?>', 'success');
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
        globalAddNotify('<?php echo e(session()->get('error')); ?>', 'danger');
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>