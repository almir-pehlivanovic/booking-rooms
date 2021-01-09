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
        @foreach($roles as $role)
            <tr>
                <th class="text-center" scope="row"><input type="checkbox"></th>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->description }}</td>
                <td class="text-center mobile-buttons">
                    <a href="{{ route('roles.show', $role->id) }}" type="button" class="btn btn-info btn-sm"> View</a>
                    <a href="{{ route('roles.edit', $role->id) }}" type="button" class="btn btn-warning btn-sm"> Edit</a>
                    {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['roles.destroy', $role->id]]) !!}
                        <button type="submit" onclick = "return confirm('You are about to delete role permanently. Are you sure?')" class="btn btn-danger btn-sm"> Delete</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>