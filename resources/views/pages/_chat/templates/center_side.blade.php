<div class="wrappers">
    <div class="containers bg-white">
        <div class="left">
            <div class="top">
                <form action="" id="form_search">
                    <input type="text" placeholder="Search" name="query" autocomplete="off">
                    <a onclick="$('#form_search').submit()[0]" href="javascript:;" class="search">
                        <i class="fas fa-search mt-3 fa-lg"></i>
                    </a>
                </form>
            </div>
            <ul class="people list-unstyled">
                @foreach($chat_history as $history)
                    <li class="person" data-chat="person{{$history['withUser']->id}}"
                        data-user-id="{{$history['withUser']->id}}">
                        <img src="{{$history['withUser']->image_path ?? asset('assets/img/user_avatar.jpg')}}" alt=""/>
                        <span class="name text-capitalize">{{$history['withUser']->firstname . " " . $history['withUser']->lastname}}</span>
                        <span class="time">{{$history['lastMessages']->created_at->diffForHumans()}}</span>
                        <div class="preview">{{$history['lastMessages']->message}}</div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="right">
            <div class="top">
                <span>To: <span
                            class="name">{{$chat_history->first()['withUser']->firstname ?? '' }} {{ $chat_history->first()['withUser']->lastname ?? ''}}</span></span>
            </div>
            @if(count($chat_history) == 0)
                <div id="empty_chat" class="chat active-chat">
                </div>
            @endif
            @foreach($chat_history as $history)
                <div class="chat" data-chat="person{{$history['withUser']->id}}">
                    <div class="chat-overflow">
                        <div class="conversation-start">
                            {{--<span>Today, 6:48 AM</span>--}}
                        </div>
                        @foreach($history['messages'] as $message)
                            <div class="bubble @if($message->from_user_id == $user->id) me @else you @endif">
                                {{$message->message}}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach


            <div class="write" @if(count($chat_history) == 0) style="display: none" @endif>
                <form id="ChatSendMessageForm">
                    <input type="hidden" name="from_user_id" value="{{$user->id}}">
                    <input type="hidden" name="to_user_id" value="">
                    <input type="text" name="message" autocomplete="off"/>
                    <button type="submit" class="send now-ui-icons ui-1_send"
                            style="font:normal normal normal 14px/1 Nucleo Outline!important"></button>
                </form>
            </div>
        </div>
    </div>
</div>