<table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th width="5%" scope="col"></th>
        <th width="15%" scope="col">ID</th>
        <th width="15%" scope="col">Name</th>
        <th width="25%" scope="col">Display name</th>
        <th width="25%" scope="col">Description</th>
        <th width="15%" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($permissions as $permission)
            <tr>
                <th class="text-center" scope="row"><input type="checkbox"></th>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->display_name }}</td>
                <td>{{ $permission->description }}</td>
                <td class="text-center mobile-buttons">
                    <a href="{{ route('permissions.show', $permission->id) }}" type="button" class="btn btn-info btn-sm"> View</a>
                    <a href="{{ route('permissions.edit', $permission->id) }}" type="button" class="btn btn-warning btn-sm"> Edit</a>
                    {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id]]) !!}
                        <button type="submit" onclick = "return confirm('You are about to delete permission permanently. Are you sure?')" class="btn btn-danger btn-sm"> Delete</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>