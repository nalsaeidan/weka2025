<!-- business information here -->
<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
       <!-- <title>Receipt-{{$receipt_details->invoice_no}}</title>-->
    </head>
    <body>
        <div class="row ticket">
        	
        	
        	@if(!empty($receipt_details->logo))
        		<div class="text-box text-center">
        			<img style="max-height: 100px; width: auto;" src="{{$receipt_details->logo}}" alt="Logo">
        		</div>
        	@endif
        	<div class="text-box">
        	<!-- Logo -->
            <p class="text-center">
            	<!-- Header text -->
            	@if(!empty($receipt_details->header_text))
            		<span class="headings">{!! $receipt_details->header_text !!}</span>
					<br/>
				@endif

				<!-- business information here -->
				@if(!empty($receipt_details->display_name))
					<span class="headings">
						{{$receipt_details->display_name}}
					</span>
					<br/>
				@endif
				
				@if(!empty($receipt_details->address))
					{!! $receipt_details->address !!}
					<br/>
				@endif

				@if(!empty($receipt_details->contact))
					{!! $receipt_details->contact !!}
				@endif
            	@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
				@endif
				@if(!empty($receipt_details->website))
					{{ $receipt_details->website }}
				@endif
				@if(!empty($receipt_details->location_custom_fields))
					<br>{{ $receipt_details->location_custom_fields }}
				@endif
				@if(!empty($receipt_details->transaction_type))
                        @if($receipt_details->transaction_type == 'sell_return')
                            <h5 class="text-center" style="font-weight: bold; font-size: 18px !important; color:#007665 !important;">{{'فاتورة مرتجعة'}}</h5>
						@endif
                   @endif   
                @if($receipt_details->transaction_type == 'sell')
				@if(!empty($receipt_details->sub_heading_line1))
					{{ $receipt_details->sub_heading_line1 }}<br/>
				@endif
				@if(!empty($receipt_details->sub_heading_line2))
					{{ $receipt_details->sub_heading_line2 }}<br/>
				@endif
				@if(!empty($receipt_details->sub_heading_line3))
					{{ $receipt_details->sub_heading_line3 }}<br/>
				@endif
				@if(!empty($receipt_details->sub_heading_line4))
					{{ $receipt_details->sub_heading_line4 }}<br/>
				@endif		
				@if(!empty($receipt_details->sub_heading_line5))
					{{ $receipt_details->sub_heading_line5 }}<br/>
				@endif
				@endif
				@if(!empty($receipt_details->tax_info1))
					<br><b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
				@endif

				@if(!empty($receipt_details->tax_info2))
					<b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}
				@endif
				<hr style="border-top: 1px dashed ;">
				<!-- Title of receipt -->
				@if(!empty($receipt_details->invoice_heading))
					<br/><p class="font-28 sub-headings" style="text-align: center !important">{!! $receipt_details->invoice_heading !!}</p>
				@endif
				

			</p>
			</div>
    		<hr style="border-top: 1px dashed ;">
			<div class=" textbox-info">
				<p class="f-right" style="font-weight:bold"><strong>{!! $receipt_details->invoice_no_prefix !!}</strong></p>
				<p class="f-left">
					{{$receipt_details->invoice_no}}
				</p>
			</div>
        <!-- Total Due-->
				@if(!empty($receipt_details->total_due))
				<div class="textbox-info ">
						<p class="f-right" style="font-weight:bold">
							<strong>{!! $receipt_details->total_due_label !!}</strong>
						</p>
                    <p class="f-left">{{$receipt_details->total_due}}</p>
					</div>
				@endif
				<div class="textbox-info">
				<p class="f-right" style="font-weight:bold"><strong>{!! $receipt_details->date_label !!}</strong></p>
				<p class="f-left">
					{{$receipt_details->invoice_date}}
				</p>
			</div>
			
			@if(!empty($receipt_details->due_date_label))
				<div class="textbox-info">
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->due_date_label}}</strong></p>
					<p class="f-left">{{$receipt_details->due_date ?? ''}}</p>
				</div>
			@endif

			@if(!empty($receipt_details->sales_person_label))
				<div class="textbox-info">
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->sales_person_label}}</strong></p>
				
					<p class="f-left">{{$receipt_details->sales_person}}</p>
				</div>
			@endif

			@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
				<div class="textbox-info">
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->brand_label}}</strong></p>
				
					<p class="f-left">{{$receipt_details->repair_brand}}</p>
				</div>
			@endif

			@if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
				<div class="textbox-info">
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->device_label}}</strong></p>
				
					<p class="f-left">{{$receipt_details->repair_device}}</p>
				</div>
			@endif
			
			@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
    
				<div class="textbox-info">
                @if(!empty($receipt_details->model_no_label))
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->model_no_label}}</strong></p>
				@endif
					<p class="f-left">{{$receipt_details->repair_model_no}}</p>
				</div>
			@endif
			
			@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
				<div class="textbox-info">
                @if(!empty($receipt_details->serial_no_label))
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->serial_no_label}}</strong></p>
				@endif
					<p class="f-left">{{$receipt_details->repair_serial_no}}</p>
				</div>
			@endif

			@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
				<div class="textbox-info">
                @if(!empty($receipt_details->repair_status_label))
					<p class="f-right" style="font-weight:bold"><strong>
						{!! $receipt_details->repair_status_label !!}
					</strong></p>
                @endif
					<p class="f-left">
						{{$receipt_details->repair_status}}
					</p>
				</div>
        	@endif

        	@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
	        	<div class="textbox-info">
                @if(!empty($receipt_details->repair_warranty_label))
	        		<p class="f-right" style="font-weight:bold"><strong>
	        			{!! $receipt_details->repair_warranty_label !!}
	        		</strong></p>
                @endif
	        		<p class="f-left">
	        			{{$receipt_details->repair_warranty}}
	        		</p>
	        	</div>
        	@endif

        	<!-- Waiter info -->
			@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
	        	<div class="textbox-info">
                @if(!empty($receipt_details->service_staff_label))
	        		<p class="f-right" style="font-weight:bold"><strong>
	        			{!! $receipt_details->service_staff_label !!}
	        		</strong></p>
                @endif
	        		<p class="f-left">
	        			{{$receipt_details->service_staff}}
					</p>
	        	</div>
	        @endif

	        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
	        	<div class="textbox-info">
	        		<p class="f-right"style="font-weight:bold"><strong>
	        			@if(!empty($receipt_details->table_label))
							<b>{!! $receipt_details->table_label !!}</b>
						@endif
	        		</strong></p>
	        		<p class="f-left">
	        			{{$receipt_details->table}}
	        		</p>
	        	</div>
	        @endif

	        <!-- customer info -->
   
	        <div class="textbox-info">
	        	<p class="" style="margin-bottom: 0px !important"><strong>
	        		{{$receipt_details->customer_label ?? ''}}
	        	</strong></p>

	        	<p class="">
	        		@if(!empty($receipt_details->customer_info))
						{!! $receipt_details->customer_info !!}
						
					@endif
	        	</p>
	        </div>
			
			@if(!empty($receipt_details->client_id_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{{ $receipt_details->client_id_label }}
					</strong></p>
					<p class="f-right">
						{{ $receipt_details->client_id }}
					</p>
				</div>
			@endif
			 @if(!empty($receipt_details->customer_tax_label))
				<div class="textbox-info">
					<p class="f-right"><strong>
						{{ $receipt_details->customer_tax_label }}
					</strong></p>
					<p class="f-left">
						{{ $receipt_details->customer_tax_number }}
					</p><br>
				</div>
			@endif
			

			@if(!empty($receipt_details->customer_custom_fields))
				<div class="textbox-info">
					<p class="centered">
						{!! $receipt_details->customer_custom_fields !!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->sales_person_label))
					
					<b>{{ $receipt_details->sales_person_label }}</b> {{ $receipt_details->sales_person }}<br/>
				@endif
			@if(!empty($receipt_details->customer_rp_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{{ $receipt_details->customer_rp_label }}
					</strong></p>
					<p class="f-right">
						{{ $receipt_details->customer_total_rp }}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_1_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_1_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_2_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_2_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_3_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_3_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_4_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_4_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->shipping_custom_field_5_label))
				<div class="textbox-info">
					<p class="f-left"><strong>
						{!!$receipt_details->shipping_custom_field_5_label!!} 
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
					</p>
				</div>
			@endif
			@if(!empty($receipt_details->sale_orders_invoice_no))
				<div class="textbox-info">
					<p class="f-left"><strong>
						@lang('restaurant.order_no')
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->sale_orders_invoice_no ?? ''!!}
					</p>
				</div>
			@endif

			@if(!empty($receipt_details->sale_orders_invoice_date))
				<div class="textbox-info">
					<p class="f-left"><strong>
						@lang('lang_v1.order_dates')
					</strong></p>
					<p class="f-right">
						{!!$receipt_details->sale_orders_invoice_date ?? ''!!}
					</p>
				</div>
			@endif
    @php
        $p_width = 40;
        @endphp
        @if(!empty($receipt_details->item_discount_label))
        @php
        $p_width -= 15;
        @endphp
        @endif
            <table style="margin-top: 25px !important; direction:rtl" class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-left" width="5%">#</th>
                    @if(empty($receipt_details->table_product_label))
                        <th class="text-left" width="19%">
                        	{{$receipt_details->table_product_label}}
                        </th>
                    @endif
                    @if(empty($receipt_details->table_qty_label))
                        <th class=" text-left" width="19%">
                        	{{$receipt_details->table_qty_label}}
                        </th>
                    @endif
                        @if(empty($receipt_details->hide_price))
                        <th class=" text-left" width="19%">
                        	{{$receipt_details->table_unit_price_label}}
                    </th>
                        @if(!empty($receipt_details->item_discount_label))
							<th class="text-left" width="19%">{{$receipt_details->item_discount_label}}</th>
						@endif
                        <th class=" text-left" width="19%">{{$receipt_details->table_subtotal_label}}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                	@forelse($receipt_details->lines as $line)
	                    <tr>
	                        <td class="" style="vertical-align: top;">
	                        	{{$loop->iteration}}
	                        </td>
	                        <td class="">
                             	@if(!empty($line['image']))
                    			<img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
                    			@endif
	                        	{{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
	                        	@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
	                        	@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
	                        	@if(!empty($line['sell_line_note']))
	                        	<br>
	                        	<span class="f-8">
	                        	{{$line['sell_line_note']}}
	                        	</span>
	                        	@endif 
	                        	@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif 
	                        	@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif
	                        	@if(!empty($line['warranty_name']))
	                            	<br>
	                            	<small>
	                            		{{$line['warranty_name']}}
	                            	</small>
	                            @endif
	                            @if(!empty($line['warranty_exp_date']))
	                            	<small>
	                            		- {{@format_date($line['warranty_exp_date'])}}
	                            </small>
	                            @endif
	                            @if(!empty($line['warranty_description']))
	                            	<small> {{$line['warranty_description'] ?? ''}}</small>
	                            @endif
	                        </td>
	                        <td class="">{{$line['quantity']}} {{$line['units']}}</td>
	                        @if(empty($receipt_details->hide_price))
	                        <td class="">{{$line['unit_price_before_discount']}}</td>
	                        @if(!empty($receipt_details->item_discount_label))
								<td class="">
									{{$line['line_discount'] ?? '0.00'}}
								</td>
							@endif
	                        <td class="">{{$line['line_total']}}</td>
	                        @endif
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr>
									<td>
										&nbsp;
									</td>
									<td>
			                            {{$modifier['	name']}} {{$modifier['variation']}} 
			                            @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif 
			                        </td>
									<td class="text-right">{{$modifier['quantity']}} {{$modifier['units']}} </td>
									@if(empty($receipt_details->hide_price))
									<td class="text-right">{{$modifier['unit_price_inc_tax']}}</td>
									@if(!empty($receipt_details->item_discount_label))
										<td class="text-right">0.00</td>
									@endif
									<td class="text-right">{{$modifier['line_total']}}</td>
									@endif
								</tr>
							@endforeach
						@endif
                    @endforeach-->
                    <tr>
                    	<td @if(!empty($receipt_details->item_discount_label)) colspan="6" @else colspan="5" @endif>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
    
    		<table class="table table-hover table-f-12" style="width:50%; float:left">
    <thead></thead>
    <tbody>
    @if(!empty($receipt_details->total_quantity_label))
    <tr>
					<td class="">
						{!! $receipt_details->total_quantity_label !!}
					</td>
					<td class="">
						{{$receipt_details->total_quantity}}
					</td>
    </tr>
			@endif
    @if(empty($receipt_details->hide_price))
                <tr>
                    <td class="">
                    	{!! $receipt_details->subtotal_label !!}
                    </td>
                    <td class="">
                    	{{$receipt_details->subtotal}}
                    </td>
                </tr>
                <!-- Shipping Charges -->
				@if(!empty($receipt_details->shipping_charges))
					<tr>
						<td class="">
							{!! $receipt_details->shipping_charges_label !!}
						</td>
						<td class="">
							{{$receipt_details->shipping_charges}}
						</td>
					</tr>
				@endif

				@if(!empty($receipt_details->packing_charge))
					<tr>
						<td class="">
							{!! $receipt_details->packing_charge_label !!}
						</td>
						<td class="">
							{{$receipt_details->packing_charge}}
						</td>
					</tr>
				@endif

				<!-- Discount -->
				@if( !empty($receipt_details->discount) )
					<tr>
						<td class="">
							{!! $receipt_details->discount_label !!}
						</td>

						<td class="">
							(-) {{$receipt_details->discount}}
						</td>
					</tr>
				@endif

				@if(!empty($receipt_details->reward_point_label) )
					<tr>
						<td class="">
							{!! $receipt_details->reward_point_label !!}
						</td>

						<td class="">
							(-) {{$receipt_details->reward_point_amount}}
						</td>
					</tr>
				@endif

				@if( !empty($receipt_details->tax) )
					<tr>
						<td class="">
							{!! $receipt_details->tax_label !!}
						</td>
						<td class="">
							(+) {{$receipt_details->tax}}
						</td>
					</tr>
				@endif

				@if( $receipt_details->round_off_amount > 0)
					<tr>
						<td class="">
							{!! $receipt_details->round_off_label !!} 
						</td>
						<td class="">
							{{$receipt_details->round_off}}
						</td>
					</tr>
				@endif
				@if(!empty($receipt_details->total_in_words))
    <tr>
				<td colspan="2" class="">
					<small>
					({{$receipt_details->total_in_words}})
					</small>
				</td>
    </tr>
				@endif
				@if(!empty($receipt_details->payments))
					@foreach($receipt_details->payments as $payment)
						<tr>
							<td class="">{{$payment['method']}} ({{$payment['date']}}) </td>
							<td class="">{{$payment['amount']}}</td>
						</tr>
					@endforeach
				@endif
<!-- Total -->
			<tr>
					<td class="">
						{!! $receipt_details->total_label !!}
					</td>
					<td class="">
						{{$receipt_details->total}}
					</td>
				</tr>
				<!-- Total Paid-->
				@if(!empty($receipt_details->total_paid))
					<tr>
						<td class="">
							{!! $receipt_details->total_paid_label !!}
						</td>
						<td class="">
							{{$receipt_details->total_paid}}
						</td>
					</tr>
				@endif

				<!-- Total Due-->
					<tr>
                    @if(!empty($receipt_details->total_due))
						<td class="">
							{!! $receipt_details->total_due_label  !!}
						</td>
						<td class="">
							{{$receipt_details->total_due}}
						</td>
                    @endif
					</tr>
    @if(!empty($receipt_details->types_of_service))
					
					<tr>
						<td>{!! $receipt_details->types_of_service_label !!}:</td>
                   		 <td>{{$receipt_details->types_of_service}}</td>
                    </tr>
						<!-- Waiter info -->
						@if(!empty($receipt_details->types_of_service_custom_fields))
							@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
                    		<tr><td><strong>{{$key}}: </strong> {{$value}}</td></tr>
							@endforeach
						@endif
				@endif
			@if(!empty($receipt_details->all_due))
					<tr>
						<td class="">
							{!! $receipt_details->all_bal_label !!}
						</td>
						<td class="">
							{{$receipt_details->all_due}}
						</td>
					</tr>
				@endif
			@endif
    </tbody>
    </table>
    
    			
            @if(empty($receipt_details->hide_price))
	            <!-- tax -->
	            @if(!empty($receipt_details->taxes))
	            	<table class="border-bottom width-100 table-f-12" style="width:100%;">
	            		@foreach($receipt_details->taxes as $key => $val)
	            			<tr>
	            				<td class="left">{{$key}}</td>
	            				<td class="right">{{$val}}</td>
	            			</tr>
	            		@endforeach
	            	</table>
	            @endif
            @endif


            @if(!empty($receipt_details->additional_notes))
	            <p class="centered" >
	            	{!! nl2br($receipt_details->additional_notes) !!}
	            </p>
            @endif
            {{-- Barcode --}}
			@if($receipt_details->show_barcode)
				<br/>
    
				<!-- <img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}"> -->
				         
    <table style="width:100% !important; margin-top: 30px;">
                <thead></thead>
                <tbody>
                <tr>
                <td>
                
                  <img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee([1,2,3,4,5],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$receipt_details->tax1]), 'QRCODE')}}" alt="barcode"/>

                
