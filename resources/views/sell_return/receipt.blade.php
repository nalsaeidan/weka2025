<br/>
<table style="width:100%;">
	<thead>
		<tr>
			<td><br/>
				<table style="width:100%;">
					<thead>
						<tr>
							<td>
				
							@if(!empty($receipt_details->invoice_heading))
								<p class="text-right text-muted-imp" style="font-weight: bold; font-size: 18px !important">{!! $receipt_details->invoice_heading !!}</p>
							@endif
				
							<p class="text-right">
								@if(!empty($receipt_details->invoice_no_prefix))
									{!! $receipt_details->invoice_no_prefix !!}
								@endif
				
								{{$receipt_details->invoice_no}}
							</p>
				
							</td>
						</tr>
					</thead>
				
					<tbody>
						<tr>
							<td>
				
				@if(!empty($receipt_details->header_text))
					<div class="row invoice-info">
						<div class="col-xs-12">
							{!! $receipt_details->header_text !!}
						</div>
					</div>
				@endif
				
				<!-- business information here -->
                 <div class="row invoice-info">

	<div class="col-md-6 invoice-col width-50" style="margin-top:50px !important">

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
			<img style="margin-top: -100px; max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img">
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
		<!--	@if(!empty($receipt_details->customer_label))
				<b>{{ $receipt_details->customer_label }}</b><br/>
			@endif -->

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
					<div class="col-md-6 invoice-col width-50 word-wrap">
						<p>
							@if(!empty($receipt_details->sub_heading_line1))
								{{ $receipt_details->sub_heading_line1 }}
							@endif
							@if(!empty($receipt_details->sub_heading_line2))
								<br>{{ $receipt_details->sub_heading_line2 }}
							@endif
							@if(!empty($receipt_details->sub_heading_line3))
								<br>{{ $receipt_details->sub_heading_line3 }}
							@endif
							@if(!empty($receipt_details->sub_heading_line4))
								<br>{{ $receipt_details->sub_heading_line4 }}
							@endif
							@if(!empty($receipt_details->sub_heading_line5))
								<br>{{ $receipt_details->sub_heading_line5 }}
							@endif
						</p>
					</div>
				
				<div class="row color-555">
					<div class="col-xs-12">
						<br/>
						<table class="table">
							<thead class="thead-dark">
								<tr>
									<th>#</th>
									@php
										$p_width = 35;
									@endphp
									@if($receipt_details->show_cat_code != 1)
										@php
											$p_width = 45;
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
									<th>
										{{$receipt_details->table_subtotal_label}}
									</th>
								</tr>
							</thead>
							<tbody>
								@foreach($receipt_details->lines as $line)
									<tr>
										<td>
											{{$loop->iteration}}
										</td>
										<td>
											{{$line['name']}} {{$line['variation']}}
											@if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif
											@if(!empty($line['sell_line_note']))({{$line['sell_line_note']}}) @endif
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
											{{$line['unit_price_exc_tax']}}
										</td>
										<td>
											{{$line['line_total']}}
										</td>
									</tr>
								@endforeach
				
								@php
									$lines = count($receipt_details->lines);
								@endphp
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
				
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="row invoice-info" style="page-break-inside: avoid !important">
					<div class="col-md-6 invoice-col width-50">
						<table class="table-no-side-cell-border table-no-top-cell-border width-100">
							<tbody>
								<tr>
									<td>
										{!! $receipt_details->subtotal_label !!}
									</td>
									<td class="text-right">
										{{$receipt_details->subtotal}}
									</td>
								</tr>
				
								<!-- Tax -->
								@if(!empty($receipt_details->taxes))
									@foreach($receipt_details->taxes as $k => $v)
										<tr>
											<td>{{$k}}</td>
											<td class="text-right">{{$v}}</td>
										</tr>
									@endforeach
								@endif
				
								<!-- Discount -->
								@if( !empty($receipt_details->discount) )
									<tr>
										<td>
											{!! $receipt_details->discount_label !!}
										</td>
				
										<td class="text-right">
											(-) {{$receipt_details->discount}}
										</td>
									</tr>
								@endif
				
								@if(!empty($receipt_details->group_tax_details))
									@foreach($receipt_details->group_tax_details as $key => $value)
										<tr>
											<td>
												{!! $key !!}
											</td>
											<td class="text-right">
												(+) {{$value}}
											</td>
										</tr>
									@endforeach
								@else
									@if( !empty($receipt_details->tax) )
										<tr>
											<td>
												{!! $receipt_details->tax_label !!}
											</td>
											<td class="text-right">
												(+) {{$receipt_details->tax}}
											</td>
										</tr>
                            <tr>
											<td>
												{!! $receipt_details->total_label !!}
											</td>
											<td class="text-right">
												{{$receipt_details->total}}
											</td>
										</tr>
									@endif
								@endif
				
								<!-- Total -->
								
							</tbody>
						</table>
					</div>
				</div>
                            <div class="row invoice-info">
                	<div class="invoice-col pull-left" style="padding:15px !important">
						<b class="p-5">@lang('lang_v1.authorized_signatory')</b>
					</div>
                            </div>
				<div class="row color-555">
					<div class="col-xs-6">
						{{$receipt_details->additional_notes}}
					</div>
				
				
				</div>
				@if($receipt_details->show_barcode)
<div class="row">

<div class=" mt-5 col-xs-12" align="left" style="text-align:left !important" style="background:#b3bcc4 !important">
        <!--<span class="mt-5" style="padding:5px !important ; background:#b3bcc4 !important"> scan Qr code to view your invoice and make your payments</span>
        -->@if(empty($receipt_details->tax_label1)&&empty($receipt_details->tax_info1)&&empty($receipt_details->tax))
                		<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.' 
                                                              '.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
                                                              '.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>

					@elseif(empty($receipt_details->tax_label1)&&empty($receipt_details->tax_info1))

                		<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.' 
                                                              '.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
															  '.'الضريبة ='.$receipt_details->tax.'
                                                              '.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
															  
				    @elseif(empty($receipt_details->tax_label1)&&empty($receipt_details->tax))

						<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.'
															    '.'الرقم الضريبي ='. $receipt_details->tax_info1.'  
																'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
																'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>

					@elseif(empty($receipt_details->tax)&&empty($receipt_details->tax_info1))

					<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->tax_label1.' 
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>


	
					@elseif(empty($receipt_details->tax))
					<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->tax_label1.'
														'.'الرقم الضريبي ='. $receipt_details->tax_info1.'   
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>

					@elseif(empty($receipt_details->tax_info1))
					<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->tax_label1.' 
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.'
														'.'الضريبة ='.$receipt_details->tax.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
					
					
					@elseif(empty($receipt_details->tax_label1))
					<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'الرقم الضريبي ='. $receipt_details->tax_info1.'   
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.'
														'.'الضريبة ='.$receipt_details->tax.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>

					@else
					<img class="text-left" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->tax_label1.' 
														'.'الرقم الضريبي ='. $receipt_details->tax_info1.'   
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.'
														'.'الضريبة ='.$receipt_details->tax.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
					@endif

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