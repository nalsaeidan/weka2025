<style>
table thead th ,
table tbody td,
table tbody th{
    border-bottom: 1px solid #cecece !important;
}
table tfoot th, table tfoot th{
border-bottom: none !important;
}
</style>
<table style="width:100%; direction:rtl">
	<thead>

	<tr>
		<td colspan="3">
		<!--<p>
					<small>
						@if(!empty($receipt_details->invoice_no_prefix))
			{!! $receipt_details->invoice_no_prefix !!}
		@endif

		{{$receipt_details->invoice_no}}
				</small>
            </p>-->
		</td>
	</tr>
	<tr>
		<td style="width:33.3%">

			<!-- Shop & Location Name  -->
			@if(!empty($receipt_details->display_name))
				<p>
					<strong>{{$receipt_details->display_name}}</strong>
					@if(!empty($receipt_details->address))
						<br/>{!! $receipt_details->address !!}
					@endif

					@if(!empty($receipt_details->contact))
						<br/><strong>{!! $receipt_details->contact !!}</strong>
					@endif

					@if(!empty($receipt_details->website))
						<br/>{{ $receipt_details->website }}
					@endif

					@if(!empty($receipt_details->tax_info1))
						<br/>{{ $receipt_details->tax_label1 }} {{ $receipt_details->tax_info1 }}
					@endif

					@if(!empty($receipt_details->tax_info2))
						<br/>{{ $receipt_details->tax_label2 }} {{ $receipt_details->tax_info2 }}
					@endif

					@if(!empty($receipt_details->location_custom_fields))
						<br/>{{ $receipt_details->location_custom_fields }}
					@endif
					@if(!empty($receipt_details->commession))
						<br/>{{" مندوب:  "}}{{ $receipt_details->commession }}
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
				<p class="color-555">

					@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
						@if(!empty($receipt_details->brand_label))
							<span>
						<strong>{!! $receipt_details->brand_label !!}</strong>
					</span>
						@endif
						{{$receipt_details->repair_brand}}<br>
					@endif


					@if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
						@if(!empty($receipt_details->device_label))
							<span>
						<strong>{!! $receipt_details->device_label !!}</strong>
					</span>
						@endif
						{{$receipt_details->repair_device}}<br>
					@endif

					@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
						@if(!empty($receipt_details->model_no_label))
							<span>
						<strong>{!! $receipt_details->model_no_label !!}</strong>
					</span>
						@endif
						{{$receipt_details->repair_model_no}} <br>
					@endif

					@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
						@if(!empty($receipt_details->serial_no_label))
							<span>
						<strong>{!! $receipt_details->serial_no_label !!}</strong>
					</span>
						@endif
						{{$receipt_details->repair_serial_no}}<br>
					@endif
					@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
						@if(!empty($receipt_details->repair_status_label))
							<span>
						<strong>{!! $receipt_details->repair_status_label !!}</strong>
					</span>
						@endif
						{{$receipt_details->repair_status}}<br>
					@endif

					@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
						@if(!empty($receipt_details->repair_warranty_label))
							<span>
						<strong>{!! $receipt_details->repair_warranty_label !!}</strong>
					</span>
						@endif
						{{$receipt_details->repair_warranty}}
						<br>
					@endif
				</p>
				@if(!empty($sell->commission_agent))
					<p><b>{{"المندوب" }}:</b>{{ $sell->commission->getUserFullNameAttribute() }}<br></p>
				@endif
		</td>
		<td style="width:33.3%; text-align:center;">
			<!-- Logo -->
			@if(!empty($receipt_details->logo))
				<img style="text-align:center; max-height: 120px; width: auto" src="{{$receipt_details->logo}}" class="img">
				<br/>
			@endif
                
                           
			
 @if(!empty($receipt_details->transaction_type))
                        @if($receipt_details->transaction_type == 'sell_return')
                            <h5 class="text-center" style="font-weight: bold; font-size: 18px !important; color:#007665 !important;">{{'فاتورة مرتجعة'}}</h5>
						@endif
                   @endif   
                        @if(!empty($receipt_details->header_text))
				<p>{!! $receipt_details->header_text !!}</p>
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
				<p>{!! $sub_headings !!}</p>
			@endif

            {{--@if(!empty($receipt_details->invoice_heading))
				<p style="font-weight: bold; font-size: 35px !important;">{!! $receipt_details->invoice_heading !!}</p>
			@endif--}}

                        @if($receipt_details->transaction_type == 'sell')
            @if(!empty($receipt_details->invoice_heading))
					<p class="text-center" style="font-weight: bold; font-size: 18px !important; color:#007665 !important;">
						{!! $heading[0] !!}
						@if(!empty($heading[1]))
							{!! $heading[1] !!}
						@endif
                        <br/>
						@if(!empty($heading[2]))
							{!! $heading[2] !!}
						@endif
                        @if(!empty($heading[3]))
							{!! $heading[3] !!}
						@endif
                        @if(!empty($heading[4]))
							{!! $heading[4] !!}
						@endif
					</p>
				@endif
                        @endif

		</td>
		<td style="width:33.3%; text-align: right; padding-right: 90px;">


			<p>
				@if(!empty($receipt_details->invoice_no_prefix))
					{!! $receipt_details->invoice_no_prefix !!}
					{{$receipt_details->invoice_no}}
				@endif
			</p>

			<!-- Date-->
			@if(!empty($receipt_details->date_label))
				<p>
					{{$receipt_details->date_label}}
					{{$receipt_details->invoice_date}}
				</p>

			@endif
			@if(!empty($receipt_details->due_date_label))
				<p>
					{{$receipt_details->due_date_label}}
					{{$receipt_details->due_date . ''}}
				</p>
			@endif
			@if(!empty($receipt_details->customer_label))
				<p><b>{{ $receipt_details->customer_label }}</b></p>
			@endif

		<!-- customer info -->
			@if(!empty($receipt_details->customer_info))
				<p>{!! $receipt_details->customer_info !!}</p>
			@endif
			@if(!empty($receipt_details->client_id_label))
				<p><strong>{{ $receipt_details->client_id_label }}</strong> {{ $receipt_details->client_id }}</p>
			@endif
			@if(!empty($receipt_details->customer_tax_label))
				<p><strong>{{ $receipt_details->customer_tax_label }}</strong> {{ $receipt_details->customer_tax_number }}</p>
			@endif
			@if(!empty($receipt_details->customer_custom_fields))
				<p>{!! $receipt_details->customer_custom_fields !!}</p>
			@endif
			@if(!empty($receipt_details->sales_person_label))
				<p><strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}</p>
			@endif

			@if(!empty($receipt_details->customer_rp_label))
				<p><strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}</p>
			@endif

		<!-- Display type of service details -->
			@if(!empty($receipt_details->types_of_service))
				<p>
					<strong>{!! $receipt_details->types_of_service_label !!}:</strong>
					{{$receipt_details->types_of_service}}
				</p>
				<!-- Waiter info -->
				@if(!empty($receipt_details->types_of_service_custom_fields))
					@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
						<p><strong>{{$key}}: </strong> {{$value}}</p> @if(!$loop->last), @endif
					@endforeach
				@endif
			@endif
		</td>
	</tr>
	<tr>
		@if(!empty($receipt_details->shipping_custom_field_1_label) || !empty($receipt_details->shipping_custom_field_2_label))
			<td colspan="2">
				@if(!empty($receipt_details->shipping_custom_field_1_label))
					<p><strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value . ''!!}</p>
				@endif
			</td>
			<td>
				@if(!empty($receipt_details->shipping_custom_field_2_label))
					<p><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value . ''!!}</p>
				@endif
			</td>
		@endif
	</tr>
	<tr>
		@if(!empty($receipt_details->shipping_custom_field_3_label) || !empty($receipt_details->shipping_custom_field_4_label))
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
		@endif
	</tr>
	<tr>
		@if(!empty($receipt_details->shipping_custom_field_5_label))
			<td colspan="3">
				@if(!empty($receipt_details->shipping_custom_field_5_label))
					<strong>{!!$receipt_details->shipping_custom_field_5_label!!} :</strong> {!!$receipt_details->shipping_custom_field_5_value . ''!!}
				@endif
			</td>
		@endif
	</tr>
	<tr>
		@if(!empty($receipt_details->sale_orders_invoice_no) || !empty($receipt_details->sale_orders_invoice_date))
			<td colspan="2">
				<strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no . ''!!}
			</td>
			<td>
				<strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date . ''!!}
			</td>
		@endif
	</tr>
	</thead>

	<tbody>
	@php
		$subtotal = 0;
            $line_total = 0;
                if(!empty($receipt_details->lines)){
                foreach($receipt_details->lines as $line){
                   // if(!empty($line['unit_price_uf']) && !empty($line['quantity_uf'])){
               // $line_total = $line['unit_price_uf'] * $line['quantity_uf'];
                //$subtotal += $line_total;
                //}
                $subtotal += $line['line_total'];

            //echo $line_total ;
                }
                }
	@endphp
	<tr>
		<td colspan="3" style="border-bottom:none !important ">

			<div class="row">
				@includeIf('sale_pos.receipts.partial.common_repair_invoice')
			</div>
			<div class="row color-555">
				<div class="col-xs-12">
					<table class="table" style="direction:rtl">
						<thead class="thead-dark">
						<tr>
							<th style="text-align:right">#</th>

							@php
								$p_width = 40;
							@endphp
							@if(!empty($receipt_details->show_cat_code))
								@if($receipt_details->show_cat_code == 1)
									@php
										if(!empty($p_width)){
                                            $p_width -= 10;
                                            }
									@endphp
								@endif
							@endif
							@if(!empty($receipt_details->item_discount_label))
								@php
									if(!empty($p_width)){
                                    $p_width -= 10;
                                    }
								@endphp
							@endif
							@if(!empty($receipt_details->table_product_label))
								<th style="text-align:right">
									{{$receipt_details->table_product_label}}
								</th>
							@endif
							@if($receipt_details->show_cat_code)
								{{--						<th style="text-align:right">{{$receipt_details->cat_code_label}}</th>--}}
								<th style="text-align:right">رقم القسم</th>
							@endif
							@if(!empty($receipt_details->table_qty_label))
								<th style="text-align:right">
									{{$receipt_details->table_qty_label}}
								</th>
							@endif
							@if(!empty($receipt_details->table_unit_price_label))
								<th style="text-align:right">
									{{$receipt_details->table_unit_price_label}}
								</th>
							@endif
							@if(!empty($receipt_details->item_discount_label))
								<th style="text-align:right">
									{{$receipt_details->item_discount_label}}
								</th>
							@endif
							@if(!empty($receipt_details->table_subtotal_label))
								<th style="text-align:right">
									{{$receipt_details->table_subtotal_label}}
								</th>
							@endif
						</tr>
						</thead>
						<tbody>
						@foreach($receipt_details->lines as $line)
							<tr>
								<td>
									{{$loop->iteration}}
								</td>
								<td>
									@if(!empty($line['image']))
										<img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
									@endif
									@if(!empty($line['name']))
										{{$line['name']}} @endif @if(!empty($line['product_variation'])) {{$line['product_variation']}} @endif @if(!empty($line['variation'])) {{$line['variation']}} @endif

									@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
									@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
									@if(!empty($line['sell_line_note']))
										<br>
										<small>{{$line['sell_line_note']}}</small>
									@endif
									@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif
									@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

									@if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
									@if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] . ''}}</small>@endif
								</td>

								@if(!empty($receipt_details->show_cat_code))
									@if($receipt_details->show_cat_code == 1)
										<td>
											@if(!empty($line['cat_code']))
												{{$line['cat_code']}}
											@endif
										</td>
									@endif
								@endif
								<td>
									@if(!empty($line['quantity']) && !empty($line['units']))
										{{$line['quantity']}} {{$line['units']}}
									@endif
								</td>
								<td>
									@if(!empty($line['unit_price_before_discount']))
										{{$line['unit_price_before_discount']}}
									@elseif(!empty($line['unit_price']))
										{{$line['unit_price']}}
									@endif
								</td>


								@if(!empty($receipt_details->item_discount_label))
									<td>
										{{$line['line_discount']}}

									</td>
								@endif
								<td>
									{{$line['line_total']}}
								</td>
							</tr>
							{{--					@if(!empty($line['modifiers']))--}}
							{{--						@foreach($line['modifiers'] as $modifier)--}}
							{{--							<tr>--}}
							{{--								<td>--}}
							{{--									 --}}
							{{--								</td>--}}
							{{--								<td>--}}
							{{--		                            {{$modifier['name']}} {{$modifier['variation']}}--}}
							{{--		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif--}}
							{{--		                            @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif--}}
							{{--		                        </td>--}}

							{{--								@if($receipt_details->show_cat_code == 1)--}}
							{{--			                        <td>--}}
							{{--			                        	@if(!empty($modifier['cat_code']))--}}
							{{--			                        		{{$modifier['cat_code']}}--}}
							{{--			                        	@endif--}}
							{{--			                        </td>--}}
							{{--			                    @endif--}}

							{{--								<td>--}}
							{{--									{{$modifier['quantity']}} {{$modifier['units']}}--}}
							{{--								</td>--}}
							{{--								<td>--}}
							{{--									{{$modifier['unit_price_exc_tax']}}--}}
							{{--								</td>--}}
							{{--								@if(!empty($receipt_details->item_discount_label))--}}
							{{--									<td>0.00</td>--}}
							{{--								@endif--}}
							{{--								<td>--}}
							{{--									{{$modifier['line_total']}}--}}
							{{--								</td>--}}
							{{--							</tr>--}}
							{{--						@endforeach--}}
							{{--					@endif--}}
						@endforeach

						@php
							if(!empty($receipt_details->lines)){
                                $lines = count($receipt_details->lines);
            }
						@endphp

						{{--				 @for ($i = $lines; $i < 7; $i++)--}}
						{{--    				<tr>--}}
						{{--    					<td> </td>--}}
						{{--    					<td> </td>--}}
						{{--    					<td> </td>--}}
						{{--    					<td> </td>--}}
						{{--    					<td> </td>--}}
						{{--    					@if(!empty($receipt_details->item_discount_label))--}}
						{{--    					<td></td>--}}
						{{--    					@endif--}}
						{{--    					<td> </td>--}}
						{{--    				</tr>--}}
						{{--				@endfor --}}

						</tbody>
					</table>
				</div>
			</div>

			<div class="row invoice-info color-555" style="page-break-inside: avoid !important; direction:rtl !important">


				<div class="col-md-12 invoice-col width-100">
					<table class="table">
						<thead class="thead-light">
						<tr>
							@if(!empty($receipt_details->total_quantity_label))
								<th style="text-align:right">
									{!! $receipt_details->total_quantity_label !!}
								</th>
							@endif
							@if(!empty($receipt_details->subtotal_label))
								<th style="text-align:right">
									{!! $receipt_details->subtotal_label !!}
								</th>
							@endif
							@if(!empty($receipt_details->shipping_charges))
								<th style="text-align:right">
									{!! $receipt_details->shipping_charges_label !!}
								</th>
							@endif
							@if(!empty($receipt_details->packing_charge))
								<th style="text-align:right">
									{!! $receipt_details->packing_charge_label !!}
								</th>
							@endif
							@if(!empty($receipt_details->taxes))
								@foreach($receipt_details->taxes as $k => $v)
									<th style="text-align:right">{{$k}}</th>
								@endforeach
							@endif
							@if(!empty( $receipt_details->discount))
								<th style="text-align:right">
									{!! $receipt_details->discount_label !!}
								</th>
							@endif
							@if(!empty( $receipt_details->reward_point_label))
								<th style="text-align:right">
									{!! $receipt_details->reward_point_label !!}
								</th>
							@endif
							@if(!empty($receipt_details->group_tax_details))
								@foreach($receipt_details->group_tax_details as $key => $value)
									<th style="text-align:right">
										{!! $key !!}
									</th>
								@endforeach
							@else
								@if(!empty($receipt_details->tax_label) && !empty($receipt_details->tax))
									<th style="text-align:right">
										{!! $receipt_details->tax_label !!}
{{--										{{'here'}}--}}
									</th>
								@endif
							@endif
							@if( $receipt_details->round_off_amount > 0)
								<th style="text-align:right">
									{!! $receipt_details->round_off_label !!}
								</th>
							@endif
						</tr>
						</thead>
						<tbody>
						@if(!empty($receipt_details->total_quantity))
							<td>
								{{$receipt_details->total_quantity}}
							</td>
						@endif
						<td>
							{{$subtotal}}
						</td>

						<!-- Shipping Charges -->
						@if(!empty($receipt_details->shipping_charges))
							<td>
								{{$receipt_details->shipping_charges}}
							</td>
						@endif

						@if(!empty($receipt_details->packing_charge))\
						<td>
							{{$receipt_details->packing_charge}}
						</td>
						@endif

						<!-- Tax -->
						@if(!empty($receipt_details->taxes))
							@foreach($receipt_details->taxes as $k => $v)
								<td>(+) {{$v}}</td>
							@endforeach
						@endif

						<!-- Discount -->
						@if( !empty($receipt_details->discount) )
							<td>
								(-) {{$receipt_details->discount}}
							</td>
						@endif

						@if( !empty($receipt_details->reward_point_label) )
							<td>
								(-) {{$receipt_details->reward_point_amount}}
							</td>
						@endif

						@if(!empty($receipt_details->group_tax_details))
							@foreach($receipt_details->group_tax_details as $key => $value)
								<td>
									(+) {{$value}}
								</td>
							@endforeach
						@else
							@if( !empty($receipt_details->tax) )
								<td>
									(+) {{$receipt_details->tax}}
								</td>
							@endif
						@endif

						@if( $receipt_details->round_off_amount > 0)
							<td>
								{{$receipt_details->round_off}}
							</td>
						@endif

						<!-- Total -->
						@if( !empty($receipt_details->total_label) )
							<tr>
								<th style="text-align:right">
									{{-- {!! $receipt_details->total_label !!} --}}
									{{'الاجمالي:'}}
								</th>
								<td style="text-align:right">
									{{$receipt_details->total}}
								</td>
							</tr>
						@endif
						<!-- Total-Paid -->
						@if( !empty($receipt_details->total_paid_label) )
							<tr>
								<th style="text-align:right">
{{--									{!! $receipt_details->total_paid_label !!}--}}
									{{'الاجمالي المدفوع:'}}
								</th>
								<td style="text-align:right">
									{{$receipt_details->total_paid}}
								</td>
							</tr>
						@endif
						<!-- Total_due -->
						@if( !empty($receipt_details->total_due_label) )
							<tr>
								<th style="text-align:right">
{{--									{!! $receipt_details->total_due_label !!}--}}
									{{'الاجمالي المستحق:'}}
								</th>
								<td style="text-align:right">
									{{$receipt_details->total_due}}
								</td>
							</tr>
						@endif
						@if(!empty($receipt_details->total_in_words))
							<tr>
								<td style="text-align:right" colspan="2">
									<small>({{$receipt_details->total_in_words}})</small>
								</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
				<div class="col-md-6 invoice-col width-50" style="text-align: right">
					<table class="table table-slim" style="direction:rtl !important">
						@if(!empty($receipt_details->payments))
							@foreach($receipt_details->payments as $payment)
								<tr>
									<td>{{$payment['method']}}</td>
								</tr>
								<tr>
									<td>{{$payment['amount']}}</td>
								</tr>
								<tr>
									<td>{{$payment['date']}}</td>
								</tr>
							@endforeach
						@endif
					</table>
				</div>
			</div>
		</td>
	</tr>
	</tbody>
	<tfoot>
	<tr>
		<td style="padding-top:30px; float:right">
			@if(!empty($receipt_details->footer_text))
				{!! $receipt_details->footer_text !!}
			@endif
		</td>
		<td>
			{{--Barcode--}}
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
				<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee([1,2,3,4,5],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$y]), 'QRCODE')}}" alt="barcode"/>
			@endif --}}

			{{--qr code 4.8v --}}
			@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
			<img style="width: 100px !important;" class="center-block" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
			@endif
		</td>
		<td>
			<p style="text-align:center"><strong>@lang('lang_v1.authorized_signatory')</strong></p>
		</td>
	</tr>
	</tfoot>
</table>