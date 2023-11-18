<?php if(!empty($categories)): ?>
		<!-- <div class="col-md-4" id="product_category_div">
			<select class="select2" id="product_category" style="width:100% !important">

				<option value="all"><?php echo app('translator')->get('lang_v1.all_category'); ?></option>

				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($category['id'], false); ?>"><?php echo e($category['name'], false); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(!empty($category['sub_categories'])): ?>
						<optgroup label="<?php echo e($category['name'], false); ?>">
							<?php $__currentLoopData = $category['sub_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<i class="fa fa-minus"></i> <option value="<?php echo e($sc['id'], false); ?>"><?php echo e($sc['name'], false); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</optgroup>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div> -->
	<div  id="product_category_div">
		<div class="category-container">
			<ul class="category-list">
				<button type="button" style="margin: 2px;" data-category="all" class="product_category">
					<li value="all"><?php echo app('translator')->get('lang_v1.all_category'); ?></li>
				</button>
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<button type="button"  style="margin: 2px;" data-category="<?php echo e($category['id'], false); ?>" class="product_category">
						<li><?php echo e($category['name'], false); ?></li>
					</button> 
					<?php if(!empty($category['sub_categories'])): ?>
						<?php $__currentLoopData = $category['sub_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<button type="button" style="margin: 2px;" data-category="<?php echo e($sc['id'], false); ?>" class="product_category">
							<li>-- <?php echo e($sc['name'], false); ?></li> 
						</button>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<!-- <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(!empty($category['sub_categories'])): ?>
						<?php $__currentLoopData = $category['sub_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<button style="margin: 2px;" data-category="<?php echo e($sc['id'], false); ?>" class="product_category">
							<li>-- <?php echo e($sc['name'], false); ?></li> 
						</button>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
			
			</ul>
		</div>
	</div>
	<?php endif; ?><?php /**PATH C:\xampp\htdocs\ferasnew\stableSam\resources\views/sale_pos/partials/category_list_pos.blade.php ENDPATH**/ ?>