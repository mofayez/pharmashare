<style>
    .my-group input {
        height: 40px !important;
        max-width: 45% !important;
    }

    .my-group .btn-main {
        height: 40px !important;
        max-width: 10% !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 267px;">
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-6 offset-md-2">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
                <div class="col-md-12 table-scroll">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(app()->getLocale() == 'ar' ? 'نوع المنشور ' : 'Post Type'); ?></th>
                            <th><?php echo e(app()->getLocale() == 'ar' ? ' المستخدم' : 'User'); ?></th>
                            <th width="70%"><?php echo e(app()->getLocale() == 'ar' ? ' المحتوي' : 'Content'); ?></th>
                            <th><?php echo e(app()->getLocale() == 'ar' ? 'تاريخ النشر ' : 'Posted At'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($posts)==0): ?>
                            <tr>
                                <td colspan="12"><?php echo e(__('admin.no_data')); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="_<?php echo e($post->id); ?>">
                                <td>00<?php echo e($post->id); ?></td>
                                <td class="text-uppercase"><?php echo e($post->post_type); ?></td>
                                <td><?php echo e($post->user->firstname ?? ''); ?> <?php echo e($post->user->lastname ?? ''); ?></td>
                                <td class="text-left">
                                    <span class="text-primary"><?php echo e(app()->getLocale() == 'ar' ? 'المحتوي' : 'Content'); ?>:</span>
                                    <b><?php echo e($post->post ?? '-'); ?></b>
                                    <br>
                                    <span class="text-primary"><?php echo e(app()->getLocale() == 'ar' ? ' مرفقات' : 'Attachment'); ?>:</span>
                                    <?php $__currentLoopData = $post->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="text-info" target="_blank" href="<?php echo e($file['name']); ?>">Attached File</a>
                                        <br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($post->user->created_at); ?></td>
                                <td>
                                    <div class="btn-group direction">
                                        <button class="btn btn-main p-2 pl-3 pr-3"
                                                onclick="approve('<?php echo e($post->id); ?>')">
                                            <i class="now-ui-icons ui-1_check"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-12">
                    <?php echo e($posts->appends(request()->except('page'))->render('pagination::bootstrap-4')); ?>

                </div>
            </div>
        </div>
    </div>
</div>