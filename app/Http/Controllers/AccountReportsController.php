<?php

namespace App\Http\Controllers;

use App\Account;

use App\AccountTransaction;
use App\TransactionPayment;
use App\Utils\TransactionUtil;
use DB;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccountReportsController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $transactionUtil;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil)
    {
        $this->transactionUtil = $transactionUtil;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
 public function balanceSheet()
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = session()->get('user.business_id');

            $end_date = !empty(request()->input('end_date')) ? $this->transactionUtil->uf_date(request()->input('end_date')) : \Carbon::now()->format('Y-m-d');

            $purchase_details = $this->transactionUtil->getPurchaseTotals(
                $business_id,
                null,
                $end_date
            );
            $sell_details = $this->transactionUtil->getSellTotals(
                $business_id,
                null,
                $end_date
            );

            $transaction_types = ['sell_return'];

            $sell_return_details = $this->transactionUtil->getTransactionTotals(
                $business_id,
                $transaction_types,
                null,
                $end_date
            );

            $data = $this->transactionUtil->getProfitLossDetails($business_id, $location_id=null, $start_date = date( 'Y' ) . '-01-01', $end_date);


            //رقم حساب الموردين لنظهره بالميزانيه

            $account_supplier_number = Account::where('id','2')->get()->pluck('account_number');
            
            
            //رقم حساب العملاء لنظهره بالميزانيه
        
            $account_customer_number = Account::where('id','1')->get()->pluck('account_number');
            

            //رقم حساب المخزن لنظهره بالميزانيه
        
            $closing_stock_number = Account::where('id','4')->get()->pluck('account_number');

            //رقم حساب ضريبة المشتريات والمصاريف لنظهره بالميزانيه
        
            $account_purchace_expense_number = Account::where('id','200')->get()->pluck('account_number');
            

            //رقم حساب ضريبة المبيعات لنظهره بالميزانيه
        
            $account_sells_number = Account::where('id','100')->get()->pluck('account_number');
            

             //رقم حساب ضريبة القيمة المضافة المستحقة لنظهره بالميزانيه
        
             $account_taxes_number = Account::where('id','300')->get()->pluck('account_number');
            

            //رقم حساب صافي الربح لنظهره بالميزانيه

            $net_profit_number = Account::where('id','3')->get()->pluck('account_number');

            //رقم حساب تسويات القيد الافتتاحي لنظهره بالميزانيه

            $start_debits_number = Account::where('id','5')->get()->pluck('account_number');
            



            $account_details = $this->getAccountBalance($business_id, $end_date);
            $account_details_assets = $this->getAccountBalanceAssets($business_id, $end_date);
            $account_numbers_assets = $this->getAccountBalanceAssetsNumber($business_id, $end_date);

            $account_numbers = $this->getAccountBalanceNumber($business_id, $end_date);
            // $capital_account_details = $this->getAccountBalance($business_id, $end_date, 'capital');

            //Get Closing stock
            $closing_stock = $this->transactionUtil->getOpeningClosingStock(
                $business_id,
                $end_date,
                null
            );

            $output = [
                'supplier_due' => $purchase_details['purchase_due'],
                'customer_due' => $sell_details['invoice_due'] - $sell_return_details['total_sell_return_inc_tax'],
                'account_balances' => $account_details,
                'account_numbers' => $account_numbers,
                'account_balances_assets' => $account_details_assets,
                'account_numbers_assets' => $account_numbers_assets,
                'closing_stock' => $closing_stock,
                'capital_account_details' => null,
                'supplier_due_number' => $account_supplier_number ,
                'customer_due_number' => $account_customer_number,
                'closing_stock_number' => $closing_stock_number,
                'sells_number' => $account_sells_number,
                'taxes_number' => $account_taxes_number,
                'purchace_expense_number' => $account_purchace_expense_number,
                'net_profit_number' =>$net_profit_number,
                'start_debits_number' => $start_debits_number,
                'net_profit' => $data['net_profit'],
            ];

            return $output;
        }

        return view('account_reports.balance_sheet');
    }

