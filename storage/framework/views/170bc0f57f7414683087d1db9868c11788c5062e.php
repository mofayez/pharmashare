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
<div class="card" style="min-height: 300px">
    <div class="card card-blog card-plain card-body">

        <div class="row">
            <div class="col-md-8">
                <h2><?php echo e(__('jobs.all_jobs')); ?> </h2> 
            </div>
            <div class="col-md-4">
                <?php if($user->role_id != 4): ?>
                    <div class="float-right">
                       <a href="<?php echo e(route('getPostJobsView')); ?>" class="btn btn-main">
                            <?php echo e(__('jobs.add_job')); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-12 table-scroll">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th><?php echo e(__('jobs.job_title')); ?> </th>
                        <th><?php echo e(__('jobs.salary')); ?> </th>
                        <th><?php echo e(__('jobs.created_at')); ?>   </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($job->job_name); ?></td>
                            <td>
                                <?php echo e($job->salary); ?> - <?php echo e($job->max_salary); ?>

                            </td>
                            <td><?php echo e($job->created_at->format('Y-m-d')); ?></td>
                            <td>
                                <div class="btn-group direction">
                                    <a href="<?php echo e(route('getEditJob',['id'=>$job->id])); ?>"
                                       class="btn btn-info p-2 pr-3 pl-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteJob('<?php echo e($job->id); ?>')" class="btn btn-danger p-2 pr-3 pl-3">
                                        <i class="now-ui-icons ui-1_simple-remove"></i>
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