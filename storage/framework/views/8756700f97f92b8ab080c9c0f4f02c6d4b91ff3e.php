<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>

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
    
        @media  only screen and (max-width: 600px) {
            .my-group .btn-main {
                max-width: 25% !important;
            }   
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
        <?php echo $__env->make("pages.profile.add-to-favourites.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.profile.add-to-favourites.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.profile.add-to-favourites.templates.update_product_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <?php echo e(Html::script("assets/js/typeahead.bundle.js")); ?>

    <?php echo e(Html::script("assets/js/multiple-select.js")); ?>


    <script>
        $(function () {
            let added_to_favourites = [];
            <?php $__currentLoopData = $favourites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            added_to_favourites.push(parseInt('<?php echo e($item); ?>'));
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            $('.loading-overlay').fadeOut();

            $('.multiselect').change(function () {
                console.log($(this).val());
            }).multipleSelect({
                width: '100%'
            });

            jQuery(document).ready(function ($) {
                $('.Typeahead-spinner').hide();
                // Set the Options for "Bloodhound" suggestion engine
                var engine = new Bloodhound({
                    remote: {
                        url: '<?php echo e(route('getStoreAutoCompleteDrugs')); ?>' + '?drug_name=%QUERY%',
                        wildcard: '%QUERY%'
                    },
                    datumTokenizer: Bloodhound.tokenizers.whitespace('drug_name', 'name'),
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
                        // console.log(item);
                        return item.trade_name;
                    },
                    // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                    name: 'usersList',

                    displayKey: '%QUERY%',//$('#search-input').val('dsa'),
                    // the key from the array we want to display (name,etc...)
                    templates: {
                        empty: [
                            '<div class="list-group text-right search-results-dropdown"><div class="list-group-item"> <?php echo e(__('pharmacy.no_data')); ?></div></div>'
                        ],
                        header: [
                            '<div class="list-group text-right search-results-dropdown">'
                        ],
                        suggestion: function (data) {
                            return '<div class="list-group-item text-right">' +
                                '<br><b style="position:relative;top:-12px;padding-right:10px">' + data.trade_name + '</b><br></div>'


                        }
                    }
                }).on('typeahead:asyncrequest', function () {
                    $('.Typeahead-spinner').show();
                }).on('typeahead:asynccancel typeahead:asyncreceive', function () {
                    $('.Typeahead-spinner').hide();
                }).on('typeahead:selected', function (e, item) {
                    updateTable();
                });
            });

            let table = $('#myTable').DataTable({
                "searching": false,
                "paging": true,
                "autoWidth": false,
                "ordering": false,
                "responsive": false,
                "pageLength": 50,
                "columnDefs": [
                    {
                        "targets": [0, 1, 2, 3, 4, 5 ,6],
                        "visible": true
                    },
                ],
            });

            $(document).on('switchChange.bootstrapSwitch', '.bootstrap-switch', function (e) {
                e.preventDefault();
                if ($(this).attr('data-column') != undefined) {
                    console.log($(this).attr('data-column'));

                    // Get the column API object
                    var column = table.column($(this).attr('data-column'));

                    // Toggle the visibility
                    column.visible(!column.visible());
                }
            });
            
            $('input[name="drug_name"]').on('keyup', function (e) {
                let query = $(this).val();

                var code = e.keyCode || e.which;
                if (code == 13) {
                    if (query) {
                        updateTable();
                    }
                }

            });

            $('.fav_form').on('submit', function (e) {
    
                e.preventDefault();
                let form = $(this);
                let form_data = form.serialize();
    
                $.ajax({
                    url: '<?php echo e(route('submitFavourite')); ?>',
                    type: 'post',
                    data: form_data,
                    success: function (response) {
    
                        if (!response.status) {
                            let errors = response.data.validation_errors;
    
                            if (errors.available_quantity_in_packs) {
                                form.find('span.error_amount').text(errors.available_quantity_in_packs[0]);
                            } else {
                                form.find('span.error_amount').text();
                            }
                            if (errors.minimum_order_value_or_quantity) {
                                form.find('span.error_min_amount').text(errors.minimum_order_value_or_quantity[0]);
                            } else {
                                form.find('span.error_min_amount').text('');
                            }
                            if (errors.offered_price_or_bonus) {
                                form.find('span.error_cost').text(errors.offered_price_or_bonus[0]);
                            } else {
                                form.find('span.error_cost').text('');
                            }
                            return false;
                        }
    
                        swal({
                            type:'success',
                            title:"<?php echo e(app()->getLocale() == 'ar' ? 'تمت العملية بنجاح': 'Successfully Edit'); ?>",
                            timer:2000
                        })
                        $('#close_modal').trigger('click')
                        // form.parents().eq(1).fadeOut()
                    }
                })
            });
            
            $(document).on('click', '.add-to-fav', function () {
                let $this = $(this);
                let id = $this.attr('data-item-id');
                let pharmashare_code = $this.attr('data-item-pharmashare_code');
                let strength = $this.attr('data-item-strength');
                let pack_size = $this.attr('data-item-pack_size');
                let active_ingredient = $this.attr('data-item-active_ingredient');
                let trade_name = $this.attr('data-item-trade_name');
                let manufacturer = $this.attr('data-item-manufacturer');
                
                if(!$('input[name="bulk"]:checked').length > 0){
                    
                    $('#active_ingredient').text(active_ingredient);
                    $('#manufacturer').text(manufacturer);
                    $('#strength').text(strength);
                    $('#pack_size').text(pack_size);
                    $('#trade_name').text(trade_name);
                    
                    $('input[name="pharmashare_code"]').val(pharmashare_code)
                    $('input[name="fav_id"]').val()
                    $('input[name="form"]').val()
                    $('input[name="trade_name"]').val(trade_name)
                    $('input[name="pack_size"]').val(pack_size)
                    $('input[name="active_ingredient"]').val(active_ingredient)
                    $('input[name="manufacturer"]').val(manufacturer)
                    $('input[name="strength"]').val(strength)
                     
                    $('#update_product_trigger').trigger('click');
                    return ;
                }
                
                added_to_favourites.push(parseInt($this.attr('data-item-id')));
                $this.button('loading');
                setTimeout(function () {
                    $this.button('reset');
                    $.ajax({
                        method: 'post',
                        url: "<?php echo e(route('addToFavourite')); ?>",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            drug_id: id
                        },
                        success: function (response) {
                            if (response.status) {
                                addnotify();
                                $('#list_btn').removeClass('btn-main').addClass('btn-danger animated bounceIn');
                                setTimeout(function () {
                                    $this.attr('disabled', 'disabled');
                                    let count = $('#favourites-count');
                                    let current = parseInt(count.text());
                                    count.text(current + 1);
                                    $('#list_btn').removeClass('btn-danger animated bounceIn').addClass('btn-main');
                                }, 1000);
                            }
                        }
                    })
                }, 800);
            })

            function addnotify() {

                $.growl({
                    message: `<b>  <?php echo e(app()->getLocale() == 'ar' ? 'تم الاضافة الى السلة' : 'Added To List'); ?>  </b>`
                }, {
                    type: 'warning',
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

            function updateTable() {

                $('.loading-overlay').show();

                let fetch_data = {
                    _token: "<?php echo e(csrf_token()); ?>",
                    drug_name: $('input[name="drug_name"]').val(),
                };

                $.ajax({
                    method: "get",
                    url: "<?php echo e(route('getDrugsFromModel')); ?>",
                    data: fetch_data,
                    success: function (response) {
                        console.log(response);
                        table.clear().draw();
                        $.each(response, function (index, item) {
                            let is_disabled = false;

                            if ($.inArray(item.id, added_to_favourites) != -1) {
                                is_disabled = true;
                            }
                            table.row.add([
                                `<button class="btn btn-warning add-to-fav p-2 pl-3 pr-3" ${is_disabled ? disabled = "disabled" : ''} data-item-id="${item.id}"  data-item-pack_size="${item.pack_size}" data-item-strength="${item.strength}" data-item-active_ingredient="${item.active_ingredient}" data-item-trade_name="${item.trade_name}" data-item-pharmashare_code="${item.pharmashare_code}" data-item-manufacturer="${item.manufacturer}"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">
                                      <?php echo e(app()->getLocale() == 'ar' ? 'اضافة للمخزن' : 'Add To Store'); ?> 
                                    </button>`,
                                `${item.pharmashare_code}`,
                                `<h6 class="m-0 p-0" style="text-align: left">
                                    ${item.trade_name}
                                </h6>`,
                                `${item.manufacturer}`,
                                `${item.pack_size} `,
                                `${item.form} `,
                                `${item.active_ingredient} `,
                                `${item.strength ? item.strength : '-'} `
                            ]).draw(false);
                        });

                        setTimeout(() => {

                            $('.loading-overlay').fadeOut();
                        }, 500);

                    },
                    error: function (errors) {

                    }
                });

                $('.loading-overlay').fadeOut();
            }
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>