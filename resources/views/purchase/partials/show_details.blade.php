<div class="modal-header">
    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    @php
      $title = $purchase->type == 'purchase_order' ? __('lang_v1.purchase_order_details') : __('purchase.purchase_details');
    @endphp
</div>
<div class="modal-body">
  <div class="row">
    <div class="" style="text-align:right !important; float:left !important; padding: 20px;@if(empty($purchase->business->logo))padding-top:120px @endif">
    @if(!empty($purchase->business->logo))
    <img style="max-height: 120px; width: 120px;" src="{{asset('uploads/business_logos/' . $purchase->business->logo)}}" class="img">
    @endif
    <!--<h3>{{ $purchase->business->tax_label_1 }}</h3>-->
	@if(!empty($purchase->contact->supplier_business_name))
    <p>فاتورة من</p>
    <p>{{ $purchase->contact->supplier_business_name }}</p>
    @endif
   <!-- <p> {{ $purchase->contact->name}}</p>-->
    @if(!empty($purchase->contact->tax_number))
    <p>@lang('contact.tax_no'): {{$purchase->contact->tax_number}}</p>
        @endif
    
    </div>
    <div class="" style="float:right !important; text-align:right !important; padding:20px; padding-top:0px;">
    <h1>{{ $purchase->business->name }}</h1>
    <p>
    @if(!empty($purchase->business->tax_number_1))
          @lang('contact.tax_no'): {{$purchase->business->tax_number_1}}
        @endif
    </p>
     @if(!empty($purchase->location->city) || !empty($purchase->location->state) || !empty($purchase->location->country))
          {{implode(',', array_filter([$purchase->location->country , $purchase->location->city, $purchase->location->state]))}}
    @endif
    <p>{{ $purchase->business->tax_number_1}}</p>
    <p><b>@lang('purchase.purchase_total'):</b> </p><p>{{ $purchase->final_total }}</p>
    @if(!empty($purchase_line->mfg_date))
      <p><b>@lang('product.mfg_date'):</b> {{ @format_date($purchase_line->mfg_date) }}</p>
    @endif
    @if(!empty($purchase_line->exp_date))
      <p><b>@lang('product.exp_date'):</b> {{ @format_date($purchase_line->exp_date) }}</p>
    @endif
    @if($purchase->additional_notes)
      <p><b>@lang('purchase.additional_notes'):</b> {{ $purchase->additional_notes }}</p>
    @endif
    </div>
  <div class="clearfix"></div>
  </div>
