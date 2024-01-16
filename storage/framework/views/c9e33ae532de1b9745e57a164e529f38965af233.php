

<?php $__env->startSection('title', __('accounting::lang.trial_balance')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
        
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('date_range_filter', __('report.date_range') . ':'); ?>

            <?php echo Form::text('date_range_filter', null, 
                ['placeholder' => __('lang_v1.select_a_date_range'), 
                'class' => 'form-control', 'readonly', 'id' => 'date_range_filter']); ?>

        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">
        
        <div class="box box-warning">
            <div class="box-header with-border text-center">
                <h2 class="box-title"><?php echo app('translator')->get( 'accounting::lang.trial_balance'); ?></h2>
                <p><?php echo e(\Carbon::createFromTimestamp(strtotime($start_date))->format(session('business.date_format')), false); ?> ~ <?php echo e(\Carbon::createFromTimestamp(strtotime($end_date))->format(session('business.date_format')), false); ?></p>
            </div>

            <div class="box-body">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th></th>
                            <th><?php echo app('translator')->get( 'accounting::lang.debit'); ?></th>
                            <th><?php echo app('translator')->get( 'accounting::lang.credit'); ?></th>
                            <th><?php echo app('translator')->get( 'accounting::lang.total_debit_balance'); ?></th>
                            <th><?php echo app('translator')->get( 'accounting::lang.total_credit_balance'); ?></th>
                        </tr>
                    </thead>

                    <?php
                        $total_debit = 0;
                        $total_credit = 0;
                        $final_balance =0;
                    ?>

                    <tbody>
                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php
                            $total_debit += $account->debit_balance;
                            $total_credit += $account->credit_balance;
                           $final_balance += $account->debit_balance - $account->credit_balance;
                        ?>

                            <tr>
                                <td><?php echo e($account->name_ar ?? $account->name_en, false); ?></td>
                                <td>
                                    <?php if($account->debit_balance != 0): ?>
                                        <?php echo e(number_format($account->debit_balance,2,",","."), false); ?>

                                    <?php endif; ?>    
                                </td>
                                <td>
                                    <?php if($account->credit_balance != 0): ?>
                                        <?php echo e(number_format($account->credit_balance,2,",","."), false); ?>

                                    <?php endif; ?>
                                </td>

                                
                                <td><?php echo e(($account->debit_balance - $account->credit_balance < 0) ? 0 : ($account->debit_balance - $account->credit_balance ), false); ?></td>
                                                              
                               
                                
                                <td><?php echo e(($account->debit_balance - $account->credit_balance < 0) ? ($account->debit_balance - $account->credit_balance ) : 0, false); ?></td>
                                  


                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th class="total_debit"><?php echo e(session("currency")["symbol"], false); ?> <?php echo e(number_format($total_debit,2,",","."), false); ?></th>
                            <th class="total_credit"><?php echo e(session("currency")["symbol"], false); ?> <?php echo e(number_format($total_credit,2,",","."), false); ?></th>
                            <th class="total_debit_balance"><?php echo e(session("currency")["symbol"], false); ?> <?php echo e(number_format($final_balance,2,",","."), false); ?></th>
                            <th class="total_credit_balance"><?php echo e(session("currency")["symbol"], false); ?> <?php echo e(number_format($final_balance,2,",","."), false); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
    $(document).ready(function(){

        dateRangeSettings.startDate = moment('<?php echo e($start_date, false); ?>');
        dateRangeSettings.endDate = moment('<?php echo e($end_date, false); ?>');

        $('#date_range_filter').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                apply_filter();
            }
        );
        $('#date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#date_range_filter').val('');
            apply_filter();
        });

        function apply_filter(){
            var start = '';
            var end = '';

            if ($('#date_range_filter').val()) {
                start = $('input#date_range_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');
                end = $('input#date_range_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            }

            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('start_date', start);
            urlParams.set('end_date', end);
            window.location.search = urlParams;
        }
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\Modules\Accounting\Providers/../Resources/views/report/trial_balance.blade.php ENDPATH**/ ?>