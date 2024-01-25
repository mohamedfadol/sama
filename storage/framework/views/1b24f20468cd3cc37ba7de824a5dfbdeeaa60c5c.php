<?php $__env->startSection('title', __( 'songs.songs' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'songs.songs' ); ?>
        <small><?php echo app('translator')->get( 'songs.manage_your_songs' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'songs.songs' )]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('songs.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                            data-href="<?php echo e(action([\App\Http\Controllers\SongsControllerController::class, 'create']), false); ?>" 
                            data-container=".songs_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="songs_table">
                    <thead>
                        <tr>
                        <th><?php echo app('translator')->get( 'songs.song_name' ); ?></th>
                            <th><?php echo app('translator')->get( 'songs.path' ); ?></th>
                            <th><?php echo app('translator')->get( 'songs.nike_name' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
    <?php echo $__env->renderComponent(); ?>
    
    <div class="modal fade songs_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\resources\views/songs/index.blade.php ENDPATH**/ ?>