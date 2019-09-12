@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    {{Html::style('assets/css/iziToast.min.css')}}
    <style>
        .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
            background-color: #722ec2;
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
        @include("pages.setting.setPayments.templates.top_header")
        @include("pages.setting.setPayments.templates.center_content")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

            $('#change_profile').on('click', function () {
                $('input[name="profile-image"]').trigger('click');
            });
            $('input[name="profile-image"]').on('change', function () {
                showMyImage(this);
            });
        });

        //helpers
        function showMyImage(fileInput) {
            var files = fileInput.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var imageType = /image.*/;
                if (!file.type.match(imageType)) {
                    continue;
                }
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function (e) {
                    $('.update-profile-loader').show();
                    setTimeout(() => {
                        $("#image-preview").attr('src', this.result);
                        $('.update-profile-loader').hide();
                    }, 1000);
                }
            }
        }

        @if(session()->has('success'))
        globalAddNotify('{{session()->get('success')}}', 'success');
        @endif

        @if(session()->has('error'))
        globalAddNotify('{{session()->get('error')}}', 'danger');
        @endif
    </script>
@endsection