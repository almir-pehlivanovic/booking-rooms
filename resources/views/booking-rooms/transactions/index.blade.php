@extends('layouts.main')

@section('content')
<div class="container'fluid">
    <div class="row m-0 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Transactions</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Transaction Time</th>
                                    <th scope="col">Room</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <th class="text-center" scope="row">{{ $transaction->id }}</th>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->room ? $transaction->room->name : ''  }}</td>
                                        <td>{{ (!is_null($transaction->user)) ? $transaction->user->name : 'User moved to trash' }}</td>
                                        <td>{{ number_format($transaction->paid_amount / 100, 2) ?? '0.00' }}</td>
                                        <td class="text-center mobile-buttons"> 
                                            @if($transaction->room)
                                                <a href="{{ route('transactions.show', $transaction->id) }}" type="button" class="btn btn-info btn-sm"> View</a>
                                            @endif
                                            {!! Form::open(['class' => 'd-inline', 'method' => 'DELETE', 'route' => ['transactions.destroy', $transaction->id]]) !!}
                                                <button type="submit" onclick="return confirm('You are about to delete a transaction permanently. Are you sure?')" class="btn btn-danger btn-sm"> Remove</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
