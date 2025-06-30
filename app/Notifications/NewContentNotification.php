<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public $contentType, 
        public $title,
        public $excerpt,
        public $url
    )
    {
        //
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                   
                    ->subject("[ANEEPES] Nouveau $this->contentType : " . $this->title)
                    ->greeting("Bonjour,")
                    ->line("Un nouvel  $this->contentType a été publié sur le site de la FNEB :")
                    ->line('**' . $this->title . '**')
                    ->line($this->excerpt)
                    ->action('Lire la suite', $this->url)
                    ->line('Pour ne plus recevoir ces notifications :');
                   // ->action('Se désabonner', route('newsletter.unsubscribe', $subscriber->token));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
