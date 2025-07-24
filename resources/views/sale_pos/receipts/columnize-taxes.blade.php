@php
	$totals = ['taxable_value' => 0];
@endphp

<table style="width:100%; margin-top:15px !important; direction:rtl !important">
	<thead>
		<tr>
			<!--<td class="pull-right mt-0">
				<small class="text-muted-imp">
					@if(!empty($receipt_details->invoice_no_prefix))
						{!! $receipt_details->invoice_no_prefix !!}
					@endif

					{{$receipt_details->invoice_no}}
				</small>
			</td>-->
		</tr>
	</thead>

	<tbody>
		<tr>
			<td class="text-right" style="line-height: 15px !important; padding-bottom: 10px !important">
				@if(!empty($receipt_details->header_text))
            <p >{!! $receipt_details->header_text !!}</p>
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
			<div class="bg-light-blue-active text-right font-20 padding-5">
				<span class="text-right bg-light-blue-active">
					{!! $receipt_details->all_bal_label !!}
				</span>

				{{$receipt_details->all_due}}
			</div>
		@endif
		
		
		<!-- Date-->
		@if(!empty($receipt_details->date_label))
            <div class= "text-right font-20 color-555">
				<span class="text-right">
					{{$receipt_details->date_label}}
				</span>

				{{$receipt_details->invoice_date}}
			</div>
		@endif
		@if(!empty($receipt_details->due_date_label))
			<div class="text-right font-20 color-555">
				<span class="text-right">
					{{$receipt_details->due_date_label}}
				</span>

				{{$receipt_details->due_date ?? ''}}
			</div>
		@endif

	</div>

	<div class="col-md-6 invoice-col width-50 color-555">
		
		<!-- Logo -->
		@if(!empty($receipt_details->logo))
			<img style="margin-top: -70px; max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img">
			<br/>
		@endif

		<!-- Shop & Location Name  -->
		@if(!empty($receipt_details->display_name))
			<p>
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
					<br/>{{ $receipt_details->location_custom_fields }}
				@endif
			</p>
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
<div class="row color-555">
	<div class="col-xs-12">
		<br/>
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
    @if(!empty($receipt_details->table_product_label))
      <th scope="col">{!! $receipt_details->table_product_label !!}</th>
    @endif
    @if(!empty($receipt_details->cat_code_label))
      <th scope="col">{!! $receipt_details->cat_code_label !!}</th>
    @endif
    @if(!empty($receipt_details->table_qty_label))
      <th scope="col">{!! $receipt_details->table_qty_label !!}</th>
    @endif
    @if(!empty($receipt_details->table_unit_price_label) || !empty($receipt_details->currency['symbol']) )
      <th scope="col">{!! $receipt_details->table_unit_price_label !!} <span class="small color-white"> ({{$receipt_details->currency['symbol']}})</span></th>
    @endif
    @if(!empty($receipt_details->item_discount_label))  
    <th scope="col">{!! $receipt_details->item_discount_label !!}</th>
    @endif
    @if(!empty($receipt_details->currency['symbol']))  
    <th scope="col">القيمة الخاضعة للضريبة<span class="small color-white"> ({{$receipt_details->currency['symbol']}})</span></th>
    @endif
    	@if(!empty($receipt_details->table_tax_headings))
					
						@foreach($receipt_details->table_tax_headings as $tax_heading)
							<th>
								{{$tax_heading}} <span class="small color-white"> ({{$receipt_details->currency['symbol']}})</span>
							</th>

							@php
								$totals[$tax_heading] = 0;
							@endphp
						@endforeach

					@endif  
     <th scope="col">{!! $receipt_details->table_subtotal_label !!}  <span class="small color-white"> ({{$receipt_details->currency['symbol']}})</span></th>
    </tr>
  </thead>
  <tbody>
  @foreach($receipt_details->lines as $line)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>
							@if(!empty($line['image']))
								<img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
							@endif
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
                            @if(!empty($line['sell_line_note']))
                            <br>
                            <small class="text-muted">
                            {{$line['sell_line_note']}}
                        	</small>
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

      <td>{{$line['quantity']}} {{$line['units']}}</td>
    <td>{{$line['unit_price_before_discount']}}</td>
    @if(!empty($receipt_details->item_discount_label))
						<td>
							{{$line['line_discount']}}
						</td>
						@endif
    <td>
							<span class="display_currency" data-currency_symbol="false">
								{{$line['price_exc_tax']}}
							</span>

							@php
								$totals['taxable_value'] += $line['price_exc_tax'];
							@endphp
						</td>
    @if(!empty($receipt_details->table_tax_headings))
					
						@foreach($receipt_details->table_tax_headings as $tax_heading)
							<td>
								@if(!empty($line['group_tax_details']))
								
								@foreach($line['group_tax_details'] as $tax_detail)
									@if(strpos($tax_detail['name'], $tax_heading) !== FALSE)
										
										@php
											$totals[$tax_heading] += $tax_detail['calculated_tax'];
										@endphp

										<span class="display_currency" data-currency_symbol="false">
										{{$tax_detail['calculated_tax']}}
										</span>
										<br/>
										<span class="small">
											{{$tax_detail['amount']}}%
										</span>
									@endif
								@endforeach

								@else
									@if(strpos($line['tax_name'], $tax_heading) !== FALSE)

									@php
										$totals[$tax_heading] += ($line['tax_unformatted'] * $line['quantity_uf']);
									@endphp

									<span class="display_currency" data-currency_symbol="false">
									{{$line['tax_unformatted'] * $line['quantity_uf']}}
									</span>
									<br/>
									<span class="small">
										{{$line['tax_percent']}}%
									</span>
									@endif
								@endif
							</td>
						@endforeach

						@endif
    <td>{{$line['line_total']}}</td>
    </tr>
  {{-- @if(!empty($line['modifiers']))
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
									&nbsp;
								</td>
								<td>
									&nbsp;
								</td>
								<td>
									&nbsp;
								</td>
								<td>
									{{$modifier['unit_price_exc_tax']}}
								</td>
								<td>
									{{$modifier['line_total']}}
								</td>
							</tr>
						@endforeach
					@endif --}}
				@endforeach

				@php
					$lines = count($receipt_details->lines);
				@endphp

			<!--	@for ($i = $lines; $i < 5; $i++)
    				<tr>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					@if(!empty($receipt_details->item_discount_label))
    					<td>&nbsp;</td>
    					@endif
    					@if(!empty($receipt_details->table_tax_headings))
						@foreach($receipt_details->table_tax_headings as $tax_heading)
							<td>&nbsp;</td>
						@endforeach
						@endif
    					
    					@if($receipt_details->show_cat_code == 1)
    						<td>&nbsp;</td>
    					@endif
    				</tr>
				@endfor -->
				<tr>
					@php
						$colspan = 4;
					@endphp
					@if($receipt_details->show_cat_code == 1)
						@php
							$colspan += 1;
						@endphp
					@endif
					
					@if(!empty($receipt_details->item_discount_label))
						@php
							$colspan += 1;
						@endphp
					@endif
					<th colspan="{{$colspan}}"
						style="background-color: #d2d6de !important;">
						Total
					</th>
					<th style="background-color: #d2d6de !important;">
						<span class="display_currency" data-currency_symbol="false">
							{{$totals['taxable_value']}}
						</span>
					</th>
					
					<!-- <td>&nbsp;</td> -->

					@if(!empty($receipt_details->table_tax_headings))
					@foreach($receipt_details->table_tax_headings as $tax_heading)
						<th style="background-color: #d2d6de !important;">
							<span class="display_currency" data-currency_symbol="false">
							{{$totals[$tax_heading]}}
							</span>
						</th>
					@endforeach
					@endif
