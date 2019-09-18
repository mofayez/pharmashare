<div class="modal fade" id="rates_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-left">
                <div class="row direction">
                    <div class="col-md-12 text-center">
                        <div id="ratings"></div>
                    </div>
                    <div class="col-md-12">
                        <label> تعليق</label>
                        <textarea name="comment" class="form-control" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-main">
                        <i class="now-ui-icons"></i> تقييم
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="all_packages_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body text-center">
                <?php echo e(Form::open([
                    'method'=>'post',
                    'route'=>'submitRedeem',
                ])); ?>

                <div class="row direction">
                    <div class="col-md-12 text-left">
                        <ul id="redeem_content" class="list-unstyled"></ul>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-main">
                            <?php echo e(__('store.add')); ?>

                        </button>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>