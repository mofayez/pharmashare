<style>
    .form-check .form-check-label {
        padding-left: 0px;
        padding-right: 35px;
    }

    .form-check .form-check-sign:after, .form-check .form-check-sign:before {
        right: 0;
        left: auto;
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
                                    <h3>   <?php echo e(__('settings.contact_us')); ?>  </h3>
                                </div>
                                <div class="col-md-12 table-scroll">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th> <?php echo e(__('settings.name')); ?> </th>
                                            <th><?php echo e(__('settings.phone')); ?></th>
                                            <th> <?php echo e(__('settings.message')); ?>  </th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($contact->name); ?></td>
                                                <td><?php echo e($contact->phone); ?></td>
                                                <td><?php echo e($contact->message); ?></td>
                                                <td>
                                                    <button class="btn btn-danger p-1 pr-2 pl-2"
                                                            onclick="deleteMessage('<?php echo e($contact->id); ?>')">
                                                        <i class="fa fa-times"></i>
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