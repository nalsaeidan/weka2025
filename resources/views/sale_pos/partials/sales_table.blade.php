@php
    $custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div class="table-responsive" style="overflow-x: visible;">
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
            <th width="5%">@lang('lang_v1.types_of_service')</th>
            <th width="5%">{{ $custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' )}}</th>
            <th width="5%">@lang('lang_v1.added_by')</th>
            <th width="5%">@lang('sale.sell_note')</th>
            <th width="5%">@lang('sale.staff_note')</th>
            <th width="5%">@lang('sale.shipping_details')</th>
            <!--<th width="5%">@lang('restaurant.table')</th>-->
            <th width="5%">@lang('restaurant.service_staff')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 footer-total text-center">
            <td colspan="7"><strong>@lang('sale.total'):</strong></td>
            <td class="footer_payment_status_count"></td>
            <td class="payment_method_count"></td>
            <td class="footer_sale_total"></td>
            <td class="footer_total_paid"></td>
            <td class="footer_total_remaining"></td>
        	<td colspan="2"></td>
            <td class="footer_total_sell_return_due"></td>
            <td class="service_type_count"></td>
        	<td colspan="6"></td>
        </tr>
    </tfoot>
</table>
</div>