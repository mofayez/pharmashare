<!-- Button trigger modal -->
<button type="button" id="update_product_trigger" class="btn btn-primary" data-toggle="modal" data-target="#update_product_modal" style="display:none">
  Launch demo modal
</button>
<div class="modal fade" id="update_product_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-left">
                <div class="row direction">
                     <div class="cards col-md-12 card-contacst card-raiseds" style="min-height: 350px">
                            <?php echo e(Form::open([
                                'route'=>'submitFavourite',
                                'method'=>'post',
                                'class'=>'fav_form'
                            ])); ?> 
                            <div class="card-bodys">

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <h4 id="trade_name"></h4>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class=" table-scroll">
                                            <table class="table table-bordered table-scroll">
                                                <tr>
                                                    <td><?php echo e(__('store.origin')); ?></td>
                                                    <td><?php echo e(__('store.manufacturer')); ?></td>
                                                    <td><?php echo e(__('store.strength')); ?></td>
                                                    <td><?php echo e(__('store.packet_size')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td id="active_ingredient"></td>
                                                    <td id="manufacturer"></td>
                                                    <td id="strength"></td>
                                                    <td id="pack_size"></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="pharmashare_code" value="">
                                <input type="hidden" name="fav_id" value="">
                                <input type="hidden" name="form" value="">
                                <input type="hidden" name="trade_name" value="">
                                <input type="hidden" name="pack_size" value="">
                                <input type="hidden" name="active_ingredient" value="">
                                <input type="hidden" name="manufacturer" value="">
                                <input type="hidden" name="strength" value="">

                                <div class="row">
                                    <div class="col-md-4 text-left">
                                        <div class="form-group">
                                            <label><?php echo e(__('store.amount')); ?></label>
                                            <input type="text" class="form-control"
                                                   name="available_quantity_in_packs"
                                                   placeholder="<?php echo e(__('store.amount')); ?>">
                                            <span class="error_amount text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-left">
                                        <div class="form-group">
                                            <label><?php echo e(__('store.cost')); ?></label>
                                            <input name="offered_price_or_bonus" type="text" class="form-control"
                                                   placeholder="<?php echo e(__('store.cost')); ?>">
                                            <span class="error_cost text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-left">
                                        <div class="form-group">
                                            <label><?php echo e(__('store.min_amount')); ?></label>
                                            <input name="minimum_order_value_or_quantity" type="text"
                                                   class="form-control"
                                                   placeholder="<?php echo e(__('store.min_amount')); ?>">
                                            <span class="error_min_amount text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-12 text-center">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-main  pull-right">
                                                <?php echo e(app()->getLocale() == 'ar' ? 'تحديث' : 'Update'); ?>

                                            </button> 
                                            
                                            <button type="button" id="close_modal" class="btn btn-secondary pull-right" data-dismiss="modal">
                                                <?php echo e(app()->getLocale() == 'ar' ? 'اغلاق' : 'Close'); ?>

                                            </button>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php echo e(Form::close()); ?>

                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group direction">
                    <!--<button class="btn btn-main">-->
                    <!--    قبول الطلب-->
                    <!--    <i class="now-ui-icons ui-1_check"></i>-->
                    <!--</button>-->
                    <!--<button class="btn btn-danger">-->
                    <!--    رفض الطلب-->
                    <!--    <i class="now-ui-icons ui-1_simple-remove"></i>-->
                    <!--</button>-->
                </div>
            </div>
        </div>
    </div>
</div>
