<style>
    .text-center{
        text-align: center;
    }
    .small-box{
        padding: 6px;
        box-shadow: 0 1px 8px 4px rgb(9 9 9 / 10%);
    }
</style>
<?php $__empty_1 = true; $__currentLoopData = $kitchens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kitchen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	<div class="col-md-3 col-xs-6 order_div">
		<div class="small-box">
            <a href="<?php echo e(route('kitchen.show',$kitchen->id), false); ?>">
                <div class="inner text-center">
                    <div <?php if(empty($for_ledger)): ?> class="bg-green  text-center" <?php endif; ?> style="padding: 5px;"><?php echo e(__('restaurant.kitchen_name'), false); ?></div>
                    <span  style="padding: 20px;"><?php echo e($kitchen->name, false); ?></span>
                </div>
            </a>
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
	<h4 class="text-center"><?php echo app('translator')->get('restaurant.no_kitchen_found'); ?></h4>
</div>
<?php endif; ?>


 
<script>
    function updateClockTime() {
        // Get all elements with the class "clock-time"
        const clockElements = document.querySelectorAll('.clock-time');
        // Update the time for each element
        clockElements.forEach((element) => {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            element.textContent = timeString;
        });
    }
    // Update the clock time every second
    setInterval(updateClockTime, 1000);
    // Call the function immediately to set the initial time
    updateClockTime();
</script>
 <?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/kitchen/kitchens.blade.php ENDPATH**/ ?>