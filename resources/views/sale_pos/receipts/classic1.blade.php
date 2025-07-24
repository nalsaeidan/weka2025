<!-- business information here -->

<div class="row">

	<!-- Logo -->
	@if(!empty($receipt_details->logo))
		<img style="max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img img-responsive center-block">
	@endif
	<!-- Header text -->
	@if(!empty($receipt_details->header_text))
		<div class="col-xs-12" style="direction:rtl">
        {{$receipt_details->header_text}}
		</div>
	@endif

	<!-- business information here -->
	<div class="col-xs-12 text-center" style="direction:rtl">
		<h2 style="color:#486c20 !important; font-family:'Droid Arabic Kufi', serif" class="text-center">
			<!-- Shop & Location Name  -->
			@if(!empty($receipt_details->display_name))
				{{$receipt_details->display_name}}
			@endif
		</h2>

		<!-- Address -->
		<p style="direction:rtl; font-family:'Droid Arabic Kufi', serif">
		@if(!empty($receipt_details->address))
				<small class="text-center" style="direction:rtl;color:#486c20 !important">
		{!! $receipt_details->address !!}
				</small>
		@endif
        <!-- Title of receipt -->
		@if(!empty($receipt_details->invoice_heading))
			<br/><span style="font-weight:bold !important; font-size: 24 !important; font-family:'Droid Arabic Kufi', serif; color: #fce196 !important" class="text-center">
				{!! $receipt_details->invoice_heading !!}
			</span>
		@endif
    </p>
    @if(!empty($receipt_details->contact))website
			<br/>{!! $receipt_details->contact !!}
		@endif
<!-- 		@if(!empty($receipt_details->contact) && !empty($receipt_details->website))
			<br/>{!! $receipt_details->contact !!} 
		@endif -->
	<p>	
    @if(!empty($receipt_details->website))
    
			<br/><b>الموقع: </b>{{ $receipt_details->website }}
		@endif
    </p>
    <p>
		@if(!empty($receipt_details->location_custom_fields))
			<br>{{ $receipt_details->location_custom_fields }}
		@endif
    </p>
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
		<p>
		@if(!empty($receipt_details->tax_info1))
        <b>{{ $receipt_details->tax_label1 }}</b> <br> <span style="color:#444741 !important">{{ $receipt_details->tax_info1 }}</span>
		@endif
		@if(!empty($receipt_details->tax_info2))
			<b>{{ $receipt_details->tax_label2 }}</b> <br><span style="color:#444741 !important">{{ $receipt_details->tax_info2 }}</span>
		@endif
		</p>
     <hr style="color:#f33a24 !important">
    <p style="direction:rtl; font-family:'Droid Arabic Kufi', serif">
    	<span style="font-weight:bold !important; font-size: 24 !important;color:#034d99 !important; font-family:'Droid Arabic Kufi', serif"><u style="color:#034d99 !important">@lang("invoice.invoice_to")</u></span>
		
        <span class="col-md-12 c0l-xs-12 col-sm-12 text-center" >
        <!-- customer info -->
				@if(!empty($receipt_details->customer_info))
			
				{!! $receipt_details->customer_info !!} <br>
				@endif
				@if(!empty($receipt_details->client_id_label))
					<b>{{ $receipt_details->client_id_label }}</b> {{ $receipt_details->client_id }}<br/>
				@endif
				@if(!empty($receipt_details->customer_tax_label))
					<b>{{ $receipt_details->customer_tax_label }}</b> {{ $receipt_details->customer_tax_number }}<br/>
				@endif
				@if(!empty($receipt_details->customer_custom_fields))
					{!! $receipt_details->customer_custom_fields !!}
				@endif
				@if(!empty($receipt_details->sales_person_label))
					
					<b>{{ $receipt_details->sales_person_label }}</b> {{ $receipt_details->sales_person }}<br/>
				@endif
				@if(!empty($receipt_details->customer_rp_label))
					
					<strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}<br/>
				@endif
        </span>
    </p>
	<hr style="color:#f33a24 !important">
		

		<!-- Invoice  number, Date  -->
		<p style="width: 100% !important; direction:rtl" class="word-wrap">
			<span class="pull-right text-center word-wrap" style="width:50%">
				@if(!empty($receipt_details->invoice_no_prefix))
					<b>{!! $receipt_details->invoice_no_prefix !!}</b>
				@endif
            
            @if(!empty($receipt_details->total_due))
			<br><b>{!! $receipt_details->total_due_label !!}
				</b>
            {{$receipt_details->total_due}}
            @endif
        </span>
				@if(!empty($receipt_details->types_of_service))
					<br/>
					<span class="pull-right text-center" style="width:50%">
						<strong>{!! $receipt_details->types_of_service_label !!}:</strong>
						{{$receipt_details->types_of_service}}
						<!-- Waiter info -->
						@if(!empty($receipt_details->types_of_service_custom_fields))
							@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
								<br><strong>{{$key}}: </strong> {{$value}}
							@endforeach
						@endif
					</span>
				@endif
        
