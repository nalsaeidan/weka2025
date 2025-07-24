<style>
	.icons{
		float:right;
		width: auto;
		border-radius: 30px;
		border: 1px solid;
		padding: 10px;
		background: #007665 !important;
		color: #ffffff !important;
	}
	.fa, .fas, :before {
		color: white !important;
	}
	.data{
		float:left;
		text-align: right;
		width:80%;
		padding: 7px 9px;
	}
	@media(max-width: 991px){
		.right-invoice-info{
			/*margin-top: -100px;*/
		}
	}

	// .table.table-bordered thead{
	// 	background-color: #007665 !important;
	// }

</style>
<div>
	<table id="parent" style="width:100%; direction:rtl !important">
		<thead>
		<tr>
			<td colspan="2">
				<!-- Logo -->
				@if(!empty($receipt_details->logo))
					<p><img style=" max-height: 120px; width: auto;" src="{{$receipt_details->logo}}"></p>
					<br/>
				@endif
			<!-- Shop & Location Name  -->
				@if(!empty($receipt_details->display_name))
					<p><strong>{{$receipt_details->display_name}}</strong></p>
					@if(!empty($receipt_details->address))
						<p>{!! $receipt_details->address !!}</p>
					@endif

					@if(!empty($receipt_details->contact))
						<p><strong>{!! $receipt_details->contact !!}</strong></p>
					@endif

					@if(!empty($receipt_details->website))
						<p>{{ $receipt_details->website }}</p>
					@endif

					@if(!empty($receipt_details->tax_info1))
						<p>{{ $receipt_details->tax_label1 }} {{ $receipt_details->tax_info1 }}</p>
					@endif

					@if(!empty($receipt_details->tax_info2) && !empty($receipt_details->tax_label2))
						<p>{{ $receipt_details->tax_label2 }} {{ $receipt_details->tax_info2 }}</p>
					@endif

					@if(!empty($receipt_details->location_custom_fields))
						<p>{{ $receipt_details->location_custom_fields }}</p>
					@endif
					@if(!empty($receipt_details->commession))
						<p>{{" مندوب:  "}}{{ $receipt_details->commession }}<p>
						@endif
						@endif
						<!-- Display type of service details -->
						@if(!empty($receipt_details->types_of_service) && !empty($receipt_details->types_of_service_label))
							<p><strong>{!! $receipt_details->types_of_service_label !!}:</strong>
								{{$receipt_details->types_of_service}}
							</p>
							<!-- Waiter info -->
							@if(!empty($receipt_details->types_of_service_custom_fields))

								@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
									<p><strong>{{$key}}: </strong> {{$value}} </p>@if(!$loop->last), @endif
								@endforeach
							@endif
						@endif
					<!-- Table information-->
						@if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
							<p>
								@if(!empty($receipt_details->table_label))
									{!! $receipt_details->table_label !!}
								@endif
								{{$receipt_details->table}}
							</p>
						@endif

					<!-- Waiter info -->
						@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
							<p>
								@if(!empty($receipt_details->service_staff_label))
									{!! $receipt_details->service_staff_label !!}
								@endif
								{{$receipt_details->service_staff}}
							</p>
						@endif
						@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
							@if(!empty($receipt_details->brand_label))
								<p>
									<strong>{!! $receipt_details->brand_label !!}</strong>
								</p>
								{{$receipt_details->repair_brand}}
							@endif
						@endif

						@if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
							@if(!empty($receipt_details->device_label))
								<p>
									<strong>{!! $receipt_details->device_label !!}</strong>

									{{$receipt_details->repair_device}}
								</p>
							@endif
						@endif

						@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
							@if(!empty($receipt_details->model_no_label))
								<p>
									<strong>{!! $receipt_details->model_no_label !!}</strong>
									{{$receipt_details->repair_model_no}}
								</p>
							@endif
						@endif

						@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
							@if(!empty($receipt_details->serial_no_label))
								<p>
									<strong>{!! $receipt_details->serial_no_label !!}</strong>
									{{$receipt_details->repair_serial_no}}
								</p>
							@endif
						@endif
						@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
							@if(!empty($receipt_details->repair_status_label))
								<p>
									<strong>{!! $receipt_details->repair_status_label !!}</strong>
									{{$receipt_details->repair_status}}
								</p>
							@endif
						@endif

						@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
							@if(!empty($receipt_details->repair_warranty_label))
								<p>
									<strong>{!! $receipt_details->repair_warranty_label !!}</strong>
									{{$receipt_details->repair_warranty}}
								</p>
							@endif
						@endif
			</td>
			<td>
                                @if(!empty($receipt_details->header_text))
					<p style="font-size: 18px !important;">{!! $receipt_details->header_text !!}</p>
				@endif
                                 @if(!empty($receipt_details->transaction_type))
                        @if($receipt_details->transaction_type == 'sell_return')
                            <h5 class="text-left" style="font-weight: bold; font-size: 18px !important; color:#007665 !important;">{{'فاتورة مرتجعة'}}</h5>
						@endif
                   @endif   
				

				@php
					if (!empty($receipt_details->sub_heading_line1) && !empty($receipt_details->sub_heading_line2) && !empty($receipt_details->sub_heading_line3) && !empty($receipt_details->sub_heading_line4) && !empty($receipt_details->sub_heading_line5) ){
$sub_headings = implode('<br/>', array_filter([$receipt_details->sub_heading_line1, $receipt_details->sub_heading_line2, $receipt_details->sub_heading_line3, $receipt_details->sub_heading_line4, $receipt_details->sub_heading_line5]));
}
if (!empty($receipt_details->invoice_heading)){
$heading = explode(" ",$receipt_details->invoice_heading);
}
				@endphp

				@if(!empty($sub_headings))
					<span>{!! $sub_headings !!}</span>
				@endif
