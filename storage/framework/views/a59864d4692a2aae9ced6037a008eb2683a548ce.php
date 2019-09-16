<div class="modal fade" id="drugs_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="now-ui-icons ui-1_simple-remove"></i>
				</button>
				<h4 class="title title-up">
				    <?php echo e(__('profile.drugs_approved')); ?>

				</h4>
			</div>
			<div class="modal-body">
			    <div class="row">
			        <div class="col-md-6 text-left"> 
                        <h4>
                            <?php echo e(__('settings.unapproved_products')); ?> :
                            <span id="unapproved_drugs_count">0</span>
                        </h4>
			        </div>
			        <div class="col-md-6 text-left"> 
                        <h4>
                            <?php echo e(__('settings.approved_products')); ?> :
                            <span id="approved_drugs_count">0</span>
                        </h4>
			        </div>
			        <div class="col-md-12">
			            <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#approved" role="tab" aria-selected="false">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'الادوية تم قبولها': 'Approved Drugs'); ?>

                                    <i class="now-ui-icons shopping_bag-16"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#upapproved" role="tab" aria-selected="true">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'الادوية قيد الانتظار  ' : 'Upapproved Drugs'); ?>

                                    <i class="now-ui-icons shopping_bag-16"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content text-center">
                            <div class="tab-pane" id="approved" role="tabpanel">
                                 
                			    <div class="table-scroll direction"> 
                    				<table class="table table-bordered" id="table_approved_drug_detail">
                    				    <tr>
                    				        <td>-</td>
                    				        <td>-</td>
                    				        <td>-</td>
                    				    </tr>
                    				</table>
                			    </div>
                            </div>
                            <div class="tab-pane active show" id="upapproved" role="tabpanel">
                                
                			    <div class="table-scroll direction"> 
                    				<table class="table table-bordered" id="table_drug_detail">
                    				    <tr>
                    				        <td>-</td>
                    				        <td>-</td>
                    				        <td>-</td>
                    				    </tr>
                    				</table>
                			    </div>
                            </div>
                        </div>
			        </div>
			    </div>
			</div>
			<div class="modal-footer"> 
				<button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('profile.close')); ?></button>
			</div>
		</div>
	</div>
</div>