@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">Edit Room</div>

                    <div class="card-body">
                    {!! Form::model($rooms, [
                            'method'    => 'PUT',
                            'route'     => ['rooms.update', $rooms->id],  

                    ]) !!}

                        @include('booking-rooms.rooms.form')

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection