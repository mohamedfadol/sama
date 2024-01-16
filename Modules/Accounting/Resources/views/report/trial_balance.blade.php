@extends('layouts.app')

@section('title', __('accounting::lang.trial_balance'))

@section('content')

@include('accounting::layouts.nav')

<section class="content">
        
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('date_range_filter', __('report.date_range') . ':') !!}
            {!! Form::text('date_range_filter', null, 
                ['placeholder' => __('lang_v1.select_a_date_range'), 
                'class' => 'form-control', 'readonly', 'id' => 'date_range_filter']); !!}
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">
        
        <div class="box box-warning">
            <div class="box-header with-border text-center">
                <h2 class="box-title">@lang( 'accounting::lang.trial_balance')</h2>
                <p>{{@format_date($start_date)}} ~ {{@format_date($end_date)}}</p>
            </div>

            <div class="box-body">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>@lang( 'accounting::lang.debit')</th>
                            <th>@lang( 'accounting::lang.credit')</th>
                            <th>@lang( 'accounting::lang.total_debit_balance')</th>
                            <th>@lang( 'accounting::lang.total_credit_balance')</th>
                        </tr>
                    </thead>

                    @php
                        $total_debit = 0;
                        $total_credit = 0;
                        $final_balance =0;
                    @endphp

                    <tbody>
                        @foreach($accounts as $account)

                        @php
                            $total_debit += $account->debit_balance;
                            $total_credit += $account->credit_balance;
                           $final_balance += $account->debit_balance - $account->credit_balance;
                        @endphp

                            <tr>
                                <td>{{$account->name_ar ?? $account->name_en}}</td>
                                <td>
                                    @if($account->debit_balance != 0)
                                        {{number_format($account->debit_balance,2,",",".")}}
                                    @endif    
                                </td>
                                <td>
                                    @if($account->credit_balance != 0)
                                        {{number_format($account->credit_balance,2,",",".")}}
                                    @endif
                                </td>

                                
                                <td>{{ ($account->debit_balance - $account->credit_balance < 0) ? 0 : ($account->debit_balance - $account->credit_balance )}}</td>
                                                              
                               
                                
                                <td>{{ ($account->debit_balance - $account->credit_balance < 0) ? ($account->debit_balance - $account->credit_balance ) : 0}}</td>
                                  


                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th class="total_debit">{{session("currency")["symbol"]}} {{number_format($total_debit,2,",",".") }}</th>
                            <th class="total_credit">{{session("currency")["symbol"]}} {{number_format($total_credit,2,",",".") }}</th>
                            <th class="total_debit_balance">{{session("currency")["symbol"]}} {{number_format($final_balance,2,",",".") }}</th>
                            <th class="total_credit_balance">{{session("currency")["symbol"]}} {{number_format($final_balance,2,",",".") }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

</section>


@stop

@section('javascript')

<script type="text/javascript">
    $(document).ready(function(){

        dateRangeSettings.startDate = moment('{{$start_date}}');
        dateRangeSettings.endDate = moment('{{$end_date}}');

        $('#date_range_filter').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                apply_filter();
            }
        );
        $('#date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#date_range_filter').val('');
            apply_filter();
        });

        function apply_filter(){
            var start = '';
            var end = '';

            if ($('#date_range_filter').val()) {
                start = $('input#date_range_filter')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');
                end = $('input#date_range_filter')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            }

            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('start_date', start);
            urlParams.set('end_date', end);
            window.location.search = urlParams;
        }
    });

</script>

@stop