<style>
table tbody {display: block;max-height: 150px;overflow-y: scroll;}
table thead, table tbody tr {display: table;width: 100%;table-layout: fixed;}
.clock {font-weight: bold;}
.small-box p {font-size: 13px;}
.share-button{display:inline-block;display: flex;justify-content: space-between;}
.order-status {border: 2px solid none;}
.order-status-pending {border: 2px solid red;}
.order-status-servied {border: 2px solid green;}
.light-gray{background-color: #6d97ea!important;}
.white {color: #fff;}
.light-orang {color: #000;background-color: #c4bc6c!important;}
.new {
    padding: 5px;
    background-color: #d73434;
    border-radius: 16px;
    border: 1px dashed;
}
.t-number {
    padding: 5px;
    background-color: #5EA85E;
    border-radius: 13px;
    border: 1px dashed;
}
.heart {width: 20px;animation: animateHeart 1.2s infinite;}
@keyframes animateHeart {0% {transform: scale(0.5); }50% {transform: scale(0.5);}100% {transform: scale(1);}}

</style>
@forelse($orders as $order)

        @php
            $count_sell_line = count($order->sell_lines);
            $count_cooked = count($order->sell_lines->where('res_line_order_status', 'cooked'));
            $count_served = count($order->sell_lines->where('res_line_order_status', 'served'));
            $count_returned = count($order->sell_lines->where('res_line_order_status', 'returned'));
            $count_null = count($order->sell_lines->where('res_line_order_status', null));
            $order_status =  $count_null;
            if($count_cooked == $count_sell_line) {
                    $order_status =  'cooked';
            } else if($count_served == $count_sell_line) {
                    $order_status =  'served';
            } else if ($count_served > 0 && $count_served < $count_sell_line) {
                    $order_status =  'partial_served';
            } else if ($count_returned) {
                    $order_status =  'returned';
            }
            else if ($count_null) {

                $order_status =  'new';
            }
            
        @endphp
	<div class="col-md-3 col-xs-6 order_div" >
    
		<div class="small-box 
            @if($order_status == 'returned') light-orang white @endif @if($order_status == 'served') bg-gray @else light-gray white @endif ">
            <div class="inner text-center" style="text-align: -webkit-center;">
                @if($order_status  == 'new')
                    <div class="heart">
                        <span class="new white">@lang('restaurant.new')</span> 
                    </div>
                @endif
                @if($order_status  == 'returned')
                    <div class="heart">
                        <span class="new white">@lang('restaurant.returned')</span> 
                    </div>
                @endif
            <table class="table no-margin table-bordered table-slim " style="width: 100%;">
                <thead class=" {{$order_status  == 'served' ? "order-status-servied" : "order-status-pending" }}" >
                    <tr>
                        <td>{{ __('restaurant.table_no') }}  <span @if(!empty($order->table_name)) class="t-number" @endif >{{ $order->table_name }}</span> </td>
                        <td>#{{$order->invoice_no}}</td>
                        <td> <div class="clock"><p class="clock-time"></p></div> </td>
                    </tr>
                </thead>
                <thead>
                    <tr @if(empty($for_ledger)) class="bg-green" @endif>
                        <th>{{ __('sale.product') }}</th>
                        <th>{{ __('sale.qty') }}</th>
                        <th>{{ __('restaurant.notes') }}</th>
                        @if ($order_status == 'new')
                            
                        @else
                        <th>{{ __('restaurant.status') }} </th> 
                        @endif
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($order->sell_lines->whereNull('parent_sell_line_id') as $sell_line)
                        @if ($sell_line->res_line_order_status != "cooked")
                        <tr> 
                            <td>{{ $sell_line->product->name }}</td>
                            <td>{{ $sell_line->quantity }}</td>
                            <td>
                                {{ $sell_line->sell_line_note }} ,
                                @forelse ($order->sell_lines->whereNotNull('parent_sell_line_id')->where('parent_sell_line_id',$sell_line->id) as $line)
                                    <span>{{$line->product->name}}</span>
                                @empty
                                @endforelse
                            </td>
                            @if (!is_null($sell_line->res_line_order_status))
                            <td style="padding: 2px;">
                                @if ($sell_line->res_line_order_status == "cooked")
                                <a href="#" class="btn btn-sm small-box-footer btn-danger mark_as_cooked_btn_not" 
                                        data-href="{{action([\App\Http\Controllers\Restaurant\KitchenController::class, 'markOrderCompleteDone'], [$sell_line->id])}}">
                                            <i class="fa fa-check white"></i> @lang('restaurant.not_done')</a>
                                @else
                                <a href="#" class="btn btn-sm small-box-footer bg-info mark_as_cooked_btn" 
                                            data-href="{{action([\App\Http\Controllers\Restaurant\KitchenController::class, 'markAsCooked'], [$sell_line->id])}}">
                                                <i class="fa fa-check white"></i> @lang('restaurant.done')</a>
                                @endif
                            </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                        @else
                            
                        @endif
                         
                        @empty
                            <span>cooked</span>
                    @endforelse
                </tbody>
            </table>  
            </div>
                <div class='share-button'>
                    @if ($order_status == "new")     
                        <a href="#" class="btn btn-sm small-box-footer bg-primary mark_as_served_btn" 
                            data-href="{{action([\App\Http\Controllers\Restaurant\OrderController::class, 'markAsServed'], [$sell_line->id])}}">
                                <i class="fa fa-check"></i> @lang('restaurant.order_as_served')</a> 
                    @else 
                    @endif
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

<script> 
     
        var startTimeInSeconds = (10 * 3600);
        // Function to format seconds into HH:mm:ss
        function formatTime(seconds) {
            var hours = Math.floor(seconds / 3600);
            var minutes = Math.floor((seconds % 3600) / 60);
            var remainingSeconds = seconds % 60;
            return pad(minutes) + ':' + pad(remainingSeconds);
        }

        // Function to pad single-digit numbers with a leading zero
        function pad(num) {
            return num < 10 ? '0' + num : num;
        }

        // Update the counter every second
        var interval = setInterval(function() {
        $('.clock-time').text(formatTime(startTimeInSeconds));
        startTimeInSeconds++;
        }, 1000);
  
    
</script>
 
 