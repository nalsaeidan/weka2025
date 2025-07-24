@extends('layouts.auth2')
@section('title', __('lang_v1.login'))

@section('content')
    <div class="login-form col-md-12 col-xs-12 right-col-content">
        <p class="form-header text-white">@lang('lang_v1.login')</p>
        <form method="POST" action="{{ route('login') }}" id="login-form">
            {{ csrf_field() }}
            <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                @php
                    $username = old('username');
                    $password = null;
                    if(config('app.env') == 'demo'){
                        $username = 'admin';
                        $password = '123456';
                        $demo_types = [
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
                        ];
                        if(!empty($_GET['demo_type']) && array_key_exists($_GET['demo_type'], $demo_types)){
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
                <input id="password" type="password" class="form-control" name="password" value="{{ $password }}" required placeholder="@lang('lang_v1.password')">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            {{-- ✅ Turnstile Widget --}}
            <div class="form-group {{ $errors->has('turnstile') ? 'has-error' : '' }}">
                <div class="cf-turnstile" data-sitekey="0x4AAAAAABgW5bnI08vVdiA0"></div>
                @if ($errors->has('turnstile'))
                    <span class="help-block">
                        <strong>{{ $errors->first('turnstile') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('lang_v1.remember_me')
                    </label>
                </div>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat btn-login col-6 col-lg-6 col-xl-6 col-md-12 col-sm-12 col-xs-12">@lang('lang_v1.login')</button>
                @if(config('app.env') != 'demo')
                    <a href="{{ route('password.request') }}" class="pull-right col-md-12 col-sm-12 col-xs-12">
                        @lang('lang_v1.forgot_your_password')
                    </a>
                @endif
            </div>
        </form>
    </div>

    @if(config('app.env') == 'demo')
        {{-- محتوى تجريبي --}}
        {{-- ... --}}
    @endif
@stop
@section('javascript')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change(function(){
            window.location = "{{ route('login') }}?lang=" + $(this).val();
        });

        $('a.demo-login').click(function(e){
            e.preventDefault();
            $('#username').val($(this).data('admin'));
            $('#password').val("{{$password}}");

            // ⏳ تأخير الإرسال 1 ثانية لتوليد رمز turnstile
            setTimeout(function() {
                $('form#login-form').submit();
            }, 1000);
        });
    });
</script>
@endsection

