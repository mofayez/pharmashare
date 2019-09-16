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
        @include("pages.setting.getAllComplaints.templates.top_header")
        @include("pages.setting.getAllComplaints.templates.center_content")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    <script>

        $(document).ready(function () {
            $('.loading-overlay').fadeOut();

        });

        function deleteComplaint(id) {
            swal({
                text: '{{__('profile.are_you_sure')}}',
                title: "{{__('profile.warning')}} ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                confirmButtonText: "{{__('profile.yes')}}",
                cancelButtonText: "{{__('profile.no')}}"
            }).then((result) => {
                if (result) {
                    $.ajax({
                        method: 'post',
                        url: '{{route('deleteContactUs')}}',
                        data: {
                            _token: '{{csrf_token()}}',
                            id: id,
                        },
                        success: function (resposne) {
                            if (resposne.status) {
                                location.reload();
                            }
                        }
                    })
                }
            });

        }

        @if(session()->has('success'))
        globalAddNotify('{{session()->get('success')}}', 'success');
        @endif

        @if(session()->has('error'))
        globalAddNotify('{{session()->get('error')}}', 'danger');
        @endif
    </script>
@endsection