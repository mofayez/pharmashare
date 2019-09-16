@extends("layouts.master")
@section("styles")
    <link href='https://fonts.googleapis.com/css?family=PT+Sans&subset=latin' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    {{Html::style('assets/css/iziToast.min.css')}}
    @if(app()->getLocale() == "ar")
        {{Html::style('assets/css/chat-ar.css')}}
    @else
        {{Html::style('assets/css/chat-en.css')}}
    @endif
    <style>
        .send {
            background: transparent;
            border: 0;
            height: 40px;
            bottom: 0px;
            position: relative;
            cursor: pointer;
        }

        .send:focus {
            outline: 0;
        }
    </style>
@endsection

@section("body")

    <body class="profile-page">
    @if($user->role_id == 4)
        @include("includes.navbar_alt")
    @else
        @include("includes.navbar")
    @endif


    <div class="wrapper">
        @include("pages.chat.templates.top_header")
        @include("pages.chat.templates.center_content")
        @include("pages.chat.templates.all_users_modal")
    </div>

    </body>

@endsection

@section("scripts")

    {{Html::script('public/js/chat.js')}}
    {{Html::script("assets/js/emojionearea.min.js")}}
    {{Html::script("assets/js/iziToast.min.js")}}
    <script>

        @foreach($chat_history as $history)
        @if($loop->first)
        document.querySelector('.chat[data-chat=person{{$history['withUser']->id}}]').classList.add('active-chat');
        document.querySelector('.person[data-chat=person{{$history['withUser']->id}}]').classList.add('active');
        $('#ChatSendMessageForm > input[name="to_user_id"]').val("{{$history['withUser']->id}}");
        @endif
        @endforeach

        $(document).on('mousedown', 'li.person', function () {
            let person = $(this);
            let user_id = person.attr('data-user-id');
            person.addClass('active').siblings().removeClass('active');
            $('div.chat').removeClass('active-chat');
            $(`div.chat[data-chat="person${user_id}"]`).addClass('active-chat');
            console.log(person.find('span.name').text())
            $('div.top').find('span.name').text(person.find('span.name').text());
            $('#ChatSendMessageForm > input[name="to_user_id"]').val(user_id);
            $('#empty_chat').remove();
            $('.chat.active-chat > .chat-overflow').scrollTop($(".chat.active-chat > .chat-overflow")[0].scrollHeight);
        });

    </script>


    <script>
        $('#compose_message').submit(function (e) {

            e.preventDefault();
            let form_array = $(this).serializeArray();
            let from_user = null;
            let to_user = null;
            let message = null;
            $.each(form_array, function (index, input) {
                if (input.name === "from_user_id") from_user = input.value;
                if (input.name === "to_user_id") to_user = input.value;
                if (input.name === "message") message = input.value;

            });
            if (message == null) {
                return false;
            }

            let active_scroll_chat = $('.chat.active-chat > .chat-overflow');
            $.ajax({
                method: 'post',
                url: '{{route('chatPostSendMessage')}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'from_user_id': from_user,
                    'to_user_id': to_user,
                    'message': message,
                },
                success: function (response) {
                    console.log(response);
                    if (response.status) {
                        location.reload();
                        active_scroll_chat.append(`
                            <div class="bubble me">
                                ${message}
                            </div>
                        `);
                        $('li.person.active > .preview').text(message);
                        $('li.person.active > .time').text("Now");
                    }
                },
                error: function (errors) {

                },
            });
        });
        $('#ChatSendMessageForm').submit(function (e) {
            e.preventDefault();
            let form_array = $(this).serializeArray();
            let from_user = null;
            let to_user = null;
            let message = null;
            $.each(form_array, function (index, input) {
                if (input.name === "from_user_id") from_user = input.value;
                if (input.name === "to_user_id") to_user = input.value;
                if (input.name === "message") message = input.value;

            });
            if ($('input[name="message"]').val() == null) {
                return false;
            }

            let active_scroll_chat = $('.chat.active-chat > .chat-overflow');
            $.ajax({
                method: 'post',
                url: '{{route('chatPostSendMessage')}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'from_user_id': from_user,
                    'to_user_id': to_user,
                    'message': message,
                },
                success: function (response) {
                    console.log(response);
                    if (response.status) {
                        active_scroll_chat.append(`
                            <div class="bubble me">
                                ${message}
                            </div>
                        `);
                        $('li.person.active > .preview').text(message);
                        $('li.person.active > .time').text("Now");
                        // $('.chat.active-chat > .chat-overflow').scrollTop($(".chat.active-chat > .chat-overflow")[0].scrollHeight);

                    }
                },
                error: function (errors) {

                },
            });

            active_scroll_chat.scrollTop(active_scroll_chat[0].scrollHeight);
            $('input[name="message"]').val('');
        });

        @if(app('request')->get('user_id'))

        $('#comp_msg').trigger('click');
        $('select[name="to_user_id"]').val({{app('request')->get('user_id')}});

        @endif

    </script>

@endsection