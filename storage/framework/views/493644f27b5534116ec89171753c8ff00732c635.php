<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel='stylesheet' href='http://antenna.io/demo/jquery-bar-rating/dist/themes/fontawesome-stars.css'>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        .section {
            padding: 10px 0;
        }
        .br-theme-fontawesome-stars .br-widget a{
            font-size: 40px;
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
        <?php echo $__env->make("pages.pharmacy.boughts.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.pharmacy.boughts.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.pharmacy.boughts.templates.showinfo_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.pharmacy.boughts.templates.rates_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("http://antenna.io/demo/jquery-bar-rating/jquery.barrating.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>


    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

            $('input[name="status"]').on('change', function () {
                location.href = "<?php echo e(route('getBoughtsView')); ?>?status=" + $(this).val();
            });
        });

        function block_store(store_id) {
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
                        method: "post",
                        url: "<?php echo e(route('blockStore')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            store_id: store_id,
                        },
                        success: function (response) {
                            console.log(response)
                            if (response.status) {
                                location.reload();
                            }
                        },
                        error: function (errors) {

                        }
                    })
                }
            })
        }

        function printreport(id, serial) {
            window.open("<?php echo e(route('getSalesReportView')); ?>" + "?id=" + id + "&sale_number=" + serial, "Report", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1200, height=500, top=" + (screen.height - 100) + ", left=" + (screen.width / 2));
        }
    </script>
    <script>

        $('#rates_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var store_id = button.data('store-id');
            $('input[name="store_id"]').val(store_id);
        });
        var emotionsArray = ['angry', 'disappointed', 'meh', 'happy', 'inlove'];
        $("#ratings").emotionsRating({
            emotionSize: 80,
            bgEmotion: 'happy',
            emotions: emotionsArray,
            color: '#7c1fff',
            onUpdate: function (value) {
                $('input[name="rating"]').val(value);
                $('#current_rate').text(value);
            }
        });


        $('#example-fontawesome').barrating({
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            onSelect: function(value, text) {
                $('input[name="rating"]').val(value);
                $('#current_rate').text(value);
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>