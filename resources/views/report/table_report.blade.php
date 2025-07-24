@extends('layouts.app')
@section('title', __('restaurant.table_report'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('restaurant.table_report')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" id="accordion">
              <div class="box-header with-border">
                <h3 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <i class="fa fa-filter" aria-hidden="true"></i> @lang('report.filters')
                  </a>
                </h3>
              </div>
              <div id="collapseFilter" class="panel-collapse active collapse in" aria-expanded="true">
                <div class="box-body">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('tr_location_id',  __('purchase.business_location') . ':') !!}
                            {!! Form::select('tr_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('tr_date_range', __('report.date_range') . ':') !!}
                            {!! Form::text('date_range', @format_date('first day of this month') . ' ~ ' . @format_date('last day of this month'), ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'tr_date_range', 'readonly']); !!}
                        </div>
                    </div>
                        
                   <div class="col-md-12">
                    {!! Form::label('product_pr_start_time', __('lang_v1.time_range') . ': يتم تفعيل النطاق الزمني في حالة تحديد يوم واحد فقط اما في حالة اكثر من يوم فيكون لكامل الوقت من بداية الساعة 00:00 إلى نهاية الساعة 23:59') !!}
                   </div>

                    <div class="col-md-3">
                        
                        @php
                            $startDay = Carbon::now()->startOfDay();
                            $endDay   = $startDay->copy()->endOfDay();
                        @endphp
                       
                        <div class="form-group">
                            {!! Form::text('start_time', @format_time($startDay), ['style' => __('lang_v1.select_a_date_range'), 'class' => 'form-control width-50 f-left', 'id' => 'tr_start_time']); !!}
                            {!! Form::text('end_time', @format_time($endDay), ['class' => 'form-control width-50 f-left', 'id' => 'tr_end_time']); !!}
                        </div>
                    </div>
                    {{-- {!! Form::close() !!} --}}
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive" style="overflow-x: visible;">
                    <table class="table table-bordered table-striped" id="table_report" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>@lang('messages.date')</th>
                                <th>@lang('restaurant.table')</th>
                                <th>@lang('report.total_sell')</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
    
    <script type="text/javascript">
        $(document).ready(function(){
            if($('#tr_date_range').length == 1){
                $('#tr_date_range').daterangepicker(
                    dateRangeSettings, 
                    function(start, end) {
                        $('#tr_date_range').val(
                            start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                        );
                        table_report.ajax.reload();

                    }
                );

                $('#tr_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#tr_date_range').val('');
                table_report.ajax.reload();
                });

                $('#tr_start_time, #tr_end_time').datetimepicker({
                    format: moment_time_format,
                    ignoreReadonly: true,
                }).on('dp.change', function(ev){
                    table_report.ajax.reload();
                });

                
                //     {
                //     ranges: ranges,
                //     autoUpdateInput: false,
                //     startDate: moment().startOf('month'),
                //     endDate: moment().endOf('month'),
                //     locale: {
                //         format: moment_date_format
                //     }
                // });
                // $('#tr_date_range').on('apply.daterangepicker', function(ev, picker) {
                //     $(this).val(picker.startDate.format(moment_date_format) + ' ~ ' + picker.endDate.format(moment_date_format));
                //     table_report.ajax.reload();
                // });

                

                // $('#tr_date_range').on('cancel.daterangepicker', function(ev, picker) {
                //     $(this).val('');
                //     table_report.ajax.reload();
                // });
            }

            table_report = $('#table_report').DataTable({
                            processing: true,
                            serverSide: true,
    						responsive: true,
							fixedHeader: false,
                            "ajax": {
                                "url": "/reports/table-report",
                                "data": function ( d ) {
                                    var start = '';
                                    var end = '';
                                    var start_time = $('#tr_start_time').val();
                                    var end_time = $('#tr_end_time').val();

                                    if ($('#tr_date_range').val()) {
                                        start = $('input#tr_date_range')
                                            .data('daterangepicker')
                                            .startDate.format('YYYY-MM-DD');

                                        start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                        end = $('input#tr_date_range')
                                            .data('daterangepicker')
                                            .endDate.format('YYYY-MM-DD');
                                        end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    }
                                    d.start_date = start;
                                    d.end_date = end;
                                    d.location_id = $('#tr_location_id').val();
                                    //  start = $('#tr_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                    //  start = moment(start + " " + start_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    // d.start_date = start;

                                    //  end = $('#tr_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                    //  end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format).format('YYYY-MM-DD HH:mm');
                                    // d.end_date = end;

                                    }
                            },
                            columns: [
                            	{
                				"className":      'details-control',
                				"orderable":      false,
               					"data":           null,
                				"defaultContent": '',
                                searchable: false,
            					},
                                {data: 'transaction_date', name: 'transaction_date' },
                                {data: 'table', name: 'res_tables.name'},
                                {data: 'total_sell', name: 'total_sell', searchable: false}
                            ],
                            "fnDrawCallback": function (oSettings) {
                                __currency_convert_recursively($('#table_report'));
                            }
                        });
            //Customer Group report filter
            $('select#tr_location_id, #tr_date_range').change( function(){
                table_report.ajax.reload();
            });
        })
    </script>
@endsection