<!-- Table information-->
        <span class="col-md-6 c0l-xs-6 col-sm-6 text-center" style="width:50%">
				<b>{{$receipt_details->date_label}}</b>{{$receipt_details->invoice_date}}

				@if(!empty($receipt_details->due_date_label))
				<br><b>{{$receipt_details->due_date_label}}</b> {{$receipt_details->due_date ?? ''}}
				@endif

				@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
					<br>
					@if(!empty($receipt_details->brand_label))
						<b>{!! $receipt_details->brand_label !!}</b>
					@endif
					{{$receipt_details->repair_brand}}
		        @endif


		        @if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
					<br>
					@if(!empty($receipt_details->device_label))
						<b>{!! $receipt_details->device_label !!}</b>
					@endif
					{{$receipt_details->repair_device}}
		        @endif

				@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
					<br>
					@if(!empty($receipt_details->model_no_label))
						<b>{!! $receipt_details->model_no_label !!}</b>
					@endif
					{{$receipt_details->repair_model_no}}
		        @endif

				@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
					<br>
					@if(!empty($receipt_details->serial_no_label))
						<b>{!! $receipt_details->serial_no_label !!}</b>
					@endif
					{{$receipt_details->repair_serial_no}}<br>
		        @endif
				@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
					@if(!empty($receipt_details->repair_status_label))
						<b>{!! $receipt_details->repair_status_label !!}</b>
					@endif
					{{$receipt_details->repair_status}}<br>
		        @endif
		        
		        @if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
					@if(!empty($receipt_details->repair_warranty_label))
						<b>{!! $receipt_details->repair_warranty_label !!}</b>
					@endif
					{{$receipt_details->repair_warranty}}
					<br>
		        @endif
		        
				<!-- Waiter info -->
				@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
		        	<br/>
					@if(!empty($receipt_details->service_staff_label))
						<b>{!! $receipt_details->service_staff_label !!}</b>
					@endif
					{{$receipt_details->service_staff}}
		        @endif
		        @if(!empty($receipt_details->shipping_custom_field_1_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_2_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_3_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_3_label!!}:</strong> {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_4_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_5_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
				@endif
				{{-- sale order --}}
				@if(!empty($receipt_details->sale_orders_invoice_no))
					<br>
					<strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no ?? ''!!}
				@endif

				@if(!empty($receipt_details->sale_orders_invoice_date))
					<br>
					<strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date ?? ''!!}
				@endif
            
			</span>
        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
		        	
			<span class="col-md-6 c0l-xs-6 col-sm-6 text-center" style="width:50%">
						@if(!empty($receipt_details->table_label))
							<b>{!! $receipt_details->table_label !!}</b>
						@endif
						{{$receipt_details->table}}

						<!-- Waiter info -->
					</span>
		        @endif
    </p>
   
	</div>
</div>
<div class="row">
    @includeIf('sale_pos.receipts.partial.common_repair_invoice')
</div>

