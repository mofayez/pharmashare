@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>


    {{Html::style('assets/css/iziToast.min.css')}}
    {{Html::style('assets/css/multiple-select.css')}}
    <style>
        .section {
            padding: 10px 0;
        }
    </style>
    <style>
        .my-group select {
            height: auto !important;
            max-width: 25% !important;
        }

        .my-group .btn-main {
            height: auto !important;
            min-width: 15% !important;
        }

        .form-check {
            margin-top: -17px;
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
        @include("pages.admin.all-products.templates.top_header")
        @include("pages.admin.all-products.templates.center_content")
        @include("pages.admin.all-products.templates.select_show_modal")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    {{Html::script("assets/js/multiple-select.js")}}
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();
        });

        function gonext() {
            $('.loading-overlay').show();
            setTimeout(() => {
                location.href = "{{route('getShippingView')}}";
                $('.loading-overlay').fadeOut();
            }, 1000);
        }

        function printreport(e) {
            e.preventDefault();
            window.open("{{route('getSalesReportView')}}", "Report", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1200, height=500, top=" + (screen.height - 100) + ", left=" + (screen.width / 2));
        }

        function payment() {
            swal({
                title: '{{__('settings.warning')}}',
                text: '{{__('settings.are_you_sure')}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '{{__('settings.yes')}}',
                cancelButtonText: '{{__('settings.no')}}',
            }).then((result) => {
                if (result.value) {
                    swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }

        $('#datarange').flatpickr({
            // defaultDate: ['2018-10-29', '2018-10-16'],
            mode: 'range',
            dateFormat: 'Y-m-d',
            onChange: function (selectedDates, dateStr, instance) {

            }, onClose: function (selectedDates, dateStr, instance) {

            },
        });
    </script>
    <script>
        $(function () {
            $('.multiselect').change(function () {
                console.log($(this).val());
            }).multipleSelect({
                width: '100%'
            });
        });

        function removeItem(id) {
            swal({
                title: '{{__('settings.warning')}}',
                text: '{{__('settings.are_you_sure')}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '{{__('settings.yes')}}',
                cancelButtonText: '{{__('settings.no')}}',
            }).then((result) => {
                console.log(result)
                if (result) {
                    $.ajax({
                        method: 'delete',
                        url: '{{route('deleteAdminProduct')}}',
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id
                        },
                        success: function (response) {
                            console.log(response)
                            if (response.status) {
                                location.reload();
                            }
                        }
                    })
                }
            })
        }

        function approve(id) {
            swal({
                title: '{{__('settings.warning')}}',
                text: '{{__('settings.are_you_sure')}}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: '{{__('settings.yes')}}',
                cancelButtonText: '{{__('settings.no')}}',
            }).then((result) => {
                if (result) {
                    $.ajax({
                        method: 'POST',
                        url: '{{route('postApproveDrug')}}',
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id
                        },
                        success: function (response) {
                            console.log(response)
                            if (response.status) {
                                location.reload();
                            }
                        }
                    })
                }
            })
        }
    </script>
@endsection