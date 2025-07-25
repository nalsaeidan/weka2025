<table style="width:100%; margin-top:45px !important">
	<thead>
		<tr>
			<td>
				<p class="text-right">
					<small class="text-muted-imp">
						@if(!empty($receipt_details->invoice_no_prefix))
							{!! $receipt_details->invoice_no_prefix !!}
						@endif

						{{$receipt_details->invoice_no}}
					</small>
				</p>
			</td>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td class="text-center" style="line-height: 15px !important; padding-bottom: 10px !important">
				@if(!empty($receipt_details->header_text))
					{!! $receipt_details->header_text !!}
				@endif

				@php
					$sub_headings = implode('<br/>', array_filter([$receipt_details->sub_heading_line1, $receipt_details->sub_heading_line2, $receipt_details->sub_heading_line3, $receipt_details->sub_heading_line4, $receipt_details->sub_heading_line5]));
				@endphp

				@if(!empty($sub_headings))
					<span>{!! $sub_headings !!}</span>
				@endif

				@if(!empty($receipt_details->invoice_heading))
					<p class="" style="font-weight: bold; font-size: 35px !important">{!! $receipt_details->invoice_heading !!}</p>
				@endif
			</td>
		</tr>

		<tr>
			<td>

<!-- business information here -->
<div class="row invoice-info">

	<div class="col-md-6 invoice-col width-50" style="margin-top:25px !important">

		<div class="text-right font-20 color-555">
			@if(!empty($receipt_details->invoice_no_prefix))
				<span class="text-right">{!! $receipt_details->invoice_no_prefix !!}</span>
			@endif

			{{$receipt_details->invoice_no}}
		</div>
		<!-- Total Due-->
		@if(!empty($receipt_details->total_due))
			<div class="bg-light-blue-active text-right font-20 padding-5" style="margin:10px !important;font-weight: bold !important; color:black !important">
				<span class="text-right bg-light-blue-active">
					{!! $receipt_details->total_due_label !!}
				</span>

				{{$receipt_details->total_due}}
			</div>
		@endif

		@if(!empty($receipt_details->all_due))
			<div class="bg-light-blue-active text-right font-20 padding-5 color-555">
				<span class="text-right bg-light-blue-active">
					{!! $receipt_details->all_bal_label !!}
				</span>

				{{$receipt_details->all_due}}
			</div>
		@endif
		
		
		<!-- Date-->
		@if(!empty($receipt_details->date_label))
			<div class="text-right font-20 color-555">
				<span class="text-right">
					{{$receipt_details->date_label}}
				</span>

				{{$receipt_details->invoice_date}}
			</div>
		@endif
		@if(!empty($receipt_details->due_date_label))
			<div class="text-right font-20 color-555">
				<span class="pull-left">
					{{$receipt_details->due_date_label}}
				</span>

				{{$receipt_details->due_date ?? ''}}
			</div>
		@endif

		

	</div>

	<div class="col-md-6 invoice-col width-50 color-555">
		
		<!-- Logo -->
		@if(!empty($receipt_details->logo))
			<img style="margin-top: -70px; max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img center-block">
			<br/>
		@endif

		<!-- Shop & Location Name  -->
		@if(!empty($receipt_details->display_name))
			<span>
				{{$receipt_details->display_name}}
				@if(!empty($receipt_details->address))
					<br/>{!! $receipt_details->address !!}
				@endif

				@if(!empty($receipt_details->contact))
					<br/>{!! $receipt_details->contact !!}
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
					<br/>{{ $receipt_details->location_custom_fields }}<br/>
				@endif
			</span>
		@endif
				<div class="word-wrap text-left">
			@if(!empty($receipt_details->customer_label))
				<b>{{ $receipt_details->customer_label }}</b><br/>
			@endif

			<!-- customer info -->
			@if(!empty($receipt_details->customer_info))
				{!! $receipt_details->customer_info !!}
			@endif
			@if(!empty($receipt_details->client_id_label))
				<br/>
				<strong>{{ $receipt_details->client_id_label }}</strong> {{ $receipt_details->client_id }}
			@endif
			@if(!empty($receipt_details->customer_tax_label))
				<br/>
				<strong>{{ $receipt_details->customer_tax_label }}</strong> {{ $receipt_details->customer_tax_number }}
			@endif
			@if(!empty($receipt_details->customer_custom_fields))
				<br/>{!! $receipt_details->customer_custom_fields !!}
			@endif
			@if(!empty($receipt_details->sales_person_label))
				<br/>
				<strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}
			@endif

			@if(!empty($receipt_details->customer_rp_label))
				<br/>
				<strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}
			@endif

			<!-- Display type of service details -->
			@if(!empty($receipt_details->types_of_service))
				<span class="pull-left text-left">
					<strong>{!! $receipt_details->types_of_service_label !!}:</strong>
					{{$receipt_details->types_of_service}}
					<!-- Waiter info -->
					@if(!empty($receipt_details->types_of_service_custom_fields))
						<br>
						@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
							<strong>{{$key}}: </strong> {{$value}}@if(!$loop->last), @endif
						@endforeach
					@endif
				</span>
			@endif
		</div>
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



        <div class="word-wrap">

			<p class="text-right color-555">

			@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
				@if(!empty($receipt_details->brand_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->brand_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_brand}}<br>
	        @endif


	        @if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
				@if(!empty($receipt_details->device_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->device_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_device}}<br>
	        @endif
	        
			@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
				@if(!empty($receipt_details->model_no_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->model_no_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_model_no}} <br>
	        @endif

			@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
				@if(!empty($receipt_details->serial_no_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->serial_no_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_serial_no}}<br>
	        @endif
			@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
				@if(!empty($receipt_details->repair_status_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->repair_status_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_status}}<br>
	        @endif
	        
	        @if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
				@if(!empty($receipt_details->repair_warranty_label))
					<span class="pull-left">
						<strong>{!! $receipt_details->repair_warranty_label !!}</strong>
					</span>
				@endif
				{{$receipt_details->repair_warranty}}
				<br>
	        @endif
	        </p>
		</div>
	</div>
