<form action="{{ $page->id ? route('lara-mvcms.content-management.pages.update', $page->id) : route('lara-mvcms.content-management.pages.store') }}" method="post" class="form-horizontal">
    @if ($page->id)
        <input type="hidden" name="_method" value="put" />
    @endif
    {{ csrf_field() }}

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">{{ trans('lara-mvcms::pages.page') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="name">{{ trans('lara-mvcms::models/page.name') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" value="{{ old('name') !== null ? old('name') : $page->name }}" class="form-control" placeholder="{{ trans('lara-mvcms::models/page.name') }}">
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
                    <div class="form-group{{ $errors->has($locale.'.slug') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-slug">{{ trans('lara-mvcms::models/page.slug') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[slug]" value="{{ old($locale.'.slug') !== null ? old($locale.'.slug') : ($page->translate($locale) ? $page->translate($locale)->slug : '') }}" id="{{ $locale }}-slug" class="form-control" placeholder="{{ trans('lara-mvcms::models/page.slug') }}">
                            @if ($errors->has($locale.'.slug'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.slug') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has($locale.'.title') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-title">{{ trans('lara-mvcms::models/page.title') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[title]" value="{{ old($locale.'.title') !== null ? old($locale.'.title') : ($page->translate($locale) ? $page->translate($locale)->title : '') }}" id="{{ $locale }}-title" class="form-control" placeholder="{{ trans('lara-mvcms::models/page.title') }}">
                            @if ($errors->has($locale.'.title'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.title') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has($locale.'.description') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-description">{{ trans('lara-mvcms::models/page.description') }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[description]" value="{{ old($locale.'.description') !== null ? old($locale.'.description') : ($page->translate($locale) ? $page->translate($locale)->description : '') }}" id="{{ $locale }}-description" class="form-control" placeholder="{{ trans('lara-mvcms::models/page.description') }}">
                            @if ($errors->has($locale.'.description'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.description') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has($locale.'.content') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label" for="{{ $locale }}-content">{{ trans('lara-mvcms::models/page.content') }}</label>
                        <div class="col-sm-10">
                            <textarea id="{{ $locale }}-content" class="form-control html-editable" data-token="{{ csrf_token() }}" placeholder="{{ trans('lara-mvcms::models/page.content') }}" name="{{ $locale }}[content]">{{ old($locale.'.content') !== null ? old($locale.'.content') : ($page->translate($locale) ? $page->translate($locale)->content : '') }}</textarea>
                            @if ($errors->has($locale.'.content'))
                                <p class="text-red">
                                    {{ $errors->first($locale.'.content') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('lara-mvcms::pages.buttons.save') }}</button>
</form>
