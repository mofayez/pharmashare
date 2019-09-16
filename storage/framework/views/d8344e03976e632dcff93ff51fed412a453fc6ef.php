<nav class="navbar navbar-expand-lg navbar-transparent bg-white fixed-top direction" color-on-scroll="100">
    <div class="container">

        <div class="navbar-translate">
            <a href="<?php echo e(route('getIndexView')); ?>">
                <img src="<?php echo e(asset('front_assets/images/logo.png')); ?>" style="width: 150px;background: white;" alt="">
            </a> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar top-bar"></span>
                <span class="navbar-toggler-bar middle-bar"></span>
                <span class="navbar-toggler-bar bottom-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse show" data-nav-image="./assets/img//blurred-image-1.jpg"
             data-color="orange">
 
                <ul class="navbar-nav direction" style="margin-right: auto"> 

                            <li class="nav-item text-center">
                                <a href="<?php echo e(route('getIndexView')); ?>" class="nav-link btn btn-main btn-round text-white">
                                    <p> <?php echo e(__('front.home')); ?></p>
                                </a>
                            </li>

                            <li class="nav-item text-center">
                                <a href="<?php echo e(route('getContactView')); ?>" class="nav-link">
                                    <p><?php echo e(__('front.contact_us')); ?>  </p>
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="<?php echo e(route('getJobsView')); ?>" class="nav-link">
                                    <p><?php echo e(__('front.find_job')); ?></p>
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="<?php echo e(route('getPharamcyView')); ?>" class="nav-link">
                                    <p><?php echo e(__('front.map')); ?></p>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link btn-round" id="settings" data-toggle="dropdown">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </a>
                                <div class="dropdown-menu text-left" aria-labelledby="settings">
                                    <a class="dropdown-header"><?php echo e(__('front.account')); ?></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('getLoginView')); ?>"><?php echo e(__('front.login')); ?></a>
                                    <a class="dropdown-item"
                                       href="<?php echo e(route('getRegisterView')); ?>"> <?php echo e(__('front.register')); ?>   </a>
                                    <?php if(app()->getLocale() == 'ar'): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('setEn')); ?>">
                                            
                                             الانجليزية 
                                        
                                        </a>
                                    <?php else: ?>
                                        <a class="dropdown-item" href="<?php echo e(route('setAr')); ?>">
                                             
                                             Arabic 
                                             
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </li>

                        </ul>

        </div>

    </div>

</nav>