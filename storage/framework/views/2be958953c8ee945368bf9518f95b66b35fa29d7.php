<style>
table tbody {display: block;}
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

 
    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            if ($order->sell_lines->where('kitchen_id',$kitchen->id)->where('res_line_order_status','!=','cooked')->count() > 0) {
        ?>
        <?php 
            $kitchen_id = $kitchen->id;
            $status =  $order->lineDetails?->where('kitchen_id', $kitchen->id)->where('transaction_id', $order->id)->first()->status ?? null;
            
            $count_sell_line = count($order->sell_lines);
            $count_cooked = count($order->sell_lines->where('res_line_order_status', 'cooked'));
            $count_served = count($order->sell_lines->where('res_line_order_status', 'served'));
            $count_returned = count($order->sell_lines->where('res_line_order_status', 'returned'));
            $count_null = count($order->sell_lines->where('res_line_order_status', null));
            $order_status =  $count_null;
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
                <?php if($status == 'returned'): ?> light-orang white <?php endif; ?> 
                    <?php if($status == 'served'): ?> bg-gray <?php else: ?> light-gray white <?php endif; ?> ">
                <div class="inner text-center" style="text-align: -webkit-center;">
                    <?php if($status  == null): ?>
                        <div class="heart">
                            <span class="new white"><?php echo app('translator')->get('restaurant.new'); ?></span> 
                        </div>
                    <?php endif; ?>
                    <?php if($status  == 'returned'): ?> 
                        <div class="heart">
                            <span class="new white"><?php echo app('translator')->get('restaurant.returned'); ?></span> 
                        </div>
                    <?php endif; ?>
                <table class="table no-margin table-bordered table-slim" style="width: 100%;">
                    <thead class=" <?php echo e($status  == 'served' ? "order-status-servied" : "order-status-pending", false); ?>" >
                        <tr>
                            <td><?php echo e(__('restaurant.table_no'), false); ?>  <span <?php if(!empty($order->table_name)): ?> class="t-number" <?php endif; ?> ><?php echo e($order->table_name, false); ?></span> </td>
                            <td>#<?php echo e($order->invoice_no, false); ?></td>
                            <td class="text-center"> 
                            <div id="countdown_<?php echo $index; ?>">Loading...</div> 
                            </td>
                        </tr>
                    </thead>
                    <thead>
                        <tr <?php if(empty($for_ledger)): ?> class="bg-green" <?php endif; ?>>
                            <th><?php echo e(__('sale.product'), false); ?></th>
                            <th><?php echo e(__('sale.qty'), false); ?></th>
                            <th><?php echo e(__('restaurant.notes'), false); ?></th>
                            <?php if($order_status == 'new'): ?>
                            <?php else: ?>
                                <th><?php echo e(__('restaurant.status'), false); ?> </th> 
                            <?php endif; ?>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_2 = true; $__currentLoopData = $order->sell_lines->whereNull('parent_sell_line_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <tr> 
                                <td><?php echo e($sell_line->product->name, false); ?></td>
                                <td><?php echo e($sell_line->quantity, false); ?></td>
                                 <td>
                                    <?php echo e($sell_line->sell_line_note, false); ?> ,
                                    <?php if(!empty($sell_line->modifiers)): ?>
                                        <?php $__currentLoopData = $sell_line->modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($modifier->variations->name ?? '', false); ?> &nbsp;|                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                 </td>
                                <?php if($status != null): ?>
                                    <td style="padding: 2px;">
                                        <?php if($sell_line->res_line_order_status == "cooked"): ?>
                                        <a href="#" class="btn btn-sm small-box-footer btn-danger white mark_as_cooked_btn_not" 
                                                data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'markOrderCompleteDone'], [$sell_line->id]), false); ?>">
                                                    <i class="fa fa-check white"></i> <?php echo app('translator')->get('restaurant.not_done'); ?></a>
                                        <?php else: ?>
                                        <a href="#" class="btn btn-sm small-box-footer bg-info white mark_as_cooked_btn" 
                                                    data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'markAsCooked'], [$sell_line->id]), false); ?>">
                                                        <i class="fa fa-check white"></i> <?php echo app('translator')->get('restaurant.done'); ?></a>
                                        <?php endif; ?>
                                    </td>
                                <?php else: ?>
                                <?php endif; ?>
                            </tr> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?> 
                        <?php endif; ?>
                    </tbody>
                </table>  
                </div>
                    <div class='share-button'>
                        <?php if($status == null): ?>     
                            <a href="#" class="btn btn-sm small-box-footer bg-primary mark_as_served_btn" 
                                data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\OrderController::class, 'markAsServed'], [$order->id,$kitchen_id]), false); ?>">
                                    <i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.order_as_served'); ?></a> 
                        <?php else: ?> 
                        <a href="#" class="btn btn-sm small-box-footer bg-info white mark_as_all_cooked_btn" 
                                data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\OrderController::class, 'markAsAllCooked'], [$order->id,$kitchen_id]), false); ?>">
                                    <i class="fa fa-check"></i> <?php echo app('translator')->get('restaurant.mark_as_cooked'); ?></a>
                        <?php endif; ?>
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

        <?php
         }
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-md-12">
        <h4 class="text-center"><?php echo app('translator')->get('restaurant.no_orders_found'); ?></h4>
    </div>
    <?php endif; ?>
 
    <script>
        <?php foreach ($orders as $index => $order): ?>
            var laravelCreatedAt = "<?php echo e($order->created_at->toIso8601String(), false); ?>";
            var countdownInterval_<?php echo $index; ?> = setInterval(function () {
            // Convert Laravel created_at to JavaScript Date object
            var createdAtDate = new Date(laravelCreatedAt);
            // Get the current system time
            var now = new Date();
            // Calculate the difference in milliseconds
            var difference = now - createdAtDate;
            // Convert milliseconds to seconds and minutes
            var seconds = Math.floor(difference / 1000);
            var minutes = Math.floor(seconds / 60);
            document.getElementById('countdown_<?php echo $index; ?>').innerHTML = minutes + 'm ' + seconds %60 + 's';
            // console.log("Minutes: " + minutes + ", Seconds: " + seconds);
        }, 1000);
        <?php endforeach; ?>
    </script>

 
<?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/partials/edit_show_orders.blade.php ENDPATH**/ ?>