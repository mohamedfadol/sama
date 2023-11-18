<div class="row" id="featured_products_box" style="display: none;">
<?php if(!empty($featured_products)): ?>
	<?php echo $__env->make('sale_pos.partials.featured_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</div>
<div class="row">
	<!-- category list was here -->

	<!-- category list was here -->
	
	<?php if(!empty($brands)): ?>
		<div class="col-sm-4" id="product_brand_div">
			<?php echo Form::select('size', $brands, null, ['id' => 'product_brand', 'class' => 'select2', 'name' => null, 'style' => 'width:100% !important']); ?>

		</div>
	<?php endif; ?>

	<!-- used in repair : filter for service/product -->
	<div class="col-md-6 hide" id="product_service_div">
		<?php echo Form::select('is_enabled_stock', ['' => __('messages.all'), 'product' => __('sale.product'), 'service' => __('lang_v1.service')], null, ['id' => 'is_enabled_stock', 'class' => 'select2', 'name' => null, 'style' => 'width:100% !important']); ?>

	</div>
 
	<div class="col-sm-4 <?php if(empty($featured_products)): ?> hide <?php endif; ?>" id="feature_product_div">
		<button type="button" class="btn btn-primary btn-flat" id="show_featured_products"><?php echo app('translator')->get('lang_v1.featured_products'); ?></button>
	</div>
</div> 
<br>
<div class="row">
	<input type="hidden" id="suggestion_page" value="1">
	<div class="col-md-4">
	<?php echo $__env->make('sale_pos.partials.category_list_pos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
	<div class="col-md-8">
	<div class="row">
	<input type="hidden" id="suggestion_page" value="1">
	<div class="col-md-12">
		<div class="eq-height-row" id="product_list_body"></div>
	</div>
	<div class="col-md-12 text-center" id="suggestion_page_loader" style="display: none;">
		<i class="fa fa-spinner fa-spin fa-2x"></i>
	</div>
</div>
	</div>
</div> 
<?php /**PATH C:\xampp\htdocs\ferasnew\stableSam\resources\views/sale_pos/partials/pos_sidebar.blade.php ENDPATH**/ ?>