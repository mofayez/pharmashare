<div class="row">
    <div class="col-md-12">
        <div class="card" style="min-height: 267px;">
            <div class="card card-blog card-plain card-body direction">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <!--
                                color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                            -->
                            <ul class="nav nav-pills nav-pills-primary nav-pills-just-icons justify-content-center flex-row" role="tablist">
                                <li class="nav-item text-left">
                                    <a class="nav-link active show" data-toggle="tab" href="#link20" role="tablist">
                                        <i class="now-ui-icons users_single-02"></i>
                                    </a>
                                    <h6><?php echo e(__('admin.delete_user')); ?>   </h6>
                                </li>
                                <li class="nav-item text-left">
                                    <a class="nav-link" data-toggle="tab" href="#link21" role="tablist">
                                        <i class="fas fa-user-cog"></i>
                                    </a>
                                    <h6><?php echo e(__('admin.activate_user')); ?>   </h6>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="link20">

                                    <div class="row">
                                        <div class="col-md-12 table-scroll">
                                            <table class="table table-bordered " id="dataTable1">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo e(__('admin.name')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.user')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.permission')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.phone')); ?>

                                                    </th>
                                                    <th width="150px">
                                                        <?php echo e(__('admin.rate')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.status')); ?>

                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo e($account->firstname . ' ' . $account->lastname); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($account->username); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($account->role->title); ?>

                                                        </td>
                                                        <td dir="ltr">
                                                            +(<?php echo e($account->prefix); ?>) <?php echo e($account->phone); ?>

                                                        </td>
                                                        <td>
                                                            <?php if($account->role->title == 'store'): ?>
                                                                <?php echo e($account->averageRating()); ?>/5
                                                                <a href="" data-toggle="modal"
                                                                   data-user-id="<?php echo e($account->id); ?>"
                                                                   data-target="#showrating_modal"
                                                                   class="text-info"><?php echo e(__('admin.show')); ?> </a>
                                                                <?php if($account->averageRating() == 5): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() > 4 && $account->averageRating() < 5): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() == 4): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() > 3 && $account->averageRating() < 4): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() == 3): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() > 2 && $account->averageRating() < 3): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() == 2): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() > 1 && $account->averageRating() < 2): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() == 1): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php elseif($account->averageRating() > 0 && $account->averageRating() < 1): ?>
                                                                    <div dir="ltr">
                                                                        <i class="fas fa-star-half-alt"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div dir="ltr">
                                                                        <i class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i><i
                                                                                class="far fa-star"></i>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                -
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if($account->activated): ?>
                                                                <label class="badge badge-success"><?php echo e(__('admin.activated')); ?> </label>
                                                            <?php else: ?>
                                                                <label class="badge badge-danger"><?php echo e(__('admin.not_activated')); ?>   </label>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="p-0">
                                                            <?php if(count($account->posts) == 0): ?>
                                                            <?php endif; ?>
                                                            <?php if($account->activated): ?>
                                                            <button class="btn btn-danger p-1 pl-3 pr-3"
                                                                    onclick="deactivate_account('<?php echo e($account->id); ?>')">
                                                                <?php echo e(__('admin.not_activated')); ?>

                                                            </button>
                                                            <?php else: ?>
                                                            <button class="btn btn-warning p-1 pl-3 pr-3"
                                                                    onclick="activate_account('<?php echo e($account->id); ?>')">
                                                                <?php echo e(__('admin.activate')); ?>

                                                            </button>
                                                            <?php endif; ?>
                                                            <button class="btn btn-danger p-1 pl-3 pr-3"
                                                                    onclick="remove_account('<?php echo e($account->id); ?>')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="link21">
                                    <div class="row">
                                        <div class="col-md-12 table-scroll">
                                            <table class="table table-bordered " id="dataTable2">
                                                <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo e(__('admin.name')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.user')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.permission')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.phone')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.details')); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(__('admin.status')); ?>

                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $disactivated_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo e($d_account->firstname . ' ' . $d_account->lastname); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($d_account->username); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($d_account->role->title); ?>

                                                        </td>
                                                        <td dir="ltr">
                                                            +(<?php echo e($d_account->prefix); ?>) <?php echo e($d_account->phone); ?>

                                                        </td>
                                                        <td>
                                                            <button class="btn btn-main p-1 pl-3 pr-3" type="button"
                                                                    data-toggle="modal" data-user="<?php echo e($d_account); ?>" 
                                                                    data-role_id="<?php echo e($d_account->role->id ?? 0); ?>"
                                                                    data-trade_license_path="<?php echo e($d_account->papers->trade_license_path ?? ''); ?>"
                                                                    data-passport_license_path="<?php echo e($d_account->papers->passport_license_path ?? ''); ?>"
                                                                    data-pharmacy_license_path="<?php echo e($d_account->papers->pharmacy_license_path ?? ''); ?>"
                                                                    data-target="#showLicense_modal">
                                                                <?php echo e(__('admin.show_details')); ?>

                                                            </button>
                                                        </td>
                                                        <td>
                                                            <?php if($d_account->activated): ?>
                                                                <label class="badge badge-success">
                                                                    <?php echo e(__('admin.activated')); ?>

                                                                </label>
                                                            <?php else: ?>
                                                                <label class="badge badge-danger">
                                                                    <?php echo e(__('admin.not_activated')); ?>

                                                                </label>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="p-0">
                                                            <button class="btn btn-warning p-1 pl-3 pr-3"
                                                                    onclick="activate_account('<?php echo e($d_account->id); ?>')">
                                                                <?php echo e(__('admin.activate')); ?>

                                                            </button>
                                                            <button class="btn btn-danger p-1 pl-3 pr-3"
                                                                    onclick="deactivate_account('<?php echo e($d_account->id); ?>')">
                                                                <?php echo e(__('admin.not_activated')); ?>

                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
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
    </div>
</div>