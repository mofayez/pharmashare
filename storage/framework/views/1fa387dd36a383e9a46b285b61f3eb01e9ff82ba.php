<style>
    .my-group input {
        height: 30px !important;
        max-width: 25% !important;
    }

    .my-group .btn-main {
        height: 30px !important;
        max-width: 10% !important;
    }

    #map {
        width: 100%;
        height: 50vh;
        position: relative;
        display: flex;
    }

</style>
<div class="card">
    <div class="card card-blog card-plain card-body">
        <?php if($user->role_id != 4): ?>
            <div class="float-right">
                <a href="<?php echo e(route('getAllJob')); ?>" class="btn btn-main">
                    <?php echo e(__('jobs.all_jobs')); ?>

                </a>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <h2><?php echo e(__('jobs.add_new_job')); ?></h2>
            </div>
            <div class="col-md-4 d-none d-md-block">
                <?php if(in_array('jobs',(array)$allowed_ads)): ?>
                    <?php if(count($first_ratio) == 0): ?>
                        <img src="<?php echo e(asset('assets/img/pharmacist-1.png')); ?>" class="img-responsive" alt="">
                    <?php endif; ?>
                    <?php $__currentLoopData = $first_ratio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->iteration == 1): ?>
                            <div style="position: absolute;z-index: 9;width: 60%;top: -20px;right: 0;">
                                <img src="<?php echo e(asset('assets/img/cron.png')); ?>" alt="">
                                <h4 class="" style="position: absolute;top: 0px;right:20%;color: #FFF">
                                    <?php echo e(__('profile.ads')); ?>

                                </h4>
                            </div>
                            <a href="<?php echo e($ads['link'] ?? '#'); ?>" target="_blank">
                                <img src="<?php echo e($ads['second_image']); ?>" alt="">
                            </a>
                        <?php else: ?>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/img/pharmacist-1.png')); ?>" class="img-responsive" alt="">
                <?php endif; ?>

            </div>
            <div class="col-md-8 text-left">
                <?php echo e(Form::open([
                    'method'=>'post',
                    'route'=>'handlePostJob'
                ])); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('jobs.job_title')); ?>  </label>
                            <input type="text" class="form-control" name="job_name"
                                   placeholder="<?php echo e(__('jobs.job_title')); ?>">
                        </div>
                        <?php if($errors->has('job_name')): ?>
                            <span style="top: -10px;position: relative;"
                                  class="text-danger"><?php echo e($errors->first('job_name')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__('jobs.salary')); ?></label>
                            <select name="job_type_id" class="form-control" onchange="changeType()">
                                <?php $__currentLoopData = $job_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(app()->getLocale() == 'ar'): ?>
                                        <option value="<?php echo e($job_type->id); ?>"><?php echo e($job_type->name); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo e($job_type->id); ?>"><?php echo e($job_type->title); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php if($errors->has('job_type_id')): ?>
                            <span style="top: -10px;position: relative;"
                                  class="text-danger"><?php echo e($errors->first('job_type_id')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6" id="range" style="display:none">
                        <div class="form-group">
                            <label><?php echo e(__('jobs.salary_range')); ?></label>
                            <br>
                            <label><?php echo e(__('jobs.salary_between')); ?>

                                (<span id="salaryfrom"></span> - <span id="salaryto"></span>)
                            </label>
                            <div id="sliderSalary" class="slider slider-info"></div>
                            <input type="hidden" name="salary">
                            <input type="hidden" name="max_salary">
                        </div>
                        <?php if($errors->has('salary')): ?>
                            <span style="top: -10px;position: relative;"
                                  class="text-danger"><?php echo e($errors->first('salary')); ?></span>
                        <?php endif; ?>
                        <?php if($errors->has('max_salary')): ?>
                            <span style="top: -10px;position: relative;"
                                  class="text-danger"><?php echo e($errors->first('max_salary')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo e(__('jobs.requirements')); ?>  </label>
                            <textarea class="form-control" name="requirements" rows="8"
                                      placeholder="<?php echo e(__('jobs.requirements')); ?> "></textarea>
                        </div>
                        <?php if($errors->has('requirements')): ?>
                            <span style="top: -10px;position: relative;"
                                  class="text-danger"><?php echo e($errors->first('requirements')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo e(__('jobs.contacts')); ?>  </label>
                            <textarea class="form-control" rows="8" name="contacts"
                                      placeholder="<?php echo e(__('jobs.contacts')); ?>"></textarea>
                        </div>
                        <?php if($errors->has('contacts')): ?>
                            <span style="top: -10px;position: relative;"
                                  class="text-danger"><?php echo e($errors->first('contacts')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="text-center  m-auto">
                        <button type="submit" class="btn btn-main">
                            <?php echo e(__('jobs.add_job')); ?>

                        </button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
        
        
        
    </div>
</div>