<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <?php echo e(Html::style('assets/css/mapbox-gl.css')); ?>

    <?php echo e(Html::style('assets/css/mapbox-gl-geocoder.css')); ?>

    <style>
        .section {
            padding: 10px 0;
        }

        #map {
            width: 100%;
            height: 350px;
            zoom: 120%;
        }

        .mapboxgl-canvas {
            left: 0;
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
        <?php echo $__env->make("pages.pharmacy.drugStoreMap.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.pharmacy.drugStoreMap.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

    </script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibXVoYW1tYWRhd2QiLCJhIjoiY2pub2JyZHc1Mjg4czNrbzNmengwZWVhNyJ9.HoLCFRgD50g8kxEw-5hmvA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/dark-v9',
            zoom: 7,
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
            zoom: 12,
            class: "form-control",
            placeholder: "<?php echo e(__('pharmacy.search')); ?>"
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

        let markers = JSON.parse('<?php echo json_encode($all_locations); ?>');
        
        $('.select_types').on('change',function(){
            let type = $(this).val();
            location_type(type);
        });
        
        function location_type(type){
            location.href = "<?php echo e(route('drugStoreMapView')); ?>?type="+type;
        }
        
        $.each(markers, function (index, marker) {
            addMarker(marker)
        });

        function addMarker(e) {

            var el = document.createElement('div');
            el.className = 'marker';
            let coordinates = [e.lng, e.lat];

            prev_marker = new mapboxgl.Marker(el)
                .setLngLat(coordinates)
                .setPopup(new mapboxgl.Popup({offset: 25})
                .setHTML('<h3 class="btn btn-main text-white" style="font-size: 15px">' + e.name + '</h3><p>' + e.phone + '</p>'))
                .addTo(map)
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>