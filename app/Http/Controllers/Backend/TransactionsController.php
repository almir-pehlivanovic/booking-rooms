<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['room', 'user'])->get();

        return view('booking-rooms.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::where('id', $id)->with(['room', 'user'])->firstOrFail();
       
        $user = auth()->user();
        $notifications = $user->notifications()->get();
        foreach($notifications as $notification)
        {
           
            if($transaction->id == $notification->data['id'])
            {
                $notifications = $user->notifications()->first();
                $notification->markAsRead();

                if(is_null($transaction->room)){
                    $transactions = Transaction::with(['room', 'user'])->get();
                    return view('booking-rooms.transactions.index', compact('transactions'));
                }
            }
        }
        
        return view('booking-rooms.transactions.show', compact('transaction'));
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();

        return redirect('/backend/transactions')->with('message', 'Your transaction was deleted');
    }
}

