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
        @include("pages.profile.all-products.templates.top_header")
        @include("pages.profile.all-products.templates.center_content")
        @include("pages.profile.all-products.templates.select_show_modal")
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

        function gonext() {
            $('.loading-overlay').show();
            setTimeout(() => {
                location.href = "{{route('getShippingView')}}";
                $('.loading-overlay').fadeOut();
            }, 1000);
        }

    </script>
    <script>
        $(function () {
            $('.multiselect').change(function () {
                console.log($(this).val());
            }).multipleSelect({
                width: '100%'
            });
        });

        function remove(id) {
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
                if (result) {

                    $.ajax({
                        method: "delete",
                        url: "{{route('deleteDrugStore')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: id,
                        },
                        success:function (response) {
                            if (response.status){
                                location.reload();
                            }
                        },
                        error:function (errors) {

                        }
                    })
                }
            })
        }
    </script>
@endsection