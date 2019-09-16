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
        @include("pages.profile.get-all-favourites.templates.top_header")
        @include("pages.profile.get-all-favourites.templates.center_content")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    {{Html::script("assets/js/multiple-select.js")}}
    <script>
        let fav_count = parseInt("{{count($favourites)}}");
        
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        $('.fav_form').on('submit', function (e) {

            e.preventDefault();
            let form = $(this);
            let form_data = form.serialize();

            $.ajax({
                url: '{{route('submitFavourite')}}',
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
                        title:"{{app()->getLocale() == 'ar' ? 'تمت العملية بنجاح': 'Successfully Edit'}}"
                    })
                    form.parents().eq(1).fadeOut()
                }
            })
        });

        function deleteFav(id) {
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
                        url: "{{route('deleteFavourite')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id: id,
                        },
                        success: function (response) {
                            if (response.status) {
                                $('#_' + id).fadeOut()
                                
                                fav_count = fav_count - 1;                  
                                if(fav_count == 0){
                                    $('#no_data').show();
                                }
                            }
                        },
                        error: function (errors) {

                        }
                    })
                }
            })
        }
    </script>
@endsection