<form action="{{ $role->id ? route('lara-mvcms.administration.roles.update', $role->id) : route('lara-mvcms.administration.roles.store') }}" method="post" class="form-horizontal">
    @if ($role->id)
        <input type="hidden" name="_method" value="put" />
    @endif
    {{ csrf_field() }}

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">{{ trans('lara-mvcms::roles.role') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="name">{{ trans('lara-mvcms::models/role.name') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" value="{{ old('name') !== null ? old('name') : $role->name }}" class="form-control" placeholder="{{ trans('lara-mvcms::models/role.name') }}">
                    @if ($errors->has('name'))
                        <p class="text-red">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @foreach(config('translatable.locales') as $locale)
                <li class="{{ App::getLocale() == $locale ? 'active' : '' }}">
                    <a href="#tab-{{ $locale }}" data-toggle="tab">
                        <span class="flag-icon flag-icon-{{ $locale }}"></span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach(config('translatable.locales') as $locale)
                <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab-{{ $locale }}">
                    <div class="form-group{{ $errors->has($locale.'.title') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-title">{{ trans('lara-mvcms::models/role.title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[title]" value="{{ old($locale.'.title') !== null ? old($locale.'.title') : ($role->translate($locale) ? $role->translate($locale)->title : '') }}" id="{{ $locale }}-title" class="form-control" placeholder="{{ trans('lara-mvcms::models/role.title') }}">
                            @if ($errors->has($locale.'.title'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.title') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has($locale.'.description') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-description">{{ trans('lara-mvcms::models/role.description') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[description]" value="{{ old($locale.'.description') !== null ? old($locale.'.description') : ($role->translate($locale) ? $role->translate($locale)->description : '') }}" id="{{ $locale }}-description" class="form-control" placeholder="{{ trans('lara-mvcms::models/role.description') }}">
                            @if ($errors->has($locale.'.description'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.description') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">{{ trans('lara-mvcms::roles.relations') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label class="col-sm-2 control-label">{{ trans('lara-mvcms::models/role.permissions') }}</label>
                <div class="col-sm-10">
                    @foreach ($permissions as $permission)
                        <div class="checkbox icheck">
                            <label><input type="checkbox" class="iCheck" name="permissions[]" value="{{ $permission->id }}" {{ count(old()) ? (in_array($permission->id, (array)old('permissions')) ? "checked" : "") : ($role->hasPermission($permission) ? "checked" : "") }} /> {{ $permission->title }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('lara-mvcms::roles.buttons.save') }}</button>
</form>
