

<?php $__env->startSection('title', __('accounting::lang.account_receivable_ageing_details')); ?>

<?php $__env->startSection('css'); ?>
<style>
.table-sticky thead,
.table-sticky tfoot {
  position: sticky;
}
.table-sticky thead {
  inset-block-start: 0; /* "top" */
}
.table-sticky tfoot {
  inset-block-end: 0; /* "bottom" */
}
.collapsed .collapse-tr {
    display: none;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content">
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="form-group">
                <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('location_id', $business_locations, request()->input('location_id'), 
                    ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-warning">
                <div class="box-header with-border text-center">
                    <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.account_receivable_ageing_details' ); ?></h2>
                </div>
                <div class="box-body">
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('account.transaction_type'); ?></th>
                                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                <th><?php echo app('translator')->get('contact.customer'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.due_date'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.due'); ?></th>
                            </tr>
                        </thead>
                        <?php $__currentLoopData = $report_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody <?php if($loop->index != 0): ?> class="collapsed" <?php endif; ?>>
                            <tr class="toggle-tr" style="cursor: pointer;">
                                <th colspan="6">
                                    <span class="collapse-icon">
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </span>
                                    <?php if($key == 'current'): ?>
                                       <spna style="color: #2dce89 !important;"> 
                                       <?php echo app('translator')->get( 'accounting::lang.current' ); ?> </spna>
                                    <?php elseif($key == '1_30'): ?>
                                        <span style="color: #ffd026 !important;"> 
                                        <?php echo app('translator')->get( 'accounting::lang.days_past_due', ['days' => '1 - 30'] ); ?>
                                        </span>
                                    <?php elseif($key == '31_60'): ?>
                                        <span style="color: #ffa100 !important;"> 
                                        <?php echo app('translator')->get( 'accounting::lang.days_past_due', ['days' => '31 - 60'] ); ?>
                                        </span>
                                    <?php elseif($key == '61_90'): ?>
                                        <span style="color: #f5365c !important;"> 
                                            <?php echo app('translator')->get( 'accounting::lang.days_past_due', ['days' => '61 - 90'] ); ?>
                                        </span>
                                    <?php elseif($key == '>90'): ?>
                                        <span style="color: #FF0000 !important;"> 
                                        <?php echo app('translator')->get( 'accounting::lang.91_and_over_past_due' ); ?>
                                        </span>
                                    <?php endif; ?>
                                </th>
                            </tr>
                            <?php
                                $total=0;
                            ?>
                            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $total += $details['due'];
                                ?>
                                <tr class="collapse-tr">
                                    <td>
                                        <?php echo e($details['transaction_date'], false); ?>

                                    </td>
                                    <td>
                                        <?php echo app('translator')->get( 'accounting::lang.invoice' ); ?>
                                    </td>
                                    <td>
                                        <?php echo e($details['invoice_no'], false); ?>

                                    </td>
                                    <td>
                                        <?php echo e($details['contact_name'], false); ?>

                                    </td>
                                    <td>
                                        <?php echo e($details['due_date'], false); ?>

                                    </td>
                                    <td>
                                        <?php 
            $formated_number = "";
            if (session("business.currency_symbol_placement") == "before") {
                $formated_number .= session("currency")["symbol"] . " ";
            } 
            $formated_number .= number_format((float) $details['due'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            if (session("business.currency_symbol_placement") == "after") {
                $formated_number .= " " . session("currency")["symbol"];
            }
            echo $formated_number; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr class="collapse-tr bg-gray">
                                <th>
                                    <?php if($key == 'current'): ?>
                                        <?php echo app('translator')->get( 'accounting::lang.total_for_current' ); ?>
                                    <?php elseif($key == '1_30'): ?>
                                        <?php echo app('translator')->get( 'accounting::lang.total_for_days_past_due', ['days' => '1 - 30'] ); ?>
                                    <?php elseif($key == '31_60'): ?>
                                        <?php echo app('translator')->get( 'accounting::lang.total_for_days_past_due', ['days' => '31 - 60'] ); ?>
                                    <?php elseif($key == '61_90'): ?>
                                        <?php echo app('translator')->get( 'accounting::lang.total_for_days_past_due', ['days' => '61 - 90'] ); ?>
                                    <?php elseif($key == '>90'): ?>
                                        <?php echo app('translator')->get( 'accounting::lang.total_for_91_and_over' ); ?>
                                    <?php endif; ?>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php 
            $formated_number = "";
            if (session("business.currency_symbol_placement") == "before") {
                $formated_number .= session("currency")["symbol"] . " ";
            } 
            $formated_number .= number_format((float) $total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            if (session("business.currency_symbol_placement") == "after") {
                $formated_number .= " " . session("currency")["symbol"];
            }
            echo $formated_number; ?></th>
                            </tr>
                        </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#location_id').change( function(){
            if($(this).val()) {
                window.location.href = "<?php echo e(route('accounting.account_receivable_ageing_details'), false); ?>?location_id=" + $(this).val();
            } else {
                window.location.href = "<?php echo e(route('accounting.account_receivable_ageing_details'), false); ?>";
            }
        });
    });
    $(document).on('click', '.toggle-tr', function(){
        $(this).closest('tbody').toggleClass('collapsed');
        var html = $(this).closest('tbody').hasClass('collapsed') ? 
        '<i class="fas fa-arrow-circle-right"></i>' : '<i class="fas fa-arrow-circle-down"></i>';
        $(this).find('.collapse-icon').html(html);
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\Modules\Accounting\Providers/../Resources/views/report/account_receivable_ageing_details.blade.php ENDPATH**/ ?>