public function balanceSheet1()
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = session()->get('user.business_id');

            $end_date = !empty(request()->input('end_date')) ? $this->transactionUtil->uf_date(request()->input('end_date')) : \Carbon::now()->format('Y-m-d');

            $purchase_details = $this->transactionUtil->getPurchaseTotals(
                $business_id,
                null,
                $end_date
            );
            $sell_details = $this->transactionUtil->getSellTotals(
                $business_id,
                null,
                $end_date
            );

            $transaction_types = ['sell_return'];

            $sell_return_details = $this->transactionUtil->getTransactionTotals(
                $business_id,
                $transaction_types,
                null,
                $end_date
            );

            $data = $this->transactionUtil->getProfitLossDetails($business_id, $location_id=null, $start_date = date( 'Y' ) . '-01-01', $end_date);


            //رقم حساب الموردين لنظهره بالميزانيه

            $account_supplier_number = Account::where('id','2')->get()->pluck('account_number');
            
            
            //رقم حساب العملاء لنظهره بالميزانيه
        
            $account_customer_number = Account::where('id','1')->get()->pluck('account_number');
            

            //رقم حساب المخزن لنظهره بالميزانيه
        
            $closing_stock_number = Account::where('id','4')->get()->pluck('account_number');


            //رقم حساب صافي الربح لنظهره بالميزانيه

            $net_profit_number = Account::where('id','3')->get()->pluck('account_number');

            //رقم حساب تسويات القيد الافتتاحي لنظهره بالميزانيه

            $start_debits_number = Account::where('id','5')->get()->pluck('account_number');
            



            $account_details = $this->getAccountBalance($business_id, $end_date);
            $account_details_assets = $this->getAccountBalanceAssets($business_id, $end_date);
            $account_numbers_assets = $this->getAccountBalanceAssetsNumber($business_id, $end_date);

            $account_numbers = $this->getAccountBalanceNumber($business_id, $end_date);
            // $capital_account_details = $this->getAccountBalance($business_id, $end_date, 'capital');

            //Get Closing stock
            $closing_stock = $this->transactionUtil->getOpeningClosingStock(
                $business_id,
                $end_date,
                null
            );

            $output = [
                'supplier_due' => $purchase_details['purchase_due'],
                'customer_due' => $sell_details['invoice_due'] - $sell_return_details['total_sell_return_inc_tax'],
                'account_balances' => $account_details,
                'account_numbers' => $account_numbers,
                'account_balances_assets' => $account_details_assets,
                'account_numbers_assets' => $account_numbers_assets,
                'closing_stock' => $closing_stock,
                'capital_account_details' => null,
                'supplier_due_number' => $account_supplier_number ,
                'customer_due_number' => $account_customer_number,
                'closing_stock_number' => $closing_stock_number,
                'net_profit_number' =>$net_profit_number,
                'start_debits_number' => $start_debits_number,
                'net_profit' => $data['net_profit'],
            ];

            return $output;
        }

        return view('account_reports.balance_sheet1');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function trialBalance()
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = session()->get('user.business_id');

            $end_date = !empty(request()->input('end_date')) ? $this->transactionUtil->uf_date(request()->input('end_date')) : \Carbon::now()->format('Y-m-d');

            $purchase_details = $this->transactionUtil->getPurchaseTotals(
                $business_id,
                null,
                $end_date
            );
            $sell_details = $this->transactionUtil->getSellTotals(
                $business_id,
                null,
                $end_date
            );

            $account_details = $this->getAccountBalance($business_id, $end_date);

            // $capital_account_details = $this->getAccountBalance($business_id, $end_date, 'capital');

            $output = [
                'supplier_due' => $purchase_details['purchase_due'],
                'customer_due' => $sell_details['invoice_due'],
                'account_balances' => $account_details,
                'capital_account_details' => null
            ];

            return $output;
        }

        return view('account_reports.trial_balance');
    }


    // (ارصدة الحسابات)الفنكشن الخاصه بأرصدة الأصول
    /**
     * Retrives account balances.
     * @return Obj
     */
    private function getAccountBalance($business_id, $end_date, $account_type = 'others')
    {
        $query = Account::leftjoin(
            'account_transactions as AT',
            'AT.account_id',
            '=',
            'accounts.id'
        )
                                // ->NotClosed()
                                ->whereNull('AT.deleted_at')
                                ->where('business_id', $business_id)
                                ->whereIn('account_type_id',[1,2,3,4,8,9,10,11])
                                ->whereDate('AT.operation_date', '<=', $end_date);

        // if ($account_type == 'others') {
        //    $query->NotCapital();
        // } elseif ($account_type == 'capital') {
        //     $query->where('account_type', 'capital');
        // }

        $account_details = $query->select(['name','account_number',
                                        DB::raw("SUM( IF(AT.type='credit', amount, -1*amount) ) as balance")])
                                ->groupBy('accounts.id')
                                ->get()
                                ->pluck('balance', 'name','account_number');

        return $account_details;
    }

    private function getAccountBalanceNumber($business_id, $end_date, $account_type = 'others')
    {
        $query = Account::leftjoin(
            'account_transactions as AT',
            'AT.account_id',
            '=',
            'accounts.id'
        )
                                // ->NotClosed()
                                ->whereNull('AT.deleted_at')
                                ->where('business_id', $business_id)
                                ->whereIn('account_type_id',[1,2,3,4,5,7,8,9])
                                ->whereDate('AT.operation_date', '<=', $end_date);

        // if ($account_type == 'others') {
        //    $query->NotCapital();
        // } elseif ($account_type == 'capital') {
        //     $query->where('account_type', 'capital');
        // }

        $account_numbers = $query->select(['account_number','name'])
                                ->groupBy('accounts.id')
                                ->get()
                                ->pluck('account_number','name');

        return $account_numbers;
    }


    //  (ارصدة الحسابات)الفنكشن الخاصه بارصدة الالتزامات

    private function getAccountBalanceAssets($business_id, $end_date, $account_type = 'others')
    {
        $query = Account::leftjoin(
            'account_transactions as AT',
            'AT.account_id',
            '=',
            'accounts.id'
        )
                                // ->NotClosed()
                                ->whereNull('AT.deleted_at')
                                ->where('business_id', $business_id)
                                ->whereIn('account_type_id',[5,6,7,12,13,14])
                                ->whereDate('AT.operation_date', '<=', $end_date);

        // if ($account_type == 'others') {
        //    $query->NotCapital();
        // } elseif ($account_type == 'capital') {
        //     $query->where('account_type', 'capital');
        // }

        $account_details_assets = $query->select(['name',
                                        DB::raw("SUM( IF(AT.type='credit', amount, -1*amount) ) as balance")])
                                ->groupBy('accounts.id')
                                ->get()
                                ->pluck('balance', 'name');

        return $account_details_assets;
    }



    private function getAccountBalanceAssetsNumber($business_id, $end_date, $account_type = 'others')
    {
        $query = Account::leftjoin(
            'account_transactions as AT',
            'AT.account_id',
            '=',
            'accounts.id'
        )
                                // ->NotClosed()
                                ->whereNull('AT.deleted_at')
                                ->where('business_id', $business_id)
                                ->whereIn('account_type_id',[10,11,12,13,14,15])
                                ->whereDate('AT.operation_date', '<=', $end_date);

        // if ($account_type == 'others') {
        //    $query->NotCapital();
        // } elseif ($account_type == 'capital') {
        //     $query->where('account_type', 'capital');
        // }

        $account_numbers_assets = $query->select(['account_number','name'])
                                ->groupBy('accounts.id')
                                ->get()
                                ->pluck('account_number','name');

        return $account_numbers_assets;
    }
    



    /**
     * Displays payment account report.
     * @return Response
     */
    public function paymentAccountReport()
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = session()->get('user.business_id');

        if (request()->ajax()) {
            $query = TransactionPayment::leftjoin(
                'transactions as T',
                'transaction_payments.transaction_id',
                '=',
                'T.id'
            )
                                    ->leftjoin('accounts as A', 'transaction_payments.account_id', '=', 'A.id')
                                    ->where('transaction_payments.business_id', $business_id)
                                    ->whereNull('transaction_payments.parent_id')
                                    ->where('transaction_payments.method', '!=', 'advance')
                                    ->select([
                                        'paid_on',
                                        'payment_ref_no',
                                        'T.ref_no',
                                        'T.invoice_no',
                                        'T.type',
                                        'T.id as transaction_id',
                                        'A.name as account_name',
                                        'A.account_number',
                                        'transaction_payments.id as payment_id',
                                        'transaction_payments.account_id'
                                    ]);

            $start_date = !empty(request()->input('start_date')) ? request()->input('start_date') : '';
            $end_date = !empty(request()->input('end_date')) ? request()->input('end_date') : '';

            if (!empty($start_date) && !empty($end_date)) {
                $query->whereBetween(DB::raw('date(paid_on)'), [$start_date, $end_date]);
            }

            $account_id = !empty(request()->input('account_id')) ? request()->input('account_id') : '';

            if ($account_id == 'none') {
                $query->whereNull('account_id');
            } elseif (!empty($account_id)) {
                $query->where('account_id', $account_id);
            }

            return DataTables::of($query)
                    ->editColumn('paid_on', function ($row) {
                        return $this->transactionUtil->format_date($row->paid_on, true);
                    })
                    ->addColumn('action', function ($row) {
                        $action = '<button type="button" class="btn btn-info 
                        btn-xs btn-modal"
                        data-container=".view_modal" 
                        data-href="' . action('AccountReportsController@getLinkAccount', [$row->payment_id]). '">' . __('account.link_account') .'</button>';
                        
                        return $action;
                    })
                    ->addColumn('account', function ($row) {
                        $account = '';
                        if (!empty($row->account_id)) {
                            $account = $row->account_name . ' - ' . $row->account_number;
                        }
                        return $account;
                    })
                    ->addColumn('transaction_number', function ($row) {
                        $html = $row->ref_no;
                        if ($row->type == 'sell') {
                            $html = '<button type="button" class="btn btn-link btn-modal"
                                    data-href="' . action('SellController@show', [$row->transaction_id]) .'" data-container=".view_modal">' . $row->invoice_no . '</button>';
                        } elseif ($row->type == 'purchase') {
                            $html = '<button type="button" class="btn btn-link btn-modal"
                                    data-href="' . action('PurchaseController@show', [$row->transaction_id]) .'" data-container=".view_modal">' . $row->ref_no . '</button>';
                        }
                        return $html;
                    })
                    ->editColumn('type', function ($row) {
                        $type = $row->type;
                        if ($row->type == 'sell') {
                            $type = __('sale.sale');
                        } elseif ($row->type == 'purchase') {
                            $type = __('lang_v1.purchase');
                        } elseif ($row->type == 'expense') {
                            $type = __('lang_v1.expense');
                        }
                        return $type;
                    })
                    ->filterColumn('account', function ($query, $keyword) {
                        $query->where('A.name', 'like', ["%{$keyword}%"])
                            ->orWhere('account_number', 'like', ["%{$keyword}%"]);
                    })
                    ->filterColumn('transaction_number', function ($query, $keyword) {
                        $query->where('T.invoice_no', 'like', ["%{$keyword}%"])
                            ->orWhere('T.ref_no', 'like', ["%{$keyword}%"]);
                    })
                    ->rawColumns(['action', 'transaction_number'])
                    ->make(true);
        }

        $accounts = Account::forDropdown($business_id, false);
        $accounts = ['' => __('messages.all'), 'none' => __('lang_v1.none')] + $accounts;
        
        return view('account_reports.payment_account_report')
                ->with(compact('accounts'));
    }

    /**
     * Shows form to link account with a payment.
     * @return Response
     */
    public function getLinkAccount($id)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = session()->get('user.business_id');
        if (request()->ajax()) {
            $payment = TransactionPayment::where('business_id', $business_id)->findOrFail($id);
            $accounts = Account::forDropdown($business_id, false);

            return view('account_reports.link_account_modal')
                ->with(compact('accounts', 'payment'));
        }
    }

    /**
     * Links account with a payment.
     * @param  Request $request
     * @return Response
     */
    public function postLinkAccount(Request $request)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = session()->get('user.business_id');
            if (request()->ajax()) {
                $payment_id = $request->input('transaction_payment_id');
                $account_id = $request->input('account_id');

                $payment = TransactionPayment::with(['transaction'])->where('business_id', $business_id)->findOrFail($payment_id);
                $payment->account_id = $account_id;
                $payment->save();

                $payment_type = !empty($payment->transaction->type) ? $payment->transaction->type : null;
                if (empty($payment_type)) {
                    $child_payment = TransactionPayment::where('parent_id', $payment->id)->first();
                    $payment_type = !empty($child_payment->transaction->type) ? $child_payment->transaction->type : null;
                }

                AccountTransaction::updateAccountTransaction($payment, $payment_type);
            }
            $output = ['success' => true,
                            'msg' => __("account.account_linked_success")
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                
            $output = ['success' => false,
                        'msg' => __("messages.something_went_wrong")
                        ];
        }

        return $output;
    }
}
