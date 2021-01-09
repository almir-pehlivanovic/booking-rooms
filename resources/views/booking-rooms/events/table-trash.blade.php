<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="5%" scope="col"></th>
            <th scope="col">ID</th>
            <th scope="col">Room</th>
            <th scope="col">User</th>
            <th scope="col">Name</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">Description</th>
            <th width="15%" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
            <tr>
                <th class="text-center" scope="row"><input type="checkbox"></th>
                <td>{{ $event->id }}</td>
                <td>{{ (!is_null($event->room)) ? $event->room->name : 'Room in Trash' }}</td>
                <td>{{ (!is_null($event->user)) ? $event->user->name : 'User in Trash' }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->start_time }}</td>
                <td>{{ $event->end_time }}</td>
                <td>{{ $event->description }}</td>
                <td class="text-center mobile-buttons">
                    @if(!is_null($event->room) && !is_null($event->user) )
                        {!! Form::open(['class' => 'd-inline', 'method' => 'PUT', 'route' => ['events.restore', $event->id]]) !!}
                            <button type="submit"  class="btn btn-warning btn-sm"> Restore</button>
                        {!! Form::close() !!}
                    
                        {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['events.force-destroy', $event->id]]) !!}
                            <button type="submit" onclick="return confirm('You are about to delete a event permanently. Are you sure?')" class="btn btn-danger btn-sm"> Remove</button>
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>