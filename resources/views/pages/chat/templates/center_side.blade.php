<div class="wrappers">
    <div class="containers bg-white">
        <div class="left">
            <div class="top">
                <form action="" id="form_search">
                    <input type="text" placeholder="Search" name="query" autocomplete="off" value="{{app('request')->get('query')}}">
                    <a onclick="$('#form_search').submit()[0]" href="javascript:;" class="search">
                        <i class="fas fa-search mt-3 fa-lg"></i>
                    </a>
                </form>
            </div>
            <ul class="people list-unstyled">
                @foreach($chat_history as $chat)
                    <li class="person @if($chat['lastMessageFromHim']) {{$chat['lastMessageFromHim'] ? $chat['lastMessageFromHim']->read_at ? '' : 'unread': ''}} @endif"
                        data-chat="person @if($chat['withUser']) {{$chat['withUser']->id}} @endif"
                        data-username=" @if($chat['withUser']) {{$chat['withUser']->firstname . ' ' . $chat['withUser']->lastname}}  @endif"
                        data-user-id=" @if($chat['withUser']) {{$chat['withUser']->id}} @endif"
                        data-user-url="@if($chat['withUser']){{route('getUserProfileView',['username'=>'@'.$chat['withUser']->username , 'id'=>$chat['withUser']->id])}} @endif"
                        id=" @if($chat['withUser']) chat_{{$chat['withUser']->id}} @endif">
                        <img src=" @if($chat['withUser']) {{ $chat['withUser']->image_path ?? asset('assets/img/user_avatar.jpg')}} @endif" alt=""/>
                        <div class="name text-capitalize"> 
                            @if($chat['withUser']) 
                                {{$chat['withUser']->firstname . ' ' . $chat['withUser']->lastname}} <br>
                                <div class="badge badge-primary" style="font-size:8px">{{$chat['withUser']->role->title ?? ''}}</div> 
                            @endif
                        </div>
                        <span class="time" style="font-size:12px">{{$chat['lastMessages']->created_at->diffForHumans()}}</span>
                        <div class="preview">{{$chat['lastMessages']->message}}</div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="right">
            <div class="top">
                <span> {{app()->getLocale() == 'ar' ? 'الي': 'To'}}
                    <a id="name" class="name" href=""> </a>
                </span>
            </div>
            <div class="chat active-chat" data-chat="person1" style="padding-top: 15px;">
                <div class="chat-overflow">
                    <div class="conversation-start">
                        {{--<span>Today, 6:48 AM</span>--}}
                    </div>

                </div>
            </div>

            {{--style="display: none"--}}
            <div class="write">
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