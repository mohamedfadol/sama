<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\GlobalCurrencyController::class, 'store']), 'method' => 'post', 'id' => 'galobal_currencies_add_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.add_galobal_currencies' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('name', __( 'lang_v1.global_currency_name' ) . ':*'); ?>

          <?php echo Form::text('global_currency_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.global_currency_name' )]); ?>

      </div>

      <div class="form-group">
        <?php echo Form::label('global_currency_value', __( 'lang_v1.global_currency_value' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.global_currency_exempt_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
          <?php echo Form::text('global_currency_value', null, ['class' => 'form-control ', 'required' , 'placeholder' => __( 'lang_v1.global_currency_value' )]); ?>

      </div>

      <!-- <div class="form-group">
        <?php echo Form::label('name', __( 'lang_v1.local_currency_name' ) . ':*'); ?>

          <?php echo Form::text('local_currency_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.local_currency_name' )]); ?>

      </div>

      <div class="form-group">
        <?php echo Form::label('local_currency_value', __( 'lang_v1.local_currency_value' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('lang_v1.local_currency_exempt_help') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
          <?php echo Form::text('local_currency_value', null, ['class' => 'form-control ', 'required' , 'placeholder' => __( 'lang_v1.local_currency_value' )]); ?>

      </div> -->
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog --><?php /**PATH C:\xampp\htdocs\pos\resources\views/galobal_currencies/create.blade.php ENDPATH**/ ?>