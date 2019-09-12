<style>
    .left-menu{
        right: -5px!important;
        left: auto!important;
    }
</style>
<div class="row infinite-scroll">
    @foreach($posts as $k => $post)
    {{--post--}}
    <div id="post_{{$post->id}}" class="col-md-12">
        <div class="card card-plain bg-white card-body" style="box-shadow: 1px 2px 15px #aaa">
            <div class="row">
                {{--user avatar--}}
                <div class="col-2 p-xs-0">
                    <div class="card-avatar">
                        <a href="{{route('getUserProfileView',['username'=>'@'.$post->user->username , 'id'=>$post->user->id])}}">
                            <img class="img img-raised" width="100%" height="70"
                                 src="{{$post->user->image_path ?? asset("assets/img/user_avatar.jpg") }}">
                        </a>
                        <div class="ripple-container"></div>
                    </div>
                </div>
                {{--user info--}}
                <div class="col-8">
                    <h4 class="card-title mt-0 text-left text-capitalize">
                        <a href="{{route('getUserProfileView',['username'=>'@'.$post->user->username , 'id'=>$post->user->id])}}">
                            {{$post->user->firstname .' '.$post->user->lastname}}
                        </a>
                        @if($post->user->role_id == 1)
                        <div class="btn-post-compose position-relative" style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -2230px;"></div>
                        @endif
                        <small class="post-time" title="{{$post->updated_at}}">{{$post->posted_at}}</small>
                    </h4>
                </div>
                {{--more options--}}
                @if($post->user_id == $user->id || $user->role_id == 1)
                <div class="col-2">
                    <div class="dropdown direction">
                        <a href="#" class="bg-transparent btn-round text-dark" data-toggle="dropdown"
                           aria-haspopup="false" aria-expanded="false">
                            <i class="fas fa-ellipsis-h fa-1x"></i>
                        </a>
                        <div class="dropdown-menu {{app()->getLocale() == 'en' ? 'left-menu' :''}}" data-placement="{{app()->getLocale() == 'ar' ? 'right' : 'left'}}">
                            <a class="dropdown-item" style="cursor:pointer"
                               onclick="deletePost('{{$post->id}}')">{{__('profile.delete_post')}}</a>
                        </div>
                    </div>
                </div>
                @endif
                {{--post content--}}
                <div class="col-md-12">
                    <div class="description">
                        <p class="post-head-text text-left">
                            {{$post->post}}
                        </p>
                        <div class="card card-blog card-plain">
                            <div class="card-image">
                                <div class="row">
                                    @foreach($post->files as $file)

                                    @if($loop->iteration == 4)
                                    @break
                                    @endif

                                    @if($post->fileCount == 1)
                                    @if($loop->iteration == 1)
                                    <div class="col-12 p-2">
                                        @endif
                                        @endif
                                        @if($post->fileCount == 2)
                                        @if($loop->iteration == 1 || $loop->iteration == 2)
                                        <div class="col-6 p-2">
                                            @endif
                                            @endif
                                            @if($post->fileCount == 3)
                                            @if($loop->iteration == 1)
                                            <div class="col-12 p-2">
                                                @endif
                                                @if($loop->iteration == 2 || $loop->iteration == 3)
                                                <div class="col-6 p-2">
                                                    @endif
                                                    @endif
                                                    @if($post->fileCount > 3)
                                                    @if($loop->iteration == 1)
                                                    <div class="col-12 p-2">
                                                        @endif
                                                        @if($loop->iteration == 2)
                                                        <div class="col-6 p-2">
                                                            @endif
                                                            @if($loop->iteration == 3)
                                                            <div class="col-6 p-2">
                                                                <div class="post-image-more direction"
                                                                     onclick="postImagesPreview('{{$post->id}}')">
                                                                    <div class="info">
                                                                        <h1>{{$post->fileCount - 3}}+</h1>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                @endif
                                                                @if($file['file_type'] == 'image')
                                                                <div onclick="postImagesPreview('{{$post->id}}')">
                                                                    <img class="img rounded img-raised" style="min-height: 200px"
                                                                         src="{{$file['name']}}">
                                                                </div>
                                                                @endif
                                                                @if($file['file_type'] != 'image' && $file['file_type'] != 'video')
                                                                <div class="text-center col-md-12">
                                                                    <a href="{{$file['name']}}" target="_blank" download>
                                                                        <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                        <b>
                                                                            {{app()->getLocale() == 'ar' ? 'اضغط هنا لتحميل الملف': 'Click Here To Download File'}}
                                                                        </b><br/>                                                                                
                                                                    </a>
                                                                </div>
                                                                @endif
                                                                @if($file['file_type'] == 'video')
                                                                <div class="videoContainer">
                                                                    <div class="video">
                                                                        <video controls>
                                                                            <source src="{{$file['name']}}"></source>
                                                                        </video>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--post feedback--}}
                                        <div class="col-md-12">
                                            <div class="float-left" onclick="likesModal('{{$post->id}}')" style="cursor: pointer">
                                                <i class="fas fa-heart text-danger"></i>
                                                <b class="post_likes">{{count($post->likes)}}</b> {{__('profile.like')}}
                                                <br>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="media like_avatars">
                                                @foreach($post->likes->sortByDesc("updated_at")->take(2) as $like)
                                                <a href="{{route('getUserProfileView',['username'=>'@'.$like->user->username , 'id'=>$like->user->id])}}" class="avatar m-0" style="display:inline-flex;width: 45px;height: 45px"
                                                   data-original-title="{{$like->user->firstname . ' ' . $like->user->lastname}}"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="" data-container="body" data-animation="true">
                                                    <img src="{{$like->user->image_path ?? asset("assets/img/user_avatar.jpg")}}"
                                                    class="media-object img-raised"
                                                    style="width: 40px;height: 40px;border-radius: 50%" alt="">
                                                </a>
                                                @endforeach
                                                @if(count($post->likes) >= 3)
                                                <div class="avatar m-0" data-toggle="modal" data-target="#likes-modal-sm"
                                                     onclick="likesModal('{{$post->id}}')"
                                                     style="cursor:pointer;display:inline-flex;width: 45px;height: 45px"
                                                     data-original-title="more"
                                                     data-toggle="tooltip" data-placement="top"
                                                     title="" data-container="body" data-animation="true">
                                                    <img src="{{asset("assets/img/more.png")}}"
                                                    class="media-object img-raised"
                                                    style="width: 40px;height: 40px;border-radius: 50%" alt="">
                                                </div>
                                                @endif
                                            </div>
                                            <hr>
                                        </div>
                                        {{--reactions--}}
                                        <div class="col-md-12">
                                            <div class="bar-actionsbox">

                                                <a data-post-id="{{$post->id}}"
                                                   class="action-item like-button @if($post->likes->where('user_id',$user->id)->first()) liked @endif">
                                                  <span class='like-icon'>
                                                    <div class='heart-animation-1'></div>
                                                    <div class='heart-animation-2'></div>
                                                  </span>
                                                    &nbsp;
                                                    {{__('profile.like')}}
                                                </a>

                                                <a class="action-item">
                                                    <i class="fas fa-comment"></i>
                                                    &nbsp;
                                                    {{__('profile.comment')}}
                                                </a>

                                                {{--<a class="action-item">--}}
                                                    {{--<i class="fas fa-share"></i>--}}
                                                    {{--&nbsp;--}}
                                                    {{--{{__('profile.share')}}--}}
                                                    {{--</a>--}}
                                            </div>
                                            <hr style="margin-top: 10px">
                                        </div>
                                        {{--comment--}}
                                        <div class="col-md-12">
                                            {{Form::open([
                                            'method'=>'post',
                                            'route'=>'addPostComment',
                                            'class'=>'add_comment_form'
                                            ])}}
                                            <div class="position-absolute comment-send-btn">
                                                <button type="submit" class="btn btn-main btn-sm btn-round btn-icon">
                                                    <i class="now-ui-icons ui-1_send"></i>
                                                </button>
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user-circle"></i>
                                </span>
                                                </div>
                                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                                <input type="text" name="comment" class="form-control"
                                                       autocomplete="off" placeholder="{{__('profile.comment_here')}}">
                                            </div>
                                            {{Form::close()}}
                                        </div>
                                        {{--comments--}}
                                        <div class="col-md-12">
                                            {{--<div class="text-left">--}}
                                                {{--<img style="width: 35px;height: 30px;display: inline-block"--}}
                                                         {{--class="img-responsive" src="assets/img/imessage-typing.gif" alt="">--}}
                                                {{--<p style="font-size: 10px;display: inline-block;color: #777">--}}
                                                    {{--{{__('profile.someone_typing')}}--}}
                                                    {{--</p>--}}
                                                {{--</div>--}}
                                            <div class="post-comments-view">

                                                @if(count($post->comments) > 2)
                                                <div id="accordion_{{$post->id}}" role="tablist" aria-multiselectable="true"
                                                     class="card-collapse">
                                                    <div class="card card-plain m-0 mb-3">
                                                        <div class="card-header" role="tab" id="headingOne">
                                                            <a data-toggle="collapse" data-parent="#accordion"
                                                               href="#collapse_{{$post->id}}"
                                                               aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                                                {{__('profile.show_comments')}}

                                                                <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                            </a>
                                                        </div>

                                                        <div id="collapse_{{$post->id}}" class="collapse" role="tabpanel"
                                                             aria-labelledby="headingOne"
                                                             style="">
                                                            <div class="card-body p-2">

                                                                @foreach($post->comments as $comment)
                                                                @if($loop->iteration == (count($post->comments) - 1))
                                                                @continue
                                                                @endif
                                                                @if($loop->iteration == count($post->comments))
                                                                @continue
                                                                @endif
                                                                <div id="comment_{{$comment->id}}" class="media-area">

                                                                    <div class="media">
                                                                        <a class="float-left" href="{{route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])}}">
                                                                            <div class="avatar">
                                                                                <img class="media-object img-raised"
                                                                                     style="width: 50px"
                                                                                     src="{{$comment->user->image_path ?? asset("assets/img/user_avatar.jpg")}}"
                                                                                alt="...">
                                                                            </div>
                                                                        </a>
                                                                        <div class="media-body">
                                                                            @if($user->id == $comment->user->id || $user->role_id == 1)
                                                                            <div class="float-right">
                                                                                <div class="dropdown">
                                                                                    <a href="#"
                                                                                       class="bg-transparent btn-round text-dark"
                                                                                       data-toggle="dropdown"
                                                                                       aria-haspopup="false"
                                                                                       aria-expanded="false">
                                                                                        <i class="fas fa-ellipsis-h fa-1x"></i>
                                                                                    </a>
                                                                                    <div class="dropdown-menu"
                                                                                         data-placement="left">
                                                                                        <a class="dropdown-item" style="cursor:pointer"
                                                                                           onclick="deleteComment('{{$comment->id}}')">{{__('profile.delete_comment')}}</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                            <h6 class="media-heading text-left mb-0 text-capitalize">
                                                                                <a href="{{route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])}}">
                                                                                    {{$comment->user->firstname .' '. $comment->user->lastname}}
                                                                                </a>
                                                                                <small style="font-size: 10px;"
                                                                                       class="text-muted">{{$comment->posted_at}}</small>
                                                                            </h6>

                                                                            <div>
                                                                                <p class="text-left post-text-comment mt-1 p-2">
                                                                                    {!! $comment->comment !!}
                                                                                </p>
                                                                                @if(!$loop->last)
                                                                                {{--<hr>--}}
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @php
                                                $last_2_comments = $post->comments->sortByDesc('id')->take(2);
                                                @endphp
                                                @foreach($last_2_comments->sortBy('id') as $comment)
                                                <div id="comment_{{$comment->id}}" class="media-area">
                                                    <div class="media">
                                                        <a class="float-left" href="{{route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])}}">
                                                            <div class="avatar">
                                                                <img class="media-object img-raised" style="width: 50px"
                                                                     src="{{$comment->user->image_path ?? asset("assets/img/user_avatar.jpg")}}"
                                                                alt="...">
                                                            </div>
                                                        </a>
                                                        <div class="media-body">
                                                            @if($user->id == $comment->user->id || $user->role_id == 1)
                                                            <div class="float-right">
                                                                <div class="dropdown direction">
                                                                    <a href="#" class="bg-transparent btn-round text-dark"
                                                                       data-toggle="dropdown"
                                                                       aria-haspopup="false" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-h fa-1x"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu" data-placement="right">
                                                                        <a class="dropdown-item" style="cursor:pointer"
                                                                           onclick="deleteComment('{{$comment->id}}')">{{__('profile.delete_comment')}}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <h6 class="media-heading text-left mb-0 text-capitalize">
                                                                <a href="{{route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])}}" >
                                                                    {{$comment->user->firstname .' '. $comment->user->lastname}}
                                                                </a>
                                                                <small style="font-size: 10px;"
                                                                       class="text-muted">{{$comment->commented_at}}</small>
                                                            </h6>

                                                            <div>
                                                                <p class="text-left post-text-comment mt-1 p-2">
                                                                    {!! $comment->comment !!}
                                                                </p>
                                                                @if(!$loop->last)
                                                                {{--<hr>--}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(in_array('feeds',(array)$allowed_ads))
                            @isset($second_ratio[$k])
                            @if($second_ratio[$k]['scaled_image'])
                            <div class="col-md-12 mb-2">
                                <div style="position: absolute;z-index: 9;width: 30%;top: -20px;right: 0;">
                                    <img src="{{asset('assets/img/cron.png')}}" alt="">
                                    <h3 class="" style="position: absolute;top: 25px;right:20%;color: #FFF">
                                        {{__('profile.ads')}}
                                    </h3>
                                </div>
                                <a href="{{$second_ratio[$k]['link'] ?? '#'}}" target="_blank">
                                    <img src="{{$second_ratio[$k]['third_image']}}" alt="">
                                </a>
                            </div>
                            @endif
                            @endisset
                            @endif
                            {{----}}
                            @endforeach
                            @if($paginate)
                            {{$posts->links() ?? ''}}
                            @endif
                        </div>