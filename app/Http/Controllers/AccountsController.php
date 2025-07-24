<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

use App\Accounts;
use Illuminate\Http\Request;
use App\Utils\Util;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
// use Yajra\DataTables\Facades\DataTables;
class AccountsController extends Controller
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

        if (request()->ajax()) {
            $accounts = Cache::remember("accounts_list_{$business_id}", 60, function () use ($business_id) {
                return Accounts::where('business_id', $business_id)
                    ->select(['id', 'name', 'number', 'type'])
                    ->get();
            });

            return DataTables::of($accounts)
                ->addColumn('name', '{{$name}}')
                ->addColumn('number', '{{$number}}')
                ->addColumn('type', '{{$type}}')
                ->addColumn('action',
                    '@can("accounts.update")
                        <a href="{{action(\'AccountsController@edit\', [$id])}}" class="btn btn-xs btn-primary" title="@lang("messages.edit")">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                    @endcan

                    @can("accounts.delete")
                        <button data-href="{{action(\'AccountsController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_accounts_button" title="@lang("messages.delete")">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    @endcan'
                )
                ->removeColumn('id')
                ->rawColumns(['action', 'name','number','type'])
                ->make(true);
        }

        return view('accounts.index');
    }

            return view('accounts.index');
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (!auth()->user()->can('accounts.access')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $business_id = request()->session()->get('user.business_id');

        $accounts =Accounts::all();
        $duplicate_accounts = null;
        if (!empty(request()->input('number'))) {
            $duplicate_accounts = Accounts::where('business_id', $business_id)->find(request()->input('number'));
            $duplicate_accounts->number .= ' (copy)';
        }
        if (!empty(request()->input('name'))) {
            $duplicate_accounts = Accounts::where('business_id', $business_id)->find(request()->input('name'));
            $duplicate_accounts->name .= ' (copy)';
        }

        return view('accounts.create')->with(compact('accounts','duplicate_accounts'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (!auth()->user()->can('accounts.create')) {
        //     abort(403, 'Unauthorized action.');
        // }
        try {
            $business_id = $request->session()->get('user.business_id');
            $input = $request->only(['name','type','number','accounts_id','description']);
            $input['business_id'] = $business_id;
            $input['currency'] ='';
            $account = Accounts::create($input);

            $output = ['success' => true,
                            'data' => $account,
                            'msg' => __("accounts.added_success")
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong")
                        ];
        }

        return redirect('accounts')->with('status', $output);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function show(Accounts $accounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (!auth()->user()->can('accounts.update')) {
        //     abort(403, 'Unauthorized action.');
        // }

        $business_id = request()->session()->get('user.business_id');
        $account = Accounts::where('business_id', $business_id)
                    ->findOrFail($id);
        if ($account->account_status == 'active') {
            $is_checked_checkbox = true;
        } else {
            $is_checked_checkbox = false;
        }

        $accounts = Accounts::all();

        return view('accounts.edit')
                ->with(compact('account','is_checked_checkbox','accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('accounts.update')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['name','type','number','accounts_id','description']);
            $input['account_status'] = !empty($request->input('is_active')) ? 'active' : 'inactive';
            $business_id = request()->session()->get('user.business_id');
            $input['business_id'] = $business_id;
            $account = Accounts::where('business_id', $business_id)
                        ->findOrFail($id);
            $account->update($input);
            
            $output = ['success' => 1,
            'msg' => __("accounts.accounts_update_success")
        ]; 

        }  catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __('messages.something_went_wrong')
                        ];
        }

        return redirect('accounts')->with('status', $output);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (!auth()->user()->can('accounts.delete')) {
        //     abort(403, 'Unauthorized action.');
        // }

        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');
                
                $account = Accounts::where('business_id', $business_id)
                    ->findOrFail($id);    
                
                    $account->delete();
                    $output = ['success' => true,
                                    'msg' => __("user.user_delete_success")
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
    }
