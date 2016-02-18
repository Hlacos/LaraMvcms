@extends('lara-mvcms::layouts.logouted')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            {{ Config::get('lara-mvcms.site-name') }}
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ trans('lara-mvcms::reset-password.reset-password-title') }}</p>
            @if (Session::has('status'))
                <div class="callout callout-success">
                    <h4>{{ trans('lara-mvcms::statuses.success') }}</h4>
                    <p>{{ Session::get('status') }}</p>
                </div>
            @endif
            <form method="post" action="{{ route('lara-mvcms.reset-password.store') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                    @if ($errors->has('email'))
                        <label for="email" class="control-label"><i class="fa fa-times-circle-o"></i> {{ $errors->first('email') }}</label>
                    @endif
                    <input type="email" name="email" placeholder="{{ trans('lara-mvcms::models/admin-user.email') }}" class="form-control" value="{{ Input::old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
