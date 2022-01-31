<?php

namespace App\Notifications\Customer;

use App\EloquentModels\Customer\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendExchangeRate extends Notification
{
    use Queueable;

    /**
     * @var object
     */
    private $echangeRate;
    /**
     * @var User
     */
    private $user;

    /**
     * @param object $echangeRate
     * @param User $user
     */
    public function __construct(object $echangeRate, User $user)
    {
        $this->echangeRate = $echangeRate;
        $this->user = $user;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $email = $notifiable->email;
        return (new MailMessage)
            ->cc($this->user->email)
            ->view('customers.emails.sendExchangeRate', ['exchange' => $this->echangeRate, 'user' => $this->user]);
    }

    /**
     * Get the array representation of the notification.nao
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
