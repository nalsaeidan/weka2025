@extends('layouts.app')
@section('title', __( 'lang_v1.all_sales'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>@lang( 'sale.sells')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
    @component('components.filters', ['title' => __('report.filters')])
        @include('sell.partials.sell_list_filters')
        @if($is_woocommerce)
            <div class="col-md-3">
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                          {!! Form::checkbox('only_woocommerce_sells', 1, false, 
                          [ 'class' => 'input-icheck', 'id' => 'synced_from_woocommerce']); !!} {{ __('lang_v1.synced_from_woocommerce') }}
                        </label>
                    </div>
                </div>
            </div>
        @endif
    @endcomponent
    @component('components.widget', ['class' => 'box-primary', 'title' => __( 'lang_v1.all_sales')])
        @can('direct_sell.access')
            @slot('tool')
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" href="{{action('SellController@create')}}">
                    <i class="fa fa-plus"></i> اضافة فاتورة</a>
                </div>
            @endslot
        @endcan
        @if(auth()->user()->can('direct_sell.view') ||  auth()->user()->can('view_own_sell_only') ||  auth()->user()->can('view_commission_agent_sell'))
        @php
            $custom_labels = json_decode(session('business.custom_labels'), true);
         @endphp
<div class="table-responsive" style="overflow-x: visible !important;">
            <table class="table table-bordered table-striped ajax_view" id="sell_table" style="width:100% !important;">
                <thead>
                    <tr>
                    <th width="5%"></th>
                        <th width="5%">@lang('messages.action')</th>
                        <th width="5%">@lang('messages.date')</th>
                        <th width="5%">@lang('sale.invoice_no')</th>
                        <th width="5%">@lang('sale.customer_name')</th>
                        <th width="5%">@lang('lang_v1.contact_no')</th>
                        <th width="5%">@lang('sale.location')</th>
                        <th width="5%">@lang('sale.payment_status')</th>
                        <th width="5%">@lang('lang_v1.payment_method')</th>
                        <th width="5%">@lang('sale.total_amount')</th>
                        <th width="5%">@lang('sale.total_paid')</th>
                        <th width="5%">@lang('lang_v1.sell_due')</th>
                        <th width="5%">@lang('lang_v1.sell_return_due')</th>
                        <th width="5%">@lang('lang_v1.shipping_status')</th>
                        <th width="5%">@lang('lang_v1.total_items')</th>
                        <th>@lang('lang_v1.types_of_service')</th>
                        <th>{{ $custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' )}}</th>
                        <th>@lang('lang_v1.added_by')</th>
                        <th>@lang('sale.sell_note')</th>
                        <th>@lang('sale.staff_note')</th>
                        <th>@lang('sale.shipping_details')</th>
                       <!-- <th>@lang('restaurant.table')</th>-->
                        <th>@lang('restaurant.service_staff')</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr class="bg-gray font-17 footer-total text-center">
                        <td colspan="6"><strong>@lang('sale.total'):</strong></td>
                        <td class="footer_payment_status_count"></td>
                        <td class="payment_method_count"></td>
                        <td class="footer_sale_total"></td>
                        <td class="footer_total_paid"></td>
                        <td class="footer_total_remaining"></td>
                        <td colspan="2" class="footer_total_sell_return_due"></td>
                        <td colspan="2"></td>
                        <td colspan="7" class="service_type_count"></td>
                    </tr>
                </tfoot>
            </table>
</div>      
@endif
    @endcomponent
</section>
<!-- /.content -->
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->

@stop

@section('javascript')
<script type="text/javascript">
/*function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
    '@if(empty($is_types_service_enabled))'+
        '<tr>'+
            '<td>@lang('lang_v1.types_of_service'): </td>'+
            '<td>'+d.types_of_service_name+'</td>'+
        '</tr>'+
           ' @endif'+ 
            '@if(empty($is_types_service_enabled))'+
        '<tr>'+
            '<td>{{ $custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' )}}</td>'+
            '<td>'+d.service_custom_field_1+'</td>'+
        '</tr>'+
            '@endif'+
        '<tr>'+
            '<td>@lang('lang_v1.added_by')</td>'+
            '<td>'+d.added_by+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>@lang('sale.sell_note')</td>'+
            '<td>'+d.additional_notes+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>@lang('sale.staff_note')</td>'+
            '<td>'+d.staff_note+'</td>'+
        '</tr>'+
            '<tr>'+
            '<td>@lang('sale.shipping_details')</td>'+
            '<td>'+d.shipping_details+'</td>'+
        '</tr>'+
            '@if(empty($is_tables_enabled))'+
            '<tr>'+
            '<td>@lang('restaurant.table')</td>'+
            '<td>'+d.table_name+'</td>'+
        '</tr>'+
            '@endif'+
            '@if(empty($is_service_staff_enabled))'+
            '<tr>'+
            '<td>@lang('restaurant.service_staff')</td>'+
            '<td>'+d.waiter+'</td>'+
        '</tr>'+
            '@endif'+
    '</table>';
}*/
$(document).ready( function(){
    //Date range as a button
    $('#sell_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#sell_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            sell_table.ajax.reload();
        }
    );
    $('#sell_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#sell_list_filter_date_range').val('');
        sell_table.ajax.reload();
    });
sell_table = $('#sell_table').DataTable({
		responsive: true,
        processing: true,
        serverSide: true,
		fixedHeader: false,
        aaSorting: [[1, 'desc']],
		
		//scrollX:   false,
		//scrollY: false,
        "ajax": {
            "url": "/sells",
            "data": function ( d ) {
                if($('#sell_list_filter_date_range').val()) {
                    var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
                d.is_direct_sale = 1;

                d.location_id = $('#sell_list_filter_location_id').val();
                d.customer_id = $('#sell_list_filter_customer_id').val();
                d.payment_status = $('#sell_list_filter_payment_status').val();
                d.created_by = $('#created_by').val();
                d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                d.service_staffs = $('#service_staffs').val();

                if($('#shipping_status').length) {
                    d.shipping_status = $('#shipping_status').val();
                }
                
                @if($is_woocommerce)
                    if($('#synced_from_woocommerce').is(':checked')) {
                        d.only_woocommerce_sells = 1;
                    }
                @endif

                if($('#only_subscriptions').is(':checked')) {
                    d.only_subscriptions = 1;
                }

                d = __datatable_ajax_callback(d);
            }
        },
       // scrollY:        "75vh",
        //scrollX:        true,
        //scrollCollapse: true,
		
        columns: [
         {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '',
            	searchable: false,
            },
            { data: 'action', name: 'action', orderable: false, "searchable": false},
            { data: 'transaction_date', name: 'transaction_date'  },
            { data: 'invoice_no', name: 'invoice_no'},
            { data: 'conatct_name', name: 'conatct_name'},
            { data: 'mobile', name: 'contacts.mobile'},
            { data: 'business_location', name: 'bl.name'},
            { data: 'payment_status', name: 'payment_status'},
            { data: 'payment_methods', orderable: false, "searchable": false},
            { data: 'final_total', name: 'final_total'},
            { data: 'total_paid', name: 'total_paid', "searchable": false},
            { data: 'total_remaining', name: 'total_remaining'},
            { data: 'return_due', orderable: false, "searchable": false},
            { data: 'shipping_status', name: 'shipping_status'},
            { data: 'total_items', name: 'total_items', "searchable": false},
            { data: 'types_of_service_name', name: 'tos.name', @if(empty($is_types_service_enabled)) visible: false @else visible: true @endif},
            { data: 'service_custom_field_1', name: 'service_custom_field_1', @if(empty($is_types_service_enabled)) visible: false @else visible: true @endif},
            { data: 'added_by', name: 'u.first_name'},
            { data: 'additional_notes', name: 'additional_notes'},
            { data: 'staff_note', name: 'staff_note'},
            { data: 'shipping_details', name: 'shipping_details'},
            //{ data: 'table_name', name: 'tables.name', @if(empty($is_tables_enabled)) visible: false @else visible: true @endif},
            { data: 'waiter', name: 'ss.first_name', @if(empty($is_service_staff_enabled)) visible: false @endif },
        ],
        "fnDrawCallback": function (oSettings) {
            __currency_convert_recursively($('#sell_table'));
        },
        "footerCallback": function ( row, data, start, end, display ) {
        $('.details-control').css('background', 'none');
            var footer_sale_total = 0;
            var footer_total_paid = 0;
            var footer_total_remaining = 0;
            var footer_total_sell_return_due = 0;
            for (var r in data){
                footer_sale_total += $(data[r].final_total).data('orig-value') ? parseFloat($(data[r].final_total).data('orig-value')) : 0;
                footer_total_paid += $(data[r].total_paid).data('orig-value') ? parseFloat($(data[r].total_paid).data('orig-value')) : 0;
                footer_total_remaining += $(data[r].total_remaining).data('orig-value') ? parseFloat($(data[r].total_remaining).data('orig-value')) : 0;
                footer_total_sell_return_due += $(data[r].return_due).find('.sell_return_due').data('orig-value') ? parseFloat($(data[r].return_due).find('.sell_return_due').data('orig-value')) : 0;
            }

            $('.footer_total_sell_return_due').html(__currency_trans_from_en(footer_total_sell_return_due));
            $('.footer_total_remaining').html(__currency_trans_from_en(footer_total_remaining));
            $('.footer_total_paid').html(__currency_trans_from_en(footer_total_paid));
            $('.footer_sale_total').html(__currency_trans_from_en(footer_sale_total));

            $('.footer_payment_status_count').html(__count_status(data, 'payment_status'));
            $('.service_type_count').html(__count_status(data, 'types_of_service_name'));
            $('.payment_method_count').html(__count_status(data, 'payment_methods'));
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(6)').attr('class', 'clickable_td');
        }
    });
 $(document).on('change', '#sell_list_filter_location_id, #sell_list_filter_customer_id, #sell_list_filter_payment_status, #created_by, #sales_cmsn_agnt, #service_staffs, #shipping_status',  function() {
        sell_table.ajax.reload();
    });
    @if($is_woocommerce)
        $('#synced_from_woocommerce').on('ifChanged', function(event){
            sell_table.ajax.reload();
        });
    @endif

    $('#only_subscriptions').on('ifChanged', function(event){
        sell_table.ajax.reload();
    });

$('table#sell_table>tbody').on('click', 'td.details-control', function () {
	$('table#sell_table>tbody>tr').removeAttr('data-href');

        var tr = $(this).closest('tr');
        var row = sell_table.row( 'tr' );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            //row.child.hide();
            tr.removeClass('shown');
        }
        else {
       // $('table#sell_table>tbody>tr').removeAttr('data-href');
            // Open this row
            //row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

});

</script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection