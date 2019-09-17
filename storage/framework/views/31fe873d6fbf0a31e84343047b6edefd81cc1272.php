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
        <?php echo $__env->make("pages.shopping.cart.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.shopping.cart.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.shopping.cart.templates.all_discounts_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

            $('input[name="count[]"]').focusout(function (e) {
                let $max_allowed = $(this).siblings('input[name="max_allowed[]"]');
                let $count_input = $(this);
                console.log($max_allowed.val());
                console.log($count_input.val());
                if (parseInt($max_allowed.val()) < parseInt($count_input.val())) {
                    $count_input.val($max_allowed.val());
                    $count_input.siblings('.incr-btn').addClass('btn-default').removeClass('btn-main');
                }
                if (parseInt($count_input.val()) > 1) {
                    $count_input.siblings('.decr-btn').addClass('btn-main').removeClass('btn-default');
                } else {
                    $count_input.siblings('.decr-btn').addClass('btn-default').removeClass('btn-main');
                }
            });

            $(".incr-btn").on("click", function (e) {
                let $button = $(this);
                let $count_input = $button.siblings('input[name="count[]"]');
                let $max_allowed_input = $button.siblings('input[name="max_allowed[]"]');

                if (parseInt($count_input.val()) >= parseInt($max_allowed_input.val())) {
                    $button.addClass('btn-default').removeClass('btn-main');
                    return false;
                } else {

                    if ($button.hasClass('btn-default')) {
                        $button.addClass('btn-main').removeClass('btn-default');
                    }

                    if ($button.siblings('.decr-btn').hasClass('btn-default')) {
                        $button.siblings('.decr-btn').addClass('btn-main').removeClass('btn-default');
                    }
                }

                $count_input.val(parseInt($count_input.val()) + 1);

            });
            $(".decr-btn").on("click", function (e) {
                let $button = $(this);
                let $count_input = $button.siblings('input[name="count[]"]');
                let $max_allowed_input = $button.siblings('input[name="max_allowed[]"]');

                if (parseInt($count_input.val()) <= 1) {
                    $button.addClass('btn-default').removeClass('btn-main');
                    return false;
                } else {
                    if ($button.hasClass('btn-default')) {
                        $button.addClass('btn-main').removeClass('btn-default');
                    }
                    if ($button.siblings('.incr-btn').hasClass('btn-default')) {
                        $button.siblings('.incr-btn').addClass('btn-main').removeClass('btn-default');
                    }
                }
                $count_input.val(parseInt($count_input.val()) - 1);

            });
        });

        $('#form').on('submit', function (e) {
            e.preventDefault();
            let form_data = $(this).serializeArray();
            $('.loading-overlay').show();
            $.ajax({
                method: 'post',
                url: '<?php echo e(route('submitCart')); ?>',
                data: form_data,
                success: function (response) {
                    console.log(response);
                    setTimeout(() => {
                        $('.loading-overlay').fadeOut();
                        if (response.status) {

                            location.href = "<?php echo e(route('getShippingView')); ?>";
                        }
                    }, 800);
                },
                error: function (errors) {
                    $('.loading-overlay').fadeOut();

                }
            });
            return true;

            swal({
                title: '<?php echo e(__('pharmacy.you_sure')); ?>',
                text: '<?php echo e(__('pharmacy.cart_submit_warning')); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('pharmacy.yes')); ?>',
                cancelButtonText:  '<?php echo e(__('pharmacy.no')); ?>',
            }).then((result) => {
                if (result) {
                }
            });
        });

        function emptyCart() {

            $('.loading-overlay').show();
            $.ajax({
                method: 'post',
                url: '<?php echo e(route('emptyCart')); ?>',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function (response) {
                    if (response.status) {
                        location.reload();
                    }
                    $('.loading-overlay').hide();
                }
            });
        }

        function removeItem(id) {

            $('.loading-overlay').show();
            $.ajax({
                method: 'post',
                url: '<?php echo e(route('removeCartItem')); ?>',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    drug_store_id: id
                },
                success: function (response) {
                    if (response.status) {
                        location.reload();
                    }
                    $('.loading-overlay').hide();
                }
            });
        }

        $('#all_discounts_modal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let discounts = button.data('discounts');

            $('#discounts_table').empty();
            $.each(discounts, function (index, item) {
                console.log(item)
                $('#discounts_table').append(`
                    <tr>
                        <td></td>
                        <td>
                            <?php echo e(__('pharmacy.discount_calculate')); ?>

                    ${item.foc_quantity}
                            <?php echo e(__('pharmacy.or_more')); ?>

                    <span class="text-danger">
                        + ${item.reward_points}
                        <?php echo e(__('store.points')); ?> </span>
                    </td>
                    <td>${item.foc_discount}
                            <i class="now-ui-icons media-2_sound-waves text-danger"> %</i>
                        </td>
                    <tr>
                `)
            });

        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>