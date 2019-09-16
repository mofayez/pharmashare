<div class="modal fade" id="edit_drugs_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-left">
                <form id="edit_form" method="post"> 
                    <?php echo e(csrf_field()); ?>

                    <div class="row direction">
                        <input name="id" type="hidden" value="">
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label><?php echo e(__('admin.product_category')); ?>  </label>
                                <input type="typeahead"
                                       autocomplete="off" class="form-control typeahead" name="form"
                                       value="<?php echo e(old('form')); ?>">
                            </div>
                            <?php if($errors->has('form')): ?>
                                <span class="text-danger"><?php echo e($errors->first('form')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 text-left">
                            <div class="form-group">
                                <label><?php echo e(__('admin.product_name')); ?></label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="trade_name"
                                       value="<?php echo e(old('trade_name')); ?>">
                            </div>
                            <?php if($errors->has('trade_name')): ?>
                                <span class="text-danger"><?php echo e($errors->first('trade_name')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 text-left">
                            <div class="form-group">
                                <label><?php echo e(__('admin.bar_code')); ?> </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="pharmashare_code"
                                       value="<?php echo e(old('pharmashare_code')); ?>">
                            </div>
                            <?php if($errors->has('pharmashare_code')): ?>
                                <span class="text-danger"><?php echo e($errors->first('pharmashare_code')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label>  <?php echo e(__('admin.packet_size')); ?> </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="pack_size" value="<?php echo e(old('pack_size')); ?>">
                            </div>
                            <?php if($errors->has('pack_size')): ?>
                                <span class="text-danger"><?php echo e($errors->first('pack_size')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label><?php echo e(__('admin.origin')); ?>   </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="active_ingredient"
                                       value="<?php echo e(old('active_ingredient')); ?>">
                            </div>
                            <?php if($errors->has('active_ingredient')): ?>
                                <span class="text-danger"><?php echo e($errors->first('active_ingredient')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3 text-left">
                            <div class="form-group">
                                <label> <?php echo e(__('admin.manufacturer')); ?> </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="manufacturer"
                                       value="<?php echo e(old('manufacturer')); ?>">
                            </div>
                            <?php if($errors->has('manufacturer')): ?>
                                <span class="text-danger"><?php echo e($errors->first('manufacturer')); ?></span>
                            <?php endif; ?>
                        </div> 
                        <div class="col-md-2 text-left">
                            <div class="form-group">
                                <label><?php echo e(__('admin.strength')); ?> </label>
                                <input type="text" class="form-control"
                                       autocomplete="off" name="strength" value="<?php echo e(old('strength')); ?>">
                            </div>
                            <?php if($errors->has('strength')): ?>
                                <span class="text-danger"><?php echo e($errors->first('strength')); ?></span>
                            <?php endif; ?>
                        </div>
    
                        <div class="text-center col-md-12  m-auto">
                            <button class="btn btn-main">
                                <?php echo e(__('admin.edit')); ?>

                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </button> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
