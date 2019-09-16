<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <?php echo e(Html::style('assets/css/mapbox-gl.css')); ?>

    <?php echo e(Html::style('assets/css/mapbox-gl-geocoder.css')); ?>

    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <style>
        .section {
            padding: 10px 0;
        }
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

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("body"); ?>

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    <?php echo $__env->make("includes.navbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="wrapper">
        <?php echo $__env->make("pages.postJob.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.postJob.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

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
            start: [1000, 5000],
            connect: !0,
            direction: '<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>',
            range: {min: 0, max: 10000}
        }).on('update', function (data, z) {
            $("#salaryfrom").text(data[0]);
            $("#salaryto").text(data[1]);
            $('input[name="salary"]').val(data[0]);
            $('input[name="max_salary"]').val(data[1]);
        });
    </script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibXVoYW1tYWRhd2QiLCJhIjoiY2pub2JyZHc1Mjg4czNrbzNmengwZWVhNyJ9.HoLCFRgD50g8kxEw-5hmvA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/light-v9',
            zoom: 6,
            center: [54.2639, 23.6486]
        });

        var el = document.createElement('div');
        el.className = 'marker';
        var coordinates = [54.2639, 23.6486];
        new mapboxgl.Marker(el)
            .setLngLat(coordinates)
            .setPopup(new mapboxgl.Popup({offset: 25}) // add popups
            .setHTML('<h3>Coordinates</h3><p>' + 54.2639 + '<br>' + 23.6486 + '</p>'))
            .addTo(map);
        // $('input[name="comment"]');

        map.on('click', addMarker);

        function addMarker(e) {

            //add marker

            var el = document.createElement('div');
            el.className = 'marker';
            let coordinates = [e.lngLat.lng, e.lngLat.lat];
            console.log(e)

            new mapboxgl.Marker(el)
                .setLngLat(coordinates)
                .setPopup(new mapboxgl.Popup({offset: 25}) // add popups
                .setHTML('<h3>Coordinates</h3><p>' + e.lngLat.lng + '<br>' + e.lngLat.lat + '</p>'))

                .addTo(map);
            // circleMarker = new mapboxgl.Marker(e.latlng, 200, {
            //     color: 'red',
            //     fillColor: '#f03',
            //     fillOpacity: 0.5
            // }).addTo(map);
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>