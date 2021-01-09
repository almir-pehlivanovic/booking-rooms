<table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th width="5%" scope="col"></th>
        <th width="15%" scope="col">ID</th>
        <th width="25%" scope="col">Name</th>
        <th width="15%" scope="col">E-mail</th>
        <th width="25%" scope="col">Role</th>
        <th width="15%" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <th class="text-center" scope="row"><input type="checkbox"></th>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->name }}</td>
                <td class="text-center mobile-buttons">
                    {!! Form::open(['class' => 'd-inline', 'method' => 'PUT', 'route' => ['users.restore', $user->id]]) !!}
                        <button type="submit"  class="btn btn-warning btn-sm"> Restore</button>
                    {!! Form::close() !!}
                   
                    {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['users.force-destroy', $user->id]]) !!}
                        <button type="submit" onclick="return confirm('You are about to delete a user permanently. Are you sure?')" class="btn btn-danger btn-sm"> Remove</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>