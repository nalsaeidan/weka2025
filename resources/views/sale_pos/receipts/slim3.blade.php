<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Receipt-{{$receipt_details->invoice_no}}</title>
    </head>
    <body>
        <div class="ticket">
        	
        	
        	@if(!empty($receipt_details->logo))
        		<div class="text-box centered">
        			<img style="max-height: 100px; width: auto;" src="{{$receipt_details->logo}}" alt="Logo">
        		</div>
        	@endif
        	<div class="text-box">
        	<!-- Logo -->
            <div class="centered">
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
<!--             	@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
				@endif -->
				@if(!empty($receipt_details->website))
					<br>{{ $receipt_details->website }}
				@endif
				@if(!empty($receipt_details->location_custom_fields))
					<br>{{ $receipt_details->location_custom_fields }}
				@endif

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
			</div>
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
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->model_no_label}}</strong></p>
				
					<p class="f-left">{{$receipt_details->repair_model_no}}</p>
				</div>
			@endif
			
			@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
				<div class="textbox-info">
					<p class="f-right" style="font-weight:bold"><strong>{{$receipt_details->serial_no_label}}</strong></p>
				
					<p class="f-left">{{$receipt_details->repair_serial_no}}</p>
				</div>
			@endif

			@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
				<div class="textbox-info">
					<p class="f-right" style="font-weight:bold"><strong>
						{!! $receipt_details->repair_status_label !!}
					</strong></p>
					<p class="f-left">
						{{$receipt_details->repair_status}}
					</p>
				</div>
        	@endif

        	@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
	        	<div class="textbox-info">
	        		<p class="f-right" style="font-weight:bold"><strong>
	        			{!! $receipt_details->repair_warranty_label !!}
	        		</strong></p>
	        		<p class="f-left">
	        			{{$receipt_details->repair_warranty}}
	        		</p>
	        	</div>
        	@endif

        	<!-- Waiter info -->
			@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
	        	<div class="textbox-info">
	        		<p class="f-right" style="font-weight:bold"><strong>
	        			{!! $receipt_details->service_staff_label !!}
	        		</strong></p>
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
    @if(!empty($receipt_details->customer_tax_label))
				<div class="textbox-info">
					<p class="f-right"><strong>
						{{ $receipt_details->customer_tax_label }}
					</strong></p>
					<p class="f-left">
						{{ $receipt_details->customer_tax_number }}
					</p>
				</div>
			@endif
	        <br/>
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
			
			

			@if(!empty($receipt_details->customer_custom_fields))
				<div class="textbox-info">
					<p class="centered">
						{!! $receipt_details->customer_custom_fields !!}
					</p>
				</div>
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
            <div class="bb-lg mt-15 mb-10"></div>
            <table class="table table-bordered" style="padding-top: 5px !important" class="border-bottom width-100 table-f-12 mb-10">
            <thead>
            <!-- <th>#</th> -->
            <th>{{$receipt_details->table_product_label}}</th>
            <th>{{$receipt_details->table_qty_label}}</th>
            @if(empty($receipt_details->hide_price))
                        <th>
                        	{{"السعر"}}
                        </th>
            @endif
            </thead>
                <tbody>
                	@forelse($receipt_details->lines as $line)
	                    <tr class="bb-lg">
	                        <!--	<td>{{$loop->iteration}}.&nbsp;</td>-->
	                        		<td>{{$line['name']}}  
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

			                        	@if(!empty($line['variation']))
			                        		,
			                        		{{$line['product_variation']}} {{$line['variation']}}
			                        	@endif
			                        	@if(!empty($line['warranty_name']))
			                            	, 
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
	                        		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                        			{{$line['quantity']}} 
	             
	                        		
	                        			
	                        			
	                        				
	                        			
	    
	                        		</td>
	                        		@if(empty($receipt_details->hide_price))
	                        		<td>{{$line['line_total']}}</td>
	                        		@endif
	                        
	                    </tr>
	                    @if(!empty($line['modifiers']))
							@foreach($line['modifiers'] as $modifier)
								<tr>
									<td>
										<div style="display:flex;">
	                        				<p style="width: 28px;" class="m-0">
	                        				</p>
	                        				<p class="text-left width-60 m-0" style="margin:0;">
	                        					{{$modifier['name']}} 
	                        					@if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
			                            		@if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif
	                        				</p>
	                        				<p class="text-right width-40 m-0">
	                        					{{$modifier['variation']}}
	                        				</p>
	                        			</div>	
	                        			<div style="display:flex;">
	                        				<p style="width: 28px;"></p>
	                        				<p class="text-left width-50 quantity">
	                        					{{$modifier['quantity']}}
	                        					@if(empty($receipt_details->hide_price))
	                        					x {{$modifier['unit_price_inc_tax']}}
	                        					@endif
	                        				</p>
	                        				<p class="text-right width-50 price">
	                        					{{$modifier['line_total']}}
	                        				</p>
	                        			</div>		                             
			                        </td>
			                    </tr>
							@endforeach
						@endif
                    @endforeach
                </tbody>
            </table>
    <hr style="border-top: 1px dashed">       
    @if(!empty($receipt_details->total_quantity_label))
				<div class="flex-box">
					<p class="left text-left">
						{!! $receipt_details->total_quantity_label !!}
					</p>
					<p class="width-50 text-right">
						{{$receipt_details->total_quantity}}
					</p>
				</div>
			@endif
			@if(empty($receipt_details->hide_price))
            <div class="flex-box">
                <p class="left text-left">
                	<strong>{!! $receipt_details->subtotal_label !!}</strong>
                </p>
                <p class="width-50 text-right">
                	<strong>{{$receipt_details->subtotal}}</strong>
                </p>
            </div>

            <!-- Shipping Charges -->
			@if(!empty($receipt_details->shipping_charges))
				<div class="flex-box">
					<p class="left text-left">
						{!! $receipt_details->shipping_charges_label !!}
					</p>
					<p class="width-50 text-right">
						{{$receipt_details->shipping_charges}}
					</p>
				</div>
			@endif

			@if(!empty($receipt_details->packing_charge))
				<div class="flex-box">
					<p class="left text-left">
						{!! $receipt_details->packing_charge_label !!}
					</p>
					<p class="width-50 text-right">
						{{$receipt_details->packing_charge}}
					</p>
				</div>
			@endif

			<!-- Discount -->
			@if( !empty($receipt_details->discount) )
				<div class="flex-box">
					<p class="width-50 text-left">
						{!! $receipt_details->discount_label !!}
					</p>

					<p class="width-50 text-right">
						(-) {{$receipt_details->discount}}
					</p>
				</div>
			@endif

			@if(!empty($receipt_details->reward_point_label) )
				<div class="flex-box">
					<p class="width-50 text-left">
						{!! $receipt_details->reward_point_label !!}
					</p>

					<p class="width-50 text-right">
						(-) {{$receipt_details->reward_point_amount}}
					</p>
				</div>
			@endif

			@if( !empty($receipt_details->tax) )
				<div class="flex-box">
					<p class="width-50 text-left">
						{!! $receipt_details->tax_label !!}
					</p>
					<p class="width-50 text-right">
						(+) {{$receipt_details->tax}}
					</p>
				</div>
			@endif

			@if( $receipt_details->round_off_amount > 0)
				<div class="flex-box">
					<p class="width-50 text-left">
						{!! $receipt_details->round_off_label !!} 
					</p>
					<p class="width-50 text-right">
						{{$receipt_details->round_off}}
					</p>
				</div>
			@endif
