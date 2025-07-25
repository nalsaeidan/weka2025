@extends('layouts.app')
@section('title', __('stock_adjustment.stock_adjustments'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('stock_adjustment.stock_adjustments')
        <small></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary', 'title' => __('stock_adjustment.all_stock_adjustments')])
        @slot('tool')
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="{{action('StockAdjustmentController@create')}}">
                <i class="fa fa-plus"></i> @lang('messages.add')</a>
            </div>
        @endslot
        <div class="table-responsive" style="overflow-x: visible;">
            <table class="table table-bordered table-striped ajax_view" id="stock_adjustment_table" style="width: 100% !important;">
                <thead>
                    <tr>
                    	<th width="5%"></th>
                        <th>@lang('messages.action')</th>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('business.location')</th>
                        <th>@lang('stock_adjustment.adjustment_type')</th>
                        <th>@lang('stock_adjustment.total_amount')</th>
                        <th>@lang('stock_adjustment.total_amount_recovered')</th>
                        <th>@lang('stock_adjustment.reason_for_stock_adjustment')</th>
                        <th>@lang('lang_v1.added_by')</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent

</section>
<!-- /.content -->
@stop
@section('javascript')
	<script src="{{ asset('js/stock_adjustment.js?v=2' . $asset_v) }}"></script>
@endsection