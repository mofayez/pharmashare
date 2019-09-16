<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link href="https://innostudio.de/fileuploader/documentation/dist/font/font-fileuploader.css" media="all"
          rel="stylesheet">
    <?php echo e(Html::style('assets/css/jquery.fileuploader.min.css')); ?>

    <?php echo e(Html::style('assets/css/jquery.fileuploader2.min.css')); ?>

    <?php echo e(Html::style('assets/css/jquery.fileuploader-theme-dragdrop.css')); ?>


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
            max-width: 15% !important;
        }

        .fileuploader-items .fileuploader-item {
            width: 100%;
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
        <?php echo $__env->make("pages.admin.edit-product.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.admin.edit-product.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script("assets/js/typeahead.bundle.js")); ?>

    <?php echo e(Html::script('assets/js/jquery.fileuploader.min.js')); ?>


    <script>
        $(document).ready(function () {

            // enable fileuploader plugin
            $('input[name="drugsxlsx"]').fileuploader({
                extensions: ['xlsx'],
                limit: 1,
                changeInput: '<div class="fileuploader-input">' +
                    '<div class="fileuploader-input-inner">' +
                    '<div class="fileuploader-main-icon"></div>' +
                    '<h3 class="fileuploader-input-caption"><span>${captions.feedback}</span></h3>' +
                    '<p>${captions.or}</p>' +
                    '<div class="fileuploader-input-button"><span>${captions.button}</span></div>' +
                    '</div>' +
                    '</div>',
                theme: 'dragdrop',
                upload: {
                    url: "<?php echo e(route('addAdminPostProductSheet')); ?>",
                    data: {
                        '_token': '<?php echo e(csrf_token()); ?>'
                    },
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    start: true,
                    synchron: true,
                    beforeSend: null,
                    onSuccess: function (result, item) {
                        console.log(result)
                        var data = {};
                        try {
                            data = result;
                        } catch (e) {
                            data.hasWarnings = true;
                        }


                        // if success
                        if (data.status && data.data[0]) {
                            item.name = data.data[0].name;
                            item.html.find('.column-title > div:first-child').text(data.data[0].name).attr('title', data.data[0].name);
                        }

                        // if warnings
                        if (data.hasWarnings) {
                            for (var warning in data.warnings) {
                                alert(data.warnings);
                            }

                            item.html.removeClass('upload-successful').addClass('upload-failed');
                            // go out from success function by calling onError function
                            // in this case we have a animation there
                            // you can also response in PHP with 404
                            return this.onError ? this.onError(item) : null;
                        }

                        item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');
                        setTimeout(function () {
                            item.html.find('.progress-bar2').fadeOut(400);
                        }, 400);
                    },
                    onError: function (item) {
                        console.log(item)
                        var progressBar = item.html.find('.progress-bar2');

                        if (progressBar.length) {
                            progressBar.find('span').html(0 + "%");
                            progressBar.find('.fileuploader-progressbar .bar').width(0 + "%");
                            item.html.find('.progress-bar2').fadeOut(400);
                        }

                        item.upload.status != 'cancelled' && item.html.find('.fileuploader-action-retry').length == 0 ? item.html.find('.column-actions').prepend(
                            '<a class="fileuploader-action fileuploader-action-retry" title="Retry"><i></i></a>'
                        ) : null;
                    },
                    onProgress: function (data, item) {
                        var progressBar = item.html.find('.progress-bar2');

                        if (progressBar.length > 0) {
                            progressBar.show();
                            progressBar.find('span').html(data.percentage + "%");
                            progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                        }
                    },
                    onComplete: null,
                },
                onRemove: function (item) {
                    
                    
                    
                    
                },
                captions: {
                    feedback: "<?php echo e(__('admin.drag_upload')); ?>",
                    feedback2: "<?php echo e(__('admin.drag_upload')); ?>",
                    drop: "<?php echo e(__('admin.drag_upload')); ?>",
                    or: "<?php echo e(__('admin.or')); ?>",
                    button: "<?php echo e(__('admin.browse')); ?>",
                },
                files: []
            });

        });
    </script>
    <script>
        $(".date-picker").each(function () {
            $(this).datepicker({
                format: "dd-mm-yyyy",
                templates: {
                    leftArrow: '<i class="now-ui-icons arrows-1_minimal-left"></i>',
                    rightArrow: '<i class="now-ui-icons arrows-1_minimal-right"></i>'
                }
            }).on("show", function () {
                $(".datepicker").addClass("open"), datepicker_color = $(this).data("datepicker-color"), 0 != datepicker_color.length && $(".datepicker").addClass("datepicker-" + datepicker_color)
            }).on("hide", function () {
                $(".datepicker").removeClass("open")
            })
        });
    </script>
    <script>

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
                cancelButtonText: '<?php echo e(__('settings.no')); ?>',
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

        jQuery(document).ready(function ($) {
            $('.Typeahead-spinner').hide();
            // Set the Options for "Bloodhound" suggestion engine
            var engine = new Bloodhound({
                remote: {
                    url: '<?php echo e(route('getAllCategories')); ?>' + '?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('q', 'name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".typeahead").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                source: engine.ttAdapter(),
                limit: 5,

                display: function (item) {
                    console.log(item);
                    return item.title;
                },
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'usersList',

                displayKey: '%QUERY%',//$('#search-input').val('dsa'),
                // the key from the array we want to display (name,etc...)
                templates: {
                    empty: [
                        '<div class="list-group text-right search-results-dropdown"><div class="list-group-item">ﻻ توجد بيانات</div></div>'
                    ],
                    header: [
                        '<div class="list-group text-right search-results-dropdown">'
                    ],
                    suggestion: function (data) {
                        return '<div class="list-group-item text-right">' +
                            '<br><b style="position:relative;top:-12px;padding-right:10px">' + data.title + '</b><br></div>'


                    }
                }
            }).on('typeahead:asyncrequest', function () {
                $('.Typeahead-spinner').show();
            }).on('typeahead:asynccancel typeahead:asyncreceive', function () {
                $('.Typeahead-spinner').hide();
            }).on('typeahead:selected', function (e, item) {
            });
        });


        <?php if(session()->has('success')): ?>
        $.growl({
            message: `<b> <?php echo e(session()->get('success')); ?> </b>`
        }, {
            type: 'success',
            allow_dismiss: !1,
            label: "Cancel",
            className: "btn-xs text-right btn-inverse",
            placement: {
                from: "bottom",
                align: "right"
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
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>