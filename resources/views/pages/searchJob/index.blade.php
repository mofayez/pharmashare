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
    @include("includes.navbar_alt")

    <div class="wrapper">
        @include("pages.searchJob.templates.top_header")
        
        @include("pages.searchJob.templates.center_content")
    </div>

    <!-- Modal -->
    <div class="modal fade" id="jobs_modal" tabindex="-1" role="dialog" aria-labelledby="jobs_modal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="transform: translate(0,65px);">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobs_modal_lable"> Job Info</h5>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="table_body">
    
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}} 
    <script>
        $('.loading-overlay').fadeOut();
    </script>
    <script>
        $(document).ready(function () {
    
            $('#jobs_modal').on('show.bs.modal', function (event) {
                $('#table_body').empty();
                let button = $(event.relatedTarget);
                let info = button.data('info');
                console.log(info)
                $('#table_body').append(`
                    <tr>
                        <td>Job Name</td>
                        <td>${info.job_name}</td>
                    </tr>
                `);
                $('#table_body').append(`
                    <tr>
                        <td>Job Requirement</td>
                        <td>${info.requirements}</td>
                    </tr>
                `);
                $('#table_body').append(`
                    <tr>
                        <td>Job Contacts</td>
                        <td>${info.contacts}</td>
                    </tr>
                `);
                $('#table_body').append(`
                    <tr>
                        <td>Job Salary</td>
                        <td>${info.job_type.title}
                            ${info.salary ? info.salary : ''}
                            
                            ${info.max_salary ? ' , '+info.max_salary : ''}
                        </td>
                    </tr>
                `);
            })
        });
    </script>
@endsection