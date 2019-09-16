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
        .hidden{
        display:none;
        }
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

        let active_scroll_chat = $('.chat-overflow');
        
        $(document).on('click', 'li.person', function () {
            let current_element = $(this);
            let to_user_id = current_element.attr('data-user-id');
            let from_user_id = '{{auth()->user()->id}}';

            $('input[name="to_user_id"]').val(to_user_id);

            if (current_element.hasClass('unread')) {
                current_element.removeClass('unread');
            }
            $('#name').text(current_element.attr('data-username'));
            current_element.addClass('active').siblings().removeClass('active');
            $('#name').attr('href',current_element.attr('data-user-url'));
            getChatMessages(from_user_id, to_user_id);
            active_scroll_chat.scrollTop($(".chat-overflow")[0].scrollHeight);
        });

        function getChatMessages(from_user_id, to_user_id) {
            $.ajax({
                url: '{{route('getChatMessages')}}',
                method: 'get',
                data: {
                    _token: '{{csrf_token()}}',
                    from_user_id: from_user_id,
                    to_user_id: to_user_id,
                },
                success: function (response) {
                    if (response.status) {
                        let chat_content = $('.chat-overflow');
                        chat_content.empty();
                        $.each(response.data.chat.messages, function (index, message) {
                            chat_content.append(`
                                <div class="bubble ${message.from_user_id == from_user_id ? 'you' : 'me'}">
                                    ${message.message}
                                </div>
                                `);
                        });
                        return true;
                    }

                }
            });
        }
        
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

            let active_scroll_chat = $('.chat-overflow');
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
                    if (response.status) {
                        active_scroll_chat.append(`
                            <div class="bubble you">
                                ${message}
                            </div>
                        `);
                        $('li.person.active > .preview').text(message);
                        $('li.person.active > .time').text("Now");
                        // $('.chat.active-chat > .chat-overflow').scrollTop($(".chat.active-chat > .chat-overflow")[0].scrollHeight);
                        return true;
                    }

                    let errors = response.data.validation_errors;
                    if (errors.to_user_id) {
                        globalAddNotify(errors.to_user_id[0], 'danger')
                    }
                    if (errors.message) {
                        globalAddNotify(errors.message[0], 'danger')
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
        @if(app('request')->get('chat_id'))

            $('#chat_{{app('request')->get('chat_id')}}').trigger('click');
             

        @endif

    </script>
    
    <script>
        // $(".selectpicker").selectpicker();
    </script>
@endsection