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
                <div class="card mt-3">
                    <div class="card-header">Edit User</div>

                    <div class="card-body">
                    {!! Form::model($users, [
                            'method'    => 'PUT',
                            'url'       => '/backend/edit-account',
                            'files'     => TRUE    

                    ]) !!}

                        @include('booking-rooms.users.form',  ['hideRoleDropdown' => true])

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
