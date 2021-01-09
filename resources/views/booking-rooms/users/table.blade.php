<table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th width="5%" scope="col"></th>
        <th scope="col">ID</th>
        <th width="25%" scope="col">Name</th>
        <th width="15%" scope="col">E-mail</th>
        <th scope="col">Role</th>
        <th scope="col">Credits</th>
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
                <td>{{ $user->roles->first()->display_name }}</td>
                <td class="<?php if($user->credits <= 500 && $user->id != 1) {?>text-danger <?php }?>">{{ $user->credits ? ($user->credits)/100 .'$' : 'no credits'}}</td>
                <td class="text-center mobile-buttons">
                    <a href="{{ route('users.show', $user->slug) }}" type="button" class="btn btn-info btn-sm"> View</a>
                    <a href="{{ route('users.edit', $user->slug) }}" type="button" class="btn btn-warning btn-sm"> Edit</a>
                    {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                        <button type="submit"  class="btn btn-danger btn-sm"> Delete</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>