<style>
    .form-check .form-check-label {
        padding-left: 0px;
        padding-right: 35px;
    }

    .form-check .form-check-sign:after, .form-check .form-check-sign:before {
        right: 0;
        left: auto;
    }

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

                                <div class="col-md-12 text-left">
                                    <h3> <?php echo e(__('settings.header')); ?> </h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php echo e(Form::open([
                                                'method'=>'post',
                                                'route'=>'getHandleHeaderSite'
                                            ])); ?>

                                            <div class="row">
                                                <input type="hidden" name="id" value="<?php echo e($slide->id); ?>">
                                                <div class="col-md-6 text-left">
                                                    <div class="form-group">
                                                        <label> <?php echo e(__('settings.title_ar')); ?>  </label>
                                                        <input type="text" name="title_ar" class="form-control"
                                                               value="<?php echo e($slide->details()->where('language','ar')->first()->title ?? ''); ?>"
                                                               placeholder="<?php echo e(__('settings.title_ar')); ?>">
                                                    </div>
                                                    <?php if($errors->has('title_ar')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('title_ar')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('settings.title_en')); ?></label>
                                                        <input type="text" name="title_en" class="form-control"
                                                               value="<?php echo e($slide->details()->where('language','en')->first()->title ?? ''); ?>"
                                                               placeholder="<?php echo e(__('settings.title_en')); ?>">
                                                    </div>
                                                    <?php if($errors->has('title_en')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('title_en')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <div class="form-group">
                                                        <label> <?php echo e(__('settings.description_ar')); ?></label>
                                                        <textarea type="text" name="description_ar" class="form-control"
                                                                  rows="8"
                                                                  placeholder="<?php echo e(__('settings.description_ar')); ?>"><?php echo e($slide->details()->where('language','ar')->first()->description); ?></textarea>
                                                    </div>
                                                    <?php if($errors->has('description_ar')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('description_ar')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 text-left">
                                                    <div class="form-group">
                                                        <label> <?php echo e(__('settings.description_en')); ?></label>
                                                        <textarea type="text" name="description_en" class="form-control"
                                                                  rows="8"
                                                                  placeholder="<?php echo e(__('settings.description_en')); ?>"><?php echo e($slide->details()->where('language','en')->first()->description); ?></textarea>
                                                    </div>
                                                    <?php if($errors->has('description_en')): ?>
                                                        <span class="text-danger"><?php echo e($errors->first('description_en')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-main">
                                                    <?php echo e(__('settings.update')); ?>

                                                </button>
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="card card-blog card-plain card-body">
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
                                                         src="<?php echo e(asset('storage/files/slider').'/'); ?><?php echo e($slide->image->name ?? '-'); ?>">
                                                    <input type="file" name="profile-image" class="d-none"
                                                           accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <hr>
                                    <h3> <?php echo e(__('settings.services')); ?> </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">

                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4">
                                                <?php echo e(Form::open([
                                                    'method'=>'post',
                                                    'route'=>'handleServiceSite'
                                                ])); ?>

                                                <input type="hidden" name="id" value="<?php echo e($service->id); ?>">
                                                <div class="card">
                                                    <div class="feature card-blog card-plain card-body p-1 pt-5 pb-5 text-center">
                                                        <img src="<?php echo e(asset('front_assets/images/'.$service->image)); ?>"
                                                             alt="">
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.title_ar')); ?>  </label>
                                                            <input class="form-control" name="title_ar"
                                                                   value="<?php echo e($service->details()->where('language','ar')->first()->title); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label>   <?php echo e(__('settings.title_en')); ?></label>
                                                            <input class="form-control" name="title_en"
                                                                   value="<?php echo e($service->details()->where('language','en')->first()->title); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label><?php echo e(__('settings.description_ar')); ?></label>
                                                            <textarea class="form-control"
                                                                      name="description_ar"><?php echo e($service->details()->where('language','ar')->first()->description); ?></textarea>
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.description_en')); ?>  </label>
                                                            <textarea class="form-control"
                                                                      name="description_en"><?php echo e($service->details()->where('language','en')->first()->description); ?></textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-main">
                                                                <?php echo e(__('settings.update')); ?>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <hr>
                                    <h3> <?php echo e(__('settings.pricing')); ?> </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">

                                        <?php $__currentLoopData = $pricing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4">
                                                <?php echo e(Form::open([
                                                    'method'=>'post',
                                                    'route'=>'handlePriceSite'
                                                ])); ?>

                                                <input type="hidden" name="id" value="<?php echo e($price->id); ?>">
                                                <div class="card">
                                                    <div class="feature card-blog card-plain card-body p-1 pt-5 pb-5 text-center">
                                                        <img src="<?php echo e(asset('front_assets/images/'.$price->image)); ?>"
                                                             alt="">
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.title_ar')); ?>  </label>
                                                            <input class="form-control" name="title_ar"
                                                                   value="<?php echo e($price->title_ar); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.title_en')); ?>  </label>
                                                            <input class="form-control" name="title_en"
                                                                   value="<?php echo e($price->title_en); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.cost')); ?> </label>
                                                            <input class="form-control" name="price"
                                                                   value="<?php echo e($price->price); ?>">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-main">
                                                                <?php echo e(__('settings.update')); ?>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <div class="col-md-12 text-left">
                                    <hr>
                                    <h3> <?php echo e(__('settings.testimonial')); ?>   </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">

                                        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tesimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4">
                                                <?php echo e(Form::open([
                                                    'method'=>'post',
                                                    'route'=>'handleTestimonialSite'
                                                ])); ?>

                                                <input type="hidden" name="id" value="<?php echo e($tesimonial->id); ?>">
                                                <div class="card">
                                                    <div class="feature card-blog card-plain card-body p-1 pt-5 pb-5 text-center">
                                                        <img style="width: 80px"
                                                             src="<?php echo e(asset('storage/files/testimonial/'.$tesimonial->image)); ?>"
                                                             alt="">
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.client_name_ar')); ?>    </label>
                                                            <input class="form-control" name="client_name_ar"
                                                                   value="<?php echo e($tesimonial->client_name_ar); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.client_name_en')); ?>    </label>
                                                            <input class="form-control" name="client_name_en"
                                                                   value="<?php echo e($tesimonial->client_name_en); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.description_ar')); ?>   </label>
                                                            <textarea class="form-control"
                                                                      name="description_ar"><?php echo e($tesimonial->description_ar); ?></textarea>
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.description_en')); ?>   </label>
                                                            <textarea class="form-control"
                                                                      name="description_en"><?php echo e($tesimonial->description_en); ?></textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-main">
                                                                <?php echo e(__('settings.update')); ?>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>


                                <div class="col-md-12 text-left">
                                    <hr>
                                    <h3> <?php echo e(__('settings.faq')); ?>   </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">

                                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-3 p-1">
                                                <?php echo e(Form::open([
                                                    'method'=>'post',
                                                    'route'=>'handleFaqSite'
                                                ])); ?>

                                                <input type="hidden" name="id" value="<?php echo e($faq->id); ?>">
                                                <div class="card">
                                                    <div class="feature card-blog card-plain card-body p-1 pt-5 pb-5 text-center">
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.question_ar')); ?>    </label>
                                                            <input class="form-control" name="question_ar"
                                                                   value="<?php echo e($faq->question_ar); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.question_en')); ?>    </label>
                                                            <input class="form-control" name="question_en"
                                                                   value="<?php echo e($faq->question_en); ?>">
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.answer_ar')); ?>   </label>
                                                            <textarea class="form-control"
                                                                      name="answer_ar"><?php echo e($faq->answer_ar); ?></textarea>
                                                        </div>
                                                        <div class="form-group text-left">
                                                            <label> <?php echo e(__('settings.answer_en')); ?>   </label>
                                                            <textarea class="form-control"
                                                                      name="answer_en"><?php echo e($faq->answer_en); ?></textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-main">
                                                                <?php echo e(__('settings.update')); ?>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo e(Form::close()); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <div class="col-md-12 table-scroll">
                                    <table class="table table-bordered">
                                        <?php $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <?php echo e(Form::open([
                                                    'method'=>'post',
                                                    'route'=>'handleTranslation',
                                                ])); ?>

                                                <td>
                                                    <input type="text" class="form-control text-left" required name="text_ar" autocomplete="off" value="<?php echo e($trans->text_ar); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-left" required name="text_en" autocomplete="off" value="<?php echo e($trans->text_en); ?>">
                                                </td>
                                                <td width="80px">
                                                    <input type="hidden" name="id" value="<?php echo e($trans->id); ?>">
                                                    <button type="submit" class="btn btn-main">
                                                        <?php echo e(__('settings.update')); ?>

                                                    </button>
                                                </td>
                                                <?php echo e(Form::close()); ?>

                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>