@extends('layouts.app')
@section('title', __('sale.discount'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang( 'sale.discount' )
    </h1>
    
</section>

<!-- Main content -->
<section class="content">

	<div class="box">
        <div class="box-header">
        	<h3 class="box-title">@lang('lang_v1.all_your_discounts')</h3>
            @can('brand.create')
            	<div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-href="{{action('DiscountController@create')}}" 
                    data-container=".discount_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                </div>
            @endcan
        </div>
        <div class="box-body">
            @can('brand.view')
                <div class="table-responsive" style="overflow-x: visible;">
            	<table class="table table-bordered table-striped" id="discounts_table" style="width: 100% !important;">
            		<thead>
            			<tr>
                        	
                        	<th width="5%"></th>
                            <th><input type="checkbox" id="select-all-row" data-table-id="discounts_table"></th>
            				<th>@lang( 'unit.name' )</th>
            				<th>@lang( 'lang_v1.starts_at' )</th>
            				<th>@lang( 'lang_v1.ends_at' )</th>
                            <th>@lang( 'sale.discount_amount' )</th>
                            <th>@lang( 'lang_v1.priority' )</th>
                            <th>@lang( 'product.brand' )</th>
                            <th>@lang( 'product.category' )</th>
                            <th>@lang( 'report.products' )</th>
                            <th>@lang( 'sale.location' )</th>
                            <th>@lang( 'messages.action' )</th>
            			</tr>
            		</thead>
                    <tfoot>
                    <tr>
                        <td colspan="12">
                        <div style="display: flex; width: 100%;">
                            {!! Form::open(['url' => action('DiscountController@massDeactivate'), 'method' => 'post', 'id' => 'mass_deactivate_form' ]) !!}
                            {!! Form::hidden('selected_discounts', null, ['id' => 'selected_discounts']); !!}
                            {!! Form::submit(__('lang_v1.deactivate_selected'), array('class' => 'btn btn-xs btn-warning', 'id' => 'deactivate-selected')) !!}
                            {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            	</table>
                </div>
            @endcan
        </div>
    </div>

    <div class="modal fade discount_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">

    $(document).on('click', '#deactivate-selected', function(e){
        e.preventDefault();
        var selected_rows = [];
        var i = 0;
        $('.row-select:checked').each(function () {
            selected_rows[i++] = $(this).val();
        }); 
        
        if(selected_rows.length > 0){
            $('input#selected_discounts').val(selected_rows);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('form#mass_deactivate_form').submit();
                }
            });
        } else{
            $('input#selected_discounts').val('');
            swal('@lang("lang_v1.no_row_selected")');
        }    
    });

    $(document).on('click', '.activate-discount', function(e){
        e.preventDefault();
        var href = $(this).data('href');
        $.ajax({
            method: "get",
            url: href,
            dataType: "json",
            success: function(result){
                if(result.success == true){
                    toastr.success(result.msg);
                    discounts_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });

    $(document).on('shown.bs.modal', '.discount_modal', function(){
        $('#variation_ids').select2({
            ajax: {
                url: '/purchases/get_products?check_enable_stock=false&only_variations=true',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    var results = [];
                    for (var item in data) {
                        results.push(
                            {
                                id: data[item].variation_id,
                                text: data[item].text,
                            }
                        );
                    }
                    return {
                        results: results,
                    };
                },
            },
            minimumInputLength: 1,
            closeOnSelect: false
        });
    });

    $(document).on('change', '#variation_ids', function(){
        if ($(this).val().length) {
            $('#brand_input').addClass('hide');
            $('#category_input').addClass('hide');
        } else {
            $('#brand_input').removeClass('hide');
            $('#category_input').removeClass('hide');
        }
    });

    $(document).on('hidden.bs.modal', '.discount_modal', function(){
        $("#variation_ids").select2('destroy'); 
    });
$('table#sell_table>tbody').on('click', 'td.details-control', function () {
	$('table#sell_table>tbody>tr').removeAttr('data-href');

        var tr = $(this).closest('tr');
        var row = sell_table.row( 'tr' );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            //row.child.hide();
            tr.removeClass('shown');
        }
        else {
       // $('table#sell_table>tbody>tr').removeAttr('data-href');
            // Open this row
            //row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

</script>
@endsection
