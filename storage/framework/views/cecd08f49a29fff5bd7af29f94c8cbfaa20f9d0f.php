<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>

    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("body"); ?>

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <?php echo $__env->make("includes.navbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="wrapper">
        <?php echo $__env->make("pages.points.all.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.points.all.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")); ?>

    <?php echo e(Html::script("assets/js/typeahead.bundle.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <script>
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        table2 = $('#myTable').DataTable({
            "searching": false,
            "paging": false,
            "autoWidth": false,
            "ordering": false,
            "responsive": false
        });
        let counter = <?php echo e(count($foces)); ?>;
        $('#add_button').click(function (e) {
            e.preventDefault();
            table2.row.add([
                `<button type="button" class="btn btn-danger removerow">
                          <i class="fas fa-minus"></i>
                      </button>`,
                `<input name="foc_on[${counter}]" class="form-control text-center" type="hidden" value="all">
                <input name="foc_quantity[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<input name="foc_discount[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<input name="reward_points[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<select name="is_activated[${counter}]" class="form-control text-center"><option value="1">Yes</option><option value="0">No</option></select>`,
                ``,
            ]).draw(false);
            counter++;
        });
        table2.on('click', '.removerow', function (e) {
            e.preventDefault();
            let tr = $(this).parent().parent();
            table2.row(tr).remove().draw();
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>