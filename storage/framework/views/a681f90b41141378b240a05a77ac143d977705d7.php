<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\KitchenController::class, 'store']), 'method' => 'post',
        'id' => 'table_add_form' ]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.add_kitchen' ); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <?php echo Form::label('name', __( 'tax_rate.name' ) . ':*'); ?>

                    <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'tax_rate.name' )]); ?>

                </div>

                <div class="form-group col-md-12">
                    <?php echo Form::label('name', __( 'catergories' ) . ':*'); ?>

                    <select name="category_id" class="form-control select2">\
                        <option><?php echo app('translator')->get('messages.please_select'); ?></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <option value="<?php echo e($category->id, false); ?>"><?php echo e($category->name, false); ?> <?php echo e($category->short_code, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                
                <div class="form-group col-md-12">
                    <table class="table table-slim"> 
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->get('sale.location'); ?></th>
                        </tr>
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value, false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div> 
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>

        <?php echo Form::close(); ?>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog --><?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/kitchen/create.blade.php ENDPATH**/ ?>