@if(!empty($receipt_details->subtotal_unformatted))
					<th style="background-color: #d2d6de !important;">
						<span class="display_currency" data-currency_symbol="false">
							{{$receipt_details->subtotal_unformatted}}
						</span>
					</th>
                @endif
				</tr>
  </tbody>
</table>
		
	</div>
</div>

<div class="row invoice-info color-555 text-right" style="page-break-inside: avoid !important">
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
	</div>

	<div class="col-md-12 invoice-col width-100 text-left" style="margin-top:20px !important;">
		<table class="table">
            <thead class=""thead-light>
            <tr>
            @if(!empty($receipt_details->total_quantity_label))
            <th>
							{!! $receipt_details->total_quantity_label !!}
						</th>
            @endif
            @if(!empty($receipt_details->subtotal_label))
            <th>
						{!! $receipt_details->subtotal_label !!}
					</th>
            @endif
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
            <tr>
				@if(!empty($receipt_details->total_quantity_label))
						<td>
							{{$receipt_details->total_quantity}}
						</td>
				@endif
            @if(!empty($receipt_details->subtotal))
					<td>
						{{$receipt_details->subtotal}}
					</td>
				@endif
				<!-- Shipping Charges -->
				@if(!empty($receipt_details->shipping_charges))
						<td>
							{{$receipt_details->shipping_charges}}
						</td>
				@endif

				<!-- Packing Charges -->
				@if(!empty($receipt_details->packing_charge))
						<td>
							{{$receipt_details->packing_charge}}
						</td>
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
            </tr>
				<!-- Total -->
            @if( !empty($receipt_details->total_label) )
            <tr>
            <th>
						{!! $receipt_details->total_label !!}
					</th>
					<td>
						{{$receipt_details->total}}
					</td>
            </tr>
            @endif
            <!-- Total-Paid -->
            @if( !empty($receipt_details->total_paid_label) )
            <tr>
            <th>
						{!! $receipt_details->total_paid_label !!}
					</th>
					<td>
						{{$receipt_details->total_paid}}
					</td>
            </tr>
            @endif
            <!-- Total_due -->
            @if( !empty($receipt_details->total_due_label) )
            <tr>
            <th>
						{!! $receipt_details->total_due_label !!}
					</th>
					<td>
						{{$receipt_details->total_due}}
					</td>
            </tr>
            @endif
				@if(!empty($receipt_details->total_in_words))
				<tr>
					<td colspan="2" class="text-right">
						<small>({{$receipt_details->total_in_words}})</small>
					</td>
				</tr>
				@endif
			</tbody>
        </table>
    
    <b class="pull-right">@lang('lang_v1.authorized_signatory')</b>
	</div>
</div>

<div class="row color-555">
	<div class="col-xs-12">
		<br>
		<p>{!! nl2br($receipt_details->additional_notes) !!}</p>
	</div>
</div>
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
			 @if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
			<br>
			<div class="row">
					<div class="mt-5 col-xs-12" align="center" style="text-align:right !important" style="background:#b3bcc4 !important">
							{{--old qr code 4.2v --}}
						{{-- <img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee([1,2,3,4,5],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$y]), 'QRCODE')}}" alt="barcode"/> --}}

						{{--qr code 4.8v --}}
						<img style="width: 100px !important" class="center-block" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">

						<!--<span class="mt-5" style="padding:5px !important ; background:#b3bcc4 !important"> scan Qr code to view your invoice and make your payments</span> -->
					</div>
			</div>
			@endif

@if(!empty($receipt_details->footer_text))
	<div class="row color-555" style="; text-align: center !important">
		<div class="col-xs-12" style="; text-align: center !important">
			{!! $receipt_details->footer_text !!}
		</div>
	</div>
@endif

			</td>
		</tr>
	</tbody>
</table>