</div>
@if(!empty($receipt_details->shipping_custom_field_1_label) || !empty($receipt_details->shipping_custom_field_2_label))
	<div class="row">
		<div class="col-xs-6">
			@if(!empty($receipt_details->shipping_custom_field_1_label))
				<strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
			@endif
		</div>
		<div class="col-xs-6">
			@if(!empty($receipt_details->shipping_custom_field_2_label))
				<strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
			@endif
		</div>
	</div>
@endif
@if(!empty($receipt_details->shipping_custom_field_3_label) || !empty($receipt_details->shipping_custom_field_4_label))
	<div class="row">
		<div class="col-xs-6">
			@if(!empty($receipt_details->shipping_custom_field_3_label))
				<strong>{!!$receipt_details->shipping_custom_field_3_label!!} :</strong> {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
			@endif
		</div>
		<div class="col-xs-6">
			@if(!empty($receipt_details->shipping_custom_field_4_label))
				<strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
			@endif
		</div>
	</div>
@endif
@if(!empty($receipt_details->shipping_custom_field_5_label))
	<div class="row">
		<div class="col-xs-6">
			@if(!empty($receipt_details->shipping_custom_field_5_label))
				<strong>{!!$receipt_details->shipping_custom_field_5_label!!} :</strong> {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
			@endif
		</div>
	</div>
@endif
@if(!empty($receipt_details->sale_orders_invoice_no) || !empty($receipt_details->sale_orders_invoice_date))
	<div class="row">
		<div class="col-xs-6">
			<strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no ?? ''!!}
		</div>
		<div class="col-xs-6">
			<strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date ?? ''!!}
		</div>
	</div>
