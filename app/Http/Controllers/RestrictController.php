<?php

namespace App\Http\Controllers;

use App\Media;
use App\Account;
use App\Accounts;
use App\Currency;
use App\Restrict;
use Carbon\Carbon;
use App\Utils\Util;
use App\AccountType;
use App\AccountTransaction;
use App\TransactionPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Contracts\DataTable;
// use Yajra\DataTables\DataTables;

class RestrictController extends Controller
{

    protected $commonUtil;

    /**
    * Constructor
    *
    * @param Util $commonUtil
    * @return void
    */
   public function __construct(Util $commonUtil)
   {
       $this->commonUtil = $commonUtil;
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_id = request()->session()->get('user.business_id');

        // if (!auth()->user()->can('restrict.access')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $user_id = request()->session()->get('user.id');
        // $currencies = Currency::all();
        // $accounts = Accounts::where('business_id', $business_id)
        //                     ->pluck('id','name','number');
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $user_id = request()->session()->get('user.id');

            $restricts = Restrict::where('business_id', $business_id)
                                   ->select(['date','id', 'reference_number','status',
                                   'debit1','credit1',
                                   'debit2','credit2',
                                   'debit3','credit3',
                                   'debit4','credit4',
                                   'debit5','credit5',
                                   'user_id'])
                                   ->get();
                                    // $debit = $restricts->debit1+$restricts->debit2+$restricts->debit3+$restricts->debit4+$restricts->debit5;

            return DataTables::of($restricts)
                    ->addColumn('date', '{{$date}}')
                    ->addColumn('id', '{{$id}}')
                    ->addColumn('reference_number', '{{$reference_number}}')
                    ->addColumn('status', '{{$status}}')
                    ->addColumn('debit', '{{$debit1}}')
                    ->addColumn('credit', '{{$credit1}}')
                    // ->addColumn('debit', '{{$debit2}}')
                    // ->addColumn('credit', '{{$credit2}}')
                    // ->addColumn('debit', '{{$debit3}}')
                    // ->addColumn('credit', '{{$credit3}}')
                    // ->addColumn('debit', '{{$debit4}}')
                    // ->addColumn('credit', '{{$credit4}}')
                    // ->addColumn('debit', '{{$debit5}}')
                    // ->addColumn('credit', '{{$credit5}}')
                    ->addColumn('created By ', '{{$user_id}}')

                    ->addColumn(
                        'action',
                        // '@can("account.update")
                        //     <a href="{{action(\'RestrictController@edit\', [$id])}}" class="btn btn-xs btn-primary" title="@lang("messages.edit")"><i class="glyphicon glyphicon-edit"></i> </a>
                        //     &nbsp;
                        // @endcan
                        '@can("restrict.view")
                        <a href="{{action(\'RestrictController@show\', [$id])}}" class="btn btn-xs btn-info" title=" @lang("messages.view")"><i class="fa fa-eye"></i></a>
                        &nbsp;
                        @endcan
                        @can("restrict.delete")
                            <button data-href="{{action(\'RestrictController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_restricts_button" title="@lang("messages.delete")"><i class="glyphicon glyphicon-trash"></i></button>
                        @endcan'
                    )
                    // ->filterColumn('type', function($query, $keyword) {
                    //     $sql = "type  like ?";
                    //     $query->whereRaw($sql, ["%{$keyword}%"]);
                    // })
                    // ->filterColumn('type', function ($query, $keyword) {
                    //     $query->whereRaw("(type) like ?", ["%{$keyword}%"]);
                    // })
                    ->rawColumns(['action', 'id','date', 'reference_number','status','debit1','credit1','debit2','credit2','debit3','credit3','debit4','credit4','debit5','credit5','user_id'])
                    ->removeColumn('')
                    ->make(true);
        }
            return view('restricts.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (!auth()->user()->can('restrict.create')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $business_id = request()->session()->get('user.business_id');
        $currencies = Currency::all();
        // $accounts = Accounts::where('business_id', $business_id)
        //             ->select('id','name','number')
        //             ->get();
        $accounts = Account::where('business_id', $business_id)->get()
                            // ->where('id', '!=', $id)
                            // ->NotClosed()
                            // ->pluck('name', 'id')
                            ;
                    
        
        $duplicate_restrict = null;
        
        return view('restricts.create')->with(compact('currencies','accounts','duplicate_restrict'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // if (!auth()->user()->can('restrict.create')) {
        //     abort(403, 'Unauthorized action.');
        // }


            //  dd(count($request->moreFields));
                $debit=[];
                $credit=[];
                $sum = 0;
                foreach ($request->moreFields as $key => $value) {
                    $debit[] = $request->moreFields[$key]['debit'.($key+1)];
                    $credit[] = $request->moreFields[$key]['credit'.($key+1)];

                } 
                // var_dump($debit);
                // dd($credit);
    try {  
            $business_id = $request->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');
            $date= $request->input('operation_date');
            // $start = Carbon::createFromFormat('d-m-Y h:i:s', $date);
            // dd($start);


                //Validate document size
            $request->validate([
                'file' => 'file|max:'. (config('constants.document_size_limit') / 1000)
            ]);
            
            $input = $request->except('moreFields','operation_date');
            $input['business_id'] = $business_id;
            $input['user_id'] = $user_id;
            $input['date'] = $date;
            
            
            foreach($request->moreFields as $key => $value){
                foreach($value as $k =>$v){
                    $input[$k] = $v;
                }

            }

            $debits = array_sum($debit);
            $credits = array_sum($credit);
            if($debits != $credits){
                $output = ['success' => 0,
                'msg' => 'القيد غير متزن'

                ];
            }
            else{

                DB::beginTransaction();

                    $restrict = Restrict::create($input);
                    // dd($restrict);
                    $business_id = session()->get('user.business_id');

                    for($i = 1 ; $i <=  count($request->moreFields) ; $i++){
                        $depit = $this->commonUtil->num_uf($request->moreFields[$i-1]['debit'.$i]);
                        $credit = $this->commonUtil->num_uf($request->moreFields[$i-1]['credit'.$i]);
                        if (!empty($depit)) {
                            $debit_data = [
                                'amount' => $depit ,
                                'account_id' => $request->moreFields[$i-1]['account_number'.$i],
                                'type' => 'debit',
                                'sub_type' => 'restrict',
                                'created_by' => session()->get('user.id'),
                                'note' => $request->moreFields[$i-1]['description'.$i],
                                // 'transfer_account_id' => $restrict->id,
                                'restrict_id'=> $restrict->id,
                                'operation_date' => $this->commonUtil->uf_date($request->input('operation_date'), true),
                            ];

                            $debitt = AccountTransaction::createAccountTransaction($debit_data);

                        }           
                        else{

                            // if(!empty($credit))
                            // {
                                $credit_data = [
                                    'amount' => $credit ,
                                    'account_id' => $request->moreFields[$i-1]['account_number'.$i],
                                    'type' => 'credit',
                                    'sub_type' => 'restrict',
                                    'created_by' => session()->get('user.id'),
                                    'note' => $request->moreFields[$i-1]['description'.$i],
                                    // 'transfer_account_id' => $restrict->id,
                                    'restrict_id'=> $restrict->id,
                                    'transfer_transaction_id' => null,
                                    'operation_date' => $this->commonUtil->uf_date($request->input('operation_date'), true),
                                ];

                                $creditt = AccountTransaction::createAccountTransaction($credit_data);
                                // dd($creditt);

                            // }
                        }
            
                    }
            
                            Media::uploadMedia($business_id, $debit, $request, 'document');

                        DB::commit();
                        // $id = ($restrict->id);
                        // $ddv = Restrict::where('id', $id)->get();
                        // var_dump($date);
                        
                        //  $a = Restrict::where('id', $id)->update(array('date' => $date));
                        //  dd($a);
                        // $ddg = Restrict::where('id', $id)->get();
                        // var_dump($ddg->date);


                $output = ['success' => 1,
                                'msg' => __('restrict.restrict_add_success')
                            ];
            }
            }catch (\Exception $e) {

            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __('messages.something_went_wrong')
                        ];
        }
        return redirect()->action('AccountController@index')->with('status', $output);

        // return redirect('restricts')->with('status', $output);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restrict  $restrict
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        // if (!auth()->user()->can('restrict.view')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $business_id = request()->session()->get('user.business_id');

        $restrict1 = Restrict::where('business_id', $business_id)
                    ->find($id);
        $restrict = $restrict1->toArray();
        $counter = AccountTransaction::where('restrict_id', $id)->count();
        $accounts = Account::where('business_id', $business_id)->get();

        return view('restricts.show')->with(compact('restrict','restrict1','accounts','counter'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restrict  $restrict
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // if (!auth()->user()->can('restrict.create')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $business_id = request()->session()->get('user.business_id');
        $currencies = Currency::all();
        $accounts = Account::where('business_id', $business_id)->get();

        
        $restrict = Restrict::where('business_id', $business_id)
                    ->find($id);
        $transacions = AccountTransaction::where('restrict_id', $id)->get();
        $counter = (count($transacions));
        
        // $duplicate_restrict = null;
        
        return view('restricts.edit')->with(compact('currencies','accounts','restrict','counter'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restrict  $restrict
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if (!auth()->user()->can('restrict.edit')) {
        //     abort(403, 'Unauthorized action.');
        // }

        try {
            
                //Validate document size
            // $request->validate([
            //     'file' => 'file|max:'. (config('constants.document_size_limit') / 1000)
            // ]);
            $business_id = $request->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');
            $restrict = Restrict::where('business_id', $business_id)
            ->find($id);

            $debits =$request->debit1 + $request->debit2 +$request->debit3 +$request->debit4 +$request->debit5;
            $credits = $request->credit1 + $request->credit2 + $request->credit3 + $request->credit4 + $request->credit5;
            $input = $request->all();

            $input['business_id'] = $business_id;
            $input['user_id'] = $user_id;

            $restrict = $restrict->update($input);
        //     $user_id = $request->session()->get('user.id');
        if($debits != $credits){
            $output = ['success' => 0,
            'msg' => 'القيد غير متزن'
        ];
        }else{
            $output = ['success' => 1,
                            'msg' => __('restrict.restrict_update_success')
                        ];
                    }
        } catch (\Exception $e) {

            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __('messages.something_went_wrong')
                        ];

            if($debits != $credits){
                $output = ['success' => 2,
                'msg' => 'القيد غير متزن'
            ];
            }
        }

    


        return redirect('restricts')->with('status', $output);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restrict  $restrict
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (!auth()->user()->can('restrict.delete')) {
        //     abort(403, 'Unauthorized action.');
        // }

        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');
                
                $restrict = Restrict::where('business_id', $business_id)
                    ->findOrFail($id);    
                
                    $restrict->delete();
                    $output = ['success' => true,
                                    'msg' => __("user.user_delete_success")
                                    ];
                } catch (\Exception $e) {
                    Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
                
                    $output = ['success' => false,
                                'msg' => __("messages.something_went_wrong")
                            ];
                }
    
                return $output;
            }    }
}
