<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'> 

    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        #myTable_wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
        }

        tr td:first-child {
            padding: 0 !important;
        }

        span.twitter-typeahead {

            width: 65%;
        }

        .dropdown-menu open show {

            min-height: 100px !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            border: 1px solid #979797;
            background: linear-gradient(to right, #3e4bb3, #7929c4) !important; 
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            border-radius:30px;
        }
/**
 * Tooltip Styles
 */

/* Add this attribute to the element that needs a tooltip */
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  pointer-events: none;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 150%;
  left: 20%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 150%;
  left: 20%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid hsla(0, 0%, 20%, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
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
        <?php echo $__env->make("pages.store.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.store.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.store.templates.showinfo_modal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")); ?>

    <?php echo e(Html::script("assets/js/typeahead.bundle.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

    <script>
        $(".selectpicker").selectpicker();
    </script>
    <script>
        let added_to_cart = [];
        <?php
            $cart_items = session()->get('cart_storage') ?? [];
            foreach ($cart_items as $item){
        ?>
        added_to_cart.push(parseInt('<?php echo e($item['product_id']); ?>'));
        <?php
            }
        ?>
        $(document).on('click', '.add-to-cart', function () {
            let $this = $(this);
            let id = $this.attr('data-item-id');
            added_to_cart.push(parseInt($this.attr('data-item-id')));
            $this.button('loading');
            setTimeout(function () {
                $this.button('reset');
                $.ajax({
                    method: 'post',
                    url: "<?php echo e(route('addToCart')); ?>",
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>",
                        drug_store_id: id
                    },
                    success: function (response) {
                        if (response.status) {
                            addnotify();
                            setTimeout(function () {
                                $this.attr('disabled', 'disabled');
                                let count = $('#cart-count');
                                let current = parseInt(count.text());
                                count.text(current + 1);
                            }, 900);
                        }
                    }
                })
            }, 800);
        });

        function addnotify() {

            $.growl({
                message: `<b>  <?php echo e(__('pharmacy.add_to_cart')); ?>  </b>`
            }, {
                type: 'info',
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

        jQuery(document).ready(function ($) {
            $('.Typeahead-spinner').hide();
            // Set the Options for "Bloodhound" suggestion engine
            var engine = new Bloodhound({
                remote: {
                    url: '<?php echo e(route('getAutoCompleteDrugs')); ?>' + '?drug_name=%QUERY%',
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
                    return item.drug.trade_name;
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
                            '<br><b style="position:relative;top:-12px;padding-right:10px">' + data.drug.trade_name + '</b><br></div>'


                    }
                }
            }).on('typeahead:asyncrequest', function () {
                $('.Typeahead-spinner').show();
            }).on('typeahead:asynccancel typeahead:asyncreceive', function () {
                $('.Typeahead-spinner').hide();
            }).on('typeahead:selected', function (e, item) {
            });
        });

        let table = $('#myTable').DataTable({
            "searching": false,
            "paging": true,
            "autoWidth": false,
            "ordering": false,
            "responsive": false,
            "columnDefs": [
                {
                    "targets": [5, 6, 7, 8],
                    "visible": true
                },
                {
                    "targets": [0, 1, 2, 3, 4],
                    "visible": true
                },
            ],
        });

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

            $("#toggle_bars").on('click', function () {
                let table_content = $('#table_content');
                if (table_content.hasClass('col-md-12')) {
                    table_content.addClass('col-md-9').removeClass('col-md-12');
                    $("#toggle_bars").css({
                        textDecoration: 'none'
                    });
                    $('#filter_content').show();
                } else {
                    table_content.addClass('col-md-12').removeClass('col-md-9');
                    $("#toggle_bars").css({
                        textDecoration: 'line-through'
                    });
                    $('#filter_content').hide();
                }
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

        });


        let a = document.getElementById("sliderLocation");
        noUiSlider.create(a, {
            start: 1000,
            direction: '<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>',
            connect: [!0, !1],
            range: {min: 0, max: 1000}
        }).on('update', function (data) {
            $("#locationupto").text(data[0]);
            $('input[name="radius"]').val(data[0]);
        });


        let o = document.getElementById("sliderPrice");
        noUiSlider.create(o, {
            start: [0, 5000],
            connect: !0,
            direction: '<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>',
            range: {min: 0, max: 5000}
        }).on('update', function (data, z) {
            $("#pricefrom").text(data[0]);
            $("#priceto").text(data[1]);
            $('input[name="min_price"]').val(data[0]);
            $('input[name="max_price"]').val(data[1]);
        });
    </script>

    <script>

        function updateTable() {

            $('.loading-overlay').show();

            let fetch_data = {
                _token: "<?php echo e(csrf_token()); ?>",
                drug_category_id: $('select[name="drug_category_id"]').val(),
                min_price: $('input[name="min_price"]').val(),
                max_price: $('input[name="max_price"]').val(),
                radius: $('input[name="radius"]').val(),
                drug_name: $('input[name="drug_name"]').val(),
                manufacturer: $('select[name="manufacturer"]').val(),
                active_ingredient: $('select[name="active_ingredient"]').val(),
                strength: $('select[name="strength"]').val(),
                payment_type: $('select[name="payment_type"]').val(),
                is_featured: $('select[name="is_featured"]').val(),
                foc: $('select[name="foc"]').val()
            };

            $.ajax({
                method: "get",
                url: "<?php echo e(route('getDrugsWithFilterData')); ?>",
                data: fetch_data,
                success: function (response) {
                    console.log(response);
                    if (response.status) {
                        table.clear().draw();
                        $.each(response.data.drugs, function (index, item) {
                            let is_disabled = false;

                            if ($.inArray(item.id, added_to_cart) != -1) {
                                is_disabled = true;
                            }

                            console.log(item.isFeatured)
                            table.row.add([
                                `<button class="btn ${item.available_quantity_in_packs == 0 ? "btn-danger" : ' btn-main'} add-to-cart p-2 pl-3 pr-3" ${is_disabled ? disabled = "disabled" : ''} data-item-id="${item.id}" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing" ${item.available_quantity_in_packs == 0 ? disabled = "disabled" : ''} data-available-quantity="${item.available_quantity_in_packs}">
                                    <i class="now-ui-icons shopping_basket"></i>
                                </button>`,
                                `<h6 class="m-0 p-0" style="text-align: left" data-tooltip="${item.store_remarks}">
                                    ${item.drug.trade_name}
                                    <small class="btn-success ads-flash btn-simple p-1 mr-1 ml-1 ${item.isFeatured ? '' : 'd-none'}" style="font-size: 10px"><?php echo e(__('pharmacy.ads')); ?></small>
                                </h6>`,
                                `<h6  class="m-0 p-0" style="text-align: left">
                                    ${item.offered_price_or_bonus ? item.offered_price_or_bonus : '0'}
                                    <span>dir</span>
                                    <small class="btn-danger btn-simple p-1 mr-1 ml-1 ${item.FOC.length > 0 ? '' : 'd-none'}"  data-tooltip="${item.FOC.length > 0 ? ('when you buy amount: ' + item.FOC[0].foc_quantity + ' discount will be: ' + item.FOC[0].foc_discount) : '' }" style="font-size: 10px;top: 5px;position: relative;">   <?php echo e(__('pharmacy.discount')); ?>    </small>

                                </h6>`,
                                `${item.drug.manufacturer}`,
                                `${item.drug.active_ingredient} `,
                                `<span style="color:#e91d63">${item.store_user.firstname + item.store_user.lastname}</span>`,
                                `${item.drug.strength ? item.drug.strength : '-'} `,
                                `${item.drug.pack_size ? item.drug.pack_size : '-'} `,
                                `-`,
                            ]).draw(false);
                        });

                        setTimeout(() => {

                            $('.loading-overlay').fadeOut();
                        }, 500);

                    }
                },
                error: function (errors) {

                }
            });
        }
        
        $('input[name="drug_name"]').on('keypress',function(e) {
            if(e.which == 13) {
                updateTable()
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>