@endif
<div class="row">
	@includeIf('sale_pos.receipts.partial.common_repair_invoice')
</div>
<div class="row color-555 mt-5">
	<div class="col-xs-12">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th>#</td>
					
					@php
						$p_width = 40;
					@endphp
					@if($receipt_details->show_cat_code == 1)
						@php
							$p_width -= 10;
						@endphp
					@endif
					@if(!empty($receipt_details->item_discount_label))
						@php
							$p_width -= 10;
						@endphp
					@endif
					<th>
						{{$receipt_details->table_product_label}}
					</th>

					@if($receipt_details->show_cat_code == 1)
						<th>{{$receipt_details->cat_code_label}}</th>
					@endif
					
					<th>
						{{$receipt_details->table_qty_label}}
					</th>
					<th>
						{{$receipt_details->table_unit_price_label}}
					</th>
					@if(!empty($receipt_details->item_discount_label))
					<th>
						{{$receipt_details->item_discount_label}}
					</th>
					@endif
					<th>
						{{$receipt_details->table_subtotal_label}}
					</th>
				</tr>
        
			</thead>
			<tbody>
				@php
					$subtotal = 0;
				@endphp
				@foreach($receipt_details->lines as $line)
					<tr>
						<td>
							{{$loop->iteration}}
						</td>
						<td>
							@if(!empty($line['image']))
								<img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
							@endif
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
                            @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                            @if(!empty($line['sell_line_note']))
                            <br>
                            <small>{{$line['sell_line_note']}}</small>
                            @endif
                            @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif 

                            @if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                            @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif
                        </td>

						@if($receipt_details->show_cat_code == 1)
	                        <td>
	                        	@if(!empty($line['cat_code']))
	                        		{{$line['cat_code']}}
	                        	@endif
	                        </td>
	                    @endif

						<td>
							{{$line['quantity']}} {{$line['units']}}
						</td>
						<td>
							{{$line['unit_price_before_discount']}} 
						</td>
						@if(!empty($receipt_details->item_discount_label))
						<td>
							{{$line['line_discount'] ?? '0.00'}}
						</td>
						@endif
						<td>
							@php
								$line_total = $line['unit_price_uf'] * $line['quantity_uf'];
								$subtotal += $line_total;
							@endphp
							{{@num_format($line_total)}}
						</td>
					</tr>
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
								<td>
									&nbsp;
								</td>
								<td>
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif 
		                            @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif 
		                        </td>

								@if($receipt_details->show_cat_code == 1)
			                        <td>
			                        	@if(!empty($modifier['cat_code']))
			                        		{{$modifier['cat_code']}}
			                        	@endif
			                        </td>
			                    @endif

								<td>
									{{$modifier['quantity']}} {{$modifier['units']}}
								</td>
								<td>
									{{$modifier['unit_price_exc_tax']}}
								</td>
								@if(!empty($receipt_details->item_discount_label))
									<td>0.00</td>
								@endif
								<td>
									{{$modifier['line_total']}}
								</td>
							</tr>
						@endforeach
					@endif
				@endforeach

				@php
					$lines = count($receipt_details->lines);
				@endphp

				<!-- @for ($i = $lines; $i < 7; $i++)
    				<tr>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					@if(!empty($receipt_details->item_discount_label))
    					<td></td>
    					@endif
    					<td>&nbsp;</td>
    				</tr>
				@endfor -->

			</tbody>
		</table>
	</div>
</div>

