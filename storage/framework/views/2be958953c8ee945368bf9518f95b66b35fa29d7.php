<style>
table tbody {display: block;max-height: 150px;overflow-y: scroll;}
table thead, table tbody tr {display: table;width: 100%;table-layout: fixed;}
.clock {font-weight: bold;}
.small-box p {font-size: 13px;}
.share-button{display:inline-block;display: flex;justify-content: space-between;}
.order-status {border: 2px solid none;}
.order-status-pending {border: 2px solid red;}
.order-status-servied {border: 2px solid green;}
.light-gray{background-color: #6d97ea!important;}
.white {color: #fff;}
.light-orang {color: #000;background-color: #c4bc6c!important;}
.new {
    padding: 5px;
    background-color: #d73434;
    border-radius: 16px;
    border: 1px dashed;
}
.t-number {
    padding: 5px;
    background-color: #5EA85E;
    border-radius: 13px;
    border: 1px dashed;
}
.heart {width: 20px;animation: animateHeart 1.2s infinite;}
@keyframes animateHeart {0% {transform: scale(0.5); }50% {transform: scale(0.5);}100% {transform: scale(1);}}

</style>
<?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <?php
            $count_sell_line = count($order->sell_lines);
            $count_cooked = count($order->sell_lines->where('res_line_order_status', 'cooked'));
            $count_served = count($order->sell_lines->where('res_line_order_status', 'served'));
            $count_returned = count($order->sell_lines->where('res_line_order_status', 'returned'));
            $count_null = count($order->sell_lines->where('res_line_order_status', null));
            $order_status =  'received';
            if($count_cooked == $count_sell_line) {
                    $order_status =  'cooked';
            } else if($count_served == $count_sell_line) {
                    $order_status =  'served';
            } else if ($count_served > 0 && $count_served < $count_sell_line) {
                    $order_status =  'partial_served';
            } else if ($count_returned) {
                    $order_status =  'returned';
            }
            else if ($count_null) {
                $order_status =  'new';
            }
            
        ?>
	<div class="col-md-3 col-xs-6 order_div" >
    
		<div class="small-box 
            <?php if($order_status == 'returned'): ?> light-orang white <?php endif; ?> <?php if($order_status == 'served'): ?> bg-gray <?php else: ?> light-gray white <?php endif; ?> ">
            <div class="inner text-center" style="text-align: -webkit-center;">
                <?php if($order_status  == 'new'): ?>
                    <div class="heart">
                        <span class="new white"><?php echo app('translator')->get('restaurant.new'); ?></span> 
                    </div>
                <?php endif; ?>
                <?php if($order_status  == 'returned'): ?>
                    <div class="heart">
                        <span class="new white"><?php echo app('translator')->get('restaurant.returned'); ?></span> 
                    </div>
                <?php endif; ?>
            <table class="table no-margin table-bordered table-slim " style="width: 100%;">
                <thead class=" <?php echo e($order_status  == 'served' ? "order-status-servied" : "order-status-pending", false); ?>" >
                    <tr>
                        <td><?php echo e(__('restaurant.table_no'), false); ?>  <span <?php if(!empty($order->table_name)): ?> class="t-number" <?php endif; ?> ><?php echo e($order->table_name, false); ?></span> </td>
                        <td>#<?php echo e($order->invoice_no, false); ?></td>
                        <td> <div class="clock"><p class="clock-time"></p></div> </td>
                    </tr>
                </thead>
                <thead>
                    <tr <?php if(empty($for_ledger)): ?> class="bg-green" <?php endif; ?>>
                        <th><?php echo e(__('sale.product'), false); ?></th>
                        <th><?php echo e(__('sale.qty'), false); ?></th>
                        <th><?php echo e(__('restaurant.notes'), false); ?></th>
                        <th><?php echo e(__('restaurant.status'), false); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr> 
                            <td><?php echo e($sell_line->product->name, false); ?></td>
                            <td><?php echo e($sell_line->quantity, false); ?></td>
                            <td><?php echo e($sell_line->sell_line_note, false); ?></td>
                            <td style="padding: 2px;">
                                <?php if($sell_line->res_line_order_status  != 'cooked'): ?>     
                                    <span class="btn btn-danger" style="padding: 2px;"><i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.not_done'); ?></span>
                                <?php else: ?>
                                    <span class="btn btn-primary" style="padding: 2px;"><i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.done'); ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>  
            </div>
            <div class='share-button'>
                <?php if(is_null($sell_line->res_line_order_status) || empty($sell_line->res_line_order_status)): ?>     
                    <a href="#" class="btn btn-sm small-box-footer bg-primary mark_as_served_btn" 
                        data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\OrderController::class, 'markAsServed'], [$sell_line->id]), false); ?>">
                            <i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.order_as_served'); ?></a> 
                <?php elseif($sell_line->res_line_order_status  != 'cooked'): ?>
                    <a href="#" class="btn btn-sm small-box-footer bg-yellow mark_as_cooked_btn" 
                        data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'markAsCooked'], [$sell_line->id]), false); ?>">
                            <i class="fa fa-check white"></i> <?php echo app('translator')->get('restaurant.mark_cooked'); ?></a>
                <?php endif; ?>
                    <a href="#" class="btn btn-sm small-box-footer bg-info text-white btn-modal" 
                        data-href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$order->id]), false); ?>" 
                            data-container=".view_modal"><?php echo app('translator')->get('restaurant.order_details'); ?> 
                                <i class="fa fa-arrow-circle-right"></i></a>  
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

<script> 
     
        var startTimeInSeconds = (10 * 3600) - (58 * 60);
        // Function to format seconds into HH:mm:ss
        function formatTime(seconds) {
            var hours = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds % 3600) / 60);
            var remainingSeconds = seconds % 60;
            return pad(minutes) + ':' + pad(remainingSeconds);
        }

        // Function to pad single-digit numbers with a leading zero
        function pad(num) {
            return num < 10 ? '0' + num : num;
        }

        // Update the counter every second
        var interval = setInterval(function() {
        $('.clock-time').text(formatTime(startTimeInSeconds));
        startTimeInSeconds++;
        }, 1000);
    // }
    
</script>
 
 <?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/partials/edit_show_orders.blade.php ENDPATH**/ ?>