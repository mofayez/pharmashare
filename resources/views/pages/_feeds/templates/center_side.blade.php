<style>
.nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
    background-color: #722ec2;
}
</style>

<div class="row">
    <div id="compose" class="col-md-12">
        <div class="card card-plain ">
            <div class="media media-post  card-body direction bg-white">
                <a class="pull-left author" href="#">
                    <div class="avatar">
                        <img class="media-object img-raised" alt="64x64"
                             style="width:50px;border-radius:50%" src="{{$user->image_path ?? asset("assets/img/user_avatar.jpg")}}">
                    </div>
                </a>
                <div class="media-body direction">
                    {{Form::open([
                        'method'=>'post',
                        'route'=>'addNewGroupPosts',
                        'id'=>'compose_post_form',
                        'enctype'=>'multipart/form-data'
                    ])}}
                    <textarea class="mb-0 mention form-control bg-transparent" name="post" placeholder="{{__('profile.post_here')}}"
                              rows="5"></textarea>
                    <div id="compose_post_error" class="text-danger text-left" style="font-size: 12px"></div>
                    <input type="file" class="d-none" id="compose_post_file" name="files[]" multiple>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left btn-group" style="display:inline-block">
                                <button type="button" class="btn btn-default bg-light btn-round text-dark pl-5">
                                    <div class="btn-post-compose"></div>
                                    <span>{{__('profile.compose')}}</span>
                                </button>
                                <button id="add_attachment" type="button"
                                        class="btn btn-default bg-light btn-round text-dark pl-5">
                                    <div class="btn-post-photo"></div>
                                    <span>{{__('profile.photos')}}</span>
                                </button>
                                <button id="add_emotions" type="button"
                                        class="btn btn-default bg-light btn-round text-dark pl-5">
                                    <div class="btn-post-emo"></div>
                                    <span>{{__('profile.emo')}}</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 direction" style="display: none" id="prgs">
                            <div class="progress-container text-left progress-info">
                                <span class="progress-badge">LOADING</span>
                                <div class="progress">
                                    <div id="progress" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                        <span id="percentage" class="progress-value">0%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <div class="row" id="image_preview">
                        </div>
                        <button type="submit" class="btn btn-main"  id="post-compose-btn">
                            <i class="now-ui-icons ui-1_send"></i> {{__('profile.add_post')}}
                        </button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
            <div class="text-center">
                <ul class="nav nav-pills nav-pills-primary mt-2" role="tablist">
    				<li class="nav-item">
    					<a class="nav-link {{!app('request')->post_type ? 'active show': ''}}" href="{{route('getGroupPosts')}}" role="tablist">
    						{{__('profile.all_feeds')}}
    					</a>
    				</li>
    				<li class="nav-item">
    					<a class="nav-link {{app('request')->post_type == 'text' ? 'active show': ''}}" href="{{route('getGroupPosts')}}?post_type=text" role="tablist">
    						{{__('profile.only_text')}}
    					</a>
    				</li>
    				<li class="nav-item">
    					<a class="nav-link {{app('request')->post_type == 'image' ? 'active show': ''}}"  href="{{route('getGroupPosts')}}?post_type=image" role="tablist">
    						{{__('profile.only_images')}}
    					</a>
    				</li>
    				<li class="nav-item">
    					<a class="nav-link {{app('request')->post_type == 'mine' ? 'active show': ''}}"  href="{{route('getGroupPosts')}}?post_type=mine" role="tablist">
    						{{__('profile.only_mine')}}
    					</a>
    				</li>
    			</ul>
            </div>
        </div>
    </div>
</div>
{{----}}
<div>
    <div class='post-load'>
        <div class='panel-effect'>
            <div class='fake-effect fe-0'></div>
            <div class='fake-effect fe-1'></div>
            <div class='fake-effect fe-2'></div>
            <div class='fake-effect fe-3'></div>
            <div class='fake-effect fe-4'></div>
            <div class='fake-effect fe-5'></div>
            <div class='fake-effect fe-6'></div>
            <div class='fake-effect fe-7'></div>
            <div class='fake-effect fe-8'></div>
            <div class='fake-effect fe-9'></div>
            <div class='fake-effect fe-10'></div>
            <div class='fake-effect fe-11'></div>
        </div>
    </div>
</div>
<div id="posts-div" style="display: none">
    @include("pages.feeds.templates.post_types")
</div>