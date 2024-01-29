
<?php $__env->startSection('css'); ?>
    <style>
        .no-print  {
            display: none;
        }
        
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title', __( 'restaurant.hole_views' )); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
<div class="row col-lg-12" style=" ">
    <div class="col-lg-6">
        <img src="<?php echo e(asset('uploads/business_logos/'.session()->get('business')->logo), false); ?>" style="width=80; float: inline-start;" height="90" alt="<?php echo e(env('APP_NAME'), false); ?>">
    </div>

     
    <div class="col-lg-6">
        <img style="float: left !important;" src="<?php echo e(asset('img/logo33.PNG'), false); ?>" style="width=90; float: inline-start;" height="90" alt="<?php echo e(env('APP_NAME'), false); ?>">
    </div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h1><?php echo app('translator')->get( 'restaurant.hole_views' ); ?> - <?php echo app('translator')->get( 'restaurant.orders' ); ?></h1>
    </div>
</div>
	<div class="box" style="height: 100%;">
        <div class="box-body">
            <input type="hidden" id="orders_for" value="kitchen">
        	<div class="row" id="orders_div"> 
             <?php echo $__env->make('restaurant.partials.hole_view_details', array('orders_for' => 'kitchen'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
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

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.restaurant_notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/partials/hole_view.blade.php ENDPATH**/ ?>