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
        <div class="row">  
            <div class="col-md-12 d-none d-md-block">
                <form>
                     <input type="text" class="form-control text-center bg-white typeahead" name="q"
                                   autocomplete="off"
                                   value="<?php echo e(request()->q); ?>"
                                   placeholder="<?php echo e(__('pharmacy.search_place')); ?>"/>
                        <div class="mb-2"></div>
                </form>
            </div>
            <div class="col-md-12 d-none d-md-block">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th><?php echo e(__('jobs.job_title')); ?> </th>
                            <th><?php echo e(__('jobs.salary')); ?> </th>
                            <th><?php echo e(__('jobs.created_at')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($jobs) == 0): ?>
                        <tr>
                            <td colspan="4"><?php echo e(app()->getLocale() == 'ar' ? 'لا توجد بيانات': 'No Jobs'); ?>

                        </tr>
                        <?php endif; ?>
                        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($job->job_name); ?></td>
                            <td>
                                <?php echo e($job->salary); ?> - <?php echo e($job->max_salary); ?>

                            </td>
                            <td><?php echo e($job->created_at->format('Y-m-d')); ?></td>
                            <td>
                                <div class="btn-group direction"> 
                                    <button class="btn btn-main p-2 pr-3 pl-3" data-info="<?php echo e($job); ?>" data-target="#jobs_modal" data-toggle="modal">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div> 
        </div> 
    </div>
</div>