@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">Edit User</div>

                    <div class="card-body">
                    {!! Form::model($users, [
                            'method'    => 'PUT',
                            'route'     => ['users.update', $users->id],  
                            'files'     => TRUE    

                    ]) !!}

                        @include('booking-rooms.users.form')

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
