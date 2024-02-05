
<?php $__env->startSection('title', __( 'lang_v1.galobal_currencies' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'lang_v1.galobal_currencies' ); ?>
        <small><?php echo app('translator')->get( 'lang_v1.manage_your_galobal_currencies' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.galobal_currencies' )]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('galobal_currencies.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                            data-href="<?php echo e(action([\App\Http\Controllers\GlobalCurrencyController::class, 'create']), false); ?>" 
                            data-container=".galobal_currencies_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="galobal_currencies_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'lang_v1.global_currency_name' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.global_currency_value' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.local_currency_name' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.local_currency_value' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
    <?php echo $__env->renderComponent(); ?>
    
    <div class="modal fade galobal_currencies_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\resources\views/galobal_currencies/index.blade.php ENDPATH**/ ?>