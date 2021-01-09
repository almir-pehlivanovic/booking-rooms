<table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th scope="col"></th>
        <th scope="col">ID</th>
        <th width="25%" scope="col">Name</th>
        <th width="15%" scope="col">Capacity</th>
        <th width="25%" scope="col">Description</th>
        <th scope="col">Hourly Rate</th>
        <th width="15%" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($rooms as $room)
            <tr>
                <th class="text-center" scope="row"><input type="checkbox"></th>
                <td>{{ $room->id }}</td>
                <td>{{ $room->name }}</td>
                <td>{{ $room->capacity }}</td>
                <td>{{ $room->description }}</td>
                <td><?php if(!is_null($room->hourly_rate)){ echo $room->hourly_rate . " $"; } else { echo "FREE"; } ?></td>
                <td class="text-center mobile-buttons">
                    {!! Form::open(['class' => 'd-inline', 'method' => 'PUT', 'route' => ['rooms.restore', $room->id]]) !!}
                        <button type="submit"  class="btn btn-warning btn-sm"> Restore</button>
                    {!! Form::close() !!}
                   
                    {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['rooms.force-destroy', $room->id]]) !!}
                        <button type="submit" onclick="return confirm('You are about to delete a room permanently. Are you sure?')" class="btn btn-danger btn-sm"> Remove</button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>