<div class="row invoice-info color-555" style="page-break-inside: avoid !important">
	<div class="col-md-6 invoice-col width-50">
		<table class="table table-slim">
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
		<b class="pull-left">@lang('lang_v1.authorized_signatory')</b>
	</div>

	<div class="col-md-12 invoice-col width-100">
		<table class="table">
        <thead class="thead-light">
        <tr>
        @if(!empty($receipt_details->total_quantity_label))
        <th>
							{!! $receipt_details->total_quantity_label !!}
						</th>
        @endif
        <th>
						{!! $receipt_details->subtotal_label !!}
					</th>
        @if(!empty($receipt_details->shipping_charges))
        <th>
							{!! $receipt_details->shipping_charges_label !!}
						</th>
        @endif
        @if(!empty($receipt_details->packing_charge))
        <th>
							{!! $receipt_details->packing_charge_label !!}
						</th>
        @endif
        @if(!empty($receipt_details->taxes))
					@foreach($receipt_details->taxes as $k => $v)
        <th>{{$k}}</th>
        @endforeach
				@endif
        @if( !empty($receipt_details->discount) )
        <th>
							{!! $receipt_details->discount_label !!}
						</th>
        @endif
        @if( !empty($receipt_details->reward_point_label) )
        <th>
							{!! $receipt_details->reward_point_label !!}
						</th>
        @endif
        @if(!empty($receipt_details->group_tax_details))
					@foreach($receipt_details->group_tax_details as $key => $value)
        <th>
								{!! $key !!}
							</th>
        @endforeach
				@else
					@if( !empty($receipt_details->tax) )
        <th>
								{!! $receipt_details->tax_label !!}
							</th>
        @endif
				@endif
        @if( $receipt_details->round_off_amount > 0)
        <th>
							{!! $receipt_details->round_off_label !!}
						</th>
        @endif
        </tr>
        </thead>
			<tbody>
				@if(!empty($receipt_details->total_quantity_label))						
						<td>
							{{$receipt_details->total_quantity}}
						</td>
				@endif
					<td>
						@format_currency($subtotal)
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
				<tr>
					<th>
						{!! $receipt_details->total_label !!}
					</th>
					<td>
						{{$receipt_details->total}}
					</td>
				</tr>
            <!-- Total-Paid -->
            <tr>
            <th>
						{!! $receipt_details->total_paid_label !!}
					</th>
					<td>
						{{$receipt_details->total_paid}}
					</td>
            </tr>
            <!-- Total_due -->
            <tr>
            <th>
						{!! $receipt_details->total_due_label !!}
					</th>
					<td>
						{{$receipt_details->total_due}}
					</td>
            </tr>
				@if(!empty($receipt_details->total_in_words))
				<tr>
					<td colspan="2" class="text-right">
						<small>({{$receipt_details->total_in_words}})</small>
					</td>
				</tr>
				@endif
			</tbody>
        </table>
	</div>
</div>

<div class="row color-555">
	<div class="col-xs-12">
		<br>
		<p>{!! nl2br($receipt_details->additional_notes) !!}</p>
	</div>
</div>
{{-- Barcode --}}
@if($receipt_details->show_barcode)
<br>
<div class="row">
		<div class="col-xs-12">
			<!-- <img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}"> -->
        
            <img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee([1,2,3,4,5],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$receipt_details->tax1]), 'QRCODE')}}" alt="barcode"/>

        
<!-- 			<img class="text-left" width="100px" src="data:image/png;base64,{{DNS2D::getBarcodePNG('اسم المنشأة ='.$receipt_details->tax_label1.' 
                                                       		  '.'الرقم الضريبي ='. $receipt_details->tax_info1.' 
                                                              '.'رقم الفاتورة ='.$receipt_details->invoice_no.' 
                                                              '.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
                                                              '.'الضريبة ='.$receipt_details->tax.'
                                                              '.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/> -->
<!-- <span class="mt-5" style="padding:5px !important ; background:#b3bcc4 !important"> scan Qr code to view your invoice and make your payments</span>	
       		-->
</div>
</div>
@endif

@if(!empty($receipt_details->footer_text))
	<div class="row color-555">
		<div class="col-xs-12">
			{!! $receipt_details->footer_text !!}
		</div>
	</div>
@endif

			</td>
		</tr>
	</tbody>
</table>