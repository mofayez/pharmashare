<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
            background-color: #722ec2;
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
        <?php echo $__env->make("pages.setting.getSlideHeader.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.setting.getSlideHeader.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

            $('#change_profile').on('click', function () {
                $('input[name="profile-image"]').trigger('click');
            });
            $('input[name="profile-image"]').on('change', function () {
                showMyImage(this);
            });
        });


        //helpers
        function showMyImage(fileInput) {
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function (e) {
                    $('.update-profile-loader').show();

                    let data = new FormData();
                    data.append('_token','<?php echo e(csrf_token()); ?>');
                    data.append('slide_id','<?php echo e($slide->id); ?>');
                    data.append('file', files[0]);
                    let image = this.result;
                    setTimeout(() => {
                        $.ajax({
                            method: 'POST',
                            url: '<?php echo e(route('handleHeaderUpdateImage')); ?>',
                            processData: false,  // Important!
                            contentType: false,
                            cache: false,
                            data: data,
                            success: function (response) {
                                console.log(response);
                                if (response.status){
                                    $("#image-preview").attr('src', image);
                                    $('.update-profile-loader').hide();
                                }
                            },
                            error: function (errors) {
                                console.log(errors)
                            }
                        });
                    }, 1000);
                }
            }
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