<form action="{{ $category->id ? route('lara-mvcms.blog.categories.update', $category->id) : route('lara-mvcms.blog.categories.store') }}" method="post" class="form-horizontal">
    @if ($category->id)
        <input type="hidden" name="_method" value="put" />
    @endif
    {{ csrf_field() }}

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">{{ trans('lara-mvcms::categories.category') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="parent_id">{{ trans('lara-mvcms::models/category.parent_id') }}</label>
                <div class="col-sm-10">
                    <select name="parent_id" class="form-control">
                        <option value="">{{ trans('lara-mvcms::form.select.choose') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ count(old()) ? (old('parent_id') == $category->id ? "checked" : "") : ($category->parent_id ? "checked" : "") }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('parent_id'))
                        <p class="text-red">
                            {{ $errors->first('parent_id') }}
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
                    <div class="form-group{{ $errors->has($locale.'.slug') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-slug">{{ trans('lara-mvcms::models/category.slug') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[slug]" value="{{ old($locale.'.slug') !== null ? old($locale.'.slug') : ($category->translate($locale) ? $category->translate($locale)->slug : '') }}" id="{{ $locale }}-slug" class="form-control" placeholder="{{ trans('lara-mvcms::models/category.slug') }}">
                            @if ($errors->has($locale.'.slug'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.slug') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has($locale.'.title') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-title">{{ trans('lara-mvcms::models/category.title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[title]" value="{{ old($locale.'.title') !== null ? old($locale.'.title') : ($category->translate($locale) ? $category->translate($locale)->title : '') }}" id="{{ $locale }}-title" class="form-control" placeholder="{{ trans('lara-mvcms::models/category.title') }}">
                            @if ($errors->has($locale.'.title'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.title') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has($locale.'.description') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-description">{{ trans('lara-mvcms::models/category.description') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[description]" value="{{ old($locale.'.description') !== null ? old($locale.'.description') : ($category->translate($locale) ? $category->translate($locale)->description : '') }}" id="{{ $locale }}-description" class="form-control" placeholder="{{ trans('lara-mvcms::models/category.description') }}">
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

    <button type="submit" class="btn btn-primary">{{ trans('lara-mvcms::categories.buttons.save') }}</button>
</form>
