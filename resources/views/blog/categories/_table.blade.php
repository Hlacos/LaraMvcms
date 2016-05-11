<table class="table table-bordered table-striped table-hover dataTable">
    <thead class="bg-primary">
        <tr class="mid">
            <th class="col-md-1">{{ trans('lara-mvcms::categories.index.id') }}</th>
            <th>{{ trans('lara-mvcms::categories.index.title') }}</th>
            <th>{{ trans('lara-mvcms::categories.index.slug') }}</th>
            <th>{{ trans('lara-mvcms::categories.index.description') }}</th>
            <th class="buttons col-md-1"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td class="col-md-1">{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description }}</td>
                <td class="buttons col-md-1">
                    <div class="btn-group">
                        <a href="{{ route('lara-mvcms.blog.categories.edit', $category->id) }}" class="btn btn-primary btn-sm" title="{{ trans('lara-mvcms::categories.buttons.edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="{{ route('lara-mvcms.blog.categories.delete', $category->id) }}" title="{{ trans('lara-mvcms::categories.buttons.delete') }}" class="btn btn-sm btn-danger remove-button"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
