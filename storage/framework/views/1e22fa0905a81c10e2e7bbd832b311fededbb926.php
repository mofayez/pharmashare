<?php $__env->startSection('styles'); ?>
    <style media="screen">
        .has-success.input-lg:after, .has-danger.input-lg:after {
            right: 85% !important;
            top: 15px !important;
        }

        input::placeholder {
            color: #555 !important;
        }
    </style>
    <style>
        .marker {
            background-image: url('<?php echo e(asset("assets/img/custom_marker.png")); ?>');
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

        .form-control {
            border-radius: 8px;
            background: #FFF;
        }

        .form-group .form-control, .input-group .form-control {
            padding: 10px 25px;
        }

        .form-content {
            margin-top: 10%;
        }

        .margin-form {
            margin-right: 6%;
            margin-left: 6%;
        }
    </style>
    <style>
        .register {
            display: flex
        }

        .register-part-one {
            flex: 50
        }

        .register-part-two {
            flex: 50
        }

        .messages-img {
            position: fixed;
            z-index: 9;
            bottom: 0;
            left: 0;
            width: 30%;
        }

        .mdl-card {
            width: 550px;
            min-height: 0;
            margin: 10px auto;
        }

        .mdl-card__supporting-text {
            width: 100%;
            padding: 0;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step {
            width: 25%;
            /* 100 / no_of_steps */
        }

        /* Begin actual mdl-stepper css styles */

        .mdl-stepper-horizontal-alternative {
            display: table;
            width: 80%;
            /*margin: 0 auto;*/
            float: right;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step {
            display: table-cell;
            position: relative;
            padding: 24px;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:hover,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step:active {
            background-color: rgba(0, 0, 0, .06);
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:active {
            border-radius: 15% / 75%;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:first-child:active {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:last-child:active {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:hover .mdl-stepper-circle {
            background-color: #757575;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step:first-child .mdl-stepper-bar-left,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step:last-child .mdl-stepper-bar-right {
            display: none;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-circle {
            width: 50px;
            height: 50px;
            margin: 0 auto;
            background-color: #9E9E9E;
            border-radius: 5px;
            text-align: center;
            line-height: 50px;
            font-size: 12px;
            color: white;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.active-step .mdl-stepper-circle {
            background-color: #5f2cbb;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.step-done .mdl-stepper-circle:before {
            content: "\2714";
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.step-done .mdl-stepper-circle *,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step.editable-step .mdl-stepper-circle * {
            /*display: none;*/
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.editable-step .mdl-stepper-circle {
            border: 3px solid #eee;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-title {
            margin-top: 16px;
            font-size: 14px;
            font-weight: normal;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-title,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-optional {
            text-align: center;
            color: #FFF;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.active-step .mdl-stepper-title {
            font-weight: bold;
            color: #FFF;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-optional {
            font-size: 12px;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step.active-step .mdl-stepper-optional {
            color: rgba(0, 0, 0, .54);
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-left,
        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-right {
            position: absolute;
            top: 45px;
            height: 1px;
            border-top: 1px solid #BDBDBD;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-right {
            right: 0;
            left: 60%;
            margin-left: 20px;
        }

        .mdl-stepper-horizontal-alternative .mdl-stepper-step .mdl-stepper-bar-left {
            left: 0;
            right: 60%;
            margin-right: 20px;
        }

        @-webkit-keyframes wave1 {
            0% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
            50% {
                -webkit-transform: skewX(-50deg);
                transform: skewX(-50deg);
            }
            100% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
        }

        @keyframes  wave1 {
            0% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
            50% {
                -webkit-transform: skewX(-50deg);
                transform: skewX(-50deg);
            }
            100% {
                -webkit-transform: skewX(-55deg);
                transform: skewX(-55deg);
            }
        }

        @-webkit-keyframes wave2 {
            0% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
            50% {
                -webkit-transform: skewX(-40deg);
                transform: skewX(-40deg);
            }
            100% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
        }

        @keyframes  wave2 {
            0% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
            50% {
                -webkit-transform: skewX(-40deg);
                transform: skewX(-40deg);
            }
            100% {
                -webkit-transform: skewX(-45deg);
                transform: skewX(-45deg);
            }
        }

        @-webkit-keyframes wave3 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
            50% {
                -webkit-transform: skewX(-60deg);
                transform: skewX(-60deg);
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
        }

        @keyframes  wave3 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
            50% {
                -webkit-transform: skewX(-60deg);
                transform: skewX(-60deg);
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
            }
        }

        @-webkit-keyframes wave4 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
            50% {
                -webkit-transform: skewX(-60deg) rotateX(50deg);
                transform: skewX(-60deg) rotateX(50deg);
                border-radius: 90%;
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
        }

        @keyframes  wave4 {
            0% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
            50% {
                -webkit-transform: skewX(-60deg) rotateX(50deg);
                transform: skewX(-60deg) rotateX(50deg);
                border-radius: 90%;
            }
            100% {
                -webkit-transform: skewX(-65deg);
                transform: skewX(-65deg);
                border-radius: 0;
            }
        }

        .stripe {
            position: absolute;
            width: 500px;
            height: 500px;
        }

        .stripe1 {
            top: -300px;
            left: -300px;
            -webkit-transform: skewX(-55deg);
            transform: skewX(-55deg);
            background: rgba(103, 58, 183, 0.3);
            -webkit-animation: wave1 6s infinite;
            animation: wave1 6s infinite;
        }

        .stripe2 {
            top: -350px;
            left: -350px;
            -webkit-transform: skewX(-45deg);
            transform: skewX(-45deg);
            background: rgba(103, 58, 183, 0.2);
            -webkit-animation: wave2 6s infinite;
            animation: wave2 6s infinite;
        }

        .stripe3 {
            top: -356px;
            left: -200px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.1);
            -webkit-animation: wave3 6s infinite;
            animation: wave3 6s infinite;
        }

        .stripe4 {
            top: -322px;
            left: -200px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.1);
            -webkit-animation: wave3 6s infinite;
            animation: wave3 6s infinite;
        }

        .stripe5 {
            top: -380px;
            left: -200px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.4);
            -webkit-animation: wave3 6s infinite;
            animation: wave3 6s infinite;
        }

        .stripe6 {
            top: -179px;
            left: -191px;
            -webkit-transform: skewX(-65deg);
            transform: skewX(-65deg);
            background: rgba(103, 58, 183, 0.08);
            -webkit-animation: wave4 6s infinite linear;
            animation: wave4 6s infinite linear;
        }

        .stripe7 {
            top: -316px;
            left: 51px;
            -webkit-transform: skewX(-55deg);
            transform: skewX(-55deg);
            background: rgba(103, 58, 183, 0.06);
            -webkit-animation: wave4 6s infinite linear;
            animation: wave4 6s infinite linear;
        }

        .rightside {
            background: url('<?php echo e(asset('assets/img/bg.jpg')); ?>') center center no-repeat;
            background-size: cover;
            position: absolute;
            right: 0;
            width: 50%;
            height: 100%;
            z-index: 0;
            clip-path: polygon(25% 0%, 100% 1%, 100% 100%, 25% 100%, 0 31%);
        }

        label {
            /*font-weight: bold;*/
            color: #fff;
        }

        #map {
            width: 70%;
            height: 100vh;
            position: absolute;
            display: flex;
        }

        .btn-operations {
            position: fixed;
            bottom: 20px;
            left: 15%;
            width: 20%
        }

        /*small screens*/
        @media  only screen and (max-width: 600px) {

            .btn-operations {
                position: fixed;
                bottom: 20px;
                left: 15%;
                width: 70%
            }

            #map {
                width: 100%;
                height: 100vh;
                position: absolute;
                display: flex;
            }

            .form-content {
                margin-top: 0;
            }

            .register {
                display: block;
            }

            .register-part-one {
                display: none !important;
            }

            .rightside {
                display: none !important;
            }

            .register-part-two {
                flex: none
            }

            .messages-img {
                width: 100%;
            }
        }
    </style>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <?php echo e(Html::style('assets/css/mapbox-gl.css')); ?>

    <?php echo e(Html::style('assets/css/mapbox-gl-geocoder.css')); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('body'); ?>

    <body class="login-page register" style="background: transparent">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <div id='map'></div>
    <div class="register-part-two">
        <div class="stripes">
            <div class="stripe stripe1"></div>
            <div class="stripe stripe2"></div>
            <div class="stripe stripe3"></div>
            <div class="stripe stripe4"></div>
            <div class="stripe stripe5"></div>
            <div class="stripe stripe6"></div>
            <div class="stripe stripe7"></div>
        </div>
        <div class="form-content">

            <div class="row direction margin-form">
                
                
                
                
                
                
                
                <div class="btn-operations">
                    <?php echo e(Form::open([
                        'method'=>'post',
                        'id'=>'form',
                        'route'=>['postRegister2',app('request')->id]
                    ])); ?>

                    <input type="hidden" name="lat">
                    <input type="hidden" name="lng">
                    <input type="hidden" name="location">
                    <div class="col-md-12 text-center mt-2">
                        <button id="submit_step" type="submit" class="btn btn-main btn-round text-white">
                            <?php echo e(__('auth.complete_step2')); ?>

                        </button>
                    </div>
                    <?php echo e(Form::close()); ?>

                    <div class="col-md-12">
                        <div class="btn-group" style="display: flex;flex: 1">
                            <a href="<?php echo e(route('getRegisterView3',['id'=>app('request')->id])); ?>"
                               class="btn btn-default bg-white"
                               style="width: 100%;border-radius:0;color:#000;border: 1px solid transparent;">
                                <?php echo e(__('auth.skip_step')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rightside" filter-color="purple"></div>
    <div class="page-header header-filter register-part-one" filter-color="purple"
         style="clip-path: polygon(25% 0%, 100% 1%, 100% 100%, 25% 100%, 0 31%);">
        <div class="page-header-image"
             style="clip-path:polygon(0 0, 100% 0%, 0 0, 0% 100%);
                     background:url('<?php echo e(asset('assets/img/bg.jpg')); ?>')  left center;background-size: cover;"></div>
        <div class="content">
            <div class="container">
                <div class="col-md-12">
                    <h3 class="title text-left">
                        <?php echo e(__('auth.register_new_account')); ?>    </h3>
                    <div class="mdl-card mdl-shadow--2dp">

                        <div class="mdl-card__supporting-text direction">

                            <div class="mdl-stepper-horizontal-alternative">
                                <div class="mdl-stepper-step active-step  editable-step">
                                    <div class="mdl-stepper-circle"><span>1</span></div>
                                    <div class="mdl-stepper-title">
                                        <?php echo e(__('auth.step1')); ?>   </div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                                <div class="mdl-stepper-step active-step">
                                    <div class="mdl-stepper-circle"><span>2</span></div>
                                    <div class="mdl-stepper-title"><?php echo e(__('auth.step2')); ?>  </div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                                <div class="mdl-stepper-step active-step">
                                    <div class="mdl-stepper-circle"><span>3</span></div>
                                    <div class="mdl-stepper-title"><?php echo e(__('auth.step3')); ?>  </div>
                                    <div class="mdl-stepper-bar-left"></div>
                                    <div class="mdl-stepper-bar-right"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row form-content" dir="rtl"
             style="margin-top: 25%;position:absolute;display: inline-flex;z-index: 99;width: 100%;left: 0;">
            <div class="col-md-9  text-center">
                <h3 class="mb-0">20%</h3>
                <h5><?php echo e(__('auth.completed')); ?></h5>
            </div>
        </div>
        <div class="row form-content" dir="rtl"
             style="position:absolute;display: inline-flex;z-index: 99;width: 100%;left: 0;">
        </div>
    </div>
    <div class="position-absolute" style="bottom: 0;right: 20px;z-index: 99">
        <nav>
            <ul class="list-unstyled">
                <li class="list-inline-item">
                    <a href="<?php echo e(route("setAr")); ?>">
                        العربية
                    </a>
                </li>
                <li class="list-inline-item"> | </li>
                <li class="list-inline-item">
                    <a href="<?php echo e(route("setEn")); ?>">
                        English
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    </body>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $("#footer").remove();
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });
        $("#form").submit(function (e) {
            e.preventDefault();
            $('.loading-overlay').show();
            setTimeout(() => {
                document.getElementById("form").submit();
            }, 1000);
        })
    </script>

    <?php if($errors->has('lat') || $errors->has('lng') ): ?>
        <script>
            $.growl({
                message: `<p>عفوا عليك تحديد الموقع اولا</p>`
            }, {
                type: 'danger',
                allow_dismiss: !1,
                label: "Cancel",
                className: "btn-xs text-right btn-inverse",
                placement: {
                    from: "bottom",
                    align: "right"
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
        </script>
    <?php endif; ?>
    <?php if(!$errors->has('lat') && $errors->has('location') ): ?>
        <script>

            setTimeout(() => {
                $('.mapboxgl-ctrl-geocoder input').css({
                    'border': '2px solid #F44336',
                    'border-radius': '4px',
                });
            }, 100);

            $.growl({
                message: `<p> عفوا عليك كتابة عنوان الموقع  </p>`
            }, {
                type: 'danger',
                allow_dismiss: !1,
                label: "Cancel",
                className: "btn-xs text-right btn-inverse",
                placement: {
                    from: "bottom",
                    align: "right"
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
        </script>
    <?php endif; ?>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibXVoYW1tYWRhd2QiLCJhIjoiY2pub2JyZHc1Mjg4czNrbzNmengwZWVhNyJ9.HoLCFRgD50g8kxEw-5hmvA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/dark-v9',
            zoom: 6,
            center: [54.2639, 23.6486]
        });
        var customData = {
            "features": [],
            "type": "FeatureCollection"
        };
        // $('input[name="comment"]');
        map.addControl(new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            localGeocoder: forwardGeocoder,
            zoom: 14,
            class: "form-control",
            placeholder: "<?php echo e(__('auth.write_location')); ?>"
        }));

        function forwardGeocoder(query) {
            var matchingFeatures = [];
            for (var i = 0; i < customData.features.length; i++) {
                var feature = customData.features[i];
                // handle queries with different capitalization than the source data by calling toLowerCase()
                if (feature.properties.title.toLowerCase().search(query.toLowerCase()) !== -1) {
                    // add a tree emoji as a prefix for custom data results
                    // using carmen geojson format: https://github.com/mapbox/carmen/blob/master/carmen-geojson.md
                    feature['place_name'] = '🌲 ' + feature.properties.title;
                    feature['center'] = feature.geometry.coordinates;
                    feature['place_type'] = ['park'];
                    matchingFeatures.push(feature);
                }
            }
            return matchingFeatures;
        }

        map.on('click', addMarker);
        let prev_marker = null;

        function addMarker(e) {
            if (prev_marker) {
                prev_marker.remove();
            }

            var el = document.createElement('div');
            el.className = 'marker';
            let coordinates = [e.lngLat.lng, e.lngLat.lat];
            let locaiton = $('.mapboxgl-ctrl-geocoder input').val();

            $('input[name="lng"]').val(e.lngLat.lng);
            $('input[name="lat"]').val(e.lngLat.lat);
            $('input[name="location"]').val(locaiton);

            prev_marker = new mapboxgl.Marker(el)
                .setLngLat(coordinates)
                // .setPopup(new mapboxgl.Popup({offset: 25})
                // .setHTML('<h3>Coordinates</h3><p>' + e.lngLat.lng + '<br>' + e.lngLat.lat + '</p>'))
                .addTo(map);
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>