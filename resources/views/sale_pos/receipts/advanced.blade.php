<style>
    body{
        -webkit-print-color-adjust:exact;
    }
    h4#title {
        font-weight: lighter;
        font-size: 12px;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        background-color: transparent !important;
    }
    .icons{
        float:right;
        width: 10%;
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
        width:90%;
        padding: 7px 9px;
    }
    @media(max-width: 991px){
        .right-invoice-info{
            /*margin-top: -100px;*/
        }
    }
    .div_pos < div#invoice_content < .col-md-8.col-md-offset-2.col-sm-12{
                                         position: relative !important;
                                         height: 100% !important;
                                     }
    .demo-bg, #demo-new, #demo-new-2, #demo-new-3,#demo-new-4,#demo-new-5,#demo-new-6,#demo-new-7,#demo-new-8,#demo-new-9,#demo-new-10{

        display: block !important;
        position: absolute !important;
        left: 0;
        top:0;
        bottom: 0;
        width: 100%;
        height: 100vh

    }

    // .table.table-bordered thead{
       // 	background-color: #007665 !important;
       // }
    @media print{
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
            background-color: transparent !important;
        }
    }
    @page {
        size: letter;
    }
</style>
<div id="div_pos" class="div_pos">
<style>
        @media print {
            body{
                -webkit-print-color-adjust:exact;
            }

            .div_pos{
                background-color: transparent !important;
                min-height: 100vh !important;
                position: relative !important;
            }

        }
    </style>
@if(!empty($receipt_details->logo))
<img id="demo-bg" class="demo-bg" src="{{asset($receipt_details->logo)}}">
@endif
<table style="width:100%;  direction:rtl !important; background-color: transparent !important;" class="table_pos" id="table_pos">
<thead style="margin: 0px !important; padding: 0px !important">
<tr style="margin: 0px !important; padding: 0px !important">
<td style="width:23.3%"></td>
<td style="width:43.3%; position: relative !important; padding-top: 70px">
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
<td style="width:33.3%; position: relative !important; padding-top: 5px">
<p style="text-align: right;">
@if(!empty($receipt_details->invoice_no_prefix))
<strong>{!! $receipt_details->invoice_no_prefix !!}</strong>
{{$receipt_details->invoice_no}}
@endif
</p>

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
<tfoot style="position: relative !important; margin-bottom: 100px !important; background-color: transparent !important;">
<tr>
<td style="width:30%; position: relative !important; background-color: transparent !important;">
@if(!empty($receipt_details->footer_text))
{!! $receipt_details->footer_text !!}
@endif
</td>
<td style="width:40%;text-align: center; position: relative !important; background-color: transparent !important;">
{{-- @php
$a = 0;
$y = 0;
if (!empty($receipt_details) && !empty($receipt_details->tax1)){
$a = floatval(implode(explode(',',$receipt_details->tax1))) ;
if(!empty($total_row_tax)){
$y= $a + $total_row_tax;
 }
}
@endphp --}}
{{-- {{$a.' '}}
{{ $total_row_tax }} --}}
{{--
كيو ار القديم 
@if($receipt_details->show_barcode)
<img class="" style="width: 100px;" src="data:image/png;base64,{{DNS2D::getBarcodePNG(qrcodee(['01','02','03','04','05'],[$receipt_details->display_name,$receipt_details->tax_info1,$receipt_details->invoice_date,$receipt_details->total1,$y]), 'QRCODE')}}" alt="barcode"/>
@endif
نهاية الكيو ار القديم
--}}

{{-- qr code 4.8v --}}
@if($receipt_details->show_barcode || $receipt_details->show_qr_code)
<div class="@if(!empty($receipt_details->footer_text)) col-xs-4 @else col-xs-12 @endif text-center">

@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
<img style="width: 100px;" class="center-block mt-5" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
@endif
</div>
@endif

{{-- endd qr code 4.8v --}}

</td>
<td style="width:30%;text-align: center; position: relative !important; background-color: transparent !important;"><span>
@lang('lang_v1.authorized_signatory')
</span>
</td>
</tr>
<tbody>
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
{{-- @if($receipt_details->show_cat_code == 1)--}}
{{-- <th style="text-align: right">{{$receipt_details->cat_code_label}}</th>--}}
{{-- @endif --}}
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
{{-- {{$receipt_details->table_unit_price_label}} --}}
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
@if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}: {{$line['lot_number']}} @endif
@if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}: {{$line['product_expiry']}} @endif
@if(!empty($line['warranty_name'])) <br><small>{{$line['warranty_name']}} </small>@endif @if(!empty($line['warranty_exp_date'])) <small>- {{@format_date($line['warranty_exp_date'])}} </small>@endif
@if(!empty($line['warranty_description'])) <small> {{$line['warranty_description'] . ''}}</small>@endif
@if(!empty($line['product_description']))<small style="font-wight: lighter !important;"> {!! $line['product_description'] !!} </small> @endif
</td>
{{-- @if($receipt_details->show_cat_code == 1)--}}
 {{-- <td>--}}
{{--@if(!empty($line['cat_code']))--}}
{{-- {{$line['cat_code']}}--}}
{{-- @endif--}}
{{-- </td>--}}
{{-- @endif--}}
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
{{-- @if(!empty($receipt_details->table_unit_price_label))--}}
@php
if(!empty($line['unit_price_inc_tax'])){
$line['unit_price_inc_tax'] = $line['unit_price_inc_tax'];}
@endphp
<td>
{{$line['unit_price_inc_tax']}}
</td>
@endif
{{-- @endif--}}
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
{{-- {{$line['tax_name']}}--}}
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

