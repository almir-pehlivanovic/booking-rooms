@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">{{ $event->name }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <p class= "form-control-static" id="name"> {{ $event->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="name">Room</label>
                            <p class= "form-control-static" id="name"> {{ $event->room->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="name">User</label>
                            <p class= "form-control-static" id="name"> {{ $event->user->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="name">Start time</label>
                            <p class= "form-control-static" id="name"> {{ $event->start_time }}</p>
                        </div>
                        <div class="form-group">
                            <label for="name">End time</label>
                            <p class= "form-control-static" id="name"> {{ $event->end_time }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <p class= "form-control-static" id="description"> {{ $event->description }}</p>
                        </div>
                        <a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection