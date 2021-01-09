<?php   
    if(isset($_GET['capacity']))
    {$capacity = $_GET['capacity'];}
    else{$capacity = null;}

    if(isset($_GET['end_time']))
    {$end_time = $_GET['end_time'];}
    else{$end_time = null;}

    if(isset($_GET['start_time']))
    {$start_time = $_GET['start_time'];}
    else{$start_time = null;}
?>

@extends('layouts.main')

@section('content')
<div class="container'fluid">
    <div class="row m-0 justify-content-center">
        <div class="col-md-12">
            <div class="row m-0">
                <div class="col-12 p-0 mt-3">
                    @include('booking-rooms.messages')
                </div>
            </div>
            <div class="card mt-3 mb-4">
                <div class="card-header">Search the room</div>
                <div class="card-body">
                    {!! Form::open(['class' => 'form-row', 'method' => 'GET']) !!}

                        <div class="form-group col-6 col-md-4">
                            {!! Form::label('start_time', 'Start Date') !!}
                            {!! Form::datetimeLocal('start_time',  $start_time, ['class' => 'form-control', 'placeholder' => 'Start Time']) !!}

                        </div>
                        <div class="form-group col-6 col-md-4 margin-search-date-mobile">
                            {!! Form::label('end_time', 'End Date') !!}
                            {!! Form::datetimeLocal('end_time', $end_time, ['class' => 'form-control', 'placeholder' => 'End Time']) !!}
                        </div>
                        <div class="form-group col-8 col-md-3">
                            {!! Form::label('capacity', 'Capacity') !!}
                            {!! Form::number('capacity', $capacity, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <br class="d-block br-block-tablet-landscape">
                            {!! Form::button('Search', ['type' => 'submit','class' => 'btn btn-success mt-2']) !!}
                        </div>
                    {!! Form::close() !!}
                    
                    @if($checkRooms)
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Room</th>
                                    <th scope="col">Capacity</th>
                                    <th scope="col">Hourly Rate</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td class="room-name">{{ $room->name }}</td>
                                        <td>{{ $room->capacity }}</td>
                                        <td><?php if($room->hourly_rate){ echo $room->hourly_rate; } else { echo "FREE"; } ?></td>
                                        <td class="text-center">
                                            <a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#bookRoom" data-room-id="{{ $room->id }}"> Book Room</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="bookRoom">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking of a room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bookings.book-room') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="room_id" id="room_id" value="{{ old('room_id') }}">
                    <input type="hidden" name="start_time" value="{{ request()->input('start_time') }}">
                    <input type="hidden" name="end_time" value="{{ request()->input('end_time') }}">
                    <div class="form-group">
                        <label class="required" for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>
                    <div class="form-group">
                            <label for="start">Start time</label>
                            <p class= "form-control-static" id="start"> {{ date("Y-m-d H:i", strtotime($start_time)) }}</p>
                    </div>
                    <div class="form-group">
                        <label for="end">End Time</label>
                        <p class= "form-control-static" id="end"> {{ date("Y-m-d H:i", strtotime($end_time)) }}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('recurring_until', 'Recurring until') !!}
                        {!! Form::datetimeLocal('recurring_until', null, ['class' => 'form-control']) !!}
                    </div>
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitBooking">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$('#bookRoom').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var roomId = button.data('room-id');
    var modal = $(this);
    modal.find('#room_id').val(roomId);
    modal.find('.modal-title').text('Booking of a room ' + button.parents('tr').children('.room-name').text());

    $('#submitBooking').click(() => {
        modal.find('button[type="submit"]').trigger('click');
    });
});

</script>
@endsection

