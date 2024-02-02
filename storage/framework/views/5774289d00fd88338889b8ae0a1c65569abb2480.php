<div class="modal-dialog" role="document">
  <div class="modal-content">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountCategoryController::class, 'store']), 'method' => 'post', 'id' => 'account_category_form' ]); ?>

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.add_account_category' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="form-group col-md-12">
          <?php echo Form::label('name_ar', __( 'lang_v1.name_ar' ) . ':*'); ?>

            <?php echo Form::text('name_ar', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name_ar' )]); ?>

        </div>

        <div class="form-group col-md-12">
          <?php echo Form::label('name_en', __( 'lang_v1.name_en' ) . ':'); ?>

            <?php echo Form::text('name_en', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.name_en' )]); ?>

        </div>
      </div>
    </div>

    <div class="form-group">
        <?php echo Form::label('acc_category_parent', __( 'lang_v1.parent_id' ) .":"); ?>

        <select name="acc_category_parent_id" class="form-control select2">
            <option><?php echo app('translator')->get('messages.please_select'); ?></option>
            <?php $__currentLoopData = $acc_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc_cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($acc_cate->id, false); ?>"><?php echo e($acc_cate->name_ar, false); ?> - <?php echo e($acc_cate->name_en, false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>


    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
    <?php echo Form::close(); ?>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog --><?php /**PATH C:\xampp\htdocs\pos\resources\views/account_category/create.blade.php ENDPATH**/ ?>