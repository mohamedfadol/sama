<style>
table tbody {display: block;max-height: 150px;overflow-y: scroll;}
table thead, table tbody tr {display: table;width: 100%;table-layout: fixed;}
.clock {font-weight: bold;}
.small-box p {font-size: 12px;font-size: 12px;text-wrap: nowrap;display: inline;padding: 5px;background-color: lightskyblue;border-radius: 3px;}
.small-box .ready{background-color: #60c9a6;}
.share-button{padding: 5px;}
.vl{border-left: 4px solid red;height: 200px;position: absolute;left: 50%;margin-left: -3px;top: 0;}
.heart {animation: animateHeart 1.2s infinite;}
@keyframes animateHeart {0% {transform: scale(0.8); }50% {transform: scale(0.8);}100% {transform: scale(1.5);}}
</style>

<div class="row">
    <div class="col-lg-6 col-md-4 col-xs-6 order_div">
        <h2 class="ready_order text-center">
            @lang('restaurant.ready_orders')
        </h2>
        @forelse($orders as $order)
            <div class="col-md-3 col-xs-6">
                <div class="small-box bg-gray">
                    <div class="inner">
                    <table>
                            <thead>
                            <tr class="text-center">
                                <td> <div class="clock heart"><p class="ready">#{{$order->invoice_no}}</p></div> </td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class='share-button bg-green text-center'><i class="fa fa-check"></i> @lang('restaurant.ready_to_reserve')</div>
                </div>
            </div>
            @if($loop->iteration % 4 == 0)
                <div class="hidden-xs">
                    <div class="clearfix"></div>
                </div>
            @endif
            @if($loop->iteration % 2 == 0)
                <div class="visible-xs">
                    <div class="clearfix"></div>
                </div>
            @endif
        @empty
        <div class="col-md-12">
            <h4 class="text-center">@lang('restaurant.no_orders_found')</h4>
        </div>
        @endforelse
    </div>

    <div class="vl"></div>

    <div class="col-lg-6 col-md-4 col-xs-6 order_div">
        <h2 class="ready_order text-center">@lang('restaurant.orders_are_being_prepared')</h2>
        @forelse($ervedOrders as $order)
            <div class="col-md-3 col-xs-6">
                <div class="small-box bg-gray">
                    <div class="inner">
                        <table>
                            <thead>
                            <tr class="text-center">
                                <td> <div class="clock"><p class="clock-time">#{{$order->invoice_no}}</p></div> </td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class='share-button bg-info text-center'>
                        <i class="fa fa-check"></i> @lang('restaurant.prepared')            
                    </div>
                </div>
            </div>
            @if($loop->iteration % 4 == 0)
                <div class="hidden-xs">
                    <div class="clearfix"></div>
                </div>
            @endif
            @if($loop->iteration % 2 == 0)
                <div class="visible-xs">
                    <div class="clearfix"></div>
                </div>
            @endif
        @empty
            <div class="col-md-12">
                <h4 class="text-center">@lang('restaurant.no_orders_found')</h4>
            </div>
        @endforelse
    </div>
</div>



 

 