<form action="{{ $adminUser->id ? route('lara-mvcms.administration.admin-users.update', $adminUser->id) : route('lara-mvcms.administration.admin-users.store') }}" method="post" class="form-horizontal">
    @if ($adminUser->id)
        <input type="hidden" name="_method" value="put" />
    @endif
    {{ csrf_field() }}

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">{{ trans('lara-mvcms::admin-users.admin-user') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="username">{{ trans('lara-mvcms::models/admin-user.username') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="username" id="username" value="{{ old('username') !== null ? old('username') : $adminUser->username }}" class="form-control" placeholder="{{ trans('lara-mvcms::models/admin-user.username') }}">
                    @if ($errors->has('username'))
                        <p class="text-red">
                            {{ $errors->first('username') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="firstname">{{ trans('lara-mvcms::models/admin-user.firstname') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="firstname" id="firstname" value="{{ old('firstname') !== null ? old('firstname') : $adminUser->firstname }}" class="form-control" placeholder="{{ trans('lara-mvcms::models/admin-user.firstname') }}">
                    @if ($errors->has('firstname'))
                        <p class="text-red">
                            {{ $errors->first('firstname') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="lastname">{{ trans('lara-mvcms::models/admin-user.lastname') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="lastname" id="lastname" value="{{ old('lastname') !== null ? old('lastname') : $adminUser->lastname }}" class="form-control" placeholder="{{ trans('lara-mvcms::models/admin-user.lastname') }}">
                    @if ($errors->has('lastname'))
                        <p class="text-red">
                            {{ $errors->first('lastname') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="email">{{ trans('lara-mvcms::models/admin-user.email') }}</label>
                <div class="col-sm-10">
                    <input type="email" name="email" id="email" value="{{ old('email') !== null ? old('email') : $adminUser->email }}" class="form-control" placeholder="{{ trans('lara-mvcms::models/admin-user.email') }}">
                    @if ($errors->has('email'))
                        <p class="text-red">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="password">{{ trans('lara-mvcms::models/admin-user.password') }}</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="password" value="" class="form-control" placeholder="{{ trans('lara-mvcms::models/admin-user.password') }}">
                    @if ($errors->has('password'))
                        <p class="text-red">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="password">{{ trans('lara-mvcms::models/admin-user.password_confirmation') }}</label>
                <div class="col-sm-10">
                    <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control" placeholder="{{ trans('lara-mvcms::models/admin-user.password_confirmation') }}">
                    @if ($errors->has('password_confirmation'))
                        <p class="text-red">
                            {{ $errors->first('password_confirmation') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="is_active">{{ trans('lara-mvcms::models/admin-user.is_active') }}</label>
                <div class="col-sm-10">
                    <div class="checkbox icheck">
                        <label><input type="checkbox" class="iCheck" name="is_active" value="1" {{ count(old()) ? (old('is_active') ? "checked" : "") : ($adminUser->is_active ? "checked" : "") }} /></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">{{ trans('lara-mvcms::admin-users.relations') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">{{ trans('lara-mvcms::models/admin-user.roles') }}</label>
                <div class="col-sm-10">
                    @foreach ($roles as $role)
                        <div class="checkbox icheck">
                            <label><input type="checkbox" class="iCheck" name="roles[]" value="{{ $role->id }}" {{ count(old()) ? (in_array($role->id, (array)old('roles')) ? "checked" : '') : ($adminUser->hasRole($role) ? "checked" : "") }} /> {{ $role->title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('lara-mvcms::admin-users.buttons.save') }}</button>
</form>
