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
                    <div class="card-header">{{ $user->name }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <p class= "form-control-static" id="name"> {{ $user->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <p class= "form-control-static" id="name"> {{ $user->email }}</p>
                        </div>
                        <div class="form-group">
                            <label for="name">Credits</label>
                            <div class="d-flex">
                                <p class= "form-control-static <?php if($user->credits <= 500){?>text-danger <?php }?>" id="name"> {{ $user->credits ? ($user->credits)/100 .'$' : 'no credits' }}</p>
                                @if($user->credits <= 500)
                                    {!! Form::open(['class' => 'ml-3', 'method' => 'POST', 'route' => ['users.reminder', $user->id]]) !!}
                                        <button type="submit"  class="btn btn-warning btn-sm d-inline"> Send reminder</button>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                           
                        </div>
                        <a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection