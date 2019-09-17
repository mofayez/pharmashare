<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card card-blog card-plain card-body pt-0">
                <div class="card-body bg-white mr-2 ml-2">
                    <h4 class="text-left text_purple_gradient"><?php echo e(__('pharmacy.filter')); ?>  </h4>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <label class=" float-left">  <?php echo e(__('pharmacy.product_name')); ?> </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="1"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"><?php echo e(__('pharmacy.cost')); ?> </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="2"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"> <?php echo e(__('pharmacy.manufacturer')); ?> </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="3"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"><?php echo e(__('pharmacy.origin')); ?>    </label>
                            <input type="checkbox" disabled class="bootstrap-switch" data-column="4"
                                   checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left">  <?php echo e(__('pharmacy.store_name')); ?>  </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="5" checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"><?php echo e(__('pharmacy.strength')); ?> </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="6" checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"><?php echo e(__('pharmacy.packet_size')); ?>   </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="7" checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"><?php echo e(__('pharmacy.rate')); ?> </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="8" checked/>
                        </div>
                        <div class="col-md-12 text-right">
                            <label class=" float-left"><?php echo e(__('pharmacy.product_category')); ?> </label>
                            <input type="checkbox" class="bootstrap-switch" data-column="9" checked/>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  <?php echo e(__('pharmacy.price_avg')); ?>

                                (<span id="pricefrom"></span> - <span id="priceto"></span>)
                            </label>
                            <div id="sliderPrice" class="slider slider-warning"></div>
                            <br>
                        </div>
                        <div class="col-md-12 text-left">
                            <label><?php echo e(__('pharmacy.location_avg')); ?>

                                (<span id="locationupto"></span>) <?php echo e(__('pharmacy.km')); ?>

                            </label>
                            <div id="sliderLocation" class="slider slider-info"></div>
                            <br>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label><?php echo e(__('pharmacy.origin')); ?></label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block" dir="ltr"
                                    data-size="7" name="active_ingredient">
                                <option value="0">All</option>
                                <?php $__currentLoopData = $active_ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active_ingredient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($active_ingredient->active_ingredient); ?>"><?php echo e($active_ingredient->active_ingredient); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label><?php echo e(__('pharmacy.manufacturer')); ?></label>
                            <select class="selectpicker" name="manufacturer"
                                    data-style="btn btn-main btn-round btn-block"
                                    dir="ltr"
                                    data-size="7" name="manufacturer">
                                <option value="0">All</option>
                                <?php $__currentLoopData = $manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($manufacturer->manufacturer); ?>"><?php echo e($manufacturer->manufacturer); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label><?php echo e(__('pharmacy.strength')); ?> </label>
                            <select class="selectpicker" name="strength" data-style="btn btn-main btn-round btn-block"
                                    dir="ltr"
                                    data-size="7">
                                
                                <option value="0">All</option>
                                <?php $__currentLoopData = $strengths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strength): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($strength->strength); ?>"><?php echo e($strength->strength); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  <?php echo e(__('pharmacy.payment_type')); ?> </label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block"
                                    data-size="7" name="payment_type" dir="ltr">
                                <option value="0">All</option>
                                <?php if(app()->getLocale() == 'ar'): ?>
                                    <option value="1">الدفع عن التوصيل</option>
                                    <option value="2">دفع مؤجل</option>
                                <?php else: ?>
                                    <option value="1">Cash on delivery</option>
                                    <option value="2">Delayed check</option>
                                <?php endif; ?>
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  <?php echo e(app()->getLocale() == 'ar' ? 'بها اعلان ممول' : 'Is Featured'); ?> </label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block"
                                    data-size="8" name="is_featured" dir="ltr">
                                <?php if(app()->getLocale() == 'ar'): ?>
                                    <option value="0"> الكل</option>
                                    <option value="1">اعلان ممول</option>
                                <?php else: ?>
                                    <option value="0"> All</option>
                                    <option value="1">Is Featured</option>
                                <?php endif; ?>
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  <?php echo e(app()->getLocale() == 'ar' ? 'بها خصومات' : 'Has Discount'); ?> </label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block"
                                    data-size="7" name="foc" dir="ltr">
                                <?php if(app()->getLocale() == 'ar'): ?>
                                    <option value="0"> الكل</option>
                                    <option value="1">بها خصومات</option>
                                <?php else: ?>
                                    <option value="0">All</option>
                                    <option value="1">Has Discount</option>
                                <?php endif; ?>
                            </select>
                            <hr>
                        </div>
                        <div class="col-md-12 text-left">
                            <label>  <?php echo e(app()->getLocale() == 'ar' ? 'ترتيب بواسطة  ' : 'SortBy'); ?> </label>
                            <select class="selectpicker" data-style="btn btn-main btn-round btn-block"
                                    data-size="7" name="sort_by" dir="ltr">
                                <?php if(app()->getLocale() == 'ar'): ?>
                                    <option value=""> الكل</option>
                                    <option value="price">السعر</option>
                                    <option value="bounce">الخصومات</option>
                                    <option value="reward_points">نقاط المكافئة</option>
                                    <option value="store">المتجر</option>
                                    <option value="active_ingredient">المادة الفعالة</option>
                                    <option value="brand">البراند</option>
                                    <option value="manufacturer">المصنع</option>
                                <?php else: ?>
                                    <option value="">All</option>
                                    <option value="price">Price</option>
                                    <option value="bounce">Bounce</option>
                                    <option value="reward_points">Reward Points</option>
                                    <option value="store">Store</option>
                                    <option value="active_ingredient">Store</option>
                                    <option value="brand">Brand</option>
                                    <option value="manufacturer">Manufacturer</option>
                                <?php endif; ?>
                            </select>
                            <hr>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-main" onclick="updateTable()"><?php echo e(__('pharmacy.filter')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>