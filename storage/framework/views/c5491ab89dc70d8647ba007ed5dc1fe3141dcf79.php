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
        <?php echo $__env->make("pages.shopping.checkout.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.shopping.checkout.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.shopping.checkout.templates.rates_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                url: '<?php echo e(route('submitCheckout')); ?>',
                data: form_data,
                success: function (response) {
                    console.log(response);
                    $('.loading-overlay').fadeOut();
                    if (response.status) {
                        addnotify();
                        setTimeout(() => {
                            location.href = "<?php echo e(route('getProductsView')); ?>";
                        }, 800);
                    } else {
                        let message = [];
                        $.each(response.data.un_permitted_items, function (index, item) {
                            message += '<li> <?php echo e(app()->getLocale() == 'ar' ? 'الحد الادني لقيمة الشراء من التاجر': 'The minimum purchase value of the trader'); ?>: ' + item.min_order_price + '</li>';
                        })
                        swal({
                            type: 'error',
                            title: '<?php echo e(__('settings.cost_unpermitted')); ?>',
                            html: `<h4><?php echo e(__('pharmacy.check_data')); ?></h4>
                                    <ul class="list-unstyled">
                                        ${message} 
                                    </ul>
                            `
                        });
                    }
                },
                error: function (errors) {

                }
            });
        });

        function redeemPoints(store_id, total_points_with_pharmacy) {
            console.log({
                store_id: store_id,
                total_points_with_pharmacy: total_points_with_pharmacy
            })
            $.ajax({
                url: '<?php echo e(route("getPointsPriceAPI")); ?>',
                type: 'GET',
                data: {
                    store_id: store_id,
                    total_points_with_pharmacy: total_points_with_pharmacy
                },
                success: function (data) {
                    $('#redeem_content').empty();
                    $.each(data, function (index, item) {
                        $('#redeem_content').append(`<li>
                            <input type="hidden" name="store_id" value="${store_id}"/>
                            <input id="__${index}" name="points_package_id" type="radio" ${index == 0 ? 'checked' : ''} value="${item.id}"/>
                            <label for="__${index}"><?php echo e(__('store.points')); ?>  ${item.points} <?php echo e(__('store.replace_by')); ?> <?php echo e(__('store.purchase_coupon')); ?> ${item.price} Dir </label>
                        </li>`);
                    })
                }
            })
        }

        function addnotify() {

            $.growl({
                message: `<b> <?php echo e(__('pharmacy.saved_order')); ?></b>`
            }, {
                type: 'success',
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
        var emotionsArray = ['angry', 'disappointed', 'meh', 'happy', 'inlove'];
        $("#ratings").emotionsRating({
            emotionSize: 50,
            bgEmotion: 'happy',
            emotions: emotionsArray,
            color: '#7c1fff',
            onUpdate: function (value) {

            }
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>