<!--
			<div class="flex-box">
				<p class="width-50 text-left">
					<strong>{!! $receipt_details->total_label !!}</strong>
				</p>
				<p class="width-50 text-right">
					<strong>{{$receipt_details->total}}</strong>
				</p>
			</div>-->
			@if(!empty($receipt_details->total_in_words))
				<p colspan="2" class="text-right mb-0">
					<small>
					({{$receipt_details->total_in_words}})
					</small>
				</p>
			@endif
			@if(!empty($receipt_details->payments))
				@foreach($receipt_details->payments as $payment)
					<div class="flex-box">
						<p class="width-50 text-left">{{$payment['method']}} ({{$payment['date']}}) </p>
						<p class="width-50 text-right">{{$payment['amount']}}</p>
					</div>
				@endforeach
			@endif
            <!-- Total Paid-->
				@if(!empty($receipt_details->total_paid))
					<div class="flex-box">
						<p class="width-50 text-left">
							{!! $receipt_details->total_paid_label !!}
						</p>
						<p class="width-50 text-right">
							{{$receipt_details->total_paid}}
						</p>
					</div>
				@endif

				<!-- Total Due-->
				@if(!empty($receipt_details->total_due))
					<div class="flex-box">
						<p class="width-50 text-left">
							{!! $receipt_details->total_due_label !!}
						</p>
						<p class="width-50 text-right">
							{{$receipt_details->total_due}}
						</p>
					</div>
				@endif

				@if(!empty($receipt_details->all_due))
					<div class="flex-box">
						<p class="width-50 text-left">
							{!! $receipt_details->all_bal_label !!}
						</p>
						<p class="width-50 text-right">
							{{$receipt_details->all_due}}
						</p>
					</div>
				@endif
    <hr>
    <!-- Total-->
				@if(!empty($receipt_details->total_label))
					<div class="flex-box">
						<p class="width-50 text-left">
                        <strong>{!! $receipt_details->total_label !!}</strong>
						</p>
						<p class="width-50 text-right">
                        <strong>{{$receipt_details->total}}</strong>
						</p>
					</div>
				@endif
			@endif
            <div class="border-bottom width-100">&nbsp;</div>
            @if(empty($receipt_details->hide_price))
	            <!-- tax -->
	            @if(!empty($receipt_details->taxes))
	            	<table class="border-bottom width-100 table-f-12">
	            		@foreach($receipt_details->taxes as $key => $val)
	            			<tr>
	            				<td class="text-left">{{$key}}</td>
	            				<td class="text-right">{{$val}}</td>
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
        
                 <img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee([1,2,3,4,5],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$receipt_details->tax1]), 'QRCODE')}}" alt="barcode"/>

				<!-- <img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}"> -->
