
<?php $__env->startSection('title', __( 'restaurant.received_orders' )); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content min-height-90hv no-print">
<div class="row">
    <div class="col-md-12 text-center">
        <h3><?php echo app('translator')->get( 'restaurant.all_orders' ); ?> - <?php echo app('translator')->get( 'restaurant.received_orders' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.tooltip_kitchen') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?></h3>
    </div>
</div>
	<div class="box">
        <div class="box-header">
            <a href="<?php echo e(route('kitchen.hole.view.page'), false); ?>" class="btn btn-sm btn-primary pull-right"> 
                <?php echo app('translator')->get( 'restaurant.hole_views'); ?>  <i class="fa fa-arrow-circle-left"></i>
            </a> 
            <a href="<?php echo e(route('kitchen.order.recevied'), false); ?>" class="btn btn-sm btn-primary pull-left"> 
                <i class="fa fa-arrow-circle-right"></i> <?php echo app('translator')->get( 'restaurant.order_back_to_kitchen'); ?>
            </a> 
        </div>
        <div class="box-body">
            <input type="hidden" id="orders_for" value="kitchen">
        	<div class="row" id="orders_div"> 
             <?php echo $__env->make('restaurant.partials.recevied_orders_details', array('orders_for' => 'kitchen'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
            </div>
        </div>
        <div class="overlay hide">
          <i class="fas fa-sync fa-spin"></i>
        </div>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', 'a.markOrderCompleteNotDone', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.markOrderCompleteDone', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.mark_as_cooked_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });


            $(document).on('click', 'a.back_to_kitchen_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.mark_as_received_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/partials/recevied_orders.blade.php ENDPATH**/ ?>