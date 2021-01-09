@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">{{ $permission->name }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <p class= "form-control-static" id="name"> {{ $permission->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Display Name</label>
                            <p class= "form-control-static" id="capacity"> {{ $permission->display_name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <p class= "form-control-static" id="description"> {{ $permission->description }}</p>
                        </div>
                        <a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection