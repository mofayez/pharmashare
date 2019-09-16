@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css'>

    {{Html::style('assets/css/iziToast.min.css')}}
@endsection

@section("body")

    <body class="profile-page">
    <div class="loading-overlay">
        <div class="loading-overlay-icon"></div>
    </div>
    @include("includes.navbar")

    <div class="wrapper">
        @include("pages.points.all.templates.top_header")
        @include("pages.points.all.templates.center_content")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js")}}
    {{Html::script("assets/js/typeahead.bundle.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    <script>
        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        table2 = $('#myTable').DataTable({
            "searching": false,
            "paging": false,
            "autoWidth": false,
            "ordering": false,
            "responsive": false
        });
        let counter = 0;
        $('#add_button').click(function (e) {
            e.preventDefault();
            table2.row.add([
                `<button type="button" class="btn btn-danger removerow">
                          <i class="fas fa-minus"></i>
                      </button>`,
                `<input name="foc_quantity[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<input name="foc_discount[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<input name="reward_points[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<select name="is_activated[${counter}]" class="form-control text-center"><option value="1">Yes</option><option value="0">No</option></select>`,
                ``,
            ]).draw(false);
            counter++;
        });
    </script>

@endsection