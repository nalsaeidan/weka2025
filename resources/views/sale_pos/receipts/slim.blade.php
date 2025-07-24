<!-- business information here -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="style.css"> -->
        <title>Receipt-{{$receipt_details->invoice_no}}</title>
    <style>
    .no-td-padding.table>tbody>tr>td{
	padding: 0px !important;
	}
    </style>
    </head>
    <body>
        <div class="ticket">
        	@if(!empty($receipt_details->logo))
				<div class="text-box text-center">
					<img style="max-height: 100px; width: auto;" src="{{$receipt_details->logo}}" alt="Logo">
				</div>
			@endif
			<div class="text-box">
				<!-- Logo -->
				<div class="text-center">
					<!-- Header text -->
					@if(!empty($receipt_details->header_text))
						<p class="headings">{!! $receipt_details->header_text !!}</p>=
					@endif

				<!-- business information here -->
					@if(!empty($receipt_details->display_name))
						<p class="headings">
							{{$receipt_details->display_name}}
						</p>
					@endif

					@if(!empty($receipt_details->address))
						<p>{!! $receipt_details->address !!}</p>
					@endif

					@if(!empty($receipt_details->contact))
						<p>{!! $receipt_details->contact !!}</p>
					@endif
					{{--             	@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
                    @endif --}}
					@if(!empty($receipt_details->website))
						<p>{{ $receipt_details->website }}</p>
					@endif
					@if(!empty($receipt_details->location_custom_fields))
						<p>{{ $receipt_details->location_custom_fields }}</p>
					@endif
                    @if(!empty($receipt_details->transaction_type))
                        @if($receipt_details->transaction_type == 'sell_return')
                            <h5 class="text-center" style="font-weight: bold; font-size: 18px !important; color:#007665 !important;">{{'فاتورة مرتجعة'}}</h5>
						@endif
                   @endif   
                @if($receipt_details->transaction_type == 'sell')

					@if(!empty($receipt_details->sub_heading_line1))
						<p>{{ $receipt_details->sub_heading_line1 }}</p>
					@endif
					@if(!empty($receipt_details->sub_heading_line2))
						<p>{{ $receipt_details->sub_heading_line2 }}</p>
					@endif
					@if(!empty($receipt_details->sub_heading_line3))
						<p>{{ $receipt_details->sub_heading_line3 }}</p>
					@endif
					@if(!empty($receipt_details->sub_heading_line4))
						<p>{{ $receipt_details->sub_heading_line4 }}</p>
					@endif
					@if(!empty($receipt_details->sub_heading_line5))
						<p>{{ $receipt_details->sub_heading_line5 }}</p>
					@endif
					@endif
					@if(!empty($receipt_details->tax_info1))
						<p><b>{{ $receipt_details->tax_label1 }}</b> {{ $receipt_details->tax_info1 }}
							@endif

							@if(!empty($receipt_details->tax_info2))
								<b>{{ $receipt_details->tax_label2 }}</b> {{ $receipt_details->tax_info2 }}</p>
					@endif
					@if(!empty($receipt_details->commession))
						<p>{{" مندوب:  "}}{{ $receipt_details->commession }}</p>
					@endif
					<hr style="border-top: 1px dashed ;">
					<!-- Title of receipt -->
					@if(!empty($receipt_details->invoice_heading))
						<p class="font-28 sub-headings" style="text-align: center !important">{!! $receipt_details->invoice_heading !!}</p>
					@endif
					{{-- رقم السجل
                    @if(!empty($receipt_details->record))
                    <p class=" sub-headings" style="text-align: center !important; font-size: 26px !important; font-weight: bold !important;">{{'#' . $receipt_details->record}}</p>
                    @endif --}}

				</div>
			</div>
				<hr style="border-top: 1px dashed ;">
        	@if(!empty($receipt_details->invoice_no))
					<div class=" textbox-info">
						<p class="" style="font-weight:bold; float: right; text-align: right;">
							<strong>{!! $receipt_details->invoice_no_prefix !!}</strong>
						</p>
						<p class="" style="float: left; text-align: right;">
							{{$receipt_details->invoice_no}}
						</p>
					</div>
				@endif
			<!-- Total Due-->
				@if(!empty($receipt_details->total_due))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float:right;">
							<strong>{!! $receipt_details->total_due_label !!}</strong>
						</p>
						<p class="" style="float: left;">{{$receipt_details->total_due}}</p>
					</div>
				@endif
				@if(!empty($receipt_details->invoice_date))
					<div class="textbox-info">
						<p class="" style="font-weight:bold;float:right; text-align: right;"><strong>{!! $receipt_details->date_label !!}</strong></p>
						<p class="" style="float: left; text-align: right;">
							{{$receipt_details->invoice_date}}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->due_date_label))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float: right; text-align: right;"><strong>{{$receipt_details->due_date_label}}</strong></p>
						<p class="" style="float: left; text-align: right;">{{$receipt_details->due_date . ''}}</p>
					</div>
				@endif
				@if(!empty($receipt_details->sales_person_label))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float: right; text-align: right;"><strong>{{$receipt_details->sales_person_label}}</strong></p>

						<p class="" style="float: left; text-align: right;">{{$receipt_details->sales_person}}</p>
					</div>
				@endif
				@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float:right;"><strong>{{$receipt_details->brand_label}}</strong></p>

						<p class="" style="float:left;">{{$receipt_details->repair_brand}}</p>
					</div>
				@endif
				@if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float: right;"><strong>{{$receipt_details->device_label}}</strong></p>

						<p class="" style="float: left;">{{$receipt_details->repair_device}}</p>
					</div>
				@endif
				@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float: right;"><strong>{{$receipt_details->model_no_label}}</strong></p>

						<p class="" style="float: left;">{{$receipt_details->repair_model_no}}</p>
					</div>
				@endif
				@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float: right;"><strong>{{$receipt_details->serial_no_label}}</strong></p>

						<p class="" style="float: left;">{{$receipt_details->repair_serial_no}}</p>
					</div>
				@endif

				@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float: right;"><strong>
								{!! $receipt_details->repair_status_label !!}
							</strong></p>
						<p class="" style="float: left;">
							{{$receipt_details->repair_status}}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float:right;"><strong>
								{!! $receipt_details->repair_warranty_label !!}
							</strong></p>
						<p class="" style="float: left">
							{{$receipt_details->repair_warranty}}
						</p>
					</div>
				@endif
			<!-- Waiter info -->
				@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
					<div class="textbox-info">
						<p class="" style="font-weight:bold; float: right;"><strong>
								{!! $receipt_details->service_staff_label !!}
							</strong></p>
						<p class="" style="float: left;">
							{{$receipt_details->service_staff}}
						</p>
					</div>
				@endif

				@if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
					<div class="textbox-info">
						<p class=""style="font-weight:bold; float: right;"><strong>
								@if(!empty($receipt_details->table_label))
									<b>{!! $receipt_details->table_label !!}</b>
								@endif
							</strong></p>
						<p class="" style="float: left;">
							{{$receipt_details->table}}
						</p>
					</div>
				@endif
			<!-- customer info -->
				@if(!empty($receipt_details->customer_tax_label))
					<div class="textbox-info">
						<p class="" style="float: right;"><strong>
								{{ $receipt_details->customer_tax_label }}
							</strong></p>
						<p class="" style="float: left;">
							{{ $receipt_details->customer_tax_number }}
						</p>
					</div>
				@endif
				<div class="textbox-info">
					@if(!empty($receipt_details->customer_label))
						<p class="" style="float: right;"><strong>
								{{$receipt_details->customer_label . ''}}
							</strong></p>
					@endif
					@if(!empty($receipt_details->customer_info))
						<p class="customer" style="float:left;">
							{!! $receipt_details->customer_info !!}
						</p>
					@endif
				</div>
				@if(!empty($receipt_details->client_id))
					<div class="textbox-info">
						<p class="" style="float: right;"><strong>
								{{ $receipt_details->client_id_label }}
							</strong></p>
						<p class="" style="float: left;">
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
						<p class="" style="float: right;"><strong>
								{{ $receipt_details->customer_rp_label }}
							</strong></p>
						<p class="" style="float: left;">
							{{ $receipt_details->customer_total_rp }}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->shipping_custom_field_1_label))
					<div class="textbox-info">
						<p class="" style="float: right;"><strong>
								{!!$receipt_details->shipping_custom_field_1_label!!}
							</strong></p>
						<p class="" style="float: left;">
							{!!$receipt_details->shipping_custom_field_1_value . ''!!}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->shipping_custom_field_2_label))
					<div class="textbox-info">
						<p class="" style="float: right;"><strong>
								{!!$receipt_details->shipping_custom_field_2_label!!}
							</strong></p>
						<p class="" style="float: left;">
							{!!$receipt_details->shipping_custom_field_2_value . ''!!}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->shipping_custom_field_3_label))
					<div class="textbox-info">
						<p class="" style="float: right;"><strong>
								{!!$receipt_details->shipping_custom_field_3_label!!}
							</strong></p>
						<p class="" style="float: left;">
							{!!$receipt_details->shipping_custom_field_3_value . ''!!}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->shipping_custom_field_4_label))
					<div class="textbox-info">
						<p class="" style="float: right"><strong>
								{!!$receipt_details->shipping_custom_field_4_label!!}
							</strong></p>
						<p class="" style="float: left;">
							{!!$receipt_details->shipping_custom_field_4_value . ''!!}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->shipping_custom_field_5_label))
					<div class="textbox-info">
						<p class="" style="float: right;"><strong>
								{!!$receipt_details->shipping_custom_field_5_label!!}
							</strong></p>
						<p class="" style="float: left;">
							{!!$receipt_details->shipping_custom_field_5_value . ''!!}
						</p>
					</div>
				@endif
				@if(!empty($receipt_details->sale_orders_invoice_no))
					<div class="textbox-info">
						<p class="" style="float: right"><strong>
								@lang('restaurant.order_no')
							</strong></p>
						<p class="" style="float: left;">
							{!!$receipt_details->sale_orders_invoice_no . ''!!}
						</p>
					</div>
				@endif

				@if(!empty($receipt_details->sale_orders_invoice_date))
					<div class="textbox-info">
						<p class="" style="float: right;"><strong>
								@lang('lang_v1.order_dates')
							</strong></p>
						<p class="" style="float:left;">
							{!!$receipt_details->sale_orders_invoice_date . ''!!}
						</p>
					</div>
				@endif
				<div class="bb-lg mt-15 mb-10"></div>
        <table class="no-td-padding table table-bordered border-bottom width-100 table-f-12 mb-10" style="padding-top: 5px !important; direction: rtl !important;">
            <thead>
					<!-- <th>#</th> -->
					<th style="text-align: right;">{{$receipt_details->table_product_label}}</th>
					<th style="text-align: right;">{{$receipt_details->table_qty_label}}</th>
					@if(empty($receipt_details->hide_price))
						<th style="text-align: right;">
							{{"السعر"}}
						</th>
					@endif
					</thead>
                <tbody>
                	@foreach($receipt_details->lines as $line)
	                    <tr class="bb-lg">
							{{--	                        	<td>{{$loop->iteration}}.&nbsp;</td>--}}
							<td>{{$line['name']}}
								@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
								@if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
								@if(!empty($line['sell_line_note']))
									<p class="f-8">
										{{$line['sell_line_note']}}
									</p>
								@endif
								@if(!empty($line['lot_number']))<p> {{$line['lot_number_label']}}:  {{$line['lot_number']}}<p> @endif
									@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

									@if(!empty($line['variation']))
										,
										@if(!empty($line['product_variation']))
										{{$line['product_variation']}} 
										@endif
										{{$line['variation']}}
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
										<small> {{$line['warranty_description'] . ''}}</small>
								@endif
								@if(!empty($line['modifiers']))
									<table class="table child_table" style="border: solid white !important; margin-top: 3px;">

										<tbody>
										@foreach($line['modifiers'] as $modifier)
											<tr>
												@if(!empty($modifier['variation']))
													<td>{{$modifier['variation']}} </td>
												@endif
												@if(!empty($modifier['quantity']))
													<td>{{$modifier['quantity']}}</td>
												@endif
												@if(!empty($modifier['line_total']))
													<td>{{$modifier['line_total']}}</td>
												@endif
											</tr>
										@endforeach
										</tbody>
									</table>
								@endif
							</td>
							@if(!empty($line['quantity']))
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									{{$line['quantity']}}
								</td>
							@endif
							@if(empty($receipt_details->hide_price))
								@if(!empty($line['line_total']))
									<td>{{$line['line_total']}}</td>
								@endif
							@endif

						</tr>
	                {{--	                    @if(!empty($line['modifiers']))--}}
						{{--							@foreach($line['modifiers'] as $modifier)--}}
						{{--								<tr>--}}
						{{--									<td>--}}
						{{--										<div class="row">--}}
						{{--	                        				<p class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6" style="">--}}
						{{--	                        					{{$modifier['name']}} --}}
						{{--	                        					@if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif--}}
						{{--			                            		@if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif--}}
						{{--	                        				</p>--}}
						{{--	                        				<p class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6" style="">--}}
						{{--	                        					{{$modifier['variation']}}--}}
						{{--	                        				</p>--}}
						{{--	                        			</div>	--}}
						{{--	                        			<div class="row">--}}
						{{--	                        				<p class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">--}}
						{{--	                        					{{$modifier['quantity']}}--}}
						{{--	                        					@if(empty($receipt_details->hide_price))--}}
						{{--	                        					x {{$modifier['unit_price_inc_tax']}}--}}
						{{--	                        					@endif--}}
						{{--	                        				</p>--}}
						{{--	                        				<p class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 price">--}}
						{{--	                        					{{$modifier['line_total']}}--}}
						{{--	                        				</p>--}}
						{{--	                        			</div>		                             --}}
						{{--			                        </td>--}}
						{{--			                    </tr>--}}
						{{--							@endforeach--}}
						{{--						@endif--}}
@endforeach
                </tbody>
            </table>
        @php
					if (!empty($receipt_details)){
                        if(!empty($receipt_details->line_tax_label)){
                        $total_row_tax = 0.0;
                        foreach($receipt_details->lines as $line){
                        $total_row_tax = $total_row_tax + ($line['tax'] * $line['quantity']) ;
                        }
                        }
                        }
				@endphp
    		<hr style="border-top: 1px dashed"> 
        <div class="flex-box">
						@if(!empty($receipt_details->total_quantity_label))
						<p class="" style="float:right; text-align: right;">
							{!! $receipt_details->total_quantity_label !!}
						</p>
						@endif
						@if(!empty($receipt_details->total_quantity))
						<p class="" style="float: right; text-align: right;">
							{{$receipt_details->total_quantity}}
						</p>
							@endif
					</div>
                        @php
					$subtotal = 0;
                    if (!empty($receipt_details->lines)){
                    foreach($receipt_details->lines as $line){
                        $price_per_row = 0;
                        if (!empty($line['unit_price_before_discount']) && !empty($line['quantity'])){
                    $price_per_row = $line['unit_price_before_discount'] * $line['quantity'];
                    }elseif (!empty($line['unit_price']) && !empty($line['quantity'])){
                      $price_per_row = $line['unit_price'] * $line['quantity'];      
                    }
                    if(!empty($line['modifiers'])){
                    foreach($line['modifiers'] as $modifier){
                        if(!empty($modifier['line_total'])){
                    $price_per_row = $price_per_row + $modifier['line_total'];
                    }
                    }
                    }
                    $subtotal = $subtotal + $price_per_row;
                    }
                    }
				@endphp
        @if(empty($receipt_details->hide_price))
            <div class="flex-box" style="direction: rtl;">
						@if(!empty($receipt_details->subtotal_label))
							<p class="" style="float:right; text-align: right;">
								<strong>{!! $receipt_details->subtotal_label !!}</strong>
							</p>
						@endif
						@if(!empty($subtotal))
							<p class="" style="float: left; text-align: left;">
								<strong>{{' ريال '}}{{$subtotal}}</strong>
							</p>
						@endif
					</div>
        @if(empty($receipt_details->hide_price))
					<!-- tax -->
						@if(!empty($receipt_details->taxes))
							<div class="flex-box" style="direction: rtl;">
								<p class="" style="float:right; text-align: right; width: 50%;">
									ضريبة القيمة المضافة
								</p>
								@if(!empty($total_row_tax))
									<p class="" style="float:left; text-align: left; width: 50%;">
										{{' ريال '}}{{$total_row_tax}}
									</p>
								@endif
							</div>
						@endif
					@endif
        <!-- Shipping Charges -->
			@if(!empty($receipt_details->shipping_charges))
						<div class="flex-box" style="direction: rtl;">
							@if(!empty($receipt_details->shipping_charges_label))
								<p class="" style="float:right; text-align: right;">
									{!! $receipt_details->shipping_charges_label !!}
								</p>
							@endif
							<p class="" style="float: left; text-align: left;">
								{{$receipt_details->shipping_charges}}
							</p>
						</div>
					@endif

			@if(!empty($receipt_details->packing_charge) && !empty($receipt_details->packing_charge_label))
						<div class="flex-box" style="direction: rtl;">
							<p class="" style="float:right; text-align: right;">
								{!! $receipt_details->packing_charge_label !!}
							</p>
							<p class="" style="float: left; text-align: left;">
								{{$receipt_details->packing_charge}}
							</p>
						</div>
					@endif
			<!-- Discount -->
			@if( !empty($receipt_details->discount))
						<div class="flex-box" style="direction: rtl;">
							@if( !empty($receipt_details->discount_label))
							<p class="" style="float:right; text-align: right;">
								{!! $receipt_details->discount_label !!}
							</p>
							@endif
							<p class="" style="float: left; text-align: left;">
								(-) {{$receipt_details->discount}}
							</p>
						</div>
					@endif
        @if(!empty($receipt_details->reward_point_label) )
						<div class="flex-box" style="direction: rtl;">
							@if(!empty($receipt_details->reward_point_amount))
							<p class="" style="float:right; text-align: right;">
								{!! $receipt_details->reward_point_label !!}
							</p>
							@endif
							<p class="" style="float: left; text-align: left;">
								(-) {{$receipt_details->reward_point_amount}}
							</p>
						</div>
					@endif
        @if( !empty($receipt_details->tax))
						<div class="flex-box" style="direction: rtl;">
							@if( !empty($receipt_details->tax_label) )
							<p class="" style="float:right; text-align: right;">
								{!! $receipt_details->tax_label !!}
							</p>
							@endif
							<p class="" style="float: left; text-align: left;">
								(+) {{$receipt_details->tax}}
							</p>
						</div>
					@endif
        @if(!empty($receipt_details->round_off))
						@if( $receipt_details->round_off_amount > 0)
							<div class="flex-box" style="direction: rtl;">
								@if(!empty($receipt_details->round_off_label))
								<p class="" style="float:right; text-align: right;">
									{!! $receipt_details->round_off_label !!}
								</p>
								@endif
								<p class="" style="float: left; text-align: left;">
									{{$receipt_details->round_off}}
								</p>
							</div>
						@endif
					@endif
					@if(!empty($receipt_details->total_in_words))
						<p colspan="2" class="mb-0" style="text-align: left;">
							<small>
								({{$receipt_details->total_in_words}})
							</small>
						</p>
					@endif
			@if(!empty($receipt_details->payments))
				@foreach($receipt_details->payments as $payment)
					<div class="flex-box" style="direction: rtl;">
						<p class="" style="float:right; text-align: right; width: 50%;">{{$payment['method']}} ({{$payment['date']}}) </p>
						<p class="" style="float:left; text-align: left; width: 50%;">{{$payment['amount']}}</p>
					</div>
				@endforeach
			@endif
        <!-- Total Paid-->
				@if(!empty($receipt_details->total_paid))
					<div class="flex-box" style="direction: rtl;">
						<p class="" style="float:right; text-align: right; width: 50%;">
							{!! $receipt_details->total_paid_label !!}
						</p>
						<p class="" style="float:left; text-align: left; width: 50%;">
							{{$receipt_details->total_paid}}
						</p>
					</div>
				@endif

				<!-- Total Due-->
				@if(!empty($receipt_details->total_due))
					<div class="flex-box" style="direction: rtl;">
						<p class="" style="float:right; text-align: right; width: 50%;">
							{!! $receipt_details->total_due_label !!}
						</p>
						<p class="" style="float:left; text-align: left; width: 50%;">
							{{$receipt_details->total_due}}
						</p>
					</div>
				@endif

				<!--@if(!empty($receipt_details->all_due))
					<div class="flex-box" style="direction: rtl;">
						<p class="" style="float:right; text-align: right; width: 50%;">
							{!! $receipt_details->all_bal_label !!}
						</p>
						<p class="" style="float:left; text-align: left; width: 50%;">
							{{$receipt_details->all_due}}
						</p>
					</div>
				@endif-->
    <hr>
    <!-- Total-->
				@if(!empty($receipt_details->total_label))
					<div class="flex-box" style="direction: rtl;">
						<p class="" style="float:right; text-align: right; width: 50%;">
                        {{--								<strong>{!! $receipt_details->total_label !!}</strong>--}}
								<strong>{{'الاجمالي:'}}</strong>
						</p>
						<p class="" style="float:left; text-align: left; width: 50%;">
                        <strong>{{$receipt_details->total}}</strong>
						</p>
					</div>
				@endif
        @endif
        <div class="border-bottom width-100">&nbsp;</div>
           <!-- @if(empty($receipt_details->hide_price))
	            <!-- tax -->
	           <!-- @if(!empty($receipt_details->taxes))
	            	<table class="border-bottom width-100 table-f-12">
	            		@foreach($receipt_details->taxes as $key => $val)
	            			<tr>
	            				<td class="" style="text-align: right">{{$key}}</td>
	            				<td class="" style="text-align: right">{{$val}}</td>
	            			</tr>
	            		@endforeach
	            	</table>
	            @endif
            @endif-->
        @if(!empty($receipt_details->additional_notes))
	            <p class="centered" >
	            	{!! nl2br($receipt_details->additional_notes) !!}
	            </p>
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
					<br/>
                   <img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee([1,2,3,4,5],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$y]), 'QRCODE')}}" alt="barcode"/>
        
				@endif --}}

				{{--qr code 4.8v --}}
				@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
				<img style="width: 100px !important;" class="center-block" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
				@endif

			@if(!empty($receipt_details->footer_text))
				<p class="centered footerDiv">
					{!! $receipt_details->footer_text !!}
				</p>
			@endif
    </div>
</body>
</html>
<style type="text/css">
.footerDiv p{
text-align:center !important;
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
	width: 50%;
	margin-bottom: 0px;
	white-space: nowrap;
}
.table.child_table tbody tr td{
	padding: 0px;
	border: none !important;
}
hr{
margin-top: 4px !important;
margin-bottom: 4px !important;
}
.customer br{
display: none;
}
</style>