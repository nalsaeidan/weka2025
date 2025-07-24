<style>
*{
font-family: 'DroidArabicKufiRegular';
}
p{
color: black;
font-weight:bold;
font-size:26px;
}
.form-header, .checkbox.icheck label, .form-group a , .form-group a:hover, .form-group a:active {
    color: black !important;
}
.form-control{
text-align:right;
border-radius: 8px;
}

.btn-primary, .btn-primary:hover, .btn-primary:active{
color: #fff;background-image: -webkit-linear-gradient( 
180deg, #a12299 0%, #d23a74 51%, #f96834 99%);
}
form#login-form {
    background: #e64f5614;
    padding: 40px;
    border-radius: 8px;
}
.checkbox{
direction: rtl;
}
.checkbox input[type=checkbox], .checkbox-inline input[type=checkbox]{
position: relative;
margin-left: unset;
}
</style>
<div class="row">
        	<div class="col-md-2 col-xs-2 col-sm-2 col-2"></div>
            <div class="text-right login-form col-6 col-lg-6 col-xl-6 col-md-12 col-xs-12 col-sm-12 right-col-content">
        <p class="form-header text-center">@lang('lang_v1.login')</p>
        <form method="POST" action="{{ route('login') }}" id="login-form">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                @php
                    $username = old('username');
                    $password = null;
                    if(config('app.env') == 'demo'){
                        $username = 'admin';
                        $password = '123456';

                        $demo_types = array(
                            'all_in_one' => 'admin',
                            'super_market' => 'admin',
                            'pharmacy' => 'admin-pharmacy',
                            'electronics' => 'admin-electronics',
                            'services' => 'admin-services',
                            'restaurant' => 'admin-restaurant',
                            'superadmin' => 'superadmin',
                            'woocommerce' => 'woocommerce_user',
                            'essentials' => 'admin-essentials',
                            'manufacturing' => 'manufacturer-demo',
                        );

                        if( !empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types) ){
                            $username = $demo_types[$_GET['demo_type']];
                        }
                    }
                @endphp
                <input id="username" type="text" class="form-control" name="username" value="{{ $username }}" required autofocus placeholder="@lang('lang_v1.username')">
                <span class="fa fa-user form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password"
                value="{{ $password }}" required placeholder="@lang('lang_v1.password')">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox icheck">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <label> @lang('lang_v1.remember_me')</label>
                    
                </div>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat btn-login col-md-12 col-xs-12 col-sm-12">@lang('lang_v1.login')</button>
                @if(config('app.env') != 'demo')
                <a href="{{ route('password.request') }}" class="pull-left">
                    @lang('lang_v1.forgot_your_password')
                </a>
            @endif
            </div>
        </form>
    </div>
        	<div class="col-md-2 col-xs-2 col-sm-2 col-2"></div>
        </div>
