<div class="table-responsive" style="overflow-x: visible;">
<table class="table table-bordered table-striped" id="sr_sales_with_commission_table" style="width: 100% !important;">
    <thead>
        <tr>
        	<th></th>
            <th>@lang('messages.date')</th>
            <th>@lang('sale.invoice_no')</th>
            <th>@lang('sale.customer_name')</th>
            <th>@lang('sale.location')</th>
            <th>@lang('sale.payment_status')</th>
            <th>@lang('sale.total_amount')</th>
            <th>@lang('sale.total_paid')</th>
            <th>@lang('sale.total_remaining')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 footer-total text-center">
            <td colspan="5"><strong>@lang('sale.total'):</strong></td>
            <td id="footer_payment_status_count"></td>
            <td><span class="display_currency" id="footer_sale_total" data-currency_symbol ="true"></span></td>
            <td><span class="display_currency" id="footer_total_paid" data-currency_symbol ="true"></span></td>
            <td class="text-left"><small>@lang('lang_v1.sell_due') - <span class="display_currency" id="footer_total_remaining" data-currency_symbol ="true"></span><br>@lang('lang_v1.sell_return_due') - <span class="display_currency" id="footer_total_sell_return_due" data-currency_symbol ="true"></span></small></td>
        </tr>
    </tfoot>
</table>
</div>