@if($receipt_details->transaction_type == 'sell')
				@if(!empty($receipt_details->invoice_heading))
					<p class="" style="font-weight: bold; font-size: 20px !important; color:#007665 !important;">
						{!! $heading[0] !!}
						@if(!empty($heading[1]))
							{!! $heading[1] !!}
						@endif
						@if(!empty($heading[2]))
							{!! $heading[2] !!}
						@endif
					</p>
				@endif
				@endif
				<p class="font-20 color-555">
					@if(!empty($receipt_details->invoice_no_prefix) && !empty($receipt_details->invoice_no))
						<strong>{!! $receipt_details->invoice_no_prefix !!}</strong>
					@endif
					{{$receipt_details->invoice_no}}
				</p>

				<!-- Date-->
				<p style="text-align: right" class="font-20 color-555">
					@if(!empty($receipt_details->date_label) && !empty($receipt_details->invoice_date))
						{{$receipt_details->date_label}}
					@endif
					{{$receipt_details->invoice_date}}
				</p>


				@if(!empty($receipt_details->due_date_label) && !empty($receipt_details->due_date))
					<p style="text-align: right" class="font-20 color-555">
						{{$receipt_details->due_date_label}}
						{{$receipt_details->due_date . ''}}
					</p>
				@endif
			<!-- customer info -->

				@if(!empty($receipt_details->customer_label))
					<p><b>{{ $receipt_details->customer_label }}</b>
						@endif
						@if(!empty($receipt_details->customer_info))
							<strong>{!! $receipt_details->customer_info !!}</strong>
						@endif
						@if(!empty($receipt_details->client_id_label) && !empty($receipt_details->client_id))</p>
					<p><strong>{{ $receipt_details->client_id_label }}</strong> {{ $receipt_details->client_id }}</p>
				@endif
				@if(!empty($receipt_details->customer_tax_number))
					<p><strong>الرقم الضريبي: </strong> {{ $receipt_details->customer_tax_number }}</p>
				@endif
				@if(!empty($receipt_details->customer_custom_fields))
					<p>{!! $receipt_details->customer_custom_fields !!}</p>
				@endif
				@if(!empty($receipt_details->sales_person_label) && !empty($receipt_details->sales_person))
					<p><strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}</p>
				@endif

				@if(!empty($receipt_details->customer_rp_label) && !empty($receipt_details->customer_total_rp))
					<p><strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}</p>
				@endif
			</td>
		</tr>
		@if(!empty($receipt_details->shipping_custom_field_1_label) || !empty($receipt_details->shipping_custom_field_2_label))
			<tr>
				<td colspan="2">
					@if(!empty($receipt_details->shipping_custom_field_1_label))
						<strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value . ''!!}
					@endif
				</td>
				<td>
					@if(!empty($receipt_details->shipping_custom_field_2_label))
						<strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value . ''!!}
					@endif
				</td>
			</tr>
		@endif
		@if(!empty($receipt_details->shipping_custom_field_3_label) || !empty($receipt_details->shipping_custom_field_4_label))
			<tr>
				<td colspan="2">
					@if(!empty($receipt_details->shipping_custom_field_3_label))
						<strong>{!!$receipt_details->shipping_custom_field_3_label!!} :</strong> {!!$receipt_details->shipping_custom_field_3_value . ''!!}
					@endif
				</td>
				<td>
					@if(!empty($receipt_details->shipping_custom_field_4_label))
						<strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value . ''!!}
					@endif
				</td>
			</tr>
		@endif
		@if(!empty($receipt_details->shipping_custom_field_5_label))
			<tr>
				<td colspan="3">
					@if(!empty($receipt_details->shipping_custom_field_5_label))
						<strong>{!!$receipt_details->shipping_custom_field_5_label!!} :</strong> {!!$receipt_details->shipping_custom_field_5_value . ''!!}
					@endif
				</td>
			</tr>
		@endif
		@if(!empty($receipt_details->sale_orders_invoice_no) || !empty($receipt_details->sale_orders_invoice_date))
			<tr>
				<td colspan="2">
					<strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no . ''!!}
				</td>
				<td>
					<strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date . ''!!}
				</td>
			</tr>
		@endif

		</thead>

		<tbody>
		<tr>
			<td colspan="3">
				<div class="row">
					@includeIf('sale_pos.receipts.partial.common_repair_invoice')
				</div>

				<div class="row">
					<div class="col-xs-12">
						<table class="table table-bordered">
							<thead id="tbl1" style="color:#ffffff !important">
							<tr>
								@if (!empty($receipt_details->sell_custom_field_1_value))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="50%">
										{{$receipt_details->sell_custom_field_1_label}}
									</th>
								@endif
								@if (!empty($receipt_details->sell_custom_field_2_value))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="50%">
										{{$receipt_details->sell_custom_field_2_label}}
									</th>
								@endif
								@if (!empty($receipt_details->sell_custom_field_3_value))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="50%">
										{{$receipt_details->sell_custom_field_3_label}}
									</th>
								@endif
								@if (!empty($receipt_details->sell_custom_field_4_value))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="50%">
										{{$receipt_details->sell_custom_field_4_label}}
									</th>
								@endif
							</tr>
							</thead>
							<tbody>
							<tr style="background: #eae9e9;">
								@if (!empty($receipt_details->sell_custom_field_1_value))
									<td>
										{{$receipt_details->sell_custom_field_1_value}}
									</td>
								@endif
								@if (!empty($receipt_details->sell_custom_field_2_value))
									<td>
										{{$receipt_details->sell_custom_field_2_value}}
									</td>
								@endif
								@if (!empty($receipt_details->sell_custom_field_3_value))
									<td>
										{{$receipt_details->sell_custom_field_3_value}}
									</td>
								@endif
								@if (!empty($receipt_details->sell_custom_field_4_value))
									<td>
										{{$receipt_details->sell_custom_field_4_value}}
									</td>
								@endif
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<br/>
						@php
							if (!empty($receipt_details)){
                                if(!empty($receipt_details->line_tax_label)){
                                $total_row_tax = 0.0;
                                foreach($receipt_details->lines as $line){
                                $total_row_tax = (float) $total_row_tax + ($line['tax'] * $line['quantity']) ;
                                }
                                }
                                }
						@endphp
						<table class="table table-bordered">
							<thead id="tbl1" style="color:#ffffff !important">
							<tr>
								<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="5%">#</th>

								@php
									$p_width = 25;
								@endphp
								@if($receipt_details->show_cat_code != 1)
									@php
										$p_width = 35;
									@endphp
								@endif
								@if(!empty($receipt_details->table_product_label))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="30%">
										{{$receipt_details->table_product_label}}
									</th>
								@endif

								{{--								@if($receipt_details->show_cat_code == 1)--}}
								{{--								<th style="text-align: right">{{$receipt_details->cat_code_label}}</th>--}}
								{{--						@endif --}}
								@if(!empty($receipt_details->table_qty_label))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="10%">
										{{$receipt_details->table_qty_label}}
									</th>
								@endif
								@if(!empty($receipt_details->table_unit_price_label))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="10%">
										{{$receipt_details->table_unit_price_label}}
									</th>
								@endif
								@if($total_row_tax > 0.0)
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="15%">
										@if(!empty($receipt_details->table_unit_price_label))
											{{--										{{$receipt_details->table_unit_price_label}} --}}
											@lang('product.inc_of_tax')
										@endif
									</th>
								@endif
								@if(!empty($receipt_details->line_discount_label))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="10%">
										{{$receipt_details->line_discount_label}}
									</th>
								@endif
								@if($total_row_tax > 0.0)
									@if(!empty($receipt_details->line_tax_label))
										<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="10%">
											{{$receipt_details->line_tax_label}}
										</th>
									@endif
								@endif
								@if(!empty($receipt_details->table_subtotal_label))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important" width="15%">
										{{$receipt_details->table_subtotal_label}}
									</th>
								@endif
							</tr>
							</thead>
							<tbody>
							@foreach($receipt_details->lines as $line)
								<tr style="background: #eae9e9;">
									<td>
										{{$loop->iteration}}
									</td>
									<td>
										@if(!empty($line['image'] ))
											<img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
										@endif
										@if(!empty($line['name']))
											{{$line['name']}} @endif @if(!empty($line['product_variation'])) {{$line['product_variation']}} @endif @if(!empty($line['variation'])) {{$line['variation']}} @endif

										@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
										@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
										@if(!empty($line['sell_line_note']))
											<br>
											<small class="text-muted">{{$line['sell_line_note']}}</small>
										@endif
										@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif
										@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

										@if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
										@if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] . ''}}</small>@endif
										@if(!empty($line['product_description'])) <br/> <small> {!! $line['product_description'] !!} </small> @endif
									</td>
									{{--								@if($receipt_details->show_cat_code == 1)--}}
									{{--									<td>--}}
									{{--@if(!empty($line['cat_code']))--}}
									{{--										{{$line['cat_code']}}--}}
									{{--									@endif--}}
									{{--											</td>--}}
									{{--                                        @endif--}}


									@if(!empty($line['quantity']) && !empty($line['units']))
										<td>
											{{$line['quantity']}} {{$line['units']}}
										</td>
									@endif
									<td>
										@if(!empty($line['unit_price_before_discount_uf']))
											{{$line['unit_price_before_discount_uf']}}
										@elseif(!empty($line['unit_price']))
											{{$line['unit_price']}}
										@endif
									</td>

									@if($total_row_tax > 0)
										{{--										@if(!empty($receipt_details->table_unit_price_label))--}}
										@php
											if(!empty($line['unit_price_inc_tax'])){
                                                $line['unit_price_inc_tax'] = $line['unit_price_inc_tax'];}
										@endphp

										<td>
											{{$line['unit_price_inc_tax']}}
										</td>
									@endif
									{{--									@endif--}}

									<td>
										@if(!empty($line['line_discount']))
											{{$line['line_discount']}}
										@else
											{{0.00}}
										@endif
									</td>


									@if($total_row_tax > 0)
										@if(!empty($receipt_details->line_tax_label))
											@if(!empty($line['tax']) && !empty($line['quantity']))
												<td>
													{{ $line['tax'] * $line['quantity'] }}
													{{--												{{$line['tax_name']}}--}}
												</td>
											@endif
										@endif
									@endif
									@if(!empty($line['line_total']))
										<td>
											{{$line['line_total']}}
										</td>
									@endif
								</tr>
							@endforeach

							@php
								if (!empty($receipt_details)){
                                    if (!empty($receipt_details->lines)){
                                        $lines = count($receipt_details->lines);
                                    }
                                }
							@endphp
							{{-- @for ($i = $lines; $i < 5; $i++)
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    @if($receipt_details->show_cat_code == 1)
                                        <td> </td>
                                    @endif
                                </tr>
                            @endfor --}}
							</tbody>
						</table>
					</div>
				</div>
				<div class="row invoice-info text-right" style="page-break-inside: avoid !important">
					<div class="col-md-12 invoice-col width-100">
						<table class="table table-bordered">
							<thead style="background:#007665 ; color:#ffffff !important">
							<tr style="text-align: right">
								@if(!empty($receipt_details->total_quantity_label))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										{!! $receipt_details->total_quantity_label !!}
									</th>
								@endif
								@if(!empty($receipt_details->subtotal_label))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										{!! $receipt_details->subtotal_label !!}
									</th>
								@endif
								@if(!empty($receipt_details->shipping_charges))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										{!! $receipt_details->shipping_charges_label !!}
									</th>
								@endif
								@if(!empty($receipt_details->packing_charge))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										{!! $receipt_details->packing_charge_label !!}
									</th>
								@endif
								@if( !empty($receipt_details->discount))
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										{!! $receipt_details->discount_label !!}
									</th>
								@endif
								@if( !empty($receipt_details->reward_point_label) )
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										{!! $receipt_details->reward_point_label !!}
									</th>

								@endif
								@if(!empty($receipt_details->group_tax_details))
									@foreach($receipt_details->group_tax_details as $key => $value)
										<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
											{!! $key !!}
										</th>
									@endforeach
								@else
									@if( !empty($receipt_details->tax) )
										<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
											{!! $receipt_details->tax_label !!}
										</th>
									@endif
								@endif

								@if($total_row_tax > 0)
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										ضريبة القيمة المضافة
									</th>
								@endif

								@if( $receipt_details->round_off_amount > 0)
									<th style="text-align: right; background: #007665 !important; color: #ffffff !important">
										{!! $receipt_details->round_off_label !!}
									</th>
								@endif

							</tr>
							</thead>
							<tbody>
							<tr style="background: #eae9e9;">
								@if(!empty($receipt_details->total_quantity))
									<td style="text-align: right">
										{{$receipt_details->total_quantity}}
									</td>
								@endif
								@if(!empty($receipt_details->subtotal))
									<td style="text-align: right">
										{{$receipt_details->subtotal}}
									</td>
								@endif
							<!-- Shipping Charges -->
								@if(!empty($receipt_details->shipping_charges))
									<td style="text-align: right">
										{{$receipt_details->shipping_charges}}
									</td>
								@endif

								@if(!empty($receipt_details->packing_charge))
									<td style="text-align: right">
										{{$receipt_details->packing_charge}}
									</td>
								@endif

							<!-- Discount -->
								@if( !empty($receipt_details->discount) )
									<td style="text-align: right">
										(-) {{$receipt_details->discount}}
									</td>
								@endif

								@if( !empty($receipt_details->reward_point_amount) )
									<td style="text-align: right">
										(-) {{$receipt_details->reward_point_amount}}
									</td>
								@endif

								@if(!empty($receipt_details->group_tax_details))
									@foreach($receipt_details->group_tax_details as $key => $value)
										<td style="text-align: right">
											(+) {{$value}}
										</td>
									@endforeach
								@else
									@if( !empty($receipt_details->tax) )
										<td style="text-align: right">
											(+) {{$receipt_details->tax}}
										</td>
									@endif
								@endif

								@if($total_row_tax > 0)
									<td style="text-align: right">
										{{-- @php
                                            $total_row_tax = (float) $total_row_tax ;
                                        @endphp --}}
										(+) {{$total_row_tax}}
									</td>
								@endif

								@if( $receipt_details->round_off_amount > 0)
									<td style="text-align: right">
										{{$receipt_details->round_off}}
									</td>
								@endif
							</tr>

							@if(!empty($receipt_details->total_in_words))
								<tr style="background: #eae9e9;">
									<td colspan="2" class="text-right">
										<small>({{$receipt_details->total_in_words}})</small>
									</td>
								</tr>
							@endif
							</tbody>
						</table>
						<div class="col-md-12 invoice-col width-100">
							<table class="table">
								<tbody>
								<!-- Total -->
								<tr>
									@if( !empty($receipt_details->total_label))
										<th style="text-align:right">
											{{--											{!! $receipt_details->total_label !!}--}}
											{{'الاجمالي:'}}
										</th>
									@endif
									@if(!empty($receipt_details->total))
										<td style="text-align:left">
											{{$receipt_details->total}}
										</td>
									@endif
								</tr>
								<!-- Total-Paid -->
								<tr>
									@if( !empty($receipt_details->total_paid_label) )
										<th style="text-align:right">
											{{--											{!! $receipt_details->total_paid_label !!}--}}
											{{'الاجمالي المدفوع:'}}
										</th>
									@endif
									@if( !empty($receipt_details->total_paid) )
										<td style="text-align:left">
											{{$receipt_details->total_paid}}
										</td>
									@endif
								</tr>
								<!-- Total_due -->

								<tr>
									@if( !empty($receipt_details->total_due_label) )
										<th style="text-align:right">
											{{--											{!! $receipt_details->total_due_label !!}--}}

											{{'الاجمالي المستحق:'}}
										</th>
									@endif
									@if( !empty($receipt_details->total_due) )
										<td style="text-align:left">
											{{$receipt_details->total_due}}
										</td>
									@endif
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
				@if($receipt_details->additional_notes)
					<div class="row color-555">
						<div class="col-xs-12">
							<br>

							<p>{!! nl2br($receipt_details->additional_notes) !!}</p>

						</div>
						@endif
					</div>
			</td>
		</tr>

		</tbody>
		<tfoot>
		<tr>
			<td style="text-align:right;width:33.3% !important;padding-right: 10px;">

				<div class="icons">
					<i class="fas fa-phone"></i>
					<br>
					<i class="fas fa-at"></i>
					<br>
					<i class="fas fa-globe"></i>
					<br>
					<i class="fas fa-map-marker-alt"></i>
				</div>
				<div class="data">
					@if(!empty($location_details->mobile))
						<i>{{$location_details->mobile}}</i>
					@endif
					<br>
					@if(!empty($location_details->email))
						<i>{{$location_details->email}}</i>
					@endif
					<br>
					@if(!empty($location_details->website))
						<i>{{$location_details->website}}</i>
					@endif
					<br>
					@php
						$temp = [];
						$address ='';
                        if(!empty($location_details)){
                        if (!empty($location_details->landmark)){
                        $address = $location_details->landmark . "\n";
                        }
                        if (!empty($location_details->city)) {
                        $temp[] = $location_details->city;
                        }
                        if (!empty($location_details->state)) {
                        $temp[] = $location_details->state;
                        }
                        if (!empty($location_details->zip_code)) {
                        $temp[] = $location_details->zip_code;
                        }
                        if (!empty($location_details->country)) {
                        $temp[] = $location_details->country;
                        }
                        if (!empty($temp)) {
                        $address .= implode(',', $temp);
                        }
                        }
					@endphp
					@if(!empty($address))
						<i>{{$address}}</i>
					@endif
				</div>
			</td>
			<td style="text-align:center;width:33.3% !important">
				@if(!empty($receipt_details))
					@if(!empty($receipt_details->footer_text))
						<p style="text-align:center">{!! $receipt_details->footer_text !!}</p>
					@endif
					{{-- Barcode --}}
				@php
					$a = 0;
                    $y = 0;
                    if (!empty($receipt_details)){
                        $y = floatval(implode(explode(',',$receipt_details->tax1))) ;
                        if(!empty($total_row_tax)){
                         $y= $y + $total_row_tax;
                        }
                        }
                       
				@endphp

					{{--old qr code 4.2v --}}
					{{-- @if($receipt_details->show_barcode)
							<img class="center-block" style="width:100px !important;" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee(['01','02','03','04','05'],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$y]), 'QRCODE')}}" alt="barcode"/>
					@endif --}}

					{{--qr code 4.8v --}}
					@php
				
                			$receipt_details->tax = $y;
							$var = new App\Utils\TransactionUtil();
                			$receipt_details->qr_code_text =$var->_zatca_qr_text($receipt_details->display_name, $receipt_details->tax_info1, $receipt_details->invoice_date, $receipt_details->total1, $receipt_details->tax);
            	
					@endphp
					@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
					<img style="width: 100px !important;" class="center-block" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
					@endif
				@endif
			</td>
			<td style="text-align:left;width:33.3% !important;padding-left: 10px;">
					<span>
					<b>@lang('lang_v1.authorized_signatory')</b>
					</span>
			</td>
		</tr>
		</tfoot>
	</table>
</div>