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
                <td>{{ $event->room->name }}</td>
                <td>{{ $event->user->name }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->start_time }}</td>
                <td>{{ $event->end_time }}</td>
                <td>{{ $event->description }}</td>
                <td class="text-center mobile-buttons">
                    <a href="{{ route('events.show', $event->slug) }}" type="button" class="btn btn-info btn-sm"> View</a>
                    <a href="{{ route('events.edit', $event->slug) }}" type="button" class="btn btn-warning btn-sm"> Edit</a>
                    {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['events.destroy', $event->id]]) !!}
                        <button type="submit"  class="btn btn-danger btn-sm"> Delete</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>