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
        @include("pages.setting.editLicenses.templates.top_header")
        @include("pages.setting.editLicenses.templates.center_content")
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

                    let data = new FormData();
                    data.append('_token','{{csrf_token()}}');
                    data.append('file', files[0]);
                    let image = this.result;
                    setTimeout(() => {
                        $.ajax({
                            method: 'POST',
                            url: '{{route('updateProfileImage')}}',
                            processData: false,  // Important!
                            contentType: false,
                            cache: false,
                            data: data,
                            success: function (response) {
                                console.log(response);
                                if (response.status){
                                    $("#image-preview").attr('src', image);
                                    $('.update-profile-loader').hide();
                                }
                            },
                            error: function (errors) {
                                console.log(errors)
                            }
                        });
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