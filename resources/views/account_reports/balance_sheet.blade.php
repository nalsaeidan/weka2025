@extends('layouts.app')
@section('title', __( 'account.balance_sheet' ))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'account.balance_sheet')
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row no-print">
        <div class="col-sm-12">
            <div class="col-sm-3 col-xs-6 pull-right">
                    <label for="end_date">@lang('messages.filter_by_date'):</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="text" id="end_date" value="{{@format_date('now')}}" class="form-control" readonly>
                    </div>
            </div>
        </div>
    </div>
    <br>
    <div class="box box-solid">
        <div class="box-header print_section">
            <h3 class="box-title">{{session()->get('business.name')}} - @lang( 'account.balance_sheet') - <span id="hidden_date">{{@format_date('now')}}</span></h3>
        </div>
        <div class="box-body">
            <table class="table table-border-center no-border table-pl-12">
                <thead>
                    <tr class="bg-gray">
                        <th>@lang( 'account.assets')</th>
                        


                        <th>@lang( 'account.liability')</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                        <td>
                            <table class="table" id="assets_table">
                                <tbody>
                                    <tr>
                                        <th>@lang('account.customer_due1'):</th>
                                        <td>
                                            
                                            <input type="hidden" id="hidden_customer_due_number" class="asset1">
                                            <span class="remote-data" id="customer_due_number">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                                <td>

                                            <input type="hidden" id="hidden_customer_due" class="asset">
                                            <span class="remote-data" id="customer_due">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                                </td>
                                            </tr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>@lang('report.closing_stock1'):</th>
                                        <td>
                                            <input type="hidden" id="hidden_closing_stock_number" class="asset1">
                                            
                                            <span class="remote-data" id="closing_stock_number">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            
                                            </span>
                                        </td>
                                        <td>
                                            <input type="hidden" id="hidden_closing_stock" class="asset">
                                            
                                            <span class="remote-data" id="closing_stock">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            
                                            </span>
                                        </td>

                                    </tr>

                                    <tr>
                                        <th>ضريبة المشتريات والمصاريف:</th>
                                        <td>
                                            
                                            <input type="hidden" id="hidden_purchace_expense_number" class="asset1">
                                            <span class="remote-data" id="purchace_expense_number">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                                <td>

                                            <input type="hidden" id="hidden_purchace_expense" class="asset">
                                            <span class="remote-data" id="purchace_expense">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                                </td>
                                            </tr>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th >@lang('account.account_balances'):</th>
                                    </tr>
                                    <tr>
                                        <th >اسم الحساب:</th>
                                        <th >رقم الحساب:</th>
                                        <th >الرصيد:</th>

                                    </tr> --}}

                                </tbody>
                                <tbody id="account_balances" class="pl-20-td">
                                    <tr><td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>
                                </tbody>
                                {{--
                                <tbody>
                                    <tr>
                                        <th colspan="2">@lang('account.capital_accounts'):</th>
                                    </tr>
                                </tbody>
                                <tbody id="capital_account_balances" class="pl-20-td">
                                    <tr><td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>
                                </tbody>
                                --}}
                            </table>
                        </td>

                        <td>
                            <table class="table"  id="due_table">
                                <tbody>
                                    <tr>
                                        <th>@lang('account.supplier_due1'):</th>
                                            <td>
                                                <input hidden id="hidden_supplier_due_number" class="liability1">
                                                <span class="remote-data" id="supplier_due_number">
                                                    <i class="fas fa-sync fa-spin fa-fw"></i>
                                                </span>
                                            </td>
                                            <td>
                                                <input hidden id="hidden_supplier_due" class="liability">
                                                <span class="remote-data" id="supplier_due">
                                                    <i class="fas fa-sync fa-spin fa-fw"></i>
                                                </span>
                                            </td>
                                                
                                            </tr>
                                        </td>
                                    </tr>
                                    
                                    {{-- <tr>
                                        <th >@lang('account.account_balances'):</th>
                                    </tr>
                                    <tr>
                                        <th >اسم الحساب:</th>
                                        <th >رقم الحساب:</th>
                                        <th >الرصيد:</th>

                                    </tr> --}}
                                </tbody>
                                <tbody id="account_balances" class="pl-20-td">
                                    <tr>
                                        <td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td>
                                        <td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td>

                                    </tr>

                                </tbody>


                               {{-- تسويات الرصيد الافتتاحي --}}
                                <tr>
                                    <th>تسويات القيد الافتتاحي :</th>
                                        <td>
                                            <input hidden id="hidden_start_debits_number" class="liability1">
                                            <span class="remote-data" id="start_debits_number">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                        </td>
                                        <td>
                                            
                                            <input hidden id="hidden_start_debits" class="liability1">
                                            <span id="start_debits"><i class="fas fa-sync fa-spin fa-fw"></i></span>
                                            </span>
                                        </td>
                                            
                                        </tr>
                                    </td>
                                </tr>


                                    {{-- صافي الربح --}}
                                <tr>
                                    <th>@lang('report.net_profit'):</th>
                                        <td>
                                            <input hidden id="hidden_net_profit_number" class="liability1">
                                            <span class="remote-data" id="net_profit_number">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <input hidden id="hidden_net_profit" class="liability">
                                            <span class="remote-data" id="net_profit">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                        </td>
                                            
                                        </tr>
                                    </td>
                                </tr>

                                {{-- ضريبة  المبيعات--}}
                                <tr>
                                    <th>ضريبة  المبيعات:</th>
                                        <td>
                                            <input hidden id="hidden_sells_number" class="liability1">
                                            <span class="remote-data" id="sells_number">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <input hidden id="hidden_sells" class="liability">
                                            <span class="remote-data" id="sells">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                        </td>
                                            
                                        </tr>
                                    </td>
                                </tr>


                                {{-- ضريبة القيمة المضافة المستحقة --}}
                                <tr>
                                    <th>ضريبة القيمة المضافة المستحقة:</th>
                                        <td>
                                            <input hidden id="hidden_taxes_number" class="liability1">
                                            <span class="remote-data" id="taxes_number">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <input hidden id="hidden_taxes" class="liability">
                                            <span class="remote-data" id="taxes">
                                                <i class="fas fa-sync fa-spin fa-fw"></i>
                                            </span>
                                        </td>
                                            
                                        </tr>
                                    </td>
                                </tr>




 



                            </table>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="bg-gray">
                        
                        <td>
                            <table class="table bg-gray mb-0 no-border">
                                <tr>
                                    <th>
                                        @lang('account.total_assets'): 
                                    </th>
                                    <td>
                                        <span id="total_assets"><i class="fas fa-sync fa-spin fa-fw"></i></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="table bg-gray mb-0 no-border">
                                <tr>
                                    <th>
                                        @lang('account.total_liability'): 
                                    </th>
                                    <td>
