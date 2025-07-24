<div class="modal-header">
    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    @php
      $title = $purchase->type == 'purchase_order' ? __('lang_v1.purchase_order_details') : __('purchase.purchase_details');
    @endphp
<h4 class="modal-title" id="modalTitle"> {{$title}} (<b>@lang('purchase.ref_no'):</b> #{{ $purchase->ref_no }})
</div>
<div class="modal-body">
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right">
    <img style="max-height: 120px; width: auto;" src="https://weka.sa/assets/uploads/media-uploader/weka-logo41626025527.png" class="img">
    <h3>{{ $purchase->business->tax_label_1 }}</h3>
    @if(!empty($purchase->location->city) || !empty($purchase->location->state) || !empty($purchase->location->country))
          <br>{{implode(',', array_filter([$purchase->location->country , $purchase->location->city, $purchase->location->state]))}}
    @endif
    <p>{{ $purchase->business->tax_number_1}}</p>
    <p>فاتورة من</p>
    <p> {{ $purchase->contact->name}}</p>
    @if(!empty($purchase->contact->tax_number))
          <br>@lang('contact.tax_no'): {{$purchase->contact->tax_number}}
        @endif
    
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:left;">
    <h1><b>{{ $purchase->business->name }}</b></h1><br>
    <p>
    @if(!empty($purchase->contact->tax_number))
          @lang('contact.tax_no'): {{$purchase->contact->tax_number}}
        @endif
    </p>
    <p><b>{{ __('sale.amount') }}</b> </p><br/> <p>1200</p>
    @if(!empty($purchase_line->mfg_date))
      <p><b>@lang('product.mfg_date'):</b> {{ @format_date($purchase_line->mfg_date) }}</p>
    @endif
    @if(!empty($purchase_line->exp_date))
      <p><b>@lang('product.exp_date'):</b> {{ @format_date($purchase_line->exp_date) }}</p>
    @if($purchase->additional_notes)
      <p><b>@lang('purchase.additional_notes'):</b> {{ $purchase->additional_notes }}</p>
    </div>
  <div class="clearfix"></div>
  </div>
<div class="row">
    <div class="col-sm-12 col-xs-12">
      <div class="table-responsive">
        <table class="table bg-gray">
          <thead>
            <tr class="bg-green">
              <th>#</th>
              <th>@lang('product.product_name')</th>
              <th>@lang('product.sku')</th>
              @if($purchase->type == 'purchase_order')
                <th class="text-right">@lang( 'lang_v1.quantity_remaining' )</th>
              @endif
              <th class="text-right">@if($purchase->type == 'purchase_order') @lang('lang_v1.order_quantity') @else @lang('purchase.purchase_quantity') @endif</th>
              <th class="text-right">@lang( 'lang_v1.unit_cost_before_discount' )</th>
              <th class="text-right">@lang( 'lang_v1.discount_percent' )</th>
              <th class="no-print text-right">@lang('purchase.unit_cost_before_tax')</th>
              <th class="no-print text-right">@lang('purchase.subtotal_before_tax')</th>
              <th class="text-right">@lang('sale.tax')</th>
              <th class="text-right">@lang('purchase.unit_cost_after_tax')</th>
              @if($purchase->type != 'purchase_order')
              <th class="text-right">@lang('purchase.unit_selling_price')</th>
              @if(session('business.enable_lot_number'))
                <th>@lang('lang_v1.lot_number')</th>
              @endif
              @if(session('business.enable_product_expiry'))
                <th>@lang('product.mfg_date')</th>
                <th>@lang('product.exp_date')</th>
              @endif
              @endif
              <th class="text-right">@lang('sale.subtotal')</th>
            </tr>
          </thead>
          @php 
            $total_before_tax = 0.00;
          @endphp
          @foreach($purchase->purchase_lines as $purchase_line)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                {{ $purchase_line->product->name }}
                 @if( $purchase_line->product->type == 'variable')
                  - {{ $purchase_line->variations->product_variation->name}}
                  - {{ $purchase_line->variations->name}}
                 @endif
              </td>
              <td>
                 @if( $purchase_line->product->type == 'variable')
                  {{ $purchase_line->variations->sub_sku}}
                  @else
                  {{ $purchase_line->product->sku }}
                 @endif
              </td>
              @if($purchase->type == 'purchase_order')
              <td>
                <span class="display_currency" data-is_quantity="true" data-currency_symbol="false">{{ $purchase_line->quantity - $purchase_line->po_quantity_purchased }}</span> @if(!empty($purchase_line->sub_unit)) {{$purchase_line->sub_unit->short_name}} @else {{$purchase_line->product->unit->short_name}} @endif
              </td>
              @endif
              <td><span class="display_currency" data-is_quantity="true" data-currency_symbol="false">{{ $purchase_line->quantity }}</span> @if(!empty($purchase_line->sub_unit)) {{$purchase_line->sub_unit->short_name}} @else {{$purchase_line->product->unit->short_name}} @endif</td>
              <td class="text-right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->pp_without_discount}}</span></td>
              <td class="text-right"><span class="display_currency">{{ $purchase_line->discount_percent}}</span> %</td>
              <td class="no-print text-right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price }}</span></td>
              <td class="no-print text-right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->quantity * $purchase_line->purchase_price }}</span></td>
              <td class="text-right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->item_tax }} </span> <br/><small>@if(!empty($taxes[$purchase_line->tax_id])) ( {{ $taxes[$purchase_line->tax_id]}} ) </small>@endif</td>
              <td class="text-right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price_inc_tax }}</span></td>
              @if($purchase->type != 'purchase_order')
              @php
                $sp = $purchase_line->variations->default_sell_price;
                if(!empty($purchase_line->sub_unit->base_unit_multiplier)) {
                  $sp = $sp * $purchase_line->sub_unit->base_unit_multiplier;
                }
              @endphp
              <td class="text-right"><span class="display_currency" data-currency_symbol="true">{{$sp}}</span></td>

              @if(session('business.enable_lot_number'))
                <td>{{$purchase_line->lot_number}}</td>
              @endif

              @if(session('business.enable_product_expiry'))
              <td>
                @if(!empty($purchase_line->mfg_date))
                    {{ @format_date($purchase_line->mfg_date) }}
                @endif
              </td>
              <td>
                @if(!empty($purchase_line->exp_date))
                    {{ @format_date($purchase_line->exp_date) }}
                @endif
              </td>
              @endif
              @endif
              <td class="text-right"><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price_inc_tax * $purchase_line->quantity }}</span></td>
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
            <th>@lang('purchase.net_total_amount'): </th>
            <td></td>
            <td><span class="display_currency pull-right" data-currency_symbol="true">{{ $total_before_tax }}</span></td>
          </tr>
          <tr>
            <th>@lang('purchase.discount'):</th>
            <td>
              <b>(-)</b>
              @if($purchase->discount_type == 'percentage')
                ({{$purchase->discount_amount}} %)
              @endif
            </td>
            <td>
              <span class="display_currency pull-right" data-currency_symbol="true">
                @if($purchase->discount_type == 'percentage')
                  {{$purchase->discount_amount * $total_before_tax / 100}}
                @else
                  {{$purchase->discount_amount}}
                @endif                  
              </span>
            </td>
          </tr>
          <tr>
            <th>@lang('purchase.purchase_tax'):</th>
            <td><b>(+)</b></td>
            <td class="text-right">
                @if(!empty($purchase_taxes))
                  @foreach($purchase_taxes as $k => $v)
                    <strong><small>{{$k}}</small></strong> - <span class="display_currency pull-right" data-currency_symbol="true">{{ $v }}</span><br>
                  @endforeach
                @else
                0.00
                @endif
              </td>
          </tr>
          @if( !empty( $purchase->shipping_charges ) )
            <tr>
              <th>@lang('purchase.additional_shipping_charges'):</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency pull-right" >{{ $purchase->shipping_charges }}</span></td>
            </tr>
          @endif
          <tr>
            <th>@lang('purchase.purchase_total'):</th>
            <td></td>
            <td><span class="display_currency pull-right" data-currency_symbol="true" >{{ $purchase->final_total }}</span></td>
          </tr>
        </table>
      </div>
    </div>
<div class="clear-fix"></div>
  </div>

  
  
</div>