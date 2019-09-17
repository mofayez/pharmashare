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
        @include("pages.setting.createPoints.templates.top_header")
        @include("pages.setting.createPoints.templates.center_content")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
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
        let counter = {{count($foces ?? [])}};
        $('#add_button').click(function (e) {
            e.preventDefault();
            table2.row.add([
                `<button type="button" class="btn btn-danger removerow">
                          <i class="fas fa-minus"></i>
                      </button>`,
                `<input name="foc_on[${counter}]" class="form-control text-center" type="hidden" value="all">
                <input name="foc_quantity[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<input name="foc_discount[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<input name="reward_points[${counter}]" class="form-control text-center" type="number" value="0">`,
                `<select name="is_activated[${counter}]" class="form-control text-center"><option value="1">Yes</option><option value="0">No</option></select>`,
                ``,
            ]).draw(false);
            counter++;
        });
        table2.on('click', '.removerow', function (e) {
            e.preventDefault();
            let tr = $(this).parent().parent();
            table2.row(tr).remove().draw();
        });
    </script>
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

        });


        @if(session()->has('success'))
        globalAddNotify('{{session()->get('success')}}', 'success');
        @endif

        @if(session()->has('error'))
        globalAddNotify('{{session()->get('error')}}', 'danger');
        @endif
    </script>
@endsection