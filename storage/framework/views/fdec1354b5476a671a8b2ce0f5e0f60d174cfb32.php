<style>
    .update-profile-loader {
        position: absolute;
        z-index: 10;
        bottom: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        line-height: 50px;
        color: #fff;
        transition: all 0.5s ease-in-out;
        display: none;
    }

    .update-profile-loader i {
        line-height: 280px;
        font-size: 30px;
    }

    .update-profile {
        position: absolute;
        z-index: 9;
        bottom: 0;
        width: 100%;
        height: 50px;
        background: rgba(0, 0, 0, 0.5);
        line-height: 50px;
        color: #ccc;
        opacity: 0;
        transition: all 0.5s ease-in-out;
    }

    .update-profile .title {
        margin: 0;
        padding: 0;
        line-height: 50px;
        cursor: pointer;
    }

    .card-image:hover .update-profile {
        opacity: 1;
    }
    .modal-backdrop.show{
        z-index:98;
    }
</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        <div class="text-center col-md-12  m-auto">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('pages.setting.navigators', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="link4">
                            <div class="row">
                                <div class="col-md-8">
                                    <?php echo e(Form::open([
                                        'method'=>'post',
                                        'route'=>'updateProfileInfo'
                                    ])); ?>

                                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                    <div class="row direction text-left">
                                        <div class="col-md-12">
                                            <h3>
                                                <?php echo e(__('settings.update_personal')); ?>

                                            </h3>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo e(__('auth.username')); ?>  </label>
                                                <input type="text" name="username" disabled value="<?php echo e($user->username); ?>"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="<?php echo e(__('auth.username')); ?>">
                                            </div>
                                            <?php if($errors->has('username')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('username')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo e(__('auth.phone')); ?>   </label>
                                                <div class="input-group">
                                                    <input type="tel" style="width: 70%;text-align: left;" name="phone"
                                                           dir="ltr"
                                                           class="form-control"
                                                           value="<?php echo e($user->phone); ?>"
                                                           autocomplete="off">
                                                    <input type="tel" style="width: 30%;" name="prefix" dir="ltr"
                                                           class="form-control text-center"
                                                           value="<?php echo e($user->prefix); ?>"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                            <?php if($errors->has('phone')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                                            <?php endif; ?>
                                            <?php if($errors->has('prefix') && !$errors->has('phone')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('prefix')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo e(__('auth.firstname')); ?></label>
                                                <input type="text" name="firstname" value="<?php echo e($user->firstname); ?>"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder=" <?php echo e(__('auth.firsname')); ?>">
                                            </div>
                                            <?php if($errors->has('firstname')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('firstname')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo e(__('auth.lastname')); ?>  </label>
                                                <input type="text" name="lastname" value="<?php echo e($user->lastname); ?>"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="<?php echo e(__('auth.lastname')); ?>">
                                            </div>
                                            <?php if($errors->has('lastname')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('lastname')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <label>   <?php echo e(__('auth.password')); ?></label>
                                                <input type="password" name="password" class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="<?php echo e(__('auth.password')); ?>">
                                            </div>
                                            <?php if($errors->has('password')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('password')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <label> <?php echo e(__('auth.re_password')); ?></label>
                                                <input type="password" name="password_confirmation"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder=" <?php echo e(__('auth.re_password')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>  <?php echo e(__('auth.email')); ?>  </label>
                                                <input type="text" name="email" value="<?php echo e($user->email); ?>"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="<?php echo e(__('auth.email')); ?>    ">
                                            </div>
                                            <?php if($errors->has('email')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('email')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo e(__('settings.full_address')); ?> </label>
                                                <input type="text" name="full_address" value="<?php echo e($user->full_address); ?>"
                                                       class="form-control text-left"
                                                       autocomplete="off"
                                                       placeholder="<?php echo e(__('settings.full_address')); ?>  ">
                                            </div>
                                            <?php if($errors->has('full_address')): ?>
                                                <span style="top: -10px;position: relative;"
                                                      class="text-danger"><?php echo e($errors->first('full_address')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <div class="text-center  m-auto">
                                        <button class="btn btn-main">
                                            <?php echo e(__('settings.update')); ?>

                                        </button>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                        <div class="col-md-12">
                                            <table class="table table-border">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo e(app()->getLocale() == 'ar' ? 'Lat' : 'Lat'); ?></th>
                                                        <th><?php echo e(app()->getLocale() == 'ar' ? 'Lng' : 'Lng'); ?></th>
                                                        <th><?php echo e(app()->getLocale() == 'ar' ? 'العنوان بالبحث' : 'Search Location'); ?></th>
                                                        <th><?php echo e(app()->getLocale() == 'ar' ? 'عنوان الخريطة' : 'GEO Location'); ?></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo e($user->location->lat ?? ''); ?></td>
                                                        <td><?php echo e($user->location->lng ?? ''); ?></td>
                                                        <td><?php echo e($user->location->location ?? ''); ?></td>
                                                        <td><?php echo e($user->location->geo_location ?? ''); ?></td> 
                                                        <td>
                                                            <button class="btn btn-info btn-sm" type="button" data-target="#jobs_modal" data-toggle="modal">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
<!-- Modal -->
<div class="modal fade" id="jobs_modal" tabindex="-1" role="dialog" aria-labelledby="jobs_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="transform: translate(0,65px);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobs_modal_lable"></h5>
            </div>
            <?php echo e(Form::open([
                'method'=>'post',
                'id'=>'form',
                'route'=>'postEditLocations'
            ])); ?>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="position:relative">
                            <div id='map'></div>
                            
                        <input type="hidden" name="user_id" value="<?php echo e($user->id ?? ''); ?>">
                        <input type="hidden" name="lat" value="<?php echo e($user->location->lat ?? ''); ?>">
                        <input type="hidden" name="lng" value="<?php echo e($user->location->lng ?? ''); ?>">
                        <input type="hidden" name="location" value="<?php echo e($user->location->location ?? ''); ?>">
                        <input type="hidden" name="geo_location" value="<?php echo e($user->location->geo_location ?? ''); ?>">
                        
                        
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-main"> <?php echo e(__('settings.update')); ?></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>
                                <div class="col-md-4">
                                    <div class="card card-blog card-plain card-body" style="bottom: 80px">
                                        <div class="card-image position-relative">
                                            <div class="update-profile-loader">
                                                <i class="fas fa-spin fa-spinner"></i>
                                            </div>
                                            <div class="update-profile" id="change_profile">
                                                <h4 class="title"><?php echo e(__('settings.update_profile')); ?>    </h4>
                                            </div>
                                            <img id="image-preview"
                                                 class="img img-responsive img-thumbnail rounded profile-img img-raised"
                                                 width="100%"
                                                 src="<?php echo e($user->image_path ?? asset("assets/img/user_avatar.jpg")); ?>">
                                            <input type="file" name="profile-image" class="d-none" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>