@if( !empty($receipt_details->total_label) || !empty($receipt_details->total) )
<tr>
<th style="text-align:right">
{{-- {!! $receipt_details->total_label !!}--}}
{{'الاجمالي:'}}
</th>
<td style="text-align:left">
{{$receipt_details->total}}
</td>
</tr>
@endif

@if( !empty($receipt_details->total_paid_label) )
<tr>
<th style="text-align:right">
{{-- {!! $receipt_details->total_paid_label !!}--}}
{{'الاجمالي المدفوع:'}}
</th>
<td style="text-align:left">
{{$receipt_details->total_paid}}
</td>
</tr>
@endif

@if( !empty($receipt_details->total_due_label) )
<tr>
<th style="text-align:right">
{{-- {!! $receipt_details->total_due_label !!}--}}
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
</tfoot>
</table>
<script>
$( document ).ready(function() {
                function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
var lines = {{count($receipt_details->lines)}};
  if(lines > 8){

            let demo = document.getElementById('demo-bg');
            let parentt = document.getElementById('div_pos');
            let clonedDemo = demo.cloneNode(true);
            let clonedparentt = parentt.cloneNode(true);
            clonedDemo.id = 'demo-new';
            insertAfter(demo, clonedDemo);
            clonedDemo.style = 'position: absolute !important';
            clonedDemo.style = 'top: 100vh !important';
}
        if(lines > 18){
            let demo2 = document.getElementById('demo-new');
                    let parentt2 = document.getElementById('div_pos');
                    let clonedDemo2 = demo2.cloneNode(true);
                    let clonedparentt2 = parentt2.cloneNode(true);
                    clonedDemo2.id = 'demo-new-2';
                    insertAfter(demo2, clonedDemo2);
                    clonedDemo2.style = 'position: absolute !important';
                    clonedDemo2.style = 'top: 200vh !important';
}
        if(lines > 28){
            let demo3 = document.getElementById('demo-new-2');
                    let parentt3 = document.getElementById('div_pos');
                    let clonedDemo3 = demo3.cloneNode(true);
                    let clonedparentt3 = parentt3.cloneNode(true);
                    clonedDemo3.id = 'demo-new-3';
                    insertAfter(demo3, clonedDemo3);
                    clonedDemo3.style = 'position: absolute !important';
                    clonedDemo3.style = 'top: 300vh !important';
}
        if(lines > 38){
            let demo4 = document.getElementById('demo-new-3');
                    let parentt4 = document.getElementById('div_pos');
                    let clonedDemo4 = demo4.cloneNode(true);
                    let clonedparentt4 = parentt4.cloneNode(true);
                    clonedDemo4.id = 'demo-new-4';
                    insertAfter(demo4, clonedDemo4);
                    clonedDemo4.style = 'position: absolute !important';
                    clonedDemo4.style = 'top: 400vh !important';
}
        if(lines > 48){
            let demo5 = document.getElementById('demo-new-4');
                    let parentt5 = document.getElementById('div_pos');
                    let clonedDemo5 = demo5.cloneNode(true);
                    let clonedparentt5 = parentt5.cloneNode(true);
                    clonedDemo5.id = 'demo-new-5';
                    insertAfter(demo5, clonedDemo5);
                    clonedDemo5.style = 'position: absolute !important';
                    clonedDemo5.style = 'top: 500vh !important';
}
        if(lines > 58){
            let demo6 = document.getElementById('demo-new-5');
                    let parentt6 = document.getElementById('div_pos');
                    let clonedDemo6 = demo6.cloneNode(true);
                    let clonedparentt6 = parentt6.cloneNode(true);
                    clonedDemo6.id = 'demo-new-6';
                    insertAfter(demo6, clonedDemo6);
                    clonedDemo6.style = 'position: absolute !important';
                    clonedDemo6.style = 'top: 600vh !important';
}
        if(lines > 68){
            let demo7 = document.getElementById('demo-new-6');
                    let parentt7 = document.getElementById('div_pos');
                    let clonedDemo7 = demo7.cloneNode(true);
                    let clonedparentt7 = parentt7.cloneNode(true);
                    clonedDemo7.id = 'demo-new-7';
                    insertAfter(demo7, clonedDemo5);
                    clonedDemo7.style = 'position: absolute !important';
                    clonedDemo7.style = 'top: 700vh !important';
}
        if(lines > 78){
            let demo8 = document.getElementById('demo-new-7');
                    let parentt8 = document.getElementById('div_pos');
                    let clonedDemo8 = demo8.cloneNode(true);
                    let clonedparentt8 = parentt8.cloneNode(true);
                    clonedDemo8.id = 'demo-new-8';
                    insertAfter(demo8, clonedDemo8);
                    clonedDemo8.style = 'position: absolute !important';
                    clonedDemo8.style = 'top: 800vh !important';
}
        if(lines > 88){
            let demo9 = document.getElementById('demo-new-8');
                    let parentt9 = document.getElementById('div_pos');
                    let clonedDemo9 = demo9.cloneNode(true);
                    let clonedparentt9 = parentt9.cloneNode(true);
                    clonedDemo8.id = 'demo-new-9';
                    insertAfter(demo9, clonedDemo9);
                    clonedDemo9.style = 'position: absolute !important';
                    clonedDemo9.style = 'top: 900vh !important';
}
        if(lines > 98){
            let demo10 = document.getElementById('demo-new-9');
                    let parentt10 = document.getElementById('div_pos');
                    let clonedDemo10 = demo10.cloneNode(true);
                    let clonedparentt10 = parentt10.cloneNode(true);
                    clonedDemo10.id = 'demo-new-10';
                    insertAfter(demo10, clonedDemo10);
                    clonedDemo10.style = 'position: absolute !important';
                    clonedDemo10.style = 'top: 1000vh !important';
            }
                                                });
</script>
</div>