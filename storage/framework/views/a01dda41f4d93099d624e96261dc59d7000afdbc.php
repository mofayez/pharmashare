<div class="row">
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card card-blog card-plain card-body">
                <div class="row">
                    <div class="col-md-4 text-right">
                        <img src="<?php echo e($sale->store->image_path ? $sale->store->image_path : asset('assets/img/me.jpg')); ?>"
                             style="width: 180px" alt="">
                    </div>
                    <div class="col-md-8 text-left">
                        <h4>
                            <?php echo e(app()->getLocale() == 'ar' ? 'عرض جميع المبيعات الحالية' : 'Show All Sales'); ?>

                        </h4>
                        <ul class="list-unstyled">
                            <li>
                                <h5 dir="rtl">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'اسم التاجر' : 'Store name'); ?>:
                                    <span><?php echo e($sale->store->firstname . '  ' . $sale->store->lastname); ?></span>
                                </h5>
                            </li>
                            <li>
                                <h5 dir="rtl">
                                    <?php echo e(app()->getLocale() == 'ar' ? 'اسم العميل' : 'Pharmacy name'); ?>:
                                    <span><?php echo e($sale->pharmacy->firstname . '  ' . $sale->pharmacy->lastname); ?></span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    <?php echo e(app()->getLocale() == 'ar' ? '  رقم هاتف الصيدلية ' : 'Pharmacy phone number'); ?>:
                                    <span dir="ltr"><?php echo e($sale->pharmacy->prefix . '-' . $sale->pharmacy->phone); ?></span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    <?php echo e(app()->getLocale() == 'ar' ? '  عنوان الصيدلية ' : 'Pharmacy Address'); ?>:
                                    <span dir="ltr"><?php echo e($sale->pharmacy->full_address); ?></span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    <?php echo e(app()->getLocale() == 'ar' ? 'التاريخ' : 'Date'); ?>:
                                    <span><?php echo e($sale->created_at->format('Y-m-d')); ?> </span>
                                </h5>
                            </li>
                            <li>
                                <h5>
                                    <?php echo e(app()->getLocale() == 'ar' ? 'الحالة' : 'Status'); ?>:
                                    <?php if(app()->getLocale() == 'ar'): ?>
                                        <span><?php echo e($sale->status->display_name_ar); ?> </span>
                                    <?php else: ?>
                                        <span><?php echo e($sale->status->display_name_en); ?> </span>
                                    <?php endif; ?>
                                </h5>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12 direction">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> <?php echo e(app()->getLocale() == 'ar' ? 'اسم  المنتج' : ' Product name '); ?>  </th>
                                <th><?php echo e(app()->getLocale() == 'ar' ? '  الكمية المطلوبة' : 'Amount'); ?>: </th>
                                <th><?php echo e(app()->getLocale() == 'ar' ? 'تكلفة الوحدة  ' : 'Unit Price'); ?></th>
                                <th><?php echo e(app()->getLocale() == 'ar' ? 'الاجمالي' : '  Total'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $sale->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($detail->drugStore->id); ?></td>
                                    <td><?php echo e($detail->drugStore->drug->trade_name); ?>

                                        <br> 
                                        <?php
                                            $discount = null;
                                            foreach(collect($detail->drugStore->FOC)->sortByDesc('foc_quantity') as $foc){ 
                                                if($detail->quantity >= $foc->foc_quantity){
                                                    $discount = $foc;
                                                    echo '<span class="text-danger">';
                                                    echo app()->getLocale() == 'ar' ? 'قيمة الخصم : ' . $foc->foc_discount .'%' : 'Discount Is :' . $foc->foc_discount .'%';
                                                    echo '</span>';
                                                    break;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo e($detail->quantity); ?></td>
                                    <td><?php echo e($detail->drugStore->offered_price_or_bonus); ?></td>
                                    <td>
                                        <?php if($discount): ?>
                                            <del class="text-danger"><?php echo e($detail->drugStore->offered_price_or_bonus * $detail->quantity); ?></del><br>
                                            <?php echo e(($detail->drugStore->offered_price_or_bonus - ($detail->drugStore->offered_price_or_bonus * ($discount->foc_discount/100))) * $detail->quantity); ?>

                                        <?php else: ?>
                                            <?php echo e($detail->drugStore->offered_price_or_bonus * $detail->quantity); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    <?php echo e(app()->getLocale() == 'ar' ? 'الاجمالي' : '  Total'); ?>  
                                </td>
                                <td class="bg-warning">
                                    <?php echo e($sale->total_cost); ?>

                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                     <div class="col-md-4">
                        <?php echo e(app()->getLocale() == 'ar' ? ' هذه الاسعار غير شامله ضريبه المبيعات ' : 'Vat Not Included '); ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>