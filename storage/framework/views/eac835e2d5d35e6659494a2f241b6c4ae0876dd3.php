
<?php $__env->startSection('title', __('kitchen.home_kitchen')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'restaurant.home_kitchen' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true" 
                    data-container="body" data-toggle="popover" data-placement="auto bottom" 
                    data-content="' . __('restaurant.home_kitchen_help_long') . '" data-html="true" data-trigger="hover"></i>';
                }
                ?>
    </h1>
</section>
 
<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurant.create')): ?>
            <div class="box-tools">
                <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'create']), false); ?>" 
                    data-container=".creat_kitchen_modal">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
            </div>
        <?php endif; ?>
        <?php $__env->endSlot(); ?>  
            <div class="table-responsive">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurant.view')): ?>
                <table class="table table-bordered table-striped" id="home_kitchen_ta">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('restaurant.kitchen_name'); ?></th>
                            <th><?php echo app('translator')->get('restaurant.category_name'); ?></th>
                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                        </tr>
                    </thead> 
                </table>
                <?php endif; ?>
            </div> 
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade creat_kitchen_modal contains_select2" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>






<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('submit', 'form#table_add_form', function(e){
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if(result.success == true){
                            $('div.creat_kitchen_modal').modal('hide');
                            toastr.success(result.msg);
                            home_kitchen_ta.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            //kitchen table
            var home_kitchen_ta = $('#home_kitchen_ta').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/kitchen-home',
                    columnDefs: [ {
                        // "targets": [0],
                        // "targets": [1,2, 3],
                        "orderable": false,
                        "searchable": false 
                    } ],
                    columns: [ 
                        { data: 'name', name: 'name'  },
                        { data: 'category.name', name: 'category' },
                        { data: 'action', name: 'action'}
                    ],
                });

            $(document).on('click', 'button.edit_kitchen_button', function(){

                $( "div.creat_kitchen_modal" ).load( $(this).data('href'), function(){

                    $(this).modal('show');

                    $('form#edit_form').submit(function(e){
                        e.preventDefault();
                        var data = $(this).serialize();

                        $.ajax({
                            method: "POST",
                            url: $(this).attr("action"),
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    $('div.creat_kitchen_modal').modal('hide');
                                    toastr.success(result.msg);
                                    home_kitchen_ta.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_kitchen_button', function(){
                swal({
                  title: LANG.sure,
                  text: LANG.confirm_delete_table,
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    home_kitchen_ta.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

             
            $(document).on('click', 'button.remove_modifier_product', function(){
                swal({
                  title: LANG.sure,
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $(this).closest('tr').remove();
                    }
                });
            });
            
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\resources\views/restaurant/kitchen/home.blade.php ENDPATH**/ ?>