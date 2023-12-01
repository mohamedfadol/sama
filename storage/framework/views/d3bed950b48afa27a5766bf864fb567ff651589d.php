<?php $request = app('Illuminate\Http\Request'); ?>

<?php
    $pos_layout = true;
?>

<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>" dir="<?php echo e(in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr', false); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e(Session::get('business.name'), false); ?></title> 

        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('be6bac61ce5c670ed4b2', {
            cluster: 'eu'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
            });
        </script>
        <?php echo $__env->make('layouts.partials.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('css'); ?>
        <?php echo $__env->yieldContent('js'); ?>

        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('be6bac61ce5c670ed4b2', {cluster: 'eu'});
            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
            });
        </script>
    </head>

    <body class="hold-transition lockscreen">
        <div class="wrapper">
            <script type="text/javascript">
                if(localStorage.getItem("upos_sidebar_collapse") == 'true'){
                    var body = document.getElementsByTagName("body")[0];
                    body.className += " sidebar-collapse";
                }
            </script>
        
        
        <audio id="newOrder">
            <source src="<?php echo e(asset('audio/ordercome.mp3'), false); ?>" type="audio/mpeg">
        </audio>

        <script src="<?php echo e(asset('js/notifications.js'), false); ?>"></script>
        <!-- Modal -->
        <div class="modal fade notify" id="notifyModel" tabindex="-1" role="dialog" aria-labelledby="notifyModelLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="notifyModelLabel"><?php echo e(__('restaurant.new_order_coming'), false); ?></h5>
                </div>
                <div class="modal-body">
                    <!-- <input name="mo" id="mo" class="form-control"> -->
                </div>
                <div class="modal-footer">
                    <button type="button" onClick="window.location.href=window.location.href" class="btn btn-primary btn-block">Ok</button>
                </div>
                </div>
            </div>
        </div>


            <!-- Content Wrapper. Contains page content -->
            <div class="container-fluid">
             <?php echo $__env->make('layouts.partials.header-restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <!-- Add currency related field-->
                <input type="hidden" id="__code" value="<?php echo e(session('currency')['code'], false); ?>">
                <input type="hidden" id="__symbol" value="<?php echo e(session('currency')['symbol'], false); ?>">
                <input type="hidden" id="__thousand" value="<?php echo e(session('currency')['thousand_separator'], false); ?>">
                <input type="hidden" id="__decimal" value="<?php echo e(session('currency')['decimal_separator'], false); ?>">
                <input type="hidden" id="__symbol_placement" value="<?php echo e(session('business.currency_symbol_placement'), false); ?>">

                <input type="hidden" id="__orders_refresh_interval" value="<?php echo e(config('constants.orders_refresh_interval', 600), false); ?>">
                <!-- End of currency related field-->

                <?php if(session('status')): ?>
                    <input type="hidden" id="status_span" data-status="<?php echo e(session('status.success'), false); ?>" data-msg="<?php echo e(session('status.msg'), false); ?>">
                <?php endif; ?>
                <?php echo $__env->yieldContent('content'); ?>
                <?php if(config('constants.iraqi_selling_price_adjustment')): ?>
                    <input type="hidden" id="iraqi_selling_price_adjustment">
                <?php endif; ?>

                <!-- This will be printed -->
                <section class="invoice print_section" id="receipt_section">
                </section>
                
            </div>
            <?php echo $__env->make('home.todays_profit_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- /.content-wrapper -->

            <?php echo $__env->make('layouts.partials.footer-restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>

        <?php echo $__env->make('layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <script src="<?php echo e(asset('js/restaurant.js?v=' . $asset_v), false); ?>"></script>
        <div class="modal fade view_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel"></div>

        

    </body>
</html><?php /**PATH C:\xampp\htdocs\pos\resources\views/layouts/restaurant.blade.php ENDPATH**/ ?>