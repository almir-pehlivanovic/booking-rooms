<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaction;
use App\User;
use App\Notifications\TransactionsNotification;

class BalanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
       // $user->load('transactions.room');
        $intent = $user->createSetupIntent();

        return view('booking-rooms.balance', compact('user', 'intent'));
    }

    public function add(Request $request)
    {
       
        $paymentMethod = $request->input('payment_method');
        $user          = $request->user();
        $admin         = User::where('id', 1)->first();
       
        try
        {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $stripeCharge = $user->charge($request->input('amount'), $paymentMethod);

            Transaction::create([
                'user_id'     => $user->id,
                'paid_amount' => $stripeCharge->amount,
            ]);

            //notifiy the admin about the transaction
            $id = Transaction::latest()->first()->id;
            $admin->notify(new TransactionsNotification(Transaction::findOrFail($id)));

            $user->credits += $stripeCharge->amount;
            $user->save();
        } 
        catch(\Exception $ex)
        {
            return redirect()->back()->withErrors([$ex->getMessage()]);
        }

        return redirect()->back()->with('message-transaction', 'Transaction completed');
    }

    public function show($id)
    {
        $user = auth()->user();
        // $user->load('transactions.room');
        $intent = $user->createSetupIntent();

        $notifications = $user->notifications()->get();
        foreach($notifications as $notification)
        {
           
            if($user->id == $notification->data['id'])
            {
                $notifications = $user->notifications()->first();
                $notification->markAsRead();

                // if(is_null($transaction->room)){
                //     $transactions = Transaction::with(['room', 'user'])->get();
                //     return view('booking-rooms.transactions.index', compact('transactions'));
                // }
            }
        }
        
        return view('booking-rooms.balance', compact('user', 'intent'));
    }
}
