<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title> Pharmacy </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <link rel='stylesheet' href='front_assets/css/style.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/bootstrap.min.css' type='text/css' media='all'/>
    <?php if(app()->getLocale() == 'ar'): ?>
        <link rel='stylesheet' href='front_assets/css/bootstrap-rtl.min.css' type='text/css' media='all'/>
    <?php endif; ?>
    <link rel='stylesheet' href='front_assets/css/now-ui-kit.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/main.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='front_assets/css/custom.css' type='text/css' media='all'/>
    <?php if(app()->getLocale() == 'ar'): ?>
        <link rel='stylesheet' href='front_assets/css/ar.css' type='text/css' media='all'/>
    <?php else: ?>
        <link rel='stylesheet' href='front_assets/css/en.css' type='text/css' media='all'/>
    <?php endif; ?>

    <script type='text/javascript' src='front_assets/js/jquery-3.2.1.min.js'></script>
</head>

<body class="page-template page-template-page-wordpress page-template-page-wordpress-php page page-id-10451  onepagermenu wpb-js-composer js-comp-ver-4.12 vc_responsive"
      id=”skrollr-body”>

<?php echo $__env->make('front_site.templates.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<article id="bodywrapper">

    <!--! Content -->
    <article class="nosidebar  post-10451 page type-page status-publish hentry category-wordpress">

        <!-- Content -->
        <section id="content_inner_wrapper" class="dark" style="margin:auto;width:100%;background-color:#ffffff">
            <section id="content-container">

                <div class="container-fluid" style="padding: 0">

                    <!--start contact-->
                    <section class="tp_vc_mw_rowwrapper pb-0" style="background: #FFF;padding: 0;">
                        <!--<div id="particles-js" style="position:absolute"></div>-->
                        <article style="" class="tp_vc_mw_rowinner  darkonlight">
                            <div class="rowbgimage_overlay" style="background-color:transparent;"></div>
                            <div class="content_max_width">
                                <div class="vc_row wpb_row vc_row-fluid mb-0">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center"
                                                             style="background: url('<?php echo e(asset('front_assets/images/bg_1.jpg')); ?>') center center no-repeat;background-size: cover">
                                                            <h2 class="p-5 mt-5">
                                                                <?php echo e(__('front.contact_us')); ?>

                                                            </h2>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                            <div class="card">
                                                                <div class="card-plain card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-7">
                                                                            <?php echo e(Form::open([
                                                                                'method'=>'post',
                                                                                'route'=>'handleContactUs'
                                                                            ])); ?>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label> <?php echo e(__('front.name')); ?></label>
                                                                                        <input type="text"
                                                                                               name="name"
                                                                                               class="form-control text-left"
                                                                                               autocomplete="off"
                                                                                               value="<?php echo e(old('name')); ?>"
                                                                                               placeholder="<?php echo e(__('front.type_name')); ?>">
                                                                                    </div>
                                                                                    <?php if($errors->has('name')): ?>
                                                                                        <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label> <?php echo e(__('front.phone')); ?>  </label>
                                                                                        <input type="text"
                                                                                               name="phone"
                                                                                               class="form-control text-left"
                                                                                               autocomplete="off"
                                                                                               value="<?php echo e(old('phone')); ?>"
                                                                                               placeholder="<?php echo e(__('front.type_phone')); ?>">
                                                                                    </div>
                                                                                    <?php if($errors->has('phone')): ?>
                                                                                        <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label> <?php echo e(__('front.message')); ?></label>
                                                                                        <textarea name="message"
                                                                                                  class="form-control text-left"
                                                                                                  autocomplete="off"
                                                                                                  placeholder="<?php echo e(__('front.type_message')); ?>"><?php echo e(old('message')); ?></textarea>
                                                                                    </div>
                                                                                    <?php if($errors->has('message')): ?>
                                                                                        <span class="text-danger"><?php echo e($errors->first('message')); ?></span>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <div class="col-md-12 text-center mb-3 mt-3">
                                                                                    <button type="submit"
                                                                                            class="btn btn-main btn-md">
                                                                                        <?php echo e(__('front.send')); ?>

                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <?php echo e(Form::close()); ?>

                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <img src="<?php echo e(asset('front_assets/images/pharmacist-2.png')); ?>"
                                                                                 alt="">
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
                                <div style="clear:both"></div>
                            </div>
                        </article>
                    </section>
                    <!--end contact-->

                    <!--start footer-->
                    <hr>
                    <footer style="background: url('<?php echo e(asset('front_assets/images/footer_bg.jpg')); ?>') center bottom no-repeat;background-size: contain">
                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <p>
                                    Copy Rights Are Reseved
                                    <a style="color: purple" href="">@approc</a>
                                    Inc .
                                </p>
                            </div>
                        </div>
                    </footer>
                    <!--end footer-->
                </div>

                <div class="content_max_width"></div>
            </section>
            <!-- End Of Content -->

            <div class="clearfix"></div>
        </section>

    </article>

</article>

<script src="front_assets/js/bootstrap.min.js"></script>
<script src="front_assets/js/popper.min.js"></script>
<script src="front_assets/js/now-ui-kit.min.js"></script>
<script type='text/javascript' src='front_assets/js/revslider/js/revolution.addon.paintbrush.min-1.0.0.js'></script>
<script type='text/javascript' src='front_assets/js/particles.min.js'></script>
<script type='text/javascript' src='front_assets/js/skrollr.min.js'></script>
<script type='text/javascript' src='front_assets/js/plugins.js'></script>
</body>
</html>