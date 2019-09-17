<ul class="nav nav-pills nav-pills-primary flex-column">
    <li class="nav-item">
        <a class="nav-link <?php if($nav == 1): ?> active show <?php endif; ?>" href="<?php echo e(route('getProfileSettingView')); ?>">
            <?php echo e(__('settings.personal_info')); ?>

        </a>
    </li>
    <?php if(auth()->user()->role_id == 2): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 2): ?> active show <?php endif; ?>" href="<?php echo e(route('getPaymentsSettingView')); ?>">
                <?php echo e(__('settings.payment_types')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id == 2): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 12): ?> active show <?php endif; ?>" href="<?php echo e(route('createPoints')); ?>">
                <?php echo e(__('store.points')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id != 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 3): ?> active show <?php endif; ?>" href="<?php echo e(route('getEditLicensesView')); ?>">
                <?php echo e(__('settings.edit_licenses')); ?>

            </a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="nav-link <?php if($nav == 4): ?> active show <?php endif; ?>" href="<?php echo e(route('getNotificationsSettingView')); ?>">
            <?php echo e(__('settings.notifications')); ?>

        </a>
    </li>
    <?php if(auth()->user()->role_id == 3): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 5): ?> active show <?php endif; ?>" href="<?php echo e(route('getPharmacyBlacklist')); ?>">
                <?php echo e(__('settings.black_list')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id == 2): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 5): ?> active show <?php endif; ?>" href="<?php echo e(route('getStoreBlacklist')); ?>">
                <?php echo e(__('settings.black_list')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id == 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 6): ?> active show <?php endif; ?>" href="<?php echo e(route('getHeaderSite')); ?>">
                <?php echo e(__('settings.out_site')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id == 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 7): ?> active show <?php endif; ?>" href="<?php echo e(route('getContactUs')); ?>">
                <?php echo e(__('settings.contact_us')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id == 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 11): ?> active show <?php endif; ?>" href="<?php echo e(route('getDefaultSettings')); ?>">
                <?php echo e(app()->getLocale() == 'ar' ? 'الاعدادات العامة' : 'Default Settings'); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id == 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 8): ?> active show <?php endif; ?>" href="<?php echo e(route('getComplaintsUs')); ?>">
                <?php echo e(__('settings.complaints')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id != 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 9): ?> active show <?php endif; ?>" href="<?php echo e(route('getCreateComplaintsUs')); ?>">
                <?php echo e(__('settings.complaints')); ?>

            </a>
        </li>
    <?php endif; ?>
    <?php if(auth()->user()->role_id == 1): ?>
        <li class="nav-item">
            <a class="nav-link <?php if($nav == 10): ?> active show <?php endif; ?>" href="<?php echo e(route('getAdsControl')); ?>">
                <?php echo e(__('settings.ads_control')); ?>

            </a>
        </li>
    <?php endif; ?>
</ul>