<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\TaxRateController::class, 'update'], [$tax_rate->id]), 'method' => 'PUT', 'id' => 'tax_rate_edit_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'tax_rate.edit_taxt_rate' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('name', __( 'tax_rate.name' ) . ':*'); ?>

          <?php echo Form::text('name', $tax_rate->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'tax_rate.name' )]); ?>

      </div>

      <div class="form-group">
        <?php echo Form::label('amount', __( 'tax_rate.rate' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.tax_exempt_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
          <?php echo Form::text('amount', $tax_rate->amount, ['class' => 'form-control input_number', 'required']); ?>

      </div>

      <div class="form-group">
          <?php echo Form::label('account_parent', __( 'accounting::lang.account_parent' ) . ':*'); ?>

          <div class="input-group">
              <span class="input-group-addon">
                  <i class="fa fa-users"></i>
              </span>
                <select class="form-control accounts-dropdown select2" name="account_id" id="account_sub_type" required>
                    <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                    <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($account->id, false); ?>" <?php if($account->id == $tax_rate->account_id): ?> selected <?php endif; ?>><?php echo e($account->name_ar, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
          </div>
      </div>

      <div class="form-group">
        <div class="checkbox">
          <label>
             <?php echo Form::checkbox('for_tax_group', 1, !empty($tax_rate->for_tax_group), [ 'class' => 'input_icheck']); ?> <?php echo app('translator')->get( 'lang_v1.for_tax_group_only' ); ?>
          </label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.for_tax_group_only_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog --><?php /**PATH C:\xampp\htdocs\pos\resources\views/tax_rate/edit.blade.php ENDPATH**/ ?>