@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">Edit Role</div>

                    <div class="card-body">
                    {!! Form::model($permissions, [
                            'method'    => 'PUT',
                            'route'     => ['permissions.update', $permissions->id],  

                    ]) !!}

                        @include('booking-rooms.permissions.form')

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection