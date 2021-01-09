<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreditsReminder extends Notification
{
    use Queueable;

    public $credits;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($credits)
    {
        $this->credits = $credits;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    
    public function toDatabase($notifiable)
    {
        return [
            'id'        => $this->credits->id,
            'time'      => $this->credits->created_at,
            'message'   => 'Your credit balance is low ('. $this->credits->credits . '$), please add more credits.'
        ];
    }
}
