<table class="table table-bordered table-striped table-hover dataTable">
    <thead class="bg-primary">
        <tr class="mid">
            <th class="col-md-1">{{ trans('lara-mvcms::pages.index.id') }}</th>
            <th>{{ trans('lara-mvcms::pages.index.name') }}</th>
            <th>{{ trans('lara-mvcms::pages.index.slug') }}</th>
            <th>{{ trans('lara-mvcms::pages.index.title') }}</th>
            <th>{{ trans('lara-mvcms::pages.index.description') }}</th>
            <th class="buttons col-md-1"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pages as $page)
            <tr>
                <td class="col-md-1">{{ $page->id }}</td>
                <td>{{ $page->name }}</td>
                <td>{{ $page->slug }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->description }}</td>
                <td class="buttons col-md-1">
                    <div class="btn-group">
                        <a href="{{ route('lara-mvcms.content-management.pages.edit', $page->id) }}" class="btn btn-primary btn-sm" title="{{ trans('lara-mvcms::pages.buttons.edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="{{ route('lara-mvcms.content-management.pages.delete', $page->id) }}" title="{{ trans('lara-mvcms::pages.buttons.delete') }}" class="btn btn-sm btn-danger remove-button"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