<!-- 				@if(empty($receipt_details->display_name)&&empty($receipt_details->tax_info1)&&empty($receipt_details->tax))
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
				@endif

			@if(!empty($receipt_details->footer_text))
				<p class="centered">
					{!! $receipt_details->footer_text !!}
				</p>
			@endif
        </div>
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
}

.sub-headings{
	font-size: 15px;
	font-weight: 700;
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

td.serial_number, th.serial_number{
	width: 5%;
    max-width: 5%;
}

td.description,
th.description {
    width: 35%;
    max-width: 35%;
}

td.quantity,
th.quantity {
    width: 15%;
    max-width: 15%;
    word-break: break-all;
}
td.unit_price, th.unit_price{
	width: 25%;
    max-width: 25%;
    word-break: break-all;
}

td.price,
th.price {
    width: 20%;
    max-width: 20%;
    word-break: break-all;
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
.table-info th {
	text-align: left;
}
.table-info td {
	text-align: right;
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
.m-0 {
	margin:0;
}
.textbox-info {
	clear: both;
}
.textbox-info p {
	margin-bottom: 0px
}
.flex-box {
	display: flex;
	width: 100%;
}
.flex-box p {
	width: 50%;
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
.bb-lg {
	border-bottom: 1px solid lightgray;
}
</style>

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