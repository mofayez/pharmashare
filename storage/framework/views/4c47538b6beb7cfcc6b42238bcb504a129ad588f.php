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
        <style>
            #jobs li .apply::after{
                content: 'عرض';
            }
        </style>
    <?php else: ?>
        <link rel='stylesheet' href='front_assets/css/en.css' type='text/css' media='all'/>
        <style>
            #jobs li .apply::after{
                content: 'Show';
            }
        </style>
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
                        <article class="tp_vc_mw_rowinner  darkonlight">
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
                                                                <?php echo e(__('front.find_job')); ?>

                                                            </h2>
                                                        </div>
                                                        <div class="col-md-2"></div>
                                                        <div class="col-md-8">
                                                            <div class="card">
                                                                <div class="card-plain card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <div class="row">

                                                                                <div class="col-md-12">
                                                                                    <form>
                                                                                        <div class="form-group">
                                                                                            <label> <?php echo e(__('front.find_job')); ?></label>
                                                                                            <input type="text"
                                                                                                   name="search"
                                                                                                   class="form-control text-left"
                                                                                                   autocomplete="off"
                                                                                                   placeholder="<?php echo e(__('front.find_job_p')); ?>">
                                                                                        </div>
                                                                                    </form>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <ul id="jobs">
                                                                                        <?php if(count($jobs) == 0): ?>
                                                                                        <li style="width: 100%">
                                                                                            <?php echo e(app()->getLocale() == 'ar' ? 'لا توجد بيانات': 'No Jobs'); ?>

                                                                                        </li>
                                                                                        <?php endif; ?>
                                                                                        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <li style="width: 100%">
                                                                                                <span class="term-and-company"><?php echo e($job->user->username); ?> / <?php echo e($job->user->phone); ?> </span>
                                                                                                <h2 class="title"><?php echo e($job->job_name); ?></h2>
                                                                                                <p class="description"><?php echo e($job->contacts); ?></p>
                                                                                                <button class="apply"
                                                                                                        data-info="<?php echo e($job); ?>"
                                                                                                        data-target="#jobs_modal"
                                                                                                        data-toggle="modal"></button>
                                                                                            </li>
                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <img src="<?php echo e(asset('front_assets/images/pharmacist-1.png')); ?>"
                                                                                 width="90%" style="margin: auto "
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
<!-- Modal -->
<div class="modal fade" id="jobs_modal" tabindex="-1" role="dialog" aria-labelledby="jobs_modal"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="transform: translate(0,65px);">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobs_modal_lable"> Job Info</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody id="table_body">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="front_assets/js/bootstrap.min.js"></script>
<script src="front_assets/js/popper.min.js"></script>
<script src="front_assets/js/now-ui-kit.min.js"></script>
<script>
    $(document).ready(function () {

        $('#jobs_modal').on('show.bs.modal', function (event) {
            $('#table_body').empty();
            let button = $(event.relatedTarget);
            let info = button.data('info');
            console.log(info)
            $('#table_body').append(`
                <tr>
                    <td>Job Name</td>
                    <td>${info.job_name}</td>
                </tr>
            `);
            $('#table_body').append(`
                <tr>
                    <td>Job Requirement</td>
                    <td>${info.requirements}</td>
                </tr>
            `);
            $('#table_body').append(`
                <tr>
                    <td>Job Contacts</td>
                    <td>${info.contacts}</td>
                </tr>
            `);
            $('#table_body').append(`
                <tr>
                    <td>Job Salary</td>
                    <td>${info.job_type.title}
                        ${info.salary ? info.salary : ''}
                        
                        ${info.max_salary ? ' , '+info.max_salary : ''}
                    </td>
                </tr>
            `);
        })
    });
</script>
</body>
</html>