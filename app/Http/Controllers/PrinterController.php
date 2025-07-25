<?php

namespace App\Http\Controllers;

use App\Printer;
use Datatables;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('access_printers')) {
             abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $printer = Printer::where('business_id', $business_id)
                        ->select(['name', 'connection_type',
                            'capability_profile', 'char_per_line', 'ip_address', 'port', 'path', 'id']);

            return Datatables::of($printer)
                ->editColumn('capability_profile', function ($row) {
                    return Printer::capability_profile_srt($row->capability_profile);
                })
                ->editColumn('connection_type', function ($row) {
                    return Printer::connection_type_str($row->connection_type);
                })
                ->addColumn(
                    'action',
                    '@can("printer.update")
                    <a href="{{action(\'PrinterController@edit\', [$id])}}" class="btn btn-xs btn-primary" title="@lang("messages.edit")"><i class="glyphicon glyphicon-edit"></i> </a>
                        &nbsp;
                    @endcan
                    @can("printer.delete")
                        <button data-href="{{action(\'PrinterController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_printer_button" title=" @lang("messages.delete")"><i class="glyphicon glyphicon-trash"></i></button>
                    @endcan'
                )
                ->removeColumn('id')
                ->rawColumns([7])
                ->make(false);
        }

        return view('printer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('access_printers')) {
             abort(403, 'Unauthorized action.');
        }

        $capability_profiles = Printer::capability_profiles();
        $connection_types = Printer::connection_types();

        return view('printer.create')
            ->with(compact('capability_profiles', 'connection_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('access_printers')) {
             abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = $request->session()->get('user.business_id');
            $input = $request->only(['name', 'connection_type', 'capability_profile', 'ip_address', 'port', 'path', 'char_per_line']);

            $input['business_id'] = $business_id;
            $input['created_by'] = $request->session()->get('user.id');
            ;

            if ($input['connection_type'] == 'network') {
                $input['path'] = '';
            } elseif (in_array($input['connection_type'], ['windows', 'linux'])) {
                $input['ip_address'] = '';
                $input['port'] = '';
            }

            $printer = new Printer;
            $printer->fill($input)->save();

            $output = ['success' => 1,
                            'msg' => __('printer.added_success')
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong")
                        ];
        }

        return redirect('printers')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('access_printers')) {
             abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $printer = Printer::where('business_id', $business_id)->find($id);

        $capability_profiles = Printer::capability_profiles();
        $connection_types = Printer::connection_types();

        return view('printer.edit')
            ->with(compact('printer', 'capability_profiles', 'connection_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('access_printers')) {
             abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['name', 'connection_type', 'capability_profile', 'ip_address', 'port', 'path', 'char_per_line']);
            $business_id = $request->session()->get('user.business_id');

            $printer = Printer::where('business_id', $business_id)->findOrFail($id);

            if ($input['connection_type'] == 'network') {
                $input['path'] = '';
            } elseif (in_array($input['connection_type'], ['windows', 'linux'])) {
                $input['ip_address'] = '';
                $input['port'] = '';
            }

            $printer->fill($input)->save();

            $output = ['success' => true,
                        'msg' => __("printer.updated_success")
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
        
            $output = ['success' => false,
                        'msg' => __("messages.something_went_wrong")
                    ];
        }

        return redirect('printers')->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('access_printers')) {
             abort(403, 'Unauthorized action.');
        }
        
        if (request()->ajax()) {
            try {
                $business_id = request()->user()->business_id;

                $printer = Printer::where('business_id', $business_id)->findOrFail($id);
                $printer->delete();

                $output = ['success' => true,
                            'msg' => __("printer.deleted_success")
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
