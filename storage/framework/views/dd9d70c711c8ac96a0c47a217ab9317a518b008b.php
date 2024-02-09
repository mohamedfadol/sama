<style>
table tbody {display: block;max-height: 150px;overflow-y: scroll;}
table thead, table tbody tr {display: table;width: 100%;table-layout: fixed;}
.clock {font-weight: bold; background-color: #8B8DE7; padding: 5px; font-size: 20px}
.small-box p {font-size: 12px;font-size: 12px;text-wrap: nowrap;display: inline;padding: 5px;background-color: lightskyblue;border-radius: 3px;}
.small-box .ready{background-color: #60c9a6;}
.share-button{padding: 5px;}
.vl{border-left: 2px solid black;height: -webkit-fill-available;position: absolute;left: 50%;top: 0;} 
</style>

<div class="row">
    <div class="col-lg-6 col-md-4 col-xs-6 order_div">
        <h1 class="ready_order text-center">
            <?php echo app('translator')->get('restaurant.ready_orders'); ?>
        </h1>
        <hr style="border-bottom: 2px solid black; ">
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 col-xs-3">
                <div class="small-box bg-gray">
                    <div class="inner">
                    <table>
                            <thead>
                            <tr class="text-center clock-time">
                                <td class="clock"> #<?php echo e($order->invoice_no, false); ?> </td>
                            </tr>
                            </thead>
                        </table>
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
        <?php endif; ?>
    </div>

    <div class="vl"></div>

    <div class="col-lg-6 col-md-4 col-xs-6 order_div">
        <h1 class="ready_order text-center"><?php echo app('translator')->get('restaurant.orders_are_being_prepared'); ?></h1>
        <hr style="border-bottom: 2px solid black; ">
        <?php $__empty_1 = true; $__currentLoopData = $resrvedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-md-3 col-xs-3">
                <div class="small-box bg-gray">
                    <div class="inner">
                        <table>
                            <thead>
                            <tr class="text-center clock-time ">
                                <td class="clock">  #<?php echo e($order->invoice_no, false); ?> </td>
                            </tr>
                            </thead>
                        </table>
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
        <?php endif; ?>
    </div>
</div>



 

 <?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/partials/hole_view_details.blade.php ENDPATH**/ ?>