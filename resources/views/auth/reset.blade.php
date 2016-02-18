@extends('lara-mvcms::layouts.logouted')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            {{ Config::get('lara-mvcms.site-name') }}
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('lara-mvcms::reset-password.new-password-title') }}</p>
            <form method="post" action="{{ route('lara-mvcms.reset-password.delete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="_method" value="delete">

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
                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" placeholder="{{ trans('lara-mvcms::models/admin-user.password-confirmation') }}" class="form-control">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-4 col-xs-offset-8">
                        <button class="btn btn-primary btn-block btn-flat" type="submit">{{ trans('lara-mvcms::reset-password.send') }}</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="{{ route('lara-mvcms.sessions.create') }}">{{ trans('lara-mvcms::reset-password.log-in') }}</a><br>
            <a class="text-center" href="register.html">{{ trans('lara-mvcms::reset-password.registration') }}</a>

        </div><!-- /.login-box-body -->
    </div>
@stop
