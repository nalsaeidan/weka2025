@extends('layouts.app')
@section('title', __('lang_v1.activity_log'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ __('lang_v1.activity_log')}}</h1>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('al_users_filter', __( 'lang_v1.by' ) . ':') !!}
                        {!! Form::select('al_users_filter', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'al_users_filter', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('subject_type', __( 'lang_v1.subject_type' ) . ':') !!}
                        {!! Form::select('subject_type', $transaction_types, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'subject_type', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('al_date_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('al_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                    </div>
                </div>

                <div class="col-md-12">
                    {!! Form::label('al_start_time', __('lang_v1.time_range') . ': يتم تفعيل النطاق الزمني في حالة تحديد يوم واحد فقط اما في حالة اكثر من يوم فيكون لكامل الوقت من بداية الساعة 00:00 إلى نهاية الساعة 23:59') !!}
                </div>

                <div class="col-md-3">
                    @php
                        $startDay = Carbon::now()->startOfDay();
                        $endDay = $startDay->copy()->endOfDay();
                        // dd($endDay);
                    @endphp

                    <div class="form-group">
                        {!! Form::text('start_time', @format_time($startDay), ['style' => __('lang_v1.select_a_date_range'), 'class' => 'form-control width-50 f-left', 'id' => 'al_start_time']) !!}
                        {!! Form::text('end_time', @format_time($endDay), ['class' => 'form-control width-50 f-left', 'id' => 'al_end_time']) !!}
                    </div>
                </div>

            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary'])
            <div class="table-responsive" style="overflow-x: visible;">
                <table class="table table-bordered table-striped" id="activity_log_table" style="width: 100% !important;">
                    <thead>
                        <tr>
                        	<th width="5%"></th>
                            <th>@lang('lang_v1.date')</th>
                            <th>@lang('lang_v1.subject_type')</th>
                            <th>@lang('messages.action')</th>
                            <th>@lang('lang_v1.by')</th>
                            <th>@lang('brand.note')</th>
                        </tr>
                    </thead>
                </table>
            </div>
            @endcomponent
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready( function(){
        $('#al_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#al_date_filter').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            activity_log_table.ajax.reload();
        });
        $('#al_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#al_date_filter').val('');
            activity_log_table.ajax.reload();
        });

        $('#al_start_time, #al_end_time').datetimepicker({
                format: moment_time_format,
                ignoreReadonly: true,
            }).on('dp.change', function(ev) {
                activity_log_table.ajax.reload();
            
            });

        activity_log_table = $('#activity_log_table').DataTable({
            processing: true,
            serverSide: true,
        	responsive: true,
			fixedHeader: false,
            aaSorting: [[0, 'desc']],
            "ajax": {
                "url": '{{action("ReportController@activityLog")}}',
                "data": function ( d ) {
                    var start = '';
                    var end = '';
                    var start_time = $('#al_start_time').val();
                    var end_time = $('#al_end_time').val();

                    if ($('#al_date_filter').val()) {
                        start= $('input#al_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end= $('input#al_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');

                        start = moment(start + " " + start_time, "YYYY-MM-DD" + " " +
                            moment_time_format).format('YYYY-MM-DD HH:mm');
                        end = moment(end + " " + end_time, "YYYY-MM-DD" + " " + moment_time_format)
                            .format('YYYY-MM-DD HH:mm');

                    }
                    d.start_date = start;
                    d.end_date = end;
                    d.user_id = $('#al_users_filter').val();
                    d.subject_type = $('#subject_type').val();
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
                { data: 'created_at', name: 'created_at'  },
                { data: 'subject_type', "orderable": false, "searchable": false},
                { data: 'description', name: 'description'},
                { data: 'created_by', name: 'created_by'},
                { data: 'note', name: 'note'}
            ]
        });  

        $(document).on('change', '#al_users_filter, #subject_type', function(){
            activity_log_table.ajax.reload();
        })
    });
</script>
@endsection