<!--                 @if(empty($receipt_details->display_name)&&empty($receipt_details->tax_info1)&&empty($receipt_details->tax))
                		<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.' 
                                                              '.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
                                                              '.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>

					@elseif(empty($receipt_details->display_name)&&empty($receipt_details->tax_info1))

                		<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.' 
                                                              '.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
															  '.'الضريبة ='.$receipt_details->tax.'
                                                              '.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
															  
				    @elseif(empty($receipt_details->display_name)&&empty($receipt_details->tax))

						<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.'
															    '.'الرقم الضريبي ='. $receipt_details->tax_info1.'  
																'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
																'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/> -->

<!-- 					@elseif(empty($receipt_details->tax)&&empty($receipt_details->tax_info1))

					<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->display_name.' 
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>


	
					@elseif(empty($receipt_details->tax))
					<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->display_name.' 
														'.'الرقم الضريبي ='. $receipt_details->tax_info1.'   
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>

					@elseif(empty($receipt_details->tax_info1))
					<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->display_name.' 
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.'
														'.'الضريبة ='.$receipt_details->tax.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/> -->
					
					
<!-- 					@elseif(empty($receipt_details->display_name))
					<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->display_name.' 
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.'
														'.'الضريبة ='.$receipt_details->tax.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>

					@else
					<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->display_name.' 
														'.'الرقم الضريبي ='. $receipt_details->tax_info1.'   
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.'
														'.'الضريبة ='.$receipt_details->tax.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
					@endif -->
                </tr>
                </tbody>
    </table>
    
                
