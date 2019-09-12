@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    {{Html::style('assets/css/mapbox-gl.css')}}
    {{Html::style('assets/css/mapbox-gl-geocoder.css')}}
    {{Html::style('assets/css/iziToast.min.css')}}
    <style>
        .section {
            padding: 10px 0;
        }

        .marker {
            background-image: url('{{asset("assets/img/custom_marker.png")}}');
            background-size: cover;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
        }

        .mapboxgl-popup {
            max-width: 200px;
        }

        .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
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
        @include("pages.allJobs.templates.top_header")
        @include("pages.allJobs.templates.center_content")
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

        function deleteJob(id) {

            swal({
                title: '{{__('settings.warning')}}',
                text: '{{__('settings.are_you_sure')}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '{{__('settings.yes')}}',
                cancelButtonText:  '{{__('settings.no')}}',
            }).then((result) => {
                if (result) {
                    $('.loading-overlay').show();
                    $.ajax({
                        method: 'delete',
                        url: '{{route('deleteJob')}}',
                        data: {
                            _token: '{{csrf_token()}}',
                            job_id: id
                        },
                        success: function (response) {
                            console.log(response);
                            setTimeout(() => {
                                $('.loading-overlay').fadeOut();
                                if (response.status) {

                                    location.reload();
                                }
                            }, 200);
                        },
                        error: function (errors) {

                        }
                    });
                }
            });
        }
    </script>
@endsection