@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>


    {{Html::style('assets/css/iziToast.min.css')}}
    {{Html::style('assets/css/multiple-select.css')}}
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
@endsection

@section("body")

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    @include("includes.navbar")

    <div class="wrapper">
        @include("pages.admin.all-sales.templates.top_header")
        @include("pages.admin.all-sales.templates.center_content") 
        @include("pages.admin.all-sales.templates.showinfo_modal") 
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    {{Html::script("assets/js/multiple-select.js")}}
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
                url: '{{route('getOrderItems')}}',
                data: {
                    _token: '{{csrf_token()}}',
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
@endsection