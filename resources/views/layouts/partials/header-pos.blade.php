<!-- default value -->
@php
    $go_back_url = action('SellPosController@index');
    $transaction_sub_type = '';
    $view_suspended_sell_url = action('SellController@index').'?suspended=1';
    $pos_redirect_url = action('SellPosController@create');
@endphp

@if(!empty($pos_module_data))
    @foreach($pos_module_data as $key => $value)
        @php
            if(!empty($value['go_back_url'])) {
                $go_back_url = $value['go_back_url'];
            }

            if(!empty($value['transaction_sub_type'])) {
                $transaction_sub_type = $value['transaction_sub_type'];
                $view_suspended_sell_url .= '&transaction_sub_type='.$transaction_sub_type;
                $pos_redirect_url .= '?sub_type='.$transaction_sub_type;
            }
        @endphp
    @endforeach
@endif
<input type="hidden" name="transaction_sub_type" id="transaction_sub_type" value="{{$transaction_sub_type}}">
@inject('request', 'Illuminate\Http\Request')
<div class="col-md-12 no-print pos-header">
  <input type="hidden" id="pos_redirect_url" value="{{$pos_redirect_url}}">
  <div class="row">
    <div class="col-md-6">
      <div class="m-6 mt-5" style="display: flex;">
        <p ><strong>@lang('sale.location'): &nbsp;</strong> 
          @if(empty($transaction->location_id))
            @if(count($business_locations) > 1)
            <div style="width: 28%;margin-bottom: 5px;">
               {!! Form::select('select_location_id', $business_locations, $default_location->id ?? null , ['class' => 'form-control input-sm',
                'id' => 'select_location_id', 
                'required', 'autofocus'], $bl_attributes); !!}
            </div>
            @else
              {{$default_location->name}}
            @endif
          @endif

          @if(!empty($transaction->location_id)) {{$transaction->location->name}} @endif &nbsp;{{ @format_datetime('now') }} <i class="fa fa-keyboard hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('sale_pos.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i>
        </p>
      </div>
    </div>
    <div class="col-md-6">
      <a href="{{$go_back_url}}" title="{{ __('lang_v1.go_back') }}" class="btn btn-info btn-flat m-6 btn-xs m-5 pull-right">
        <strong><i class="fa fa-backward fa-lg"></i></strong>
      </a>
      @can('close_cash_register')
      <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" class="btn btn-danger btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".close_register_modal" 
          data-href="{{ action('CashRegisterController@getCloseRegister')}}">
            <strong><i class="fa fa-window-close fa-lg"></i></strong>
      </button>
      @endcan
      
      @can('view_cash_register')
      <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" class="btn btn-success btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".register_details_modal" 
          data-href="{{ action('CashRegisterController@getRegisterDetails')}}">
            <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
      </button>
      @endcan

      <!--<button title="@lang('lang_v1.calculator')" id="btnCalculator" type="button" class="btn btn-success btn-flat pull-right m-5 btn-xs mt-10 popover-default" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
            <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
      </button>-->
    <script type="text/javascript">
      
      function toggleCalculator(){
      $('#calculator').toggle();
      }
      
function calcEnterVal(A) {
    document.getElementById('res').value += A
}
function clearResultScreen() {
    document.getElementById('res').value = ""
}
function calculateResult() {
    try {
        var input = eval(document.getElementById('res').value);
        document.getElementById('res').value = input
    } catch (A) {
        document.getElementById('res').value = "Error"
    }
}
      </script>
      
        <button id="" title="@lang('lang_v1.calculator')" type="button" class="btn btn-success btn-flat m-6 hidden-xs btn-xs m-5 pull-right popover-default hidden-xs" onclick="toggleCalculator()" data-toggle="popover" data-trigger="click"  data-html="true" data-placement="bottom">
            <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
        </button>
      <div id="calculator" style="display:none; position:absolute; z-index:999; background:white;left: 20px; top: 40px;">
  <div class="row text-center" id="calc">
    <div class="calcBG col-md-12 text-center">
      <div class="row" id="result">
        <form name="calc">
          <input type="text" class="screen text-right" name="result" readonly id="res">
        </form>
      </div>
      <div class="row">
        <button id="allClear" type="button" class="btn btn-danger" onclick="clearResultScreen()">AC</button>
        <button id="clear" type="button" class="btn btn-warning" onclick="clearResultScreen()">CE</button>
        <button id="%" type="button" class="btn" onclick="calcEnterVal(this.id)">%</button>
        <button id="/" type="button" class="btn" onclick="calcEnterVal(this.id)">÷</button>
      </div>
      <div class="row">
        <button id="7" type="button" class="btn" onclick="calcEnterVal(this.id)">7</button>
        <button id="8" type="button" class="btn" onclick="calcEnterVal(this.id)">8</button>
        <button id="9" type="button" class="btn" onclick="calcEnterVal(this.id)">9</button>
        <button id="*" type="button" class="btn" onclick="calcEnterVal(this.id)">x</button>
      </div>
      <div class="row">
        <button id="4" type="button" class="btn" onclick="calcEnterVal(this.id)">4</button>
        <button id="5" type="button" class="btn" onclick="calcEnterVal(this.id)">5</button>
        <button id="6" type="button" class="btn" onclick="calcEnterVal(this.id)">6</button>
        <button id="-" type="button" class="btn" onclick="calcEnterVal(this.id)">-</button>
      </div>
      <div class="row">
        <button id="1" type="button" class="btn" onclick="calcEnterVal(this.id)">1</button>
        <button id="2" type="button" class="btn" onclick="calcEnterVal(this.id)">2</button>
        <button id="3" type="button" class="btn" onclick="calcEnterVal(this.id)">3</button>
        <button id="+" type="button" class="btn" onclick="calcEnterVal(this.id)">+</button>
      </div>
      <div class="row">
        <button id="0" type="button" class="btn" onclick="calcEnterVal(this.id)">0</button>
        <button id="." type="button" class="btn" onclick="calcEnterVal(this.id)">.</button>
        <button id="equals" type="button" class="btn btn-success" onclick="calculateResult()">=</button>
        <button id="blank" type="button" class="btn">&nbsp;</button>
      </div>
    </div>
  </div>
</div>

      <button type="button" title="{{ __('lang_v1.full_screen') }}" class="btn btn-primary btn-flat m-6 hidden-xs btn-xs m-5 pull-right" id="full_screen">
            <strong><i class="fa fa-window-maximize fa-lg"></i></strong>
      </button>

      <button type="button" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}" class="btn bg-yellow btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-container=".view_modal" 
          data-href="{{$view_suspended_sell_url}}">
            <strong><i class="fa fa-pause-circle fa-lg"></i></strong>
      </button>
      @if(empty($pos_settings['hide_product_suggestion']) && isMobile())
        <button type="button" title="{{ __('lang_v1.view_products') }}"   
          data-placement="bottom" class="btn btn-success btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-toggle="modal" data-target="#mobile_product_suggestion_modal">
            <strong><i class="fa fa-cubes fa-lg"></i></strong>
        </button>
      @endif

      @if(Module::has('Repair') && $transaction_sub_type != 'repair')
        @include('repair::layouts.partials.pos_header')
      @endif

        @if(in_array('pos_sale', $enabled_modules) && !empty($transaction_sub_type))
          @can('sell.create')
            <a href="{{action('SellPosController@create')}}" title="@lang('sale.pos_sale')" class="btn btn-success btn-flat m-6 btn-xs m-5 pull-right">
              <strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
            </a>
          @endcan
        @endif

    </div>
    
  </div>
</div>
