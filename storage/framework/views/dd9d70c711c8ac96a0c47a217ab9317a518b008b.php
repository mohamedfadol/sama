<style>
table tbody {display: block;max-height: 150px;overflow-y: scroll;}
table thead, table tbody tr {display: table;width: 100%;table-layout: fixed;}
.clock {font-weight: bold;}
.small-box p {font-size: 12px;font-size: 12px;text-wrap: nowrap;display: inline;padding: 5px;background-color: lightskyblue;border-radius: 3px;}
.small-box .ready{background-color: #60c9a6;}
.share-button{padding: 5px;}
.vl{border-left: 4px solid red;height: 200px;position: absolute;left: 50%;margin-left: -3px;top: 0;}
.heart {animation: animateHeart 1.2s infinite;}
@keyframes animateHeart {0% {transform: scale(0.8); }50% {transform: scale(0.8);}100% {transform: scale(1.5);}}
</style>

<div class="row">
    <div class="col-lg-6 col-md-4 col-xs-6 order_div">
        <h2 class="ready_order text-center">
            <?php echo app('translator')->get('restaurant.ready_orders'); ?>
        </h2>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 col-xs-6">
                <div class="small-box bg-gray">
                    <div class="inner">
                    <table>
                            <thead>
                            <tr class="text-center">
                                <td> <div class="clock heart"><p class="ready">#<?php echo e($order->invoice_no, false); ?></p></div> </td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class='share-button bg-green text-center'><i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.ready_to_reserve'); ?></div>
                </div>
            </div>
            <?php if($loop->iteration % 4 == 0): ?>
                <div class="hidden-xs">
                    <div class="clearfix"></div>
                </div>
            <?php endif; ?>
            <?php if($loop->iteration % 2 == 0): ?>
                <div class="visible-xs">
                    <div class="clearfix"></div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-md-12">
            <h4 class="text-center"><?php echo app('translator')->get('restaurant.no_orders_found'); ?></h4>
        </div>
        <?php endif; ?>
    </div>

    <div class="vl"></div>

    <div class="col-lg-6 col-md-4 col-xs-6 order_div">
        <h2 class="ready_order text-center"><?php echo app('translator')->get('restaurant.orders_are_being_prepared'); ?></h2>
        <?php $__empty_1 = true; $__currentLoopData = $ervedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 col-xs-6">
                <div class="small-box bg-gray">
                    <div class="inner">
                        <table>
                            <thead>
                            <tr class="text-center">
                                <td> <div class="clock"><p class="clock-time">#<?php echo e($order->invoice_no, false); ?></p></div> </td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class='share-button bg-info text-center'>
                        <i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.prepared'); ?>            
                    </div>
                </div>
            </div>
            <?php if($loop->iteration % 4 == 0): ?>
                <div class="hidden-xs">
                    <div class="clearfix"></div>
                </div>
            <?php endif; ?>
            <?php if($loop->iteration % 2 == 0): ?>
                <div class="visible-xs">
                    <div class="clearfix"></div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-md-12">
                <h4 class="text-center"><?php echo app('translator')->get('restaurant.no_orders_found'); ?></h4>
            </div>
        <?php endif; ?>
    </div>
</div>



 

 <?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/partials/hole_view_details.blade.php ENDPATH**/ ?>