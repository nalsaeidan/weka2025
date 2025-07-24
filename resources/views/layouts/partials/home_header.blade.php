<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="/">{{config('app.name', 'ultimatePOS')}}</a>-->
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
      <li><a href="{{ action('HomeController@index') }}">@lang('home.home')</a></li>
      <li><a href="#"> | </a></li>
        @if(Auth::check())
            <li><a href="{{ action('HomeController@index') }}">@lang('home.weka')</a></li>
      <li><a href="#"> | </a></li>
        @endif
        @if(Route::has('frontend-pages') && config('app.env') != 'demo' 
        && !empty($frontend_pages))
            @foreach($frontend_pages as $page)
                <li><a href="{{ action('\Modules\Superadmin\Http\Controllers\PageController@showPage', $page->slug) }}">{{$page->title}}</a></li>
      <li><a href="#"> | </a></li>
            @endforeach
        @endif
        @if(Route::has('pricing') && config('app.env') != 'demo')
       <li><a href="{{ action('\Modules\Superadmin\Http\Controllers\PricingController@index') }}">@lang('superadmin::lang.pricing')</a></li>
      <li><a href="#"> | </a></li>
        @endif
        @if(Route::has('repair-status'))
        <li>
          <a href="{{ action('\Modules\Repair\Http\Controllers\CustomerRepairStatusController@index') }}">
            @lang('repair::lang.repair_status')
          </a>
        </li>
      <li><a href="#"> | </a></li>
        @endif
      @if (Route::has('login'))
            @if(!Auth::check())
      			
                <li><a href="{{ route('login') }}">@lang('lang_v1.login')</a></li>
      			<li><a href="#"> | </a></li>
                @if(config('constants.allow_registration'))
                    <li><a href="{{ route('business.getRegister') }}">@lang('lang_v1.register')</a></li>
      				<li><a href="#"> | </a></li>
                @endif
            @endif
        @endif
       <li><a href="https://www.facebook.com/wekasa2021"><i class="fab fa-facebook-f"></i></a></li>
       <li><a href="https://twitter.com/wekasa2021"><i class="fab fa-twitter"></i></a></li>
       <li><a href="https://www.instagram.com/wekasa2021/"><i class="fab fa-instagram"></i></a></li>
       <li><a href="https://www.youtube.com/channel/UCtLxftD2UsXDRB3694cQ8qQ"><i class="fab fa-youtube"></i></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right info-items">
      <li><a><i class="fas fa-phone"></i> 0530339595 - 0531339595</a></li>
      <li><a><i class="fas fa-envelope"></i> info@weka.sa</a></li>
      </ul> 
    </div><!-- nav-collapse -->
  </div>
</nav>
<nav class="navbar navbar-area navbar-expand-lg absolute">
    <div class="container-fluid nav-container">
        <div class="logo-wrapper navbar-brand">
            <a href="{{route ('login') }}" class="logo">
               
                                    <img src="{{asset('uploads/img/logo.png')}}" alt="">
                                          </a>
        </div>
        <!-- /.navbar btn wrapper -->
        
        <!-- navbar collapse end -->
            </div>
</nav>