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

                                (<span id="locationupto"></span>)  <?php echo e(__('pharmacy.km')); ?>

                            </label>
                            <div id="sliderLocation" class="slider slider-info"></div>
                            <br>
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