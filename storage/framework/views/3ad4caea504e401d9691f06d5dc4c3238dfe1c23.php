<div class="wrappers">
    <div class="containers bg-white">
        <div class="left">
            <div class="top">
                <form action="" id="form_search">
                    <input type="text" placeholder="Search" name="query" autocomplete="off" value="<?php echo e(app('request')->get('query')); ?>">
                    <a onclick="$('#form_search').submit()[0]" href="javascript:;" class="search">
                        <i class="fas fa-search mt-3 fa-lg"></i>
                    </a>
                </form>
            </div>
            <ul class="people list-unstyled">
                <?php $__currentLoopData = $chat_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="person <?php if($chat['lastMessageFromHim']): ?> <?php echo e($chat['lastMessageFromHim'] ? $chat['lastMessageFromHim']->read_at ? '' : 'unread': ''); ?> <?php endif; ?>"
                        data-chat="person <?php if($chat['withUser']): ?> <?php echo e($chat['withUser']->id); ?> <?php endif; ?>"
                        data-username=" <?php if($chat['withUser']): ?> <?php echo e($chat['withUser']->firstname . ' ' . $chat['withUser']->lastname); ?>  <?php endif; ?>"
                        data-user-id=" <?php if($chat['withUser']): ?> <?php echo e($chat['withUser']->id); ?> <?php endif; ?>"
                        data-user-url="<?php if($chat['withUser']): ?><?php echo e(route('getUserProfileView',['username'=>'@'.$chat['withUser']->username , 'id'=>$chat['withUser']->id])); ?> <?php endif; ?>"
                        id=" <?php if($chat['withUser']): ?> chat_<?php echo e($chat['withUser']->id); ?> <?php endif; ?>">
                        <img src=" <?php if($chat['withUser']): ?> <?php echo e($chat['withUser']->image_path ?? asset('assets/img/user_avatar.jpg')); ?> <?php endif; ?>" alt=""/>
                        <div class="name text-capitalize"> 
                            <?php if($chat['withUser']): ?> 
                                <?php echo e($chat['withUser']->firstname . ' ' . $chat['withUser']->lastname); ?> <br>
                                <div class="badge badge-primary" style="font-size:8px"><?php echo e($chat['withUser']->role->title ?? ''); ?></div> 
                            <?php endif; ?>
                        </div>
                        <span class="time" style="font-size:12px"><?php echo e($chat['lastMessages']->created_at->diffForHumans()); ?></span>
                        <div class="preview"><?php echo e($chat['lastMessages']->message); ?></div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <div class="right">
            <div class="top">
                <span> <?php echo e(app()->getLocale() == 'ar' ? 'الي': 'To'); ?>

                    <a id="name" class="name" href=""> </a>
                </span>
            </div>
            <div class="chat active-chat" data-chat="person1" style="padding-top: 15px;">
                <div class="chat-overflow">
                    <div class="conversation-start">
                        
                    </div>

                </div>
            </div>

            
            <div class="write">
                <form id="ChatSendMessageForm">
                    <input type="hidden" name="from_user_id" value="<?php echo e($user->id); ?>">
                    <input type="hidden" name="to_user_id" value="">
                    <input type="text" name="message" autocomplete="off"/>
                    <button type="submit" class="send now-ui-icons ui-1_send"
                            style="font:normal normal normal 14px/1 Nucleo Outline!important"></button>
                </form>
            </div>
        </div>
    </div>
</div>