<div class="row">
    <div class="col-xs-12">
        <br/>
        @php
        $p_width = 40;
        @endphp
        @if(!empty($receipt_details->item_discount_label))
        @php
        $p_width -= 15;
        @endphp
        @endif
        <table class="table table-responsive table-slim" style="direction:rtl">
            <thead>
            <tr>
                <th width="{{$p_width}}%" style="text-align: right !important; color:#034d99 !important">{{$receipt_details->table_product_label}}</th>
                <th width="15%" style="text-align: right !important; color:#034d99 !important">{{$receipt_details->table_qty_label}}</th>
                <th width="15%" style="text-align: right !important; color:#034d99 !important">{{$receipt_details->table_unit_price_label}}</th>
                @if(!empty($receipt_details->item_discount_label))
                <th width="15%" style="text-align: right !important; color:#034d99 !important">{{$receipt_details->item_discount_label}}</th>
                @endif
                <th width="15%" style="text-align: right !important; color:#034d99 !important">{{$receipt_details->table_subtotal_label}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($receipt_details->lines as $line)
            <tr>
                <td style="text-align: right !important;">
                    @if(!empty($line['image']))
                    <img src="{{$line['image']}}" alt="Image" width="50" style="float: left; margin-right: 8px;">
                    @endif
                    {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}}
                    @if(!empty($line['sub_sku'])), {{$line['sub_sku']}} @endif @if(!empty($line['brand'])), {{$line['brand']}} @endif @if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
                    @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                    @if(!empty($line['sell_line_note']))
                    <br>
                    <small>
                        {{$line['sell_line_note']}}
                    </small>
                    @endif
                    @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}:  {{$line['lot_number']}} @endif
                    @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}:  {{$line['product_expiry']}} @endif

                    @if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
                    @if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] ?? ''}}</small>@endif
                </td>
                <td style="text-align: right !important;">{{$line['quantity']}} {{$line['units']}} </td>
                <td style="text-align: right !important;">{{$line['unit_price_before_discount']}}</td>
                @if(!empty($receipt_details->item_discount_label))
                <td style="text-align: right !important;">
                    {{$line['line_discount'] ?? '0.00'}}
                </td>
                @endif
                <td style="text-align: right !important;">{{$line['line_total']}}</td>
            </tr>
            @if(!empty($line['modifiers']))
            @foreach($line['modifiers'] as $modifier)
            <tr>
                <td>
                    {{$modifier['name']}} {{$modifier['variation']}}
                    @if(!empty($modifier['sub_sku'])), {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
                    @if(!empty($modifier['sell_line_note']))({{$modifier['sell_line_note']}}) @endif
                </td>
                <td class="text-center">{{$modifier['quantity']}} {{$modifier['units']}} </td>
                <td class="text-center">{{$modifier['unit_price_inc_tax']}}</td>
                @if(!empty($receipt_details->item_discount_label))
                <td class="text-center">0.00</td>
                @endif
                <td class="text-center">{{$modifier['line_total']}}</td>
            </tr>
            @endforeach
            @endif
            @empty
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>



<div class="row">
    <div class="col-md-12"><hr/></div>
    <div class="col-xs-6" style="float:left !important;">

        <table class="table table-slim" style="direction:rtl !important;">
        <thead></thead>
        <tbody>
            <!--@if(!empty($receipt_details->payments))
            @foreach($receipt_details->payments as $payment)
            <tr>
                <th>{{$payment['method']}}</th>
                <td style="direction:rtl" class="text-right" >{{$payment['amount']}}</td>
            </tr>
            @endforeach
            @endif-->
            @if(!empty($receipt_details->total_quantity_label))
            <tr class="color-555">
                <th style="width:70%">
                    {!! $receipt_details->total_quantity_label !!}
                </th>
                <td style="text-align:left !important;">
                    {{$receipt_details->total_quantity}}
                </td>
            </tr>
            @endif
        <tr>
                <th style="width:70%">
                    {!! $receipt_details->subtotal_label !!}
                </th>
                <td style="text-align:left !important;">
                    {{$receipt_details->subtotal}}
                </td>
            </tr>
        @if( !empty($receipt_details->tax) )
        <tr>
        <th style="width:70%">{!! $receipt_details->tax_label !!}</th>
        <td style="text-align:left !important;">(+) {{$receipt_details->tax}}</td>
        </tr>
        @endif
            <!-- Total-->
            @if(!empty($receipt_details->total))
            <tr>
                <th>
                    @lang('lang_v1.total_label')
                </th>
                <td style="text-align:left !important;">
                    {{$receipt_details->total}}
                </td>
            </tr>
            @endif
            <!-- Total Paid-->
            @if(!empty($receipt_details->total_paid))
            <tr>
                <th>
                    {!! $receipt_details->total_paid_label !!}
                </th>
                <td style="text-align:left !important;">
                    {{$receipt_details->total_paid}}
                </td>
            </tr>
            @endif
            <!-- Total Due-->
            @if(!empty($receipt_details->total_due))
            <tr>
                <th>
                    {!! $receipt_details->total_due_label !!}
                </th>
                <td style="text-align:left !important;">
                    {{$receipt_details->total_due}}
                </td>
            </tr>
            @endif
        @if(!empty($receipt_details->payments))
				@foreach($receipt_details->payments as $payment)
            <tr>
                <th>@lang("lang_v1.date")</th>
                <td style="text-align:left !important;">{{$payment['date']}}</td>
            </tr>
@endforeach
        @endif

            @if(!empty($receipt_details->all_due))
            <tr>
                <th>
                    {!! $receipt_details->all_bal_label !!}
                </th>
                <td style="text-align:left !important;">
                    {{$receipt_details->all_due}}
                </td>
            </tr>
            @endif
           
            
            @if(!empty($receipt_details->total_exempt_uf))
            <tr>
                <th style="width:70%">
                    @lang('lang_v1.exempt')
                </th>
                <td style="text-align:left !important;">
                    {{$receipt_details->total_exempt}}
                </td>
            </tr>
            @endif
        </tbody>
        </table>
    </div>
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-slim">
                <thead>
                @if(!empty($receipt_details->shipping_charges))
                <th>{!! $receipt_details->shipping_charges_label !!}</th>
                @endif
                @if(!empty($receipt_details->packing_charge))
                <th>{!! $receipt_details->packing_charge_label !!}</th>
                @endif
                @if( !empty($receipt_details->discount) )
                <th>{!! $receipt_details->discount_label !!}</th>
                @endif
                @if( !empty($receipt_details->reward_point_label) )
                <th>{!! $receipt_details->reward_point_label !!}</th>
                @endif
                @if( !empty($receipt_details->tax) )
                <th>{!! $receipt_details->tax_label !!}</th>
                @endif
                @if( $receipt_details->round_off_amount > 0)
                <th>{!! $receipt_details->round_off_label !!}</th>
                @endif
                <th>@lang('lang_v1.total_label')</th>
                </thead>
                <tbody>
                <tr>
                    <!-- Shipping Charges -->
                    @if(!empty($receipt_details->shipping_charges))
                    <td>{{$receipt_details->shipping_charges}}</td>

                    @endif

                    @if(!empty($receipt_details->packing_charge))
                    <td>{{$receipt_details->packing_charge}}</td>
                    @endif

                    <!-- Discount -->
                    @if( !empty($receipt_details->discount) )
                    <td>(-) {{$receipt_details->discount}}</td>
                    @endif

                    @if( !empty($receipt_details->reward_point_label) )
                    <td>(-) {{$receipt_details->reward_point_amount}}</td>
                    @endif

                    <!-- Tax -->
                    @if( !empty($receipt_details->tax) )
                    <td>(+) {{$receipt_details->tax}}</td>
                    @endif

                    @if( $receipt_details->round_off_amount > 0)
                    <td>{{$receipt_details->round_off}}</td>
                    @endif

                    <!-- Total -->
                    <td>
                        {{$receipt_details->total}}
                        @if(!empty($receipt_details->total_in_words))
                        <br>
                        <small>({{$receipt_details->total_in_words}})</small>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-xs-12">
        <p>{!! nl2br($receipt_details->additional_notes) !!}</p>
    </div>
</div>
@if($receipt_details->show_barcode)
<div class="row">

<div class=" mt-5 col-xs-12" align="center" style="text-align:left !important" style="background:#b3bcc4 !important">
        <!--<span class="mt-5" style="padding:5px !important ; background:#b3bcc4 !important"> scan Qr code to view your invoice and make your payments</span>
        -->
                        		<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee([1,2,3,4,5],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$receipt_details->tax1]), 'QRCODE')}}" alt="barcode"/>


