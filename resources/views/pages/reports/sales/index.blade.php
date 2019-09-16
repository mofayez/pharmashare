@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>
    {{Html::style('assets/css/iziToast.min.css')}}
    <style>
        #myTable_wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
        }
    </style>
@endsection

@section("body")

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>

    <div class="wrapper">
        @include("pages.reports.sales.templates.sales")
    </div>
    <button class="btn btn-info btn-round btn-icon btn-lg"
            onclick="print();"
            style="position: fixed;right: 30px;bottom: 30px">
        <i class="now-ui-icons files_paper"></i>
    </button>
    </body>

@endsection

@section("scripts")

    {{Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

    </script>
@endsection