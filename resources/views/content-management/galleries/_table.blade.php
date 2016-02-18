<table class="table table-bordered table-striped table-hover dataTable">
    <thead class="bg-primary">
        <tr class="mid">
            <th class="col-md-1">{{ trans('lara-mvcms::galleries.index.id') }}</th>
            <th>{{ trans('lara-mvcms::galleries.index.title') }}</th>
            <th>{{ trans('lara-mvcms::galleries.index.filename') }}</th>
            <th>{{ trans('lara-mvcms::galleries.index.extension') }}</th>
            <th>{{ trans('lara-mvcms::galleries.index.file_type') }}</th>
            <th>{{ trans('lara-mvcms::galleries.index.size') }}</th>
            <th class="buttons col-md-1"></th>
        </tr>
    </thead>
    <tbody>
        @if (!$currentGallery->isRoot())
            <tr>
                <td class="col-md-1">{{ $currentGallery->parent_id }}</td>
                <td><a href="{{ route('lara-mvcms.content-management.galleries.index', ['parent_id' => $currentGallery->parent_id]) }}" title="Parent">..</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="col-md-1">
                </td>
            </tr>
        @endif
        @foreach ($galleries as $gallery)
            <tr>
                <td class="col-md-1">{{ $gallery->id }}</td>
                <td><a href="{{ $gallery->is_directory ? route('lara-mvcms.content-management.galleries.index', ['parent_id' => $gallery->id]) : $gallery->image->publicUrl() }}" title="{{ $gallery->title }}">{{ $gallery->title }}</a></td>
                <td>{{ $gallery->is_directory ? "" : $gallery->image->filename }}</td>
                <td>{{ $gallery->is_directory ? "" : $gallery->image->extension }}</td>
                <td>{{ $gallery->is_directory ? "" : $gallery->image->file_type }}</td>
                <td>{{ $gallery->is_directory ? "" : readableSize($gallery->image->size) }}</td>
                <td class="buttons col-md-1">
                    <div class="btn-group">
                        <a href="{{ route('lara-mvcms.content-management.galleries.edit', $gallery->id) }}" class="btn btn-primary btn-sm" title="{{ trans('lara-mvcms::galleries.buttons.edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="{{ route('lara-mvcms.content-management.galleries.delete', $gallery->id) }}" title="{{ trans('lara-mvcms::galleries.buttons.delete') }}" class="btn btn-sm btn-danger remove-button"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
