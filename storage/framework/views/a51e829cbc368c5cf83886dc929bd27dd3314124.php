<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\CoaController::class, 'update'], $account->id), 
        'method' => 'put', 'id' => 'create_client_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'accounting::lang.edit_account' ); ?></h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('name_ar', __( 'user.name_ar' ) . ':*'); ?>

                            <?php echo Form::text('name_ar', $account->name_ar, ['class' => 'form-control', 'required', 'placeholder' => __( 'user.name_ar' ) ]); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('name_en', __( 'user.name_en' ) . ':*'); ?>

                            <?php echo Form::text('name_en', $account->name_en, ['class' => 'form-control', 'placeholder' => __( 'user.name_en' ) ]); ?>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo Form::label('account_parent', __( 'accounting::lang.account_parent' ) . ':*'); ?>

                    <select class="form-control" name="account_parent_id" id="account_parent">
                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($account_type->id, false); ?>" 
                            data-show_balance="<?php echo e($account_type->show_balance, false); ?>"
                             <?php if($account_type->id == $account->parent_id): ?> selected <?php endif; ?>>
                            <?php echo e($account_type->name_ar, false); ?> <?php echo e($account_type->name_en, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <?php echo Form::label('is_account_primary_type', __( 'accounting::lang.is_account_primary_type' ) . ':*'); ?>

                     <input type="checkbox" name="is_account_primary_type" 
                       <?php if($account->is_account_primary_type == 1): ?> checked <?php endif; ?>   id="is_account_primary_type" value="1">
                    <p class="help-block" id="detail_type_desc"></p>
                </div> 
                <div class="form-group">
                    <?php echo Form::label('account_number', __( 'accounting::lang.account_number' ) . ':'); ?>

                    <?php echo Form::text('account_number', $account->account_number, ['class' => 'form-control', 'placeholder' => __( 'accounting::lang.account_number' ) ]); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('description', __( 'lang_v1.description' ) . ':'); ?>

                    <?php echo Form::textarea('description', $account->description, ['class' => 'form-control', 
                        'placeholder' => __( 'lang_v1.description' ) ]); ?>

                </div>
            </div>
        </div> 
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog --><?php /**PATH C:\xampp\htdocs\pos\Modules\Accounting\Providers/../Resources/views/chart_of_accounts/edit.blade.php ENDPATH**/ ?>