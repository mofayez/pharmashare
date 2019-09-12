<?php if(!$current_user->location): ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4><?php echo e(app()->getLocale() == 'ar' ? 'ﻻ يوجد خريطة': 'No Marker To Set'); ?></h4>
        </div>
    </div>
<?php else: ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <div id='map'></div>
        </div>
    </div>
<?php endif; ?>