<!--                                         <span hidden id="total_liabilty"><i class="fas fa-sync fa-spin fa-fw"></i></span> -->
                                        <span id="total_liabilty1"><i class="fas fa-sync fa-spin fa-fw"></i></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <button type="button" class="btn btn-primary no-print pull-right"onclick="window.print()">
          <i class="fa fa-print"></i> @lang('messages.print')</button>
        </div>
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
    $(document).ready( function(){
        //Date picker
        $('#end_date').datepicker({
            autoclose: true,
            format: datepicker_date_format
        });
        update_balance_sheet();

        $('#end_date').change( function() {
            update_balance_sheet();
            $('#hidden_date').text($(this).val());
        });
    });

    function update_balance_sheet(){
        var loader = '<i class="fas fa-sync fa-spin fa-fw"></i>';
        $('span.remote-data').each( function() {
            $(this).html(loader);
        });

        $('table#assets_table tbody#account_balances').html('<tr><td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');
        $('table#assets_table tbody#capital_account_balances').html('<tr><td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');

        $('table#due_table tbody#account_balances').html('<tr><td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');
        $('table#due_table tbody#capital_account_balances').html('<tr><td colspan="2"><i class="fas fa-sync fa-spin fa-fw"></i></td></tr>');

        var end_date = $('input#end_date').val();
        $.ajax({
            url: "{{action('AccountReportsController@balanceSheet')}}?end_date=" + end_date,
            dataType: "json",
            success: function(result){
                console.log(result.customer_due_number)
                
                ////ارصدة الموردين
                $('span#supplier_due').text(__currency_trans_from_en(result.supplier_due, true));
                __write_number($('input#hidden_supplier_due'), result.supplier_due);

                $('span#supplier_due_number').text(result.supplier_due_number, true);
                __write_number($('input#hidden_supplier_due_number'), result.supplier_due_number);

                ////ارصدة العملاء
                $('span#customer_due').text(__currency_trans_from_en(result.customer_due, true));
                __write_number($('input#hidden_customer_due'), result.customer_due);

                $('span#customer_due_number').text(result.customer_due_number, true);
                __write_number($('input#hidden_customer_due_number'), result.customer_due_number);

                $('span#customer_due_number').text(result.customer_due_number, true);
                __write_number($('input#hidden_customer_due_number'), result.customer_due_number);


                ////المخزن
                $('span#closing_stock').text(__currency_trans_from_en(result.closing_stock, true));
                __write_number($('input#hidden_closing_stock'), result.closing_stock);
                
                $('span#closing_stock_number').text(result.closing_stock_number, true);
                __write_number($('input#hidden_closing_stock_number'), result.closing_stock_number);
                


                //// صافي الربح
                $('span#net_profit').text(__currency_trans_from_en(result.net_profit, true));
                __write_number($('input#hidden_net_profit'), result.net_profit);

                $('span#net_profit_number').text(result.net_profit_number, true);
                __write_number($('input#hidden_net_profit_number'), result.net_profit_number);


                //// ضريبة المبيعات
                $('span#sells').text(__currency_trans_from_en(result.sells, true));
                __write_number($('input#hidden_sells'), result.sells);

                $('span#sells_number').text(result.sells_number, true);
                __write_number($('input#hidden_sells_number'), result.sells_number);

                //// ضريبة المشتريات والمصاريف
                $('span#purchace_expense').text(__currency_trans_from_en(result.purchace_expense, true));
                __write_number($('input#hidden_purchace_expense'), result.purchace_expense);

                $('span#purchace_expense_number').text(result.purchace_expense_number, true);
                __write_number($('input#hidden_purchace_expense_number'), result.purchace_expense_number);



                //// ضريبة القيمة المضافة المستحقة
                $('span#taxes').text(__currency_trans_from_en(result.taxes, true));
                __write_number($('input#hidden_taxes'), result.taxes);

                $('span#taxes_number').text(result.taxes_number, true);
                __write_number($('input#hidden_taxes_number'), result.taxes_number);




                //تسويات القيد الافتتاحي
                $('span#start_debits').text(__currency_trans_from_en(result.start_debits, true));
                __write_number($('input#hidden_start_debits'));

                $('span#start_debits_number').text(result.start_debits_number, true);
                __write_number($('input#hidden_start_debits_number'), result.start_debits_number);


                // var account_numbers = result.account_balances['account_number'];
                var account_balances = result.account_balances;
                $('table#assets_table tbody#account_balances').html('');
                for (var key in account_balances ) {
                    var accnt_bal = __currency_trans_from_en(result.account_balances[key]);
                    var accnt_bal_with_sym = __currency_trans_from_en(result.account_balances[key], true);
                    var account_tr = '<tr><th class="pl-20-t">' + key + ':</th><td class="pl-20-td">' + result.account_numbers[key] + '</td><td><input type="hidden" class="asset" value="' + accnt_bal + '">' + accnt_bal_with_sym + '</td></tr>';
                    $('table#assets_table tbody#account_balances').append(account_tr);
                
                
            }
            

                var account_balances = result.account_balances_assets;
                $('table#due_table tbody#account_balances').html('');
                for (var key in account_balances) {
                    console.log(result.account_numbers_assets[key]);
                    var accnt_bal = __currency_trans_from_en(result.account_balances_assets[key]);
                    var accnt_bal_with_sym = __currency_trans_from_en(result.account_balances_assets[key], true);
                    var account_tr = '<tr><th class="pl-20-td">' + key + ':</th><td class="pl-20-td">' + result.account_numbers_assets[key] + '</td><td><input type="hidden" class="liability" value="' + accnt_bal + '">' + accnt_bal_with_sym + '</td></tr>';
                    $('table#due_table tbody#account_balances').append(account_tr);
                }

                
                var capital_account_details = result.capital_account_details;
                $('table#assets_table tbody#capital_account_balances').html('');
                for (var key in capital_account_details) {
                    var accnt_bal = __currency_trans_from_en(result.capital_account_details[key]);
                    var accnt_bal_with_sym = __currency_trans_from_en(result.capital_account_details[key], true);
                    var account_tr = '<tr><td class="pl-20-td">' + key + ':</td><td><input type="hidden" class="asset" value="' + accnt_bal + '">' + accnt_bal_with_sym + '</td></tr>';
                    $('table#assets_table tbody#capital_account_balances').append(account_tr);
                }

				var net = result.net_profit;
                var total_liabilty = 0;
                var total_assets = 0;
                var start_debits = 0;
                $('input.liability').each( function(){
                    total_liabilty += __read_number($(this));
                });
                $('input.asset').each( function(){
                    total_assets += __read_number($(this));
                });

                

                $('span#total_liabilty').text(__currency_trans_from_en(total_liabilty, true));
                $('span#total_liabilty1').text(__currency_trans_from_en(total_assets, true));
                $('span#total_assets').text(__currency_trans_from_en(total_assets, true));
                $('span#start_debits').text(__currency_trans_from_en((total_assets-total_liabilty), true));

                
            }
        });
    }
</script>

@endsection