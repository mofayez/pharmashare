<style>
.jscroll-inner{
    max-width:100%!important;
}
    .left-menu {
        right: -5px !important;
        left: auto !important;
    }
    .link-overflow{ 
        text-overflow: ellipsis;
        overflow: hidden;
        max-width: 550px;
        white-space: nowrap;   
    }@media  only screen and (max-width: 600px) {
       .link-overflow{ 
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: 300px;
            white-space: nowrap;   
        }
    }
</style>
<div class="row infinite-scroll">
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <div id="post_<?php echo e($post->id); ?>" class="col-md-12">
            <div class="card card-plain bg-white card-body" style="box-shadow: 1px 2px 15px #aaa">
                <div class="row">
                    
                    <div class="col-2 p-xs-0">
                        <div class="card-avatar">
                            <a href="<?php echo e(route('getUserProfileView',['username'=>'@'.$post->user->username , 'id'=>$post->user->id])); ?>">
                                <img class="img img-raised" width="100%" height="70"
                                     src="<?php echo e($post->user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>">
                            </a>
                            <div class="ripple-container"></div>
                        </div>
                    </div>
                    
                    <div class="col-8">
                        <h4 class="card-title mt-0 text-left text-capitalize">
                            <a href="<?php echo e(route('getUserProfileView',['username'=>'@'.$post->user->username , 'id'=>$post->user->id])); ?>">
                                <?php echo e($post->user->firstname .' '.$post->user->lastname); ?>

                            </a>
                            <?php if($post->user->role_id == 1): ?>
                                <div class="btn-post-compose position-relative"
                                     style="display: inline-block;right: auto;left: auto;top: 5px;background-position: 0px -2230px;"></div>
                            <?php endif; ?>
                            <br/>
                            <span class="badge badge-default" style="font-size:10px"><?php echo e($post->user->role->title ?? ''); ?></span>
                            <br/>
                            <small class="post-time" title="<?php echo e($post->updated_at); ?>"><?php echo e($post->posted_at); ?></small>
                        </h4>
                    </div>
                    
                    <?php if($post->user_id == $user->id || $user->role_id == 1): ?>
                        <div class="col-2">
                            <div class="dropdown direction">
                                <a href="#" class="bg-transparent btn-round text-dark" data-toggle="dropdown"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h fa-1x"></i>
                                </a>
                                <div class="dropdown-menu <?php echo e(app()->getLocale() == 'en' ? 'left-menu' :''); ?>"
                                     data-placement="<?php echo e(app()->getLocale() == 'ar' ? 'right' : 'left'); ?>">
                                    <a class="dropdown-item" style="cursor:pointer"
                                       onclick="deletePost('<?php echo e($post->id); ?>')"><?php echo e(__('profile.delete_post')); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="col-md-12">
                        <div class="description">
                            <p class="post-head-text text-left">
                                <?php echo e($post->post); ?>

                            </p>

                            <?php if($post->post_type == 'link'): ?>
                                <h5 class="text-left link-overflow"> 
                                    <a href="<?php echo e($post->link); ?>" class="text-info" target="_blank">
                                        <?php echo e($post->link); ?>

                                    </a>
                                    <?php


                                        $title = '';
                                        $image = '';
                                        $description = '';

                                    try{
                                        $tags = get_meta_tags($post->link);
                                        $html = file_get_contents($post->link);
                                        $doc = new DOMDocument();
                                        @$doc->loadHTML($html);
                                        $metas = $doc->getElementsByTagName('meta');
                                        $links = $doc->getElementsByTagName('link');

                                        $title = '';
                                        $image = '';
                                        $description = '';
                                        for ($i = 0; $i < $metas->length; $i++)
                                        {
                                            $meta = $metas->item($i);
                                            if ($meta->getAttribute('property') == 'og:image'){
                                                $image = $meta->getAttribute('content');
                                            }
                                            if ($meta->getAttribute('property') == 'og:site_name'){
                                                $title = $meta->getAttribute('content');
                                            }

                                        }
                                        for ($i = 0; $i < $links->length; $i++)
                                        {
                                            $link = $links->item($i);
                                            if ($link->getAttribute('rel') == 'shortcut icon'){
                                                $image = $link->getAttribute('href');
                                            }

                                        }
                                    }catch (Exception $exception){
                                    }
                                    ?> 
                                </h5>
                                <a href="<?php echo e($post->link); ?>" target="_blank">
                                    <div class="row" style="border: 1px solid #d4d4d4;border-radius: 15px;">
                                            <div class="col-2" style="border-right:1px solid #d4d4d4;text-align:center;padding-top:30px;"> 
                                                <?php if($image): ?>
                                                    <img src="<?php echo e($image); ?>" style="width:50%">
                                                <?php else: ?>
                                                    <i class="fa fa-globe fa-4x"></i>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-10 text-left">
                                                <h4><?php echo e($tags['author'] ?? $title ?? ''); ?></h4>
                                                <div class="link-overflow" style="font-size:12px"><?php echo e($post->link); ?></div>
                                                <h5 style="color:#111"><?php echo e($tags['description'] ?? ''); ?></h5>
                                            </div>
                                    </div>
                                </a>
                            <?php endif; ?>
                            <div class="card card-blog card-plain">
                                <div class="card-image">
                                    <div class="row">
                                        <?php $__currentLoopData = $post->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($loop->iteration == 4): ?>
                                                <?php break; ?>
                                            <?php endif; ?>

                                            <?php if($post->fileCount == 1): ?>
                                                <?php if($loop->iteration == 1): ?>
                                                    <div class="col-12 p-2">
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if($post->fileCount == 2): ?>
                                                            <?php if($loop->iteration == 1 || $loop->iteration == 2): ?>
                                                                <div class="col-6 p-2">
                                                                    <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if($post->fileCount == 3): ?>
                                                                        <?php if($loop->iteration == 1): ?>
                                                                            <div class="col-12 p-2">
                                                                                <?php endif; ?>
                                                                                <?php if($loop->iteration == 2 || $loop->iteration == 3): ?>
                                                                                    <div class="col-6 p-2">
                                                                                        <?php endif; ?>
                                                                                        <?php endif; ?>
                                                                                        <?php if($post->fileCount > 3): ?>
                                                                                            <?php if($loop->iteration == 1): ?>
                                                                                                <div class="col-12 p-2">
                                                                                                    <?php endif; ?>
                                                                                                    <?php if($loop->iteration == 2): ?>
                                                                                                        <div class="col-6 p-2">
                                                                                                            <?php endif; ?>
                                                                                                            <?php if($loop->iteration == 3): ?>
                                                                                                                <div class="col-6 p-2">
                                                                                                                    <div class="post-image-more direction"
                                                                                                                         onclick="postImagesPreview('<?php echo e($post->id); ?>')">
                                                                                                                        <div class="info">
                                                                                                                            <h1><?php echo e($post->fileCount - 3); ?>

                                                                                                                                +</h1>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <?php endif; ?>
                                                                                                                    <?php endif; ?>
                                                                                                                    <?php if($file['file_type'] == 'image'): ?>
                                                                                                                        <div onclick="postImagesPreview('<?php echo e($post->id); ?>')">
                                                                                                                            <img class="img rounded img-raised"
                                                                                                                                 style="min-height: 200px"
                                                                                                                                 src="<?php echo e($file['name']); ?>">
                                                                                                                        </div>
                                                                                                                    <?php endif; ?>
                                                                                                                    <?php if($file['file_type'] != 'image' && $file['file_type'] != 'video'): ?>
                                                                                                                        <div class="text-center col-md-12">
                                                                                                                            <a href="<?php echo e($file['name']); ?>"
                                                                                                                               target="_blank"
                                                                                                                               download>
                                                                                                                                <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                                                                                                                                <b>
                                                                                                                                    <?php echo e(app()->getLocale() == 'ar' ? 'اضغط هنا لتحميل الملف': 'Click Here To Download File'); ?>

                                                                                                                                </b><br/>
                                                                                                                            </a>
                                                                                                                        </div>
                                                                                                                    <?php endif; ?>
                                                                                                                    <?php if($file['file_type'] == 'video'): ?>
                                                                                                                        <div class="videoContainer">
                                                                                                                            <div class="video">
                                                                                                                                <video controls>
                                                                                                                                    <source src="<?php echo e($file['name']); ?>"></source>
                                                                                                                                </video>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    <?php endif; ?>
                                                                                                                </div>
                                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                        </div>
                                                                                                </div>
                                                                                    </div>
                                                                            </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12">
                                                                    <div class="float-left"
                                                                         onclick="likesModal('<?php echo e($post->id); ?>')"
                                                                         style="cursor: pointer">
                                                                        <i class="fas fa-heart text-danger"></i>
                                                                        <b class="post_likes"><?php echo e(count($post->likes)); ?></b> <?php echo e(__('profile.like')); ?>

                                                                        <br>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="media like_avatars">
                                                                        <?php $__currentLoopData = $post->likes->sortByDesc("updated_at")->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $like): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <a href="<?php echo e(route('getUserProfileView',['username'=>'@'.$like->user->username , 'id'=>$like->user->id])); ?>"
                                                                               class="avatar m-0"
                                                                               style="display:inline-flex;width: 45px;height: 45px"
                                                                               data-original-title="<?php echo e($like->user->firstname . ' ' . $like->user->lastname); ?>"
                                                                               data-toggle="tooltip"
                                                                               data-placement="top"
                                                                               title="" data-container="body"
                                                                               data-animation="true">
                                                                                <img src="<?php echo e($like->user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>"
                                                                                     class="media-object img-raised"
                                                                                     style="width: 40px;height: 40px;border-radius: 50%"
                                                                                     alt="">
                                                                            </a>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php if(count($post->likes) >= 3): ?>
                                                                            <div class="avatar m-0" data-toggle="modal"
                                                                                 data-target="#likes-modal-sm"
                                                                                 onclick="likesModal('<?php echo e($post->id); ?>')"
                                                                                 style="cursor:pointer;display:inline-flex;width: 45px;height: 45px"
                                                                                 data-original-title="more"
                                                                                 data-toggle="tooltip"
                                                                                 data-placement="top"
                                                                                 title="" data-container="body"
                                                                                 data-animation="true">
                                                                                <img src="<?php echo e(asset("assets/img/more.png")); ?>"
                                                                                     class="media-object img-raised"
                                                                                     style="width: 40px;height: 40px;border-radius: 50%"
                                                                                     alt="">
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                
                                                                <div class="col-md-12">
                                                                    <div class="bar-actionsbox">

                                                                        <a data-post-id="<?php echo e($post->id); ?>"
                                                                           class="action-item like-button <?php if($post->likes->where('user_id',$user->id)->first()): ?> liked <?php endif; ?>">
                                                  <span class='like-icon'>
                                                    <div class='heart-animation-1'></div>
                                                    <div class='heart-animation-2'></div>
                                                  </span>
                                                                            &nbsp;
                                                                            <?php echo e(__('profile.like')); ?>

                                                                        </a>

                                                                        <a class="action-item">
                                                                            <i class="fas fa-comment"></i>
                                                                            &nbsp;
                                                                            <?php echo e(__('profile.comment')); ?>

                                                                        </a>

                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </div>
                                                                    <hr style="margin-top: 10px">
                                                                </div>
                                                                
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-comment')): ?>
                                                                    <div class="col-md-12">
                                                                        <?php echo e(Form::open([
                                                                        'method'=>'post',
                                                                        'route'=>'addPostComment',
                                                                        'class'=>'add_comment_form'
                                                                        ])); ?>

                                                                        <div class="position-absolute comment-send-btn">
                                                                            <button type="submit"
                                                                                    class="btn btn-main btn-sm btn-round btn-icon">
                                                                                <i class="now-ui-icons ui-1_send"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <i class="fa fa-user-circle"></i>
                                                                                </span>
                                                                            </div>
                                                                            <input type="hidden" name="post_id"
                                                                                   value="<?php echo e($post->id); ?>">
                                                                            <input type="text" name="comment"
                                                                                   class="form-control"
                                                                                   autocomplete="off"
                                                                                   placeholder="<?php echo e(__('profile.comment_here')); ?>">
                                                                        </div>
                                                                        <?php echo e(Form::close()); ?>

                                                                    </div>
                                                                <?php endif; ?>
                                                                
                                                                <div class="col-md-12">
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <div class="post-comments-view">

                                                                        <?php if(count($post->comments) > 2): ?>
                                                                            <div id="accordion_<?php echo e($post->id); ?>"
                                                                                 role="tablist"
                                                                                 aria-multiselectable="true"
                                                                                 class="card-collapse">
                                                                                <div class="card card-plain m-0 mb-3">
                                                                                    <div class="card-header" role="tab"
                                                                                         id="headingOne">
                                                                                        <a data-toggle="collapse"
                                                                                           data-parent="#accordion"
                                                                                           href="#collapse_<?php echo e($post->id); ?>"
                                                                                           aria-expanded="false"
                                                                                           aria-controls="collapseOne"
                                                                                           class="collapsed">
                                                                                            <?php echo e(__('profile.show_comments')); ?>


                                                                                            <i class="now-ui-icons arrows-1_minimal-down"></i>
                                                                                        </a>
                                                                                    </div>

                                                                                    <div id="collapse_<?php echo e($post->id); ?>"
                                                                                         class="collapse"
                                                                                         role="tabpanel"
                                                                                         aria-labelledby="headingOne"
                                                                                         style="">
                                                                                        <div class="card-body p-2">

                                                                                            <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <?php if($loop->iteration == (count($post->comments) - 1)): ?>
                                                                                                    <?php continue; ?>
                                                                                                <?php endif; ?>
                                                                                                <?php if($loop->iteration == count($post->comments)): ?>
                                                                                                    <?php continue; ?>
                                                                                                <?php endif; ?>
                                                                                                <div id="comment_<?php echo e($comment->id); ?>"
                                                                                                     class="media-area">

                                                                                                    <div class="media">
                                                                                                        <a class="float-left"
                                                                                                           href="<?php echo e(route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])); ?>">
                                                                                                            <div class="avatar">
                                                                                                                <img class="media-object img-raised"
                                                                                                                     style="width: 50px"
                                                                                                                     src="<?php echo e($comment->user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>"
                                                                                                                     alt="...">
                                                                                                            </div>
                                                                                                        </a>
                                                                                                        <div class="media-body">
                                                                                                            <?php if($user->id == $comment->user->id || $user->role_id == 1): ?>
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
                                                                                                                            <a class="dropdown-item"
                                                                                                                               style="cursor:pointer"
                                                                                                                               onclick="deleteComment('<?php echo e($comment->id); ?>')"><?php echo e(__('profile.delete_comment')); ?></a>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            <?php endif; ?>
                                                                                                            <h6 class="media-heading text-left mb-0 text-capitalize">
                                                                                                                <a href="<?php echo e(route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])); ?>">
                                                                                                                    <?php echo e($comment->user->firstname .' '. $comment->user->lastname); ?>

                                                                                                                </a>
                                                                                                                <small style="font-size: 10px;"
                                                                                                                       class="text-muted"><?php echo e($comment->posted_at); ?></small>
                                                                                                            </h6>

                                                                                                            <div>
                                                                                                                <p class="text-left post-text-comment mt-1 p-2">
                                                                                                                    <?php echo $comment->comment; ?>

                                                                                                                </p>
                                                                                                                <?php if(!$loop->last): ?>
                                                                                                                    
                                                                                                                <?php endif; ?>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <?php
                                                                            $last_2_comments = $post->comments->sortByDesc('id')->take(2);
                                                                        ?>
                                                                        <?php $__currentLoopData = $last_2_comments->sortBy('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div id="comment_<?php echo e($comment->id); ?>"
                                                                                 class="media-area">
                                                                                <div class="media">
                                                                                    <a class="float-left"
                                                                                       href="<?php echo e(route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])); ?>">
                                                                                        <div class="avatar">
                                                                                            <img class="media-object img-raised"
                                                                                                 style="width: 50px"
                                                                                                 src="<?php echo e($comment->user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>"
                                                                                                 alt="...">
                                                                                        </div>
                                                                                    </a>
                                                                                    <div class="media-body">
                                                                                        <?php if($user->id == $comment->user->id || $user->role_id == 1): ?>
                                                                                            <div class="float-right">
                                                                                                <div class="dropdown direction">
                                                                                                    <a href="#"
                                                                                                       class="bg-transparent btn-round text-dark"
                                                                                                       data-toggle="dropdown"
                                                                                                       aria-haspopup="false"
                                                                                                       aria-expanded="false">
                                                                                                        <i class="fas fa-ellipsis-h fa-1x"></i>
                                                                                                    </a>
                                                                                                    <div class="dropdown-menu"
                                                                                                         data-placement="right">
                                                                                                        <a class="dropdown-item"
                                                                                                           style="cursor:pointer"
                                                                                                           onclick="deleteComment('<?php echo e($comment->id); ?>')"><?php echo e(__('profile.delete_comment')); ?></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                        <h6 class="media-heading text-left mb-0 text-capitalize">
                                                                                            <a href="<?php echo e(route('getUserProfileView',['username'=>'@'.$comment->user->username , 'id'=>$comment->user->id])); ?>">
                                                                                                <?php echo e($comment->user->firstname .' '. $comment->user->lastname); ?>

                                                                                            </a>
                                                                                            <small style="font-size: 10px;"
                                                                                                   class="text-muted"><?php echo e($comment->commented_at); ?></small>
                                                                                        </h6>

                                                                                        <div>
                                                                                            <p class="text-left post-text-comment mt-1 p-2">
                                                                                                <?php echo $comment->comment; ?>

                                                                                            </p>
                                                                                            <?php if(!$loop->last): ?>
                                                                                                
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </div>
                                                                </div>
                                                    </div>
                                    </div>
                                </div>

                                <?php if(in_array('feeds',(array)$allowed_ads)): ?>
                                    <?php if(isset($second_ratio[$k])): ?>
                                        <?php if($second_ratio[$k]['scaled_image']): ?>
                                            <div class="col-md-12 mb-2">
                                                <div style="position: absolute;z-index: 9;width: 30%;top: -20px;right: 0;">
                                                    <img src="<?php echo e(asset('assets/img/cron.png')); ?>" alt="">
                                                    <h3 class=""
                                                        style="position: absolute;top: 25px;right:20%;color: #FFF">
                                                        <?php echo e(__('profile.ads')); ?>

                                                    </h3>
                                                </div>
                                                <a href="<?php echo e($second_ratio[$k]['link'] ?? '#'); ?>" target="_blank">
                                                    <img src="<?php echo e($second_ratio[$k]['third_image']); ?>" alt="">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($paginate): ?>
                                    <?php echo e($posts->links() ?? ''); ?>

                                <?php endif; ?>
                            </div>