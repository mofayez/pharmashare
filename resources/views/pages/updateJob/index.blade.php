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
        @include("pages.updateJob.templates.top_header")
        @include("pages.updateJob.templates.center_content")
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


        function changeType() {
            let type_id = $('select[name="job_type_id"]').val();
            if(type_id == 3){
                $('#range').show();
            } else{
                $('#range').hide();
            }
        }


        let o = document.getElementById("sliderSalary");
        noUiSlider.create(o, {
            start: [{{$job->salary ?? 1000}}, {{$job->max_salary ?? 5000}}],
            connect: !0,
            direction: '{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}',
            range: {min: 0, max: 10000}
        }).on('update', function (data, z) {
            $("#salaryfrom").text(data[0]);
            $("#salaryto").text(data[1]);
            $('input[name="salary"]').val(data[0]);
            $('input[name="max_salary"]').val(data[1]);
        });

        @if(session()->has('success'))
        globalAddNotify('{{session()->get('success')}}', 'success');
        @endif

        @if(session()->has('error'))
        globalAddNotify('{{session()->get('error')}}', 'danger');
        @endif
    </script>
@endsection