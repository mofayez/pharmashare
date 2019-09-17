<div class="modal fade" id="rates_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-left">
                <?php echo e(Form::open([
                    'method'=>'post',
                    'route'=>'RateStore'
                ])); ?>

                <div class="row direction">
                    
                        
                    
                    <div class="stars stars-example-fontawesome m-auto text-center">
                        <select id="example-fontawesome" name="rating" autocomplete="off">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <h3><span id="current_rate">0</span>/5</h3>
                    </div>
                    <input type="hidden" name="store_id">
                    <input type="hidden" name="rating" value="0">
                    <div class="col-md-12">
                        <label> <?php echo e(__('pharmacy.comment')); ?></label>
                        <textarea name="comment" class="form-control" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-main">
                        <i class="now-ui-icons"></i><?php echo e(__('pharmacy.rate')); ?>

                    </button>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
