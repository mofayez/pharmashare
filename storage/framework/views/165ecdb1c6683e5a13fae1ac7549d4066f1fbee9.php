<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>

    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

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
        @media  only screen and (max-width: 600px) {
            .my-group .btn-main {
                max-width: 35% !important;
            }   
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
        <?php echo $__env->make("pages.profile.sales.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.profile.sales.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.profile.sales.templates.showinfo_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script("https://momentjs.com/downloads/moment.js")); ?>

    <script>

        let start_date = '<?php echo e(app('request')->get('start_date')); ?>';
        let end_date = '<?php echo e(app('request')->get('end_date')); ?>';
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
            let date = $('#datarange').flatpickr({
                defaultDate: ['<?php echo e(app('request')->get('start_date') ? app('request')->get('start_date') : "today"); ?>', '<?php echo e(app('request')->get('end_date') ? app('request')->get('end_date') : "today"); ?>'],
                mode: 'range',
                dateFormat: 'Y-m-d',
                onChange: function (selectedDates, dateStr, instance) {

                }, onClose: function (selectedDates, dateStr, instance) {
                    start = selectedDates[0];
                    end = selectedDates[1];

                    start = moment(start).format("YYYY-MM-DD");
                    end = moment(end).format("YYYY-MM-DD");
                    if (selectedDates[0] != undefined) {
                        start_date = start;
                    }
                    if (selectedDates[1] != undefined) {
                        end_date = end;
                    }

                },
            });

            $('input[name="status"]').on('change', function () {
                let url = "<?php echo e(route('getSalesView')); ?>";

                url = url + "?page=1"
                    + "&status=" + $(this).val()
                    + "&start_date=" + start_date
                    + "&end_date=" + end_date
                    + "&query=" + $('input[name="query"]').val();

                location.href = url;
            });
        });
        
        function filter(){
            let url = "<?php echo e(route('getSalesView')); ?>";

                url = url + "?page=1"
                    + "&status=" + $('input[name="status"]').val()
                    + "&start_date=" + start_date
                    + "&end_date=" + end_date
                    + "&query=" + $('input[name="query"]').val();

                location.href = url;
        }

        function printreport(id, serial) {
            window.open("<?php echo e(route('getSalesReportView')); ?>" + "?id=" + id + "&sale_number=" + serial, "Report", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1200, height=500, top=" + (screen.height - 100) + ", left=" + (screen.width / 2));
        }

        $('#showinfo_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var order_id = button.data('order-id');
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
                    store_id: '<?php echo e(auth()->user()->id); ?>',
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


        function approve() {
            swal({
                title: '<?php echo e(__('settings.warning')); ?>',
                text: '<?php echo e(__('settings.are_you_sure')); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('settings.yes')); ?>',
                cancelButtonText: '<?php echo e(__('settings.no')); ?>',
            }).then((result) => {
                if (result) {

                    $.ajax({
                        method: "post",
                        url: "<?php echo e(route('ApproveOrder')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            order_id: $('input[name="order_id"]').val(),
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

        function block_pharmacy(pharmacy_id) {
            swal({
                title: '<?php echo e(__('settings.warning')); ?>',
                text: '<?php echo e(__('settings.are_you_sure')); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('settings.yes')); ?>',
                cancelButtonText: '<?php echo e(__('settings.no')); ?>',
            }).then((result) => {
                if (result) {

                    $.ajax({
                        method: "post",
                        url: "<?php echo e(route('blockPharmacy')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            pharmacy_id: pharmacy_id,
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

        function reject() {
            swal({
                title: '<?php echo e(__('settings.warning')); ?>',
                text: '<?php echo e(__('settings.are_you_sure')); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '<?php echo e(__('settings.yes')); ?>',
                cancelButtonText: '<?php echo e(__('settings.no')); ?>',
            }).then((result) => {
                if (result) {

                    $.ajax({
                        method: "post",
                        url: "<?php echo e(route('RejectOrder')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            order_id: $('input[name="order_id"]').val(),
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

        $('#datarange').flatpickr({
            defaultDate: ['today', 'today'],
            mode: 'range',
            dateFormat: 'Y-m-d',
            onChange: function (selectedDates, dateStr, instance) {

            }, onClose: function (selectedDates, dateStr, instance) {

            },
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>