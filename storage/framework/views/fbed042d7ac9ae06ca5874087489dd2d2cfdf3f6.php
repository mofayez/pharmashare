<?php $__env->startSection("styles"); ?>
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <?php echo e(Html::style('assets/css/iziToast.min.css')); ?>

    <script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <?php echo e(Html::style('assets/css/mapbox-gl.css')); ?>

    <?php echo e(Html::style('assets/css/mapbox-gl-geocoder.css')); ?>

    <script src="https://maps.googleapis.com/maps/api/js?v=3&key=<?php echo e(env("GOOGLE_MAP_API")); ?>&amp;sensor=false&amp;libraries=geometry"></script>

    <style>
        .nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
            background-color: #722ec2;
        }
        #map ,.mapboxgl-canvas{ 
            height: 40vh;
            display: flex;
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
    <?php if($user->role_id == 4): ?>
        <?php echo $__env->make("includes.navbar_alt", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make("includes.navbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <div class="wrapper">
        <?php echo $__env->make("pages.setting.editProfile.templates.top_header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("pages.setting.editProfile.templates.center_content", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    </body>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("scripts"); ?>

    <?php echo e(Html::script("assets/js/emojionearea.min.js")); ?>

    <?php echo e(Html::script("assets/js/iziToast.min.js")); ?>

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
                    data.append('_token','<?php echo e(csrf_token()); ?>');
                    data.append('file', files[0]);
                    let image = this.result;
                    setTimeout(() => {
                        $.ajax({
                            method: 'POST',
                            url: '<?php echo e(route('updateProfileImage')); ?>',
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
        <?php if(session()->has('success')): ?>
        globalAddNotify('<?php echo e(session()->get('success')); ?>', 'success');
        <?php endif; ?>

        <?php if(session()->has('error')): ?>
        globalAddNotify('<?php echo e(session()->get('error')); ?>', 'danger');
        <?php endif; ?>
    </script>
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
            
            // $.ajax({
            //     url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+e.lngLat.lat+','+e.lngLat.lng+'&key=<?php echo e(env("GOOGLE_MAP_API")); ?>', 
            //     type: "get",    
            //     dataType: 'json',
            //     success: function(response){                          
            //         console.log(response);                   
            //     }           
            // });  
            
            var geocoder = new google.maps.Geocoder();
            let lngLat = new google.maps.LatLng(e.lngLat.lat , e.lngLat.lng);
            var geocoderRequest = { location: lngLat };
            geocoder.geocode(geocoderRequest, function(results, status){
                if(status == 'OK'){
                    $('input[name="geo_location"]').val(results[0].formatted_address); 
                }
                
            //do your result related activities here, maybe push the coordinates to the backend for later use, etc.
            });  
            
            prev_marker = new mapboxgl.Marker(el)
                .setLngLat(coordinates)
                // .setPopup(new mapboxgl.Popup({offset: 25})
                // .setHTML('<h3>Coordinates</h3><p>' + e.lngLat.lng + '<br>' + e.lngLat.lat + '</p>'))
                .addTo(map);
        }
        $('#jobs_modal').on('show.bs.modal', function (event) {
            console.log('sdsa')
            setTimeout(()=>{
                
                map.resize()
            },200)
        });
        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>