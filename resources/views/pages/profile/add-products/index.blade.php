@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link href="https://innostudio.de/fileuploader/documentation/dist/font/font-fileuploader.css" media="all"
          rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>
    {{Html::style('assets/css/jquery.fileuploader.min.css')}}
    {{Html::style('assets/css/jquery.fileuploader2.min.css')}}
    {{Html::style('assets/css/jquery.fileuploader-theme-dragdrop.css')}}

    {{Html::style('assets/css/iziToast.min.css')}}
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
        .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th{
            font-weight:bold;
        }
        .table-bordered td, .table-bordered th { 
            white-space: nowrap;
        }
    </style>
@endsection

@section("body")

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    @include("includes.navbar")

    <div class="wrapper">
        @include("pages.profile.add-products.templates.top_header")
        @include("pages.profile.add-products.templates.center_content")
        <button class="btn btn-primary d-none" id="ap_btn" data-toggle="modal" data-target="#drugs_list">
			<i class="now-ui-icons files_single-copy-04"></i>
        	Classic
        </button>
        @include("pages.profile.add-products.templates.drugs_modal")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    {{Html::script("assets/js/typeahead.bundle.js")}}
    {{Html::script('assets/js/jquery.fileuploader.min.js')}}

    <script>
        $(document).ready(function () {


            table2 = $('#discount_table').DataTable({
                "searching": false,
                "paging": false,
                "autoWidth": false,
                "ordering": false,
                "responsive": false
            });


            table2.on('click', '.removerow', function (e) {
                e.preventDefault();
                let tr = $(this).parent().parent();
                table2.row(tr).remove().draw();
            });

            let counter = 0;
            $('#add_button').click(function (e) {
                e.preventDefault();
                table2.row.add([
                    `<button type="button" class="btn btn-danger removerow">
                          <i class="fas fa-minus"></i>
                      </button>`,
                    `<input name="foc_quantity[${counter}]" class="form-control text-center" type="number" value="0">`,
                    `<input name="foc_discount[${counter}]" class="form-control text-center" type="number" value="0">`,
                    ``,
                    ``,
                    ``,
                    ``,
                ]).draw(false);
                counter++;
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            
            // enable fileuploader plugin
            $('input[name="drugsxlsx"]').fileuploader({
                extensions: ['csv'],
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
                    url: "{{route('addPostProductSheet')}}",
                    data: {
                        '_token': '{{csrf_token()}}'
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


                        if (result.status) {
                            // swal({
                            //     'type': 'success',
                            //     'title': ``,
                            //     'html': `<div>
                            //                 <h4>
                            //                     {{__('settings.approved_products')}} :
                            //                     <span>${result.data.approved_drugs_count}</span>
                            //                 </h4>
                            //                 <h4>
                            //                     {{__('settings.unapproved_products')}} :
                            //                     <span>${result.data.unapproved_drugs.length}</span>
                            //                 </h4>
                            //             </div>`
                            // })
                            console.log(result.data.unapproved_drugs)
                            $('#table_drug_detail').empty();
                            $('#table_approved_drug_detail').empty();
                            
                            $('#table_drug_detail').append(`
                                <thead>
                                    <tr>
                                        <th>{{__('pharmacy.bar_code')}}</th>
                                        <th>{{__('pharmacy.product_name')}}</th>
                                        <th>{{__('pharmacy.manufacturer')}}</th>
                                        <th>{{__('pharmacy.packet_size')}}</th>
                                        <th>{{__('pharmacy.origin')}}</th>
                                        <th>{{__('pharmacy.amount')}}</th>
                                        <th>{{__('pharmacy.min_amount')}}</th>
                                        <th>{{__('pharmacy.cost')}}</th> 
                                        <th>{{__('pharmacy.notes')}}</th>
                                    </tr>
                                </thead>
                            `);
                            $('#table_approved_drug_detail').append(`
                                <thead>
                                    <tr>
                                        <th>{{__('pharmacy.bar_code')}}</th>
                                        <th>{{__('pharmacy.product_name')}}</th>
                                        <th>{{__('pharmacy.manufacturer')}}</th>
                                        <th>{{__('pharmacy.packet_size')}}</th>
                                        <th>{{__('pharmacy.origin')}}</th>
                                        <th>{{__('pharmacy.amount')}}</th>
                                        <th>{{__('pharmacy.min_amount')}}</th>
                                        <th>{{__('pharmacy.cost')}}</th> 
                                        <th>{{__('pharmacy.notes')}}</th>
                                    </tr>
                                </thead>
                            `);
                            
                            $.each(result.data.unapproved_drugs , function(index , drug){
                                $('#table_drug_detail').append(`
                                    <tr>
                                        <td>${drug.pharmashare_code}</td>
                                        <td>${drug.trade_name}</td>
                                        <td>${drug.manufacturer}</td>
                                        <td>${drug.pack_size}</td>
                                        <td>${drug.active_ingredient}</td>
                                        <td>${drug.available_quantity_in_packs}</td>
                                        <td>${drug.minimum_order_value_or_quantity}</td>
                                        <td>${drug.offered_price_or_bonus}</td> 
                                        <td>${drug.store_remarks}</td>
                                    </tr>
                                `);
                            });
                               
                            $.each(result.data.approved_drugs , function(index , drug){
                                $('#table_approved_drug_detail').append(`
                                    <tr>
                                        <td>${drug.drug.pharmashare_code}</td>
                                        <td>${drug.drug.trade_name}</td>
                                        <td>${drug.drug.manufacturer}</td>
                                        <td>${drug.drug.pack_size}</td>
                                        <td>${drug.drug.active_ingredient}</td>
                                        <td>${drug.available_quantity_in_packs}</td>
                                        <td>${drug.minimum_order_value_or_quantity}</td>
                                        <td>${drug.offered_price_or_bonus}</td> 
                                        <td>${drug.store_remarks}</td>
                                    </tr>
                                `);
                            });
                                            
                                            
                            setTimeout(()=>{
                                $('#unapproved_drugs_count').text(result.data.unapproved_drugs.length)
                                $('#approved_drugs_count').text(result.data.approved_drugs.length)
                                $('#ap_btn').trigger('click');
                            },500);
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
                    {{--$.post("{{route('RemoveImagesAjax',['account'=> app('request')->account , 'id'=> app('request')->id])}}", {--}}
                    {{--file: item.name,--}}
                    {{--_token:'{{csrf_token()}}'--}}
                    {{--});--}}
                },
                captions: {
                    feedback: '{{__("store.drag_upload")}}',
                    feedback2: '{{__("store.drag_upload")}}',
                    drop: '{{__("store.drag_upload")}}',
                    or: '{{__("store.or")}}',
                    button: '{{__("store.browse")}}',
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


        function printreport(e) {
            e.preventDefault();
            window.open("{{route('getSalesReportView')}}", "Report", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1200, height=500, top=" + (screen.height - 100) + ", left=" + (screen.width / 2));
        }

        function payment() {
            swal({
                title: '{{__('settings.warning')}}',
                text: '{{__('settings.are_you_sure')}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '{{__('settings.yes')}}',
                cancelButtonText: '{{__('settings.no')}}',
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
                    url: '{{route('getAllCategories')}}' + '?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('q', 'name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $("#typeahead_category").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                source: engine.ttAdapter(),
                limit: 10,

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


        jQuery(document).ready(function ($) {
            $('.Typeahead-spinner').hide();
            // Set the Options for "Bloodhound" suggestion engine
            var engine = new Bloodhound({
                remote: {
                    url: '{{route('getAllBarcode')}}' + '?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('q', 'name'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $("#typeahead_barcode").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                source: engine.ttAdapter(),
                limit: 10,

                display: function (item) {
                    console.log(item);
                    return item.pharmashare_code;
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
                            '<br><b style="position:relative;top:-12px;padding-right:10px">' + data.pharmashare_code + '</b><br></div>'


                    }
                }
            }).on('typeahead:asyncrequest', function () {
                $('.Typeahead-spinner').show();
            }).on('typeahead:asynccancel typeahead:asyncreceive', function () {
                $('.Typeahead-spinner').hide();
            }).on('typeahead:selected', function (e, item) {
                console.log(item)
                $('input[name="form"]').val(item.drug_category.title)
                $('input[name="trade_name"]').val(item.trade_name)
                $('input[name="pack_size"]').val(item.pack_size)
                $('input[name="active_ingredient"]').val(item.active_ingredient)
                $('input[name="manufacturer"]').val(item.manufacturer)
                $('input[name="strength"]').val(item.strength)
                $('#pharmacy_ead').text(item.pharmacy_price_aed);
                $('#public_ead').text(item.public_price_aed);
                $('input[name="offered_price_or_bonus"]').val(item.public_price_aed);
                
            });
        });


        @if(session()->has('success'))
        $.growl({
            message: `<b> {{session()->get('success')}} </b>`
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
        @endif
    </script>
@endsection