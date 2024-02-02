
<?php $__env->startSection('title', __('lang_v1.financial_statement')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'lang_v1.financial_statement' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.financial_statement_help_long') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
    </h1>
</section>
 
<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-href="<?php echo e(action([\App\Http\Controllers\FinancialStatementController::class, 'create']), false); ?>" 
                    data-container=".financial_statement_modal">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
            </div>
        <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="financial_statement_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'lang_v1.name_ar' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.name_en' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                     
                </table>
            </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade financial_statement_modal contains_select2" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

 
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\resources\views/financial_statement/index.blade.php ENDPATH**/ ?>