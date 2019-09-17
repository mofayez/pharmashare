@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    {{Html::style('assets/css/iziToast.min.css')}}
@endsection

@section("body")

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    @include("includes.navbar")

    <div class="wrapper">
        @include("pages.shopping.checkout.templates.top_header")
        @include("pages.shopping.checkout.templates.center_content")
        @include("pages.shopping.checkout.templates.rates_modal")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
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
                url: '{{route('submitCheckout')}}',
                data: form_data,
                success: function (response) {
                    console.log(response);
                    $('.loading-overlay').fadeOut();
                    if (response.status) {
                        addnotify();
                        setTimeout(() => {
                            location.href = "{{route('getProductsView')}}";
                        }, 800);
                    } else {
                        let message = [];
                        $.each(response.data.un_permitted_items, function (index, item) {
                            message += '<li> {{app()->getLocale() == 'ar' ? 'الحد الادني لقيمة الشراء من التاجر': 'The minimum purchase value of the trader'}}: ' + item.min_order_price + '</li>';
                        })
                        swal({
                            type: 'error',
                            title: '{{__('settings.cost_unpermitted')}}',
                            html: `<h4>{{__('pharmacy.check_data')}}</h4>
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

        function redeemPoints(store_id, pharmacy_id) {
            console.log({
                store_id: store_id,
                pharmacy_id: pharmacy_id
            })
        }

        function addnotify() {

            $.growl({
                message: `<b> {{__('pharmacy.saved_order')}}</b>`
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
@endsection