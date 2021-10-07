<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Lang;

class MailResetPasswordNotification extends ResetPassword
{
    use Queueable;
    protected $pageUrl;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
       parent::__construct($token);
       $this->pageUrl = '/reset';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if(static::$toMailCallback){
            return call_user_func(static::$toMailCallback, $notifiable, $this->token)
        }
        return (new MailMessage)
                    ->suject(Lang::getFromJson('Redefinir a senha do aplicativo'))
                    ->line(Lang::getFromJson('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.'))
                    ->action(Lang::getFromJson('Redefinir a senha'), $this->pageUrl."?token=".$this->token)
                    ->line(Lang::getFromJson('Este link de redefinição de senha irá expirar em :count.', ['count' => config('auth.passwords.users.expire')]))
                    ->line(Lang::getFromJson('Se você não solicitou uma redefinição de senha, nenhuma ação adicional será necessária.'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
