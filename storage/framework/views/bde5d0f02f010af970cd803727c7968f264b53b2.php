<div class="modal-dialog no-print" role="document">
<?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\TransactionController::class, 'saveMap']), 'method' => 'POST', 'id' => 'save_accounting_map' ]); ?>

    
    <input type="hidden" name="type" value="<?php echo e($type, false); ?>" id="transaction_type">
    <?php if(in_array($type, ['sell', 'purchase'])): ?>
        <input type="hidden" name="id" value="<?php echo e($transaction->id, false); ?>">
    <?php elseif(in_array($type, ['sell_payment', 'purchase_payment'])): ?>
        <input type="hidden" name="id" value="<?php echo e($transaction_payment->id, false); ?>">
    <?php endif; ?>

<div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="modalTitle">
        <?php if($type == 'sell'): ?>
            <?php echo e($transaction->invoice_no, false); ?>

        <?php elseif(in_array($type, ['sell_payment', 'purchase_payment'])): ?>
            <?php echo e($transaction_payment->payment_ref_no, false); ?>

        <?php elseif($type == 'purchase'): ?>
            <?php echo e($transaction->ref_no, false); ?>

        <?php endif; ?>
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('payment_account', __('accounting::lang.payment_account') . ':*' ); ?>

                <?php echo Form::select('payment_account', !is_null($default_payment_account) ? [$default_payment_account->id => $default_payment_account->name] : [], $default_payment_account->id ?? null, ['class' => 'form-control accounts-dropdown','placeholder' => __('accounting::lang.payment_account'), 'required' => 'required']); ?>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo Form::label('deposit_to', __('accounting::lang.deposit_to') . ':*' ); ?>

                <?php echo Form::select('deposit_to', !is_null($default_deposit_to) ? 
                    [$default_deposit_to->id => $default_deposit_to->name] : [], $default_deposit_to->id ?? null, ['class' => 'form-control accounts-dropdown','placeholder' => __('accounting::lang.deposit_to'), 'required' => 'required']); ?>

            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.cancel'); ?></button>
</div>

<?php echo Form::close(); ?>

	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog --><?php /**PATH C:\xampp\htdocs\pos\Modules\Accounting\Providers/../Resources/views/transactions/map.blade.php ENDPATH**/ ?>