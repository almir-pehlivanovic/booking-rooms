<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionsNotification extends Notification
{
    use Queueable;


    public $transaction;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id'                => $this->transaction->id,
            'transaction_time'  => $this->transaction->created_at,
            'room'              => $this->transaction->room_id ,
            'user'              => $this->transaction->user_id,
            'amount'            => $this->transaction->paid_amount,
        ];
    }

  
}
