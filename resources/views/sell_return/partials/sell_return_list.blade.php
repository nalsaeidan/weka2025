<div class="table-responsive" style="overflow-x: visible;">
    <table class="table table-bordered table-striped ajax_view" id="sell_return_table" style="width:100% !important;">
        <thead>
            <tr>
            	<th width="5%"></th>
                <th>@lang('messages.action')</th>
                <th>@lang('messages.date')</th>
                <th>@lang('sale.invoice_no')</th>
                <th>@lang('lang_v1.parent_sale')</th>
                <th>@lang('sale.customer_name')</th>
                <th>@lang('sale.location')</th>
                <th>@lang('purchase.payment_status')</th>
                <th>@lang('sale.total_amount')</th>
                <th>@lang('purchase.payment_due')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">
                <td colspan="6"><strong>@lang('sale.total'):</strong></td>
                <td id="footer_payment_status_count_sr"></td>
                <td><span class="display_currency" id="footer_sell_return_total" data-currency_symbol ="true"></span></td>
                <td><span class="display_currency" id="footer_total_due_sr" data-currency_symbol ="true"></span></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>