<table class="table table-bordered table-striped table-hover dataTable">
    <thead class="bg-primary">
        <tr class="mid">
            <th class="col-md-1">{{ trans('lara-mvcms::permissions.index.id') }}</th>
            <th>{{ trans('lara-mvcms::permissions.index.name') }}</th>
            <th>{{ trans('lara-mvcms::permissions.index.title') }}</th>
            <th>{{ trans('lara-mvcms::permissions.index.description') }}</th>
            <th class="buttons col-md-1"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td class="col-md-1">{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->title }}</td>
                <td>{{ $permission->description }}</td>
                <td class="buttons col-md-1">
                    <div class="btn-group">
                        <a href="{{ route('lara-mvcms.administration.permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm" title="{{ trans('lara-mvcms::permissions.buttons.edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="{{ route('lara-mvcms.administration.permissions.delete', $permission->id) }}" title="{{ trans('lara-mvcms::permissions.buttons.delete') }}" class="btn btn-sm btn-danger remove-button"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
