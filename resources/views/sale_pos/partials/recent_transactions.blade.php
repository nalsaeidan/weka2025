@php
	$subtype = '';
@endphp
@if(!empty($transaction_sub_type))
	@php
		$subtype = '?sub_type='.$transaction_sub_type;
	@endphp
@endif

@if(!empty($transactions))
	<table class="table table-slim no-border">
		@foreach ($transactions as $transaction)
		{{-- {{ dd($transaction) }} --}}

			<tr class="cursor-pointer" 
	    		title="Customer: {{optional($transaction->contact)->name}} 
		    		@if(!empty($transaction->contact->mobile) && $transaction->contact->is_default == 0)
		    			<br/>Mobile: {{$transaction->contact->mobile}}
		    		@endif
					">
					
				<td>
					{{ $loop->iteration}}.
				</td>
				<td>
					{{ $transaction->invoice_no }} ({{optional($transaction->contact)->name}})
					@if(!empty($transaction->table))
						- {{$transaction->table->name}}
					@endif
				</td>

				<td>
					@if(!empty($transaction->return_parent))
					{{-- {{$transaction->return_parent->invoice_no}} --}}
					<small class="label bg-red label-round no-print" title="' . __('lang_v1.some_qty_returned_from_sell') .'"><i class="fas fa-undo"></i></small>
					@else
					{{ ''}}
					@endif

				</td>
				
				<td class="display_currency">
					{{ $transaction->final_total }}
					
				</td>
				<td>
					<a href="{{action('SellPosController@edit', [$transaction->id]).$subtype}}">
	    				<i class="fas fa-pen text-muted" aria-hidden="true" title="{{__('lang_v1.click_to_edit')}}"></i>
	    			</a>
	    			
	    			<a href="{{action('SellPosController@destroy', [$transaction->id])}}" class="delete-sale" style="padding-left: 20px; padding-right: 20px"><i class="fa fa-trash text-danger" title="{{__('lang_v1.click_to_delete')}}"></i></a>

	    			<a href="{{action('SellPosController@printInvoice', [$transaction->id])}}" class="print-invoice-link">
	    				<i class="fa fa-print text-muted" aria-hidden="true" title="{{__('lang_v1.click_to_print')}}"></i>
	    			</a>

					<a href="{{action('SellReturnController@add', [$transaction->id])}}" style="padding-left: 20px; padding-right: 20px"><i class="fas fa-undo" title="{{__("lang_v1.sell_return")}}"></i></a>
					
				</td>
			</tr>
		@endforeach
	</table>
@else
	<p>@lang('sale.no_recent_transactions')</p>
@endif