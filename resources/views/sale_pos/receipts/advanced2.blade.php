    <div class="bg-container" style="position: fixed !important; height: 100% !important; width: 100% !important; z-index: 0 !important; background-image: url('https://test.weka.sa/uploads/invoice_logos/1650100138_background.png') !important; background-size: 100% 100% !important;"></div>
    <div class="content" style="position: relative !important; z-index: 1 !important;">
    <style>
		* {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
    color-adjust: exact !important;                 /*Firefox*/
}
        body {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        background-color: transparent !important;
        }


        .bg-container {
            position: fixed !important;
            height: 100% !important;
            width: 100% !important;
            z-index: 0 !important;
            background-image: url('https://test.weka.sa/uploads/invoice_logos/1650100138_background.png') !important;
            background-size: 100% 100% !important;
        }

        .content {
        position: relative;
        z-index: 1;
        }
@media print {
* {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
    color-adjust: exact !important;                 /*Firefox*/
}
        body {
        display:block !important;
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        background-color: transparent !important;
        }


        .bg-container {
            position: fixed !important;
            height: 100% !important;
            width: 100% !important;
            z-index: 0 !important;
            background-image: url('https://test.weka.sa/uploads/invoice_logos/1650100138_background.png') !important;
            background-size: 100% 100% !important;
        }

        .content {
        position: relative !important;
        z-index: 1 !important;
        }
}
@page {
    background: url('https://test.weka.sa/uploads/invoice_logos/1650100138_background.png') no-repeat 0 0 !important;
    background-image-resize: 6;
}
    </style>
        <table style="width:100%;position: relative !important;  direction:rtl !important; background-color: transparent !important;" class="table_pos" id="table_pos">
        <thead style="margin: 0px !important; padding: 0px !important; position: relative !important; background-color: transparent !important;">
        <tr style="margin: 0px !important; padding: 0px !important">
            <td style="width:33.3%; position: relative !important; background-color: transparent !important;"></td>
            <td style="width:33.3%; position: relative !important; padding-top: 70px; background-color: transparent !important;">
                @php
                    if (!empty($receipt_details)){
                        if (!empty($receipt_details->sub_heading_line1) && !empty($receipt_details->sub_heading_line2) && !empty($receipt_details->sub_heading_line3) && !empty($receipt_details->sub_heading_line4) && !empty($receipt_details->sub_heading_line5) ){
                           $sub_headings = implode('<br/>', array_filter([$receipt_details->sub_heading_line1, $receipt_details->sub_heading_line2, $receipt_details->sub_heading_line3, $receipt_details->sub_heading_line4, $receipt_details->sub_heading_line5]));
                        }
                        if (!empty($receipt_details->invoice_heading)){
                        $heading = explode(" ",$receipt_details->invoice_heading);
                        }
                    }
                @endphp
                @if(!empty($receipt_details->transaction_type))
                    @if($receipt_details->transaction_type == 'sell_return')
                        <h5 class="text-center" style="font-weight: bold; font-size: 18px !important; color:#007665 !important;">{{'فاتورة مرتجعة'}}</h5>
                    @endif
                @endif
                @if($receipt_details->transaction_type == 'sell')
                    @if(!empty($receipt_details->invoice_heading))
                        <p class="text-center" style="font-weight: bold; font-size: 18px !important; color:#007665 !important;">
                            {!! $heading[0] !!}
                            @if(!empty($heading[1]))
                                {!! $heading[1] !!}
                            @endif
                            @if(!empty($heading[2]))
                                {!! $heading[2] !!}
                            @endif
                            <br/>
                            @if(!empty($heading[3]))
                                {!! $heading[3] !!}
                            @endif
                            <br/>

                            @if(!empty($heading[4]))
                                {!! $heading[4] !!}
                            @endif

                        </p>
                    @endif
                @endif
            </td>
            <td style="width:33.3%; position: relative !important; padding-top: 5px; background-color: transparent !important;">

                <p style="text-align: right;">
                    @if(!empty($receipt_details->invoice_no_prefix))
                        <strong>{!! $receipt_details->invoice_no_prefix !!}</strong>
                        {{$receipt_details->invoice_no}}
                    @endif
                </p>
                <!-- Date-->

                <p style="text-align: right">
                    @if(!empty($receipt_details->date_label))
                        {{$receipt_details->date_label}}

                    @endif
                    {{$receipt_details->invoice_date}}
                </p>

                @if(!empty($receipt_details->due_date_label))
                    <p style="text-align: right">
                        {{$receipt_details->due_date_label}}
                        {{$receipt_details->due_date . ''}}
                    </p>
                @endif
            <!-- customer info -->

                @if(!empty($receipt_details->customer_label))
                    <p><b>{{ $receipt_details->customer_label }}</b>
                        @endif
                        @if(!empty($receipt_details->customer_info))
                            <strong>{!! $receipt_details->customer_info !!}</strong></p>
                @endif
                @if(!empty($receipt_details->client_id_label))
                    <p><strong>{{ $receipt_details->client_id_label }}</strong> {{ $receipt_details->client_id }}</p>
                @endif
                @if(!empty($receipt_details->customer_tax_number))
                    <p><strong>الرقم الضريبي: </strong> {{ $receipt_details->customer_tax_number }}</p>
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
            </td>
        </tr>
        </thead>
        <tbody style="background-color: transparent !important; position: relative !important;">
        <tr>
            <td colspan="3">
                <div class="row">
                    @includeIf('sale_pos.receipts.partial.common_repair_invoice')
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
                        <table style="background-color: transparent !important;" class="table table-bordered">
                            <thead id="tbl1" style="color:#ffffff !important; background-color: #007665 !important;">
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
                                <tr style="">
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
                                        @if(!empty($line['product_description']))<small style="font-wight: lighter !important;"> {!! $line['product_description'] !!} </small> @endif
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
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row invoice-info text-right" style="page-break-inside: avoid !important">


                    <div class="col-md-12 invoice-col width-100">
                        <table style="background-color: transparent !important;" class="table table-bordered">
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
                            <tbody style="">
                            <tr style="">
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
                                <tr style="">
                                    <td colspan="2" class="text-right">
                                        <small>({{$receipt_details->total_in_words}})</small>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="col-md-12 invoice-col width-100">
                            <table style="background-color: transparent !important;" class="table">
                                <tbody>
                                <!-- Total -->
                                @if( !empty($receipt_details->total_label) || !empty($receipt_details->total) )
                                    <tr>
                                        <th style="text-align:right">
                                            {{--											{!! $receipt_details->total_label !!}--}}
                                            {{'الاجمالي:'}}
                                        </th>
                                        <td style="text-align:left">
                                            {{$receipt_details->total}}
                                        </td>
                                    </tr>
                                @endif
                                <!-- Total-Paid -->
                                @if( !empty($receipt_details->total_paid_label) )
                                    <tr>
                                        <th style="text-align:right">
                                            {{--											{!! $receipt_details->total_paid_label !!}--}}
                                            {{'الاجمالي المدفوع:'}}
                                        </th>
                                        <td style="text-align:left">
                                            {{$receipt_details->total_paid}}
                                        </td>
                                    </tr>
                                @endif
                                <!-- Total_due -->
                                @if( !empty($receipt_details->total_due_label) )
                                    <tr>
                                        <th style="text-align:right">
                                            {{--											{!! $receipt_details->total_due_label !!}--}}
                                            {{'الاجمالي المستحق:'}}
                                        </th>
                                        <td style="text-align:left">
                                            {{$receipt_details->total_due}}
                                        </td>
                                    </tr>
                                @endif
                                @if(!empty($receipt_details->transaction_type))
                                    @if($receipt_details->transaction_type == 'sell_return')
                                        @if( !empty($receipt_details->total) )
                                            <tr>
                                                <th style="text-align:right">
                                                    {{'المرتجعات:'}}
                                                </th>
                                                <td style="text-align:left">
                                                    {{$receipt_details->total}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 invoice-col" style="width:100% !important">
                        <table class="table table-slim table-bordered" style="direction: rtl;text-align: right; background: #00766521 !important; width:100% !important">
                            @if(!empty($receipt_details->payments))
                                @foreach($receipt_details->payments as $payment)
                                    <tr style="width:100% !important">
                                        <td style="padding-right: 20px; background: #00766521 !important;width:33.3% !important">{{$payment['method']}}</td>
                                        <td style="padding-right: 20px; background: #00766521 !important;width:33.3% !important">{{$payment['amount']}}</td>
                                        <td style="padding-right: 20px; background: #00766521 !important;width:33.3% !important">{{$payment['date']}}</td>
                                    </tr>

                                @endforeach
                            @endif
                        </table>
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

                    

        </tbody>
        <tfoot style="position: relative !important; background-color: transparent !important; bottom:0">
        <tr>
            <td style="position: relative !important; background-color: transparent !important;">
                @if(!empty($receipt_details->footer_text))
                    {!! $receipt_details->footer_text !!}
                @endif
            </td>
            <td style="position: relative !important; background-color: transparent !important;">
                @php
                    $a = 0;
                    $y = 0;
                    if (!empty($receipt_details) && !empty($receipt_details->tax1)){
                        $a = floatval(implode(explode(',',$receipt_details->tax1))) ;
                        if(!empty($total_row_tax)){
                         $y= $a + $total_row_tax;
                        }
                        }
                        // $y= (float)$y;

                @endphp
                {{-- 	{{$a.'  '}}
        {{ $total_row_tax }} --}}


                {{--old qr code 4.2v --}}
                {{-- @if($receipt_details->show_barcode)
                    <img class="" style="width: 100px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee(['01','02','03','04','05'],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$y]), 'QRCODE')}}" alt="barcode"/>
                @endif --}}

                {{--qr code 4.8v --}}
                @if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
                <img style="width: 100px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
                @endif
            </td>
            <td style="position: relative !important; background-color: transparent !important;"><span>
	@lang('lang_v1.authorized_signatory')
	</span>
            </td>
        </tr>

        </tfoot>
    </table>

    </div>
                <script>
                var imgs = document.images;
                console.log(imgs.length);
                $( document ).ready(function(){
                var imgs = document.images;
                console.log(imgs.length);
                });
                </script>