<div class="row">
    <div class="col-sm-12 col-xs-12">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="bg-green">
              <th>#</th>
              <th>@lang('product.product_name')</th>
              <th>@lang('product.sku')</th>
              @if($purchase->type == 'purchase_order')
                <th style="text-align: right">@lang( 'lang_v1.quantity_remaining' )</th>
              @endif
              <th style="text-align: right">@if($purchase->type == 'purchase_order') @lang('lang_v1.order_quantity') @else @lang('purchase.purchase_quantity') @endif</th>
              <th style="text-align: right">@lang( 'lang_v1.unit_cost_before_discount' )</th>
              <th style="text-align: right">@lang( 'lang_v1.discount_percent' )</th>
              <!--<th style="text-align:right">@lang('purchase.discount')</th>-->
            @php
            $flag = "false";
            foreach($purchase->purchase_lines as $purchase_line){
            if($purchase_line->item_tax > 0){
            	$flag = 'true';
            }
            }
            @endphp
            @if($flag == 'true')
              <th style="text-align: right" class="no-print">@lang('purchase.unit_cost_before_tax')</th>
              <th style="text-align: right" class="no-print">@lang('purchase.subtotal_before_tax')</th>
              <th style="text-align: right">@lang('sale.tax')</th>
              <th style="text-align: right">@lang('purchase.unit_cost_after_tax')</th>
            @endif
            
              @if($purchase->type != 'purchase_order')
              <!--<th style="text-align: right">@lang('purchase.unit_selling_price')</th>-->
              <!--@if(session('business.enable_lot_number'))
                <th style="text-align: right">@lang('lang_v1.lot_number')</th>
              @endif-->
              @if(session('business.enable_product_expiry'))
                <th style="text-align: right">@lang('product.mfg_date')</th>
                <th style="text-align: right">@lang('product.exp_date')</th>
              @endif
              @endif
              <th style="text-align: right">@lang('sale.subtotal')</th>
            </tr>
          </thead>
          @php 
            $total_before_tax = 0.00;
          @endphp
          @foreach($purchase->purchase_lines as $purchase_line)
            <tr>
              <td style="text-align: right">{{ $loop->iteration }}</td>
              <td style="text-align: right">
                {{ $purchase_line->product->name }}
                 @if( $purchase_line->product->type == 'variable')
                  - {{ $purchase_line->variations->product_variation->name}}
                  - {{ $purchase_line->variations->name}}
                 @endif
              </td>
              <td style="text-align: right">
                 @if( $purchase_line->product->type == 'variable')
                  {{ $purchase_line->variations->sub_sku}}
                  @else
                  {{ $purchase_line->product->sku }}
                 @endif
              </td>
              @if($purchase->type == 'purchase_order')
              <td style="text-align: right">
                <span class="display_currency" data-is_quantity="true" data-currency_symbol="false">{{ $purchase_line->quantity - $purchase_line->po_quantity_purchased }}</span> @if(!empty($purchase_line->sub_unit)) {{$purchase_line->sub_unit->short_name}} @else {{$purchase_line->product->unit->short_name}} @endif
              </td>
              @endif
              <td style="text-align: right"><span class="display_currency" data-is_quantity="true" data-currency_symbol="false">{{ $purchase_line->quantity }}</span> @if(!empty($purchase_line->sub_unit)) {{$purchase_line->sub_unit->short_name}} @else {{$purchase_line->product->unit->short_name}} @endif</td>
              <td style="text-align: right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->pp_without_discount}}</span></td>
              <td style="text-align: right"><span class="display_currency">{{ $purchase_line->discount_percent}}</span> %</td>
              <!--<td style="text-align: right">({{$purchase->discount_amount}}%)</td>-->
            @if($purchase_line->item_tax > 0)
              <td class="no-print" style="text-align: right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price }}</span></td>
            @php
            $total_before = $purchase_line->quantity * $purchase_line->purchase_price;
            @endphp
              <td class="no-print" style="text-align: right"><span class="display_currency" data-currency_symbol="true">{{ $total_before }}</span></td>
            @php
            if(!empty($purchase_line->item_tax)){
            $tax_per_line = $purchase_line->item_tax * $purchase_line->quantity;
            }else{
            $tax_per_line = 00;
            }
            @endphp
              <td style="text-align: right"><span class="" data-currency_symbol="true">{{ $tax_per_line }} </span></td>
              <td style="text-align: right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price_inc_tax }}</span></td>
            @endif
              @if($purchase->type != 'purchase_order')
              @php
                $sp = $purchase_line->variations->default_sell_price;
                if(!empty($purchase_line->sub_unit->base_unit_multiplier)) {
                  $sp = $sp * $purchase_line->sub_unit->base_unit_multiplier;
                }
              @endphp
              <!--<td style="text-align: right"><span class="display_currency" data-currency_symbol="true">{{$sp}}</span></td>

              @if(session('business.enable_lot_number'))
                <td style="text-align: right">{{$purchase_line->lot_number}}</td>
              @endif-->

              @if(session('business.enable_product_expiry'))
              <td style="text-align: right">
                @if(!empty($purchase_line->mfg_date))
                    {{ @format_date($purchase_line->mfg_date) }}
                @endif
              </td>
              <td style="text-align: right">
                @if(!empty($purchase_line->exp_date))
                    {{ @format_date($purchase_line->exp_date) }}
                @endif
              </td>
              @endif
              @endif
              <td style="text-align: right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price_inc_tax * $purchase_line->quantity}}</span></td>
            </tr>
            @php 
              $total_before_tax += ($purchase_line->quantity * $purchase_line->purchase_price);
            @endphp
          @endforeach
        </table>
      </div>
    </div>
  </div>
