<div id="content" class="section direction">
    <div class="container-fluid">
        <div class="button-container">
            &nbsp;<br>
            &nbsp;<br>
        </div>

        <div class="row mt-3">
            
                
            
            <style>
                select{
                    direction: ltr!important;
                }
                .bootstrap-select.btn-group .dropdown-menu li a span.text{
                    direction: ltr!important;
                }
                .my-group select {
                    height: auto !important;
                    max-width: 25% !important;
                }

                .my-group .btn-main {
                    height: auto !important;
                    max-width: 15% !important;
                }
            </style>
            <div class="col-md-12" style="margin-top: -40px;position: relative;z-index: 999;">
                 <div class="row">
                     <div class="col-md-2"></div>
                     <div class="col-md-8">
                         <div class="input-group my-group">
                             <select id="lunch" name="drug_category_id" class="form-control bg-white pl-1 pr-1 text-center" dir="ltr">
                                 <option value="0">ALL</option>
                                 <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                             <input type="hidden" name="radius">
                             <input type="hidden" name="min_price">
                             <input type="hidden" name="max_price">
                             <input type="text" class="form-control text-left bg-white typeahead" name="drug_name" autocomplete="off"
                                    placeholder="<?php echo e(__('pharmacy.search_place')); ?>"/>
                             <button class="btn btn-default btn-main m-0 form-control border-0" onclick="updateTable()" type="submit" style="padding:0">
                                <?php echo e(__('pharmacy.search')); ?>

                             </button>
                         </div>
                     </div>
                 </div>
            </div>
            <div class="col-md-12 text-center" id="table_content">
                <?php echo $__env->make("pages.store.templates.center_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-3 text-right" style="display: none" id="filter_content">
                <?php echo $__env->make("pages.store.templates.left_side", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>

    </div>

</div>