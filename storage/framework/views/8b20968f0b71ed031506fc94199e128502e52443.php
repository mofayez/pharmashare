<div class="modal fade" id="showinfo_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-left">
                <div class="row direction">
                    <div class="col-md-12 text-left">
                        <input type="hidden" name="order_id" value="">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?php echo e(__('store.product_name')); ?>  </th>
                                <th><?php echo e(__('store.current_amount')); ?></th>
                                <th><?php echo e(__('store.required_amount')); ?></th>
                                <th><?php echo e(__('store.cost')); ?></th>
                            </tr>
                            </thead>
                            <tbody id="order_items">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>