@extends('layouts.restaurant_notify')
@section('title', __( 'restaurant.received_orders' ))

@section('content')
<!-- Main content -->
<section class="content min-height-90hv no-print">
<div class="row">
    <div class="col-md-12 text-center">
        <h3>@lang( 'restaurant.all_orders' ) - @lang( 'restaurant.received_orders' ) @show_tooltip(__('lang_v1.tooltip_kitchen'))</h3>
    </div>
</div>
	<div class="box">
        <div class="box-header">
            <a href="{{route('kitchen.hole.view.page')}}" class="btn btn-sm btn-primary pull-right"> 
                @lang( 'restaurant.hole_views')  <i class="fa fa-arrow-circle-left"></i>
            </a> 
            <a href="{{route('kitchen.order.recevied')}}" class="btn btn-sm btn-primary pull-left"> 
                <i class="fa fa-arrow-circle-right"></i> @lang( 'restaurant.order_back_to_kitchen')
            </a> 
        </div>
        <div class="box-body">
            <input type="hidden" id="orders_for" value="kitchen">
        	<div class="row" id="orders_div"> 
             @include('restaurant.partials.recevied_orders_details', array('orders_for' => 'kitchen'))   
            </div>
        </div>
        <div class="overlay hide">
          <i class="fas fa-sync fa-spin"></i>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', 'a.markOrderCompleteNotDone', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.markOrderCompleteDone', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.mark_as_cooked_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });


            $(document).on('click', 'a.back_to_kitchen_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'a.mark_as_received_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                    location.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

        });
    </script>
@endsection