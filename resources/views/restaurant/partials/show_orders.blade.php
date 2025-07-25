@forelse($orders as $order)
	<div class="col-md-3 col-xs-6 order_div">
		<div class="small-box bg-gray">
            <div class="inner">
            	<h4 class="text-center">#{{$order->invoice_no}}</h4>
				<h4 class="text-center">رقم الدور = {{$order->record_number}}#</h4>
				<table class="table no-margin no-border table-slim">
            		{{-- <tr><th>@lang('restaurant.placed_at')</th><td>{{@format_date($order->created_at)}} {{ @format_time($order->created_at)}}</td></tr>
            		<tr><th>@lang('restaurant.order_status')</th> --}}
                              @php
                                    $count_sell_line = count($order->sell_lines);
                                    $count_cooked = count($order->sell_lines->where('res_line_order_status', 'cooked'));
                                    $count_served = count($order->sell_lines->where('res_line_order_status', 'served'));
                                    $order_status =  'received';
                                    if($count_cooked == $count_sell_line) {
                                          $order_status =  'cooked';
                                    } else if($count_served == $count_sell_line) {
                                          $order_status =  'served';
                                    } else if ($count_served > 0 && $count_served < $count_sell_line) {
                                          $order_status =  'partial_served';
                                    } else if ($count_cooked > 0 && $count_cooked < $count_sell_line) {
                                          $order_status =  'partial_cooked';
                                    }
                                    
                              @endphp
                              {{-- <td><span class="label @if($order_status == 'cooked' ) bg-red @elseif($order_status == 'served') bg-green @elseif($order_status == 'partial_cooked') bg-orange @else bg-light-blue @endif">@lang('restaurant.order_statuses.' . $order_status) </span></td> --}}
							  <td> </td>
                        </tr>
            		<tr><th>@lang('contact.customer')</th><td>{{$order->customer_name}}</td></tr>
            		<tr><th>@lang('restaurant.table')</th><td>{{$order->table_name}}</td></tr>
            		{{-- <tr><th>@lang('sale.location')</th><td>{{$order->business_location}}</td></tr> --}}
					<tr>
						<th>#</th>
						<th>الطبات</th>
						<th>الكمية</th>

					</tr>
					@foreach($order->sell_lines as $sell_line)
					<tr>
						<td>{{ $loop->iteration }}</td>

						<td>

							{{ $sell_line->product->name }}
							@if( $sell_line->product->type == 'variable')
							- {{ $sell_line->variations->product_variation->name ?? ''}}
							- {{ $sell_line->variations->name ?? ''}},
							@endif
							<!--{{ $sell_line->variations->sub_sku ?? ''}}-->
							@php
							$brand = $sell_line->product->brand;
							@endphp
							@if(!empty($brand->name))
							, {{$brand->name}}
							@endif
			
							@if(!empty($sell_line->sell_line_note))
							<br> {{$sell_line->sell_line_note}}
							@endif
							
						</td>
						{{-- <td>
							{{ $sell_line->product->name}}
						</td> --}}
						<td><span>{{$sell_line->quantity}}</span></td>

					</tr>						
					@if(!empty($sell_line->modifiers))
        						@foreach($sell_line->modifiers as $modifier)
								<tr>
									<td>&nbsp;</td>
									<td>
										{{ $modifier->product->name }} - {{ $modifier->variations->name ?? ''}},
										<!--{{ $modifier->variations->sub_sku ?? ''}}-->
									</td>
									
									<td>{{ $modifier->quantity }}</td>
			
						
            						@endforeach
								</tr>
        			@endif
				@endforeach

            	</table>
            </div>
            @if($orders_for == 'kitchen')
            	<a href="#" class="btn btn-flat small-box-footer bg-yellow mark_as_cooked_btn" data-href="{{action('Restaurant\KitchenController@markAsCooked', [$order->id])}}"><i class="fa fa-check-square-o"></i> @lang('restaurant.mark_as_cooked')</a>
            @elseif($orders_for == 'waiter' && $order->res_order_status != 'served')
            	<a href="#" class="btn btn-flat small-box-footer bg-yellow mark_as_served_btn" data-href="{{action('Restaurant\OrderController@markAsServed', [$order->id])}}"><i class="fa fa-check-square-o"></i> @lang('restaurant.mark_as_served')</a>
            @else
            	<div class="small-box-footer bg-gray">&nbsp;</div>
            @endif
            	<a href="#" class="btn btn-flat small-box-footer bg-info btn-modal" data-href="{{ action('SellController@show', [$order->id])}}" data-container=".view_modal">@lang('restaurant.order_details') <i class="fa fa-arrow-circle-right"></i></a>
         </div>
	</div>
	@if($loop->iteration % 4 == 0)
		<div class="hidden-xs">
			<div class="clearfix"></div>
		</div>
	@endif
	@if($loop->iteration % 2 == 0)
		<div class="visible-xs">
			<div class="clearfix"></div>
		</div>
	@endif
@empty
<div class="col-md-12">
	<h4 class="text-center">@lang('restaurant.no_orders_found')</h4>
</div>
@endforelse