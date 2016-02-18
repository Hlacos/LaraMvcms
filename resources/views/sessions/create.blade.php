@extends('lara-mvcms::layouts.logouted')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            {{ Config::get('lara-mvcms.site-name') }}
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('lara-mvcms::sessions.sign-in-title') }}</p>
            <form method="post" action="{{ route('lara-mvcms.sessions.store') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    @if ($errors->has('email'))
                        <label for="email" class="control-label"><i class="fa fa-times-circle-o"></i> {{ $errors->first('email') }}</label>
                    @endif
                    <input type="email" name="email" placeholder="{{ trans('lara-mvcms::models/admin-user.email') }}" class="form-control" value="{{ Input::old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    @if ($errors->has('password'))
                        <label for="password" class="control-label"><i class="fa fa-times-circle-o"></i> {{ $errors->first('password') }}</label>
                    @endif
                    <input type="password" name="password" placeholder="{{ trans('lara-mvcms::models/admin-user.password') }}" class="form-control">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label><input type="checkbox" class="iCheck" name="remember_me" value="1" /> {{ trans('lara-mvcms::sessions.remember-me') }}</label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button class="btn btn-primary btn-block btn-flat" type="submit">{{ trans('lara-mvcms::sessions.sign-in') }}</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- {{ trans('lara-mvcms::sessions.or') }} -</p>
                <a class="btn btn-block btn-social btn-facebook btn-flat" href="#"><i class="fa fa-facebook"></i> {{ trans('lara-mvcms::sessions.facebook-login') }}</a>
                <a class="btn btn-block btn-social btn-google btn-flat" href="#"><i class="fa fa-google-plus"></i> {{ trans('lara-mvcms::sessions.google-plus-login') }}</a>
            </div><!-- /.social-auth-links -->

            <a href="{{ route('lara-mvcms.reset-password.create') }}">{{ trans('lara-mvcms::sessions.forgotten-password') }}</a><br>
            <a class="text-center" href="register.html">{{ trans('lara-mvcms::sessions.registration') }}</a>

        </div><!-- /.login-box-body -->
    </div>
@stop