<div class="row">
<div class="col-md-6 col-6 col-sm-6 col-xs-6" style="text-align:left"></div>
    <div style="text-align:right" class="col-6 col-md-6 col-sm-6 col-xs-6 @if($purchase->type == 'purchase_order') col-md-offset-6 @endif">
      <div class="table-responsive">
        <table class="table">
          <!-- <tr class="hide">
            <th>@lang('purchase.total_before_tax'): </th>
            <td></td>
            <td><span class="display_currency pull-right">{{ $total_before_tax }}</span></td>
          </tr> -->
         <tr>
            <th style="text-align: right; padding:2px !important;">@lang('purchase.net_total_amount'): </th>
            <td style="padding:2px !important;"></td>
            <td style="text-align: right; padding:2px !important;"><span class="display_currency" data-currency_symbol="true">{{ $total_before_tax }}</span></td>
          </tr>
          <tr>
            <th style="text-align: right; padding:2px !important;">@lang('purchase.discount'):</th>
            <td style="text-align: right; padding:2px !important;">
              <b>(-)</b>
              @if($purchase->discount_type == 'percentage')
                ({{$purchase->discount_amount}} %)
              @endif
            </td>
            <td style="text-align: right;padding:2px !important;">
              <span class="display_currency" data-currency_symbol="true">
                @if($purchase->discount_type == 'percentage')
                  {{$purchase->discount_amount * $total_before_tax / 100}}
                @else
                  {{$purchase->discount_amount}}
                @endif                  
              </span>
            </td>
          </tr>
        	@php
              $i = 0;
              
              foreach($purchase->purchase_lines as $purchase_line){
              $i = $i + ($purchase_line->item_tax * $purchase_line->quantity) ;
              }
           @endphp
        @if($i > 0)
          <tr>
            <th style="text-align: right; padding:2px !important;">ضريبة القيمة المضافة:</th>
            <td style="text-align: right; padding:2px !important;">
              <b>(+)</b>
            </td>
              <td style="text-align: right !important; padding:2px !important;">
              
              
              <span style="text-align: right !important" class="display_currency" data-currency_symbol="true">{{$i}}</span>
            </td>
          </tr>
        @endif
          	@if(!empty($purchase_taxes))
          <tr>
            <th style="text-align: right; padding:2px !important;">ضريبة القيمة المضافة:</th>
            <td style="text-align: right; padding:2px !important;"><b>(+)</b></td>
            <td style="text-align: right; padding:2px !important;">
                
                  @foreach($purchase_taxes as $k => $v)
                     <span class="display_currency" data-currency_symbol="true">{{ $v }}</span><br>
                  @endforeach
              </td>
          </tr>
         @endif
          @if(  $purchase->shipping_charges > 0 )
            <tr>
              <th style="text-align: right; padding:2px !important;">@lang('purchase.additional_shipping_charges'):</th>
              <td style="text-align: right; padding:2px !important;"><b>(+)</b></td>
              <td style="text-align: right; padding:2px !important;"><span class="display_currency" >{{ $purchase->shipping_charges }}</span></td>
            </tr>
          @endif
          <tr>
            <th style="text-align: right; padding:2px !important;">@lang('purchase.purchase_total'):</th>
            <td style="text-align: right; padding:2px !important;"></td>
            <td style="text-align: right; padding:2px !important;"><span class="display_currency" data-currency_symbol="true" >{{ $purchase->final_total }}</span></td>
          </tr>
        </table>
      </div>
    </div>
<div class="clear-fix"></div>
  </div>

<div class="row">
    @if(!empty($purchase->type == 'purchase'))
    <div class="col-md-12 col-12 col-sm-12 col-xs-12" style="width:100%">
      <div class="table-responsive">
      <h4>{{ __('sale.payment_info') }}:</h4>
        <table class="table table-bordered">
          <tr class="bg-green">
            <th style="text-align: right">#</th>
            <th style="text-align: right">{{ __('messages.date') }}</th>
            <th style="text-align: right">{{ __('purchase.ref_no') }}</th>
            <th style="text-align: right">{{ __('sale.amount') }}</th>
            <th style="text-align: right">{{ __('sale.payment_mode') }}</th>
            <th style="text-align: right">{{ __('sale.payment_note') }}</th>
          </tr>
          @php
            $total_paid = 0;
          @endphp
          @forelse($purchase->payment_lines as $payment_line)
            @php
              $total_paid += $payment_line->amount;
            @endphp
            <tr>
              <td style="text-align: right">{{ $loop->iteration }}</td>
              <td style="text-align: right">{{ @format_date($payment_line->paid_on) }}</td>
              <td style="text-align: right">{{ $payment_line->payment_ref_no }}</td>
              <td style="text-align: right"><span class="display_currency" data-currency_symbol="true">{{ $payment_line->amount }}</span></td>
              <td style="text-align: right">{{ $payment_methods[$payment_line->method] ?? '' }}</td>
              <td style="text-align: right">@if($payment_line->note) 
                {{ ucfirst($payment_line->note) }}
                @else
                --
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td style="text-align: center" colspan="6" class="text-center">
                @lang('purchase.no_payments')
              </td>
            </tr>
          @endforelse
        </table>
      </div>
    </div>
	<div class="clear-fix"></div>
    @endif
  </div>
  {{-- Barcode --}}
  <div class="row print_section">
    <div class="col-xs-12">
       <img class="pull-right" width="100px" src="data:image/png;base64,{{DNS2D::getBarcodePNG('اسم المنشأة ='.$purchase->business->tax_label_1.'
																	    '.'الرقم الضريبي ='. $purchase->business->tax_number_1.'
                                      '.'رقم المرجعي ='.$purchase->ref_no.' 
																		 	  '.'الوقت والتاريخ ='.$purchase->transaction_date.'
																		 	  '.'المجموع ='. $purchase->final_total
                                    , 'QRCODE')}}" alt="barcode"/> 
      {{-- <img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($purchase->ref_no, 'C128', 2,30,array(39, 48, 54), true)}}"> --}}
    </div>
  </div>
  
</div>