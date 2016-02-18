<table class="table table-bordered table-striped table-hover dataTable">
    <thead class="bg-primary">
        <tr class="mid">
            <th class="col-md-1">{{ trans('lara-mvcms::roles.index.id') }}</th>
            <th>{{ trans('lara-mvcms::roles.index.name') }}</th>
            <th>{{ trans('lara-mvcms::roles.index.title') }}</th>
            <th>{{ trans('lara-mvcms::roles.index.description') }}</th>
            <th class="buttons col-md-1"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $role)
            <tr>
                <td class="col-md-1">{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->title }}</td>
                <td>{{ $role->description }}</td>
                <td class="buttons col-md-1">
                    <div class="btn-group">
                        <a href="{{ route('lara-mvcms.administration.roles.edit', $role->id) }}" class="btn btn-primary btn-sm" title="{{ trans('lara-mvcms::roles.buttons.edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="{{ route('lara-mvcms.administration.roles.delete', $role->id) }}" title="{{ trans('lara-mvcms::roles.buttons.delete') }}" class="btn btn-sm btn-danger remove-button"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
