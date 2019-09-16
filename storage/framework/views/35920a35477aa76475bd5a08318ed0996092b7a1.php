<ul class="nav nav-pills nav-pills-primary flex-column">
    <?php if($user->role_id == 2): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 2): ?> active show <?php endif; ?>" href="<?php echo e(route('getAddDrugsOffersView')); ?>">
                <?php echo e(__('admin.add_feature_ads')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if($user->role_id == 1 || $user->role_id == 2 || $user->role_id == 3): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 1): ?> active show <?php endif; ?>" href="<?php echo e(route('getAddImageOffersView')); ?>">
                <?php echo e(__('admin.add_image_ads')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 3): ?> active show <?php endif; ?>" href="<?php echo e(route('getAllUserOffersView')); ?>">
                <?php echo e(__('admin.show_my_ads')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if($user->role_id == 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 6): ?> active show <?php endif; ?>" href="<?php echo e(route('getAddOfferPackagesView')); ?>">
                <?php echo e(__('admin.add_package')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 4): ?> active show <?php endif; ?>" href="<?php echo e(route('getOfferPackagesView')); ?>">
                <?php echo e(__('admin.packages')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 5): ?> active show <?php endif; ?>" href="<?php echo e(route('getApproveOffersView')); ?>">
                <?php echo e(__('admin.accept_ads')); ?>

            </a>
        </li>
    <?php endif; ?>
</ul>