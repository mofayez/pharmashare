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
        @include("pages.shopping.shipping.templates.top_header")
        @include("pages.shopping.shipping.templates.center_content")
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
                url: '{{route('submitPayment')}}',
                data: form_data,
                success: function (response) {
                    console.log(response);
                    setTimeout(() => {
                        $('.loading-overlay').fadeOut();
                        if (response.status){

                            location.href = "{{route('getCheckoutView')}}";
                        }
                    }, 800);
                },
                error: function (errors) {

                }
            });
        });
    </script>
@endsection