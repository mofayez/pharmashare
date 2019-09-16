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
        <?php echo $__env->make("pages.admin.approve-products.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.approve-products.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.approve-products.templates.select_show_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.approve-products.templates.edit_drug_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script("assets/js/multiple-select.js")); ?>

    <script>
        $('#edit_drugs_modal').on('show.bs.modal', function (event) {
          let button = $(event.relatedTarget);
          let drug = button.data('drug')
          console.log(drug)
          $('input[name="id"]').val(drug.id);
          $('input[name="form"]').val(drug.form);
          $('input[name="trade_name"]').val(drug.trade_name);
          $('input[name="pharmashare_code"]').val(drug.pharmashare_code);
          $('input[name="pack_size"]').val(drug.pack_size);
          $('input[name="active_ingredient"]').val(drug.active_ingredient);
          $('input[name="manufacturer"]').val(drug.manufacturer);
          $('input[name="strength"]').val(drug.strength);
            
        });
        
        $('#edit_form').on('submit',function(e){
            e.preventDefault(); 
            let data_form = $(this).serialize();
            
            // swal({
            //     title:'waiting for service ...',
            //     text:$(this).serialize(),
            //     type:'info'
            // })
            // console.log(data_form)
            // return;
            $.ajax({
                type:'post',
                url:'<?php echo e(route("api.updateUnApprovedDrug")); ?>',
                data:data_form,
                success:function(response){
                    if(response.status){
                        location.reload();          
                    }
                }
            })
        });
        
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        function gonext() {
            $('.loading-overlay').show();
            setTimeout(() => {
                location.href = "<?php echo e(route('getShippingView')); ?>";
                $('.loading-overlay').fadeOut();
            }, 1000);
        }

        function printreport(e) {
            e.preventDefault();
            window.open("<?php echo e(route('getSalesReportView')); ?>", "Report", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1200, height=500, top=" + (screen.height - 100) + ", left=" + (screen.width / 2));
        }

        function payment() {
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
                if (result.value) {
                    swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }

        $('#datarange').flatpickr({
            // defaultDate: ['2018-10-29', '2018-10-16'],
            mode: 'range',
            dateFormat: 'Y-m-d',
            onChange: function (selectedDates, dateStr, instance) {

            }, onClose: function (selectedDates, dateStr, instance) {

            },
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

        function reject(pharmashare_code) {
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
                console.log(result)
                if (result) {
                    $.ajax({
                        method: 'POST',
                        url: '<?php echo e(route('postRejectDrug')); ?>',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            pharmashare_code: pharmashare_code
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
                        url: '<?php echo e(route('postApproveDrug')); ?>',
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