<table class="table table-bordered table-striped table-hover dataTable">
    <thead class="bg-primary">
        <tr class="mid">
            <th class="col-md-1">{{ trans('lara-mvcms::admin-users.index.id') }}</th>
            <th>{{ trans('lara-mvcms::admin-users.index.username') }}</th>
            <th>{{ trans('lara-mvcms::admin-users.index.email') }}</th>
            <th>{{ trans('lara-mvcms::admin-users.index.name') }}</th>
            <th class="buttons col-md-1"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($adminUsers as $adminUser)
            <tr>
                <td class="col-md-1">{{ $adminUser->id }}</td>
                <td>{{ $adminUser->username }}</td>
                <td>{{ $adminUser->email }}</td>
                <td>{{ $adminUser->name }}</td>
                <td class="buttons col-md-1">
                    <div class="btn-group">
                        <a href="{{ route('lara-mvcms.administration.admin-users.edit', $adminUser->id) }}" class="btn btn-primary btn-sm" title="{{ trans('lara-mvcms::admin-users.buttons.edit') }}"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href="{{ route('lara-mvcms.administration.admin-users.delete', $adminUser->id) }}" title="{{ trans('lara-mvcms::admin-users.buttons.delete') }}" class="btn btn-sm btn-danger remove-button"><span class="glyphicon glyphicon-trash"></span></a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
