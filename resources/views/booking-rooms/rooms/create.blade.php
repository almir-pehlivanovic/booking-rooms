@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">Add Room</div>

                    <div class="card-body">
                    {!! Form::model($rooms, [
                            'method'    => 'POST',
                            'route'     => 'rooms.store',  

                    ]) !!}

                        @include('booking-rooms.rooms.form')

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection