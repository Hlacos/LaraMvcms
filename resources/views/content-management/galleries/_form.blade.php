<form action="{{ $gallery->id ? route('lara-mvcms.content-management.galleries.update', $gallery->id) : route('lara-mvcms.content-management.galleries.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @if ($gallery->id)
        <input type="hidden" name="_method" value="put" />
    @endif
    {{ csrf_field() }}

    <input type="hidden" name="parent_id" value="{{ $parentId }}" />

    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">{{ trans('lara-mvcms::galleries.gallery') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label" for="title">{{ trans('lara-mvcms::models/gallery.title') }}</label>
                <div class="col-sm-10">
                    <input type="text" name="title" id="title" value="{{ old('title') !== null ? old('title') : $gallery->title }}" class="form-control" placeholder="{{ trans('lara-mvcms::models/gallery.title') }}">
                    @if ($errors->has('title'))
                        <p class="text-red">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <input type="hidden" name="is_directory" value="{{ $isDirectory }}">
            @if (!$isDirectory)
                <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">{{ trans('lara-mvcms::models/gallery.attachment') }}</label>
                    <div class="col-sm-10">
                        <input type="file" id="attachment" name="attachment" {{ count(old()) ? (old('is_directory') ? "disabled" : "") : ($gallery->is_directory ? "disabled" : "") }}>
                        @if ($errors->has('attachment'))
                            <p class="text-red">
                                {{ $errors->first('attachment') }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('lara-mvcms::galleries.buttons.save') }}</button>
</form>
