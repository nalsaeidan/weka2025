<?php

namespace App\Http\Controllers;

use App\Brands;
use App\BusinessLocation;
use App\Category;
use App\Discount;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DiscountController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $commonUtil;

    /**
     * Constructor
     *
     * @param ProductUtils $product
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
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $discounts = Discount::where('discounts.business_id', $business_id)
                        ->leftjoin('brands as b', 'discounts.brand_id', '=', 'b.id')
                        ->leftjoin('categories as c', 'discounts.category_id', '=', 'c.id')
                        ->leftjoin('business_locations as l', 'discounts.location_id', '=', 'l.id')
                        ->select(['discounts.id', 'discounts.name', 'starts_at', 'ends_at',
                            'priority', 'b.name as brand', 'c.name as category', 'l.name as location', 'discounts.is_active', 'discounts.discount_amount', 'discount_type'])
                        ->with(['variations', 'variations.product', 'variations.product_variation']);

            return Datatables::of($discounts)
                ->addColumn(
                    'action',
                    '<button data-href="{{action(\'DiscountController@edit\', [$id])}}" class="btn btn-xs btn-primary btn-modal" data-container=".discount_modal" title="@lang("messages.edit")"><i class="glyphicon glyphicon-edit"></i></button>
                        &nbsp;
                        <button data-href="{{action(\'DiscountController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_discount_button" title="@lang("messages.delete")"><i class="glyphicon glyphicon-trash"></i></button>
                        @if($is_active != 1)
                            &nbsp;
                            <button data-href="{{action(\'DiscountController@activate\', [$id])}}" class="btn btn-xs btn-success activate-discount" title="@lang("lang_v1.reactivate")"><i class="fas fa-circle-notch"></i></button>
                        @endif
                        '
                )
                ->addColumn('row_select', function ($row) {
                    return  '<input type="checkbox" class="row-select" value="' . $row->id .'">' ;
                })
                ->addColumn('products', function($row){
                    $products = [];

                    foreach ($row->variations as $variation) {
                        $products[] = $variation->full_name;
                    }

                    return '<span class="label bg-primary">' . implode('</span>, <span class="label bg-primary">', $products) . '</span>';
                })
                ->editColumn('name', function ($row) {
                    $name = $row->is_active != 1 ? $row->name . ' <span class="label bg-yellow">' . __('lang_v1.inactive') . '</sapn>' : $row->name;

                    return $name;
                })
                ->editColumn('starts_at', function ($row) {
                    $starts_at = !empty($row->starts_at) ? $this->commonUtil->format_date($row->starts_at->toDateTimeString(), true) : '';
                    return $starts_at;
                })
                ->editColumn('ends_at', function ($row) {
                    $ends_at = !empty($row->ends_at) ? $this->commonUtil->format_date($row->ends_at->toDateTimeString(), true) : '';
                    return $ends_at;
                })
                ->editColumn('discount_amount', '{{@num_format($discount_amount)}} @if($discount_type == "percentage") % @endif')
                ->rawColumns(['name', 'action', 'row_select', 'products'])
                ->make(true);
        }
        return view('discount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $categories = Category::where('business_id', $business_id)
                            ->where('parent_id', 0)
                            ->pluck('name', 'id');

        $brands = Brands::forDropdown($business_id);

        $locations = BusinessLocation::forDropdown($business_id);

        return view('discount.create')
                ->with(compact('categories', 'brands', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['name', 'brand_id', 'category_id',
                'location_id', 'priority', 'discount_type', 'discount_amount']);

            $business_id = $request->session()->get('user.business_id');
            $input['business_id'] = $business_id;

            $variation_ids = $request->input('variation_ids');

            if (!empty($variation_ids)) {
                unset($input['brand_id']);
                unset($input['category_id']);
            }

            $input['starts_at'] = $request->has('starts_at') ? $this->commonUtil->uf_date($request->input('starts_at'), true) : null;
            $input['ends_at'] = $request->has('ends_at') ? $this->commonUtil->uf_date($request->input('ends_at'), true) : null;
            $checkboxes = ['is_active', 'applicable_in_spg', 'applicable_in_cg'];

            foreach ($checkboxes as $checkbox) {
                $input[$checkbox] = $request->has($checkbox) ? 1 : 0;
            }

            $discount = Discount::create($input);

            if (!empty($variation_ids)) {
                $discount->variations()->sync($variation_ids);
            }

            $output = ['success' => true,
                            'msg' => __("lang_v1.added_success")
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong")
                        ];
        }

        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $discount = Discount::where('business_id', $business_id)
                            ->with(['variations', 'variations.product', 'variations.product_variation'])
                            ->find($id);

            $starts_at = $this->commonUtil->format_date($discount->starts_at->toDateTimeString(), true);
            $ends_at = $this->commonUtil->format_date($discount->ends_at->toDateTimeString(), true);

            $categories = Category::where('business_id', $business_id)
                            ->where('parent_id', 0)
                            ->pluck('name', 'id');

            $brands = Brands::forDropdown($business_id);

            $locations = BusinessLocation::forDropdown($business_id);

            $variations = [];

            foreach ($discount->variations as $variation) {
                $variations[$variation->id] = $variation->full_name;
            }

            return view('discount.edit')
                ->with(compact('discount', 'starts_at', 'ends_at', 'brands', 'categories', 'locations', 'variations'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $input = $request->only(['name', 'brand_id', 'category_id',
                'location_id', 'priority', 'discount_type', 'discount_amount']);

                $business_id = $request->session()->get('user.business_id');

                $input['starts_at'] = $request->has('starts_at') ? $this->commonUtil->uf_date($request->input('starts_at'), true) : null;
                $input['ends_at'] = $request->has('ends_at') ? $this->commonUtil->uf_date($request->input('ends_at'), true) : null;
                $checkboxes = ['is_active', 'applicable_in_spg', 'applicable_in_cg'];

                foreach ($checkboxes as $checkbox) {
                    $input[$checkbox] = $request->has($checkbox) ? 1 : 0;
                }

                $variation_ids = $request->input('variation_ids');

                if (!empty($variation_ids)) {
                    unset($input['brand_id']);
                    unset($input['category_id']);
                }

                $discount = Discount::where('business_id', $business_id)
                            ->find($id);

                $discount->update($input);

                $discount->variations()->sync($variation_ids);

                $output = ['success' => true,
                            'msg' => __("lang_v1.updated_success")
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }
        
        if (request()->ajax()) {
            try {
                $business_id = request()->user()->business_id;

                $discount = Discount::where('business_id', $business_id)->findOrFail($id);
                $discount->delete();

                $output = ['success' => true,
                            'msg' => __("lang_v1.deleted_success")
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

    /**
     * Mass deactivates discounts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDeactivate(Request $request)
    {
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            if (!empty($request->input('selected_discounts'))) {
                $business_id = $request->session()->get('user.business_id');

                $selected_discounts = explode(',', $request->input('selected_discounts'));

                DB::beginTransaction();

                Discount::where('business_id', $business_id)
                            ->whereIn('id', $selected_discounts)
                            ->update(['is_active' => 0]);

                DB::commit();
            }

            $output = ['success' => 1,
                            'msg' => __('lang_v1.deactivated_success')
                        ];
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __("messages.something_went_wrong")
                        ];
        }

        return redirect()->back()->with(['status' => $output]);
    }

    /**
     * Activates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        if (!auth()->user()->can('discount.access')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');
                Discount::where('id', $id)
                    ->where('business_id', $business_id)
                    ->update(['is_active' => 1]);

                $output = ['success' => true,
                                'msg' => __("lang_v1.updated_success")
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
