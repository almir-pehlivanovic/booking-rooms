@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">{{ $role->name }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <p class= "form-control-static" id="name"> {{ $role->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Display Name</label>
                            <p class= "form-control-static" id="capacity"> {{ $role->display_name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <p class= "form-control-static" id="description"> {{ $role->description }}</p>
                        </div>
                        <div class="form-group">
                        {!! Form::label('permissions', 'Permissions') !!}
                        <div class="bg-light text-dark form-control h-auto" id="permissions" name="permissions">
                            @foreach($permissions as $permission)
                                <div class="form-check form-check-inline">
                                    <p class= "form-control-static" id="permission"> {{ $permission->name }}</p>
                                </div>
                            @endforeach
                        </div>

                        @if($errors->has('permission'))
                            <span class="help-block text-danger">{{ $errors->first('permission') }}</span>
                        @endif 
                    </div>
                        <a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection