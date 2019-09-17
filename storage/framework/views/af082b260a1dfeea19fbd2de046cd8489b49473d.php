<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    .badge-success, .badge-success[href]:focus, .badge-success[href]:hover {
        border-color: #009688;
        background-color: #009688;
        color: #fff;
    }

    .btn-default {
        background-color: #979797;
    }

    legend {
        width: auto;
        margin: 0 5px;
        background: #fff;
        background: #5341b9;
        color: #FFF;
        border-radius: 26px;
    }
</style>

<div class="card">
    
    <div class="card card-blog card-plain card-body ">

        <?php if(!count($all_cart)): ?>
            <img src="<?php echo e(asset('assets/img/empty-cart.png')); ?>" alt="">
            <h3><?php echo e(__('pharmacy.cart_null')); ?></h3>
        <?php endif; ?>
        <?php echo e(Form::open([
            'id'=>'form',
            'method'=>'post',
            'route'=>'submitCart'
        ])); ?>

        <?php $__currentLoopData = $all_cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <fieldset class="mb-1 position-relative"
                      style="background: linear-gradient(to right, rgba(255, 255, 255, 0.74), rgb(255, 255, 255));border: 1px solid #666;z-index: 99">
                <legend class="text-left m-5 p-1" style="border: 1px solid #666">
                    <span> <?php echo e($cart_item['store']->firstname . $cart_item['store']->lastname); ?>  </span>
                </legend>
                <ul class="text-left list-unstyled ">
                    <li class="list-inline-item w-100">

                        <div class="p-3 pt-0 table-scroll ">
                            <table class="table table-bordered ">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th><?php echo e(__('pharmacy.product_name')); ?></th>
                                    <th><?php echo e(__('pharmacy.status')); ?></th>
                                    <th> <?php echo e(__('pharmacy.cost')); ?></th>
                                    <th> <?php echo e(__('pharmacy.current_amount')); ?></th>
                                    <th width="170px"> <?php echo e(__('pharmacy.required_amount')); ?>  </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $cart_item['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="btn-group direction">
                                                <?php if(count($item->FOC) > 0): ?>
                                                    <button class="btn btn-info p-2" type="button" data-toggle="modal"
                                                            data-target="#all_discounts_modal"
                                                            data-discounts="<?php echo e(json_encode($item->FOC)); ?>">
                                                        <i class="now-ui-icons business_bulb-63"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button class="btn btn-danger p-2" type="button"
                                                        onclick="removeItem('<?php echo e($item->id); ?>')">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <span><?php echo e($item->drug->trade_name); ?></span> <br>
                                            (<?php echo e($item->drug->drugCategory->title); ?>)
                                        </td>
                                        <td>
                                            <?php if($item->available_quantity_in_packs): ?>
                                                <label class="btn-success btn-simple"
                                                       style="font-size: 12px;padding: 3px;"><?php echo e(__('pharmacy.available')); ?></label>
                                                <br>
                                            <?php else: ?>
                                                <label class="btn-danger btn-simple"
                                                       style="font-size: 12px;padding: 3px;"><?php echo e(__('pharmacy.out_stock')); ?>    </label>
                                                <br>
                                            <?php endif; ?>
                                            <?php if($item->isFeatured): ?>
                                                <label class="btn-success btn-simple ads-flash"
                                                       style="font-size: 12px;padding: 3px;"><?php echo e(__('pharmacy.ads')); ?>  </label>
                                            <?php endif; ?>
                                            <?php if(count($item->FOC) > 0): ?>
                                                <label class="btn-info btn-simple" data-toggle="modal"
                                                       data-target="#all_discounts_modal"
                                                       data-discounts="<?php echo e(json_encode($item->FOC)); ?>"
                                                       style="cursor:pointer;font-size: 12px;padding: 3px;">  <?php echo e(__('pharmacy.discount')); ?></label>
                                            <?php endif; ?>
                                            
                                        </td>
                                        <td>
                                            <?php echo e($item->offered_price_or_bonus); ?>

                                        </td>
                                        <td>
                                            <?php echo e($item->available_quantity_in_packs); ?>

                                        </td>
                                        <td>
                                            <div class="input-group my-group direction">
                                                <button type="button"
                                                        class="btn m-0 form-control border-0 p-0 incr-btn <?php if($item->available_quantity_in_packs == 0): ?> btn-default <?php else: ?> btn-main <?php endif; ?>">
                                                    <i class="now-ui-icons ui-1_simple-add"></i>
                                                </button>
                                                <input type="hidden" name="drug_store_id[]" value="<?php echo e($item->id); ?>">
                                                <input type="hidden" name="max_allowed[]"
                                                       value="<?php echo e($item->available_quantity_in_packs); ?>">
                                                <input type="number" class="form-control text-center bg-white"
                                                       name="count[]"
                                                       autocomplete="off"
                                                       <?php if($item->available_quantity_in_packs == 0): ?>
                                                       value="0">
                                                <?php else: ?>
                                                    value="<?php echo e($item->quantity ?? 1); ?>">
                                                <?php endif; ?>
                                                <button type="button"
                                                        class="btn m-0 form-control border-0 p-0 decr-btn btn-default">
                                                    <i class="now-ui-icons ui-1_simple-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
            </fieldset>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($all_cart)): ?>
            <div class="text-center  m-auto">
                <button class="btn btn-main" type="submit">
                    <?php echo e(__('pharmacy.submit_cart')); ?>

                    <i class="now-ui-icons shopping_bag-16"></i>
                </button>
                <button class="btn btn-danger" type="button" onclick="emptyCart()">
                    <?php echo e(__('pharmacy.empty_cart')); ?>

                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
            </div>
        <?php endif; ?>
        <?php echo e(Form::close()); ?>

    </div>
</div>