<!-- 					
						@if(empty($receipt_details->display_name)&&empty($receipt_details->tax_info1)&&empty($receipt_details->tax))
                		<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.' 
                                                              '.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
                                                              '.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
 -->
<!-- 					@elseif(empty($receipt_details->display_name)&&empty($receipt_details->tax_info1))

                		<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.' 
                                                              '.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
															  '.'الضريبة ='.$receipt_details->tax.'
                                                              '.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/> -->
															  
<!-- 				    @elseif(empty($receipt_details->display_name)&&empty($receipt_details->tax))

						<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG('رقم الفاتورة ='.$receipt_details->invoice_no.'
															    '.'الرقم الضريبي ='. $receipt_details->tax_info1.'  
																'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
																'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
 -->
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
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/> -->

<!-- 					@elseif(empty($receipt_details->tax_info1))
					<img class="center-block" style="width:100px !important" src="data:image/png;base64,{{DNS2D::getBarcodePNG(
														'اسم المنشأة ='.$receipt_details->display_name.' 
														'.'رقم الفاتورة ='.$receipt_details->invoice_no.'
														'.'الضريبة ='.$receipt_details->tax.' 
														'.'الوقت والتاريخ ='.$receipt_details->invoice_date.'
														'.'المجموع ='. $receipt_details->total, 'QRCODE')}}" alt="barcode"/>
					
					
					@elseif(empty($receipt_details->display_name))
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

    </div>
</div>
@endif
@if(!empty($receipt_details->footer_text))
<div class="row" style="; text-align: center !important">
    <div class="col-xs-12" style="; text-align: center !important">
        {!! $receipt_details->footer_text !!}
    </div>
</div>
@endif 