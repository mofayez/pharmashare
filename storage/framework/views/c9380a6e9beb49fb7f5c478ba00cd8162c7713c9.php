<div class="row" style="margin-top: -140px;z-index: 9;">
    <div style="position: fixed;z-index: 9;right: 40px;bottom: 40px;">
        <a href="<?php echo e(route('getShowFavouritesView')); ?>" class="btn btn-main" id="list_btn">
            <?php echo e(app()->getLocale() == 'ar' ? 'قائمتي' : 'My List'); ?>

            (<span id="favourites-count"><?php echo e(count($favourites) ?? 0); ?></span>)
        </a>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('getAddProductView')); ?>">
                            <?php echo e(__('store.add_one_product')); ?>

                            <i class="now-ui-icons shopping_bag-16"></i>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="<?php echo e(route('getAddProductView')); ?>">-->
                    <!--        <?php echo e(__('store.upload_csv_sheet')); ?>-->
                    <!--        <i class="now-ui-icons arrows-1_cloud-upload-94"></i>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="nav-item ">
                        <a class="nav-link active show" href="<?php echo e(route('getAddToFavouritesView')); ?>">
                            <?php echo e(__('store.name_first')); ?>

                            <i class="now-ui-icons ui-2_favourite-28"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card card-blog card-plain card-body direction">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-right">
                            <label> <?php echo e(__('pharmacy.origin')); ?> </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="5"
                                   checked/>
                        </div>
                        <div class="text-right">
                            <label> <?php echo e(__('pharmacy.product_category')); ?> </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="4"
                                   checked/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control text-center bg-white typeahead" name="drug_name"
                               autocomplete="off"
                               placeholder="<?php echo e(__('pharmacy.search_place')); ?> by (Name , Pharma Code , Active Ingredient , Manufacturer)"/>
                        <div class="mb-2"></div>
                    </div>
                    <div class="col-md-4"> 
                        <div class="text-left">
                            <input type="checkbox" class="bootstrap-switch" data-column="2"
                                   checked/>
                            <label> <?php echo e(__('pharmacy.manufacturer')); ?> </label>
                        </div>
                        <div class="text-left">
                            <input type="checkbox" class="bootstrap-switch" data-column="3"
                                   checked/>
                            <label> <?php echo e(__('pharmacy.packet_size')); ?> </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h4 class="m-0"><?php echo e(app()->getLocale() == 'ar' ? 'اجمالى عدد الادوية' : 'All Drugs Count'); ?> : <span class="text-danger"><?php echo e($drugs_count); ?></span> </h4>
                        
                        <br/>
                    </div>
                    <div class="col-md-6 text-right">
                            <label> <?php echo e(app()->getLocale() == 'ar' ? '  اضافة اكثر من منتج للمفضلة  ' : 'Bulk add to store'); ?></label> 
                            <input type="checkbox" class="bootstrap-switch" name="bulk" value='1'/>
                    </div>
                </div>
                <div class="col-md-12" style="overflow:scroll">
                <table class="table table-bordered" id="myTable">
                    <thead>
                    <tr class="text-left">
                        <th></th>
                        <th><?php echo e(__('pharmacy.bar_code')); ?></th>
                        <th width="35%"><?php echo e(__('pharmacy.product_name')); ?></th>
                        <th><?php echo e(__('pharmacy.manufacturer')); ?></th>
                        <th><?php echo e(__('pharmacy.packet_size')); ?></th>
                        <th><?php echo e(__('pharmacy.product_category')); ?></th>
                        <th><?php echo e(__('pharmacy.origin')); ?></th>
                        <th><?php echo e(__('pharmacy.strength')); ?></th>
                    </tr>
                    </thead>
                    <tbody> 
                        <?php $__currentLoopData = $drugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <button class="btn btn-warning add-to-fav p-2 pl-3 pr-3" <?php if(in_array($drug->id , $favourites->toArray())): ?> disabled <?php endif; ?>  data-item-id="<?php echo e($drug->id); ?>" data-item-pack_size="<?php echo e($drug->pack_size); ?>" data-item-strength="<?php echo e($drug->strength); ?>" data-item-active_ingredient="<?php echo e($drug->active_ingredient); ?>" data-item-trade_name="<?php echo e($drug->trade_name); ?>" data-item-pharmashare_code="<?php echo e($drug->pharmashare_code); ?>" data-item-manufacturer="<?php echo e($drug->manufacturer); ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">
                                   <?php echo e(app()->getLocale() == 'ar' ? 'اضافة للمخزن' : 'Add To Store'); ?> 
                                </button>
                            </td>
                            <td><?php echo e($drug->pharmashare_code); ?></td>
                            <td>
                                <h6 class="m-0 p-0" style="text-align: left">
                                    <?php echo e($drug->trade_name); ?>

                                </h6>
                            </td>
                            <td><?php echo e($drug->manufacturer); ?></td>
                            <td><?php echo e($drug->pack_size); ?></td>
                            <td><?php echo e($drug->form); ?></td>
                            <td><?php echo e($drug->active_ingredient); ?></td>
                            <td><?php echo e($drug->strength); ?></td> 
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>