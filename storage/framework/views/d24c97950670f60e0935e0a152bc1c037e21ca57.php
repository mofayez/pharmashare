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
        <?php echo $__env->make("pages.admin.all-sales.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.all-sales.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
        <?php echo $__env->make("pages.admin.all-sales.templates.showinfo_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
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
   

        $('#showinfo_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var order_id = button.data('order-id');
            var store_id = button.data('store-id');
            var status = button.data('status');

            if (status != 'order') {
                $('#footer_btns').hide()
            } else {
                $('#footer_btns').show()
            }

            $.ajax({
                method: 'get',
                url: '<?php echo e(route('getOrderItems')); ?>',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    sale_id: order_id,
                    store_id: store_id,
                },
                success: function (response) {
                    if (response.status) {
                        $('#order_items').empty();
                        $.each(response.data.details, function (index, item) {
                            console.log(item)
                            $('#order_items').append(`
                                <tr>
                                    <td>${item.drug_store.drug.trade_name}</td>
                                    <td>${item.drug_store.available_quantity_in_packs}</td>
                                    <td>${item.quantity}</td>
                                    <td>${item.cost}</td>
                                </tr>
                            `);
                        })
                    }
                },
                error: function (response) {

                },
            });
            var modal = $(this);
            modal.find('.modal-body input[name="order_id"]').val(order_id)
        });

 
    </script>
    <script>
        $(function () {
            $('.multiselect').change(function () {
                console.log($(this).val());
            }).multipleSelect({
                width: '100%'
            });
        }); 
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>