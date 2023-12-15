<style>
table tbody {}
table thead, table tbody tr {display: table;width: 100%;table-layout: fixed;}
.clock {font-weight: bold;}
.small-box p {font-size: 13px;}
.share-button{display:inline-block;display: flex;justify-content: space-between;}
.order-status {border: 2px solid none;}
.order-status-pending {border: 2px solid red;}
.order-status-servied {border: 2px solid green;}

.navbar {
  position: relative;
  overflow: hidden;
  min-height: 5px;
}

.navbar span {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 2px;
  width: 100px;
  background-color: red;
  animation: animate 6s linear infinite;
}

@keyframes animate {0% {left: 0;transform: translate(-30%);}50% {left: 0;transform: translate(-50%);}75% {left: 0;transform: translate(-75%);}100% {left: 100%;transform: translate(0);}}
</style>
<?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <?php
            $status =  $order->lineDetails->where('transaction_id', $order->id)->first()->status ?? null;
        ?>
	<div class="col-md-3 col-xs-6 order_div">
		<div class="small-box bg-gray">
            <div class="inner">
            	<table class="table no-margin table-bordered table-slim" style="width: 100%;">
                    <thead>
                        <tr>
                            <td><?php echo e(__('restaurant.table_no'), false); ?><?php echo e($order->table_name, false); ?> </td>
                            <td>#<?php echo e($order->invoice_no, false); ?></td>
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
                        <?php $__currentLoopData = $order->sell_lines->whereNull('parent_sell_line_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr> 
                                <td><?php echo e($sell_line->product->name, false); ?></td>
                                <td><?php echo e($sell_line->quantity, false); ?></td>
                                <td>
                                    <?php echo e($sell_line->sell_line_note, false); ?>  ,

                                    <?php $__empty_2 = true; $__currentLoopData = $order->sell_lines->whereNotNull('parent_sell_line_id')->where('parent_sell_line_id',$sell_line->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                        <span><?php echo e($line->product->name, false); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                        
                                    <?php endif; ?>
                                </td>
                                <td style="padding: 2px;">
                                    <?php if($sell_line->res_line_order_status  != 'cooked' && $sell_line->res_line_order_status  != 'done'): ?>     
                                        <span class="btn btn-danger" style="padding: 2px;" ><i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.not_done'); ?></span>
                                    <?php else: ?>
                                        <span class="btn btn-primary" style="padding: 2px;" ><i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.done'); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
            	</table> 
            </div> 
                <?php if($status == "done"): ?>
                <div class='share-button'>
                    <a href="#" class="btn btn-sm small-box-footer bg-primary mark_as_received_btn" 
                        data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\OrderController::class, 'markAsReceived'], [$order->id]), false); ?>">
                            <i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.order_as_received'); ?></a> 
                    
                    <a href="#" class="btn btn-sm small-box-footer bg-yellow back_to_kitchen_btn" 
                        data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'backToKitchen'], [$order->id]), false); ?>">
                            <i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.order_back_to_kitchen'); ?></a>
                     
                    <a href="#" class="btn btn-sm small-box-footer bg-info text-white btn-modal" 
                        data-href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$order->id]), false); ?>" 
                            data-container=".view_modal"><?php echo app('translator')->get('restaurant.order_details'); ?> 
                                <i class="fa fa-arrow-circle-right"></i></a>  
                </div> 
                <?php endif; ?>
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
        var startTimeInSeconds = (10 * 3600);
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
</script>
 <?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/partials/recevied_orders_details.blade.php ENDPATH**/ ?>