@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.3/cropper.js"></script>
    {{Html::style('assets/css/iziToast.min.css')}}
    <style>
        .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
            background-color: #722ec2;
        }

        .docs-preview {
            margin-left: -1rem;
        }

        .img-preview {
            float: right;
            margin-bottom: .5rem;
            margin-left: .5rem;
            direction: ltr;
            overflow: hidden;
            margin: auto;
        }

        .img-preview > img {
            max-width: 100%;
        }

        .preview-lg {
            width: 100%;
            height: 240px;
            margin: auto;
        }

        .btn-info.active:hover, .btn-info:active:hover, .btn-info:focus, .btn-info:hover, .btn-info:not(:disabled):not(.disabled).active, .btn-info:not(:disabled):not(.disabled).active:focus, .btn-info:not(:disabled):not(.disabled):active, .btn-info:not(:disabled):not(.disabled):active:focus, .show > .btn-info.dropdown-toggle, .show > .btn-info.dropdown-toggle:focus, .show > .btn-info.dropdown-toggle:hover {
            background-color: #463d3a;
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
        @include("pages.offers.editImageOffers.templates.top_header")
        @include("pages.offers.editImageOffers.templates.center_content")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

            const $image = document.getElementById('image');
            const $image2 = document.getElementById('image2');
            let options = {
                aspectRatio: 1 / 2,
                preview: '#preview1',
            };
            let options2 = {
                aspectRatio: 16 / 9,
                preview: '#preview2',
            };

            let cropper = new Cropper($image, options);
            let cropper2 = new Cropper($image2, options2);

            let canvas;
            let canvas2;
            $('#form').submit(function (e) {
                e.preventDefault();
                $('.loading-overlay').show();
                let form = $(this)[0];
                canvas = cropper.getCroppedCanvas();
                canvas2 = cropper2.getCroppedCanvas();

                var formData = new FormData(form);
                    formData.append('ad_id', '{{request()->id}}');
                canvas.toBlob(function (blob) {
                    formData.append('size_2_1', blob);
                    formData.append('second_image_ratio', '1/2');
                });
                canvas2.toBlob(function (blob) {
                    ;
                    formData.append('size_16_9', blob);
                    formData.append('third_image_ratio', '16/9');
                });

                setTimeout(() => {

                    $.ajax({
                        url: '{{route('uploadUpdateImagesAds')}}',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            // console.log(response);
                            setTimeout(() => {
                                $('.loading-overlay').fadeOut();
                            }, 1000);
                            if (response.status) {

                                globalAddNotify('{{__('settings.add_success')}}', 'success');
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            } else {
                                let errors = response.data.validation_errors;
                                if (errors.image_package_id) {
                                    $('#image_package_id_error').show().text(errors.image_package_id[0]);
                                } else {
                                    $('#image_package_id_error').hide()
                                }
                                if (errors.link) {
                                    console.log(errors)
                                    $('#link_error').show().text(errors.link[0]);
                                } else {
                                    $('#link_error').hide()
                                }
                                if (errors.original_image) {
                                    $('#image_error').show().text(errors.original_image[0]);
                                } else {
                                    $('#image_error').hide()
                                }
                                if (errors.scaled_image) {
                                    $('#image_error').show().text(errors.scaled_image[0]);
                                } else {
                                    $('#image_error').hide()
                                }
                            }
                        }
                    });
                }, 1000);
            });

            // Import image
            let inputImage = document.getElementById('inputImage');
            let inputImage2 = document.getElementById('inputImage2');
            if (URL) {
                inputImage.onchange = function () {
                    var files = this.files;
                    var file;
                };
                inputImage2.onchange = function () {
                    var files = this.files;
                    var file;
                };
            } else {
                inputImage.disabled = true;
                inputImage.parentNode.className += ' disabled';
                inputImage2.disabled = true;
                inputImage2.parentNode.className += ' disabled';
            }
            $('input[name="image"]').on('change', function () {
                showMyImage(this, cropper);
            });
            $('input[name="image2"]').on('change', function () {
                showMyImage(this, cropper2);
            });

        });

        //relace
        function showMyImage(fileInput, cropper) {
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
                    cropper.replace(this.result)
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