<!--<p class="mt-5 text-center"> scan Qr code to view your invoice and make your payments</p>	-->
        
				@endif
    
			@if(!empty($receipt_details->footer_text))
				<p class="centered">
					{!! $receipt_details->footer_text !!}
				</p>
			@endif
    
        <!-- <button id="btnPrint" class="hidden-print">Print</button>
        <script src="script.js"></script> -->
    </body>
</html>

<style type="text/css">
.f-8 {
	font-size: 8px !important;
}
@media print {
	* {
    	font-size: 12px;
    	font-family: 'Times New Roman';
    	word-break: break-all;
	}
	.f-8 {
		font-size: 8px !important;
	}
	
.headings{
	font-size: 16px;
	font-weight: 700;
	text-transform: uppercase;
	white-space: nowrap;
}

.sub-headings{
	font-size: 15px !important;
	font-weight: 700 !important;
}

.border-top{
    border-top: 1px solid #242424;
}
.border-bottom{
	border-bottom: 1px solid #242424;
}

.border-bottom-dotted{
	border-bottom: 1px dotted darkgray;
}


.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 100%;
    max-width: 100%;
}

img {
    max-width: inherit;
    width: auto;
}

    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
.table-info {
	width: 100%;
}
.table-info tr:first-child td, .table-info tr:first-child th {
	padding-top: 8px;
}
.logo {
	float: left;
	width:35%;
	padding: 10px;
}

.text-with-image {
	float: left;
	width:65%;
}
.text-box {
	width: 100%;
	height: auto;
}

.textbox-info {
	clear: both;
}

.flex-box {
	display: flex;
	width: 100%;
}
.flex-box p {
	margin-bottom: 0px;
	white-space: nowrap;
}

.table-f-12 th, .table-f-12 td {
	font-size: 12px;
	word-break: break-word;
}

.bw {
	word-break: break-word;
}
</style>