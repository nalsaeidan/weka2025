@inject('request', 'Illuminate\Http\Request')
<!-- Main Header -->
  <header class="main-header no-print">
    <a href="{{route('home')}}" class="logo">
      
      <span class="logo-lg">{{ Session::get('business.name') }} <i class="fa fa-circle text-success" id="online_indicator"></i></span> 

    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        &#9776;
        <span class="sr-only">Toggle navigation</span>
      </a>

      @if(Module::has('Superadmin'))
        @includeIf('superadmin::layouts.partials.active_subscription')
      @endif

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">

        @if(Module::has('Essentials'))
          @includeIf('essentials::layouts.partials.header_part')
        @endif

        <div class="btn-group">
          <button id="header_shortcut_dropdown" type="button" class="btn btn-success dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-plus-circle fa-lg"></i>
          </button>
          <ul class="dropdown-menu">
            @if(config('app.env') != 'demo')
              <li><a href="{{route('calendar')}}">
                  <i class="fas fa-calendar-alt" aria-hidden="true"></i> @lang('lang_v1.calendar')
              </a></li>
            @endif
            @if(Module::has('Essentials'))
              <li><a href="#" class="btn-modal" data-href="{{action('\Modules\Essentials\Http\Controllers\ToDoController@create')}}" data-container="#task_modal">
                  <i class="fas fa-clipboard-check" aria-hidden="true"></i> @lang( 'essentials::lang.add_to_do' )
              </a></li>
            @endif
            <!-- Help Button -->
            @if(auth()->user()->hasRole('Admin#' . auth()->user()->business_id))
              <li><a id="start_tour" href="#">
                  <i class="fas fa-question-circle" aria-hidden="true"></i> @lang('lang_v1.application_tour')
              </a></li>
            @endif
          </ul>
        </div>
      <script type="application/javascript">
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
      <form>
      <div id="calculator" style="display:none; position:absolute; center:center; background:white;">
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
      
       <button id="" title="@lang('lang_v1.calculator')" type="button" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10 popover-default hidden-xs" onclick="toggleCalculator()" data-toggle="popover" data-trigger="click"  data-html="true" data-placement="bottom">
            <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
        </button>
      </form>

        
        @if($request->segment(1) == 'pos')
          @can('view_cash_register')
          <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".register_details_modal" 
          data-href="{{ action('CashRegisterController@getRegisterDetails')}}">
            <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
          </button>
          @endcan
          @can('close_cash_register')
          <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".close_register_modal" 
          data-href="{{ action('CashRegisterController@getCloseRegister')}}">
            <strong><i class="fa fa-window-close fa-lg"></i></strong>
          </button>
          @endcan
        @endif

        @if(in_array('pos_sale', $enabled_modules))
          @can('sell.create')
            <a href="{{action('SellPosController@create')}}" title="@lang('sale.pos_sale')" class="btn btn-flat pull-left m-8 btn-sm mt-10 btn-success">
              <strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
            </a>
          @endcan
        @endif

        @if(Module::has('Repair'))
          @includeIf('repair::layouts.partials.header')
        @endif

        @can('profit_loss_report.view')
          <button type="button" id="view_todays_profit" title="{{ __('home.todays_profit') }}" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10">
            <strong><i class="fas fa-money-bill-alt fa-lg"></i></strong>
          </button>
        @endcan

        <div class="m-8 pull-left mt-15 hidden-xs" style="color: #fff;"><strong>{{ @format_date('now') }}</strong></div>

        <ul class="nav navbar-nav">
          @include('layouts.partials.header-notifications')
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              @php
                $profile_photo = auth()->user()->media;
              @endphp
              @if(!empty(Session::get('business.logo')))
                  <img src="{{ asset( 'uploads/business_logos/' . Session::get('business.logo') ) }}" class="user-image" alt="Logo">
                @endif
              
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                @if(!empty(Session::get('business.logo')))
                  <img src="{{ asset( 'uploads/business_logos/' . Session::get('business.logo') ) }}" alt="Logo">
                @endif
                <p>
                  {{ Auth::User()->first_name }} {{ Auth::User()->last_name }}
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{action('UserController@getProfile')}}" class="btn btn-default btn-flat">@lang('lang_v1.profile')</a>
                </div>
                <div class="pull-right">
                  <a href="{{action('Auth\LoginController@logout')}}" class="btn btn-default btn-flat">@lang('lang_v1.sign_out')</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>