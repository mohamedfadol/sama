@extends('layouts.restaurant')
@section('css')
    <style>

    </style>
@endsection
@section('title', __( 'restaurant.hole_views' ))

@section('content')
<!-- Main content -->
<section class="content min-height-90hv no-print">
<div class="row col-lg-12 text-center" style="border: 1px solid #947f7f;">
    <h3 style="text-transform:uppercase;margin-top: 8px;"><span>{{env('APP_NAME')}}</span></h3>
</div>

<div class="row col-lg-12" style="border: 1px solid #947f7f;">
    <div class="col-lg-6"><h3 style="float: left;">
    <img src="{{asset('uploads/business_logos/'.session()->get('business')->logo)}}" 
        style="width=50" height="50" alt="upload logo"></h3></div>

    <div class="col-lg-6"><h3 style="float: right; text-transform:uppercase;"> {{session()->get('business')->name}} </h3></div>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <h3>@lang( 'restaurant.hole_views' ) - @lang( 'restaurant.orders' )</h3>
    </div>
</div>
	<div class="box">
        <div class="box-body">
            <input type="hidden" id="orders_for" value="kitchen">
        	<div class="row" id="orders_div"> 
             @include('restaurant.partials.hole_view_details', array('orders_for' => 'kitchen'))   
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