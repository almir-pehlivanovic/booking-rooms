@extends('layouts.main')

@section('content')
    <div class="container'fluid">
        <div class="row m-0 justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">Transaction number {{ $transaction->id }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Room</label>
                            <p class= "form-control-static" id="name"> {{ $transaction->room->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="capacity">User</label>
                            <p class= "form-control-static" id="capacity"> {{ $transaction->user->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="capacity">Created at</label>
                            <p class= "form-control-static" id="capacity"> {{ $transaction->created_at }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Amount</label>
                            <p class= "form-control-static" id="description"> {{ ($transaction->paid_amount) / 100 }} $</p>
                        </div>
                        <a href="#" onclick="history.back()" type="button" class="btn btn-primary d-inline">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection