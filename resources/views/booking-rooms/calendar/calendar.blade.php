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
                <div class="card-header">Calendar of events </div>
                <div class="card-body">
                    {!! Form::open(['class' => 'form-row', 'method' => 'GET', 'route' =>'calendar.index']) !!}

                        <div class="form-group col-5 ">
                            {!! Form::label('room_id', 'Room') !!}
                            {!! Form::select('room_id', App\Room::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select room' ]) !!}
                        </div>
                        <div class="form-group col-5 ml-4 mr-2">
                            {!! Form::label('user_id', 'User') !!}
                            {!! Form::select('user_id', App\User::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select user' ]) !!}
                        </div>

                        {!! Form::button('Filter', ['type' => 'submit','class' => 'btn btn-primary ml-2 margin-filter-button']) !!}
                    {!! Form::close() !!}
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <script>
        $(document).ready(function(){
            events = {!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                events: events,
                
            });
        });
    </script>
@endsection