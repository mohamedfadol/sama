<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\SongsControllerController::class, 'update'], [$song->id]), 'method' => 'PUT', 'id' => 'song_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'song.edit_song' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('name', __( 'song.song_name' ) . ':*'); ?>

          <?php echo Form::text('song_name', $song->song_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'song.song_name' )]); ?>

      </div>

      <div class="form-group">
          <?php echo Form::label('account_parent', __( 'accounting::lang.account_parent' ) . ':*'); ?>

          <div class="input-group">
          <span class="input-group-addon">
                  <i class="fa fa-song"></i>
              </span>
                <select class="form-control accounts-dropdown select2" name="song" id="song" required>
                    <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                    <?php $__currentLoopData = $selectOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key, false); ?>"  <?php if($key == $song->path): ?> selected <?php endif; ?>><?php echo e($value, false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
          </div>
      </div>

      <div class="form-group">
          <?php echo Form::label('account_parent', __( 'accounting::lang.account_parent' ) . ':*'); ?>

          <div class="input-group">
          <span class="input-group-addon">
                  <i class="fa fa-path"></i>
              </span>
              <select id="routeSelect"  class="form-control accounts-dropdown select2" name="routeSelect"  required>
                <?php $__currentLoopData = $routeNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($routeName, false); ?>"  <?php if($routeName == $song->nike_name): ?> selected <?php endif; ?>><?php echo e($routeName, false); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
      </div>

    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog --><?php /**PATH C:\xampp\htdocs\pos\resources\views/songs/edit.blade.php ENDPATH**/ ?>