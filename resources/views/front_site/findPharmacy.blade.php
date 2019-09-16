<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title> Pharmacy </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <link rel='stylesheet' href='front_assets/css/style.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/bootstrap.min.css' type='text/css' media='all'/>
    @if(app()->getLocale() == 'ar')
        <link rel='stylesheet' href='front_assets/css/bootstrap-rtl.min.css' type='text/css' media='all'/>
    @endif
    <link rel='stylesheet' href='front_assets/css/now-ui-kit.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/main.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/custom.css' type='text/css' media='all'/>
    @if(app()->getLocale() == 'ar')
        <link rel='stylesheet' href='front_assets/css/ar.css' type='text/css' media='all'/>
    @else
        <link rel='stylesheet' href='front_assets/css/en.css' type='text/css' media='all'/>
    @endif
    <script type='text/javascript' src='front_assets/js/jquery-3.2.1.min.js'></script>
    <script type='text/javascript' src='front_assets/js/jquery-1.12.4.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    {{Html::style('assets/css/mapbox-gl.css')}}
    {{Html::style('assets/css/mapbox-gl-geocoder.css')}}
    <style>
        #map {
            width: 100%;
            height: 500px;
            zoom: 120%;
        }

        .mapboxgl-canvas {
            left: 0;
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
</head>

<body class="page-template page-template-page-wordpress page-template-page-wordpress-php page page-id-10451  onepagermenu wpb-js-composer js-comp-ver-4.12 vc_responsive"
      id=”skrollr-body”>

@include('front_site.templates.navbar')

<article id="bodywrapper">

    <!--! Content -->
    <article class="nosidebar  post-10451 page type-page status-publish hentry category-wordpress">

        <!-- Content -->
        <section id="content_inner_wrapper" class="dark" style="margin:auto;width:100%;background-color:#ffffff">
            <section id="content-container">

                <div class="container-fluid" style="padding: 0">

                    <!--start contact-->
                    <section class="tp_vc_mw_rowwrapper pb-0" style="background: #FFF;padding: 0;">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article class="tp_vc_mw_rowinner  darkonlight">
                            <div class="rowbgimage_overlay" style="background-color:transparent;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid mb-0">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center"
                                                             style="background: url('{{asset('front_assets/images/bg_1.jpg')}}') center center no-repeat;background-size: cover">
                                                            <h2 class="p-5 mt-5">
                                                                {{app()->getLocale() == 'ar' ? 'الخريطة': 'Map'}}
                                                            </h2>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-plain card-body">
                                                                    <div class="row direction">
                                                                        <div class="col-md-3">
                                                                            <select class="select_types bg-white form-control" style="height: 56px;" name="types">
                                                                                <option value="all" {{app('request')->get('type') == 'all' || !app('request')->get('type') ? 'selected' : ''}}>
                                                                                    {{app()->getLocale() == 'ar' ? 'الكل': 'All'}}
                                                                                </option>
                                                                                <option value="pharmacy" {{app('request')->get('type') == 'pharmacy' ? 'selected' : ''}}>
                                                                                    {{app()->getLocale() == 'ar' ? 'الصيدلي': 'Pharmacy'}}
                                                                                </option>
                                                                                <option value="store" {{app('request')->get('type') == 'store' ? 'selected' : ''}}>
                                                                                    {{app()->getLocale() == 'ar' ? 'المخزن': 'Store'}}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div id='map'></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end contact-->

                    <!--start footer-->
                    <hr>
                    <footer style="background: url('front_assets/images/footer_bg.jpg') center bottom no-repeat;background-size: contain">
                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <p>
                                    Copy Rights Are Reseved
                                    <a style="color: purple" href="">@approc</a>
                                    Inc .
                                </p>
                            </div>
                        </div>
                    </footer>
                    <!--end footer-->
                </div>

                <div class="content_max_width"></div>
            </section>
            <!-- End Of Content -->

            <div class="clearfix"></div>
        </section>

    </article>

</article>

<script src="front_assets/js/bootstrap.min.js"></script>
<script src="front_assets/js/popper.min.js"></script>
<script src="front_assets/js/now-ui-kit.min.js"></script>
<script type='text/javascript' src='front_assets/js/revslider/js/revolution.addon.paintbrush.min-1.0.0.js'></script>
<script type='text/javascript' src='front_assets/js/particles.min.js'></script>
<script>

    $('.select_types').on('change',function(){
        let type = $(this).val();
        location_type(type);
    });

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
        placeholder: " ابحث عن صيدليه هنا    "
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

    let markers = {!! $users !!};
    $.each(markers, function (index, marker) {
        if(marker.location){
            addMarker(marker)   
        }
    });

    function addMarker(e) {
        console.log(e)

        var el = document.createElement('div');
        el.className = 'marker';
        let coordinates = [e.location.lng, e.location.lat];

        prev_marker = new mapboxgl.Marker(el)
            .setLngLat(coordinates)
            .setPopup(new mapboxgl.Popup({offset: 25})
            .setHTML('<h3 class="btn btn-main text-white" style="font-size: 15px">' + e.firstname + e.lastname + '</h3><p>' + e.phone + '</p>'))
            .addTo(map);
    }
    
    function location_type(type){
        location.href = "{{route('getPharamcyView')}}?type="+type;
    }
</script>
</body>
</html>